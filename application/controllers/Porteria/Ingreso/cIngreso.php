<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cIngreso extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Porteria/Ingreso/mIngreso'));
	}

	function index(){
		$contenido['content_page'] = 'Porteria/Ingreso/vIngreso';
		$contenido['titulo'] = 'Ingresos';
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
			
			,'personalizados/jsDataTables.js'
			,'chosen/chosen.jquery.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'
		);
		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
			
			,'chosen/chosen.min.css
		');
		$contenido['script_adicional'] = array(
			'personalizados/Porteria/Ingreso/jsIngreso.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$contenido['Residentes'] 	= $this->mIngreso->obtenerResidente();
		$contenido['Vivienda'] 		= $this->mIngreso->obtenerVivienda();
		$contenido['TipoVehi'] 		= $this->mIngreso->obtenerTipoVehiculo();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function obtenerTercero(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->obtenerTercero());
		}else{
			show_404();
		}
	}

	function obtenerNumDocu(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->obtenerNumDocu());
		}else{
			show_404();
		}
	}

	function qHistorico(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mIngreso->qHistorico())."}";
		}else{
			show_404();
		}
	}

	function qProgramado(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mIngreso->qProgramado())."}";
		}else{
			show_404();
		}
	}

	function guardarIngreso(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->guardarIngreso());
		}else{
			show_404();
		}
	}

	function obtenerData(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->obtenerData());
		}else{
			show_404();
		}
	}

	function obtenerZonas(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->obtenerZonas());
		}else{
			show_404();
		}
	}

	function obtenerDataZona(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->obtenerDataZona());
		}else{
			show_404();
		}
	}

	function modalData(){
		//$contenido['TipoVivienda'] 	= $this->db->query("SELECT TipoViviendaId As id,nombre FROM TipoVivienda WHERE Estado = 'A'")->result();
		$this->load->view('Porteria/Ingreso/vModalIngreso');
	}

	function verificaPlaca(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->verificaPlaca());
		}else{
			show_404();
		}
	}

	function guardarIngresoResidente(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->guardarIngresoResidente());
		}else{
			show_404();
		}
	}

	function obtenerTerceroVivienda(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIngreso->obtenerTerceroVivienda());
		}else{
			show_404();
		}
	}
}
?>