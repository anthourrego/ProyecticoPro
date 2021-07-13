<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">PQR's</p>
		</div>
		<!-- <div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR1/RegistrarPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\InformeExtranjeros.png">
				<p class="texto_config">Capturar</p>
			</a>
		</div> 
		
		<div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR1/CapturaPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CaracteristicasHabitaciones.png">
				<p class="texto_config">Tramitar</p>
			</a>
		</div> 
		<div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR1/ConsultaPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\AuditoriaGeneral.png">
				<p class="texto_config">Consultar</p>
			</a>
		</div> 
		<div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR1/EstadisticasPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ActividadEconomica.png">
				<p class="texto_config">Estadísticas</p>
			</a>
		</div> -->
		<?php if(in_array(3001, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/PQR/CapturarPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\InformeExtranjeros.png">
				<p class="texto_config mb-0">Capturar</p>
				<p class="txtLow">PQR's</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(3002, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/PQR/TramitarPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CaracteristicasHabitaciones.png">
				<p class="texto_config mb-0">Tramitar</p>
				<p class="txtLow">PQR's</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(3003, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/PQR/ConsultaPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\AuditoriaGeneral.png">
				<p class="texto_config mb-0">Consultar</p>
				<p class="txtLow">PQR's</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(3004, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/PQR/EstadisticasPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ActividadEconomica.png">
				<p class="texto_config mb-0">Estadísticas</p>
				<p class="txtLow">PQR's</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>