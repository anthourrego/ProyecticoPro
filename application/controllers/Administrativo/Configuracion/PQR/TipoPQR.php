<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TipoPQR extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") ||  !in_array(1302, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('TipoPQRId', 'Nombre'));
		$this->DataTables_model->set_table(array('TipoPQR'));
		$this->DataTables_model->set_column_order(array('TipoPQRId', 'Nombre'));
		$this->DataTables_model->set_column_search(array('TipoPQRId', 'Nombre'));
		$this->DataTables_model->set_order(array('TipoPQRId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre');
		$contenido['tabla'] = 'TipoPQR';
		$contenido['titulo'] = 'Tipo PQR';
		$contenido['tblNombre'] = 'TipoPQR';
		$contenido['content_page'] = 'Administrativo/Configuracion/PQR/vTipoPQR';

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/Configuracion/Menu/Inicio/PQR"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
