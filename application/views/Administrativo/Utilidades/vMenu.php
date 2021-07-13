<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Utilidades</p>
		</div>
		<?php if(in_array(2001, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Utilidades/AuditoriaGeneral">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\AuditoriaGeneral.png">
				<p class="texto_config mb-0">Auditoría General</p>
				<p class="txtLow">Utilidades</p>
			</a>
		</div>
		<?php } ?>
	</div>
	<div class="row">
		<?php if(in_array(2002, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100 cambiarClave" href="#">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CambioClave.png">
				<p class="texto_config mb-0">Cambio de Clave</p>
				<p class="txtLow">Utilidades</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(2003, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Utilidades/SeguridadGeneral">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\SeguridadGeneral.png">
				<p class="texto_config mb-0">Seguridad General</p>
				<p class="txtLow">Utilidades</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(2004, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Utilidades/TiposPerfil">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\TiposPerfil.png">
				<p class="texto_config mb-0">Tipos de Perfil</p>
				<p class="txtLow">Utilidades</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>