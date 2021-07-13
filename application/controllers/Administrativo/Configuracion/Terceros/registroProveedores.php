<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroProveedores extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1102, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Configuracion/RegistroProveedores_model'));
	}

	function index(){
		$contenido['titulo'] = 'Registro Proveedores';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vRegistroProveedores';
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
			,'personalizados/Administrativo/Configuracion/jsRegistroProveedores.js'
		);

		$contenido['estadocivilid'] = $this->RegistroProveedores_model->estadocivilid();
		$contenido['ClasificId'] = $this->RegistroProveedores_model->ClasificId();
		$contenido['ResponsabilidadFiscal'] = $this->RegistroProveedores_model->ResponsabilidadFiscal();

		$_POST['TerceroID'] = '';
		$_POST['btn'] = 'btnFastBackward';
		$contenido['clienteInicial'] = $this->RegistroProveedores_model->listaProveedores();
		
		$contenido['TERCModif'] = $this->session->userdata('TERCModif') ? $this->session->userdata('TERCModif') : array();
		$contenido['TERCCrear'] = $this->session->userdata('TERCCrear') ? $this->session->userdata('TERCCrear') : array();
		$contenido['TERCElimi'] = $this->session->userdata('TERCElimi') ? $this->session->userdata('TERCElimi') : array();

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		$this->load->view('UI/gestion_view', $contenido);
	}

	function exportar(){
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vExportarProveedores';
		$contenido['titulo'] = 'Proveedores';

		$contenido['css_lib'] = array(
			'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
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
			,'personalizados/Administrativo/Configuracion/jsExportarProveedores.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => "Registro Proveedores", "ruta" => "Administrativo/Configuracion/Terceros/RegistroProveedores"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function cargar(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->RegistroProveedores_model->cargar());
		} else {
			show_404();
		}
	}

	function registrar(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->registrar();
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
			echo $this->RegistroProveedores_model->actualizar($cliente, $nombre, $value, $tabla);
		} else {
			show_404();
		}
	}

	function cargarForanea(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->RegistroProveedores_model->cargarForanea());
		}else{
			show_404();
		}
	}

	function qSucursales(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->RegistroProveedores_model->qSucursales())."}";
		}else{
			show_404();
		}
	}

	function qInformacionAdicionalCRM(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->RegistroProveedores_model->qInformacionAdicionalCRM())."}";
		}else{
			show_404();
		}
	}

	function qContactos(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->RegistroProveedores_model->qContactos())."}";
		}else{
			show_404();
		}
	}

	function qAdjuntos(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->RegistroProveedores_model->qAdjuntos())."}";
		}else{
			show_404();
		}
	}

	function actualizarImagen(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->actualizarImagen();
		} else {
			show_404();
		}
	}

	function listaClientes(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->listaProveedores();
		} else {
			show_404();
		}
	}

	function guardarAdjunto(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->guardarAdjunto();
		} else {
			show_404();
		}
	}

	function guardarCRUD(){
		if ($this->input->is_ajax_request()) {
			$tabla = $this->input->post('tabla');
			$codigo = $this->input->post('codigo');
			$cliente = $this->input->post('cliente');
			$nombre = $this->input->post('nombre');
			$value = $this->input->post('value');
			$nombreCodigo = $this->input->post('nombreCodigo');
			echo $this->RegistroProveedores_model->guardarCRUD($tabla, $codigo, $cliente, $nombre, $value, $nombreCodigo);
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
			echo $this->RegistroProveedores_model->cargarCRUD($tabla, $codigo, $cliente, $nombreCodigo);
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
			echo json_encode($this->RegistroProveedores_model->eliminarCRUD($tabla, $codigo, $cliente, $nombreCodigo));
		} else {
			show_404();
		}
	}

	function guardarCRM(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->guardarCRM();
		} else {
			show_404();
		}
	}

	function eliminarCliente(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->eliminarCliente();
		} else {
			show_404();
		}
	}

	function qDescuentoFinancieroTercero(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->RegistroProveedores_model->qDescuentoFinancieroTercero())."}";
		}else{
			show_404();
		}
	}

	function qTarifaICATercero(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->RegistroProveedores_model->qTarifaICATercero())."}";
		}else{
			show_404();
		}
	}

	function guardarICA(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->guardarICA();
		} else {
			show_404();
		}
	}

	function quitarICA(){
		if ($this->input->is_ajax_request()) {
			echo $this->RegistroProveedores_model->quitarICA();
		} else {
			show_404();
		}
	}
}

?>