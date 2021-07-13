<div class="form-row">
	<div class="col-12">
		<div class="row">
			<div class="col-12 col-md-4 col-lg-2">
				<label for="fFechaInicio" class="col-form-label col-form-label-sm">Desde:</label>
				<div class="input-group date datepicker">
					<input type="text" class="form-control form-control-sm dateFecha" name="fFechaInicio" id="fFechaInicio" maxlength="15" value="">
					<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
						<span class="input-group-text fas fa-calendar-alt d-flex"></span>
					</a>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-2">
				<label for="fFechaFin" class="col-form-label col-form-label-sm">Hasta:</label>
				<div class="input-group date datepicker">
					<input type="text" class="form-control form-control-sm dateFecha" name="fFechaFin" id="fFechaFin" maxlength="15" value="">
					<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
						<span class="input-group-text fas fa-calendar-alt d-flex"></span>
					</a>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-2">
				<label for="fTipoReunion" class="col-form-label col-form-label-sm">Tipo Reunión</label>
				<select class="chosen-select custom-select custom-select-sm" multiple name="fTipoReunion[]" id="fTipoReunion">
					<?php 
						if(count($selectTipoReunion) > 0){
							foreach ($selectTipoReunion as $key) {
								echo "<option value='".$key->TipoReunionId."'>".$key->Nombre."</option>";
							}
						}
					?>
				</select>
			</div>
			<div class="col-12 col-md-6 col-lg-2 align-self-end">
				<button class="btn btn-danger btn-sm btn-block mt-3" id="btnLimpiarFiltro"><i class="fas fa-broom"></i> Limpiar</button>
			</div>
			<div class="col-12 col-md-6 col-lg-2 align-self-end">
				<button class="btn btn-secondary btn-sm btn-block mt-3" id="btnFiltrar"><i class="fas fa-filter"></i> Filtrar</button>
			</div>
			<div class="col-12 col-md-6 col-lg-2 align-self-end">
				<button class="btn btn-info btn-sm btn-block mt-3" id="btnFiltrarTodo"><i class="fas fa-list"></i> Cargar Todas</button>
			</div>
			<div class="col-12 col-md-6 col-lg-2 align-self-end">
				<button class="btn btn-sm btn-primary btn-block registrarActa mt-3"><i class="fas fa-plus"></i> Registrar acta</button>
			</div>
		</div>
	</div>
	<div class="col-12 mt-3">
		<table class="table table-bordered table-sm table-hover table-fixed table-striped display w-100" id="tblActas" cellspacing="0">
			<thead class="w-100">
				<tr>
					<th>Id Acta</th>
					<th>Fecha</th>
					<th>Nro Acta</th>
					<th>Tipo Reunión</th>
					<th>Tema</th>
					<th>Quien Elabora</th>
					<th>Objetivo</th>
					<th>Acciones</th>						
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modalCompromiso" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Compromisos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="divCompromisos">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped w-100" id="tblCompromisos" cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>Id</th>
								<th>Usuario Asignó</th>
								<th>Usuario Asignado</th>
								<th>Prioridad</th>
								<th>Descripción</th>
								<th>Fecha Máxima</th>
								<th>Fecha Creción</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div id="divSeguimientoCompromisos" class="d-none">
					<div class="mb-3">
						<button class="btn btn-secondary btn-sm" id="btnRegresar"><i class="fas fa-caret-left"></i> Regresar</button>
					</div>
					<form id="formSeguimientoCompromisos" class="row align-items-end" action="">
						<input type="hidden" id="idUsuarioCompromiso" name="idUsuarioCompromiso">
						<input type="hidden" id="idSeguimientoCompromiso" name="idSeguimientoCompromiso">
						<div class="col-12 col-lg-10 form-group form-group-sm">
							<label for="segDescripcion"><span class="text-danger">*</span>Descripción:</label>
							<textarea id="segDescripcion" name="descripcion" class="form-control form-control-sm" autocomplete="off" style="min-height: 40px; height: 40px"></textarea>
						</div>
						<div class="col-12 col-lg-2">
							<div class="form-group form-group-sm">
								<button class="btn btn-success btn-block" type="submit"><i class="fas fa-save"></i> Agregar</button>
							</div>
						</div>
					</form>
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblSeguimientoCompromisos" cellspacing="0" style="width: 100%;">
						<thead>
							<tr>
								<th>Id</th>
								<th>Fecha</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
	$USR = '<?= $this->session->userdata('id') ?>';
</script>