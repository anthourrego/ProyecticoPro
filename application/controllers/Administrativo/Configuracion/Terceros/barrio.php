<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Barrio extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1109, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('barrioid', 'nombre'));
		$this->DataTables_model->set_table(array('barrio'));
		$this->DataTables_model->set_column_order(array('barrioid', 'nombre'));
		$this->DataTables_model->set_column_search(array('barrioid', 'nombre'));
		$this->DataTables_model->set_order(array('barrioid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Barrio';
		$contenido['titulo'] = 'Barrios';
		$contenido['tblNombre'] = 'Barrio';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vBarrio';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>