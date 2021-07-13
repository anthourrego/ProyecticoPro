<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Zona extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1110, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('zonaid', 'nombre'));
		$this->DataTables_model->set_table(array('zona'));
		$this->DataTables_model->set_column_order(array('zonaid', 'nombre'));
		$this->DataTables_model->set_column_search(array('zonaid', 'nombre'));
		$this->DataTables_model->set_order(array('zonaid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Zona';
		$contenido['titulo'] = 'Zonas';
		$contenido['tblNombre'] = 'Zona';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vZona';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>