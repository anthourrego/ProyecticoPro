<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class tipoMascota extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1707, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('TipoMascotaId', 'Nombre', "CASE WHEN Estado = 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado "));
		$this->DataTables_model->set_table(array('TipoMascota'));
		$this->DataTables_model->set_column_order(array('TipoMascotaId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('Nombre'));
		$this->DataTables_model->set_order(array('TipoMascotaId' => 'desc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Id','Nombre', 'Estado');
		$contenido['tabla'] 		= 'TipoMascota';
		$contenido['titulo'] 		= 'Tipos de mascotas';
		$contenido['tblNombre'] 	= 'TipoMascota';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Configuración'; */
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Inicio/vTipoMascota';
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