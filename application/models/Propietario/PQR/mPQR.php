<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mPQR extends CI_Model {
    function listaTipoPQR(){
		$sql = "SELECT TipoPQRId, Nombre, ValidaPedido FROM TipoPQR";

		$listaTipoPQR = $this->db->query($sql)->result();

		return $listaTipoPQR;
    }
    
    function insertar($data){
		try{
			$this->db->insert('HeadPQR', $data);
			$pqrid = $this->db->insert_id();
		}catch (Exception $e){
			return 0;
		}
		$sql = "UPDATE Montaje SET ConsePQR = CASE WHEN ConsePQR IS NULL THEN 1 ELSE ConsePQR + 1 END";
		try{
			$this->db->query($sql);
		}catch (Exception $e){
			return 0;
		}
		$sql = "SELECT ConsePQR FROM Montaje";
		try{
			$PQR = $this->db->query($sql)->row()->ConsePQR;
		}catch (Exception $e){
			return 0;
		}
		$sql = "UPDATE HeadPQR SET PQR = ".$PQR." WHERE PQRId = '".$pqrid."'";
		try{
			$this->db->query($sql);
		}catch (Exception $e){
			return 0;
		}
		return array($pqrid, $PQR);
    }
    
    function PQRArchivo($tipo, $id) {
		$files = $_FILES;
		$cpt = count($_FILES['archivos']['name']);
		$subidas = array();
		if($files['archivos']['size'][0] > 0) {
			// Configuración upload
			$config = array();
			$config['upload_path']      = FCPATH.'uploads/'.$this->session->userdata('NIT').'/pqr/';
			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');
			// Subida de cada archivo

			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['archivos']['name']     = $files['archivos']['name'][$i];
				$_FILES['archivos']['type']     = $files['archivos']['type'][$i];
				$_FILES['archivos']['tmp_name'] = $files['archivos']['tmp_name'][$i];
				$_FILES['archivos']['error']    = $files['archivos']['error'][$i];
				$_FILES['archivos']['size']     = $files['archivos']['size'][$i];
				$config['file_name'] = 'PQR_'.$id.'_nota_';
				$this->upload->initialize($config);

				$archivo = array(
					'tipo'      => $tipo
					);
				if($tipo == 'PQR') {
					$archivo['PQRId'] = $id;
				} else {
					$archivo['DetalleId'] = $id;
				}
				// Inserta la PQR para conseguir su consecutivo
				$this->db->insert('PQRArchivo', $archivo);
				$insert_id = $this->db->insert_id();
				$nombre = 'PQR_'.$id.'_nota_'.$insert_id.'.'.pathinfo($_FILES['archivos']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $nombre;
				// Una vez tiene el consecutivo cambia el nombre con que se guardó
				$this->db->where('Id', $insert_id);
				$this->db->update('PQRArchivo', array('Archivo' => $nombre));
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
    
    function enviarAlertasPQR($detalle, $numero) {
		$user = $this->session->userdata('id');
		$date = date("Y-m-d H:i:s");

		$update = "UPDATE Alerta SET Estado = 'C', Ejecutada = '$date' WHERE Tipo = 'PQ' AND Numero = '$numero'";
		$this->db->query($update);		

		$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
		SELECT '$user', S.usuarioId, '$detalle', '$date', '$date', 'PQ', '', '$numero'
		FROM Segur S 
			INNER JOIN PermisoSistema PS ON S.usuarioId = PS.UsuarioId OR S.perfilId = PS.PerfilId
		WHERE PS.Permiso = '3'";
		$this->db->query($sql);

		if ($this->db->trans_status() === FALSE) {
			return 0;
		} else {
			return 1;
		}
    }
    
    function act($PQRId, $dato) {
		$this->db->where('PQRId', $PQRId);
		$this->db->update('HeadPQR', $dato);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			return 1;
		}
    }
    
    function ver(){
        $id = $this->input->post('id');

        $datos = array();

        $pqr = $this->db->query("SELECT
                                    HP.PQRId
                                    ,HP.Pqr
                                    ,EP.Nombre AS Estado
                                    ,TP.Nombre AS Clasificacion
                                    ,HP.Asunto
                                    ,HP.Descripcion
                                    ,HP.Fecha
                                    ,HP.FechaCierre
                                    ,S.nombre AS Usuario
									,HP.UsuarioId
                                FROM 
                                    HeadPQR HP
                                    LEFT JOIN Segur S ON HP.UsuarioId = S.usuarioId
                                    LEFT JOIN EstadoPQR EP ON HP.EstadoId = EP.EstadoId 
                                    LEFT JOIN TipoPQR TP ON HP.TipoPQRId = TP.TipoPQRId
                                WHERE
                                    HP.PQRId = '$id';
        ")->result();

        $sql = "SELECT
                    DP.*,
                    S.nombre,
                    S.DependenciaId,
                    D.Nombre AS Dependencia,
                    E.Nombre AS Estado,
                    REPLACE(DP.Detalle, CHAR(10) ,'<br>') DetalleP
                FROM
                    DetallePQR DP
                    LEFT JOIN Segur S ON DP.UsuarioId = S.usuarioId
                    LEFT JOIN Dependencia D ON S.DependenciaId = D.DependenciaId
                    LEFT JOIN EstadoPQR E ON DP.EstadoReporte = E.EstadoId
                WHERE
                    PQRId = '$id'";

        $data = $this->db->query($sql)->result();

        foreach ($data as $nota) {
            $sql = "SELECT Archivo FROM PQRArchivo WHERE Tipo = 'NPQR' AND DetalleId = '".$nota->id."'";
            $query = $this->db->query($sql);
            $adjuntos = $query->result();
            $nota->Adjuntos = null;
            if($query->num_rows() > 0){
                $nota->Adjuntos = $adjuntos;
            }
		}
		
		$sql1 = "UPDATE Alerta SET Estado = 'C', Ejecutada = GETDATE() WHERE Tipo = 'QR' AND Numero = '".$id."' AND AsignadoA = '" . $pqr[0]->UsuarioId . "'";
		$this->db->query($sql1);

        $datos['informacion'] = $pqr[0];
        $datos['notas'] = $data;

        return $datos;
    }
}