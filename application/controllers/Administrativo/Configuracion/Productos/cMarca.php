<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cMarca extends MY_CRUD_Controller {

	function __construct() { 
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1404, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('marcaid','nombre','estado',"CASE estado WHEN 'A' THEN 'Activo'  ELSE 'Inactivo' END AS estado"
		));
		$this->DataTables_model->set_table(array('Marca'));
		$this->DataTables_model->set_column_order(array('marcaid', 'nombre', 'estado'));
		$this->DataTables_model->set_column_search(array('marcaid', 'nombre'));
		$this->DataTables_model->set_order(array('marcaid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Código', 'Nombre', 'Estado');
		$contenido['tabla'] 		= 'Marca';
		$contenido['titulo'] 		= 'Marca';
		$contenido['tblNombre'] 	= 'Marca';
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Productos/vMarca';
		/* $contenido['hBack'] 		= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 		= 'Incidencias'; */

		$contenido["breadcrumb"] = [
			["nombre" => "Productos", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Productos"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>