<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<?php
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
	?>
	<title>Residente - Prosof</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/ico/Icon.ico">

	<!-- AdminLTE CSS -->
	<link href="<?= base_url() ?>assets/css/adminLTE/adminlte.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/overlayScrollbars/OverlayScrollbars.min.css" rel="stylesheet">	

	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/font-awesome/css/all.min.css" rel="stylesheet">

	<!-- Alertify -->
	<link href="<?= base_url() ?>assets/css/alertify/alertify.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/alertify/themes/bootstrap.min.css" rel="stylesheet">
	
	<!-- CSS Adicionales -->
	<?php
		if(isset($css_lib)){
			foreach ($css_lib as $css) {
				printf('<link rel="stylesheet" href="%s" rel="stylesheet" type="text/css">', base_url("assets/css/".$css)); 
			}
		}
	?>

	<link href="<?= base_url() ?>assets/css/personalizados/cssGlobal.css?<?= rand() ?>" rel="stylesheet">

	<?php
		if(isset($css_adicional)){
			foreach ($css_adicional as $css) {
				printf('<link rel="stylesheet" href="%s" rel="stylesheet" type="text/css">', base_url("assets/css/".$css."?".rand())); 
			}
		}
	?>
</head>

<div href="javascript:void(0);" id="overlay"></div>