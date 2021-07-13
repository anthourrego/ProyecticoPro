<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class cTipoPrioridadIncidencia extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") ||  !in_array(1503, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('TipoPrioridadIncidenciaId', 'Nombre','ValorFrecuencia',
			"CASE WHEN Estado = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END Estado"
			,"CASE WHEN Tiempo = '001' THEN 'Hora' 
			WHEN Tiempo = '002' THEN 'Dia'
			WHEN Tiempo = '003' THEN 'Semana'
			WHEN Tiempo = '004' THEN 'Mensual'
			ELSE 'Anual' END Tiempo"));
		$this->DataTables_model->set_table(array('TipoPrioridadIncidencia'));

		$this->DataTables_model->set_column_order(array('TipoPrioridadIncidenciaId', 'Nombre','ValorFrecuencia','Tiempo','Estado'));
		$this->DataTables_model->set_column_search(array('TipoPrioridadIncidenciaId', 'Nombre','ValorFrecuencia','Tiempo','Estado'));
		$this->DataTables_model->set_order(array('TipoPrioridadIncidenciaId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Id', 'Nombre','ValorFrecuencia','Tiempo','Estado');
		$contenido['tabla'] = 'TipoPrioridadIncidencia';
		$contenido['titulo'] = 'Prioridad Incidencia';
		$contenido['tblNombre'] = 'TipoPrioridadIncidencia';
		$contenido['content_page'] = 'Administrativo/Configuracion/Incidencia/vTipoPrioridadIncidencia';

		$contenido["breadcrumb"] = [
			["nombre" => "Incidencias", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Incidencias"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>
