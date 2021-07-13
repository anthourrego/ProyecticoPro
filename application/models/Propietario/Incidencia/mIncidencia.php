<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mIncidencia extends CI_Model {

    function listaEquipos(){
		$sql = "SELECT 
					I.ItemEquipoId
					,E.Nombre
					,I.Serial
				FROM Itemequipo I
					LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
				WHERE E.Estado = 'A' AND I.Estado = 'A'";

		$consulta = $this->db->query($sql)->result();

		return $consulta;
	}

	function listaTipoIncidencia(){
		$sql = "SELECT TipoIncidenciaId, Nombre FROM TipoIncidencia WHERE Estado = 'A'";

		$listaTipoIncidencia = $this->db->query($sql)->result();

		return $listaTipoIncidencia;
	}

	function selectEstado(){
		$sql = "SELECT * FROM EstadoIncidencia
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function insertar($data,$detalle){

		$sql = "SELECT ConseHeadIncidencia FROM Montaje";
		$montaje = $this->db->query($sql)->result();

		if(count($montaje) > 0 ){
			$sql = "UPDATE Montaje SET ConseHeadIncidencia = CASE WHEN ConseHeadIncidencia IS NULL THEN 1 ELSE ConseHeadIncidencia + 1 END";
		}else{
			$sql = "INSERT INTO Montaje (ConseHeadIncidencia) values (1)";
		}

		try{
			$this->db->query($sql);
		}catch (Exception $e){
			return 0;
		}

		$sql = "SELECT ConseHeadIncidencia FROM Montaje";
		try{
			$Numero = $this->db->query($sql)->row()->ConseHeadIncidencia;
			$data['Numero'] = $Numero;

		}catch (Exception $e){
			return 0;
		}
	
		try{
			$this->db->insert('HeadIncidencia', $data);
			$pqrid = $this->db->insert_id();
		}catch (Exception $e){
			return 0;
		}

		try{
			$detalle['HeadIncidenciaId'] = $pqrid;
			$this->db->insert('DetalleIncidencia', $detalle);
			$detallaid = $this->db->insert_id();
		}catch (Exception $e){
			return 0;
		}

	
		return array($pqrid, $Numero);
	}
	
	function agregarNota($nota) {
		$this->db->trans_begin();
		 
		$this->db->insert('NotaIncidencia', $nota);


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			$insert_id = $this->db->insert_id();
			return $insert_id; 
		}
	}

	function AdjuntarArchivos($tipo, $id, $incidencia) {
		$files = $_FILES;
		$cpt = count($_FILES['archivos']['name']);
		$subidas = array();

		if($files['archivos']['size'][0] > 0) {
			// Configuración upload
			$config = array();
			$config['upload_path']      = FCPATH.'uploads/'.$this->session->userdata('NIT').'/Incidencia/'  . $incidencia;
			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');

			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			// Subida de cada archivo
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['archivos']['name']     = $files['archivos']['name'][$i];
				$_FILES['archivos']['type']     = $files['archivos']['type'][$i];
				$_FILES['archivos']['tmp_name'] = $files['archivos']['tmp_name'][$i];
				$_FILES['archivos']['error']    = $files['archivos']['error'][$i];
				$_FILES['archivos']['size']     = $files['archivos']['size'][$i];
				$config['file_name'] = 'Anexo_'.$id."_".$_FILES['archivos']['name'];
				$this->upload->initialize($config); 

				$archivo = array(
					'Id'      => $id,
					'Tipo'    => $tipo,
					'Fecha'   => date("Y-m-d H:i:s"),
					'Ruta'    => './uploads/'.$this->session->userdata('NIT').'/Incidencia/' . $incidencia . '/Anexo_'.$id."_".$_FILES['archivos']['name']
				);

				// Inserta la PQR para conseguir su consecutivo
				$this->db->insert('Anexo', $archivo);
				$insert_id = $this->db->insert_id();
				
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
				} else {
					$subida = array();
					$subida['nombre'] = $_FILES['archivos']['name'];
					$this->upload->initialize($config);
					if ($this->upload->do_upload('archivos')) {
						$data = $this->upload->data();
						// Resize
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data['full_path'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 512;
						$config['height'] = 512;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$subida['estado'] = 1;
					} else {
						$this->db->trans_rollback();
						$subida['estado'] = 0;
					}
					array_push($subidas, $subida);
				}
			}
		}
		return json_encode($subidas);
	}
	
	// 20/01/2020 ASUP - Crea alerta para todos los usuarios
	public function enviarAlertas($detalle, $numero) {
		$user = $this->session->userdata('id');

		$update = "UPDATE Alerta SET Estado = 'C', Ejecutada = GETDATE() WHERE Tipo = 'IN' AND Numero = '$numero'";
		$this->db->query($update);		

		$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
				SELECT '$user', S.usuarioId, '$detalle', GETDATE(), GETDATE(), 'IN', '', '$numero'
				FROM Segur S 
					INNER JOIN PermisoSistema PS ON S.usuarioId = PS.UsuarioId OR S.perfilId = PS.PerfilId
				WHERE PS.Permiso = '5'";
		$this->db->query($sql);

		if ($this->db->trans_status() === FALSE) {
			return 0;
		} else {
			return 1;
		}
	}

	function ver(){
        $id = $this->input->post('id');

        $datos = array();

		$sql = "SELECT 
					HI.HeadIncidenciaId AS Incidencia
					,HI.TipoIncidenciaId
					,HI.EstadoIncidenciaId
					,HI.TipoPrioridadIncidenciaId
					,E.Nombre AS NombreEstado
					,P.Nombre AS NombrePrioridad
					,T.Nombre AS NombreTipoIncidencia
					,HI.ItemEquipoId
					,HI.OperacionId
					,O.Operacion
					,HI.Ticket
					,HI.Asunto
					,HI.Descripcion
					,HI.Fecha
					,I.Serial
					,E.Nombre AS EstadoIncidencia
					,E.Cierre AS Cerrada
					,EQ.Nombre AS NombreEquipo
					,HI.Numero
				FROM HeadIncidencia HI
					LEFT JOIN EstadoIncidencia E ON HI.EstadoIncidenciaId = E.EstadoIncidenciaId
					LEFT JOIN TipoIncidencia T ON HI.TipoIncidenciaId = T.TipoIncidenciaId
					LEFT JOIN TipoPrioridadIncidencia P ON HI.TipoPrioridadIncidenciaId = P.TipoPrioridadIncidenciaId
					LEFT JOIN ItemEquipo I ON HI.ItemEquipoId = I.ItemEquipoId
					LEFT JOIN Operacion O ON HI.OperacionId = O.OperacionId
					LEFT JOIN Equipo EQ ON I.EquipoId = EQ.EquipoId
				WHERE HI.HeadIncidenciaId = '$id'";

        $incidencia = $this->db->query($sql)->result();

		$sql = "SELECT 
					S.Nombre AS Usuario
					,Descripcion
					,FechaRegis
					,Ruta AS Archivo
					,CASE 
						WHEN Privado = 1 THEN 'Privado' 
						ELSE 'Publico' 
					END Privado
					,CASE WHEN Privado = 1 THEN 'background:antiquewhite' 
						ELSE '' 
					END PrivadoColor
				FROM NotaIncidencia NI
					LEFT JOIN Segur S ON NI.UsuarioId = S.usuarioId
					LEFT JOIN Anexo A ON NI.NotaIncidenciaId = A.Id AND Tipo ='INCI'
				WHERE NI.Estado = 'A' 
					AND NI.HeadIncidenciaId = '$id'
				ORDER BY NotaIncidenciaId DESC";

		$NOTAINCIDENCIA = $this->db->query($sql)->result();

        $datos['informacion'] = $incidencia[0];

		$datos['notas'] = $NOTAINCIDENCIA;

        return $datos;
    }

	public function historialIncidencia(){
		$incidencia = $this->input->post('HeadIncidenciaId');
		$sql = "SELECT
					DI.FechaRegis,
					S.nombre,
					REPLACE(DI.Descripcion, CHAR(10) ,'<br>') DetalleP
				FROM DetalleIncidencia DI
					LEFT JOIN Segur S ON DI.UsuarioId = S.usuarioId
					LEFT JOIN Dependencia D ON S.DependenciaId = D.DependenciaId
				WHERE DI.HeadIncidenciaId = '$incidencia'";
		$data = $this->db->query($sql)->result();

		return $data;
	}
    
}

?>