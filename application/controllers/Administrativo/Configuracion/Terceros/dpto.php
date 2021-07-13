<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dpto extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1107, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('dptoid', 'nombre'));
		$this->DataTables_model->set_table(array('Dpto'));
		$this->DataTables_model->set_column_order(array('dptoid', 'nombre'));
		$this->DataTables_model->set_column_search(array('dptoid', 'nombre'));
		$this->DataTables_model->set_order(array('dptoid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Dpto';
		$contenido['titulo'] = 'Departamentos';
		$contenido['tblNombre'] = 'Departamento';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vDpto';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>