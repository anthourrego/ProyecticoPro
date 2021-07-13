<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mServicio extends CI_Model {
	function obtenerTipoServicio(){
		return $this->db->query("SELECT TipoServicioId As id, nombre FROM TipoServicio WHERE Estado = 'A'")->result();
	}

	function obtenerVivienda(){
		$sql = "SELECT 
			ViviendaId AS id
			,CONCAT(TV.Nombre,' | ',V.Nomenclatura) AS nombre 
			,CASE WHEN V.Citofono IS NULL THEN '-' ELSE V.Citofono END AS Citofono
		FROM Vivienda V
			LEFT JOIN TipoVivienda TV ON V.TipoViviendaId = TV.TipoViviendaId
		WHERE V.Estado = 'A'
		ORDER BY TV.Nombre";

		return $this->db->query($sql)->result();
	}

	function obtenerZonas(){
		return $this->db->query("SELECT HeadZonaPlanoId As id, nombre FROM HeadZonaPlano ORDER BY nombre")->result();
	}

	function obtenerDataZona(){
		$id = $this->input->post('Id');

		$sql  = "SELECT * FROM HeadZonaPlano WHERE HeadZonaPlanoId = ?";
		$sql2 = "SELECT 
			ZP.*
			,V.Nomenclatura 
			,V.Citofono
			,CONCAT(TV.Nombre,' | ',V.Nomenclatura) AS nombre
		FROM ZonaPlano ZP
			LEFT JOIN Vivienda V ON ZP.ViviendaId = V.ViviendaId
			LEFT JOIN TipoVivienda TV ON V.TipoViviendaId =TV.TipoViviendaId
		WHERE HeadZonaPlanoId = ?";

		$arr = array(
			'Head' => $this->db->query($sql,array($id))->result(),
			'Zona' => $this->db->query($sql2,array($id))->result()
		);

		return $arr;
	}

	function qHistorico(){
		$sql = "SELECT 
			'' AS Acciones
			,B.BitacoraId AS Id
			,CASE B.Estado  WHEN 'A' THEN 'Pendiente' ELSE 'Entregado' END AS Estado
			,S.nombre AS Usuario
			,CONCAT(TV.Nombre,' | ',V.Nomenclatura) AS Vivienda
			,TS.Nombre AS NomSer
			,B.Observacion
			,B.FechaRegis
		FROM Bitacora B
			LEFT JOIN Segur S ON B.UsuarioId = S.usuarioId
			LEFT JOIN Vivienda V ON B.ViviendaId = V.ViviendaId
			LEFT JOIN TipoVivienda TV ON V.TipoViviendaId = TV.TipoViviendaId
			LEFT JOIN TipoServicio TS ON B.TipoServicioId = TS.TipoServicioId
		WHERE B.Tipo = 'S'
		ORDER BY B.Estado,V.Nomenclatura";

		return $this->db->query($sql)->result();
	}

	function guardarServicio(){
		$data = $this->input->post('Data');

		$this->db->trans_begin();

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

	function actualizarServicio(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('BitacoraId',$id);
		$this->db->update('Bitacora',array('Estado'=>'F'));

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