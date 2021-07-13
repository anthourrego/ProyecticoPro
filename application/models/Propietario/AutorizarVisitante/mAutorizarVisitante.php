<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mAutorizarVisitante extends CI_Model {

	// function guardarDatos(){
	// 	$data 	= $this->input->post('Data');

	// 	if ($data['TerceroID'] != '') {
	// 		if ($data['TipoVehiculoId'] == '')
	// 			$data['TipoVehiculoId'] = null;
	// 		if ($data['Placa'] == '')
	// 			$data['Placa'] = null;
	// 		if ($data['Observacion'] == '')
	// 			$data['Observacion'] = null;


	// 		$this->db->trans_begin();

	// 		if ($data['Id'] != '') {
	// 			$id = $data['Id'];
	// 			unset($data['Id']);
	// 			$this->db->where('ProgIngresoId',$id);
	// 			$this->db->update('ProgIngreso',$data);
	// 		}else{
	// 			$data['FechaRegis'] = date("Y-m-d\TH:i:s");
	// 			$this->db->insert('ProgIngreso',$data);
	// 		}

	// 		if ($this->db->trans_status() === FALSE) {
	// 			$this->db->trans_rollback();
	// 			return 0;
	// 		}else{
	// 			$this->db->trans_commit();
	// 			RASTREO();
	// 			return 1; 
	// 		}
	// 	}else{
	// 		return 2;
	// 	}
	// }

	function guardarDatos(){
		$files 		= $_FILES;
		$cpt 		= count($_FILES);
		$subidas 	= array();
		$TIPO 		= '';
		$GID 		= $this->input->post('GID');
		$DATAG 		= array(
			'TipoVehiculoId' 	=> $this->input->post('TipoVehiculoId') != 'null' ?  $this->input->post('TipoVehiculoId') : null,
			'Placa' 			=> $this->input->post('Placa') != 'null' ?  $this->input->post('Placa') : null,
			'Cedula' 			=> $this->input->post('Cedula'),
			'Nombre' 			=> $this->input->post('Nombre'),
			'Observacion' 		=> $this->input->post('Observacion') != 'null' ?  $this->input->post('Observacion') : null,
			'Tipo' 				=> $this->input->post('Tipo'),
			'Estado' 			=> $this->input->post('Estado'),
			'ViviendaId' 		=> $this->input->post('ViviendaId'),
			'TerceroID' 		=> $this->input->post('TerceroID'),
			'FechaRegis' 		=> date("Y-m-d\TH:i:s")
		);
		$TID = $DATAG['TerceroID'];

		$RASTREO['usuarioid'] 	= $this->session->userdata('id');
		$RASTREO['equipo'] 		= $_SERVER['REMOTE_ADDR'];
		$RASTREO['fecha']		= date("Y-m-d\TH:i:s");
		$RASTREO['programa']	= "Autorizar visitantes";
		$RASTREO['cambio'] 		= ($GID != '' ? 'Actualiza autorización' : 'Crea autorización').' [Tipo : Autorización] [Cedula : '.$DATAG['Cedula'].'] [Nombre : '.$DATAG['Nombre'].'] [Placa : '.($DATAG['Placa'] != null ? $DATAG['Placa'] : '').']';

		if ($cpt > 0) {
			if(preg_match('/á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['file']['name'])===1){
				return 0;
			}
		}

		if($cpt > 0 && $files['file']['size'] > 0){
			$config = array();
			$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/Propietario/AutorizaIngreso/';
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
			$config['file_name'] = 'Autoriza_ID_'.$TID.'_Cedula_'.$DATAG['Cedula'].'_'.$nombreDoc;
			$this->upload->initialize($config);


			$DATAG['Foto'] = './uploads/'.$this->session->userdata('NIT').'/Propietario/AutorizaIngreso/Autoriza_ID_'.$TID.'_Cedula_'.$DATAG['Cedula'].'_'.$nombreDoc;

			if ($GID == '') {
				$this->db->insert('ProgIngreso',$DATAG);
				$GID  = $this->db->insert_id();
				$TIPO = 'CREA';
			}else{
				$anx = $this->db->query("SELECT Foto FROM ProgIngreso WHERE ProgIngresoId = ?",array($GID))->result();
				if (is_file($anx[0]->Foto)) {
					unlink($anx[0]->Foto);
				}
				$this->db->where('ProgIngresoId',$GID);
				$this->db->update('ProgIngreso', $DATAG);
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

			$this->db->where('ProgIngresoId',$GID);
			$this->db->update('ProgIngreso', $DATAG);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 0;
			}else{
				$this->db->trans_commit();
				$this->db->query("SET DATEFORMAT YDM;
					INSERT INTO
						rastreo (fecha, programa, cambio, usuarioid, equipo, fechaservidor, Aplicacion)
					VALUES ('".$RASTREO['fecha']."', '".$RASTREO['programa']."', '".$RASTREO['cambio']."', '".$RASTREO['usuarioid']."', '".$RASTREO['equipo']."', GETDATE(), 'Residente')"
				);
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
			$this->db->query("SET DATEFORMAT YDM;
				INSERT INTO
					rastreo (fecha, programa, cambio, usuarioid, equipo, fechaservidor, Aplicacion)
				VALUES ('".$RASTREO['fecha']."', '".$RASTREO['programa']."', '".$RASTREO['cambio']."', '".$RASTREO['usuarioid']."', '".$RASTREO['equipo']."', GETDATE(), 'Residente')"
			);
			return array(
				'Tipo' 	=> $TIPO,
				'ID' 	=> $GID
			);
		}
	}

	function eliminarAutorizacion(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('ProgIngresoId',$id);
		$this->db->update('ProgIngreso',array('Estado'=>'I'));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function validarVivienda(){
		return $this->db->query("SELECT ViviendaId FROM ViviendaTercero WHERE terceroID = ? AND Residente = 1",array($this->session->userdata('CEDULA')))->result();
	}

	function obtenerTipoVehiculo(){
		return $this->db->query("SELECT TipoVehiculoId AS id, nombre FROM TipoVehiculo WHERE Estado = 'A'")->result();
	}

	function verificaPlaca(){
		$placa = $this->input->post('Placa');

		$sql = $this->db->query("SELECT TerceroVehiculoId FROM TerceroVehiculo WHERE Placa = ?",array($placa))->result();

		if (count($sql) > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	function obtenerDataCedula(){
		$cedula = $this->input->post('Num');

		$data1 = $this->db->query("SELECT * FROM ProgIngreso WHERE cedula = ? AND Tipo = 'A' AND Estado = 'A'",array($cedula))->result();
		$data2 = $this->db->query("SELECT TOP 1 Nombre FROM ProgIngreso WHERE cedula = ?",array($cedula))->result();

		if (count($data1) > 0) {
			return array(
				'nombre' => $data1[0]->Nombre,
				'data'	 => $data1
			);
		}else{
			if (count($data2) > 0) {
				return array(
					'nombre' => $data2[0]->Nombre,
					'data'	 => []
				);
			}else{
				return array(
					'nombre' => '',
					'data'	 => []
				);
			}
		}
	}
}