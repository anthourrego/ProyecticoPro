<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class database_model extends CI_Model {

	public function __construct()
	{
		if (array_key_exists('Conexion', $this->input->request_headers())) {
			$this->load->helper(array('DESENCRIPTAR'));
			$info = json_decode(DESENCRIPTAR($this->input->request_headers()['Conexion']));

			$this->load->database();

			if($this->router->class != 'Login' || ($this->router->method == 'Cierre' && $this->router->class == 'Login')){

				$IngresoId = $this->input->request_headers()['Token'];

				$this->db->cache_on();
				$id = $this->db->query("SELECT strUsuarioId FROM Ingreso WHERE IngresoId = '$IngresoId'")->row('strUsuarioId');
				$this->session->set_userdata(array('id' => $id));
				$this->db->cache_off();

				$ingresos = $this->db->query("SELECT IngresoId FROM Ingreso WHERE IngresoId = '$IngresoId' AND Estado = 'A'")->result();
				if(count($ingresos) <= 0){
					$this->output->set_header("Token: 0");
				}
			}

			$conexion = array(
				'dsn'			=> '',
				'hostname' 		=> $info->HostDB,
				'username' 		=> $info->Usuario,
				'password' 		=> $info->Clave,
				'database' 		=> $info->BaseDatos,
				'dbdriver' 		=> $info->DriverDB,
				'dbprefix' 		=> '',
				'pconnect' 		=> FALSE,
				'db_debug' 		=> TRUE,
				'cache_on' 		=> FALSE,
				'cachedir' 		=> $info->cachedir,
				'char_set' 		=> 'utf8',
				'dbcollat' 		=> 'utf8_general_ci',
				'swap_pre' 		=> '',
				'encrypt' 		=> FALSE,
				'compress' 		=> FALSE,
				'stricton' 		=> FALSE,
				'failover' 		=> array(),
				'save_queries' 	=> TRUE
			);

			$this->db->close();

			$this->load->database($conexion);

		} else if($this->session->userdata('NIT') ){
			if($this->router->method == 'index' && $this->router->class != 'Login'){
				$this->load->database();
				$ingresos = $this->db->query("SELECT I.IngresoId
				FROM Ingreso I
				LEFT JOIN Cliente C ON I.ClienteId = C.ClienteId
				WHERE
					C.Nit = '".$this->session->userdata('NIT')."'
					AND I.strUsuarioId = '".$this->session->userdata('id')."'
					AND I.AplicativoId = 'RESIDENTE'
					AND I.Estado = 'A'
					AND I.IngresoId = '".$this->session->userdata('IngresoId')."'")->result();
				if(count($ingresos) <= 0){
					$this->session->sess_destroy();
					redirect(base_url());
				}
				$this->db->close();
			}
			$this->load->database($this->session->userdata('conexion'));
		}
	}
}

?>