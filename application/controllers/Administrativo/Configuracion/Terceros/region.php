<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1111, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('regionid', 'nombre'));
		$this->DataTables_model->set_table(array('region'));
		$this->DataTables_model->set_column_order(array('regionid', 'nombre'));
		$this->DataTables_model->set_column_search(array('regionid', 'nombre'));
		$this->DataTables_model->set_order(array('regionid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Region';
		$contenido['titulo'] = 'Regiones';
		$contenido['tblNombre'] = 'Región';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vRegion';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>