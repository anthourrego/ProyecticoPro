<style>

	#calendar {
		max-width: 1100px;
		margin: 0 auto;
  	} 

	[data-toggle="collapse"]:after {
		display: inline-block;
			display: inline-block;
			font-family: 'Font Awesome 5 Free';
			font: normal normal normal 15px/1;
			font-size: 2em;
			font-weight: bold;
			text-rendering: auto;
			-webkit-font-mdoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		content: "\f105";
		transform: rotate(90deg) ;
		transition: all linear 0.25s;
		float: right;
	}

	[data-toggle="collapse"].collapsed:after {
		transform: rotate(0deg) ;
	}

	[data-toggle="collapse"].navbar-toggler:after {
		content: none;
	}

	.btn-collapse {
		color: #fff;
		background-color: #4894d7;
		border-color: #4894d7;
	}

	.btn-collapse:hover {
		color: #fff !important;
		background-color: #3289d7;
		border-color: #3289d7;
	}

	.btn-collapse:focus, .btn-collapse.focus {
		outline: 0 !important;
		box-shadow: 0 0 0 0 !important;
	}

	/* Este es para que el calendario pase por encima */
	.accordion > .card {
		overflow: visible !important;
	}

</style> 

<div id='calendar'></div>

<div id='CrearEditar' class="d-none">
	<form id="frmRegistrarAgendamiento" class="form-row">
		<input type="hidden" id="UsuarioId" name="UsuarioId" value="<?= $this->session->userdata('id'); ?>">

		<div class="col-12 col-md-2 tipo verEditar my-1">
			<label class="mb-0" for="Numero">Incidencia:</label>
			<input type='text' id="Numero" disabled class='form-control form-control-sm' maxlength='50'>
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="FechaIni"><span class="text-danger">*</span>Fecha Inicial:</label>
			<div class="input-group input-group-sm datepicker">
				<input type="text" class="form-control dateFecha" name="FechaIni" id="FechaIni" maxlength="15" autocomplete="off">
				<a href="#" class="input-group-append input-group-addon text-decoration-none" title="Desplegar Calendario">
					<span class="input-group-text fas fa-calendar-alt d-flex"></span>
				</a>
			</div>
		</div>

		<div class="col-12 col-md-3 my-1 verEditarCol">
			<label class="mb-0" for="HoraIni"><span class="text-danger">*</span>Hora Inicial:</label>
			<div class="input-group input-group-sm timepickerLT">
				<input type="text" class="form-control dateFecha" name="HoraIni" id="HoraIni" maxlength="15" autocomplete="off">
				<a href="#" class="input-group-append input-group-addon text-decoration-none" title="Desplegar Calendario">
					<span class="input-group-text fas fa-clock d-flex"></span>
				</a>
			</div>
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="FechaFin"><span class="text-danger">*</span>Fecha Final:</label>
			<div class="input-group input-group-sm datepicker">
				<input type="text" class="form-control dateFecha" name="FechaFin" id="FechaFin" maxlength="15" autocomplete="off">
				<a href="#" class="input-group-append input-group-addon text-decoration-none" title="Desplegar Calendario">
					<span class="input-group-text fas fa-calendar-alt d-flex"></span>
				</a>
			</div>
		</div>

		<div class="col-12 col-md-3 my-1 verEditarCol">
			<label class="mb-0" for="HoraFin"><span class="text-danger">*</span>Hora Final:</label>
			<div class="input-group input-group-sm timepickerLT">
				<input type="text" class="form-control dateFecha" name="HoraFin" id="HoraFin" maxlength="15" autocomplete="off">
				<a href="#" class="input-group-append input-group-addon text-decoration-none" title="Desplegar Calendario">
					<span class="input-group-text fas fa-clock d-flex"></span>
				</a>
			</div>
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="EstadoIncidenciaId">Estado:</label>
			<select class="chosen-select custom-select custom-select-sm headIncidencia" data-nombre="Estado" name="EstadoIncidenciaId" id="EstadoIncidenciaId">
				<option value="" data-color='' data-cierre='' disabled selected>Seleccione</option>
				<?php
					foreach ($listaEstadoIncidencia as $Estado) {
						echo "<option data-color='".$Estado->ColorHexa."' data-cierre='".$Estado->Cierre."' value='".$Estado->EstadoIncidenciaId."'>".$Estado->Nombre."</option>";
					}
				?> 
			</select>
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="color">Color Estado:</label>
			<input type="text" name="color" id="color" disabled class="form-control form-control-sm">
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="TipoPrioridadIncidenciaId">Prioridad:</label>
			<select class="chosen-select custom-select custom-select-sm headIncidencia" data-nombre="Prioridad" name="TipoPrioridadIncidenciaId" id="TipoPrioridadIncidenciaId">
				<option value="0" data-tiempo="0" disabled selected>Seleccione</option>
				<?php
					foreach ($listaTipoPrioridadIncidencia as $Prioridad) {
						echo "<option data-frecuencia=".$Prioridad->ValorFrecuencia."  data-tiempo=".$Prioridad->Tiempo." value='".$Prioridad->TipoPrioridadIncidenciaId."'>".$Prioridad->Nombre."</option>";
					}
				?> 
			</select>
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0">Tiempo Respuesta:</label>
			<div class="input-group input-group-sm" id="tiemporespuesta">
				<div class="input-group-prepend">
					<span class="input-group-text font-weight-bold">&nbsp;&nbsp;&nbsp;</span>
				</div>
				<input type='text' disabled class='form-control' maxlength='50'>
			</div>
		</div>

		<div class="col-12 col-md-4 text-left my-1">
			<label class="mb-0" for="ItemEquipoId"><span class="text-danger">*</span>Equipo:</label>
			<select class="chosen-select custom-select custom-select-sm" required name="ItemEquipoId" id="ItemEquipoId">
				<option value="" data-serial='' disabled selected>Seleccione</option>
				<?php
					foreach ($listaEquipos as $Equipos) {
						echo "<option value='" . $Equipos->ItemEquipoId . "' data-serial='".$Equipos->Serial."'>" . $Equipos->ItemEquipoId . " | ". $Equipos->Nombre . "</option>";
					}
				?> 
			</select>
		</div>

		<div class="col-12 col-md-2 my-1">
			<label class="mb-0">Serial:</label>
			<input type='text' id="Serial" disabled class='form-control form-control-sm'>
		</div>

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="TipoIncidenciaId"><span class="text-danger">*</span>Tipo Incidencia:</label>
			<select class="chosen-select custom-select custom-select-sm headIncidencia" data-nombre="Tipo Incidencia" name="TipoIncidenciaId" id="TipoIncidenciaId">
				<option value="" data-validar="0" disabled selected>Seleccione</option>
				<?php
					foreach ($listaTipoIncidencia as $TipoInc) {
						echo "<option value='".$TipoInc->TipoIncidenciaId."'>".$TipoInc->Nombre."</option>";
					}
				?> 
			</select>
		</div> 

		<div class="col-12 col-md-3 my-1">
			<label class="mb-0" for="OperacionId">Operación:</label>
			<select class="chosen-select custom-select headIncidencia" data-nombre="Operación" name="OperacionId" id="OperacionId">
				<option value="" disabled selected>Seleccione</option>
				<?php
					foreach ($listaOperacion as $Operacion) {
						echo "<option value='".$Operacion->OperacionId."'>".$Operacion->Operacion."</option>";
					}
				?> 
			</select>
		</div>

		<div class="col-12 my-1">
			<label class="mb-0" for="Asunto"><span class="text-danger">*</span>Asunto:</label>
			<input name="Asunto" id="Asunto" class="form-control form-control-sm" type="text" autocomplete="off">
		</div>

		<div class="col-12 my-1">
			<label for="Descripcion" class="mb-0"><span class="text-danger">*</span>Descripción:</label>  
			<textarea name="Descripcion" id="Descripcion" rows="3" class="form-control form-control-sm" type="text"></textarea>  
		</div>

		<div class="col-12 verCrear">
			<label class="mb-0" for="form-image">Anexar archivos:</label>
			<div class='custom-file custom-file-sm'>
				<input type='file' class='custom-file-input custom-file-input-sm' name="archivos[]" id="form-image" multiple="true" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
				<label class='custom-file-label custom-file-label-sm' for='archivos' data-browse='Elegir'>
					<span id="form-image-span" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
				</label>
			</div>
		</div>
	</form>

	<div class="accordion col-12 mt-2 p-0 verEditar" id="accordiontecnicoIncidencia">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#collapseTecnicoIncidencia" aria-expanded="true" aria-controls="collapseTecnicoIncidencia">
				<h5 class="mb-0 my-auto">
					<i class="fas fa-clipboard-list"></i> Técnicos Asignados
				</h5>
			</button>
			<div id="collapseTecnicoIncidencia" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accordiontecnicoIncidencia">
				<div class="row">
					<div class="col-12 col-md-3 mb-2">
						<button class="btn btn-primary btn-sm btn-block" id="CrearAsignarTecnicos"><i class="fas fa-plus"></i> Asignar Técnicos</button>
					</div>
					<div class="col-12">
						<div class="table-responsive" style="min-height: 220px !important;">
							<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento w-100" id="TblTecnicosAsignados" data-tipo="H" cellspacing="0">
								<thead>
									<tr>
										<th>Acción</th>
										<th>Nombre Técnicos</th>
										<th>Documento</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="accordion col-12 p-0 verEditar" id="accordionActividadesIncidencia">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#collapseActividadIncidenciaA" aria-expanded="true" aria-controls="collapseActividadIncidenciaA">
				<h5 class="mb-0 my-auto">
					<i class="fas fa-clipboard-check"></i> Actividades Incidencia
				</h5>
			</button>
			<div id="collapseActividadIncidenciaA" class="collapse container-fluid py-2" aria-labelledby="Historial" data-parent="#accordionActividadesIncidencia">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento w-100" id="TblActividadIncidencia" data-tipo="H" cellspacing="0">
						<thead>
							<tr>
								<th>Acción</th>
								<th>Nombre Actividad</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>

	<div class="accordion col-12 p-0 verEditar" id="accordionNotas">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Notas" data-toggle="collapse" data-target="#collapseNotas" aria-expanded="true" aria-controls="collapseNotas">
				<h5 class="mb-0 my-auto">
					<i class="far fa-comments"></i> Notas
				</h5>
			</button>
			<div id="collapseNotas" class="collapse" aria-labelledby="Notas" data-parent="#accordionNotas">
				<div id="contenedorNotas" class="overflow-auto" style="max-height: 500px !important;">
					<table class="table table-bordered table-condensed table-striped mb-0">
						<tbody class="" id="notas"></tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>

	<div class="accordion col-12 p-0 verEditar" id="accordionAddNotas">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="AddNotas" data-toggle="collapse" data-target="#collapseAddNotas" aria-expanded="true" aria-controls="collapseAddNotas">
				<h5 class="mb-0 my-auto">
					<i class="far fa-comment-dots"></i> Añadir Nota
				</h5>
			</button>
			<div id="collapseAddNotas" class="collapse mx-2 px-2 py-3" aria-labelledby="AddNotas" data-parent="#accordionAddNotas">
				<form class="form-row" enctype="multipart/form-data" role="form" method="POST" id="frmNota">
					<div class="col-12 col-md-4 my-1 ">
						<p class="mb-2 font-weight-bold">
							<i class="fas fa-user"></i> <?= $this->session->userdata('nombre') ?>
						</p>
						<p class="mb-2">
							<i class="far fa-clock"></i> <?= date('Y-m-d') ?>
						</p>
					
					</div>
					<div class="col-12 col-md-8 form-group form-group-sm mb-2">
						<textarea id="DetalleNota" class="form-control" maxlength="3000" tabindex="30" required></textarea>
					</div>
					<div class="col-12 col-md-4 form-group form-group-sm mb-0">
						<label class="mb-0" for="form-imageAnexos">Anexar Archivos:</label>
						<div class='custom-file custom-file-sm'>
							<input type='file' class='custom-file-input custom-file-input-sm' name="archivos[]" id="form-imageAnexos" multiple="true" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
							<label class='custom-file-label custom-file-label-sm' for='archivos' data-browse='Elegir'>
								<span id="form-image-spanArchivos" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
							</label>
						</div>
					</div>
					<div class="col-12 col-md-3 form-group form-group-sm mb-0">
						<label class="mb-0" for="Privado">Visibilidad:</label>
						<select id="Privado" class="custom-select chosen-select">
							<option selected value="0">Publica</option>
							<option value="1">Privado</option>
						</select>
					</div>
					
					<div class="col-12 col-md-2 ml-auto align-self-end mt-2 mt-md-0">
						<button id="btn_enviarNota" class="btn btn-success btn-sm btn-block" disabled><i class="fas fa-save"></i> Guardar</button>
					</div> 
				</form>
			</div>	
		</div>
	</div>

	<div class="accordion col-12 p-0 verEditar" id="accordionCerrarActividades">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Notas" data-toggle="collapse" data-target="#collapseCerrarActividades" aria-expanded="true" aria-controls="collapseCerrarActividades">
				<h5 class="mb-0 my-auto">
					<i class="fas fa-list"></i> Cerrar Actividades
				</h5>
			</button>
			<div id="collapseCerrarActividades" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Notas" data-parent="#accordionNotas">
				<div class="row">
					<div class="col-12 col-md-3 mb-2">
						<button class="btn btn-primary btn-sm btn-block" id="btnCerrarActividad"><i class="fas fa-plus"></i> Cerrar Actividad</button>
					</div>
					<div class="col-12">
						<div class="table-responsive" style="min-height: 220px !important;">
							<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento w-100 mb-0" id="TblCerrarActividad" data-tipo="H" cellspacing="0">
								<thead>
									<tr>
										<th>Acción</th>
										<th>Técnico</th>
										<th>Actividad</th>
										<th>Fecha Inicial</th>
										<th>Hora Inicial</th>
										<th>Fecha Final</th>
										<th>Hora Final</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="accordion col-12 p-0 verEditar" id="accordionHistorialIncidencia">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Notas" data-toggle="collapse" data-target="#collapseHistorialIncidencia" aria-expanded="true" aria-controls="collapseHistorialIncidencia">
				<h5 class="mb-0 my-auto">
					<i class="fas fa-history"></i> Historial Incidencia
				</h5>
			</button>
			<div id="collapseHistorialIncidencia" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Notas" data-parent="#accordionNotas">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped w-100" id="TblHistorialIncidencia">
						<thead class="thead-light">
							<tr>
								<td style="width: 20%">Fecha</td>
								<td style="width: 30%">Nombre de Usuario</td>
								<td>Cambio</td>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
	
	<hr class="my-2">

	<div class="col-12 text-right col-md-12 mt-2 p-0 d-flex justify-content-between">
		<button class="btn btn-secondary" id="Cancelar"><i class="fas fa-angle-left"></i> Regresar</button>	
		<button type="submit" id="guardarAgenda" class="verCrear btn btn-success"><i class="fas fa-save"></i> Registrar</button>
		<button type="button" id="ActualizarAgenda" class="verEditar btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
	</div>

</div>