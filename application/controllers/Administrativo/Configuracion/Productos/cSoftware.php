<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cSoftware extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1407, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('SoftwareId', 'Nombre','Version'));
		$this->DataTables_model->set_table(array('Software'));
		$this->DataTables_model->set_column_order(array('SoftwareId', 'Nombre','Version'));
		$this->DataTables_model->set_column_search(array('SoftwareId', 'Nombre','Version'));
		$this->DataTables_model->set_order(array('SoftwareId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Código', 'Nombre','Version');
		$contenido['tabla'] 		= 'Software';
		$contenido['titulo'] 		= 'Software';
		$contenido['tblNombre'] 	= 'Software';
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Productos/vSoftware';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Incidencias';
 */
		$contenido["breadcrumb"] = [
			["nombre" => "Productos", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Productos"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>