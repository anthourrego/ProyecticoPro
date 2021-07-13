<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cFichaTecnica extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1704, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		//$this->load->model(array('Administrativo/Configuracion/Inicio/mMapa'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Configuracion/Inicio/vFichaTecnica';
		$contenido['titulo'] = 'Fichas tecnicas';
		$contenido['js_lib'] = array(
			'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js' 
			
			,'dataTables/dataTables.scroller.min.js'
			//,'dataTables/responsive.bootstrap.min.js'//
			,'dataTables/dataTables.buttons.min.js'
			,'dataTables/buttons.flash.min.js'
			,'dataTables/jszip.min.js'
			,'dataTables/pdfmake.min.js'
			,'dataTables/vfs_fonts.js'
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
			,'dataTables/buttons.dataTables.min.css'

			,'chosen/chosen.min.css
		');
		$contenido['script_adicional'] = array(
			'personalizados/Administrativo/Configuracion/Inicio/jsFichaTecnica.js'
		);
		//$contenido['regresar'] = '/inicio';
		
		//$contenido['Residentes'] 	= $this->mIngreso->obtenerResidente();
		//$contenido['Vivienda'] 		= $this->mIngreso->obtenerVivienda();

		$contenido["breadcrumb"] = [
			["nombre" => "Configuración", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Configuracion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}
}
?>