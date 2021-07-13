<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Residente - Prosof</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/ico/128.ico?<?= rand() ?>">

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/font-awesome/css/all.min.css" rel="stylesheet">
	<style type="text/css">
		.salto {
			page-break-after:always;
		}
        .nDerecha {
            text-align: right;
        }
	</style>
</head>
<div class="salto">
<?php
	$this->load->view($reporte);
?>
</div>

<script type="text/javascript">
    window.focus();
    window.print();
</script>