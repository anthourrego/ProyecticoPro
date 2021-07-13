<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cIncidencia extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Propietario/Incidencia/mIncidencia'));
	}

	function index() {
		$contenido['titulo'] = 'Incidencias';
		$contenido['content_page'] = 'Propietario/Incidencia/vIncidencia';
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
			,'personalizados/Propietario/Incidencia/jsIncidencia.js'
		);

		$contenido["permisoTramite"] = 1 /* in_array(3030, $this->session->userdata('SEGUR')) */;

		$contenido["listaEquipos"] = $this->mIncidencia->listaEquipos();

		$contenido["listaTipoIncidencia"] = $this->mIncidencia->listaTipoIncidencia();
		$contenido["selectEstado"] = $this->mIncidencia->selectEstado();

		$contenido["breadcrumb"] = [
			["nombre" => "Inicio", "ruta" => "Inicio"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	public function ver(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mIncidencia->Ver());
		} else {
			show_404();
		}
	}

	public function crear(){ 
		if ($this->input->is_ajax_request()) {

			$datos = array(
				'ItemEquipoId'     => $this->input->post('ItemEquipoId'),
				'Fecha' 		   => date("Y-m-d H:i:s"), 
				'TipoIncidenciaId' => $this->input->post('TipoIncidenciaId'),
				'Asunto' 		   => $this->input->post('Asunto'),
				'Descripcion' 	   => $this->input->post('Descripcion')
			);

			$detalla = array(
				'UsuarioId'		   => $this->input->post('UsuarioId'), 
				'FechaRegis' 	   => date("Y-m-d H:i:s"), 
				'Descripcion' 	   => 'Nueva Incidencia'
			);

			$this->db->trans_begin();

			$idIncidencia = $this->mIncidencia->insertar($datos,$detalla);

			if($idIncidencia == 0){
				$this->db->trans_rollback();
				echo 0;
			}
			
			if($_FILES['archivos']['size'][0] > 0){
				$nota = array(
					'HeadIncidenciaId' => $idIncidencia[0],
					'Privado' => 0,
					'Estado' => 'A',
					'Descripcion' => 'Adjunto Incidencias',
					'FechaRegis' => date('Y-m-d H:i:s'),
					'UsuarioId' => $this->session->userdata('id')
				);

				$id = $this->mIncidencia->agregarNota($nota);
	
				$idIncidencia[] = $this->mIncidencia->AdjuntarArchivos('INCI', $id, $idIncidencia[0]);
			} else {
				$idIncidencia[] = '[]';
			}

			if($this->mIncidencia->enviarAlertas('[Nueva Incidencia] Nro ' .  $idIncidencia[1] .' - '.$this->input->post('Asunto'), $idIncidencia[0]) == 0){
				$this->db->trans_rollback();
				echo 0;
				return 0;
			}

			$this->db->trans_commit();

			$_POST["RASTREO"]['fecha'] = date('d-m-Y H:i:s');
			$_POST["RASTREO"]['programa'] = "Capturar Incidencia";
			$_POST["RASTREO"]['cambio'] = "Se crea incidencia [id: " . $idIncidencia[0] . ", Nro: " . $idIncidencia[1] . ", Asunto: " . $this->input->post('Asunto') . ", Descripcion: " . $this->input->post('Descripcion') . "]";
			RASTREO(); 

			echo json_encode($idIncidencia);
		} else {
			show_404();
		}
	}

	function qHistorialIncidencia(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mIncidencia->historialIncidencia())."}";
		}else{
			show_404();
		}
	}
}
?>