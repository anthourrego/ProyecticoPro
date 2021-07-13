<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] != base_url()){
			redirect(base_url());
		}
		//var_dump($this->session->userdata());
		if ($this->session->userdata('CEDULA') && $this->session->userdata('login')) {
			switch ($this->session->userdata('TipoV')) {
				case 'P':
				case 'A':
				case 'PR':
					redirect(site_url('Inicio'));
					break;
				default:
					$this->load->view('vRegistro');
					break;
			}
		}elseif ($this->session->userdata('CEDULA')) {
			$contenido['Cedula'] 	= $this->session->userdata('CEDULA');
			$contenido['Datos'] 	= $this->session->userdata('DATAINI');
			$this->load->view('vLogin', $contenido);
			
		}else{
			//$this->load->view('vLogin');
			$this->load->view('vNIT');
			// $this->load->view('vCedula');
		}
	}
	
}