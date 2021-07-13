<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones_model extends CI_Model {
	function formatoCadena($array){
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

	function getNotificaciones() {
		$usuarioid = $this->session->userdata('id');
		$this->db->query("SET DATEFORMAT YDM;");
		$sql = "SELECT 
					A.AlertaId, 
					A.UsuarioId, 
					A.AsignadoA,
					A.Descripcion,
					A.Creada,
					A.Programada,
					A.Ejecutada,
					A.Tipo,
					A.Estado,
					A.Numero
				FROM Alerta A
				WHERE (A.AsignadoA = 'ANTHONY' OR A.AsignadoA IS NULL) 
					AND A.Estado = ''";
		$NUEVAS = $this->db->query($sql)->result();

		$TOTALNUEVAS = count($NUEVAS);
		if($TOTALNUEVAS > 0) {
			$ids = array();
			for($i = 0; $i < count($NUEVAS); $i++){
				array_push($ids, $NUEVAS[$i]->AlertaId);
			}
			$ids = $this->formatoCadena($ids);
			$this->db->query("
				UPDATE Alerta SET Estado = 'V'
				WHERE UsuarioId = '$usuarioid' AND Estado = '' AND AlertaId IN ($ids)
			");
			if ($this->db->affected_rows() == 0) {
				$NUEVAS = array();
			}
		}
		$TOTAL = count($this->listaNotificaciones());

		$Notificaciones = array(
			'Nuevas' => $NUEVAS,
			'Total' => $TOTAL
		);
		if($NUEVAS > 0){
			return $Notificaciones;
		}else{
			return '';
		}
	}

	/* function listaNotificaciones() {
		$usuarioid = $this->session->userdata('id');
		$this->db->query("SET DATEFORMAT YDM;");
		$sql = "SELECT
			A.AlertaId, 
			A.UsuarioId, A.AsignadoA, A.Descripcion, 
			A.Creada, A.Programada, A.Ejecutada, 
			A.Tipo, A.Estado, A.Numero, HR.Reserva
		FROM Alerta A 
		LEFT JOIN Reserva R ON A.Numero = R.ReservaId
		LEFT JOIN HeadReserva HR ON R.HeadReservaId = HR.HeadReservaId
		WHERE (A.AsignadoA = '$usuarioid' OR A.AsignadoA IS NULL) 
		AND A.Estado != 'C' 
		AND A.Estado != 'N' 
		AND A.Tipo NOT IN ('MN')
		AND FORMAT(GETDATE(), 'yyyy-dd-MM HH:mm:ss') >= IIF(A.Tipo = 'MA', A.Creada, CAST(CONCAT(FORMAT(A.Programada, 'yyyy-dd-MM'), ' ', R.HoraDespertador) AS DATETIME))
		ORDER BY A.Creada DESC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	} */

	function listaNotificaciones() {
		$usuarioid = $this->session->userdata('id');
		$this->db->query("SET DATEFORMAT YDM;");
		$sql = "SELECT
			A.AlertaId, 
			A.UsuarioId, 
			A.AsignadoA, 
			A.Descripcion, 
			A.Creada, 
			A.Programada, 
			A.Ejecutada, 
			A.Tipo, A.Estado, 
			A.Numero
		FROM Alerta A 
		WHERE (A.AsignadoA = '$usuarioid' OR A.AsignadoA IS NULL) 
			AND A.Estado != 'C' 
			AND A.Estado != 'N' 
			AND A.Tipo NOT IN ('MN')
		ORDER BY A.Creada DESC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	
	function actualizarAlerta() {
		$id = $this->input->post('id');
		$this->db->where('AlertaId', $id);
		$this->db->update('Alerta', array('Estado' => 'C', 'Ejecutada' => date("Y-m-d H:i:s")));
	}
}

?>