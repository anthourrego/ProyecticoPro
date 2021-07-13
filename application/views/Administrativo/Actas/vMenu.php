<!-- Botones de Actas -->
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle"><i class="fas fa-file-signature"></i> Actas</p>
		</div>
		<?php if(in_array(6001, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Actas/Acta">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\TipoNotaDebito.png">
				<p class="texto_config mb-0">Actas</p>
				<p class="txtLow">Actas</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(6002, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Actas/Consultas">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\InformeExtranjeros.png">
				<p class="texto_config mb-0">Consultas</p>
				<p class="txtLow">Actas</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>

