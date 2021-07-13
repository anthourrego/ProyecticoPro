<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('SEGUR')) {
	
	function SEGUR($opcion, $href){  

		$CI = & get_instance();
		$SEGUR = $CI->session->userdata('SEGUR');
		if(in_array($opcion, $SEGUR)){
			$href = "href='".base_url().$href."'";
		}else{
			if($href == '#'){
				$style = "display: none";
			}else{
				$style = "cursor: not-allowed";
			}
			$href = "href='javascript:void(0);' onclick='disabled($(this));' style='".$style."'";
		}
		return $href;
		
	}
}   
?>