<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class InformacionEmpresa extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1701, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Configuracion/InformacionEmpresa_model'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Configuracion/vInformacionEmpresa';
		$contenido['titulo'] = 'Datos del conjunto';
		$contenido['js_lib'] = array(
			'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js'
			,'dataTables/dataTables.scroller.min.js'

			,'chosen/chosen.jquery.min.js'
		);
		$contenido['css_lib'] = array(
			'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'

			,'chosen/chosen.min.css'
		);
		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Configuracion/jsInformacionEmpresa.js'
		);
		$contenido['TipoOperacionDIAN'] = $this->InformacionEmpresa_model->TipoOperacionDIAN();
		$contenido['ResponsabilidadFiscal'] = $this->InformacionEmpresa_model->ResponsabilidadFiscal();
		$contenido['Empresa'] = $this->InformacionEmpresa_model->Empresa();

		$contenido["breadcrumb"] = [
			["nombre" => "Configuración", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Configuracion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	function actualizarBD(){
		if ($this->input->is_ajax_request()) {
			echo $this->InformacionEmpresa_model->actualizarBD();
		}else{
			show_404();
		}
	}

	function cargarForanea(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->InformacionEmpresa_model->cargarForanea());
		}else{
			show_404();
		}
	}

	function actualizarImagen(){
		if ($this->input->is_ajax_request()) {
			if (isset($_FILES['Lista_Anexos'])){
				if(preg_match('/#|"|á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['Lista_Anexos']['name'])===1){
					echo 3;
					return 3;
				}
			}

			$files = $_FILES;
			if (count($files) > 0) {
				$cpt = count($_FILES['Lista_Anexos']['name']);
			}
			$subidas = array();
			if (count($files) == 0) {
				echo 0;
				return 0;
			}else{
				if($files['Lista_Anexos']['size'] > 0){
					$config = array();
					$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/InformacionEmpresa';
					if (!file_exists($config['upload_path'])) {
						mkdir($config['upload_path'], 0777, true);
					}
					$config['allowed_types']    = 'png';
					$config['max_size']         = '20048';
					$config['overwrite']        = TRUE;
					$this->load->library('upload');
					$this->load->library('image_lib');
					//SUBIDA DE CADA ARCHIVO
					$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
					$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
					$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
					$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
					$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];

					$nombreDoc = 'logo_cliente.'.pathinfo($_FILES['Lista_Anexos']['name'], PATHINFO_EXTENSION);

					$config['file_name'] = $nombreDoc;
					$this->upload->initialize($config);

					$subida = array();
					$subida['nombre'] = $_FILES['Lista_Anexos']['name'];
					if ($this->upload->do_upload('Lista_Anexos')) {
						$data = $this->upload->data();
						echo 1;
						return 1;
					} else {
						echo 0;
						return 0;
					}
				}else{
					echo 0;
					return 0;
				}
			}
			echo 1;
			return 1;
		} else {
			show_404();
		}
	}

	function actualizarFondo(){
		if ($this->input->is_ajax_request()) {
			echo($this->InformacionEmpresa_model->actualizarFondo());
		} else {
			show_404();
		}
	}

	function quitarFondo(){
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->InformacionEmpresa_model->quitarFondo());
		} else {
			show_404();
		}
	}
}

?>