<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mMascota extends CI_Model {
	function obtenerMascota(){
		return $this->db->query("SELECT TipoMascotaId AS id,nombre FROM TipoMascota WHERE Estado = 'A'")->result();
	}

	function actualizarImagen(){
		$files 		= $_FILES;
		$cpt 		= count($_FILES);
		$subidas 	= array();
		$TIPO 		= '';
		$GID 		= $this->input->post('GID');
		$DATAG 		= array(
			'TipoMascotaId' => $this->input->post('TipoMascotaId'),
			'TerceroID' 	=> $this->input->post('TerceroID'),
			'ViviendaId' 	=> $this->input->post('ViviendaId'),
			'Nombre' 		=> $this->input->post('Nombre'),
			'Raza' 			=> $this->input->post('Raza') != '' ?  $this->input->post('Raza') : null,
			'Sexo' 			=> $this->input->post('Sexo'),
			'Tamano' 		=> $this->input->post('Tamano') != '' ? $this->input->post('Tamano') :null,
			'FechaNac' 		=> $this->input->post('FechaNac'),
			'Observacion' 	=> $this->input->post('Observacion') != '' ? $this->input->post('Observacion') : null,
			'FechaRegis' 	=> date("Y-m-d\TH:i:s")
		);
		$TID = $DATAG['TerceroID'];

		//var_dump($_FILES);
		if ($cpt > 0) {
			if(preg_match('/á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['file']['name'])===1){
				return 0;
			}
		}

		if($cpt > 0 && $files['file']['size'] > 0){
			$config = array();
			$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/Propietario/Mascota/';
			$config['allowed_types']    = 'gif|jpg|png|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;

			$this->load->library('upload');
			$this->load->library('image_lib');

			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}
			$_FILES['file']['name']     = $files['file']['name'];
			$_FILES['file']['type']     = $files['file']['type'];
			$_FILES['file']['tmp_name'] = $files['file']['tmp_name'];
			$_FILES['file']['error']    = $files['file']['error'];
			$_FILES['file']['size']     = $files['file']['size'];

			if (strpos($files['file']['name'], " ") !== false) {
				$nombreDoc = str_replace(' ','_',$files['file']['name']); 
			}else{
				$nombreDoc = $files['file']['name'];
			}
			$config['file_name'] = 'Mascota_ID_'.$TID.'_'.$nombreDoc;
			$this->upload->initialize($config);


			$DATAG['Foto'] = './uploads/'.$this->session->userdata('NIT').'/Propietario/Mascota/Mascota_ID_'.$TID.'_'.$nombreDoc;

			if ($GID == 'null') {
				$this->db->insert('TerceroMascota',$DATAG);
				$GID  = $this->db->insert_id();
				$TIPO = 'CREA';
			}else{
				$anx = $this->db->query("SELECT Foto FROM TerceroMascota WHERE TerceroMascotaId = ?",array($GID))->result();
				if (is_file($anx[0]->Foto)) {
					unlink($anx[0]->Foto);
				}
				$this->db->where('TerceroMascotaId',$GID);
				$this->db->update('TerceroMascota', $DATAG);
				$TIPO = 'ACTUALIZA';
			}

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$subida 			= array();
				$subida['nombre'] 	= $_FILES['file']['name'];
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$this->db->trans_commit();
					$data = $this->upload->data();
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
				$subidas[] = $subida['estado'];
			}
		}else{
			$this->db->trans_begin();

			unset($DATAG['FechaRegis']);
			$TIPO = 'ACTUALIZA';

			$this->db->where('TerceroMascotaId',$GID);
			$this->db->update('TerceroMascota', $DATAG);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 0;
			}else{
				$this->db->trans_commit();
				return array(
					'Tipo' 	=> $TIPO,
					'ID' 	=> $GID
				);
			}
		}

		$exepcion = 0;
		for ($i=0; $i < count($subidas); $i++) { 
			if ($subidas[$i] == 0) {
				$exepcion = 1;
				break;
			}
		}

		if ($exepcion == 1) {
			return array(
				'Tipo' => 'ERROR'
			);
		}else{
			return array(
				'Tipo' 	=> $TIPO,
				'ID' 	=> $GID
			);
		}
	}

	function obtenerMascotaTercero(){
		$id  	= $this->input->post('Id');
		$id2 	= $this->input->post('Id2');
		$tipo 	= $this->input->post('Tipo');

		$sql = "SELECT
			TM.TerceroMascotaId As id
			,TM.nombre
			,TM.TipoMascotaId
			,TM.Raza	
			,CASE Sexo WHEN 'F' THEN 'Hembra' ELSE 'Macho' END AS Sexo
			,TM.Tamano
			,TM.FechaNac
			,TM.Observacion
			,TM.Foto
			,Vacuna = STUFF((
				SELECT CONCAT('[ ',VT.Vacuna,' / ',VT.Fecha,' ]')
				FROM VacunaTerceroMascota VT
				WHERE VT.TerceroMascotaId = TM.TerceroMascotaId FOR XML PATH('span')),1, 0, '')
		FROM TerceroMascota TM ";
		
		
		if ($tipo == 'Id') {
			$sql .= "WHERE TM.TerceroMascotaId = ?";
			return $this->db->query($sql,array($id))->result();
		}else{
			$sql .= "WHERE TerceroID = ? AND ViviendaId = ?";
			return $this->db->query($sql,array($id,$id2))->result();
		}

	}

	function validarVivienda(){
		return $this->db->query("SELECT ViviendaId FROM ViviendaTercero WHERE terceroID = ? AND Residente = 1",array($this->session->userdata('CEDULA')))->result();
	}

	function qHistorico(){
		$id = $this->input->post('Id');

		$sql = "SELECT 
			'' AS Acciones
			,VacunaTerceroMascotaId AS Id
			,Vacuna
			,Fecha
		FROM VacunaTerceroMascota
		WHERE TerceroMascotaId = ?";

		return $this->db->query($sql,array($id))->result();
	}

	function guardarVacuna(){
		$data = $this->input->post('Data');

		$this->db->trans_begin();

		$this->db->insert('VacunaTerceroMascota',$data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function eliminarMascota(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('TerceroMascotaId',$id);
		$this->db->delete('VacunaTerceroMascota');

		$this->db->where('TerceroMascotaId',$id);
		$this->db->delete('TerceroMascota');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

}