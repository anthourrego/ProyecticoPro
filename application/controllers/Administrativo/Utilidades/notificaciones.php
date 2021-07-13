<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->load->model(array('Administrativo/Utilidades/Notificaciones_model'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Utilidades/vNotificaciones';
		$contenido['titulo'] = 'Notificaciones';

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.dataTables.min.css'

			,'chosen/chosen.min.css'
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
			,'dataTables/buttons.bootstrap4.min.js'
			,'dataTables/buttons.html5.min.js'
			,'dataTables/buttons.print.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'

			,'chosen/chosen.jquery.min.js'
		);
		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Utilidades/jsNotificaciones.js'
		);

		$contenido['Opciones'] = array();
		$contenido['json'] = '';
		if (isset($_POST['json'])){
			$contenido['json'] = $_POST['json'];
		}

		$this->load->view('UI/gestion_view', $contenido);
	}

	function getNotificaciones() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Notificaciones_model->getNotificaciones());
		}else{
			show_404();
		}
	}

	function listaNotificaciones() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Notificaciones_model->listaNotificaciones());
		}else{
			show_404();
		}
	}

	function actualizarAlerta() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Notificaciones_model->actualizarAlerta());
		}else{
			show_404();
		}
	}

	function actualizarAlertaDespertador() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Notificaciones_model->actualizarAlertaDespertador());
		}else{
			show_404();
		}
	}
}

?>