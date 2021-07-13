<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cInventario extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1408, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Configuracion/Productos/mInventario'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Configuracion/Productos/vInventario';
		$contenido['titulo'] = "Inventario de equipos";

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'

			,'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js'
			,'dataTables/dataTables.scroller.min.js'
			,'dataTables/dataTables.buttons.min.js'
			,'dataTables/buttons.flash.min.js'
			,'dataTables/jszip.min.js'
			,'dataTables/pdfmake.min.js'
			,'dataTables/vfs_fonts.js'
			,'dataTables/buttons.bootstrap4.min.js'
			,'dataTables/buttons.html5.min.js'
			,'dataTables/buttons.print.min.js'

			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Configuracion/Productos/jsInventario.js'
		);

		/* $contenido['hBack'] 	= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 	= 'Incidencias'; */

		$contenido["breadcrumb"] = [
			["nombre" => "Productos", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Productos"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$contenido['selectProveedor'] 	= $this->mInventario->selectProveedor();
		$contenido['selectPais'] 		= $this->mInventario->selectPais();
		$contenido['selectEquipo'] 		= $this->mInventario->selectEquipo();
		$contenido['selectDependencia'] = $this->selectDependencia();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function selectEquipo(){
		return json_encode($this->mInventario->selectEquipo());
	}

	function selectProveedor(){
		return json_encode($this->mInventario->selectProveedor());
	}
	function selectEmpleado(){
		return json_encode($this->mInventario->selectEmpleado());
	}
	function selectPais(){
		return json_encode($this->mInventario->selectPais());
	}
	function selectSeccion(){
		return json_encode($this->mInventario->selectSeccion());
	}
	function selectEstado(){
		return json_encode($this->mInventario->selectEstado());
	}
	function selectTipo(){
		return json_encode($this->mInventario->selectTipo());
	}
	function selectCiudad(){
		return json_encode($this->mInventario->selectCiudad());
	}

	function selectDependencia(){
		return json_encode($this->mInventario->selectDependencia());
	}


	function GuardarIt(){
		if ($this->input->is_ajax_request()) {
			echo $this->mInventario->GuardarIt();
		} else {
			show_404();
		}
	}

	function eliminarA(){
		if ($this->input->is_ajax_request()) {
			echo $this->mInventario->eliminarA();
		} else {
			show_404();
		}
	}

	function validarSerial(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mInventario->validarSerial());
		} else {
			show_404();
		}
	}

	function obtenerInventario(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mInventario->obtenerInventario());
		} else {
			show_404();
		}
	}

	function modalInventario(){
		$contenido['selectProveedor'] = $this->mInventario->selectProveedor();
		$contenido['selectPais'] = $this->mInventario->selectPais();
		$contenido['selectEquipo'] = $this->mInventario->selectEquipo();
		$contenido['selectDependencia'] = $this->selectDependencia();

		$this->load->view('Administrativo/Configuracion/Productos/vModalInventario',$contenido);

	}


}

?>