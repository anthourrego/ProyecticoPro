<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class CcentroCosto extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1401, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('centcostid', 'nombre'));
		$this->DataTables_model->set_table(array('CentCost'));
		$this->DataTables_model->set_column_order(array('centcostid', 'nombre'));
		$this->DataTables_model->set_column_search(array('centcostid', 'nombre'));
		$this->DataTables_model->set_order(array('centcostid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Código', 'Nombre');
		$contenido['tabla'] 		= 'CentCost';
		$contenido['titulo'] 		= 'Centro Costo';
		$contenido['tblNombre'] 	= 'CentCost';
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Productos/vCentCost';
		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>