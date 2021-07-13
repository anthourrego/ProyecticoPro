<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cMenu extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")/*  || !in_array(2, $this->session->userdata('SEGUR')) */){
			redirect(base_url());
		}
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Incidencia/vMenu';
		
		$this->load->view('UI/default_view', $contenido);
	}	

}
?>