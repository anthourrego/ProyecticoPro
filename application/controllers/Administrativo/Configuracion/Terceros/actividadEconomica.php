<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ActividadEconomica extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1112, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('actividadid', 'nombre'));
		$this->DataTables_model->set_table(array('actividad'));
		$this->DataTables_model->set_column_order(array('actividadid', 'nombre'));
		$this->DataTables_model->set_column_search(array('actividadid', 'nombre'));
		$this->DataTables_model->set_order(array('actividadid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'Actividad';
		$contenido['titulo'] = 'Actividades Económicas';
		$contenido['tblNombre'] = 'Actividad Económica';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vActividadEconomica';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>