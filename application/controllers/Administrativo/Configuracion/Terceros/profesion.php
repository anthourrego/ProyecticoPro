<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesion extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1117, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('profesionid', 'nombre'));
		$this->DataTables_model->set_table(array('Profesion'));
		$this->DataTables_model->set_column_order(array('profesionid', 'nombre'));
		$this->DataTables_model->set_column_search(array('profesionid', 'nombre'));
		$this->DataTables_model->set_order(array('profesionid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Profesion';
		$contenido['titulo'] = 'Profesiones';
		$contenido['tblNombre'] = 'Profesión';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vProfesion';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>