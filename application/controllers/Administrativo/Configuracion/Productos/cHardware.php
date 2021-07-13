<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cHardware extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1406, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('HardwareId', 'Nombre'));
		$this->DataTables_model->set_table(array('Hardware'));
		$this->DataTables_model->set_column_order(array('HardwareId', 'Nombre'));
		$this->DataTables_model->set_column_search(array('HardwareId', 'Nombre'));
		$this->DataTables_model->set_order(array('HardwareId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Código', 'Nombre');
		$contenido['tabla'] 		= 'Hardware';
		$contenido['titulo'] 		= 'Hardware';
		$contenido['tblNombre'] 	= 'Hardware';
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Productos/vHardware';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Incidencias'; */

		$contenido["breadcrumb"] = [
			["nombre" => "Productos", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Productos"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>