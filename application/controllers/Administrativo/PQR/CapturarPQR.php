<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class CapturarPQR extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(3001, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/PQR/CapturarPQR_model'));
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/PQR/vCapturarPQR';
		$contenido['titulo'] = 'Capturar';

		$contenido['css_lib'] = array(
			'chosen/chosen.min.css'
		);

		$contenido['js_lib'] = array(
			'bs-custom-file-input.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'
			,'datetimepicker/moment.js'

			,'chosen/chosen.jquery.min.js'
		);

		$contenido['script_adicional'] = array(
			'personalizados/Administrativo/PQR/jsCapturarPQR.js'
		);

		$contenido["permisoTramite"] = 1 /* in_array(3030, $this->session->userdata('SEGUR')) */;

		$contenido["listaTipoPQR"] = $this->CapturarPQR_model->listaTipoPQR();
		$contenido["listaClientes"] = $this->CapturarPQR_model->listaClientes();

		$contenido["breadcrumb"] = [
			["nombre" => "PQR's", "ruta" => "Administrativo/PQR/menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}

	public function crear(){ 
		if ($this->input->is_ajax_request()) {

			$TipoPQRid 			= $this->input->post('TipoPQR');
			$PQRPedido 			= $this->input->post('PQRPedido');
			$productoId 		= $this->input->post('Producto');
			$otroCliente 		= $this->input->post('OtroCliente');
			$selectFact 		= $this->input->post('selectFact');
			$validarMaterial 	= false;
			if($selectFact == "DGFact"){
				$Factura 			= $this->input->post('Factura');
			}else{
				$Factura = $selectFact;
			}

			$productosPedido 	= json_decode($this->input->post('productosPedido'));

			$fecha = new DateTime();

			$datos = array(
				'UsuarioId'		=> $this->input->post('UsuarioId'), 
				'Fecha' 		=> $fecha->format("Y-m-d H:i:s"), 
				'TipoPQRid' 	=> $this->input->post('TipoPQR'),
				'Asunto' 		=> $this->input->post('Asunto'),
				'Descripcion' 	=> $this->input->post('Descripcion')
			);

			if($Factura != ""){
				$validarMaterial = true;
				$datos['Factura'] = $Factura;
			}

			if($PQRPedido == 1){
				if($otroCliente != "" && !empty($otroCliente)){
					$datos['OtroCliente'] = $otroCliente;
				} else {
					$datos['TerceroId'] = $this->input->post('TerceroId');
				}
				if(!empty($this->input->post('Pedido'))){
					$datos['Pedido'] = $this->input->post('Pedido');
				}
			}else if($PQRPedido == 0){
				if($otroCliente != "" && !empty($otroCliente)){
					$datos['OtroCliente'] = $otroCliente;
				} else {
					$datos['TerceroId'] = $this->input->post('TerceroId');
				}
			}

			$this->db->trans_begin();

			$idPQR = $this->CapturarPQR_model->insertar($datos);

			// 24/01/2018 JCSM - Enviado de alertas a servicio al cliente
			if($idPQR != 0){
				// 26/03/2018 JCSM - Adjunción de archivos

				// Inserto los productos
				if (json_encode($productosPedido) != '[{}]'){
					if($this->CapturarPQR_model->registrarProductosPedido($idPQR[0], $productosPedido, $validarMaterial) == 0){
						$this->db->trans_rollback();
						echo 0;
						return 0;
					}
				}

				$idPQR[] = $this->CapturarPQR_model->PQRArchivo('PQR', $idPQR[0]);

				if($this->CapturarPQR_model->enviarAlertasPQR('[Nueva PQR] - '.$this->input->post('Asunto'), $idPQR[0]) == 0){
					$this->db->trans_rollback();
					echo 0;
					return 0;
				}


			}else{
				$this->db->trans_rollback();
				echo 0;
				return 0;
			}

			$solicitud = "PQR".$this->input->post('TipoPQR').$idPQR[1];

			$datos = array(
				'Solicitud' => $solicitud
			);
			$this->CapturarPQR_model->act($idPQR[0],$datos);

			$this->db->trans_commit();

			echo json_encode($idPQR);
		} else {
			show_404();
		}
	}

	function verificarPedido(){
		if($this->input->is_ajax_request()) {
			echo json_encode($this->CapturarPQR_model->verificarPedido());
		}else{
			show_404();
		}
	}

	function verificarFactura(){
		if($this->input->is_ajax_request()) {
			echo json_encode($this->CapturarPQR_model->verificarFactura());
		}else{
			show_404();
		}
	}

	function listaMateriales(){
		if($this->input->is_ajax_request()) {
			echo json_encode($this->CapturarPQR_model->listaMateriales());
		}else{
			show_404();
		}
	}

	function cargarForanea(){
		if($this->input->is_ajax_request()) {
			echo json_encode($this->CapturarPQR_model->cargarForanea());
		}else{
			show_404();
		}
	}

	function listaClientes(){
		if($this->input->is_ajax_request()) {
			echo json_encode($this->CapturarPQR_model->listaClientes());
		}else{
			show_404();
		}
	}
}

?>