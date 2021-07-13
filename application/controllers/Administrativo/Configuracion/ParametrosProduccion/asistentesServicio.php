<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AsistentesServicio extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1603, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio_model'));
	}

	function index(){
		$contenido['titulo'] = 'Asistentes Servicio';
		$contenido['content_page'] = 'Administrativo/Configuracion/ParametrosProduccion/vAsistentesServicio';
		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
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
		);
		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Configuracion/ParametrosProduccion/jsAsistentesServicio.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Parámetros de producción", "ruta" => "Administrativo/Configuracion/Menu/Inicio/ParametrosProduccion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$contenido['estadocivilid'] = $this->AsistentesServicio_model->estadocivilid();
		$_POST['TerceroID'] = '';
		$_POST['btn'] = 'btnFastBackward';
		$contenido['clienteInicial'] = $this->AsistentesServicio_model->listaClientes();
		$this->load->view('UI/gestion_view', $contenido);
	}

	function exportar(){
		$contenido['content_page'] = 'Administrativo/Configuracion/ParametrosProduccion/vExportarAsistentesServicio';
		$contenido['titulo'] = 'Exportar';

		$contenido['css_lib'] = array(
			'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'
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
			,'personalizados/Administrativo/Configuracion/ParametrosProduccion/jsExportarAsistentesServicio.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Parámetros de producción", "ruta" => "Administrativo/Configuracion/Menu/Inicio/ParametrosProduccion"]
			,["nombre" => "Asistentes Servicio", "ruta" => "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function cargar(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->AsistentesServicio_model->cargar());
		} else {
			show_404();
		}
	}

	function registrar(){
		if ($this->input->is_ajax_request()) {
			echo $this->AsistentesServicio_model->registrar();
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
			echo $this->AsistentesServicio_model->actualizar($cliente, $nombre, $value, $tabla);
		} else {
			show_404();
		}
	}

	function cargarForanea(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->AsistentesServicio_model->cargarForanea());
		}else{
			show_404();
		}
	}

	function qActividadesOperarioCP(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->AsistentesServicio_model->qActividadesOperarioCP())."}";
		}else{
			show_404();
		}
	}

	function qActividadesOperarioAC(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->AsistentesServicio_model->qActividadesOperarioAC())."}";
		}else{
			show_404();
		}
	}

	function actualizarImagen(){
		if ($this->input->is_ajax_request()) {
			echo $this->AsistentesServicio_model->actualizarImagen();
		} else {
			show_404();
		}
	}

	function listaClientes(){
		if ($this->input->is_ajax_request()) {
			echo $this->AsistentesServicio_model->listaClientes();
		} else {
			show_404();
		}
	}

	function eliminarCliente(){
		if ($this->input->is_ajax_request()) {
			echo $this->AsistentesServicio_model->eliminarCliente();
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
			echo $this->AsistentesServicio_model->cargarCRUD($tabla, $codigo, $cliente, $nombreCodigo);
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
			echo json_encode($this->AsistentesServicio_model->eliminarCRUD($tabla, $codigo, $cliente, $nombreCodigo));
		} else {
			show_404();
		}
	}

	function GuardarCP(){
		if ($this->input->is_ajax_request()) {
			echo $this->AsistentesServicio_model->GuardarCP();
		} else {
			show_404();
		}
	}

	function GuardarAC(){
		if ($this->input->is_ajax_request()) {
			echo $this->AsistentesServicio_model->GuardarAC();
		} else {
			show_404();
		}
	}
}

?>