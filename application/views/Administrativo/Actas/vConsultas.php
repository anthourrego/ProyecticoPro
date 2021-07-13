<style>
	.list-group-item.active{
		color: #333;
		background-color: #e6e6e6;
		border-color: #adadad;
	}
	
</style>

<div class="row">
	<div class="col-sm-2">
		<label class="col-form-label col-form-label-sm" for="fTipo">Filtrar:</label>
		<select id="fTipo" class="chosen-select custom-select custom-select-sm">
			<option value="">Todo</option>
			<option value="fechas">Rango de fechas</option>
			<option value="mes">Mes</option>
			<option value="anio">Año</option>
		</select>
	</div>
	<div class="col-sm-2 fechas divFiltro d-none">
		<label for="fInicio">Desde:</label>
		<div class="input-group date cha1 datepicker">
			<input type="text" class="form-control form-control-sm dateFecha" name="fInicio" id="fInicio" maxlength="15" value="<?= date('Y-m-d') ?>">
			<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
				<span class="input-group-text fas fa-calendar-alt d-flex"></span>
			</a>
		</div>
	</div>
	<div class="col-sm-2 fechas divFiltro d-none">
		<label for="fFin">Hasta:</label>
		<div class="input-group date cha1 datepicker">
			<input type="text" class="form-control form-control-sm dateFecha" name="fFin" id="fFin" maxlength="15" value="<?= date('Y-m-d') ?>">
			<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
				<span class="input-group-text fas fa-calendar-alt d-flex"></span>
			</a>
		</div>
	</div>
	<div class="col-sm-1 mes divFiltro d-none">
		<label>Año:</label>
		<input type="text" id="fAnio2" class="form-control form-control-sm aniopicker" value="<?= date('Y') ?>">
	</div>
	<div class="col-sm-2 mes divFiltro d-none">
		<label>Mes:</label>
		<select id="fMes" class="chosen-select custom-select custom-select-sm cargaFiltro">
			<option value="Enero">Enero</option>
			<option value="Febrero">Febrero</option>
			<option value="Marzo">Marzo</option>
			<option value="Abril">Abril</option>
			<option value="Mayo">Mayo</option>
			<option value="Junio">Junio</option>
			<option value="Julio">Julio</option>
			<option value="Agosto">Agosto</option>
			<option value="Septiembre">Septiembre</option>
			<option value="Octubre">Octubre</option>
			<option value="Noviembre">Noviembre</option>
			<option value="Diciembre">Diciembre</option>
		</select>
	</div>
	<div class="col-sm-1 anio divFiltro d-none">
		<label>Año:</label>
		<input type="text" id="fAnio" class="form-control form-control-sm aniopicker" value="<?= date('Y') ?>">
	</div>
	<div class="divFiltro mes hide">
	</div>
	<div class="divFiltro anio hide">
	</div>
</div>
<hr>
<div class="row mt-3">
	<div class="col-12 col-lg-2">
		<div class="list-group" id="list-tab" role="tablist">
			<a class="list-group-item list-group-item-action active" id="list-asistentes-list" data-toggle="list" data-tabla="dtTblTiempoAsistentes" href="#list-asistentes" role="tab" aria-controls="asistentes">Tiempo Asistentes</a>
			<a class="list-group-item list-group-item-action" id="list-mes-list" data-toggle="list" data-tabla="dtTblTiempoMes" href="#list-mes" role="tab" aria-controls="mes">Mes</a>
			<a class="list-group-item list-group-item-action" id="list-TipoReunion-list" data-toggle="list" data-tabla="dtTblTiempoTipoReunion" href="#list-TipoReunion" role="tab" aria-controls="TipoReunion">Tiempo Tipo Reunión</a>
		</div>
	</div>
  	<div class="col-12 col-lg-10 mt-4 mt-lg-0">
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="list-asistentes" role="tabpanel" aria-labelledby="list-asistentes-list">
				<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblTiempoAsistentes">
					<thead>
						<tr>
							<th>Asistente</th>
							<th>Cantidad Actas</th>
							<th>Tiempo</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
				<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblTiempoMes">
					<thead>
						<tr>
							<th>Mes</th>
							<th>Cantidad Actas</th>
							<th>Tiempo</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="tab-pane fade" id="list-TipoReunion" role="tabpanel" aria-labelledby="list-TipoReunion-list">
				<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblTiempoTipoReunion">
					<thead>
						<tr>
							<th>Tipo Reunión</th>
							<th>Cantidad Actas</th>
							<th>Tiempo</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
  	</div>
</div>