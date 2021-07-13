<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ResponsabilidadFiscal extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1201, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('RespoFiscaId', 'Nombre'));
		$this->DataTables_model->set_table(array('ResponsabilidadFiscal'));
		$this->DataTables_model->set_column_order(array('RespoFiscaId', 'Nombre'));
		$this->DataTables_model->set_column_search(array('RespoFiscaId', 'Nombre'));
		$this->DataTables_model->set_order(array('RespoFiscaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre');
		$contenido['tabla'] = 'ResponsabilidadFiscal';
		$contenido['titulo'] = 'Responsabilidad Fiscal';
		$contenido['tblNombre'] = 'Responsabilidad Fiscal';
		$contenido['content_page'] = 'Administrativo/Configuracion/ParametrosFacturacionCartera/vResponsabilidadFiscal';

		$contenido["breadcrumb"] = [
			["nombre" => "Parámetros de facturación y cartera", "ruta" => "Administrativo/Configuracion/Menu/Inicio/ParametrosFacturacionCartera"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>