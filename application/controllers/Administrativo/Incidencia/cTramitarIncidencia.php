<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cTramitarIncidencia extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(5002, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Incidencia/mTramitarIncidencia'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Incidencia/vTramitarIncidencia';
		$contenido['titulo'] = "Incidencias";

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
			,'personalizados/Administrativo/Incidencia/jsTramitarIncidencia.js'
		);

		$contenido['selectTipoPrioridad'] = $this->mTramitarIncidencia->selectTipoPrioridad();
		$contenido['selectEstado'] = $this->mTramitarIncidencia->selectEstado();
		$contenido['TipoIncidencia'] = $this->mTramitarIncidencia->TipoIncidencia();
		$contenido['listaEquipos'] = $this->mTramitarIncidencia->listaEquipos();

		$contenido["breadcrumb"] = [
			["nombre" => "Gestión Incidencia", "ruta" => "Administrativo/Incidencia/cMenu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function consultarIncidencia($idIncidencia){
		$contenido['content_page'] = 'Administrativo/Incidencia/vConsultarIncidencia';

		$INCIDENCIA = $this->mTramitarIncidencia->consultaIncidencia($idIncidencia);
		$contenido['INCIDENCIA'] = $INCIDENCIA;
		$contenido['titulo'] = "Consultar Incidencia - " . $INCIDENCIA[0]->Numero;
		
		$contenido['dependencia'] = 1;
		$contenido['informacion'] = 1;
		$contenido['notas'] = 1;

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css' 
			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.bootstrap4.min.css'
			,'chosen/chosen.min.css'
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
			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Incidencia/jsConsultarIncidencia.js'
		);

		$contenido['selectTipoPrioridad'] = $this->mTramitarIncidencia->selectTipoPrioridad();
		$contenido['selectEstado'] = $this->mTramitarIncidencia->selectEstado();
		$contenido['TipoIncidencia'] = $this->mTramitarIncidencia->TipoIncidencia();

		$contenido["breadcrumb"] = [
			["nombre" => "Gestión Incidencia", "ruta" => "Administrativo/Incidencia/cMenu"]
			,["nombre" => "Incidencias", "ruta" => "Administrativo/Incidencia/cTramitarIncidencia"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function do_upload(){
		if ($this->input->is_ajax_request()) {
			ini_set('post_max_size', '64M');
			ini_set('upload_max_filesize', '64M');
			try {

				$subidas = array();
				$nota = array(
						'HeadIncidenciaId' => $this->input->post('HeadIncidenciaId')
						,'Privado' => $this->input->post('Privado')
						,'Estado' => 'A'
						,'Descripcion' => $this->input->post('Descripcion')
						,'FechaRegis' => date('Y-m-d H:i:s')
						,'UsuarioId' => $this->session->userdata('id')
					);
						
				$id = $this->mTramitarIncidencia->agregarNota($nota);
				
				if ($id == 0) {
					throw new Exception("Error al guardar la Nota.", 1);
				} else {
					echo $this->mTramitarIncidencia->AdjuntarArchivos('INCI', $id, $this->input->post('HeadIncidenciaId'));
				}
			} catch (Exception $e) {
				var_dump($e->getMessage());
			}
		} else {
			show_404();
		}
	}

	function qHistorialIncidencia(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mTramitarIncidencia->historialIncidencia())."}";
		}else{
			show_404();
		}
	}

	function qListaActividades(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mTramitarIncidencia->listaActividades())."}";
		}else{
			show_404();
		}
	}

	function qListaTecnicosAsignados(){
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mTramitarIncidencia->qListaTecnicosAsignados())."}";
		}else{
			show_404();
		}
	}

	function listaTecnicos(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->listaTecnicos());
		}else{
			show_404();
		}
	}

	function eliminarAgregaActividad(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->eliminarAgregaActividad());
		}else{
			show_404();
		}
	}

	function eliminarTecnicosAsignados(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->eliminarTecnicosAsignados());
		}else{
			show_404();
		}
	}

	function agregarTecnicos(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->agregarTecnicos());
		}else{
			show_404();
		}
	}

	function actualizar() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->actualizar());
		} else {
			show_404();
		}
	}

	public function qListaActividadesLogTiempo() {
		if ($this->input->is_ajax_request()) {
			echo '{"data":'.json_encode($this->mTramitarIncidencia->qListaActividadesLogTiempo())."}";
		} else {
			show_404();
		}
	}

	public function listaActividadesLogTiempo() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->listaActividadesLogTiempo());
		} else {
			show_404();
		}
	}

	public function guardarLogTiempo() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->guardarLogTiempo());
		} else {
			show_404();
		}
	}

	public function actualizarLogTiempo() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->actualizarLogTiempo());
		} else {
			show_404();
		}
	}

	public function eliminarLogTiempo() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->eliminarLogTiempo());
		} else {
			show_404();
		}
	}

	public function anexosAgenda() {
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->mTramitarIncidencia->anexosAgenda());
		} else {
			show_404();
		}
	}

	function listaEquipos(){
		return json_encode($this->mTramitarIncidencia->listaEquipos());
	}

}

?>