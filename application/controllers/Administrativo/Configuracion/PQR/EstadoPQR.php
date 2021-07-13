<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class EstadoPQR extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") ||  !in_array(1301, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('EstadoId', 'Nombre', "CASE WHEN Cierre = '1' THEN 'Aplica' ELSE 'No aplica' END Cierre", 'ColorHexa'));
		$this->DataTables_model->set_table(array('EstadoPQR'));
		$this->DataTables_model->set_column_order(array('EstadoId', 'Nombre', 'Cierre', 'ColorHexa'));
		$this->DataTables_model->set_column_search(array('EstadoId', 'Nombre'));
		$this->DataTables_model->set_order(array('EstadoId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre', 'Cierre', 'Color');
		$contenido['tabla'] = 'EstadoPQR';
		$contenido['titulo'] = 'Estado PQR';
		$contenido['tblNombre'] = 'EstadoPQR';
		$contenido['content_page'] = 'Administrativo/Configuracion/PQR/vEstadoPQR';
		$contenido['js_lib'] = array(
			'bootstrap-colorpicker/bootstrap-colorpicker.min.js'
		);
		$contenido['css_lib'] = array(
			'bootstrap-colorpicker/bootstrap-colorpicker.min.css'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/Configuracion/Menu/Inicio/PQR"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
