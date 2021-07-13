<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cIncidente extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Porteria/Incidente/mIncidente'));
	}

	function index(){
		$contenido['content_page'] = 'Porteria/Incidente/vIncidente';
		$contenido['titulo'] = 'Incidentes y/o Daños';
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
			'personalizados/Porteria/Incidente/jsIncidente.js'
		);
		
		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$contenido['Zonas'] 	= $this->mIncidente->obtenerZonas();
		
		$this->load->view('UI/gestion_view', $contenido);
	}

	function guardarValores(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIncidente->guardarValores());
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

	function qHistorico(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mIncidente->qHistorico())."}";
		}else{
			show_404();
		}
	}
}
?>