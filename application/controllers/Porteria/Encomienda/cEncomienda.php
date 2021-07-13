<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cEncomienda extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Porteria/Encomienda/mEncomienda'));
	}

	function index(){
		$contenido['content_page'] = 'Porteria/Encomienda/vEncomienda';
		$contenido['titulo'] = 'Encomiendas';
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
			'personalizados/Porteria/Encomienda/jsEncomienda.js'
		);
		
		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$contenido['Residentes'] 	= $this->mEncomienda->obtenerResidente();
		$contenido['Vivienda'] 		= $this->mEncomienda->obtenerVivienda();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function obtenerTerceroVivienda(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEncomienda->obtenerTerceroVivienda());
		}else{
			show_404();
		}
	}

	function guardarEncomienda(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEncomienda->guardarEncomienda());
		}else{
			show_404();
		}
	}

	function obtenerZonas(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEncomienda->obtenerZonas());
		}else{
			show_404();
		}
	}

	function obtenerDataZona(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEncomienda->obtenerDataZona());
		}else{
			show_404();
		}
	}

	function qHistorico(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mEncomienda->qHistorico())."}";
		}else{
			show_404();
		}
	}

	function actualizarEncomienda(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mEncomienda->actualizarEncomienda());
		}else{
			show_404();
		}
	}
}
?>