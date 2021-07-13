<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ClasificacionCliente extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1105, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array(
			'idClasificacion'
			,'Nombre'
			,'Estado'
			,'VentasInicial'
			,'VentasFinal'
		));
		$this->DataTables_model->set_table(array('ClasificacionCliente'));
		$this->DataTables_model->set_column_order(array(
			'idClasificacion'
			,'Nombre'
			,'Estado'
			,'VentasInicial'
			,'VentasFinal'
		));
		$this->DataTables_model->set_column_search(array('idClasificacion', 'Nombre'));
		$this->DataTables_model->set_order(array('idClasificacion' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array(
			'Código'
			,'Nombre'
			,'Estado'
			,'Rango Inicial de Ventas'
			,'Rango Final de Ventas'
		);
		$contenido['tabla'] = 'ClasificacionCliente';
		$contenido['titulo'] = 'Clasificación de Clientes';
		$contenido['tblNombre'] = 'Clasificación de Cliente';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vClasificacionCliente';
		$this->load->view('UI/CRUD_view', $contenido);
	}

	function ValidarRangos(){
		if ($this->input->is_ajax_request()) {
			$VentasInicial = $_POST['VentasInicial'];
			$VentasFinal = $_POST['VentasFinal'];
			$codigo = $_POST['codigo'];
			$query = "SELECT Nombre FROM ClasificacionCliente WHERE
			(
				($VentasInicial BETWEEN VentasInicial AND VentasFinal)
				OR ($VentasFinal BETWEEN VentasInicial AND VentasFinal)
				OR (VentasInicial BETWEEN $VentasInicial AND $VentasFinal)
				OR (VentasFinal BETWEEN $VentasInicial AND $VentasFinal)
			)
			AND Estado <> 'I'";
			if($codigo != ''){
				$query .= " AND idClasificacion <> '$codigo'";
			}
			$str = '';
			$consulta = $this->db->query($query)->result();
			$array = [];
			if(count($consulta) > 0){
				foreach ($consulta as $key) {
					$array[] = $key->Nombre;
				}
				$array = implode(', ', $array);
				$str = $array;
			}
			echo $str;
		}else{
			show_404();
		}
	}
}
?>