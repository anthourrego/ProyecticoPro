<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mProgramarInvitacion extends CI_Model {

	function guardarDatos(){
		$data 	= $this->input->post('Data');
		$cc 	= $this->session->userdata('CEDULA');

		$verifica = $this->db->query("SELECT terceroID FROM Tercero WHERE terceroID = ?",array($cc))->result();

		if (count($verifica) > 0) {
			$data['terceroID'] 	= $cc;
			$data['FechaRegis'] = date("Y-m-d\TH:i:s");
			if ($data['TipoVehiculoId'] == '') {
				$data['TipoVehiculoId'] = null;
			}
			if ($data['Placa'] == '') {
				$data['Placa'] = null;
			}

			$this->db->trans_begin();

			$this->db->insert('ProgIngreso',$data);

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

	function eliminarInvitacion(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('IngresoId',$id);
		$this->db->delete('Ingreso');

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

	function obtenerDataCedula(){
		$cedula = $this->input->post('Num');

		$data1 = $this->db->query("SELECT * FROM ProgIngreso WHERE cedula = ? AND Tipo = 'P' AND Estado = 'A'",array($cedula))->result();
		$data2 = $this->db->query("SELECT * FROM ProgIngreso WHERE cedula = ? AND Tipo = 'A' AND Estado = 'A'",array($cedula))->result();

		if (count($data1) > 0) {
			return 1;
		}else{
			if (count($data2) > 0) {
				return 2;
			}else{
				return 0;
			}
		}
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