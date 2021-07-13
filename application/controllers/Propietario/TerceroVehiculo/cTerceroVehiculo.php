<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cTerceroVehiculo extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Propietario/TerceroVehiculo/mTerceroVehiculo'));
	}

	function index() {
		$contenido['titulo'] 		= 'Mis vehículos';
		$contenido['content_page'] 	= 'Propietario/TerceroVehiculo/vTerceroVehiculo';
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
			,'personalizados/Propietario/TerceroVehiculo/jsTerceroVehiculo.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$contenido['TipoVehi']		= $this->mTerceroVehiculo->obtenerTipoVehiculo();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function guardarDatos(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTerceroVehiculo->guardarDatos());
		}else{
			show_404();
		}
	}

	function verificaPlaca(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTerceroVehiculo->verificaPlaca());
		}else{
			show_404();
		}
	}

	function eliminarVehiculo(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTerceroVehiculo->eliminarVehiculo());
		}else{
			show_404();
		}
	}
}
?>