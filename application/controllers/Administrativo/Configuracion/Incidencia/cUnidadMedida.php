<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cUnidadMedida extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1504, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('UnidadMedidaId', 'Nombre',
			"CASE WHEN Estado = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END Estado"
			));
		$this->DataTables_model->set_table(array('UnidadMedida'));
		$this->DataTables_model->set_column_order(array('UnidadMedidaId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('UnidadMedidaId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_order(array('UnidadMedidaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre','Estado');
		$contenido['tabla'] = 'UnidadMedida';
		$contenido['titulo'] = 'Unidades de Medida';
		$contenido['tblNombre'] = 'UnidadMedida';
		$contenido['content_page'] = 'Administrativo/Configuracion/Incidencia/vUnidadMedida';

		$contenido["breadcrumb"] = [
			["nombre" => "Incidencias", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Incidencias"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
