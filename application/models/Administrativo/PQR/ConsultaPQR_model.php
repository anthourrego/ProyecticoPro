<?php
class ConsultaPQR_model extends CI_Model{

	function selectProblemaCalidad(){
		$sql = "SELECT * FROM CausaPQR
		 WHERE Tipo = 'D' 
		 ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectOperacion(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'O' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectCausaPQR(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'C' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectResponsable(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'R' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectSeccion(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'S' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	function selectEstado(){
		$sql = "SELECT * FROM EstadoPQR
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	function selectTipo(){
		$sql = "SELECT * FROM TipoPQR
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	function selectCiudad(){
		$sql = "SELECT * FROM Ciudad
		ORDER BY nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	function selectAsesor(){
		$sql = "SELECT usuarioId, Nombre FROM Segur
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	function selectDependencia(){
		$sql = "SELECT dependenciaId, Nombre FROM Dependencia
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function listaClientes(){
		$sql = "SELECT 
					TerceroID
					,nombre 
				FROM Tercero 
				WHERE Estado = 'A'";
		$conuslta = $this->db->query($sql)->result();

		return $conuslta;
	}
}