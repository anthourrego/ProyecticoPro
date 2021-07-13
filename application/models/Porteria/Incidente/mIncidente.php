<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mIncidente extends CI_Model {
	function qHistorico(){
		$sql = "SELECT 
			Fecha
			,B.FechaRegis
			,S.nombre AS Usuario
			,ZP.nombre AS Zona
			,B.Observacion
		FROM Bitacora B
			LEFT JOIN Segur S ON B.UsuarioId = S.usuarioId
			LEFT JOIN HeadZonaPlano ZP ON B.HeadZonaPlanoId = ZP.HeadZonaPlanoId
		WHERE B.Tipo = 'I'
		ORDER BY B.Fecha";

		return $this->db->query($sql)->result();
	}

	function guardarValores(){
		$data = $this->input->post('Data');

		$this->db->trans_begin();

		if ($data['HeadZonaPlanoId'] == '') {
			$data['HeadZonaPlanoId'] = null;
		}
		$data['FechaRegis'] = date("Y-m-d\TH:i:s");
		$data['UsuarioId'] 	= $this->session->userdata('id');

		$this->db->insert('Bitacora',$data);

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
		return $this->db->query("SELECT HeadZonaPlanoId AS id,nombre FROM HeadZonaPlano ORDER BY nombre")->result();
	}
}