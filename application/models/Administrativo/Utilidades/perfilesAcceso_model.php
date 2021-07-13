<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilesAcceso_model extends CI_Model {

	function cargarPerfilesAcceso($valor, $key, $tabla) {
		$this->db->select('nombre')
				 ->where($key, $valor);
		$consulta = $this->db->get($tabla);
		return $consulta->result();
	}

	function permisos($id, $campo){
		$this->db->select("Permiso");
		$this->db->where($campo, $id);
		$this->db->where('Aplicativo', 'RESIDENTE');
		$permisos = $this->db->get('PermisoSistema');
		//Arreglo que lleno con las opciones
		$array = array();
		foreach($permisos->result() as $row){
	        $array[] = $row->Permiso;
	    }
		return $array;
	}

	function permisosTERC($id, $login, $campo){
		$this->db->select('campo')
				 ->where($login, $id)
				 ->where($campo, 1);
		$permisos = $this->db->get('PerfilObjetos');
		//Arreglo que lleno con las opciones
		$array = array();
		foreach($permisos->result() as $row){
			$array[] = $row->campo;
	    }
		return $array;
	}

	function guardarPerfilAcceso(){
		$SEGUR = json_decode($this->input->post('SEGUR'));
		$TERCCrear = json_decode($this->input->post('TERCCrear'));
		$TERCModif = json_decode($this->input->post('TERCModif'));
		$TERCElimi = json_decode($this->input->post('TERCElimi'));
		$id = $this->input->post('id');
		$perfil = $this->input->post('perfil');

		if($perfil != null){
			$usuarioId = null;
			$perfilId = $id;
			$campo = 'perfilId';
		}else{
			$usuarioId = $id;
			$perfilId = null;
			$campo = 'usuarioId';
		}

		$PerfilObjetos = array(
			['campo' => '0', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '60', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '71', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '86', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '1', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '2', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '92', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '3', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '90', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '4', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '5', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '6', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '7', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '8', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '9', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '80', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '10', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '11', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '12', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '13', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '14', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '15', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '16', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '17', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '18', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '19', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '20', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '21', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '22', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '43', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '49', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '34', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '35', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '36', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '37', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '40', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '41', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '85', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '39', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '88', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '89', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '23', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '24', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '25', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '26', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '27', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '28', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '29', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '30', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '31', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '32', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '33', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '52', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '53', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '51', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '87', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '47', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '46', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '44', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '81', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '82', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '83', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '84', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '54', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '45', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '50', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '55', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '56', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '61', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '62', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '63', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '64', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '65', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '66', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '67', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '68', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '69', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '70', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '91', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '72', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '73', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '74', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '75', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '76', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '77', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '78', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '79', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
			,['campo' => '95', 'perfilId' => $perfilId, 'usuarioId' => $usuarioId, 'crear' => 0, 'modificar' => 0, 'eliminar' => 0]
		);

		foreach ($PerfilObjetos as $key => $value) {
			if(in_array($PerfilObjetos[$key]['campo'], $TERCCrear)){
				$PerfilObjetos[$key]['crear'] = 1;
			}
			if(in_array($PerfilObjetos[$key]['campo'], $TERCModif)){
				$PerfilObjetos[$key]['modificar'] = 1;	
			}
			if(in_array($PerfilObjetos[$key]['campo'], $TERCElimi)){
				$PerfilObjetos[$key]['eliminar'] = 1;
			}
		}

		$Permisos = array();

		if(count($SEGUR) > 0){
			foreach ($SEGUR as $key => $value) {
				$Permisos[] = array(
					$campo => $id
					,'Permiso' => $value
					,'Aplicativo' => 'RESIDENTE'
				);
			}
		}

		$this->db->trans_begin();

		$this->db->where('Aplicativo', 'RESIDENTE');
		if($perfil != null){
			$this->db->where('perfilId', $perfilId)
				->delete('PermisoSistema');

			if(count($SEGUR) > 0){
				$this->db->insert_batch('PermisoSistema', $Permisos);
			}
		}else{
			$this->db->where('usuarioId', $usuarioId)
				->delete('PermisoSistema');

			if(count($SEGUR) > 0){
				$this->db->insert_batch('PermisoSistema', $Permisos);
			}
		}

		$this->db->where('usuarioId', $usuarioId)
				->where('perfilId', $perfilId)
				->delete('PerfilObjetos');

		$this->db->insert_batch('PerfilObjetos', $PerfilObjetos);

		$this->db->where('usuarioId', $usuarioId)
				->where('perfilId', $perfilId)
				->where('crear', 0)
				->where('modificar', 0)
				->where('eliminar', 0)
				->delete('PerfilObjetos');

		if ($this->db->trans_status() == true) {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		} else {
			$this->db->trans_rollback();
			return 0;
		}
	}

}

?>