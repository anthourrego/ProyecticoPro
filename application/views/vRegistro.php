<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<?php
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
	?>
	<title>Cocora Residente</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/ico/Icon.ico">

	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">	
	<link href="<?= base_url() ?>assets/css/font-awesome/css/all.min.css" rel="stylesheet">
	<!-- <link href="<?= base_url() ?>assets/css/alertify/bootstrap.min.css" rel="stylesheet"> -->
	<link href="<?= base_url() ?>assets/css/alertify/alertify.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/chosen/chosen.min.css" rel="stylesheet">	
	<!-- <link href="<?= base_url() ?>assets/css/personalizados/login.css?<?= rand() ?>" rel="stylesheet"> -->
</head>

<style type="text/css">
	.hidden {
		display: none !important;
	}

	#overlay {
		bottom: 0;
		left: 0;
		position: fixed;
		right: 0;
		top: 0;
		z-index: 100000;
		cursor: wait;
	}

	@media(max-width: 767px) {
		#overlay {
			background: rgba( 255, 255, 255, .8 ) url("assets/img/ajax-loader.gif") 50% 50% no-repeat;
		}
	}

	body{
		/*background-image: url("<?=base_url()?>assets/img/Cocora2.png");*/
		min-height: 100vh;
		background-repeat: no-repeat;
		background-size: contain;
		background-position: center;
		background-attachment: fixed;
	}

	body:before{
		width: 100%;
		content: "";
		min-height: 100vh;
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0.7;
		z-index: -1;
	}

	.chosen-container{
		height: calc(1.5em + .75rem + 2px) !important;
		width: 100% !important;
		font-size: 1rem !important;
		font-weight: 400 !important;
		line-height: 1.5 !important;
		background: rgba(255, 255, 255, 0.2);
		color: #fff;
		border: none !important;
		border-radius: .25rem !important;
		transition: all 0.5s ease-out;
	}

	.chosen-container-single a {
		height: calc(1.5em + .75rem + 2px) !important;
		width:s 100% !important;
		font-size: 1rem !important;
		font-weight: 400 !important;
		line-height: 1.5 !important;
		
		background: transparent !important;
		box-shadow: none !important;
		text-align: left !important;
		background: rgba(255, 255, 255, 0.2);
		color: #fff;
		border: none !important;
		border-radius: .25rem !important;
		transition: all 0.5s ease-out;
	}

	.chosen-single > span{
		padding: .375rem 0rem;
		color: #fff;
	}

	.chosen-container-single b{
		margin-top: 8px
	}

	.chosen-container-active{
		outline: 0;
		border-radius: .25rem;
		background: rgba(255, 255, 255, 0.1);
		box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
	}

	.login{
		backdrop-filter: blur(3px);
		background: rgba(0, 0, 0, 0.4);
	}
	.form-control::placeholder{
		color: white !important;
		opacity: 0.8 !important;
	}
	.cc{
		background-color: #aeaeae;
		border-color: #aeaeae;
		color: white;
		font-size: 18px;
		font-weight: bolder;
	}
	.cc:focus{
		background-color: #aeaeae;
		border-color: #80bdff;
		color: white;
		font-size: 18px;
		font-weight: bolder;
		outline: 0;
		box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
	}
	.card{
		background-color: #9f9f9f;
		border-color: #c8c2c2;
		text-decoration: none !important;

	}
	.card:hover{
		background-color: #858585;
		border-color: #c8c2c2;
		text-decoration: none !important;
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.15);
		-webkit-transform: scale(1.1);
		-ms-transform: scale(1.1);
		transform: scale(1.1);
		transition: 0.3s ease;
	}
	.card:focus{
		background-color: #858585;
		border-color: #c8c2c2;
		text-decoration: none !important;
		-webkit-transform: scale(1.1);
		-ms-transform: scale(1.1);
		transform: scale(1.1);
		transition: 0.3s ease;
	}
	.card-body h6{
		font-weight: bolder;
		text-align: center;
		color: white;
		font-size: 18px;
	}
	.fas{
		color: white;
		font-size: 80px;
		text-align: center;
	}
	.far{
		color: white;
		font-size: 80px;
		text-align: center;
	}
</style>

<div href="javascript:void(0);" id="overlay"></div>
<body class="container-fluid">
	<div class="row no-gutter">
		<div class="col-12 login">
			<div style="min-height: 100vh;" class="d-flex align-items-center">
				<div class="container">
					<div class="row justify-content-md-center">
						<?php 
							$vista 	= $this->session->userdata('navV');
							$adm 	= ($vista == 'ALL' || $vista == 'PA' || $vista == 'PRA') ? '' : 'd-none';
							$pr 	= ($vista == 'ALL' || $vista == 'PPR' || $vista == 'PRA') ? '' : 'd-none';
							$p 		= ($vista == 'ALL' || $vista == 'PPR' || $vista == 'PA') ? '' : 'd-none';
						?>
						<div class="col-12 col-md-6 col-xl-4 <?= $adm?> dataDiv" data-ini="Admin" data-tipo="A">
							<a class="card w-100 mt-2 tipoV>" href="#">
								<i class="fas fa-book-reader mt-2"></i>
								<div class="card-body">
									<h6>Administrativo</h6>
								</div>
							</a>
						</div>
						<div class="col-12 col-md-6 col-xl-4 <?= $pr?> dataDiv" data-ini="Propietario" data-tipo="PR">
							<a class="card w-100 mt-2 tipoV" href="#">
								<i class="fas fa-house-user mt-2"></i>
								<div class="card-body">
									<h6>Residentes / Propietarios</h6>
								</div>
							</a>
						</div>
						<div class="col-12 col-md-6 col-xl-4 <?= $p?> dataDiv" data-ini="Porteria" data-tipo="P">
							<a class="card w-100 mt-2 tipoV" href="#">
								<i class="far fa-address-card mt-2"></i>
								<div class="card-body">
									<h6>Porterias</h6>
								</div>
							</a>
						</div>
						<!-- <a class="card col-12 col-md-4 col-xl-3 mt-2 tipoV" href="#" data-ini="Propietario">
						</a>
						<a class="card col-12 col-md-4 col-xl-3 mt-2 tipoV" href="#" data-ini="Portero">
						</a> -->
						<div class="col-12 col-md-10 col-xl-8 mx-auto py-4">
							<p class="text-white" style="text-align: center;font-size: 12px;line-height: 15px;margin-top: 11px;margin-bottom: -25px;">Servicio al Cliente <a href="tel:(+036)3151720" style="color:#fff;"><b style="font-weight: 600;">(6) 3151720</b></a> - Movil <a href="tel:(+57)3206321074" style="color:#fff;"><b style="font-weight: 600;">320 632 1074</b></a> Copyright (c) By Prosof S.A.S</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<footer>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>	
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/chosen/chosen.jquery.min.js"></script>		
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/alertify/alertify.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/libraries/jsRastreo.js"></script>
</footer>

</html>

<script type="text/javascript">
	(function() {
		$(".chosen-select").chosen();

		document.addEventListener('DOMContentLoaded', function (e) {
			$("#overlay").addClass('hidden');
			$('#NIT').attr('disabled', false);
			setTimeout(function(){
				$('#NIT').focus();
			},0);
			$(document).on({
				ajaxStart: function() {
					$("#overlay").removeClass('hidden');
				},
				ajaxStop: function() {
					$("#overlay").addClass('hidden');
				},
				ajaxError: function(funcion, request, settings){
					if(request.responseText != '' && request.responseText != undefined){
						$("#overlay").removeClass('hidden');
						alertify.alert('Error', request.responseText, function(){
							this.destroy();
						});
						console.error(funcion);
						console.error(request);
						console.error(settings);
					}
				}
			});
			$(".dataDiv").off("click").on("click",function(e){
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: "<?=base_url()?>Login/inicio",
					data: {
						Tipo 	: $(this).attr('data-tipo'),
						RASTREO : RASTREO("Ingresa al Sistema Cocora Residente "+$(this).attr('data-ini')+" ", 'Ingreso Sistema')
					},
					success:function(res){
						switch(res){
							case '1':
								location.href = "<?= base_url() ?>";
								break;
							case 'error':
								alertify.alert('Advertencia', 'A ocurrido un error en el sistema, porfavor comuniquese con el administrador del sistema.');
								break;
							default:
								break;
						}
					}
				});
			})
		});
	})();
</script>