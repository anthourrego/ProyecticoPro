<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cFichaTecnica extends CI_Controller { 
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(4, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/FichaTecnica/mFichaTecnica'));
	}


	function index(){
		$contenido['titulo'] 		= 'Fichas Tecnicas';
		$contenido['content_page'] 	= 'Administrativo/FichaTecnica/vFichaTecnica';

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
			,'jquery-validate/jquery.validate.min.js'
			,'jquery-validate/messages_es.min.js'

			
			,'personalizados/jsDataTables.js'
			,'chosen/chosen.jquery.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsValidate.js'
			,'personalizados/Administrativo/FichaTecnica/jsFichaTecnica.js'
			,'personalizados/Administrativo/FichaTecnica/jsVehiculo.js'
			,'personalizados/Administrativo/FichaTecnica/jsMaquinaria.js'
			,'personalizados/Administrativo/FichaTecnica/jsEquipoComputo.js'
			,'personalizados/Administrativo/FichaTecnica/jsLocativa.js'
		);

		$contenido['Vehiculo'] 		= $this->mFichaTecnica->obtenerItemEquipo(1);
		$contenido['Maquinaria'] 	= $this->mFichaTecnica->obtenerItemEquipo(2);
		$contenido['EquipoC'] 		= $this->mFichaTecnica->obtenerItemEquipo(3);
		$contenido['Locativa'] 		= $this->mFichaTecnica->obtenerItemEquipo(4);
		$contenido['undMedida']		= json_encode($this->mFichaTecnica->obtenerUnidadMedida());

		$this->load->view('UI/gestion_view', $contenido);
	}

	function verificaEquipo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->verificaEquipo());
		} else {
			show_404();
		}
	}

	function guardarValores(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->guardarValores());
		} else {
			show_404();
		}
	}

	function editarValores(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->editarValores());
		} else {
			show_404();
		}
	}

	function guardarElementoVehiculo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->guardarElementoVehiculo());
		} else {
			show_404();
		}	
	}

	function editarElementoVehiculo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->editarElementoVehiculo());
		} else {
			show_404();
		}	
	}

	function obtenerDataTabla(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->obtenerDataTabla());
		} else {
			show_404();
		}
	}

	function eliminaElemento(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->eliminaElemento());
		} else {
			show_404();
		}
	}

	function obtenerOperacion(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->obtenerOperacion());
		} else {
			show_404();
		}
	}

	function guardarOP(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->guardarOP());
		} else {
			show_404();
		}	
	}

	function actualizarOP(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->actualizarOP());
		} else {
			show_404();
		}
	}

	function eliminarOperacion(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->eliminarOperacion());
		} else {
			show_404();
		}
	}

	function guardarAnexo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->guardarAnexo());
		} else {
			show_404();
		}
	}

	function eliminarAnexo(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->eliminarAnexo());
		} else {
			show_404();
		}
	}

	function eliminarFT(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->eliminarFT());
		} else {
			show_404();
		}
	}

	function obtenerDataFT(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->obtenerDataFT());
		} else {
			show_404();
		}	
	}

	function eliminarTemporal(){
		if ($this->input->is_ajax_request()) {
			echo  json_encode($this->mFichaTecnica->eliminarTemporal());
		} else {
			show_404();
		}
	}
}