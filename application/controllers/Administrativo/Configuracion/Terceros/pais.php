<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pais extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1106, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('paisid', 'nombre'));
		$this->DataTables_model->set_table(array('pais'));
		$this->DataTables_model->set_column_order(array('paisid', 'nombre'));
		$this->DataTables_model->set_column_search(array('paisid', 'nombre'));
		$this->DataTables_model->set_order(array('paisid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Pais';
		$contenido['titulo'] = 'Países';
		$contenido['tblNombre'] = 'País';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vPais';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>