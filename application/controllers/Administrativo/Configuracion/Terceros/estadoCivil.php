<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class EstadoCivil extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1115, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('estadocivilid', 'nombre'));
		$this->DataTables_model->set_table(array('EstadoCivil'));
		$this->DataTables_model->set_column_order(array('estadocivilid', 'nombre'));
		$this->DataTables_model->set_column_search(array('estadocivilid', 'nombre'));
		$this->DataTables_model->set_order(array('estadocivilid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'EstadoCivil';
		$contenido['titulo'] = 'Estados Civiles';
		$contenido['tblNombre'] = 'Estado Civil';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vEstadoCivil';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>