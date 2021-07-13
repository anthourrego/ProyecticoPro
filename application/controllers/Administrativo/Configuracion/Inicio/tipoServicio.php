<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class tipoServicio extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1706, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('TipoServicioId', 'Nombre', "CASE WHEN Estado = 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado "));
		$this->DataTables_model->set_table(array('TipoServicio'));
		$this->DataTables_model->set_column_order(array('TipoServicioId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('Nombre'));
		$this->DataTables_model->set_order(array('TipoServicioId' => 'desc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Id','Nombre', 'Estado');
		$contenido['tabla'] 		= 'TipoServicio';
		$contenido['titulo'] 		= 'Tipos de servicios';
		$contenido['tblNombre'] 	= 'TipoServicio';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Configuración'; */
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Inicio/vTipoServicio';
		$contenido['js_lib'] = array(
			'chosen/chosen.jquery.min.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Configuración", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Configuracion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>