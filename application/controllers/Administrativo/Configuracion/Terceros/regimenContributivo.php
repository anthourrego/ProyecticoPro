<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class RegimenContributivo extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1113, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array(
			'RegimenID'
			,'nombre'
			,'vretefuent'
			,'vreteiva'
			,'vreteica'
			,'vreteotro'
			,'cretefuent'
			,'creteiva'
			,'creteica'
			,'civa'
			,'tretefuent'
			,'treteiva'
			,'treteica'
			,'treteotro'
			,'tliquiva'
			,'vcree'
			,'ccree'
			,'tcree'
			,'CodigoDIAN'));
		$this->DataTables_model->set_table(array('TipoRegi'));
		$this->DataTables_model->set_column_order(array(
			'RegimenID'
			,'nombre'
			,'vretefuent'
			,'vreteiva'
			,'vreteica'
			,'vreteotro'
			,'cretefuent'
			,'creteiva'
			,'creteica'
			,'civa'
			,'tretefuent'
			,'treteiva'
			,'treteica'
			,'treteotro'
			,'tliquiva'
			,'vcree'
			,'ccree'
			,'tcree'
			,'CodigoDIAN'));
		$this->DataTables_model->set_column_search(array('RegimenID', 'nombre'));
		$this->DataTables_model->set_order(array('RegimenID' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array(
			'Código'
			,'Nombre'
			,'Ret. Fuente Ventas'
			,'Ret. IVA Ventas'
			,'Ret. ICA Ventas'
			,'Otras Retenciones Ventas'
			,'Ret. Fuente Compras'
			,'Ret. IVA Compras'
			,'Ret. ICA Compras'
			,'Calcula IVA Compras'
			,'Ret. Fuente Terceros'
			,'Ret. IVA Terceros'
			,'Ret. ICA Terceros'
			,'Otras Retenciones Terceros'
			,'Tercero Liquida IVA'
			,'CREE Ventas'
			,'CREE Compras'
			,'CREE Terceros'
			,'Regimen FE'
		);
		$contenido['tabla'] = 'TipoRegi';
		$contenido['titulo'] = 'Regímenes Contributivos';
		$contenido['tblNombre'] = 'Regímen Contributivo';
		$contenido['content_page'] = 'Administrativo/Configuracion/Terceros/vRegimenContributivo';

		$contenido["breadcrumb"] = [
			["nombre" => "Terceros", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Terceros"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>