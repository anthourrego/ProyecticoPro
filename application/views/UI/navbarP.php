<body>
	<style>
		#almacenIni_chosen{
			height: auto !important;
		}
	</style>
	<nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 navbar-expand-md">
		

		<ul class="navbar-nav d-md-none w-50">
			<li class="nav-item text-nowrap d-md-none">
				<a class="nav-link ellipsis text-center" href="#" title="<?= $this->session->userdata('nombre') ?>">
					<i class="fas fa-user mr-2"></i><?= $this->session->userdata('nombre') ?>
				</a>
			</li>
		</ul>

		<div class="dropdown d-md-none">
			<button class="border-0 navbar-toggler" type="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="fas fa-power-off"></span>
			</button>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink2">
				<a class="dropdown-item cerrar" href="#"><span class="fas fa-sign-out-alt mr-2"></span>Cerrar Sesión</a>
				<a class="dropdown-item acercaDe" href="#"><span class="far fa-star mr-2"></span>Acerca de</a>
			</div>
		</div>

		<a class="d-none d-md-block p-0" href="<?=base_url()?>" title="Página principal de Residente">
			<div style="background: url(<?= base_url() ?>assets/img/logo_prosof.png) no-repeat center center;"></div>
			<!-- <div style="background: url(<?= base_url() ?>uploads/<?= $this->session->userdata('NIT') ?>/InformacionHotel/logo_cliente.png) no-repeat center center;"></div> -->
		</a>

		<ul class="navbar-nav ml-auto mb-0 col-sm-6 mr-0 px-0 d-none d-md-block">
			<li class="navbar-brand text-nowrap dropdown offset-lg-8 col-lg-4 offset-md-6 col-md-6">
				<a class="nav-link dropdown-toggle ellipsis" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
					<i class="fas fa-user mr-2"></i><span class=""><?= $this->session->userdata('nombre') ?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item cerrar" href="#"><span class="fas fa-sign-out-alt mr-2"></span>Cerrar Sesión</a>
					<?php  
						switch ($this->session->userdata('navV')) {
							case 'ALL':
							case 'PPR':
							case 'PA':
							case 'PRA':
								echo '<a class="dropdown-item cambioSesion" href="'.base_url().'cambioSesion"><span class="fas fa-sync mr-2"></span>Cambiar Sesión</a>';
								break;
							default:
								break;
						}
					?>
					<a class="dropdown-item acercaDe" href="#"><span class="far fa-star mr-2"></span>Acerca de</a>
				</div>
			</li>
		</ul>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-xl-12 contenido">