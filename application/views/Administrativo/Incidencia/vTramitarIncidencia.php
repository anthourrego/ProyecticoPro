<div class="form-row">
	<div class="col-12 col-md-2 mb-2"> 
		<button class="btn btn-secondary btn-sm btn-block" id="btnFiltros" data-toggle="collapse" data-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros">
			<i class="fas fa-filter"></i> Filtros
		</button>
	</div>
	<div class="collapse col-12" id="collapseFiltros">
		<div class="card card-body mb-2">
			<div class="form-row">
				<div class="col-12 col-md-4 col-lg-2 my-1">
					<label class="mb-0" for="fecha1">Fecha inicio:</label>
					<div class="input-group date cha1 datepicker">
						<input type="text" class="form-control form-control-sm dateFecha" name="fecha1" id="fecha1" maxlength="15" value="<?= date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y'))) ?>">
						<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
							<span class="input-group-text fas fa-calendar-alt d-flex"></span>
						</a>
					</div>
				</div>
				<div class="col-12 col-md-4 col-lg-2 my-1">
					<label class="mb-0" for="fecha2">Fecha final:</label>
					<div class="input-group date cha2 datepicker">
						<input type="text" name="fecha2" id="fecha2" class="form-control form-control-sm dateFecha" maxlength="15" value="<?= date('Y-m-d') ?>">
						<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
							<span class="input-group-text fas fa-calendar-alt d-flex"></span>
						</a>
					</div>
				</div>

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0" for="TipoPrioridadIncidenciaId">Tipo Prioridad:</label>
					<select class="chosen-select custom-select custom-select-sm" multiple name="TipoPrioridadIncidenciaId[]" id="TipoPrioridadIncidenciaId">
						<?php
							foreach ($selectTipoPrioridad as $tipoPrioridad) {
								echo("<option value='".$tipoPrioridad->TipoPrioridadIncidenciaId."'>".$tipoPrioridad->Nombre);
							}
						?> 
					</select>
				</div>

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0" for="EstadoIncidenciaId">Estado:</label>
					<select class="chosen-select custom-select custom-select-sm se" multiple name="EstadoIncidenciaId[]" id="EstadoIncidenciaId" tabindex="8">
					 	<?php
							foreach ($selectEstado as $estado) {
								echo("<option value='".$estado->EstadoIncidenciaId."'>".$estado->Nombre);
							}
						?> 
					</select>
				</div>

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0" for="TipoIncidenciaId">Tipo Incidencia:</label>
					<select class="chosen-select custom-select custom-select-sm se" multiple name="TipoIncidenciaId[]" id="TipoIncidenciaId" tabindex="8">
						 <?php
						 	foreach ($TipoIncidencia as $tipo) {
								echo("<option value='".$tipo->TipoIncidenciaId."'>".$tipo->Nombre);
							}
						?> 
					</select>
				</div>

				<!-- Equipo -->
				<div class="col-12 col-md-4 my-1">
					<label class="mb-0" for="ItemEquipoId">Equipo:</label>
					<select class="chosen-select custom-select custom-select-sm" name="ItemEquipoId" id="ItemEquipoId">
						<option value="" selected>Todos</option>
						<?php
							foreach ($listaEquipos as $Equipos) {
								echo "<option value='" . $Equipos->ItemEquipoId . "' data-serial='".$Equipos->Serial."'>" . $Equipos->ItemEquipoId . " | ". $Equipos->Nombre . " | " . $Equipos->Serial . "</option>";
							}
						?> 
					</select>
				</div>

				<!-- N° de PQR -->			
				<div class="col-12 col-md-4 col-lg-2 my-1">
					<label class="mb-0" for="nIncidencia">N° de Incidencia:</label>
					<input placeholder="N° de Incidencia" class="form-control input-sm" id="nIncidencia" type="text">
				</div>
				<div class="col-12 col-md-4 col-lg-2 my-1 align-self-end">
					<button class="btn btn-primary btn-sm btn-block" id="btnCargar">
						<i class="fas fa-list-alt"></i> Cargar
					</button>
				</div>		
			</div>
		</div>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-sm table-hover table-fixed table-striped display w-100" id="tblIncidencias" cellspacing="0">
		<thead>
			<tr>
				<th>ID</th>
				<th>Incidencia</th>
				<th>Equipo</th>
				<th>Serial</th>
				<th>T.Incidencia</th>
				<th>Estado</th>
				<th>Prioridad</th>
				<th>Asunto</th>
				<th>Descripción</th>
				<th>Operación</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>