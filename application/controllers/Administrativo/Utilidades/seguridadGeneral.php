<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class SeguridadGeneral extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(2003, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('RTRIM(usuarioId) usuarioId', 'RTRIM(nombre) nombre', 'RTRIM(estado) estado', 'RTRIM(perfilid) perfilid', 'Cedula'));
		$this->DataTables_model->set_table(array('Segur'));
		$this->DataTables_model->set_column_order(array('usuarioId', 'nombre', 'estado', 'perfilid', 'Cedula'));
		$this->DataTables_model->set_column_search(array('usuarioId', 'nombre'));
		$this->DataTables_model->set_order(array('usuarioId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Estado');
		$contenido['tabla'] = 'Segur';
		$contenido['titulo'] = 'Usuarios';
		$contenido['tblNombre'] = 'Usuarios';
		$contenido['Perfiles'] = $this->db->query("SELECT perfilid, nombre FROM Perfil ORDER BY Nombre ASC")->result();
		$contenido['content_page'] = 'Administrativo/Utilidades/vSeguridadGeneral';

		$contenido["breadcrumb"] = [
			["nombre" => "Utilidades", "ruta" => "Administrativo/Utilidades/Menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}

	function guardarCRUD($tabla) {
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			$codigo = $CI->input->post('codigo');
			$datos = $CI->input->post('data');
			$ID = $CI->input->post('ID');
			$controlador = $CI->input->post('controlador');
			@$datos['perfilId'] = @$datos['perfilId'] == '' ? NULL : @$datos['perfilId'];
			
			$datosConexion = array(
				'dsn'	=> '',
				'hostname' => "SQLGESTIONWEB\GESTIONWEB,1433",
				'username' => 'sa',
				'password' => '123/admin.*',
				'database' => 'GESTION_CONF_PROSOF',
				'dbdriver' => 'sqlsrv',
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

			$db2 = $this->load->database($datosConexion, TRUE);

			if(array_key_exists('password', $datos)){
				$clave = md5($datos['password']);
				$datos['clave'] = $clave;
				unset($datos['password']);
			}

			$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
			$_POST['RASTREO']['programa'] = $controlador;

			$this->db->trans_begin();
			$db2->trans_begin();

			if ($CI->CRUD_model_validarRegistro($codigo, $ID, $tabla)==true) {
				if ($CI->CRUD_model_actualizar($codigo, $datos, $ID, $tabla)==true) {

					if (isset($datos['cedula']) || isset($datos['nombre'])) {
						$actu = '';
						if (isset($datos['cedula'])) {
							$actu = "Cedula = '" . $datos['cedula'] . "'";
						}

						if (isset($datos['nombre'])){
							$actu .= ($actu == '' ? '' : ', ') . "Nombre = '" . $datos['nombre'] . "'";
						}

						$sql = "UPDATE Usuario SET " . $actu . " WHERE CodigoUsuario = '" . $codigo . "' AND AplicativoClienteId = '" . $this->session->userdata('DATAINI')->AplicativoClienteId . "'";

						$db2->query($sql);

						if ($db2->trans_status() == true) {
							$this->db->trans_commit();
							$db2->trans_commit();
							//Rastreo en caso de que se guarde el registro                    
							$_POST['RASTREO']['cambio'] = 'Actualiza '.$controlador. ' ID '.$codigo;
							RASTREO();

							echo 0;
						} else {
							$this->db->trans_rollback();
							$db2->trans_rollback();
							//echo "No se pudieron actualizar los datos.";
							echo 1;
						}
					} else {
						$this->db->trans_commit();
						$db2->trans_commit();
						//Rastreo en caso de que se guarde el registro                    
						$_POST['RASTREO']['cambio'] = 'Actualiza '.$controlador. ' ID '.$codigo;
						RASTREO();

						echo 0;
					}								
				}else {
					$this->db->trans_rollback();
					$db2->trans_rollback();
					//echo "No se pudieron actualizar los datos.";
					echo 1;
				}
			}else{ 
				if ($CI->CRUD_model_guardar($tabla, $datos)==true) {

					$sql = "INSERT INTO Usuario(CodigoUsuario, Cedula, AplicativoClienteId, Nombre) VALUES('" . $codigo . "', '" . $datos['cedula'] . "', '" . $this->session->userdata('DATAINI')->AplicativoClienteId ."', '" . $datos['nombre'] . "')";

					$db2->query($sql);

					if ($db2->trans_status() == true) {
						$this->db->trans_commit();
						$db2->trans_commit();
						//Rastreo en caso de que se guarde el registro                    
						if($codigo == ''){
							$_POST['RASTREO']['cambio'] = 'Guarda '.$controlador. ' ID '.$CI->db->insert_id();;
						}else{
							$_POST['RASTREO']['cambio'] = 'Guarda '.$controlador. ' ID '.$codigo;
						}
						
						RASTREO();
						
						echo 2;
					} else {
						$this->db->trans_rollback();
						$db2->trans_rollback();
						//echo "No se pudieron guardar los datos.";
						echo 3;
					}
					
				}else {
					$this->db->trans_rollback();
					$db2->trans_rollback();
					//echo "No se pudieron guardar los datos.";
					echo 3;
				}
			} 
		}else{
			show_404();
		}
	}

	function eliminarCRUD($tabla){
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			$codigo = $CI->input->post('codigo');
			$ID = $CI->input->post('ID');
			$NRODOCUMENTO = $CI->input->post('NRODOCUMENTO');
			$controlador = $CI->input->post('controlador');
			$programa = $CI->input->post('programa');

			$integridad = true;

			$datosConexion = array(
				'dsn'	=> '',
				'hostname' => "DEV_GESTION",
				'username' => 'usuario',
				'password' => '123/usuario.*',
				'database' => 'GESTION_CONF_PROSOF',
				'dbdriver' => 'sqlsrv',
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

			$db2 = $this->load->database($datosConexion, TRUE);

			
			if($integridad == true){
				$this->db->trans_begin();
				$db2->trans_begin();

				if ($CI->CRUD_model_eliminar($codigo, $ID, $tabla)==true) {
					
					$sql = "DELETE FROM Usuario WHERE CodigoUsuario = '" . $codigo . "' AND Cedula = '" . $NRODOCUMENTO . "' AND AplicativoClienteId = '" . $this->session->userdata('DATAINI')->AplicativoClienteId . "'";
					
					$db2->query($sql);

					if ($db2->trans_status() == true) {
						$this->db->trans_commit();
						$db2->trans_commit();
	
						$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
						$_POST['RASTREO']['programa'] = $programa;
						$_POST['RASTREO']['cambio'] = 'Elimina '.$controlador.' '.$codigo;
						RASTREO();
	
						echo true;
					} else {
						$this->db->trans_rollback();
						$db2->trans_rollback();
	
						echo false;
					}
					
				} else {
					$this->db->trans_rollback();
					$db2->trans_rollback();

					echo false;
				}
			} else {
				echo false;
			}
		} else {
			show_404();
		}
	}
}
?>