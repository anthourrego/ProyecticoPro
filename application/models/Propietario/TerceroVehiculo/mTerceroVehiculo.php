<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mTerceroVehiculo extends CI_Model {

	function guardarDatos(){
		$data 	= $this->input->post('Data');

		if ($data['TerceroID'] != '') {
			if ($data['Placa'] == '')
				$data['Placa'] = null;
			if ($data['Marca'] == '')
				$data['Marca'] = null;
			if ($data['Modelo'] == '')
				$data['Modelo'] = null;
			if ($data['Color'] == '')
				$data['Color'] = null;
			if ($data['Cilindraje'] == '')
				$data['Cilindraje'] = null;

			$this->db->trans_begin();

			$this->db->insert('TerceroVehiculo',$data);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 0;
			}else{
				$this->db->trans_commit();
				RASTREO();
				return 1; 
			}
		}else{
			return 2;
		}
	}

	function eliminarVehiculo(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('TerceroVehiculoId',$id);
		$this->db->delete('TerceroVehiculo');

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
}