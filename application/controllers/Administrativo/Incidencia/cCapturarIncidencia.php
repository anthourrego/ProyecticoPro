<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cCapturarIncidencia extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(5001, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Incidencia/mCapturarIncidencia'));
	}
 
	function index(){
		$contenido['content_page'] = 'Administrativo/Incidencia/vCapturarIncidencia';
		$contenido['titulo'] = 'Capturar Incidencia';

		$contenido['css_lib'] = array(
			'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/Administrativo/Incidencia/jsCapturarIncidencia.js'
		);

		$contenido["listaTipoIncidencia"] = $this->mCapturarIncidencia->listaTipoIncidencia();

		$contenido["listaEquipos"] = $this->mCapturarIncidencia->listaEquipos();

		$contenido["breadcrumb"] = [
			["nombre" => "Gestión Incidencia", "ruta" => "Administrativo/Incidencia/cMenu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
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

			$idIncidencia = $this->mCapturarIncidencia->insertar($datos,$detalla);

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

				$id = $this->mCapturarIncidencia->agregarNota($nota);
	
				$idIncidencia[] = $this->mCapturarIncidencia->AdjuntarArchivos('INCI', $id, $idIncidencia[0]);
			} else {
				$idIncidencia[] = '[]';
			}

			if($this->mCapturarIncidencia->enviarAlertas('[Nueva Incidencia] Nro ' .  $idIncidencia[1] .' - '.$this->input->post('Asunto'), $idIncidencia[0]) == 0){
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
}

?>