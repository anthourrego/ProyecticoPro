<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TiposPerfil extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(2004, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('perfilid', 'nombre'));
		$this->DataTables_model->set_table(array('Perfil'));
		$this->DataTables_model->set_column_order(array('perfilid', 'nombre'));
		$this->DataTables_model->set_column_search(array('perfilid', 'nombre'));
		$this->DataTables_model->set_order(array('nombre' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Perfil';
		$contenido['titulo'] = 'Creación de Perfiles';
		$contenido['tblNombre'] = 'Perfil';
		$contenido['content_page'] = 'Administrativo/Utilidades/vTiposPerfil';

		$contenido["breadcrumb"] = [
			["nombre" => "Utilidades", "ruta" => "Administrativo/Utilidades/Menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>