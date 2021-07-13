<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Iconografia extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		/* if (!$this->session->userdata("login")){
			redirect(base_url());
		} */

		//$this->load->model(array('Administrativo/Configuracion/Inicio/mMapa'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Configuracion/Inicio/vIconografia';
		$contenido['titulo'] = 'Iconografia';
		$contenido['js_lib'] = array(
		);
		$contenido['css_lib'] = array(
		);
		$contenido['script_adicional'] = array(
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Configuración", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Configuracion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	public function pruebas(){
		echo("funca");
	}
}
?>