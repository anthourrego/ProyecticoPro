<style type="text/css">
	.date{
		text-align: center;
	}
	.chos-unit .chosen-container-single a{
		height: calc(1.5em + .5rem + 8px) !important;
	}
	.chos-unit .chosen-container-single a span{
		margin-top: 3px;
	}
</style>
<div class="row">
	<div class="col-12 col-sm-6 mb-2">
		<form id="frmRegistro" autocomplete="off">
			<div class="row">
				<div class="col-12 col-sm-3">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Fecha : </label>
					<div class="input-group date datepicker">
						<input type="text" class="form-control form-control-sm dateFecha" name="fecha" id="fecha" maxlength="15" value="" required>
						<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
							<span class="input-group-text fas fa-calendar-alt d-flex"></span>
						</a>
					</div>
					<!-- <input class="form-control date" id="fecha" required> -->
				</div>
				<div class="col-12 col-sm-9">
					<label class="mb-0 txtLabel">Zona : </label>
					<select class="form-control input-sm chos-unit chosen" required autofocus id="chZona" autocomplete="off">
						<option selected value="" disabled>Selecione la zona:</option>
						<option value="">&nbsp;</option>
						<?php if(count($Zonas) > 0) {
							foreach ($Zonas as $key) {
								echo "<option value='".$key->id."'>".$key->nombre."</option>";
							}
						} ?>
					</select>
				</div>
				<div class="col-12">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Observaciones : </label>
					<textarea class="form-control form-control-sm" id="observacion" required></textarea>
				</div>
				<div class="btn-group col-12 mt-2" role="group">
					<button type="submit" class="btn btn-success col-6 col-sm-6 col-xl-3 ml-auto" form="frmRegistro" id="btnGuardar"><i class="fas fa-save"></i>&nbsp;Guardar&nbsp;</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-12 col-sm-6">
		<div class="table-responsive">
			<table id="tblHistorico" class="table table-striped table-bordered table-condensed nowrap table-hover w-100" cellspacing="0">
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Fecha registro</th>
						<th>Usuario</th>
						<th>Zona</th>
						<th>Descripción</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>