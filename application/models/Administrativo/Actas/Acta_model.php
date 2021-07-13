<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acta_model extends CI_Model {

	function selectTipoReunion(){
		$sql = "SELECT TipoReunionId, Nombre FROM TipoReunion WHERE Estado = 'A' ORDER BY TipoReunionId ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectUsuario(){
		$sql = "SELECT usuarioId, nombre FROM Segur WHERE estado = 'A'";
		return $this->db->query($sql)->result();
	}

	function selectUsuariosAdmin(){
		$sql = "SELECT usuarioId, nombre FROM Segur WHERE Estado = 'A' AND Admin = '1'";
		return $this->db->query($sql)->result();

	}

	function crearActa(){
		$tipoReunion = $this->input->post("tipoReunion");		
		$tema = $this->input->post("tema");
		$quienElabora = $this->input->post("quienElabora");
		$tiempo = $this->input->post("tiempo");
		$permisoVisualizacion = $this->input->post("permisoVisualizacion");
		$permisoModificacion = $this->input->post("permisoModificacion");
		$permisoAnulacion = $this->input->post("permisoAnulacion");
		$asistentes = $this->input->post("asistentes");
		$otrosAsistentes = $this->input->post("otrosAsistentes");
		$objetivoReunion = $this->input->post("objetivoReunion");
		$temasTratados = $this->input->post("temasTratados");

		$_POST["RASTREO"]['fecha'] = date('d-m-Y H:i:s');
		$_POST["RASTREO"]['programa'] = "Actas"; 

		$this->db->trans_begin();

		try{
			$this->db->query("UPDATE Montaje SET ConseRadicadoActa = CASE WHEN ConseRadicadoActa IS NULL THEN 1 ELSE ConseRadicadoActa + 1 END");
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

		$nActa = $this->db->query("SELECT ConseRadicadoActa FROM Montaje")->row('ConseRadicadoActa');

		$sql = "INSERT INTO Acta (
					TipoReunionId
					,Radicado
					,Tema
					,Fecha
					,UsrElaboraId
					,OtroAsistente
					,ObjetivoReunion
					,TemaTratado
					,Estado
					,Tiempo
				) VALUES (
					'" . $tipoReunion . "'
					,'" . $nActa . "'
					,'" . $tema . "'
					,GETDATE()
					,'" . $quienElabora . "'
					,'" . $otrosAsistentes . "'
					,'" . $objetivoReunion . "'
					,'" . $temasTratados . "'
					,'A'
					,'" . $tiempo . "'
				)";

		try{
			$this->db->query($sql);
		}catch (Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

		$idActa = $this->db->insert_id();

		if (count($asistentes)) {
			foreach ($asistentes as $key => $value) {

				$sql = "INSERT INTO ActaAsistente(ActaId, UsuarioId, FechaRegis) VALUES ('" . $idActa . "', '" . $value . "', GETDATE())";

				try{
					$this->db->query($sql);
				}catch (Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}
		}

		if (count($permisoVisualizacion)) {
			foreach ($permisoVisualizacion as $key => $value) {
				
				$sql = "INSERT INTO ActaPermiso (ActaId, UsuarioId, Visualiza) VALUES ('" . $idActa . "', '" . $value . "', '1')";
				
				try{
					$this->db->query($sql);
				}catch (Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}
		}

		if (count($permisoModificacion)) {
			foreach ($permisoModificacion as $key => $value) {
				$validar = $this->db->query("SELECT ActaPermisoId FROM ActaPermiso WHERE ActaId = '" . $idActa . "' AND UsuarioId = '" .  $value . "'")->result();

				if (count($validar)) {
					$sql = "UPDATE ActaPermiso SET Modifica = '1' WHERE ActaPermisoId = '" . $validar[0]->ActaPermisoId . "'";
				} else {
					$sql = "INSERT INTO ActaPermiso (ActaId, UsuarioId, Modifica) VALUES ('" . $idActa . "', '" . $value . "', '1')";
				}

				try{
					$this->db->query($sql);
				}catch (Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}
		}

		if (count($permisoAnulacion)) {
			foreach ($permisoAnulacion as $key => $value) {

				$validar = $this->db->query("SELECT ActaPermisoId FROM ActaPermiso WHERE ActaId = '" . $idActa . "' AND UsuarioId = '" .  $value . "'")->result();

				if (count($validar)) {
					$sql = "UPDATE ActaPermiso SET Anula = '1' WHERE ActaPermisoId = '" . $validar[0]->ActaPermisoId . "'";
				} else {
					$sql = "INSERT INTO ActaPermiso (ActaId, UsuarioId, Anula) VALUES ('" . $idActa . "', '" . $value . "', '1')";
				}

				try{
					$this->db->query($sql);
				}catch (Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}
		}

		if($this->enviarAlertas('[Nueva Acta] - ' . $tema, $idActa) == 0){
			$this->db->trans_rollback();
			return 0;
		}
		

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			$_POST["RASTREO"]['cambio'] = "Crea acta nro " . $nActa;
			RASTREO();

			return array(
					'idActa' =>$idActa
					,'nroActa' => $nActa
				);
		}
	}

	public function crearCompromiso(){
		$idActa = $this->input->post("idActa");
		$nroActa = $this->input->post('nroActa');
		$idUsuario = $this->input->post("usuario");
		$prioridad = $this->input->post("prioridad");
		$descripcion = $this->input->post("descripcion");
		$fechaMaxima = $this->input->post("fecha");
		$asignado = $this->input->post("asignado");
		$prioridadNombre = $this->input->post("prioridadNombre");

		$_POST["RASTREO"]['fecha'] = date('d-m-Y H:i:s');
		$_POST["RASTREO"]['programa'] = "Actas"; 
		$_POST["RASTREO"]['cambio'] = "Registra nuevo compromiso del acta nro " . $nroActa . ", [Usuario: " . $asignado . "][Fecha Maxima: " . $fechaMaxima . "][Prioridad: " . $prioridadNombre . "][Descripción: " . $descripcion . "]";

		$this->db->trans_begin();

		$sql = "INSERT INTO ActaCompromiso (
					ActaId
					,UsuarioId
					,Prioridad
					,Descripcion
					,FechaMax
					,FechaRegis
					,Estado
					,UsuarioAsignaId
				) VALUES (
					'" . $idActa . "'
					,'" . $idUsuario . "'
					,'" . $prioridad . "'
					,'" . $descripcion . "'
					,'" . $fechaMaxima . "'																			
					,GETDATE()
					,'A'
					,'" . $this->session->userdata("id") . "'
				)";

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	public function listaCompromisos(){
		$sql = "SELECT
					'' AS Acciones
					,AC.ActaCompromisoId
					,S1.nombre AS UsuarioAsigna
					,S.nombre
					,CASE AC.Prioridad
						WHEN 'B' THEN 'Baja'
						WHEN 'M' THEN 'Media'
						WHEN 'A' THEN 'Alta'
					END AS Prioridad
					,AC.Descripcion
					,AC.FechaMax
					,AC.FechaRegis
				FROM ActaCompromiso AC
					LEFT JOIN Segur S ON AC.UsuarioId = S.usuarioId
					LEFT JOIN Segur S1 ON AC.UsuarioAsignaId = S1.usuarioId
				ORDER BY AC.ActaCompromisoId ASC";
		
		$consulta = $this->db->query($sql);
		
		return $consulta->result();
	}

	function eliminarCompromiso(){
		$idCompromiso = $this->input->post("idCompromiso");

		$this->db->trans_begin();

		$sql = "UPDATE ActaCompromiso SET Estado = 'I' WHERE ActaCompromisoId = $idCompromiso";

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function eliminarActa(){
		$id = $this->input->post("idActa");

		$this->db->trans_begin();

		$sql = "UPDATE Acta SET Estado = 'I' WHERE ActaId = $id";

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	public function anexoArchivo(){

		$codigo = $this->input->post('codigo');
		$nroActa = $this->input->post('nroActa');

		$_POST["RASTREO"]['fecha'] = date('d-m-Y H:i:s');
		$_POST["RASTREO"]['programa'] = "Actas"; 

		$files = $_FILES;
		$this->db->trans_begin();

		$nombreDoc = "";
		$cpt = count($_FILES['Lista_Anexos']['name']);
		$subidas = array();
		if($files['Lista_Anexos']['size'] > 0){
			//CONFIGURACION UPLOAD
			$config = array();
			$config['upload_path']      = FCPATH.'/uploads/'. $this->session->userdata('NIT') . '/Actas/' . $codigo;
			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');
			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}
			//SUBIDA DE CADA ARCHIVO
			$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
			$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
			$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
			$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
			$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];
			if (strpos($files['Lista_Anexos']['name'], " ") == true) {
				$nombreDoc = str_replace(' ','_',$files['Lista_Anexos']['name']); 
			}else{
				$nombreDoc = $files['Lista_Anexos']['name'];
			}
			$config['file_name'] = $nombreDoc;
			$this->upload->initialize($config);
			$archivo = array(
					'Id' => $codigo
					,'Tipo' => 'ACTA'
					,'Ruta' => 'uploads/'. $this->session->userdata('NIT') .'/Actas/' . $codigo .'/' . $nombreDoc
					,'Fecha' => date("Y-m-d H:i:s")
				);
			$this->db->insert('Anexo', $archivo);
			$insert_id = $this->db->insert_id();
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$subida = array();
				$subida['nombre'] = $_FILES['Lista_Anexos']['name'];
				if ($this->upload->do_upload('Lista_Anexos')) {
					$data = $this->upload->data();
					//RESIZE
					$config['image_library'] = 'gd2';
					$config['source_image'] = $data['full_path'];
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 512;
					$config['height'] = 512;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->db->trans_commit();
					$_POST["RASTREO"]['cambio'] = "Se agrega anexo " . $nombreDoc . " al acta nro " . $nroActa;
					RASTREO();
					$subida['estado'] = 1;
				} else {
					$this->db->trans_rollback();
					$subida['estado'] = 0;
				}
				array_push($subidas, $subida);
			}

		}else{
			return 0;
		}

		return $insert_id;
	}

	public function datosActa($id){
		$user = $this->session->userdata('id');

		$datos = $this->db->query("SELECT * FROM Acta WHERE ActaId = $id")->result();

		$permisos = $this->db->query("SELECT * FROM ActaPermiso WHERE ActaId = $id")->result();
		$asistentes = $this->db->query("SELECT * FROM ActaAsistente WHERE ActaId = $id")->result();	
		$asis = [];
		$visualiza = [];
		$modifica = [];
		$anula = [];

		if (count($asistentes)) {
			foreach ($asistentes as $key => $value) {
				$asis[] = $value->UsuarioId;
			}
		}

		if (count($permisos)) {
			foreach ($permisos as $key => $value) {
				if($value->Visualiza == 1){
					$visualiza[] = $value->UsuarioId;
				}
	
				if($value->Modifica == 1){
					$modifica[] = $value->UsuarioId;					
				}
	
				if($value->Anula == 1){
					$anula[] = $value->UsuarioId;	
				}
			}
		}

		$datos[0]->visualiza = $visualiza;
		$datos[0]->modifica = $modifica;
		$datos[0]->anula = $anula;
		$datos[0]->asistentes = $asis;		

		$this->db->query("UPDATE Alerta SET Estado = 'C', Ejecutada = GETDATE() WHERE Tipo = 'AC' AND Numero = '$id' AND AsignadoA = '$user'");	

		return $datos[0];
	}

	public function crearCompromisoSeguimiento(){
		$idSeguimientoCompromiso = $this->input->post("idSeguimientoCompromiso");
		$descripcion = $this->input->post("descripcion");
		$_POST["RASTREO"]['fecha'] = date('d-m-Y H:i:s');
		$_POST["RASTREO"]['programa'] = "Actas"; 

		$this->db->trans_begin();

		$sql = "INSERT INTO SeguimientoCompromiso (
					ActaCompromisoId, 
					UsuarioId,
					Seguimiento, 
					FechaRegis 
				) VALUES (
					'" . $idSeguimientoCompromiso . "'
					,'" . $this->session->userdata("id") . "'
					,'" . $descripcion . "'
					,GETDATE()
				)";

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$id = $this->db->insert_id();
			$this->db->trans_commit();
			$_POST["RASTREO"]['cambio'] = "Se registra Seguimiento Compromiso [Id: " . $id . "][Descripción: " . $descripcion ."] del compromiso " . $idSeguimientoCompromiso;
			RASTREO();
			return 1;
		}
	}

	function eliminarSeguimientoCompromiso(){
		$id = $this->input->post("id");

		$this->db->trans_begin();

		$sql = "DELETE FROM SeguimientoCompromiso WHERE SeguimientoCompromisoId = $id";

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function ActualizarActa(){
		$idActa = $this->input->post("idActa");
		$campo = $this->input->post("campo");
		$valor = $this->input->post("valor");

		$this->db->trans_begin();

		$sql = "UPDATE Acta SET $campo = '$valor' WHERE ActaId = $idActa";

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function actualizarPermisos(){
		$campo = $this->input->post('campo');
		$valor = $this->input->post('valor');
		$tipo = $this->input->post('tipo'); 
		$idActa = $this->input->post('idActa');

		$this->db->trans_begin();
		$sql = $this->db->query("SELECT TOP 1 * FROM ActaPermiso WHERE ActaId = '" . $idActa . "' AND UsuarioId = '" . $valor . "'")->result();

		if (count($sql) == 0) {
			try{
				$this->db->query("INSERT INTO ActaPermiso (ActaId, UsuarioId, Visualiza, Modifica, Anula) VALUES ('" . $idActa . "', '" . $valor . "', '0', '0', '0')");
			}catch (Exception $e){
				$this->db->trans_rollback();
				return 0;
			}		
		}

		$this->db->query("UPDATE ActaPermiso SET " . $campo ." = '" . $tipo . "' WHERE ActaId = '" . $idActa . "' AND UsuarioId = '" . $valor ."'");
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function actualizarAsistentes(){
		$valor = $this->input->post('valor');
		$tipo = $this->input->post('tipo'); 
		$idActa = $this->input->post('idActa');

		$this->db->trans_begin();
		
		if ($tipo == 1) {
			$sql = "INSERT INTO ActaAsistente(ActaId, UsuarioId, FechaRegis) VALUES ('" . $idActa . "', '" . $valor . "', GETDATE())";
		} else {
			$sql = "DELETE FROM ActaAsistente WHERE ActaId = '" . $idActa . "' AND UsuarioId = '" . $valor . "'";		
		}

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function eliminarAnexo(){
		$id = $this->input->post('id');
		$ruta = $this->db->query("SELECT Ruta FROM Anexo WHERE AnexoId = '$id'")->row()->Ruta;

		$this->db->trans_begin();

		$this->db->where('AnexoId',$id);
		$this->db->delete('Anexo');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			if (is_file("./" . $ruta)) {
				unlink("./" . $ruta);
			}
			RASTREO();
			return 1;
		}
	}

	function validarPermiso($id, $tipo){
		$usuario = $this->session->userdata('id');
		if ($tipo == 1) {
			$sql = "SELECT 
				A.ActaId
			FROM Acta A
				LEFT JOIN ActaPermiso AP ON A.ActaId = AP.ActaId AND AP.UsuarioId = '$usuario' AND AP.Visualiza = '1'
				LEFT JOIN ActaAsistente AA ON A.ActaId = AA.ActaId AND AA.UsuarioId = '$usuario'
			WHERE A.Estado = 'A'
				AND (AP.UsuarioId = '$usuario' OR AA.UsuarioId = '$usuario' OR UsrElaboraId = '$usuario')
				AND A.ActaId = '$id'";
		} else {
			$sql = "SELECT 
				A.ActaId
			FROM Acta A
				LEFT JOIN ActaPermiso AP ON A.ActaId = AP.ActaId AND AP.UsuarioId = '$usuario' AND AP.Modifica = '1'
			WHERE A.Estado = 'A'
				AND (AP.UsuarioId = '$usuario' OR UsrElaboraId = '$usuario')
				AND A.ActaId = '$id'";
		}

		$permiso = $this->db->query($sql)->result();

		return count($permiso);
	}

	// 20/01/2020 ASUP - Crea alerta para todos los usuarios
	function enviarAlertas($detalle, $numero) {
		$user = $this->session->userdata('id');
		$date = date("Y-m-d H:i:s");

		$update = "UPDATE Alerta SET Estado = 'C', Ejecutada = '$date' WHERE Tipo = 'AC' AND Numero = '$numero'";
		$this->db->query($update);		

		$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
		SELECT '$user', S.usuarioId, '$detalle', '$date', '$date', 'AC', '', '$numero'
		FROM Segur S 
			INNER JOIN PermisoSistema PS ON S.usuarioId = PS.UsuarioId OR S.perfilId = PS.PerfilId
		WHERE PS.Permiso = '6'";
		$this->db->query($sql);

		if ($this->db->trans_status() === FALSE) {
			return 0;
		} else {
			return 1;
		}
	}
}

?>