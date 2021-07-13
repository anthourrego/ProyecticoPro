<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class SeccionPQR extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") /*||  !in_array(1402, $this->session->userdata('SEGUR')) */){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('CausaPQRId', 'Nombre'));
		$this->DataTables_model->set_table(array('CausaPQR'));
		$this->DataTables_model->set_where(array(
			["Tipo = 'S'"]
		));
		$this->DataTables_model->set_column_order(array('CausaPQRId', 'Nombre'));
		$this->DataTables_model->set_column_search(array('CausaPQRId', 'Nombre'));
		$this->DataTables_model->set_order(array('CausaPQRId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre');
		$contenido['tabla'] = 'CausaPQR';
		$contenido['titulo'] = 'Sección PQR';
		$contenido['tblNombre'] = 'CausaPQR';
		$contenido['content_page'] = 'Administrativo/PQR/vSeccionPQR';

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/Configuracion/Menu/Inicio/PQR"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
