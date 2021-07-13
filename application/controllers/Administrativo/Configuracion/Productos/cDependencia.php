<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cDependencia extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1402, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('D.DependenciaId'
			,'D.Nombre'
			,'C.nombre AS CentroCosto'));
		$this->DataTables_model->set_table(array('Dependencia D'));
		$this->DataTables_model->set_joins(array(array('CentCost C', 'D.CentCostId = C.centcostId', 'left')));
		$this->DataTables_model->set_column_order(array('DependenciaId', 'Nombre', 'CentroCosto'));
		$this->DataTables_model->set_column_search(array('C.DependenciaId', 'C.Nombre'));
		$this->DataTables_model->set_order(array('DependenciaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Dependenciaid', 'Nombre', 'Centro Costo');
		$contenido['tabla'] = 'Dependencia';
		$contenido['titulo'] = 'Dependencia';
		$contenido['tblNombre'] = 'Dependencia';
		$contenido['CentCost'] = $this->db->query("SELECT CentCostId, nombre FROM CentCost ORDER BY nombre ASC")->result();
		$contenido['content_page'] = 'Administrativo/Configuracion/Productos/vDependencia';
		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>