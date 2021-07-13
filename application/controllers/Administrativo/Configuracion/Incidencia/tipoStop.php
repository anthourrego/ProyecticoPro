<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class tipoStop extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1505, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('TipoStopId', 'Nombre', "CASE WHEN Estado = 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado "));
		$this->DataTables_model->set_table(array('TipoStop'));
		$this->DataTables_model->set_column_order(array('TipoStopId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('Nombre'));
		$this->DataTables_model->set_order(array('TipoStopId' => 'desc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Id','Nombre', 'Estado');
		$contenido['tabla'] 		= 'TipoStop';
		$contenido['titulo'] 		= 'Tipos de stop';
		$contenido['tblNombre'] 	= 'TipoStop';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Configuración'; */
		
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Incidencia/vTipoStop';
		$contenido['js_lib'] = array(
			'chosen/chosen.jquery.min.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Incidencias", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Incidencias"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>