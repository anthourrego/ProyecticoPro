<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mSalida extends CI_Model {

	function verificaTerceroSalida(){
		$placa 	= $this->input->post('Placa');
		$cedula = $this->input->post('Cedula');
		$arr 	= array();
		$valida	= 0;

		$sqlR = "SELECT 
			ViviendaTerceroId
			,VT.TerceroID
			,T.Nombre
			,'Residente' AS tipo
		FROM ViviendaTercero VT
			LEFT JOIN Tercero T ON VT.TerceroID = T.TerceroID
		WHERE VT.TerceroID = ? AND Residente = 1";

		$sqlR2 = "SELECT 
			TV.TerceroVehiculoId
			,TV.TerceroID
			,T.Nombre
			,TVI.Nombre AS nomVehi
			,TV.Placa
			,'Residente' AS tipo 
		FROM TerceroVehiculo TV
			LEFT JOIN Tercero T ON TV.TerceroID = T.TerceroID
			LEFT JOIN TipoVehiculo TVI ON TV.TipoVehiculoId = TVI.TipoVehiculoId
		WHERE TV.Placa = ?";

		$sql1 = $this->db->query($sqlR,array($cedula))->result();
		if (count($sql1) > 0){
			$arr['Tipo'] = 'Residente';
			$arr['data'] = $sql1;
			$valida = 1;
		}
		$sql2 = $this->db->query($sqlR2,array($placa))->result();
		if (count($sql2) > 0){
			$arr['Tipo'] = 'PlacaResidente';
			$arr['data'] = $sql2;
			$valida = 1;
		}

		if ($valida == 1) {
			return $arr;
		}

		if ($this->verificaSalidaVisitaAut($cedula,$placa) == 1) {
			return 0;
		}
		

		$sqlV = "SELECT 
			PIN.ProgIngresoId
			,PIN.Cedula AS TerceroID
			,PIN.Nombre
			,TV.Nombre AS nomVehi
			,PIN.Placa
			,'Visitante' AS tipo
			,PIN.Tipo AS tipoV
		FROM ProgIngreso PIN
			LEFT JOIN Ingreso I ON PIN.ProgIngresoId = I.ProgIngresoId AND I.Estado = 'I'
			LEFT JOIN TipoVehiculo TV ON PIN.TipoVehiculoId = TV.TipoVehiculoId
		WHERE PIN.Tipo IN('A','P','I') AND PIN.Estado = 'A' AND I.Estado = 'I' AND PIN.Cedula = ?";

		$sqlP = "SELECT 
			PIN.ProgIngresoId
			,PIN.Cedula AS TerceroID
			,PIN.Nombre
			,TV.Nombre AS nomVehi
			,PIN.Placa
			,'Visitante' AS tipo
			,PIN.Tipo AS tipoV
		FROM ProgIngreso PIN
			LEFT JOIN Ingreso I ON PIN.ProgIngresoId = I.ProgIngresoId AND I.Estado = 'I'
			LEFT JOIN TipoVehiculo TV ON PIN.TipoVehiculoId = TV.TipoVehiculoId
		WHERE PIN.Tipo IN('A','P','I') AND PIN.Estado = 'A' AND I.Estado = 'I' AND PIN.Placa = ?";

		$sql3 = $this->db->query($sqlV,array($cedula))->result();
		if (count($sql3) > 0){
			$arr['Tipo'] = 'VisitaResidente';
			$arr['data'] = $sql3;
			$valida = 1;
		}
		$sql4 = $this->db->query($sqlP,array($placa))->result();
		if (count($sql4) > 0){
			$arr['Tipo'] = 'PlacaVisita';
			$arr['data'] = $sql4;
			$valida = 1;
		}

		if ($valida == 1) {
			return $arr;
		}else{
			return 0;
		}
	}

	function registrarSalida(){
		$id  = $this->input->post('Id');
		$id2 = $this->input->post('Id2');
		$id3 = $this->input->post('Id3');
		$tip = $this->input->post('Tipo');
		$this->db->trans_begin();

		if ($id != '') {
			$this->db->insert('Ingreso',array(
					'Fecha' 		=> date("Y-m-d\TH:i:s"),
					'Estado' 		=> 'S',
					'ProgIngresoId' => $id,
				)
			);
			if ($tip == 'P' || $tip == 'I') {
				$this->db->where('ProgIngresoId',$id);
				$this->db->update('ProgIngreso',array('Estado'=>'F'));
			}
		}
		if ($id2 != '') {
			$this->db->insert('Ingreso',array(
					'Fecha' 			=> date("Y-m-d\TH:i:s"),
					'Estado' 			=> 'S',
					'TerceroVehiculoId' => $id2,
				)
			);
		}
		if ($id3 != '') {
			$this->db->insert('Ingreso',array(
					'Fecha' 			=> date("Y-m-d\TH:i:s"),
					'Estado' 			=> 'S',
					'ViviendaTerceroId' => $id3,
				)
			);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1; 
		}
	}

	function verificaSalidaVisitaAut($cc,$placa){
		$sql = "SELECT 
			COUNT(*) AS Cont 
			,CASE WHEN Max('Ingreso') IS NULL THEN 'NE' ELSE Max('Ingreso') END AS Tipo
		FROM ProgIngreso P
			INNER JOIN Ingreso I ON P.ProgIngresoId = I.ProgIngresoId
		WHERE (P.Placa = '$placa' OR P.Cedula = '$cc') AND I.Estado = 'I' AND P.Estado NOT IN('F','I')
		UNION
		SELECT 
			COUNT(*) AS Cont
			,CASE WHEN Max('Salida') IS NULL THEN 'NE' ELSE Max('Salida') END AS Tipo
		FROM ProgIngreso P
			INNER JOIN Ingreso I ON P.ProgIngresoId = I.ProgIngresoId
		WHERE (P.Placa = '$placa' OR P.Cedula = '$cc') AND I.Estado = 'S' AND P.Estado NOT IN('F','I')";

		$con = $this->db->query($sql)->result();

		if ($con[0]->Cont < $con[1]->Cont) {
			return 0;
		}else{
			return 1;
		}
	}
}