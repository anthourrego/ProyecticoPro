<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cEquipo extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1405, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Configuracion/Productos/mEquipo'));
	}

	function index(){
		$contenido['titulo'] = 'Equipo';
		$contenido['content_page'] = 'Administrativo/Configuracion/Productos/vEquipo';
		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.dataTables.min.css'
		);
		$contenido['js_lib'] = array(
			'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'

			,'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js'
			,'dataTables/dataTables.scroller.min.js'
			,'dataTables/dataTables.buttons.min.js'
			,'dataTables/buttons.flash.min.js'
			,'dataTables/jszip.min.js'
			,'dataTables/pdfmake.min.js'
			,'dataTables/vfs_fonts.js'
			,'dataTables/buttons.html5.min.js'
			,'dataTables/buttons.print.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
		);
		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Configuracion/Productos/jsEquipo.js'
		);

		$contenido['familia'] 	= $this->mEquipo->familia();
		$contenido['marca']   	= $this->mEquipo->marca();
		$_POST['TerceroID'] 	= '';
		$_POST['btn'] 			= 'btnFastBackward';
		/* $contenido['hBack'] 	= 'Administrativo/Configuracion/Menu';
		$contenido['txtBack'] 	= 'Incidencias'; */

		$contenido["breadcrumb"] = [
			["nombre" => "Productos", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Productos"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$this->load->view('UI/gestion_view', $contenido);
	}

	function exportar(){
		$contenido['content_page'] = 'Administrativo/Configuracion/Productos/vExportarEquipo';
		$contenido['titulo'] = 'Productos';

		$contenido['css_lib'] = array(
			'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.dataTables.min.css'
		);
		$contenido['js_lib'] = array(
			'dataTables/jquery.dataTables.min.js'
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
			,'inputmask/jquery.inputmask.bundle.min.js'
		);
		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Configuracion/Productos/jsExportarEquipo.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Productos", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Productos"]
			,["nombre" => "Equipo", "ruta" => "Administrativo/Configuracion/Productos/cEquipo"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function cargar(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEquipo->cargar());
		} else {
			show_404();
		}
	}

	function registrar(){
		if ($this->input->is_ajax_request()) {
			echo $this->mEquipo->registrar();
		} else {
			show_404();
		}
	}

	function actualizar() {
		if ($this->input->is_ajax_request()) {
			$cliente = $this->input->post('cliente');
			$nombre = $this->input->post('nombre');
			$value = $this->input->post('value');
			$tabla = $this->input->post('tabla');
			echo $this->mEquipo->actualizar($cliente, $nombre, $value, $tabla);
		} else {
			show_404();
		}
	}

	function cargarForanea(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEquipo->cargarForanea());
		}else{
			show_404();
		}
	}

	// function qActividadesOperarioCP(){
	// 	if ($this->input->is_ajax_request()) {
	// 		echo '{"data":'.json_encode($this->mEquipo->qActividadesOperarioCP())."}";
	// 	}else{
	// 		show_404();
	// 	}
	// }

	// function qActividadesOperarioAC(){
	// 	if ($this->input->is_ajax_request()) {
	// 		echo '{"data":'.json_encode($this->mEquipo->qActividadesOperarioAC())."}";
	// 	}else{
	// 		show_404();
	// 	}
	// }

	function actualizarImagen(){
		if ($this->input->is_ajax_request()) {
			echo $this->mEquipo->actualizarImagen();
		} else {
			show_404();
		}
	}

	function listaClientes(){
		if ($this->input->is_ajax_request()) {
			echo $this->mEquipo->listaClientes();
		} else {
			show_404();
		}
	}

	function EliminarEquipo(){
		if ($this->input->is_ajax_request()) {
			echo $this->mEquipo->EliminarEquipo();
		} else {
			show_404();
		}
	}

	function cargarCRUD(){
		if ($this->input->is_ajax_request()) {
			$tabla = $this->input->post('tabla');
			$codigo = $this->input->post('codigo');
			$cliente = $this->input->post('cliente');
			$nombreCodigo = $this->input->post('nombreCodigo');
			echo $this->mEquipo->cargarCRUD($tabla, $codigo, $cliente, $nombreCodigo);
		} else {
			show_404();
		}
	}

	function eliminarCRUD(){
		if ($this->input->is_ajax_request()) {
			$tabla = $this->input->post('tabla');
			$codigo = $this->input->post('codigo');
			$cliente = $this->input->post('cliente');
			$nombreCodigo = $this->input->post('nombreCodigo');
			echo json_encode($this->mEquipo->eliminarCRUD($tabla, $codigo, $cliente, $nombreCodigo));
		} else {
			show_404();
		}
	}

	function GuardarCP(){
		if ($this->input->is_ajax_request()) {
			echo $this->mEquipo->GuardarCP();
		} else {
			show_404();
		}
	}

	function GuardarAC(){
		if ($this->input->is_ajax_request()) {
			echo $this->mEquipo->GuardarAC();
		} else {
			show_404();
		}
	}
}

?>