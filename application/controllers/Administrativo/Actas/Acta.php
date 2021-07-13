<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Acta extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(6001, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Actas/Acta_model'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Actas/vActa';
		$contenido['titulo'] = 'Lista Actas';

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
			,'datetimepicker/moment.js'
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
			,'personalizados/Administrativo/Actas/jsActa.js'
		);

		$contenido["selectTipoReunion"] = $this->Acta_model->selectTipoReunion();

		$contenido["breadcrumb"] = [
			["nombre" => "Actas", "ruta" => "Administrativo/Actas/Menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function crear(){
		$contenido['content_page'] = 'Administrativo/Actas/vActaCrear';
		$contenido['titulo'] = 'Registrar Acta';

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'

			,'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
			,'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'datetimepicker/moment.js'
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
			,'jquery-validate/jquery.validate.min.js'
			,'jquery-validate/messages_es.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/jsValidate.js'
			,'personalizados/Administrativo/Actas/jsActaCrear.js'
		);

		$contenido["modificar"] = 0;

		$contenido["selectTipoReunion"] = $this->Acta_model->selectTipoReunion();
		$contenido["selectUsuario"] = $this->Acta_model->selectUsuario();
		$contenido["selectUsuarioAdmin"] = $this->Acta_model->selectUsuariosAdmin();

		$contenido["breadcrumb"] = [
			["nombre" => "Actas", "ruta" => "Administrativo/Actas/Menu"]
			,["nombre" => "Lista Actas", "ruta" => "Administrativo/Actas/Acta"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function Ver($id){

		if ($this->Acta_model->validarPermiso($id, 1) == 0) {
			redirect(base_url() . "Administrativo/Actas/Acta");
		}

		$contenido['content_page'] = 'Administrativo/Actas/vActaCrear';
		$contenido['titulo'] = 'Ver Acta ' . $id;

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'

			,'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
			,'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'datetimepicker/moment.js'
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
			,'jquery-validate/jquery.validate.min.js'
			,'jquery-validate/messages_es.min.js'									
			,'chosen/chosen.jquery.min.js'
			,'jquery-validate/jquery.validate.min.js'
			,'jquery-validate/messages_es.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Actas/jsActaCrear.js'
		);

		$contenido["idActa"] = $id;
		$contenido["datosActa"] = $this->Acta_model->datosActa($id);

		$contenido["selectTipoReunion"] = $this->Acta_model->selectTipoReunion();
		$contenido["selectUsuario"] = $this->Acta_model->selectUsuario();
		$contenido["selectUsuarioAdmin"] = $this->Acta_model->selectUsuariosAdmin();

		$contenido["modificar"] = 1;

		$contenido["breadcrumb"] = [
			["nombre" => "Actas", "ruta" => "Administrativo/Actas/Menu"]
			,["nombre" => "Lista Actas", "ruta" => "Administrativo/Actas/Acta"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function Editar($id){

		if ($this->Acta_model->validarPermiso($id, 2) == 0) {
			redirect(base_url() . "Administrativo/Actas/Acta");
		}
 		
		$contenido['content_page'] = 'Administrativo/Actas/vActaCrear';

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
			,'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
			,'datetimepicker/moment.js'
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
			,'jquery-validate/jquery.validate.min.js'
			,'jquery-validate/messages_es.min.js'									
			,'chosen/chosen.jquery.min.js'
			,'jquery-validate/jquery.validate.min.js'
			,'jquery-validate/messages_es.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Actas/jsActaCrear.js'
		);

		$contenido["datosActa"] = $this->Acta_model->datosActa($id);

		$contenido['titulo'] = 'Editar Acta ' . $contenido["datosActa"]->Radicado;		

		$contenido["selectTipoReunion"] = $this->Acta_model->selectTipoReunion();
		$contenido["selectUsuario"] = $this->Acta_model->selectUsuario();
		$contenido["selectUsuarioAdmin"] = $this->Acta_model->selectUsuariosAdmin();

		$contenido["modificar"] = 2;

		$contenido["breadcrumb"] = [
			["nombre" => "Actas", "ruta" => "Administrativo/Actas/Menu"]
			,["nombre" => "Lista Actas", "ruta" => "Administrativo/Actas/Acta"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	public function crearActa(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->crearActa());
		} else {
			show_404();
		}
	}

	public function eliminarActa(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->eliminarActa());
		} else {
			show_404();
		}
	}

	function listaCompromisos(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->Acta_model->listaCompromisos())."}";
		}else{
			show_404();
		}
	}

	public function crearCompromiso(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->crearCompromiso());
		} else {
			show_404();
		}
	}

	public function ActualizarActa(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->ActualizarActa());
		} else {
			show_404();
		}
	}

	public function eliminarCompromiso(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->eliminarCompromiso());
		} else {
			show_404();
		}
	}

	public function eliminarSeguimientoCompromiso(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->eliminarSeguimientoCompromiso());
		} else {
			show_404();
		}
	}

	public function crearCompromisoSeguimiento(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->crearCompromisoSeguimiento());
		} else {
			show_404();
		}
	}

	public function anexoArchivo(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->anexoArchivo());
		} else {
			show_404();
		}
	}

	public function actualizarPermisos(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->actualizarPermisos());
		} else {
			show_404();
		}
	}

	public function actualizarAsistentes(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->actualizarAsistentes());
		} else {
			show_404();
		}
	}

	public function eliminarAnexo(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Acta_model->eliminarAnexo());
		} else {
			show_404();
		}
	}

}

?>