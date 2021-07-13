<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class tipoVehiculo extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1705, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('TipoVehiculoId', 'Nombre', "CASE WHEN Estado = 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado "));
		$this->DataTables_model->set_table(array('TipoVehiculo'));
		$this->DataTables_model->set_column_order(array('TipoVehiculoId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('Nombre'));
		$this->DataTables_model->set_order(array('TipoVehiculoId' => 'desc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Id','Nombre', 'Estado');
		$contenido['tabla'] 		= 'TipoVehiculo';
		$contenido['titulo'] 		= 'Tipos de vehiculos';
		$contenido['tblNombre'] 	= 'TipoVehiculo';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Configuración'; */
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Inicio/vTipoVehiculo';

		$contenido["breadcrumb"] = [
			["nombre" => "Configuración", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Configuracion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>