<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cambioSesion extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}
	}

	function index(){
		$this->load->view('vRegistro');
	}
}
?>