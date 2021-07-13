<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cFichasTecnicas extends CI_Controller { 
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(4, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/FichasTecnicas/mFichasTecnicas'));
	}


	function index(){
		$contenido['titulo'] = 'Fichas Tecnicas';
		$contenido['content_page'] = 'Administrativo/FichasTecnicas/vFichasTecnicas';
		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css' 

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.dataTables.min.css'
			,'chosen/chosen.min.css'

			);
		$contenido['js_lib'] = array(
			'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js' 
			
			,'dataTables/dataTables.scroller.min.js'
			,'dataTables/dataTables.responsive.min.js'
			,'dataTables/dataTables.buttons.min.js'
			,'dataTables/buttons.flash.min.js'
			,'dataTables/jszip.min.js'
			,'dataTables/pdfmake.min.js'
			,'dataTables/vfs_fonts.js'
			,'dataTables/buttons.html5.min.js'
			,'dataTables/buttons.print.min.js'
			
			,'personalizados/jsDataTables.js'
			,'chosen/chosen.jquery.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'
			);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/FichasTecnicas/jsFichasTecnicas2.js'
			,'personalizados/Administrativo/FichasTecnicas/jsVehiculo.js'
			,'personalizados/Administrativo/FichasTecnicas/jsMaquinaria.js'
			,'personalizados/Administrativo/FichasTecnicas/jsComputo.js'
			,'personalizados/Administrativo/FichasTecnicas/jsLocativa.js'

			);

		$this->load->view('UI/gestion_view', $contenido);
	}

	function SelectItemequipo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->SelectItemequipo());
		} else {
			show_404();
		}
	}

	function validarItemequipoEquipo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->validarItemequipoEquipo());
		} else {
			show_404();
		}
	}

	function eliminarDatosFicha(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->eliminarDatosFicha());
		} else {
			show_404();
		}
	}

	function eliminarOperacion(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->eliminarOperacion());
		} else {
			show_404();
		}
	}


	function eliminarElemento(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->eliminarElemento());
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
			echo $this->mFichasTecnicas->actualizar($cliente, $nombre, $value, $tabla);
		} else {
			show_404();
		}
	}

	function eliminar(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->eliminar());
		} else {
			show_404();
		}
	}

	function DatosEquipoFicha(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichasTecnicas->DatosEquipoFicha());
		} else {
			show_404();
		}
	}

	function guardarAnexosEquipoComputo(){

		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->uploadImg());
		}else{
			show_404();
		}
	}

	function obtenerAnexos(){

		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->obtenerAnexos());
		}else{
			show_404();
		}
	}

	function guardarValores(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->guardarValores());
		}else{
			show_404();
		}
	}

	function guardarValoresVehiculo(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->guardarValoresVehiculo());
		}else{
			show_404();
		}
	}

	function actualizarDatos(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->actualizarDatos());
		}else{
			show_404();
		}
	}

	function actualizarDatoSElemento(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->actualizarDatoSElemento());
		}else{
			show_404();
		}
	}

	function cargarDatosTablas(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->cargarDatosTablas());
		}else{
			show_404();
		}
	}

	function cargarDatosTablasVehiculo(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->cargarDatosTablasVehiculo());
		}else{
			show_404();
		}
	}

	function eliminarItemAnexo(){
		
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mFichasTecnicas->eliminarItemAnexo());
		}else{
			show_404();
		}
	}
}
?>