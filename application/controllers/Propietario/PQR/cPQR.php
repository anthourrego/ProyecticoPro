<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cPQR extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
        	redirect(base_url());
		}

		$this->load->model(array('Propietario/PQR/mPQR'));
	}

	function index($idPqr = ''){
		$contenido['content_page'] = 'Propietario/PQR/vPQR.php';
		$contenido['titulo'] = "PQR's";

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
			,'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'datetimepicker/moment.js'
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
			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Propietario/PQR/jsPQR.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$contenido['idPQR'] = $idPqr;

		$contenido["listaTipoPQR"] = $this->mPQR->listaTipoPQR();

		$this->load->view('UI/gestion_view', $contenido);
	}

	public function crear(){ 
		if ($this->input->is_ajax_request()) {

			$TipoPQRid 			= $this->input->post('TipoPQR');
			$fecha = new DateTime();

			$datos = array(
				'UsuarioId'		=> $this->input->post('UsuarioId'), 
				'TerceroId'     => $this->input->post('TerceroId'),
				'Fecha' 		=> $fecha->format("Y-m-d H:i:s"), 
				'TipoPQRid' 	=> $this->input->post('TipoPQR'),
				'Asunto' 		=> $this->input->post('Asunto'),
				'Descripcion' 	=> $this->input->post('Descripcion')
			);

			$this->db->trans_begin();

			$idPQR = $this->mPQR->insertar($datos);

			// Enviado de alertas a servicio al cliente
			if($idPQR != 0){
				// Adjunción de archivos
				$idPQR[] = $this->mPQR->PQRArchivo('PQR', $idPQR[0]);

				if($this->mPQR->enviarAlertasPQR('[Nueva PQR] - '.$this->input->post('Asunto'), $idPQR[0]) == 0){
					$this->db->trans_rollback();
					echo 0;
					return 0;
				}


			}else{
				$this->db->trans_rollback();
				echo 0;
				return 0;
			}

			$solicitud = "PQR".$this->input->post('TipoPQR').$idPQR[1];

			$datos = array(
				'Solicitud' => $solicitud
			);

			$this->mPQR->act($idPQR[0],$datos);

			$this->db->trans_commit();

			echo json_encode($idPQR);
		} else {
			show_404();
		}
	}

	public function ver(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mPQR->Ver());
		} else {
			show_404();
		}
		
	}

}

?>