<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class cTipoActividad extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1506, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('T.TipoActividadId'
			,'T.Nombre'
			,'F.Nombre AS Familia'
			,'T.Duracion','T.ValorHoraOrdinaria','T.ValorHoraNocturna','T.ValorHoraDominical',"CASE WHEN T.Estado = 'A' THEN 'ACTIVO' ELSE 'INACTIVO' END Estado"));
		$this->DataTables_model->set_table(array('TipoActividad T'));
		$this->DataTables_model->set_joins(array(array('Familia F', 'T.FamiliaId = F.FamiliaId', 'left')));
		$this->DataTables_model->set_column_order(array('TipoActividadId', 'Nombre', 'Familia','Duracion','ValorHoraOrdinaria','ValorHoraNocturna','ValorHoraDominical','Estado'));
		$this->DataTables_model->set_column_search(array('T.TipoActividadId', 'T.Nombre','T.Duracion','T.ValorHoraOrdinaria','T.ValorHoraNocturna','T.ValorHoraDominical','T.Estado'));
		$this->DataTables_model->set_order(array('TipoActividadId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'Familia','Duracion','ValorHoraOrdinaria','ValorHoraNocturna','ValorHoraDominical','Estado');
		$contenido['tabla'] = 'TipoActividad';
		$contenido['titulo'] = 'Tipo Actividad';
		$contenido['tblNombre'] = 'TipoActividad';
		$contenido['content_page'] = 'Administrativo/Configuracion/Incidencia/vTipoActividad';
		$contenido['Familia'] = $this->db->query("SELECT FamiliaId, Nombre FROM Familia ORDER BY Nombre ASC")->result();
		$contenido['js_lib'] = array(
			'chosen/chosen.jquery.min.js'
		);
		$contenido['css_lib'] = array(
			'chosen/chosen.min.css'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Incidencias", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Incidencias"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}
}
?>