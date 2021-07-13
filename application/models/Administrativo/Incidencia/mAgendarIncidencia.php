<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mAgendarIncidencia extends CI_Model {
 
	function incidencias(){ 
		//--------------------------------------------------------------------------------------------------
		// Utilities for our event-fetching scripts.
		//
		// Requires PHP 5.2.0 or higher.
		//--------------------------------------------------------------------------------------------------

		// PHP will fatal error if we attempt to use the DateTime class without this being set.
		//date_default_timezone_set('America/Bogota');
		
		// Date Utilities
		//----------------------------------------------------------------------------------------------
		// Parses a string into a DateTime object, optionally forced into the given timeZone.
		function parseDateTime($string, $timeZone=null) {
			$date = new DateTime(
			$string,
			$timeZone ? $timeZone : new DateTimeZone('America/Bogota')
				// Used only when the string is ambiguous.
				// Ignored if string has a timeZone offset in it.
			);
			if ($timeZone) {
				// If our timeZone was ignored above, force it.
				$date->setTimezone($timeZone);
			}
			return $date;
		}
		
		
		// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
		// but in UTC.
		function stripTime($datetime) {
			return new DateTime($datetime->format('Y-m-d'));
		}
		
		//--------------------------------------------------------------------------------------------------
		// This script reads event data from a JSON file and outputs those events which are within the range
		// supplied by the "start" and "end" GET parameters.
		//
		// An optional "timeZone" GET parameter will force all ISO8601 date stings to a given timeZone.
		//
		// Requires PHP 5.2.0 or higher.
		//--------------------------------------------------------------------------------------------------

		// Require our Event class and datetime utilities

		// Short-circuit if the client did not give us a date range.
		if (!isset($_GET['start']) || !isset($_GET['end'])) {
			die("Please provide a date range.");
		}

		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timeZone, like "2013-12-29".
		// Since no timeZone will be present, they will parsed as UTC.
		$range_start = parseDateTime($_GET['start']);
		$range_end = parseDateTime($_GET['end']);

		// Parse the timeZone parameter if it is present.
		$time_zone = null;
		if (isset($_GET['timeZone'])) {
			$time_zone = new DateTimeZone($_GET['timeZone']);
		}

		$sql = "SELECT 
					CONCAT('Nro ', HI.Numero , ' - ', HI.Asunto) AS title
					,A.FechaIni AS 'start'
					,A.FechaFin AS 'end'
					,EI.ColorHexa AS 'backgroundColor'
					,EI.ColorHexa AS 'borderColor'
					,HI.TipoIncidenciaId
					,HI.EstadoIncidenciaId
					,HI.TipoPrioridadIncidenciaId
					,HI.ItemEquipoId
					,HI.OperacionId
					,HI.Ticket
					,HI.Asunto
					,HI.Descripcion
					,A.FechaIni
					,A.FechaFin
					,HI.Fecha
					,I.Serial
					,HI.Numero
					,HI.HeadIncidenciaId
					,E.nombre as NombreEquipo
					,EI.Cierre
				FROM Agendamiento A
					INNER JOIN HeadIncidencia HI ON A.HeadIncidenciaId =  HI.HeadIncidenciaId
					LEFT JOIN ItemEquipo I ON HI.ItemEquipoId = I.ItemEquipoId
					LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
					LEFT JOIN EstadoIncidencia EI ON HI.EstadoIncidenciaId = EI.EstadoIncidenciaId
				WHERE 
					(A.FechaIni BETWEEN DATEADD(MONTH, -1, FORMAT(CAST('" . $_GET['start'] . "' AS DATE), 'yyyy-MM-dd')) AND  DATEADD(MONTH, +1, FORMAT(CAST('" . $_GET['end'] . "' AS DATE), 'yyyy-MM-dd'))) 
					OR (A.FechaFin BETWEEN DATEADD(MONTH, -1, FORMAT(CAST('" . $_GET['start'] . "' AS DATE), 'yyyy-MM-dd')) AND DATEADD(MONTH, +1, FORMAT(CAST('" . $_GET['end'] . "' AS DATE), 'yyyy-MM-dd')))";

		$incidencias = $this->db->query($sql)->result();

		// Accumulate an output array of event data arrays.
		$output_arrays = array();
		foreach ($incidencias as $array) {
			$array->editable = $array->Cierre == 0 ? true : false;
			// Convert the input array into a useful Event object
			$event = new Event(get_object_vars($array), $time_zone);

			// If the event is in-bounds, add it to the output
			if ($event->isWithinDayRange($range_start, $range_end)) {
				$output_arrays[] = $event->toArray();
			}
		}

		// Send JSON to the client.
		return($output_arrays);
	}

	public function listaEquipos(){
		$sql = "SELECT 
					I.ItemEquipoId
					,E.Nombre
					,I.Serial
				FROM Itemequipo I
					LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
				WHERE E.Estado = 'A' AND I.Estado = 'A'";

		$consulta = $this->db->query($sql)->result();

		return $consulta;
	}
	
	public function listaTipoIncidencia(){
		$sql = "SELECT TipoIncidenciaId,Nombre FROM TipoIncidencia WHERE Estado = 'A'";
		$listaTipoIncidencia = $this->db->query($sql)->result();
		return $listaTipoIncidencia;
	}
	
	public function listaEstadoIncidencia(){
		$sql = "SELECT 
					EstadoIncidenciaId
					,Nombre
					,ColorHexa
					,Cierre 
				FROM EstadoIncidencia";
		$listaEstadoIncidencia = $this->db->query($sql)->result();
		return $listaEstadoIncidencia;
	}
	
	public function listaTipoPrioridadIncidencia(){
		$sql = "SELECT 
					TipoPrioridadIncidenciaId
					,Nombre
					,ValorFrecuencia
					,CASE 
						WHEN Tiempo = '001' THEN 'Hora'
						WHEN Tiempo = '002' THEN 'Dia'  
						WHEN Tiempo = '003' THEN 'Semana'  
						WHEN Tiempo = '004' THEN 'Mensual' 
						WHEN Tiempo = '005' THEN 'Anual'
					END Tiempo 
				FROM TipoPrioridadIncidencia 
				WHERE Estado = 'A'
				ORDER BY Nombre ASC";
		$listaTipoPrioridadIncidencia = $this->db->query($sql)->result();
		return $listaTipoPrioridadIncidencia;
	}
	
	public function listaOperacion(){
		$ItemEquipoId = $this->input->post('ItemEquipoId');
		
		$sql = "SELECT 
					OperacionId
					,Operacion
					,ItemEquipoId 
				FROM Operacion 
				WHERE ItemEquipoId = '$ItemEquipoId'
				ORDER BY Operacion ASC";
		$listaOperacion = $this->db->query($sql)->result();
		return $listaOperacion;
	}

	public function insertar($data, $detalle, $agendamiento){

		$sql = "SELECT ConseHeadIncidencia FROM Montaje";
		$montaje = $this->db->query($sql)->result();

		if(count($montaje) > 0 ){
			$sql = "UPDATE Montaje SET ConseHeadIncidencia = CASE WHEN ConseHeadIncidencia IS NULL THEN 1 ELSE ConseHeadIncidencia + 1 END";
		}else{
			$sql = "INSERT INTO Montaje (ConseHeadIncidencia) values (1)";
		}
		
		try{
			$this->db->query($sql);
		}catch (Exception $e){
			return 0;
		}

		$sql = "SELECT ConseHeadIncidencia FROM Montaje";
		try{
			$Numero = $this->db->query($sql)->row()->ConseHeadIncidencia;
			$data['Numero'] = $Numero;

		}catch (Exception $e){
			return 0;
		}
		
		try{
			$this->db->insert('HeadIncidencia', $data);
			$incidenciaID = $this->db->insert_id();
			$agendamiento['HeadIncidenciaId'] = $incidenciaID;
		}catch (Exception $e){
			return 0;
		}

		try{
			$this->db->insert('Agendamiento', $agendamiento);
		}catch (Exception $e){
			return 0;
		}

		try{
			$detalle['HeadIncidenciaId'] = $incidenciaID;
			$this->db->insert('DetalleIncidencia', $detalle);
			$detallaid = $this->db->insert_id();
		}catch (Exception $e){
			return 0;
		}

		return array($incidenciaID, $Numero);
	}

	// 20/01/2020 ASUP - Crea alerta para todos los usuarios
	public function enviarAlertas($detalle, $numero) {
		$user = $this->session->userdata('id');

		$update = "UPDATE Alerta SET Estado = 'C', Ejecutada = GETDATE() WHERE Tipo = 'IN' AND Numero = '$numero'";
		$this->db->query($update);		

		$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
				SELECT '$user', S.usuarioId, '$detalle', GETDATE(), GETDATE(), 'IN', '', '$numero'
				FROM Segur S 
					INNER JOIN PermisoSistema PS ON S.usuarioId = PS.UsuarioId OR S.perfilId = PS.PerfilId
				WHERE PS.Permiso = '5'";
		$this->db->query($sql);

		if ($this->db->trans_status() === FALSE) {
			return 0;
		} else {
			return 1;
		}
	}

	public function agregarNota($nota) {
		$this->db->trans_begin();
		 
		$this->db->insert('NotaIncidencia', $nota);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			$insert_id = $this->db->insert_id();

			return $insert_id; 
		}
	}

	function AdjuntarArchivos($tipo, $id, $incidencia) {
		$files = $_FILES;
		$cpt = count($_FILES['archivos']['name']);
		$subidas = array();

		if($files['archivos']['size'][0] > 0) {
			// Configuración upload
			$config = array();
			$config['upload_path']      = FCPATH.'uploads/'.$this->session->userdata('NIT').'/Incidencia/'  . $incidencia;
			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');

			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			// Subida de cada archivo
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['archivos']['name']     = $files['archivos']['name'][$i];
				$_FILES['archivos']['type']     = $files['archivos']['type'][$i];
				$_FILES['archivos']['tmp_name'] = $files['archivos']['tmp_name'][$i];
				$_FILES['archivos']['error']    = $files['archivos']['error'][$i];
				$_FILES['archivos']['size']     = $files['archivos']['size'][$i];
				$config['file_name'] = 'Anexo_'.$id."_".$_FILES['archivos']['name'];
				$this->upload->initialize($config); 

				$archivo = array(
					'Id'      => $id,
					'Tipo'    => $tipo,
					'Fecha'   => date("Y-m-d H:i:s"),
					'Ruta'    => './uploads/'.$this->session->userdata('NIT').'/Incidencia/' . $incidencia . '/Anexo_'.$id."_".$_FILES['archivos']['name']
				);

				// Inserta la PQR para conseguir su consecutivo
				$this->db->insert('Anexo', $archivo);
				$insert_id = $this->db->insert_id();
				
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
				} else {
					$subida = array();
					$subida['nombre'] = $_FILES['archivos']['name'];
					$this->upload->initialize($config);
					if ($this->upload->do_upload('archivos')) {
						$data = $this->upload->data();
						// Resize
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data['full_path'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 512;
						$config['height'] = 512;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$subida['estado'] = 1;
					} else {
						$this->db->trans_rollback();
						$subida['estado'] = 0;
					}
					array_push($subidas, $subida);
				}
			}
		}
		return json_encode($subidas);
	}

	public function actualiarFechaAgenda(){

		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');
		$data = $this->input->post('data');

		$this->db->trans_begin();

		$this->db->where('HeadIncidenciaId', $HeadIncidenciaId);
		$this->db->update('Agendamiento',$data);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			//RASTREO();
			return 1;
		}
	}

	public function actualizarAlertaIncidencia(){
		$user = $this->session->userdata('id');
		$idIncidencia = $this->input->post("HeadIncidenciaId");
		
		$this->db->query("UPDATE Alerta SET Estado = 'C', Ejecutada = GETDATE() WHERE Tipo = 'IN' AND Numero = '$idIncidencia' AND AsignadoA = '$user'");	

		if ($this->db->trans_status() === FALSE) {
			return 0;
		} else {
			return 1;
		}
	}
}

class Event {

	// Tests whether the given ISO8601 string has a time-of-day or not
	const ALL_DAY_REGEX = '/^\d{4}-\d\d-\d\d$/'; // matches strings like "2013-12-29"

	public $title;
	public $allDay; // a boolean
	public $start; // a DateTime
	public $end; // a DateTime, or null
	public $properties = array(); // an array of other misc properties


	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timeZone of the parsed dates.
	public function __construct($array, $timeZone=null) {

		$this->title = $array['title'];
	
		if (isset($array['allDay'])) {
			// allDay has been explicitly specified
			$this->allDay = (bool)$array['allDay'];
		} else {
			// Guess allDay based off of ISO8601 date strings
			$this->allDay = preg_match(self::ALL_DAY_REGEX, $array['start']) &&
			(!isset($array['end']) || preg_match(self::ALL_DAY_REGEX, $array['end']));
		}
	
		if ($this->allDay) {
			// If dates are allDay, we want to parse them in UTC to avoid DST issues.
			$timeZone = null;
		}
	
		// Parse dates
		$this->start = parseDateTime($array['start'], $timeZone);
		$this->end = isset($array['end']) ? parseDateTime($array['end'], $timeZone) : null;
	
		// Record misc properties
		foreach ($array as $name => $value) {
			if (!in_array($name, array('title', 'allDay', 'start', 'end'))) {
				$this->properties[$name] = $value;
			}
		}
	}


	// Returns whether the date range of our event intersects with the given all-day range.
	// $rangeStart and $rangeEnd are assumed to be dates in UTC with 00:00:00 time.
	public function isWithinDayRange($rangeStart, $rangeEnd) {

		// Normalize our event's dates for comparison with the all-day range.
		$eventStart = stripTime($this->start);
	
		if (isset($this->end)) {
			$eventEnd = stripTime($this->end); // normalize
		} else {
			$eventEnd = $eventStart; // consider this a zero-duration event
		}
	
		// Check if the two whole-day ranges intersect.
		return $eventStart < $rangeEnd && $eventEnd >= $rangeStart;
	}


	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {

		// Start with the misc properties (don't worry, PHP won't affect the original array)
		$array = $this->properties;
	
		$array['title'] = $this->title;
	
		// Figure out the date format. This essentially encodes allDay into the date string.
		if ($this->allDay) {
			$format = 'Y-m-d'; // output like "2013-12-29"
		}
		else {
			$format = 'c'; // full ISO8601 output, like "2013-12-29T09:00:00+08:00"
		}
	
		// Serialize dates into strings
		$array['start'] = $this->start->format($format);
		if (isset($this->end)) {
			$array['end'] = $this->end->format($format);
		}
	
		return $array;
	}
}

?>