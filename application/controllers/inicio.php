<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}
	}

	function index(){
		$inicio = '';
		switch ($this->session->userdata('TipoV')) {
			case 'A':
				$inicio = 'vInicio';
				break;
			case 'PR':
				$inicio = 'vInicioPropietario';
				break;
			case 'P':
				$inicio = 'vInicioPorteria';
				break;
			default:
				# code...
				break;
		}
		$contenido['content_page'] = $inicio;
		$contenido['Ini'] = true;
		$this->load->view('UI/default_view', $contenido);
	}
}
?>