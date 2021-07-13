<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">Datos vivienda</h4>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
	<form id="frmCRUD">
		<div class="row">
			<div class="col-12">
				*<label class="mb-0" for="TipoViviendaId">Tipo de vivienda</label>
				<select class="form-control form-control-sm chosen-select" id="chTipoVivienda">
					<option value="">&nbsp;</option>
					<?php if(count($TipoVivienda) > 0) {
						foreach ($TipoVivienda as $key) {
							echo "<option value='".$key->id."'>".$key->nombre."</option>";
						}
					} ?>
				</select>
			</div>
			<div class="col-12">
				*<label class="mb-0" for="TipoViviendaId">Vivienda</label>
				<select class="form-control form-control-sm chosen-select" id="chVivienda">
					<option value="">&nbsp;</option>
				</select>
			</div>
			<div class="col-12 mt-2">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						*<label class="mb-0" for="Nomenclatura">Nomenclatura</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Nomenclatura" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						<label class="mb-0" for="Nomenclatura">Citófono</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Citofono" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						<label class="mb-0" for="Terreno">M2 Terreno</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Terreno" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4" title="Metros cuadrados construidos">
						<label class="mb-0" for="Construido">M2 Constr.</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Construido" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						<label class="mb-0" for="Pisos">N° pisos</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Pisos" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						<label class="mb-0" for="VidaUtil">Años vida util</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="VidaUtil" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4" title="Numero de habitaciones">
						<label class="mb-0" for="NumHabitacion">N° habitacio.</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="NumHabitacion" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						<label class="mb-0" for="NumBano">N° baños</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="NumBano" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						<label class="mb-0" for="NumVentana">N° ventanas</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="NumVentana" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-6">
						<label class="mb-0" for="Matricula">N° matricula</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Matricula" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-6" title="Cedula catastral">
						<label class="mb-0" for="CedulaCatastral">N° cedula cat.</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="CedulaCatastral" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-6">
						<label class="mb-0" for="Valor">Valor $COP</label>
						<input type="text" class="form-control form-control-sm dVi" data-db="Valor" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-xl-4">
						*<label class="mb-0" for="Estado">Estado</label>
						<select class="form-control form-control-sm dVi" data-db="Estado" disabled>
							<option value="">&nbsp;</option>
							<option value="A">Activo</option>
							<option value="I">Inactivo</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
	<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
</div>
