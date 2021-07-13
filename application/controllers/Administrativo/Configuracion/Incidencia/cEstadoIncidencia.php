<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cEstadoIncidencia extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") ||  !in_array(1501, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('EstadoIncidenciaId', 'Nombre', "CASE WHEN Cierre = '1' THEN 'Aplica' ELSE 'No aplica' END Cierre", 
			"CASE WHEN CierreApp = '1' THEN 'Aplica' ELSE 'No aplica' END CierreApp",'ColorHexa'));
		$this->DataTables_model->set_table(array('EstadoIncidencia'));
		$this->DataTables_model->set_column_order(array('EstadoIncidenciaId', 'Nombre', 'Cierre', 'CierreApp', 'ColorHexa'));
		$this->DataTables_model->set_column_search(array('EstadoIncidenciaId', 'Nombre'));
		$this->DataTables_model->set_order(array('EstadoIncidenciaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre', 'Cierre', 'CierreApp', 'Color');
		$contenido['tabla'] = 'EstadoIncidencia';
		$contenido['titulo'] = 'Estado Incidencia';
		$contenido['tblNombre'] = 'EstadoIncidencia';
		$contenido['content_page'] = 'Administrativo/Configuracion/Incidencia/vEstadoIncidencia';
		$contenido['js_lib'] = array(
			'bootstrap-colorpicker/bootstrap-colorpicker.min.js'
		);
		$contenido['css_lib'] = array(
			'bootstrap-colorpicker/bootstrap-colorpicker.min.css'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Incidencias", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Incidencias"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
