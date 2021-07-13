<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class TramitarPQR extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(3002, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/PQR/TramitarPQR_model'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/PQR/vTramitarPQR';
		$contenido['titulo'] = "Tramitar PQR's";

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

			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/PQR/jsTramitarPQR.js'
		);

		//$contenido['selectProblemaCalidad'] = $this->selectProblemaCalidad();
		//$contenido['selectOperacion'] = $this->selectOperacion();
		$contenido['selectCausaPQR'] = $this->selectCausaPQR();
		//$contenido['selectResponsable'] = $this->selectResponsable();
		//$contenido['selectSeccion'] = $this->selectSeccion();
		$contenido['selectEstado'] = $this->selectEstado();
		$contenido['selectTipo'] = $this->selectTipo();
		$contenido['selectCiudad'] = $this->selectCiudad();
		//$contenido['selectAsesor'] = $this->selectAsesor();
		//$contenido['selectDependencia'] = $this->selectDependencia();
		$contenido['listaClientes'] = $this->TramitarPQR_model->listaClientes();

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/PQR/menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function consultarPQR($PQRid){
		$contenido['content_page'] = 'Administrativo/PQR/vConsultarPQR';
		$contenido['titulo'] = "Consultar PQR - " . $PQRid;
		

		$contenido['css_lib'] = array(
			'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'

			,'chosen/chosen.min.css'
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

			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'bs-custom-file-input.min.js'
			,'personalizados/Administrativo/PQR/jsConsultarPQR.js'
		);

		$contenido['PQR'] = $this->TramitarPQR_model->consultaPQR($PQRid);

		$contenido['dependencia'] = 1;
		$contenido['informacion'] = 1;
		$contenido['notas'] = 1;

		//Copnsultar bien para validar estos permisos
		if($contenido['PQR'][0][0]->Cerrada == '1'){
			$contenido['dependencia'] = 0;
			$contenido['informacion'] = 0;
			$contenido['notas'] = 0;
			// 30/01/2019 JCSM - Puede tramitar PQR's cerradas
			if(in_array(3054, $this->session->userdata('SEGUR'))){
				$contenido['dependencia'] = 1;
				$contenido['informacion'] = 1;
				$contenido['notas'] = 1;
			}
		}

		if($contenido['PQR'][2][0]->DependenciaId != $contenido['PQR'][0][0]->DependenciaId && !in_array(3042, $this->session->userdata('SEGUR'))){
			//redirect(base_url().'CapturaPQR');
			$contenido['notas'] = 0;
		}

		if(!in_array(3036, $this->session->userdata('SEGUR'))){
			$contenido['dependencia'] = 0;
		}

		if(!in_array(3037, $this->session->userdata('SEGUR'))){
			$contenido['informacion'] = 0;
		}

		if(!in_array(3038, $this->session->userdata('SEGUR'))){
			$contenido['notas'] = 0;
		}

		$contenido['notas'] = 1;
		$contenido['dependencia'] = 1;
		$contenido['informacion'] = 1;

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/PQR/menu"]
			,["nombre" => "Tramitar PQR's", "ruta" => "Administrativo/PQR/TramitarPQR"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function selectProblemaCalidad(){
		return json_encode($this->TramitarPQR_model->selectProblemaCalidad());
	}

	function selectOperacion(){
		return json_encode($this->TramitarPQR_model->selectOperacion());
	}
	function selectCausaPQR(){
		return json_encode($this->TramitarPQR_model->selectCausaPQR());
	}
	function selectResponsable(){
		return json_encode($this->TramitarPQR_model->selectResponsable());
	}
	function selectSeccion(){
		return json_encode($this->TramitarPQR_model->selectSeccion());
	}
	function selectEstado(){
		return json_encode($this->TramitarPQR_model->selectEstado());
	}
	function selectTipo(){
		return json_encode($this->TramitarPQR_model->selectTipo());
	}
	function selectCiudad(){
		return json_encode($this->TramitarPQR_model->selectCiudad());
	}
	function selectAsesor(){
		return json_encode($this->TramitarPQR_model->selectAsesor());
	}
	function selectDependencia(){
		return json_encode($this->TramitarPQR_model->selectDependencia());
	}

	// 16/03/2018 JCSM - Nota y comentarios
	function do_upload(){
		if ($this->input->is_ajax_request()) {
			ini_set('post_max_size', '64M');
			ini_set('upload_max_filesize', '64M');
			try {
				$subidas = array();
				$nota = array(
					'PQRId' => $this->input->post('PQRId'),
					'EstadoReporte' => $this->input->post('EstadoReporte'),
					'Detalle' => $this->input->post('Detalle')
					);
				$nota = $this->input->post();
				$fecha = new DateTime();
				$nota['Fecha'] = $fecha->format('Y-m-d H:i:s');
				$nota['FechaRegis'] = $fecha->format('Y-m-d H:i:s');
				$nota['UsuarioId'] = $this->session->userdata('id');
				if($this->input->post('Origen')) {
					$nota['Origen'] = $this->input->post('Origen');
				}		

				$id = $this->TramitarPQR_model->agregarNota($nota);

				if ($id == 0) {
					throw new Exception("Error al guardar la Nota.", 1);
				} else {
					echo $this->TramitarPQR_model->PQRArchivo('NPQR', $id);
				}
			} catch (Exception $e) {
				var_dump($e->getMessage());
			}
		} else {
			show_404();
		}
	}

	function actualizarPQR() {
		if ($this->input->is_ajax_request()) {
			$PQRId = $this->input->post('PQRId');
			$nombre = $this->input->post('nombre');
			$value = $this->input->post('value');
			echo $this->TramitarPQR_model->actualizarPQR($PQRId, $nombre, $value, $this->input->post('otra'));
		} else {
			show_404();
		}
	}


}

?>