<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TipoTercero extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1103, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array(
			'tipotercid'
			,'nombre'
			,'Cliente'
			,'Proveedor'
			,'empleado'
			,'porcelunes'
			,'porcemarte'
			,'porcemierc'
			,'porcejueve'
			,'porceviern'
			,'porcesabad'
			,'porcedomin'
			,'DescuentoMax'
		));
		$this->DataTables_model->set_table(array('TipoTerc'));
		$this->DataTables_model->set_column_order(array(
			'tipotercid'
			,'nombre'
			,'Cliente'
			,'Proveedor'
			,'empleado'
			,'porcelunes'
			,'porcemarte'
			,'porcemierc'
			,'porcejueve'
			,'porceviern'
			,'porcesabad'
			,'porcedomin'
			,'DescuentoMax'
		));
		$this->DataTables_model->set_column_search(array('tipotercid', 'nombre'));
		$this->DataTables_model->set_order(array('tipotercid' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array(
			'Código'
			,'Nombre'
			,'Cliente'
			,'Proveedor'
			,'Empleado'
			,'Lunes'
			,'Martes'
			,'Miércoles'
			,'Jueves'
			,'Viernes'
			,'Sábado'
			,'Domingo'
		);
		$contenido['tabla'] = 'TipoTerc';
		$contenido['titulo'] = 'Tipos de Tercero';
		$contenido['tblNombre'] = 'Tipo de Tercero';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vTipoTerc';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>