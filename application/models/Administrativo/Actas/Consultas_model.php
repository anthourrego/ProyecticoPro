<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_model extends CI_Model {

	public function formatoCadena($array){
		$cantidad = count($array);
		$cad = "";
		for($i = 0; $i < $cantidad; $i++){
			if($array[$i] != ''){
				if ($i != 0)
					$cad .= ',';
				$cad .= "'".$array[$i]."'";
			}
		}
		return $cad;
	}

	public function qTiempoAsistentes(){
		$opcionFecha = $this->input->post('opcionFecha');

		$where = "";

		if($opcionFecha != null){
			switch ($opcionFecha){
				case 'fechas':
					$fechaIni = $this->input->post('fechaIni');
					$fechaFin = $this->input->post('fechaFin');

					$where .= " AND CAST(AA.FechaRegis AS DATE) >= CAST('$fechaIni' AS DATE) AND CAST(AA.FechaRegis AS DATE) <= CAST('$fechaFin' AS DATE) ";
				break;
				case 'mes':
					$mes = $this->input->post('mes');
					$anio = $this->input->post('anio');
					$where .= " AND DATENAME(YEAR, AA.FechaRegis) = '$anio' AND DATENAME(M, AA.FechaRegis)  = '$mes' ";
				break;
				case 'anio':
					$anio = $this->input->post('anio');
					$where .= " AND YEAR(AA.FechaRegis) = '$anio' ";
				break;
				default:
					$where = "";
				break;
			}
		}

		$query = "SELECT 
					CONCAT(S.cedula,' | ', S.nombre) AS Asistente
					,COUNT(AA.UsuarioId) AS Cantidad
					,ISNULL(SUM(A.Tiempo), 0) AS Tiempo
				FROM ActaAsistente AA
					LEFT JOIN Acta A ON  AA.ActaId = A.ActaId
					LEFT JOIN Segur S ON AA.UsuarioId = S.usuarioId
				WHERE 1 = 1 $where
				GROUP BY AA.UsuarioId, S.nombre, S.cedula";

		$resultado = $this->db->query($query)->result();

		return $resultado;
	}

	public function qTiempoMes(){
		$opcionFecha = $this->input->post('opcionFecha');

		$where = "";

		if($opcionFecha != null){
			switch ($opcionFecha){
				case 'fechas':
					$fechaIni = $this->input->post('fechaIni');
					$fechaFin = $this->input->post('fechaFin');

					$where .= " AND CAST(A.Fecha AS DATE) >= CAST('$fechaIni' AS DATE) AND CAST(A.Fecha AS DATE) <= CAST('$fechaFin' AS DATE) ";
				break;
				case 'mes':
					$mes = $this->input->post('mes');
					$anio = $this->input->post('anio');
					$where .= " AND DATENAME(YEAR, A.Fecha) = '$anio' AND DATENAME(M, A.Fecha)  = '$mes' ";
				break;
				case 'anio':
					$anio = $this->input->post('anio');
					$where .= " AND YEAR(A.Fecha) = '$anio' ";
				break;
				default:
					$where = "";
				break;
			}
		}

		$query = "SELECT
			DATENAME(MONTH, A.Fecha) Mes
			,COUNT(*) Cantidad
			,ISNULL(SUM(A.Tiempo), 0) Tiempo
		FROM Acta A
		WHERE 1 = 1 $where
		GROUP BY DATENAME(MONTH, A.Fecha)";

		$resultado = $this->db->query($query)->result();

		return $resultado;
	}

	public function qTiempoTipoReunion(){
		$opcionFecha = $this->input->post('opcionFecha');

		$where = "";

		if($opcionFecha != null){
			switch ($opcionFecha){
				case 'fechas':
					$fechaIni = $this->input->post('fechaIni');
					$fechaFin = $this->input->post('fechaFin');

					$where .= " AND CAST(A.Fecha AS DATE) >= CAST('$fechaIni' AS DATE) AND CAST(A.Fecha AS DATE) <= CAST('$fechaFin' AS DATE) ";
				break;
				case 'mes':
					$mes = $this->input->post('mes');
					$anio = $this->input->post('anio');
					$where .= " AND DATENAME(YEAR, A.Fecha) = '$anio' AND DATENAME(M, A.Fecha)  = '$mes' ";
				break;
				case 'anio':
					$anio = $this->input->post('anio');
					$where .= " AND YEAR(A.Fecha) = '$anio' ";
				break;
				default:
					$where = "";
				break;
			}
		}

		$query = "SELECT 
			MAX(TR.Nombre) TipoReunion
			,COUNT(*) Cantidad
			,ISNULL(SUM(A.Tiempo), 0) Tiempo
		FROM Acta A
		LEFT JOIN TipoReunion TR ON A.TipoReunionId = TR.TipoReunionId
		WHERE 1 = 1 $where
		GROUP BY TR.TipoReunionId";

		$resultado = $this->db->query($query)->result();

		return $resultado;
	}
}

?>

    