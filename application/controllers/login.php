<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	function validarNIT($nit){
		$this->load->database();
		$NIT = $nit;
		$sql = "SELECT 
			AC.HostDB
			,AC.BaseDatos
			,AC.Usuario
			,AC.Clave
			,AC.DriverDB
		FROM ModuloAcceso MA 
		LEFT JOIN Modulo M ON MA.ModuloId = M.ModuloId
		LEFT JOIN AplicativoCliente AC ON MA.AplicativoClienteId = AC.AplicativoClienteId
		LEFT JOIN Aplicativo A ON AC.AplicativoId = A.AplicativoId
		LEFT JOIN Cliente C ON AC.ClienteId = C.ClienteId
		WHERE C.Nit = '$NIT' AND C.Estado = 'A' AND A.Estado = 'A' AND M.ModuloId = 'RESIDENTE_ADM' AND A.AplicativoId = 'RESIDENTE' AND AC.Estado = 'A'";
		$consulta = $this->db->query($sql)->result();
		if(count($consulta) > 0){
			if($this->input->post('NIT')){
				$data = [
					"NIT_tmp" 		=> $nit,
					"conexion_tmp" 	=> array(
						'dsn'	=> '',
						'hostname' => $consulta[0]->HostDB,
						'username' => $consulta[0]->Usuario,
						'password' => $consulta[0]->Clave,
						'database' => $consulta[0]->BaseDatos,
						'dbdriver' => $consulta[0]->DriverDB,
						'dbprefix' => '',
						'pconnect' => FALSE,
						'db_debug' => TRUE,
						'cache_on' => FALSE,
						'cachedir' => '',
						'char_set' => 'utf8',
						'dbcollat' => 'utf8_general_ci',
						'swap_pre' => '',
						'encrypt' => FALSE,
						'compress' => FALSE,
						'stricton' => FALSE,
						'failover' => array(),
						'save_queries' => TRUE
					)
				];
				$this->session->set_userdata($data);
				return 1;
			} else {
				$datos = array(
					"HostDB" => $consulta[0]->HostDB,
					"Usuario" => $consulta[0]->Usuario,
					"Clave" => $consulta[0]->Clave,
					"BaseDatos" => $consulta[0]->BaseDatos,
					"DriverDB" => $consulta[0]->DriverDB,
				);

				return $datos; 
			}
		}else{
			if($this->input->post('NIT')){
				$this->session->sess_destroy();
			}
			return 0;
		}
	}

	function validarUsuarioCedula(){
		if ($this->input->post('Cedula')) {
			$cc = $this->input->post('Cedula');
		} else {
			$POST = json_decode(file_get_contents('php://input'));
			$cc = $POST->Cedula;
		}

		$this->load->database();

		$sql = "SELECT 
			U.CodigoUsuario
			,U.Cedula
			,U.Nombre
			,C.Nit
			,C.Nombre AS Conjunto
			,AC.AplicativoClienteId
			,C.Imagen AS Fondo
		FROM Usuario U
			LEFT JOIN AplicativoCliente AC ON U.AplicativoClienteId = AC.AplicativoClienteId
			LEFT JOIN Cliente C ON AC.ClienteId = C.ClienteId
		WHERE U.Cedula = ?";

		$datos = $this->db->query($sql,array($cc))->result();

		if (count($datos) > 0) {
			if ($this->input->post('Cedula')) {
				$data = [
					"CEDULA" 	=> $cc,
					"DATAINI" 	=> $datos,
				];
				$this->session->set_userdata($data);
				echo 1;
			} else {
				$info = array(
					"valido" => 1,
					"conjuntos" => $datos,
				);
				echo json_encode(ENCRIPTAR(json_encode($info)));
			}
		}else{
			if ($this->input->post('Cedula')) {
				echo 0;
			} else {
				$info = array(
					"valido" => 0,
					"mensaje" => "Número de cédula no valido.",
				);
				$datos = ENCRIPTAR(json_encode($info));
				echo json_encode($datos);
			}
		}
	}

	function ingreso(){
		if ($this->input->is_ajax_request()) {
			$nit 		= $this->input->post('NIT');

			$valida = $this->validarNIT($nit);
			if ($valida == 1) {
				$this->load->model(array('Login_model'));
				$user = $this->input->post('Usuario');
				$resp = $this->Login_model->ingreso();

				if($resp){
					$ini;
					for ($i=0; $i < count($this->session->userdata('DATAINI')); $i++) { 
						if ($this->session->userdata('DATAINI')[$i]->Nit == $nit) {
							$ini = $this->session->userdata('DATAINI')[$i];
						}
					}

					$this->session->unset_userdata('DATAINI');
					$this->session->set_userdata(array(
						"DATAINI" => $ini,
					));
					// 20/03/2019 JCSM - Validar ingresos
					$ingresos = $this->db->query("SELECT
						AC.NumUsuLic, X.Conectados, AC.ClienteId
					FROM Cliente C
						LEFT JOIN AplicativoCliente AC ON C.ClienteId = AC.ClienteId AND AC.AplicativoId = 'RESIDENTE'
						LEFT JOIN (SELECT
							I.ClienteId, COUNT(I.ClienteId) AS Conectados
						FROM Ingreso I
						WHERE I.AplicativoId = 'RESIDENTE'
							AND I.Estado = 'A'
							AND I.strUsuarioId <> '".$user."'
						GROUP BY I.ClienteId) X ON X.ClienteId = C.ClienteId
					WHERE C.Nit = '".$this->session->userdata('NIT_tmp')."'
						AND C.Estado = 'A'
						AND AC.Estado = 'A'")->row();
					if($ingresos->NumUsuLic != NULL && $ingresos->NumUsuLic > 0 && (($ingresos->Conectados == null) || ($ingresos->Conectados < $ingresos->NumUsuLic))){
						// Cierra la sesión de manera incorrecta
						$sql = "UPDATE Ingreso
							SET Estado = 'M',
								FechaFin = GETDATE()
						WHERE AplicativoId = 'RESIDENTE'
						AND strUsuarioId = '".$user."'
						AND Estado = 'A'
						AND ClienteId = '".$ingresos->ClienteId."'
						";
						$this->db->query($sql);
						// Genera registro de ingreso
						$sql = "INSERT INTO Ingreso (
							ClienteId
							,AplicativoId
							,strUsuarioId
							,IpLocal
							,IpServidor
							,FechaIni
							,Estado
						)VALUES (
							'".$ingresos->ClienteId."'
							,'RESIDENTE'
							,'".$user."'
							,'".$_SERVER['REMOTE_ADDR']."'
							,'".$_SERVER['SERVER_ADDR']."'
							,GETDATE()
							,'A')
						";
						$this->db->query($sql);

						$IngresoId = $this->db->insert_id();

						$data = [
							"IngresoId" => $IngresoId
						];

						$this->session->set_userdata($data);

						$this->session->set_userdata(array(
							"NIT" 		=> $this->session->userdata('NIT_tmp'),
							"conexion" 	=> $this->session->userdata('conexion_tmp'),
							"HUD" 		=> true
						));
						$this->session->unset_userdata('NIT_tmp');
						$this->session->unset_userdata('conexion_tmp');

						//var_dump($this->session->userdata());

						echo 1;
					}else{
						$usuarios = $this->db->query("SELECT
							X.strUsuarioId
						FROM Cliente C
							LEFT JOIN AplicativoCliente AC ON C.ClienteId = AC.ClienteId AND AC.AplicativoId = 'RESIDENTE'
							LEFT JOIN (SELECT
								I.ClienteId, COUNT(I.ClienteId) AS Conectados, I.strUsuarioId
							FROM Ingreso I
							WHERE I.AplicativoId = 'RESIDENTE'
								AND I.Estado = 'A'
								AND I.strUsuarioId <> '".$user."'
							GROUP BY I.ClienteId, I.strUsuarioId) X ON X.ClienteId = C.ClienteId
						WHERE C.Nit = '".$this->session->userdata('NIT_tmp')."'
							AND C.Estado = 'A'
							AND AC.Estado = 'A'")->result();
						$dataUsuarios = $this->Login_model->listaUsuarios($usuarios);
						$data = array(
							'cantidad' => [intval($ingresos->NumUsuLic)],
							'users' => $dataUsuarios
						);

						echo json_encode($data);
					}
				}else{
					echo "error";
				}
			}else{
				echo 0;
			}
		}else{
			show_404();
		}
	}

	function ingresoMovil(){
		$POST = json_decode(file_get_contents('php://input'));

		if (isset($POST->nroDocumento)) {
			$nit = $POST->nit;

			$datosDB = $this->validarNIT($nit);

			if (is_array($datosDB)) {
				$user = $POST->usuario;
				$conexion = $this->dataConexion($datosDB);
				$this->load->model(array('Login_model'));
				$resp = $this->Login_model->ingresoMovil($user, $POST->clave, $conexion, $POST->RASTREO);

				if($resp){
					// 20/03/2019 JCSM - Validar ingresos
					$ingresos = $this->db->query("SELECT
							AC.NumUsuLic, X.Conectados, AC.ClienteId
						FROM Cliente C
							LEFT JOIN AplicativoCliente AC ON C.ClienteId = AC.ClienteId AND AC.AplicativoId = 'RESIDENTE'
							LEFT JOIN (SELECT
								I.ClienteId, COUNT(I.ClienteId) AS Conectados
							FROM Ingreso I
							WHERE I.AplicativoId = 'RESIDENTE'
								AND I.Estado = 'A'
								AND I.strUsuarioId <> '".$user."'
							GROUP BY I.ClienteId) X ON X.ClienteId = C.ClienteId
						WHERE C.Nit = '".$nit."'
							AND C.Estado = 'A'
							AND AC.Estado = 'A'")->row();
	
					if($ingresos->NumUsuLic != NULL && $ingresos->NumUsuLic > 0 && (($ingresos->Conectados == null) || ($ingresos->Conectados < $ingresos->NumUsuLic))){
						// Cierra la sesión de manera incorrecta
						$sql = "UPDATE Ingreso
								SET Estado = 'M',
									FechaFin = GETDATE()
								WHERE AplicativoId = 'RESIDENTE'
									AND strUsuarioId = '".$user."'
									AND Estado = 'A'
									AND ClienteId = '".$ingresos->ClienteId."'";
	
						$this->db->query($sql);
						// Genera registro de ingreso
						$sql = "INSERT INTO Ingreso (
							ClienteId
							,AplicativoId
							,strUsuarioId
							,IpLocal
							,IpServidor
							,FechaIni
							,Estado
						)VALUES (
							'".$ingresos->ClienteId."'
							,'RESIDENTE'
							,'".$user."'
							,'".$_SERVER['REMOTE_ADDR']."'
							,'".$_SERVER['SERVER_ADDR']."'
							,GETDATE()
							,'A')";
	
						$this->db->query($sql);
	
						$IngresoId = $this->db->insert_id();
	
						$info = array(
							"valido" => 1,
							"ingreso" => $IngresoId,
							"db" => ENCRIPTAR(json_encode($datosDB))
						);
	
						echo json_encode(ENCRIPTAR(json_encode($info)));
	
					}else{
						$usuarios = $this->db->query("SELECT
							X.strUsuarioId
						FROM Cliente C
							LEFT JOIN AplicativoCliente AC ON C.ClienteId = AC.ClienteId AND AC.AplicativoId = 'RESIDENTE'
							LEFT JOIN (SELECT
								I.ClienteId, COUNT(I.ClienteId) AS Conectados, I.strUsuarioId
							FROM Ingreso I
							WHERE I.AplicativoId = 'RESIDENTE'
								AND I.Estado = 'A'
								AND I.strUsuarioId <> '".$user."'
							GROUP BY I.ClienteId, I.strUsuarioId) X ON X.ClienteId = C.ClienteId
						WHERE C.Nit = '".$this->session->userdata('NIT_tmp')."'
							AND C.Estado = 'A'
							AND AC.Estado = 'A'")->result();
						$dataUsuarios = $this->Login_model->listaUsuarios($usuarios);
						$data = array(
							'cantidad' => [intval($ingresos->NumUsuLic)],
							'users' => $dataUsuarios
						);
	
						echo json_encode(ENCRIPTAR(json_encode($info)));
					}
				} else {
					$info = array(
						"valido" => 0,
						"mensaje" => "Contraseña incorrecta.",
					);
					echo json_encode(ENCRIPTAR(json_encode($info)));
				}

			} else {
				$info = array(
					"valido" => 0,
					"mensaje" => "Error al enviar los datos.",
				);
				echo json_encode(ENCRIPTAR(json_encode($info)));
			}
		} else {
			$info = array(
				"valido" => 0,
				"mensaje" => "Error al enviar los datos.",
			);
			echo json_encode(ENCRIPTAR(json_encode($info)));
		}
	}

	function inicio(){
		$tipo = $this->input->post('Tipo');

		if ($tipo != '') {
			$data = [
				"TipoV" => $tipo,
			];
			$this->session->set_userdata($data);

			echo 1;
		}else{
			echo 'error';
		}
	}

	function cierreInactividad(){
		if ($this->input->is_ajax_request()) {
			$this->load->model(array('Login_model'));
			$_POST['RASTREO']['programa'] 	= 'Salida Sistema';
			$_POST['RASTREO']['cambio'] 	= 'Salida del Sistema Residente por Inactividad';
			RASTREO();
			$data = [
				"NIT" 		=> $this->session->userdata('NIT'),
				"conexion" 	=> $this->session->userdata('conexion')
			];
			$this->Login_model->salirIngreso();
			$this->session->sess_destroy();
			$this->session->set_userdata($data);
		}else{
			show_404();
		}
	}

	function cierre(){
		if ($this->input->is_ajax_request()) {
			$this->load->model(array('Login_model'));
			RASTREO();
			$data = [
				"NIT" 		=> $this->session->userdata('NIT'),
				"conexion" 	=> $this->session->userdata('conexion')
			];
			$this->Login_model->salirIngreso();
			$this->session->sess_destroy();
			$this->session->set_userdata($data);
		}else{
			show_404();
		}
	}

	function regresar(){
		$this->session->sess_destroy();
		echo 1;
	}

	function ocultarHUD(){
		if($this->session->userdata('HUD')){
			$this->session->set_userdata(['HUD' => false]);
			echo 0;
		}else{
			$this->session->set_userdata(['HUD' => true]);
			echo 1;
		}
	}

	function dataConexion($datosDB) {
		return array(
			'dsn'	=> '',
			'hostname' => $datosDB['HostDB'],
			'username' => $datosDB['Usuario'],
			'password' => $datosDB['Clave'],
			'database' => $datosDB['BaseDatos'],
			'dbdriver' => $datosDB['DriverDB'],
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => TRUE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => FALSE,
			'compress' => FALSE,
			'stricton' => FALSE,
			'failover' => array(),
			'save_queries' => TRUE
		);
	}
}
?>