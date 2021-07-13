<body>
	<nav class="navbar navCabe navbar-light fixed-top flex-md-nowrap p-2 navbar-expand-md <?= isset($Ini) == true ? '' : 'navCabe2';?>" style="background: rgba(0, 0, 0, 0.4) !important">
		<button class="border-0 navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#nav-bar" aria-controls="nav-bar" aria-expanded="false" aria-label="Alternar Navegación">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="d-none d-md-block p-0" href="<?=base_url()?>" title="Página principal de Residente">
					<div style="background: url(<?= base_url() ?>assets/img/Cocora.png) no-repeat center center;"></div>
					<div style="background: url(<?= base_url() ?>uploads/<?= $this->session->userdata('NIT') ?>/InformacionEmpresa/logo_cliente.png) no-repeat center center;"></div>
				</a>
			</div>
			<div class="navbar-collapse collapse" id="nav-bar">
				<ul class="navbar-nav ml-auto">
					<li data-toggle="dropdown" id="liNotificaciones" class="liNotificaciones">
						<a class="nav-link pr-4 pr-md-1" href="#" role="button">
							<span class="badge" id="totalAlertas"></span>
							<i class="far fa-bell icon-bell mr-2"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<ul class="navbar-nav mb-0 mr-0 px-0 d-none d-md-block">
			<li class="navbar-brand text-nowrap dropdown col-md-12">
				<a class="nav-link dropdown-toggle ellipsis" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user mr-2"></i><span class=""><?= $this->session->userdata('nombre') ?></span>
				</a>
				<div class="dropdown-menu drop-m dropdown-menu-right" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item drop-it cerrar" href="#"><span class="fas fa-sign-out-alt mr-2"></span>Cerrar Sesión</a>
					<?php  
						switch ($this->session->userdata('navV')) {
							case 'ALL':
							case 'PPR':
							case 'PA':
							case 'PRA':
								echo '<a class="dropdown-item drop-it" href="'.base_url().'cambioSesion"><span class="fas fa-sync mr-2"></span>Cambiar Sesión ';
								break;
							default:
								break;
						}
					?>
					<a class="dropdown-item drop-it acercaDe" href="#"><span class="far fa-star mr-2"></span>Acerca de</a>
				</div>
			</li>
		</ul>
	</nav>

	<div id="divDropdownAlerta" class="col-md-4 col-12 d-none w-100 pb-0 rounded shadow-sm">
		<div class="loaderNotificaciones d-none"></div>
		<div class="text-center p-2 w-100 NANoti">No hay actividad para mostrar</div>
		<div class="d-none list-group" id="listaAlerta"></div>
		<a href="<?php echo base_url('Administrativo/Utilidades/Notificaciones')?>">
			<div class="verTodoNTF p-2 text-center w-100">
				Ver todas las Notificaciones
			</div>
		</a>
	</div>

	<?php if (isset($Ini)) {?>
	<div class="fondillo" style="background: url(<?= $this->session->userdata('DATAINI')->Fondo == null ? base_url() . 'assets/img/iconos/Propietarios/conjunto2.jpg' : $this->session->userdata('DATAINI')->Fondo ?>) no-repeat center center; background-size: cover;">
	</div>
	<?php } ?>


	<!-- <nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 navbar-expand-md">
		<button class="border-0 navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Alternar Navegación">
			<span class="navbar-toggler-icon"></span>
		</button>

		<ul class="navbar-nav d-md-none w-50">
			<li class="nav-item text-nowrap d-md-none">
				<a class="nav-link ellipsis text-center" href="#" title="<?= $this->session->userdata('nombre') ?>">
					<i class="fas fa-user mr-2"></i><?= $this->session->userdata('nombre') ?>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav pr-0 d-md-none ulNav">
			<li data-toggle="dropdown" id="liNotificaciones" class="liNotificaciones">
				<a class="nav-link pr-4 pr-md-1" href="#" role="button">
					<span class="badge" id="totalAlertas"></span>
					<i class="fas fa-bell icon-bell mr-2"></i>
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
			<div style="background: url(<?= base_url() ?>uploads/<?= $this->session->userdata('NIT') ?>/InformacionHotel/logo_cliente.png) no-repeat center center;"></div>
		</a>

		<ul class="navbar-nav ml-auto mb-0 mr-3 d-none d-md-block">
			<li data-toggle="dropdown" id="liNotificaciones" class="liNotificaciones">
				<a class="nav-link pr-4 pr-md-1" href="#" role="button">
					<span class="badge" id="totalAlertas"></span>
					<i class="fas fa-bell icon-bell mr-2"></i>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav mb-0 mr-0 px-0 d-none d-md-block">
			<li class="navbar-brand text-nowrap dropdown col-md-12">
				<a class="nav-link dropdown-toggle ellipsis" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user mr-2"></i><span class=""><?= $this->session->userdata('nombre') ?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item cerrar" href="#"><span class="fas fa-sign-out-alt mr-2"></span>Cerrar Sesión</a>
					<a class="dropdown-item acercaDe" href="#"><span class="far fa-star mr-2"></span>Acerca de</a>
				</div>
			</li>
		</ul>
	</nav> -->

	<div id="divDropdownAlerta" class="col-md-4 col-12 d-none w-100 pb-0">
		<div class="loaderNotificaciones d-none"></div>
		<div class="text-center p-2 w-100 NANoti">No hay actividad para mostrar</div>
		<div class="d-none" id="listaAlerta"></div>
		<a href="<?php echo base_url('Utilidades/Notificaciones')?>">
			<div class="verTodoNTF p-2 text-center w-100">
				Ver todas las Notificaciones
			</div>
		</a>
	</div>
<!-- 
	<div class="container-fluid">
		<div class="row">
			<nav class="<?= $this->session->userdata('HUD') ? 'col-md-2' : 'col-md-1' ?> col-xl-1 d-md-block bg-light sidebar collapse" id="sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<?php if(in_array(1, $this->session->userdata('SEGUR'))){ ?>
							<li class="nav-item modulo <?= ($this->uri->segment(1) == 'Configuracion' ? 'active' : '') ?>" title="Configuración">
								<a class="nav-link" href="<?=base_url()?>Configuracion/Menu">
									<i><img src="<?= base_url() ?>assets\img\iconos\config.png" width="20"></i>
									<span class="titulo-seccion"><br>Configuración</span>
								</a>
							</li>
						<?php } ?>
						<?php if(in_array(2, $this->session->userdata('SEGUR'))){ ?>
							<li class="nav-item modulo <?= ($this->uri->segment(1) == 'Utilidades' ? 'active' : '') ?>" title="Utilidades">
								<a class="nav-link" href="<?=base_url()?>Utilidades/Menu">
									<i><img src="<?= base_url() ?>assets\img\iconos\Utilidades.png" width="20"></i>
									<span class="titulo-seccion"><br>Utilidades</span>
								</a>
							</li>
						<?php } ?>
							<li class="nav-item modulo <?= ($this->uri->segment(1) == 'Control' ? 'active' : '') ?>" title="Control">
								<a class="nav-link" href="<?=base_url()?>Control/Menu">
									<i><img src="<?= base_url() ?>assets\img\iconos\Control.png" width="20"></i>
									<span class="titulo-seccion"><br>Control</span>
								</a>
							</li>
							<li class="nav-item modulo <?= ($this->uri->segment(1) == 'Consultas' ? 'active' : '') ?>" title="Consultas">
								<a class="nav-link" href="<?=base_url()?>Consultas/Menu">
									<i><img src="<?= base_url() ?>assets\img\iconos\Consultas.png" width="20"></i>
									<span class="titulo-seccion"><br>Consultas</span>
								</a>
							</li>
						<?php if($this->session->userdata('NIT') == '111111111') { ?>
							<li>
								<p class="d-block d-sm-none">Nada</p>
								<p class="d-none d-sm-block d-md-none">sm</p>
								<p class="d-none d-md-block d-lg-none">md</p>
								<p class="d-none d-lg-block d-xl-none">lg</p>
								<p class="d-none d-xl-block">xl</p>
							</li>
						<?php } ?>
						<li class="nav-item text-center position-absolute w-100 d-xl-none d-none d-md-block" id="btnOcultarHUD" style="bottom: 35px;" title="Colapsar">
							<a class="nav-link" href="#">
								<i class="fas fa-bars" style="font-size: 1.5em;"></i>
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="<?= $this->session->userdata('HUD') ? 'offset-md-2 col-md-10' : 'offset-md-1 col-md-11' ?> offset-xl-1 col-xl-11 contenido"> -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-xl-12 contenidoPR">