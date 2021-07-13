<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Gestión Incidencia</p>
		</div>
		<?php if(in_array(5001, $this->session->userdata('SEGUR'))){ ?>
		 <div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Incidencia/cCapturarIncidencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\InformeExtranjeros.png">
				<p class="texto_config mb-0">Capturar</p>
				<p class="txtLow">Incidencia</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(5002, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Incidencia/cTramitarIncidencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CaracteristicasHabitaciones.png">
				<p class="texto_config mb-0">Tramitar</p>
				<p class="txtLow">Incidencia</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(5003, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Incidencia/cAgendarIncidencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\calendar.png">
				<p class="texto_config mb-0">Agendar</p>
				<p class="txtLow">Incidencia</p>
			</a>
		</div>
		<?php } ?>

		<?php if(in_array(5003, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Incidencia/cRegistroOperaciones">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Listado_vencimientos.png">
				<p class="texto_config mb-0">Listado Vencimientos</p>
				<p class="txtLow">Incidencia</p>
			</a>
		</div>
		<?php } ?>

		<!--<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/PQR/ConsultaPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\AuditoriaGeneral.png">
				<p class="texto_config mb-0">Consultar</p>
				<p class="txtLow">PQR's</p>
			</a>
		</div>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/PQR/EstadisticasPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ActividadEconomica.png">
				<p class="texto_config mb-0">Estadísticas</p>
				<p class="txtLow">PQR's</p>
			</a>
		</div> -->
	</div>
</div>