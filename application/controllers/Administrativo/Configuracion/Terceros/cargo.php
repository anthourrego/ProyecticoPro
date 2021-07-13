<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1116, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('cargoid', 'nombre'));
		$this->DataTables_model->set_table(array('Cargo'));
		$this->DataTables_model->set_column_order(array('cargoid', 'nombre'));
		$this->DataTables_model->set_column_search(array('cargoid', 'nombre'));
		$this->DataTables_model->set_order(array('cargoid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Cargo';
		$contenido['titulo'] = 'Cargos';
		$contenido['tblNombre'] = 'Cargo';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vCargos';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>