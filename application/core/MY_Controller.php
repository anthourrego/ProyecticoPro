<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
}

class MY_CRUD_Controller extends MY_Controller {

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('DataTables_model'));
	}

	function dataTableSSCRUD() {
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			if(isset($_POST['order'])){
				$_POST['order']['0']['column']--;
			}
			$list = $CI->DataTables_model->get_datatables();
			$columnas = $CI->DataTables_model->column_order;
			$data = array();
			foreach ($list as $query) {
				$row = array();

				$row[] = "";
				// Almacena en array las columnas a mostrar
				foreach ($columnas as $columna) {
					$row[] = $query->$columna;
				}

				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $CI->DataTables_model->count_all(),
				"recordsFiltered" => $CI->DataTables_model->count_filtered(),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}else{
			show_404();
		}
	}

	function guardarCRUD($tabla) {
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			$datos = $CI->input->post('data');

			if(count($datos) > 0){
				foreach ($datos as $key => $value) {
					$datos[$key] = (trim($value) == '' ? null : trim($value));
				}
			}

			$codigo = trim($CI->input->post('codigo'));
			$ID = trim($CI->input->post('ID'));
			$controlador = trim($CI->input->post('controlador'));
			$programa = trim($CI->input->post('programa'));

			$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
			$_POST['RASTREO']['programa'] = $programa;

			if ($CI->CRUD_model_validarRegistro($codigo, $ID, $tabla)) {
				if ($CI->CRUD_model_actualizar($codigo, $datos, $ID, $tabla)) {

					$dataoriginal = $CI->input->post('dataoriginal');

					if($dataoriginal == null){
						$dataoriginal = array();
					}

					$nombrecampos = $CI->input->post('nombrecampos');

					$strCambio = 'Cambia';
					if(count($datos) > 0){
						foreach ($datos as $key => $value) {
							if(!array_key_exists($key, $dataoriginal)){
								$dataoriginal[$key] = '';	
							}
							$strCambio .= ' ' . $nombrecampos[$key] . ' ' . $dataoriginal[$key] .' -> '.$datos[$key];
						}
					}
					
					//Rastreo en caso de que se guarde el registro                    
					$_POST['RASTREO']['cambio'] = 'Modifica '.$controlador.' '.$codigo.' '.$strCambio;
					RASTREO();

					echo 0;
				}else {
					//echo "No se pudieron actualizar los datos.";
					echo 1;
				}
			}else{
				if ($CI->CRUD_model_guardar($tabla, $datos)) {
					
					//Rastreo en caso de que se guarde el registro                    
					if($codigo == ''){
						$_POST['RASTREO']['cambio'] = 'Crea '.$controlador.' '.$CI->db->insert_id();
					}else{
						$_POST['RASTREO']['cambio'] = 'Crea '.$controlador.' '.$codigo;
					}
					RASTREO();
					
					echo 2;
				}else {
					//echo "No se pudieron guardar los datos.";
					echo 3;
				}
			}
		}else{
			show_404();
		}
	}

	function cargarCRUD($tabla) {
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			$codigo = $CI->input->post('codigo');
			$ID = $CI->input->post('ID');
			$datos = $CI->CRUD_model_cargar($codigo, $ID, $tabla);
			echo json_encode($datos);
		}else{
			show_404();
		}
	}

	function eliminarCRUD($tabla) {
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			$codigo = $CI->input->post('codigo');
			$ID = $CI->input->post('ID');
			$controlador = $CI->input->post('controlador');
			$programa = $CI->input->post('programa');
			// 30/01/2018 JCSM - Validaciones personalizadas antes de eliminar
			$integridad = true;

			if($integridad == true){
				if ($CI->CRUD_model_eliminar($codigo, $ID, $tabla)==true) {

					//Rastreo en caso de que se elimine el registro
					$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
					$_POST['RASTREO']['programa'] = $programa;
					$_POST['RASTREO']['cambio'] = 'Elimina '.$controlador.' '.$codigo;
					RASTREO();

					echo true;
				}
				else {
					echo false;
				}
			}else{
				echo false;
			}
		}else{
			show_404();
		}
	}

	// 16/08/2017 JCSM - Modelo que permite obtener un registro específico
	function CRUD_model_cargar($valor, $key, $tabla) {
		$CI = & get_instance();
		$CI->db->where($key, $valor);
		$consulta = $CI->db->get($tabla);
		return $consulta->result();
	}

	// 20/08/2017 JCSM - Validación para cargar o actualizar un registro
	function CRUD_model_validarRegistro($registro, $key, $tabla) {
		$CI = & get_instance();
		$CI->db->where($key, $registro);
		$resultados = $CI->db->get($tabla);
		if ($resultados->num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	// 16/08/2017 JCSM - Modelo generalizado para actualizar un registro en una tabla
	function CRUD_model_actualizar($id, $data, $key, $tabla) {
		$CI = & get_instance();
		$CI->db->where($key,$id);
		$CI->db->update($tabla,$data);

		if ($CI->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// 16/08/2017 JCSM - Modelo generalizado para guardar un registro en una tabla
	function CRUD_model_guardar($tabla, $data) {
		$CI = & get_instance();
		$CI->db->insert($tabla ,$data);

		if ($CI->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// 16/08/2017 JCSM - Modelo generalizado para eliminar un registro de una tabla
	function CRUD_model_eliminar($id, $key, $tabla) {
		$CI = & get_instance();
		$CI->db->where($key,$id);
		$CI->db->delete($tabla);

		if ($CI->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>