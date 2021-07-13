<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class CambioClave extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(2002, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Utilidades/CambioClave_model'));
	}

	function cambiarClave(){
		if($this->input->is_ajax_request()){
			echo $this->CambioClave_model->cambiarClave();
		}else{
			show_404();
		}
	}
}

?>