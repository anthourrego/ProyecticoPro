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
	<link href="<?= base_url() ?>assets/css/alertify/alertify.min.css" rel="stylesheet">
	<!-- <link href="<?= base_url() ?>assets/css/alertify/bootstrap.min.css" rel="stylesheet"> -->
	<link href="<?= base_url() ?>assets/css/chosen/chosen.min.css" rel="stylesheet">
	<!-- <link href="<?= base_url() ?>assets/css/personalizados/login.css?<?= rand() ?>" rel="stylesheet"> -->
</head>

<style>
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

	body {
		background-image: url("<?=base_url()?>assets/img/Cocora.png");
		min-height: 100vh;
		background-repeat: no-repeat;
		background-size: 290px 350px;
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
		width: 100% !important;
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
		background: rgba(0, 0, 0, 0.5);
	}

	.formTrasnparent {
		background: transparent !important;
		box-shadow: none !important;
		text-align: left !important;
		background: rgba(255, 255, 255, 0.2) !important;
		color: #fff !important;
		border: none !important;
		border-radius: .25rem !important;
		transition: all 0.5s ease-out;
		font-weight: bolder;
	}

	.formTrasnparent:focus {
		outline: 0;
		border-radius: .25rem;
		background: rgba(255, 255, 255, 0.1) !important;
		box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25) !important;
	}

	.formTrasnparent::placeholder {
		color: #fff !important;
	}
</style>

<div href="javascript:void(0);" id="overlay"></div>
<body class="container-fluid">
	<div class="row no-gutter">
		<div class="col-12 col-md-6 col-lg-5 col-xl-4 login">
			<div style="min-height: 100vh;" class="d-flex align-items-center">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-10 col-xl-8 mx-auto py-4">
							<form id="login" action="">
								<div class="ClaseIntroNit mt-3" style="text-align:center;">
									<a href="https://prosof.com.co" target="blank_"><img src="<?=base_url()?>assets/img/Cocora2.png?<?= rand() ?>" style="width: 180px;"></a>
								</div>
								<div class="form-group mt-3">
									<?php
										if (count($Datos) > 0 && count($Datos) == 1) {
											echo '<input type="text" title="'.$Datos[0]->Conjunto.'" class="form-control formTrasnparent" id="txtConjunto" name="<?= rand() ?>" autocomplete="off" value="'.$Datos[0]->Conjunto.'" data-nit="'.$Datos[0]->Nit.'" readonly>';
										}else{
											echo '
												<select class="chosen-select" required autofocus id="conjunto" name="<?= rand() ?>">';
											echo '<option value="0" disabled selected>Conjunto...</option>';
											for ($i=0; $i < count($Datos); $i++) { 
												echo '<option value="'.$Datos[$i]->Nit.'">'.$Datos[$i]->Conjunto.'</option>';
											}
											echo '</select>';
										}
									?>
								</div>
								<div class="form-group mt-3">
									<?php
										if (count($Datos) > 0 && count($Datos) == 1) {
											echo '<input type="text" title="'.$Datos[0]->Nombre.'" class="form-control formTrasnparent" id="txtUsuario" name="<?= rand() ?>" required="" autocomplete="off" value="'.$Datos[0]->Nombre.'" data-user="'.$Datos[0]->CodigoUsuario.'" readonly>';
										}else{
											echo '<input type="text" class="form-control formTrasnparent" id="txtUsuario" name="<?= rand() ?>" required="" placeholder="Usuario..." autocomplete="off" readonly>';
										}
									?>
								</div>
								<div class="form-group">
									<input type="password" class="form-control formTrasnparent" id="password" name="<?= rand() ?>" placeholder="Contraseña:" required="" method="post" autocomplete="off" disabled>
								</div>
							</form>
							<div class="row">
								<div class="col-6">
									<button class="btn btn-secondary btn-block" name="Submit" value="Ingresar" type="Submit" form="login">Ingresar</button>
								</div>
								<div class="col-6">
									<form id="regresar" action="<?= base_url('login/ingresar') ?>" method="post">
										<button class="btn btn-secondary btn-block" name="regresar" value="regresar" type="Submit" form="regresar">Regresar</button>
									</form>
								</div>
							</div>
							<div class="ClaseIntroNit mt-3" style="text-align:center;">
								<a href="https://prosof.com.co" target="blank_"><img src="<?=base_url()?>assets/img/LogoProsof.png?<?= rand() ?>" style="width: 180px;"></a>
							</div>
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
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/alertify/alertify.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/libraries/jsRastreo.js"></script>
</footer>

</html>
<script type="text/javascript">
	$dato = <?= json_encode($Datos) ?>;
	var prevValue = 0, val = 0;
	(function() {
		console.log($dato);
		if ($dato.length == 1) {
			if ($dato[0].Fondo != null) {
				$("body").css({
					"background-image": "url('<?=base_url()?>" + $dato[0].Fondo + "')"
					,"background-size": "cover"
				});
			}
		}

		document.addEventListener('DOMContentLoaded', function (e) {

			$("#overlay").addClass('hidden');
			$('#usuario, #password').attr('disabled', false);
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
			$('select').on('chosen:ready', function(){
				setTimeout(function(){
					$('.chosen-single').click();
				},0);
			}).chosen({
				placeholder_text_single: 'Usuario:'
				,width: '100%'
				,no_results_text: 'Oops, no se encuentra'
				,allow_single_deselected: true
			}).on('change', function(){
				for (var i = 0; i < $dato.length; i++) {
					if ($dato[i].Nit == $(this).val()) {
						if($dato[i].Fondo != null){
							$("body").css({
								"background-image": "url('<?=base_url()?>" + $dato[i].Fondo + "')"
								,"background-size": "cover"
							});
						} else {
							$("body").css({
								"background-image": "url('<?=base_url()?>assets/img/Cocora.png')" 
								,"background-size": "290px 350px"
							});
						}
						$("#txtUsuario").attr("data-user",$dato[i].CodigoUsuario)
						$("#txtUsuario").val($dato[i].Nombre)
					}
				}
				setTimeout(function(){
					$('#password').focus();
				},0);
			});
			$('form').submit(function(e){
				e.preventDefault();
				var usuario = $("#txtUsuario").attr('data-user');
				var nit 	= $("#txtConjunto").attr('data-nit') != undefined ? $("#txtConjunto").attr('data-nit') : $("#conjunto").val();
				if(usuario == null || nit == null){
					alertify.error('Debe de diligenciar todos los campos.');
					return;
				}else{
					$.ajax({
						type: 'POST',
						url: "<?=base_url()?>Login/Ingreso",
						data: {
							Usuario : usuario,
							NIT 	: nit,
							Clave 	: $('#password').val(),
							RASTREO : RASTREO('Ingresa al Sistema Cocora Residente', 'Ingreso Sistema')
						},
						success:function(res){
							switch(res){
								case '1':
									location.href = "<?= base_url() ?>";
								break;
								case 'error':
									alertify.alert('Advertencia', 'Contraseña no válida...', function(){
										setTimeout(function(){
											$('#password').val('').focus();
										},0);
									});
								break;
								default:
									try{
										res = JSON.parse(res);

										cantidad = res.cantidad[0];

										users = res.users;

										cad = `<center><h3>Usuarios Activos en el Sistema</h3></center>
										<table class="table table-bordered table-hover table-fixed table-striped table-condensed">
											<thead>
												<th style="text-align=center;">Código</th>
												<th style="text-align=center;">Usuario</th>
											</thead>
											<tbody>`;

												for (var i = 0; i < users.length; i++) {
													cad += `<tr>
													<td>`+users[i].codigo+`</td>
													<td>`+users[i].usuario+`</td>
												</tr>`;
											}

											cad += `</tbody>
											</table>`;

										if(cantidad == 1){
											alertify.alert("Advertencia", "Su Empresa Solo Tiene Licencia Para : "+cantidad+" Usuario"+cad+'.');
										}else{
											alertify.alert("Advertencia", "Su Empresa Solo Tiene Licencia Para : "+cantidad+" Usuarios"+cad+'.');
										}
									}catch(error){
										location.reload();
									}
								break;
							}
						}
					});
				}
			});
			$('#regresar').click(function(e){
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: "<?=base_url()?>Login/Regresar",
					success:function(res){
						if(res == '1'){
							location.reload();
						}
					}
				});
			});
		});
	})();
</script>