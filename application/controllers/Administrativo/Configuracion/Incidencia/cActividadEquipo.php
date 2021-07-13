<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class cActividadEquipo extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1507, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		} 

		$this->DataTables_model->set_select(array('T.ActividadEquipoId'
			,'T.Nombre'
			,'E.Nombre AS NombreEquipo'
			,"CASE WHEN T.Tipo = 'T' THEN 'TIEMPO' ELSE 'CONSUMO' END Tipo"
			,'U.Nombre as UnidadMedida'
			,"CASE WHEN TiempoOperacion = '001' THEN 'Día' 
			WHEN TiempoOperacion = '002' THEN 'Semana'
			WHEN TiempoOperacion = '003' THEN 'Mensual'
			WHEN TiempoOperacion = '004' THEN 'Anual'
			ELSE '' END TiempoOperacion",'DiasAlerta'
		));

		$this->DataTables_model->set_table(array('ActividadEquipo T'));
		$this->DataTables_model->set_joins(array(array('Equipo E', 'T.EquipoId = E.EquipoId', 'left'),array('UnidadMedida U', 'T.UnidadMedidaId = U.UnidadMedidaId', 'left')));

		$this->DataTables_model->set_column_order(array('ActividadEquipoId', 'Nombre', 'NombreEquipo','Tipo','UnidadMedida','TiempoOperacion','DiasAlerta'));

		$this->DataTables_model->set_column_search(array('T.ActividadEquipoId', 'T.Nombre', 'E.Nombre','T.Tipo','U.Nombre','TiempoOperacion','T.DiasAlerta'));

		$this->DataTables_model->set_order(array('ActividadEquipoId' => 'asc'));
	}

	function index() {
		$contenido['columnas'] = array('Código', 'Nombre', 'NombreEquipo','Tipo','UnidadMedida','TiempoOperacion','DiasAlerta');
		$contenido['tabla'] = 'ActividadEquipo';
		$contenido['titulo'] = 'Operaciones de equipo';
		$contenido['tblNombre'] = 'ActividadEquipo';
		$contenido['content_page'] = 'Administrativo/Configuracion/Incidencia/vActividadEquipo';

		$contenido['Equipo'] = $this->db->query("SELECT EquipoId, Nombre FROM Equipo WHERE Estado = 'A' ORDER BY Nombre ASC")->result();

		$contenido['UnidadMedida'] = $this->db->query("SELECT UnidadMedidaId, Nombre FROM UnidadMedida WHERE Estado = 'A' ORDER BY Nombre ASC")->result();

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