<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class SectorEconomico extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1114, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('sectorid', 'nombre'));
		$this->DataTables_model->set_table(array('Sector'));
		$this->DataTables_model->set_column_order(array('sectorid', 'nombre'));
		$this->DataTables_model->set_column_search(array('sectorid', 'nombre'));
		$this->DataTables_model->set_order(array('sectorid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Sector';
		$contenido['titulo'] = 'Sectores Económicos';
		$contenido['tblNombre'] = 'Sector Económico';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vSectorEconomico';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];


		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>