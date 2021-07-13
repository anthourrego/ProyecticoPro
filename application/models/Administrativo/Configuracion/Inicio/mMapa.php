<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mMapa extends CI_Model {

	function obtenerVivienda(){
		$id =  $this->input->post('Id');

		$sql = "SELECT 
			ViviendaId AS id
			,Nomenclatura AS codigo
		FROM Vivienda
		WHERE TipoViviendaId = ?";

		return $this->db->query($sql,array($id))->result();
	}

	function obtenerDataVivienda(){
		$id  = $this->input->post('Id');
		$obt = $this->input->post('Obt');

		if (count($this->db->query("SELECT ZonaplanoId FROM ZonaPlano WHERE ViviendaId = ?",array($id))->result()) > 0 && $obt == 0) {
			return 1;
		}

		$sql =  "SELECT 
			Nomenclatura
			,Citofono
			,Terreno
			,Construido
			,Pisos
			,VidaUtil
			,NumHabitacion	
			,NumBano
			,NumVentana
			,Matricula
			,CedulaCatastral
			,Valor
			,Estado 
		FROM Vivienda
		WHERE ViviendaId = ?";

		return $this->db->query($sql,array($id))->result();
	}

	function guardarZona(){
		$nombre = $this->input->post('Nombre');

		$this->db->trans_begin();

		$this->db->insert('HeadZonaPlano',array('Nombre'=>$nombre,'FechaRegis'=>date("Y-m-d\TH:i:s")));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function obtenerZonas(){
		return $this->db->query("SELECT HeadZonaPlanoId As id, nombre FROM HeadZonaPlano ORDER BY Nombre ASC")->result();
	}

	function actualizarImagen(){
		$files 		= $_FILES;
		$cpt 		= count($_FILES);
		$subidas 	= array();
		$ZonaId 	= $this->input->post('Id');

		if ($cpt > 0) {
			if(preg_match('/á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['file']['name'])===1){
				return 0;
			}
		}

		if($files['file']['size'] > 0){
			$config = array();
			$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/Adminsitrativo/Plano/';
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
			$config['file_name'] = 'Plano_ID_'.$ZonaId.'_'.$nombreDoc;
			$this->upload->initialize($config);

			$anx = $this->db->query("SELECT Imagen FROM HeadZonaPlano WHERE HeadZonaPlanoId = ?",array($ZonaId))->result();
			if (is_file($anx[0]->Imagen)) {
				unlink($anx[0]->Imagen);
			}

			$archivo = array(
				'Imagen'	=> './uploads/'.$this->session->userdata('NIT').'/Adminsitrativo/Plano/Plano_ID_'.$ZonaId.'_'.$nombreDoc,
				);
			$this->db->where('HeadZonaPlanoId',$ZonaId);
			$this->db->update('HeadZonaPlano', $archivo);

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
			return 2;
		}

		$exepcion = 0;
		for ($i=0; $i < count($subidas); $i++) { 
			if ($subidas[$i] == 0) {
				$exepcion = 1;
				break;
			}
		}

		if ($exepcion == 1) {
			return 0;
		}else{
			return 1;
		}
	}

	function guardarPosicionMapa(){
		$id 	= $this->input->Post("Id");
		$id2 	= $this->input->Post("Id2");
		$pos 	= $this->input->Post("Pos");

		$this->db->trans_begin();

		$this->db->where('HeadZonaPlanoId',$id2)
				 ->where('Posicion',$pos);
		$this->db->delete('ZonaPlano');

		$this->db->insert('ZonaPlano',array(
				"HeadZonaPlanoId"	=> $id2,
				"ViviendaId" 		=> $id,
				"Posicion" 			=> $pos
			)
		);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function obtenerDataZona(){
		$id = $this->input->post('Id');

		$sql  = "SELECT * FROM HeadZonaPlano WHERE HeadZonaPlanoId = ? ORDER BY Nombre ASC";
		$sql2 = "SELECT 
			ZP.*
			,V.Nomenclatura 
		FROM ZonaPlano ZP
			LEFT JOIN Vivienda V ON ZP.ViviendaId = V.ViviendaId
		WHERE HeadZonaPlanoId = ?
		ORDER BY V.Nomenclatura";

		$arr = array(
			'Head' => $this->db->query($sql,array($id))->result(),
			'Zona' => $this->db->query($sql2,array($id))->result()
		);

		return $arr;
	}

	function guardarConfiguracion(){
		$tipo 	= $this->input->post('Tipo');
		$valor 	= $this->input->post('Valor');
		$id 	= $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('HeadZonaPlanoId',$id);
		$this->db->update('HeadZonaPlano',array(
				$tipo => $valor	
			)
		);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function obtenerDataSeleccion(){
		$id  = $this->input->post('Id'); 
		$pos = $this->input->post('Pos'); 

		$sql = "SELECT 
			V.Nomenclatura 
			,V.TipoViviendaId
			,V.ViviendaId
		FROM ZonaPlano ZP
			LEFT JOIN Vivienda V ON ZP.ViviendaId = V.ViviendaId
		WHERE HeadZonaPlanoId = ? AND Posicion = ?";

		return $this->db->query($sql,array($id,$pos))->result();
	}

	function eliminarZona(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$anx = $this->db->query("SELECT Imagen FROM HeadZonaPlano WHERE HeadZonaPlanoId = ?",array($id))->result();
		if (is_file($anx[0]->Imagen)) {
			unlink($anx[0]->Imagen);
		}

		$this->db->where('HeadZonaPlanoId',$id);
		$this->db->delete('HeadZonaPlano');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function eliminarVivienda(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('ZonaplanoId',$id);
		$this->db->delete('ZonaPlano');

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