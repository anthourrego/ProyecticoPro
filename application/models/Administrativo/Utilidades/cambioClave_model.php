<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CambioClave_model extends CI_Model {

	function cambiarClave(){
		$actual = md5($this->input->post('actual'));
		$nueva = md5($this->input->post('nueva'));
		$confirme = md5($this->input->post('confirme'));
		if($confirme != $nueva){
			return 1;
		}else{
			if($actual == $nueva){
				return 2;
			}else{
				$consulta = $this->db->query("SELECT * FROM SEGUR WHERE usuarioId = '".$this->session->userdata('id')."' AND clave = '".$actual."'")->result();
				if( ! count($consulta) > 0){
					return 3;
				}else{
					$this->db->trans_begin();
					try{
						$this->db->query("UPDATE SEGUR SET clave = '".$nueva."' WHERE usuarioId = '".$this->session->userdata('id')."'");
					}catch(Exception $e){
						$this->db->trans_rollback();
						return 0;
					}
					RASTREO();
					if($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();
						return 0;
					}else{
						$this->db->trans_commit();
						return 4;
					}
				}
			}
		}
	}

}

?>