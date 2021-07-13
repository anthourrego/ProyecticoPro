<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TipoReunion extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1801, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('TipoReunionId', 'Nombre', "CASE Estado WHEN 'A' THEN 'Activo' WHEN 'I' THEN 'Inactivo' END AS Estado "));
		$this->DataTables_model->set_table(array('TipoReunion'));
		$this->DataTables_model->set_column_order(array('TipoReunionId', 'Nombre', 'Estado'));
		$this->DataTables_model->set_column_search(array('TipoReunionId', 'Nombre'));
		$this->DataTables_model->set_order(array('TipoReunionId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Estado');
		$contenido['tabla'] = 'TipoReunion';
		$contenido['titulo'] = 'Tipo Reunión';
		$contenido['tblNombre'] = 'TipoReunion';
		$contenido['content_page'] = 'Administrativo/Configuracion/Actas/vTipoReunion';

		$contenido["breadcrumb"] = [
			["nombre" => "Actas", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Actas"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];


		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
