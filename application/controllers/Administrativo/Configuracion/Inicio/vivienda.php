<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class vivienda extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(1703, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->DataTables_model->set_select(array(
			"V.ViviendaId"
			,"TV.Nombre AS nomVivienda"
			,"V.Nomenclatura"
			,"V.Citofono"
			,"V.Terreno"
			,"V.Construido"
			,"V.Matricula"
			,"V.CedulaCatastral"
			,"V.Pisos"
			,"V.VidaUtil"
			,"CASE WHEN V.Antejardin = 1 THEN 'Si' ELSE 'No' END AS Antejardin"
			,"CASE WHEN V.Patio = 1 THEN 'Si' ELSE 'No' END AS Patio"
			,"CASE WHEN V.Terraza = 1 THEN 'Si' ELSE 'No' END AS Terraza"
			,"CASE WHEN V.Cocina = 1 THEN 'Si' ELSE 'No' END AS Cocina"
			,"CASE WHEN V.Integral = 1 THEN 'Si' ELSE 'No' END AS Integral"
			,"V.NumHabitacion"
			,"V.NumBano"
			,"V.NumVentana"
			,"CASE WHEN V.Acueducto = 1 THEN 'Si' ELSE 'No' END AS Acueducto"
			,"CASE WHEN V.Alcantarillado = 1 THEN 'Si' ELSE 'No' END AS Alcantarillado"
			,"CASE WHEN V.Energia = 1 THEN 'Si' ELSE 'No' END AS Energia"
			,"CASE WHEN V.Gas = 1 THEN 'Si' ELSE 'No' END AS Gas"
			,"V.Valor"
			,"V.Observacion"
			,"CASE WHEN V.Estado = 'A' THEN 'Activo/a' ELSE 'Inactivo/a' END AS Estado"
		));
		$this->DataTables_model->set_table(array('Vivienda V'));
		$this->DataTables_model->set_joins(array(array('TipoVivienda TV', 'V.TipoviviendaId = TV.TipoViviendaId', 'left')));
		$this->DataTables_model->set_column_order(array(
			"ViviendaId"
			,"nomVivienda"
			,"Nomenclatura"
			,"Citofono"
			,"Terreno"
			,"Construido"
			,"Matricula"
			,"CedulaCatastral"
			,"Pisos"
			,"VidaUtil"
			,"Antejardin"
			,"Patio"
			,"Terraza"
			,"Cocina"
			,"Integral"
			,"NumHabitacion"
			,"NumBano"
			,"NumVentana"
			,"Acueducto"
			,"Alcantarillado"
			,"Energia"
			,"Gas"
			,"Valor"
			,"Observacion"
			,"Estado"
		));
		$this->DataTables_model->set_column_search(array('TV.Nombre','V.Nomenclatura',"V.Citofono",'V.Terreno','V.Construido','V.Matricula','V.CedulaCatastral','V.Valor'));
		$this->DataTables_model->set_order(array('TV.Nombre'=> 'asc','V.Nomenclatura'=> 'asc'));
	}

	function index() {
		$contenido['columnas'] 		= array('Id','Tipo de vivienda', 'Nomenclatura','Citofono', 'Terreno M2', 'Area construida M2', 'Matricula', 'Cedula catastral', 'N° de pisos', 'Años vida util', 'Antejardin', 'Patio', 'Terraza', 'Cocina', 'Integral', 'N° de habitaciones', 'N° de baños', 'N° de ventanas', 'Acueducto', 'Alcantarillado', 'Energia', 'Gas', 'Valor $COP', 'Observaciones', 'Estado');
		$contenido['tabla'] 		= 'Vivienda';
		$contenido['titulo'] 		= 'Viviendas';
		$contenido['tblNombre'] 	= 'Vivienda';
		$contenido['content_page'] 	= 'Administrativo/Configuracion/Inicio/vVivienda';
		$contenido['TipoVivienda'] 	= $this->db->query("SELECT TipoViviendaId As id,nombre FROM TipoVivienda WHERE Estado = 'A'")->result();
		$contenido['js_lib'] = array(
			'chosen/chosen.jquery.min.js'
		);

		$contenido["breadcrumb"] = [
			["nombre" => "Configuración", "ruta" => "Administrativo/Configuracion/Menu/Inicio/Configuracion"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/CRUD_view', $contenido);
	}

	function validaNomenclatura(){
		if ($this->input->is_ajax_request()) {
			$num = $this->input->post('Num');
			$res = 0;
			$sql = $this->db->query("SELECT ViviendaId FROM vivienda WHERE Nomenclatura = ?",array($num))->result();
			if (count($sql) > 0) {
				$res = 1;
			}
			echo json_encode($res);
		}else{
			show_404();
		}
	}
}
?>