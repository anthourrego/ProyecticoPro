<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class CampoAdicional extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1104, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array(
			'crmtablaid'
			,'nombre'
			,"CASE tipo WHEN 'L' THEN 'Lista Selección' WHEN 'A' THEN 'Abierto' ELSE tipo END AS tipo"
		));
		$this->DataTables_model->set_table(array('CRMTablas'));
		$this->DataTables_model->set_column_order(array(
			'crmtablaid'
			,'nombre'
			,'tipo'
		));
		$this->DataTables_model->set_column_search(array('crmtablaid', 'nombre'));
		$this->DataTables_model->set_order(array('crmtablaid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Tipo');
		$contenido['tabla'] = 'CRMTablas';
		$contenido['titulo'] = 'Definición de Datos Adicionales para Terceros';
		$contenido['tblNombre'] = 'Campo Adicional';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vCampoAdicional';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>