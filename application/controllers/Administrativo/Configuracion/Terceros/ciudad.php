<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudad extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1108, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array('C.CiudadId'
			,'C.Nombre'
			,'D.Nombre AS Dpto'));
		$this->DataTables_model->set_table(array('Ciudad C'));
		$this->DataTables_model->set_joins(array(array('Dpto D', 'C.dptoid = D.dptoid', 'left')));
		$this->DataTables_model->set_column_order(array('CiudadId', 'Nombre', 'Dpto'));
		$this->DataTables_model->set_column_search(array('C.CiudadId', 'C.Nombre'));
		$this->DataTables_model->set_order(array('CiudadId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Departamento');
		$contenido['tabla'] = 'Ciudad';
		$contenido['titulo'] = 'Ciudades';
		$contenido['tblNombre'] = 'Ciudad';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vCiudad';
		$contenido['Departamentos'] = $this->db->query("SELECT dptoid, nombre FROM Dpto ORDER BY Nombre ASC")->result();
		$contenido['js_lib'] = array(
			'chosen/chosen.jquery.min.js'
		);
		$contenido['css_lib'] = array(
			'chosen/chosen.min.css'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>