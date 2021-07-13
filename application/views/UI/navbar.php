<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	<div class="wrapper">
		<!-- navbar -->
		<nav class="main-header navbar-expand main-header navbar navbar-light fixed-top bg-light flex-md-nowrap navbar-expand-md" style="background-color: #3a77bc !important; padding: .5rem .3rem">
			<li class="nav-item" style="list-style-type: none;">
				<a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
					<i class="fas fa-bars" style="font-size: 20px"></i>
				</a>
			</li>

			<ul class="navbar-nav ml-auto pr-0 mb-0 mr-1 mr-md-3">
				<li data-toggle="dropdown" id="liNotificaciones" class="liNotificaciones">
					<a class="nav-link pr-1" href="#" role="button">
						<span class="badge" id="totalAlertas"></span>
						<i class="far fa-bell icon-bell mr-2"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

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

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-light-lightblue elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<!-- <img src="<?= base_url() ?>uploads/<?= $this->session->userdata('NIT') ?>/InformacionEmpresa/logo_cliente.png" alt="Cocora Residente" class="brand-image"> -->
				<img src="<?= base_url() ?>assets/img/Cocora2.png" alt="Cocora Residente" class="brand-image">
				<span class="brand-text font-weight-light">Cocora Residente</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
					with font-awesome or any other icon font library -->
						<li class="nav-item has-treeview user-panel mt-2 pb-2 mb-2">
							<a href="#" class="nav-link">
								<i class="nav-icon far fa-user-circle"></i>
								<p>
									<?= $this->session->userdata('nombre') ?>
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<?php  
									switch ($this->session->userdata('navV')) {
										case 'ALL':
										case 'PPR':
										case 'PA':
										case 'PRA':
											echo '<li class="nav-item"><a class="nav-link cambioSesion" href="'.base_url().'cambioSesion"><i class="fas fa-sync nav-icon"></i><p>Cambiar Sesión</p></a></li>';
											break;
										default:
											break;
									}
								?>
								<li class="nav-item">
									<a href="#" class="nav-link acercaDe">
										<i class="far fa-star nav-icon"></i>
										<p>Acerca de</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link cerrar">
										<i class="fas fa-sign-out-alt nav-icon"></i>
										<p>Cerrar Sesión</p>
									</a>
								</li>
							</ul>
						</li>
						<?php if(in_array(1, $this->session->userdata('SEGUR'))){ ?>
							<li class="nav-item <?= ($this->uri->segment(2) == 'Configuracion' ? 'menu-open' : '') ?>">
								<a href="#" class="nav-link <?= ($this->uri->segment(2) == 'Configuracion' ? 'active' : '') ?>" title="Configuración">
									<i class="nav-icon fas fa-cog"></i>
									<p>
										Configuración
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(in_array(11, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Terceros">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/Terceros" class="nav-link <?= ($this->uri->segment(5) == 'Terceros' ? 'active' : '') . ($this->uri->segment(3) == 'Terceros' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Terceros</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(12, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Parámetros de facturación y cartera">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/ParametrosFacturacionCartera" class="nav-link <?= ($this->uri->segment(5) == 'ParametrosFacturacionCartera' ? 'active' : '') . ($this->uri->segment(3) == 'ParametrosFacturacionCartera' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Parámetros de facturación y cartera</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(13, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Configuración PQR's">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/PQR" class="nav-link <?= ($this->uri->segment(5) == 'PQR' ? 'active' : '') . ($this->uri->segment(3) == 'PQR' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>PQR's</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(14, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Productos">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/Productos" class="nav-link <?= ($this->uri->segment(5) == 'Productos' ? 'active' : '') . ($this->uri->segment(3) == 'Productos' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Productos</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(15, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="onfiguración Incidencias">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/Incidencias" class="nav-link <?= ($this->uri->segment(5) == 'Incidencias' ? 'active' : '') . ($this->uri->segment(3) == 'Incidencia' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Incidencias</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(16, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Parámetros de producción">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/ParametrosProduccion" class="nav-link <?= ($this->uri->segment(5) == 'ParametrosProduccion' ? 'active' : '') . ($this->uri->segment(3) == 'ParametrosProduccion' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Parámetros de producción</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(18, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Actas">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/Actas" class="nav-link <?= ($this->uri->segment(5) == 'Actas' ? 'active' : '') . ($this->uri->segment(3) == 'Actas' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Actas</p>
										</a>
									</li>
									<?php } ?>
									<?php if(in_array(17, $this->session->userdata('SEGUR'))){ ?>
									<li class="nav-item" title="Configuración">
										<a href="<?=base_url()?>Administrativo/Configuracion/Menu/Inicio/Configuracion" class="nav-link <?= ($this->uri->segment(5) == 'Configuracion' ? 'active' : '') . ($this->uri->segment(3) == 'Inicio' ? 'active' : '') ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Configuración</p>
										</a>
									</li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
						<?php if(in_array(2, $this->session->userdata('SEGUR'))){ ?>
							<li class="nav-item" title="Utilidades" >
								<a href="<?=base_url()?>Administrativo/Utilidades/Menu" class="nav-link link <?= ($this->uri->segment(2) == 'Utilidades' ? 'active' : '') ?>">
								<i class="nav-icon fas fa-screwdriver"></i>
									<p>Utilidades</p>
								</a>
							</li>
						<?php } ?>
						<?php if(in_array(3, $this->session->userdata('SEGUR'))){ ?>
						<li class="nav-item" title="PQR'S" >
							<a href="<?=base_url()?>Administrativo/PQR/menu" class="nav-link link <?= ($this->uri->segment(2) == 'PQR' ? 'active' : '') ?>">
							<i class="nav-icon fas fa-mail-bulk"></i>
								<p>PQR'S</p>
							</a>
						</li>
						<?php } ?>

						<?php if(in_array(4, $this->session->userdata('SEGUR'))){ ?>
						<li class="nav-item" title="Fichas Técnicas" >
							<a href="<?=base_url()?>Administrativo/FichasTecnicas/cFichasTecnicas" class="nav-link link <?= ($this->uri->segment(2) == 'FichasTecnicas' ? 'active' : '') ?>">
							<i class="nav-icon far fa-list-alt"></i>
								<p>Fichas técnicas</p>
							</a>
						</li>
						<?php } ?>

						<?php if(in_array(4, $this->session->userdata('SEGUR'))){ ?>
						<li class="nav-item" title="Fichas Técnicas" >
							<a href="<?=base_url()?>Administrativo/FichaTecnica/cFichaTecnica" class="nav-link link <?= ($this->uri->segment(2) == 'FichaTecnica' ? 'active' : '') ?>">
							<i class="nav-icon far fa-list-alt"></i>
								<p>Fichas técnicas2</p>
							</a>
						</li>
						<?php } ?>

						<?php if(in_array(5, $this->session->userdata('SEGUR'))){ ?>
						<li class="nav-item" title="Fichas Técnicas" >
							<a href="<?=base_url()?>Administrativo/Incidencia/cMenu" class="nav-link link <?= ($this->uri->segment(2) == 'Incidencia' ? 'active' : '') ?>">
							<i class="nav-icon fas fa-clipboard-list"></i>
								<p>Gestión Incidencias</p>
							</a>
						</li> 
						<?php } ?>

						<li class="nav-item" title="Fichas Técnicas" >
							<a href="<?=base_url()?>Administrativo/Actas/Menu" class="nav-link link <?= ($this->uri->segment(2) == 'Actas' ? 'active' : '') ?>">
							<i class="nav-icon fas fa-file-signature"></i>
								<p>Actas</p>
							</a>
						</li>

						<?php if($this->session->userdata('NIT') == '111111111') { ?>
							<li class="pl-2">
								<p class="d-block d-sm-none">Nada</p>
								<p class="d-none d-sm-block d-md-none">sm</p>
								<p class="d-none d-md-block d-lg-none">md</p>
								<p class="d-none d-lg-block d-xl-none">lg</p>
								<p class="d-none d-xl-block">xl</p>
							</li>
						<?php } ?>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>