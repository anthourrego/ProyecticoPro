<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cSalida extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Porteria/Salida/mSalida'));
	}

	function index(){
		$contenido['content_page'] = 'Porteria/Salida/vSalida';
		$contenido['titulo'] = 'Salidas';
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
			'personalizados/Porteria/Salida/jsSalida.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];
		
		//$contenido['Residentes'] 	= $this->mIngreso->obtenerResidente();
		//$contenido['Vivienda'] 		= $this->mIngreso->obtenerVivienda();
		//$contenido['TipoVehi'] 		= $this->mIngreso->obtenerTipoVehiculo();

		$this->load->view('UI/gestion_view', $contenido);
	}

	function verificaTerceroSalida(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mSalida->verificaTerceroSalida());
		}else{
			show_404();
		}
	}

	function registrarSalida(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mSalida->registrarSalida());
		}else{
			show_404();
		}
	}
}
?>