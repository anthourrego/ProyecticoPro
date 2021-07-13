<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ItemCampoAdicional extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1104, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}
	}

	function index() {
		if(isset($_GET['crmtablaid'])){
			$contenido['columnas'] = array('Código', 'Nombre');
			$contenido['tabla'] =  'CRMDatos';
			$contenido['titulo'] = $_GET['nombre'].' - Ítems de Selección';
			$contenido['tblNombre'] = 'Ítem Campo Adicional '.$_GET['crmtablaid'];
			$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vItemCampoAdicional';

			$contenido["breadcrumb"] = [
				["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
				,["nombre" => "Definición de Datos Adicionales para Terceros", "ruta" => "Administrativo/Configuracion/Terceros/CampoAdicional"]
				,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
			];

			$this->load->view('UI/CRUD_view', $contenido);
		}else{
			redirect(base_url().'Administrativo/Configuracion/Terceros/CampoAdicional');
		}
	}

	function dataTableSSCRUD() {
		$CI = & get_instance();
		if ($CI->input->is_ajax_request()) {
			$this->DataTables_model->set_select(array('crmdatoid', 'nombre', 'crmtablaid'));
			$this->DataTables_model->set_table(array('CRMDatos'));
			if($_POST['crmtablaid'] != null){
				$this->DataTables_model->set_where([["crmtablaid", $_POST['crmtablaid']]]);
			}
			$this->DataTables_model->set_column_order(array('crmdatoid', 'nombre', 'crmtablaid'));
			$this->DataTables_model->set_column_search(array('crmdatoid', 'nombre'));
			$this->DataTables_model->set_order(array('crmdatoid' => 'asc'));

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
}
?>