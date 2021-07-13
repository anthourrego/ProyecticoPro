<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function ingreso(){
		$usuario 	= $this->input->post('Usuario');
		$clave 		= md5($this->input->post('Clave'));

		$db2 = $this->load->database($this->session->userdata('conexion_tmp'), TRUE);

		$db2->where('usuarioId', $usuario)
				 ->where('clave', $clave)
				 ->where('estado', 'A');
		$segur = $db2->get('segur');
		if ($segur->num_rows() > 0) {
			$segur = $segur->row();
			$vista = $this->obtenerVista($segur->cedula);

			if($segur->perfilId != null){
				$SEGUR 		= $this->permisos($segur->perfilId, "PerfilId");
				$TERCcrear 	= $this->permisosTERC($segur->perfilId, "perfilid", "crear");
				$TERCModif 	= $this->permisosTERC($segur->perfilId, "perfilid", "modificar");
				$TERCElimi 	= $this->permisosTERC($segur->perfilId, "perfilid", "eliminar");
			}else{
				$SEGUR 		= $this->permisos($segur->usuarioId, "UsuarioId");
				$TERCcrear 	= $this->permisosTERC($segur->usuarioId, "usuarioid", "crear");
				$TERCModif 	= $this->permisosTERC($segur->usuarioId, "usuarioid", "modificar");
				$TERCElimi 	= $this->permisosTERC($segur->usuarioId, "usuarioid", "eliminar");
			}

			$data = [
				"id" 		=> trim($segur->usuarioId),
				"nombre"	=> trim($segur->nombre),
				"TipoV"		=> $vista[0]->vista,
				"navV"		=> $vista[0]->vista,
				"login" 	=> TRUE,
				"SEGUR" 	=> $SEGUR,
				"TERCCrear" => $TERCcrear,
				"TERCModif" => $TERCModif,
				"TERCElimi" => $TERCElimi
			];

			$this->session->set_userdata($data);
			$RASTREO 					= $_POST['RASTREO'];
			$RASTREO['usuarioid'] 		= $this->session->userdata('id');
			$RASTREO['equipo'] 			= $_SERVER['REMOTE_ADDR'];

			$db2->query("SET DATEFORMAT YDM;
			INSERT INTO
				rastreo (fecha, programa, cambio, usuarioid, equipo, fechaservidor, Aplicacion)
			VALUES ('".$RASTREO['fecha']."', '".$RASTREO['programa']."', '".$RASTREO['cambio']."', '".$RASTREO['usuarioid']."', '".$RASTREO['equipo']."', GETDATE(), 'Residente')");
			return 1;
		}else{
			return 0;
		}
	}

	function ingresoMovil($usuario, $clave, $conexion, $rastreo){
		$clave = md5($clave);

		$db2 = $this->load->database($conexion, TRUE);

		$db2->where('usuarioId', $usuario)
				 ->where('clave', $clave)
				 ->where('estado', 'A');
		$segur = $db2->get('segur');

		if ($segur->num_rows() > 0) {
			$data = "'" . $rastreo->fecha . "', '" . $rastreo->programa . "', '" . $rastreo->cambio . "', '";

			$db2->query("SET DATEFORMAT YDM;
				INSERT INTO rastreo (fecha, programa, cambio, usuarioid, equipo, fechaservidor, Aplicacion)
				VALUES (" . $data . $usuario . "', '" . $_SERVER['REMOTE_ADDR'] . "', GETDATE(), 'Residente')"
			);
			return 1;
		}else{
			return 0;
		}
	}

	function obtenerVista($cedula){
		$db2 = $this->load->database($this->session->userdata('conexion_tmp'), TRUE);
		$sql = "SELECT 
			CASE 
				WHEN Porteria = 1 AND Propietario = 1 AND Admin = 1
					THEN 'ALL'
				WHEN Porteria = 1 AND Propietario = 1 AND Admin = 0
					THEN 'PPR'
				WHEN Porteria = 1 AND Propietario = 0 AND Admin = 0
					THEN 'P'
				WHEN Porteria = 1 AND Propietario = 0 AND Admin = 1
					THEN 'PA'
				WHEN Porteria = 0 AND Propietario = 1 AND Admin = 1
					THEN 'PRA'
				WHEN Porteria = 0 AND Propietario = 0 AND Admin = 1
					THEN 'A'
				WHEN Porteria = 0 AND Propietario = 1 AND Admin = 0
					THEN 'PR'
			END AS vista
		FROM Segur
		WHERE cedula = ?";

		return $db2->query($sql,array($cedula))->result();
	}

	// 15/04/2019 JCSM - Query arreglo permisos según usuario o perfil
	function permisos($id, $campo){
		$db2 = $this->load->database($this->session->userdata('conexion_tmp'), TRUE);
		$db2->select("Permiso");
		$db2->where($campo, $id);
		$db2->where('Aplicativo', 'RESIDENTE');
		$permisos = $db2->get('PermisoSistema');
		//Arreglo que lleno con las opciones
		$array = array();
		foreach($permisos->result() as $row){
			$array[] = $row->Permiso;
		}
		return $array;
	}

	function permisosTERC($id, $login, $campo){
		$db2 = $this->load->database($this->session->userdata('conexion_tmp'), TRUE);
		$db2->select('campo')
				 ->where($login, $id)
				 ->where($campo, 1);
		$permisos = $db2->get('PerfilObjetos');
		//Arreglo que lleno con las opciones
		$array = array();
		foreach($permisos->result() as $row){
			$array[] = $row->campo;
	    }
		return $array;
	}

	function listaUsuarios($users){
		$db2 = $this->load->database($this->session->userdata('conexion_tmp'), TRUE);
		$usuarios = '';
		for ($i = 0; $i < count($users); $i++) { 
			if($i == 0){
				$usuarios .= "'".$users[$i]->strUsuarioId."'";
			}else{
				$usuarios .= ",'".$users[$i]->strUsuarioId."'";
			}
		}
		$cad = "SELECT UsuarioId codigo, nombre usuario FROM Segur WHERE usuarioId IN (".$usuarios.")";
		$dataUsers = $db2->query($cad)->result();

		return $dataUsers;
	}

	function salirIngreso(){
		$this->db->close();
		$this->load->database();
		$ClienteId = $this->db->query("SELECT ClienteId FROM Cliente WHERE NIT = '".$this->session->userdata('NIT')."'")->row()->ClienteId;
		$sql = "UPDATE Ingreso
			SET Estado = 'F',
				FechaFin = GETDATE()
		WHERE AplicativoId = 'RESIDENTE'
		AND strUsuarioId = '".$this->session->userdata('id')."'
		AND Estado = 'A'
		AND ClienteId = '$ClienteId'
		";
		$this->db->query($sql, TRUE);
	}
}

?>