<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cFamilia extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1403, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}


		$this->DataTables_model->set_select(array('FamiliaId','Nombre','Estado',"CASE Estado WHEN 'A' THEN 'Activo'  ELSE 'Inactivo' END AS Estado"
		));
		$this->DataTables_model->set_table(array('Familia'));
		$this->DataTables_model->set_column_order(array('FamiliaId', 'Nombre','Estado'));
		$this->DataTables_model->set_column_search(array('FamiliaId', 'Nombre'));
		$this->DataTables_model->set_order(array('FamiliaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Código', 'Nombre','Estado');
		$contenido['tabla'] 		= 'Familia';
		$contenido['titulo'] 		= 'Familia';
		$contenido['tblNombre'] 	= 'Familia';
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Productos/vFamilia';
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