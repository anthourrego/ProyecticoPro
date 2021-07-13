<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mInventario extends CI_Model {
	
	function selectEquipo(){
		$sql = "SELECT * FROM Equipo
		WHERE Estado = 'A' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectProveedor(){
		$sql = "SELECT TerceroID,Nombre FROM Tercero 
		WHERE Estado = 'A' and EsProveedor = '1' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}


	function selectPais(){
		$sql = "SELECT * FROM Pais 
		ORDER BY nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}



	function selectDependencia(){
		$sql = "SELECT dependenciaId, Nombre FROM Dependencia
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function GuardarIt(){
		$valor        = $this->input->post('valor');
		$ItemEquipoId = $this->input->post('ItemEquipoId');

		$this->db->trans_begin();

		if(empty($ItemEquipoId)){
			$this->db->insert('Itemequipo', $valor);
		}else{
			$this->db->where('ItemEquipoId',$ItemEquipoId);
			$this->db->update('ItemEquipo',$valor);
		}

		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 2;
		}
	}

	public function eliminarA(){
		$id = $this->input->post('id');

		$this->db->trans_begin();

		$this->db->where('ItemequipoId', $id);
		$this->db->delete('Itemequipo');


		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	public function obtenerInventario(){
		$id = $this->input->post('id');

		$sql 		= "SELECT * FROM Itemequipo WHERE ItemequipoId = ?";
		$consulta 	= $this->db->query($sql,array($id))->result();
		return $consulta;
	}

	public function validarSerial(){
		$ItemEquipoId = $this->input->post('ItemEquipoId');
		$EquipoId     = $this->input->post('EquipoId');
		$Serial       = $this->input->post('Serial');

		if(empty($ItemEquipoId)){
			$sql = "SELECT * FROM Itemequipo WHERE EquipoId = $EquipoId  and Serial = '$Serial'";
		}else{
			$sql = "SELECT * FROM Itemequipo WHERE ItemequipoId <> $ItemEquipoId and EquipoId = $EquipoId  and Serial = '$Serial'";
		}

		$consulta  = $this->db->query($sql)->result();

		if(empty($consulta)){
			return 0;
		}else{
			return 1;
		}
	}
}

?>