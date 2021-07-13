<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cTipoIncidencia extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") ||  !in_array(1502, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('TipoIncidenciaId', 'Nombre',
			"CASE WHEN Estado = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END Estado"
			));
		$this->DataTables_model->set_table(array('TipoIncidencia'));
		$this->DataTables_model->set_column_order(array('TipoIncidenciaId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('TipoIncidenciaId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_order(array('TipoIncidenciaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre','Estado');
		$contenido['tabla'] = 'TipoIncidencia';
		$contenido['titulo'] = 'Tipo Incidencia';
		$contenido['tblNombre'] = 'TipoIncidencia';
		$contenido['content_page'] = 'Administrativo/Configuracion/Incidencia/vTipoIncidencia';

		$contenido["breadcrumb"] = [
			["nombre" => "Incidencias", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Incidencias"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
