<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ConsultaPQR extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(3003, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/PQR/ConsultaPQR_model'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/PQR/vConsultaPQR';
		$contenido['titulo'] = "Matriz PQR's";

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
			,'dataTables/buttons.colVis.min.js'
			/* ,'dataTables/dataTables.bootstrap.min.js'  */
			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/PQR/jsConsultaPQR.js'
		);

		$contenido['selectProblemaCalidad'] = $this->selectProblemaCalidad();
		$contenido['selectOperacion'] = $this->selectOperacion();
		$contenido['selectCausaPQR'] = $this->selectCausaPQR();
		$contenido['selectResponsable'] = $this->selectResponsable();
		$contenido['selectSeccion'] = $this->selectSeccion();
		$contenido['selectEstado'] = $this->selectEstado();
		$contenido['selectTipo'] = $this->selectTipo();
		$contenido['selectCiudad'] = $this->selectCiudad();
		$contenido['selectAsesor'] = $this->selectAsesor();
		$contenido['selectDependencia'] = $this->selectDependencia();
		$contenido['listaClientes'] = $this->ConsultaPQR_model->listaClientes();

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/PQR/menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function selectProblemaCalidad(){
		return json_encode($this->ConsultaPQR_model->selectProblemaCalidad());
	}

	function selectOperacion(){
		return json_encode($this->ConsultaPQR_model->selectOperacion());
	}
	function selectCausaPQR(){
		return json_encode($this->ConsultaPQR_model->selectCausaPQR());
	}
	function selectResponsable(){
		return json_encode($this->ConsultaPQR_model->selectResponsable());
	}
	function selectSeccion(){
		return json_encode($this->ConsultaPQR_model->selectSeccion());
	}
	function selectEstado(){
		return json_encode($this->ConsultaPQR_model->selectEstado());
	}
	function selectTipo(){
		return json_encode($this->ConsultaPQR_model->selectTipo());
	}
	function selectCiudad(){
		return json_encode($this->ConsultaPQR_model->selectCiudad());
	}
	function selectAsesor(){
		return json_encode($this->ConsultaPQR_model->selectAsesor());
	}
	function selectDependencia(){
		return json_encode($this->ConsultaPQR_model->selectDependencia());
	}

}

?>