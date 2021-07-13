<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('Busqueda_model'));
	}

	function dataTable(){
		$data['campos'] = array();
		if(isset($_GET['campos'])){
			$data['campos'] = json_decode($_GET['campos']);
		}
		$this->load->view('UI/busqueda', $data);
	}

	function consultarCliente() {
		$codigo = $this->input->post('cod');
		$datos = $this->Busqueda_model->consultarCliente($codigo); 
		echo json_encode($datos);
	}

	function consultaProducto() {
		if($this->input->is_ajax_request()) {
			$codigo = $this->input->post('cod');
			echo json_encode($this->Busqueda_model->consultaProducto($codigo));
		}else{
			show_404();
		}
	}

	function consultarTipoMaterial() {
		if($this->input->is_ajax_request()) {
			$codigo = $this->input->post('cod');
			echo json_encode($this->Busqueda_model->consultarTipoMaterial($codigo));
		}else{
			show_404();
		}
	}

}

?>