<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cServicio extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Porteria/Servicio/mServicio'));
	}

	function index(){
		$contenido['content_page'] = 'Porteria/Servicio/vServicio';
		$contenido['titulo'] = 'Servicios';
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
			'personalizados/Porteria/Servicio/jsServicio.js'
		);
		
		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$contenido['TipoServicio'] 	= $this->mServicio->obtenerTipoServicio();
		$contenido['Vivienda'] 		= $this->mServicio->obtenerVivienda();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function guardarServicio(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mServicio->guardarServicio());
		}else{
			show_404();
		}
	}

	function obtenerZonas(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mServicio->obtenerZonas());
		}else{
			show_404();
		}
	}

	function obtenerDataZona(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mServicio->obtenerDataZona());
		}else{
			show_404();
		}
	}

	function qHistorico(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mServicio->qHistorico())."}";
		}else{
			show_404();
		}
	}

	function actualizarServicio(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mServicio->actualizarServicio());
		}else{
			show_404();
		}
	}
}
?>