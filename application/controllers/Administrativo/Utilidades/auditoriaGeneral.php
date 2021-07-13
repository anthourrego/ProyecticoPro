<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AuditoriaGeneral extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(2001, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}
	}

	function index(){
		$contenido['content_page'] = 'Administrativo/Utilidades/vAuditoriaGeneral';
		$contenido['titulo'] = 'Informe de Auditoría';

		$contenido['css_lib'] = array(
			'datetimepicker/bootstrap-datetimepicker.min.css'

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
			,'dataTables/buttons.dataTables.min.css'

			,'chosen/chosen.min.css'
		);
		$contenido['js_lib'] = array(
			'datetimepicker/moment.js'
			,'datetimepicker/bootstrap-datetimepicker.min.js'
			,'personalizados/datepicker.js'

			,'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js'
			,'dataTables/dataTables.scroller.min.js'
			,'dataTables/dataTables.buttons.min.js'
			,'dataTables/buttons.flash.min.js'
			,'dataTables/jszip.min.js'
			,'dataTables/pdfmake.min.js'
			,'dataTables/vfs_fonts.js'
			,'dataTables/buttons.bootstrap4.min.js'
			,'dataTables/buttons.html5.min.js'
			,'dataTables/buttons.print.min.js'
			,'inputmask/jquery.inputmask.bundle.min.js'

			,'chosen/chosen.jquery.min.js'
		);
		$contenido['script_adicional'] = array(
			'personalizados/jsDataTables.js'
			,'personalizados/Administrativo/Utilidades/jsAuditoriaGeneral.js'
		);

		$contenido['Usuarios'] = $this->db->query("SELECT usuarioid, CONCAT(RTRIM(usuarioid),' - ',RTRIM(nombre)) nombre FROM Segur ORDER BY nombre ASC")->result();
		$contenido['Opciones'] = array();
		$contenido['json'] = '';
		if (isset($_POST['json'])){
			$contenido['json'] = $_POST['json'];
			$json = json_decode($_POST['json']);
			$sql = "SELECT DISTINCT programa FROM Rastreo WHERE (CAST(Fecha AS DATE) BETWEEN '".$json->fInicial."' AND '".$json->fFinal."')";
			if($json->UsuarioId && $json->UsuarioId != ''){
				$sql .= " AND UsuarioId = '".$json->UsuarioId."'";
			}
			if($json->Opciones && $json->Opciones != ''){
				$sql .= " AND programa = '".$json->Opciones."'";
			}
			$sql .= " ORDER BY programa ASC";
			$contenido['Opciones'] = $this->db->query($sql)->result();
		}

		$contenido["breadcrumb"] = [
			["nombre" => "Utilidades", "ruta" => "Administrativo/Utilidades/Menu"]
			,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
		];

		$this->load->view('UI/gestion_view', $contenido);
	}
}

?>