<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class CentrosProduccion extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1601, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('centroproduccionid', 'nombre', 'estado'));
		$this->DataTables_model->set_table(array('CentroProduccion'));
		$this->DataTables_model->set_column_order(array('centroproduccionid', 'nombre', 'estado'));
		$this->DataTables_model->set_column_search(array('centroproduccionid', 'nombre'));
		$this->DataTables_model->set_order(array('centroproduccionid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Estado');
		$contenido['tabla'] = 'CentroProduccion';
		$contenido['titulo'] = 'Áreas de Servicio';
		$contenido['tblNombre'] = 'Área de Servicio';
		$contenido['content_page'] = 'Administrativo/Configuracion/ParametrosProduccion/vCentrosProduccion';

		$contenido["breadcrumb"] = [
			["nombre" => "Parámetros de producción", "ruta" => "Administrativo/Configuracion/Menu/Inicio/ParametrosProduccion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>