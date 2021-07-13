<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ActividadesProduccion extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1602, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('ActividadProduccionid', 'nombre', 'estado'));
		$this->DataTables_model->set_table(array('ActividadProduccion'));
		$this->DataTables_model->set_column_order(array('ActividadProduccionid', 'nombre', 'estado'));
		$this->DataTables_model->set_column_search(array('ActividadProduccionid', 'nombre'));
		$this->DataTables_model->set_order(array('ActividadProduccionid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Estado');
		$contenido['tabla'] = 'ActividadProduccion';
		$contenido['titulo'] = 'Actividades de Servicio';
		$contenido['tblNombre'] = 'Actividad de Servicio';
		$contenido['content_page'] = 'Administrativo/Configuracion/ParametrosProduccion/vActividadesProduccion';

		$contenido["breadcrumb"] = [
			["nombre" => "Parámetros de producción", "ruta" => "Administrativo/Configuracion/Menu/Inicio/ParametrosProduccion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>