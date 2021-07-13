<div class="table-responsive">
	<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUD" cellspacing="0" style="width: 100%;">
		<thead>
			<tr>
				<th>Descripción</th>
				<th>Fecha Creación</th>
				<th>Fecha Programada</th>
				<th>Fecha Ejecutada</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Filtros</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="frmCRUD" class="form-group" method="POST" action="Notificaciones" autocomplete="off">
					<input type="hidden" name="json">

					<label for="tipo">Tipo</label>

					<select class="form-control chos-unit" id="tipo">
						<option value=''>Todas</option>
						<option value="PQ, QR">PQR</option>
						<option value='IN'>Incidencia</option>
					</select>

					<div class="row">
						<div class="col-sm-12">
							<label for="tipoFecha">Tipo Fecha</label>
							<select class="form-control chos-unit" id="tipoFecha">
								<option value='Creada'>Creación</option>
								<option value='Programada'>Programada</option>
								<option value='Ejecutada'>Ejecutada</option>
							</select>
						</div>
						<div class="col-sm-6">
							<label for="fInicial"><span class="text-danger">*</span>Periodo Inicial</label>
							<div class="input-group datepicker">
								<input type="text" class="form-control form-control-sm dateFecha" id="fInicial" required value="<?= date('Y-m-d') ?>">
								<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
									<span class="input-group-text fas fa-calendar-alt d-flex"></span>
								</a>
							</div>
						</div>
						<div class="col-sm-6">
							<label for="fFinal"><span class="text-danger">*</span>Periodo Final</label>
							<div class="input-group datepicker">
								<input type="text" class="form-control form-control-sm dateFecha" id="fFinal" required value="<?= date('Y-m-d') ?>">
								<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
									<span class="input-group-text fas fa-calendar-alt d-flex"></span>
								</a>
							</div>
						</div>
					</div>
				</form>
<?php if (isset($_POST['json'])){ ?>
			</div>
			<div class="modal-footer">
<?php } ?>
				<button type="submit" class="btn btn-primary" form="frmCRUD" id="btnFiltrar"><i class="fas fa-filter"></i> Filtrar</button>
<?php if (isset($_POST['json'])){ ?>
				<a href="<?= base_url() ?>Administrativo/Utilidades/Notificaciones" class="btn btn-warning"><i class="fas fa-redo-alt"></i> Reiniciar Filtros</a>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
	$JSON = '<?= $json ?>';
	$TITULO = '<?= $titulo ?>';
	$USR = '<?= $this->session->userdata('id') ?>';
</script>