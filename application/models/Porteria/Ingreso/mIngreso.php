<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mIngreso extends CI_Model {

	function obtenerResidente(){
		$sql = "SELECT
			T.TerceroID AS id
			,CONCAT(T.TerceroID,' | ',T.nombre) AS nombre
			,CONCAT(TV.Nombre,' | ',V.Nomenclatura) AS cod
			,V.viviendaId
			,CASE WHEN V.Citofono IS NULL THEN '-' ELSE V.Citofono END AS Citofono
		FROM ViviendaTercero VT
			LEFT JOIN Vivienda V ON VT.ViviendaId = V.ViviendaId
			LEFT JOIN TipoVivienda TV ON V.TipoViviendaId = TV.TipoViviendaId
			LEFT JOIN Tercero T ON VT.TerceroID = T.TerceroID
		WHERE Residente = 1 AND ListaGeneral = 1";

		return $this->db->query($sql)->result();
	}

	function obtenerTipoVehiculo(){
		return $this->db->query("SELECT TipoVehiculoId AS id, nombre FROM TipoVehiculo WHERE Estado = 'A'")->result();
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

	function obtenerNumDocu(){
		$id = $this->input->post('Id');

		return $this->db->query("SELECT TerceroID FROM ViviendaTercero WHERE (viviendaId = ? OR TerceroID = ?) AND Residente = 1",array($id,$id))->result();
	}

	function qHistorico(){
		$residente 	= $this->input->post("residente");
		$vivienda 	= $this->input->post("vivienda");

		$sql = "SELECT 
			'' AS Acciones
			,PIN.ProgIngresoId
			,Cedula
			,Nombre
			,CASE I.Estado WHEN 'I' THEN 'Ingreso' ELSE '' END AS Estado
			,I.Observacion
		FROM ProgIngreso PIN
			LEFT JOIN Ingreso I ON PIN.ProgIngresoId = I.ProgIngresoId AND I.Estado = 'I'
		WHERE Tipo = 'P' AND PIN.Estado IN('A','F') AND (ViviendaId = ? OR TerceroID ";

		if ($residente == '') {
			$sql .= "IN(?))";
		}else{
			$sql .= "IN?)";
		}

		return $this->db->query($sql,array($vivienda,$residente))->result();
	}

	function qProgramado(){
		$residente 	= $this->input->post("residente");
		$vivienda 	= $this->input->post("vivienda");

		$sql = "SELECT 
			'' AS Acciones
			,PIN.ProgIngresoId
			,Cedula
			,Nombre
			,Placa
			,PIN.Estado
			,PIN.Observacion
		FROM ProgIngreso PIN
			LEFT JOIN Ingreso I ON PIN.ProgIngresoId = I.ProgIngresoId 
		WHERE PIN.Tipo = 'P' AND PIN.Estado = 'A' AND I.Estado IS NULL AND (ViviendaId = ? OR TerceroID ";

		if ($residente == '') {
			$sql .= "IN(?))";
		}else{
			$sql .= "IN?)";
		}
		return $this->db->query($sql,array($vivienda,$residente))->result();
	}

	function obtenerTercero(){
		$id 	= $this->input->post('Id');
		$tipo 	= $this->input->post('Tipo');

		if ($tipo == 'Residente') {
			$viviendaId = $this->obtenerNomenclaturaVivienda($id);
			if (count($viviendaId) > 0) {
				$id = $viviendaId[0]->ViviendaId;
			}else{
				return 1;
			}
		}

		$sql = "SELECT
			T.TerceroID AS id
			,CONCAT(T.TerceroID,' | ',T.nombre) AS nombre
			,T.telefono
			,T.celular
			,V.Nomenclatura
			,T.foto
			,CASE 
				WHEN VT.Residente = 1 AND VT.Propietario = 1
					THEN 'Propietario / Residente'
				WHEN VT.Residente = 0 AND VT.Propietario = 1
					THEN 'Propietario'
				WHEN VT.Residente = 1
					THEN 'Residente'
			END AS Tipo
		FROM ViviendaTercero VT
			LEFT JOIN Vivienda V ON VT.ViviendaId = V.ViviendaId
			LEFT JOIN Tercero T ON VT.TerceroID = T.TerceroID
		WHERE VT.ViviendaId = ? AND ListaGeneral = 1";

		$consulta = $this->db->query($sql,array($id))->result();

		if (count($consulta) > 0) {
			for ($i=0; $i < count($consulta); $i++) { 
				$foto = $consulta[$i]->foto;
				$foto = base64_encode($foto);
				$consulta[$i]->foto = $foto;
			}
			return $consulta;
		}else{
			return 1;
		}
	}

	function obtenerNomenclaturaVivienda($docu){
		$sql = "SELECT
			VT.ViviendaId
		FROM ViviendaTercero VT
		WHERE VT.TerceroID = ? AND VT.Residente = 1";

		return $this->db->query($sql,array($docu))->result();
	}

	function guardarIngreso(){
		$data 	= $this->input->post('Data');
		$id 	= $this->input->post('Id');
		$tipo 	= $this->input->post('Tipo');

		$this->db->trans_begin();

		if ($tipo == 'R') {
			$this->db->insert('Ingreso',array(
					'Fecha' 			=> date("Y-m-d\TH:i:s"),
					'Estado' 			=> 'I',
					'TerceroVehiculoId' => $id
				)
			);
		}
		if ($tipo == 'A') {
			$email = $this->input->post('Email');

			if ($email != '') {
				$this->db->where('ProgIngresoId',$data['ProgIngresoId']);
				$this->db->update('ProgIngreso',array('Email'=>$email));
			}

			$data['Fecha'] = date("Y-m-d\TH:i:s");
			$this->db->insert('Ingreso',$data);
		}
		if ($tipo == 'I') {
			$this->db->insert('ProgIngreso',array(
					'TerceroID' 		=> $id['residente'][0],
					'ViviendaId' 		=> $id['vivienda'],
					'TipoVehiculoId' 	=> $data['TipoVehiculoId'] != '' ? $data['TipoVehiculoId'] : null,
					'Cedula' 			=> $data['Cedula'],
					'Nombre' 			=> $data['Nombre'],
					'Email' 			=> $data['Email'] != '' ? $data['Email'] : null,
					'Placa' 			=> $data['Placa'] != '' ? $data['Placa'] : null,
					'Tipo' 				=> 'I',
					'Estado' 			=> 'A',
					'FechaRegis' 		=> date("Y-m-d\TH:i:s"),
				)
			);
			$insert = $this->db->insert_id();
			$this->db->insert('Ingreso',array(
					'Fecha' 			=> date("Y-m-d\TH:i:s"),
					'Estado' 			=> 'I',
					'Observacion' 		=> $data['ObservacionI'] != '' ? $data['ObservacionI'] : null,
					'Acomp' 			=> $data['Acomp'] != '' ? $data['Acomp'] : null,
					'ProgIngresoId' 	=> $insert
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

	function obtenerData(){
		$id  = $this->input->post('Id');
		$id2 = $this->input->post('Id2');
		$where = "";
		if (is_array($id2)) {
			$where = $id2;
		}else{
			$where = "(".$id.")";
		}

		$sql = "SELECT 
			COUNT(*) AS Cont 
			,Max('Ingreso') AS Tipo
		FROM ProgIngreso P
			INNER JOIN Ingreso I ON P.ProgIngresoId = I.ProgIngresoId
		WHERE P.Cedula = '$id' AND P.TerceroId IN? AND I.Estado = 'I' AND P.Estado NOT IN('F','I')
		UNION
		SELECT 
			COUNT(*) AS Cont
			,Max('Salida') AS Tipo
		FROM ProgIngreso P
			INNER JOIN Ingreso I ON P.ProgIngresoId = I.ProgIngresoId
		WHERE P.Cedula = '$id' AND P.TerceroId IN? AND I.Estado = 'S' AND P.Estado NOT IN('F','I')";

		$con = $this->db->query($sql,array($where,$where))->result();

		if (count($con) == 1) {
			return $this->db->query("SELECT nombre,email,placa,tipovehiculoid,tipo,ProgIngresoId,Foto FROM ProgIngreso WHERE TerceroID IN ? AND Cedula = ? ORDER BY ProgIngresoId DESC",array($id2,$id))->result();
		}
		if (count($con) == 2) {
			if ($con[0]->Cont == $con[1]->Cont) {
				return $this->db->query("SELECT nombre,email,placa,tipovehiculoid,tipo,ProgIngresoId,Foto FROM ProgIngreso WHERE TerceroID IN ? AND Cedula = ? ORDER BY ProgIngresoId DESC",array($id2,$id))->result();
			}
			if ($con[0]->Cont < $con[1]->Cont) {
				return 2;
			}
		}
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

	function verificaPlaca(){
		$placa = $this->input->post('Placa');
		$tipo  = $this->input->post('Tipo');

		if ($tipo == 'Ingreso') {
			return $this->validaIngresoPorPlaca($placa);
		}else{
			if ($this->validaIngresoPorPlaca($placa) == 1) {
				return 1;
			}

			$sql = "SELECT 
				'Residente' AS tipo
				,T.nombre AS nombreRes
				,TVI.Nombre AS nomTipoV
				,V.Nomenclatura
				,TV.Nombre AS nomVehi
				,TerceroVehiculoId
			FROM TerceroVehiculo TVE
				LEFT JOIN Tercero T ON TVE.TerceroID = T.TerceroID
				LEFT JOIN TipoVehiculo TV ON TVE.TipoVehiculoId = TV.TipoVehiculoId
				LEFT JOIN ViviendaTercero VT ON T.TerceroID = VT.TerceroID AND VT.Residente = 1
				LEFT JOIN Vivienda V ON VT.ViviendaId = V.ViviendaId
				LEFT JOIN TipoVivienda TVI ON V.TipoViviendaId = TVI.TipoViviendaId
			WHERE TVE.Placa = ?";

			$sql2 = "SELECT 
				PIN.Cedula
				,TV.Nombre AS tipo
				,PIN.Placa
				,PIN.Nombre AS nomVis
				,PIN.Observacion 
				,PIN.ProgIngresoId
				,CONCAT(TVI.Nombre,' | ',V.Nomenclatura) AS casa
				,PIN.Email
				,PIN.Foto
			FROM ProgIngreso PIN
				LEFT JOIN TipoVehiculo TV ON PIN.TipoVehiculoId = TV.TipoVehiculoId
				LEFT JOIN Vivienda V ON PIN.ViviendaId = V.ViviendaId
				LEFT JOIN TipoVivienda TVI ON V.TipoViviendaId = TVI.TipoViviendaId
			WHERE PIN.Placa = ? AND PIN.Estado = 'A'";

			$data1 = $this->db->query($sql,array($placa))->result();
			$data2 = $this->db->query($sql2,array($placa))->result();

			return array(
				'ceroRecord' 	=> (count($data1) == 0 && count($data2) == 0) ? 1 : 0,
				'autorizado' 	=> (count($data1) > 0 && count($data2) == 0) ? 1 : 0,
				'dataAut' 		=> $data1,
				'programado' 	=> (count($data1) == 0 && count($data2) > 0) ? 1 : 0,
				'dataProg' 		=> $data2
			);
		}
	}

	function validaIngresoPorPlaca($placa){
		$sql = "SELECT 
			COUNT(*) AS Cont 
			,CASE WHEN Max('Ingreso') IS NULL THEN 'NE' ELSE Max('Ingreso') END AS Tipo
		FROM ProgIngreso P
			INNER JOIN Ingreso I ON P.ProgIngresoId = I.ProgIngresoId
		WHERE P.Placa = '$placa' AND I.Estado = 'I' AND P.Estado NOT IN('F','I')
		UNION
		SELECT 
			COUNT(*) AS Cont
			,CASE WHEN Max('Salida') IS NULL THEN 'NE' ELSE Max('Salida') END AS Tipo
		FROM ProgIngreso P
			INNER JOIN Ingreso I ON P.ProgIngresoId = I.ProgIngresoId
		WHERE P.Placa = '$placa' AND I.Estado = 'S' AND P.Estado NOT IN('F','I')
		ORDER BY 2";

		$con = $this->db->query($sql)->result();

		if ($con[0]->Cont == 0 && $con[0]->Tipo == 'NE') {
			$sqlR = "SELECT 
				COUNT(*) AS Cont 
				,CASE WHEN Max('Ingreso') IS NULL THEN 'NE' ELSE Max('Ingreso') END AS Tipo
			FROM TerceroVehiculo T
				INNER JOIN Ingreso I ON T.TerceroVehiculoId = I.TerceroVehiculoId
			WHERE T.Placa = '$placa' AND I.Estado = 'I'
			UNION
			SELECT 
				COUNT(*) AS Cont 
				,CASE WHEN Max('Salida') IS NULL THEN 'NE' ELSE Max('Salida') END AS Tipo
			FROM TerceroVehiculo T
				INNER JOIN Ingreso I ON T.TerceroVehiculoId = I.TerceroVehiculoId
			WHERE T.Placa = '$placa' AND I.Estado = 'S'
			ORDER BY 2";

			$conR = $this->db->query($sqlR)->result();
			if (count($conR) == 1) {
				return 0;
			}
			if (count($conR) == 2) {
				if ($conR[0]->Cont == $conR[1]->Cont) {
					return 0;
				}
				if ($conR[0]->Cont > $conR[1]->Cont) {
					return 1;
				}
			}
		}else{
			if (count($con) == 1) {
				return 0;
			}
			if (count($con) == 2) {
				if ($con[0]->Cont == $con[1]->Cont) {
					return 0;
				}
				if ($con[0]->Cont > $con[1]->Cont) {
					return 1;
				}
			}
		}
	}

	function guardarIngresoResidente(){
		$tipo 	= $this->input->post("Tipo");
		$id 	= $this->input->post("Id"); 

		if ($tipo == 'Residente') {
			$id2 = $this->db->query("SELECT ViviendaTerceroId FROM ViviendaTercero WHERE ViviendaId = ? AND Residente = 1",array($id))->result();
			if (count($id2) > 0) {
				$id = $id2[0]->ViviendaTerceroId;
			}else{
				return 2;
			}
		}

		$this->db->trans_begin();


		$this->db->insert("Ingreso",array(
				"Estado" 				=> "I",
				"ViviendaTerceroId" 	=> $id,
				"Fecha" 				=> date("Y-m-d\TH:i:s")
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

	function obtenerTerceroVivienda(){
		$id = $this->input->post('Id');

		$sql = "SELECT 
			V.TerceroID
			,T.nombre 
			,v.ViviendaTerceroId
		FROM ViviendaTercero V
			LEFT JOIN Tercero T ON V.TerceroID = T.TerceroID
		WHERE Residente = 1 AND ViviendaId = ?";

		return $this->db->query($sql,array($id))->result();
	}
}