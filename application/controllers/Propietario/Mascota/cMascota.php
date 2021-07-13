<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cMascota extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Propietario/Mascota/mMascota'));
	}

	function index() {
		$contenido['titulo'] 		= 'Registro de mascotas';
		$contenido['regresar'] 		= 'Inicio';
		$contenido['content_page'] 	= 'Propietario/Mascota/vMascota';
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
			,'chosen/chosen.min.css'
		);
		$contenido['script_adicional'] = array(
			'chosen/chosen.jquery.min.js'
			,'personalizados/Propietario/Mascota/jsMascota.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$contenido['TipoMascota'] 	= $this->mMascota->obtenerMascota();
		$contenido['ViviendaId'] 	= $this->mMascota->validarVivienda();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function ActualizarImagen(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mMascota->ActualizarImagen());
		}else{
			show_404();
		}
	}

	function obtenerMascotaTercero(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mMascota->obtenerMascotaTercero());
		}else{
			show_404();
		}
	}

	function qHistorico(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mMascota->qHistorico())."}";
		}else{
			show_404();
		}
	}

	function guardarVacuna(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mMascota->guardarVacuna());
		}else{
			show_404();
		}
	}

	function eliminarMascota(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mMascota->eliminarMascota());
		}else{
			show_404();
		}
	} 
}
?>