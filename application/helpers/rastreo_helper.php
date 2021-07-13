<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('RASTREO')) {
	
	function RASTREO(){
		$RASTREO 					= $_POST['RASTREO'];
		$CI 						= & get_instance();
		$RASTREO['usuarioid'] 		= $CI->session->userdata('id');
		$RASTREO['equipo'] 			= $_SERVER['REMOTE_ADDR'];

		if (is_array($RASTREO['cambio'])) {
			for ($i=0; $i < count($RASTREO['cambio']); $i++) { 
				$RASTREO['cambio'][$i] = strlen($RASTREO['cambio'][$i]) > 247 ? substr($RASTREO['cambio'][$i], 0, 247)."..." : $RASTREO['cambio'][$i];
				$CI->db->query("SET DATEFORMAT YDM;
					INSERT INTO
					rastreo (fecha, programa, cambio, usuarioid, equipo, fechaservidor, Aplicacion)
				VALUES ('".$RASTREO['fecha']."', '".$RASTREO['programa']."', '".$RASTREO['cambio'][$i]."', '".$RASTREO['usuarioid']."', '".$RASTREO['equipo']."', GETDATE(), 'Residente')");
			}
		}else{
			$RASTREO['cambio'] = strlen($RASTREO['cambio']) > 247 ? substr($RASTREO['cambio'], 0, 247)."..." : $RASTREO['cambio'];
			$CI->db->query("SET DATEFORMAT YDM;
				INSERT INTO
				rastreo (fecha, programa, cambio, usuarioid, equipo, fechaservidor, Aplicacion)
			VALUES ('".$RASTREO['fecha']."', '".$RASTREO['programa']."', '".$RASTREO['cambio']."', '".$RASTREO['usuarioid']."', '".$RASTREO['equipo']."', GETDATE(), 'Residente')");
		}
	}
}
?>