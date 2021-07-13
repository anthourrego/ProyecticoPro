<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") ||  !in_array(6002, $this->session->userdata('SEGUR'))){
			redirect(base_url());
        } 
        
		$this->load->model(array('Administrativo/Actas/Consultas_model'));
		
	}

	function index() {
		$contenido['content_page'] = 'Administrativo/Actas/vConsultas';
		$contenido['titulo'] = 'Consultas';

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
			,'chartjs/Chart.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Actas/jsConsultas.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Actas", "ruta" => "Administrativo/Actas/Menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}
	
	function qTiempoAsistentes(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->Consultas_model->qTiempoAsistentes())."}";
		}else{
			show_404();
		}
	}

	function qTiempoMes(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->Consultas_model->qTiempoMes())."}";
		}else{
			show_404();
		}
	}

	function qTiempoTipoReunion(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->Consultas_model->qTiempoTipoReunion())."}";
		}else{
			show_404();
		}
	}

}
?>
