<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cAgendarIncidencia extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(5003, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Incidencia/mAgendarIncidencia'));
	} 

	function index(){
	
		$contenido['content_page'] = 'Administrativo/Incidencia/vAgendarIncidencia';
		$contenido['titulo'] = 'Agendar Incidencia';

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css' 
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
			,'chosen/chosen.min.css'
			,'full-calendar/main.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
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
			,'full-calendar/main.js'
			,'full-calendar/es.js'
			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Incidencia/jsAgendarIncidencia.js'
		);

		$contenido["listaEquipos"] = $this->mAgendarIncidencia->listaEquipos();
 
		$contenido['listaTipoIncidencia'] = $this->mAgendarIncidencia->listaTipoIncidencia();

		$contenido['listaEstadoIncidencia'] = $this->mAgendarIncidencia->listaEstadoIncidencia();

		$contenido['listaTipoPrioridadIncidencia'] = $this->mAgendarIncidencia->listaTipoPrioridadIncidencia();

		$contenido["breadcrumb"] = [
			["nombre" => "Gestión Incidencia", "ruta" => "Administrativo/Incidencia/cMenu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function incidencias(){
		echo json_encode($this->mAgendarIncidencia->incidencias());
	}

	public function listaOperacion() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mAgendarIncidencia->listaOperacion());
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
				'TipoPrioridadIncidenciaId' => $this->input->post('TipoPrioridadIncidenciaId'),
				'EstadoIncidenciaId' => $this->input->post('EstadoIncidenciaId'),
				'Asunto' 		   => $this->input->post('Asunto'),
				'Descripcion' 	   => $this->input->post('Descripcion')
			);

			$detalla = array(
				'UsuarioId'		   => $this->input->post('UsuarioId'), 
				'FechaRegis' 	   => date("Y-m-d H:i:s"), 
				'Descripcion' 	   => 'Nueva Incidencia'
			);

			$agendamiento =  array(
				'FechaIni'  => date('Y-m-d H:i:s', strtotime($this->input->post('FechaIni'). ' ' . $this->input->post('HoraIni'))), 
				'FechaFin'  => date('Y-m-d H:i:s', strtotime($this->input->post('FechaFin'). ' ' . $this->input->post('HoraFin'))), 
			);

			$this->db->trans_begin();

			$idIncidencia = $this->mAgendarIncidencia->insertar($datos, $detalla, $agendamiento);

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
					'FechaRegis' => date("Y-m-d H:i:s"),
					'UsuarioId' => $this->session->userdata('id')
				);
				
				$id = $this->mAgendarIncidencia->agregarNota($nota);
	
				$idIncidencia[] = $this->mAgendarIncidencia->AdjuntarArchivos('INCI', $id, $idIncidencia[0]);
			} else {
				$idIncidencia[] = '[]';
			}

			if($this->mAgendarIncidencia->enviarAlertas('[Nueva Incidencia] Nro ' . $idIncidencia[1] . ' - '.$this->input->post('Asunto'), $idIncidencia[0]) == 0){
				$this->db->trans_rollback();
				echo 0;
				return 0;
			}

			$this->db->trans_commit();

			$_POST["RASTREO"]['fecha'] = date('d-m-Y H:i:s');
			$_POST["RASTREO"]['programa'] = "Agendar Incidencia";
			$_POST["RASTREO"]['cambio'] = "Se crea incidencia [id: " . $idIncidencia[0] . ", Nro: " . $idIncidencia[1] . ", Asunto: " . $this->input->post('Asunto') . ", Descripcion: " . $this->input->post('Descripcion') . "]";
			RASTREO(); 

			echo json_encode($idIncidencia);
		} else {
			show_404();
		}
	}

	public	function actualiarFechaAgenda() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mAgendarIncidencia->actualiarFechaAgenda());
		} else {
			show_404();
		}
	}

	public function actualizarAlertaIncidencia() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mAgendarIncidencia->actualizarAlertaIncidencia());
		} else {
			show_404();
		}
	}

}

?>