<div class="row">
	<div class="col-12 col-sm-6 col-xl-6">
		<form id="frmVehiculo" autocomplete="off">
			<div class="row">
					<div class="col-12 col-sm-6 col-xl-4">
						<label class="labelForm" for="tipoVehi"><span class="text-danger">*</span>Tipo de vehículo</label>
						<select class="form-control form-control-sm chosen-select" id="tipoVehi">
							<option value="">&nbsp;</option>
							<?php if(count($TipoVehi) > 0) {
								foreach ($TipoVehi as $key) {
									echo "<option value='".$key->id."'>".$key->nombre."</option>";
								}
							} ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-xl-3">
						<label class="labelForm" for="placa"><span class="text-danger">*</span>Placa</label>
						<input type="text" class="form-control form-control-sm toUpper" id="placa" required maxlength="20">
					</div>
					<div class="col-12 col-sm-6 col-xl-3">
						<label class="labelForm" for="marca">Marca</label>
						<input type="text" class="form-control form-control-sm" id="marca" maxlength="70">
					</div>
					<div class="col-12 col-sm-6 col-xl-2">
						<label class="labelForm" for="modelo">Modelo</label>
						<input type="text" class="form-control form-control-sm numerico" id="modelo" maxlength="4">
					</div>
					<div class="col-12 col-sm-6 col-xl-3">
						<label class="labelForm" for="color">Color</label>
						<input type="text" class="form-control form-control-sm" id="color" maxlength="35">
					</div>
					<div class="col-12 col-sm-6 col-xl-2">
						<label class="labelForm" for="cilindraje">Cilindraje</label>
						<input type="text" class="form-control form-control-sm numerico" id="cilindraje" maxlength="6">
					</div>
					<div class="btn-group col-12 mt-2" role="group">
						<button type="submit" class="btn btn-success col-5 col-sm-4 col-xl-3 ml-auto " form="frmVehiculo" id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
					</div>
			</div>
		</form>
	</div>
	<div class="col-12 col-sm-6 col-xl-6" style="border-left: 1px solid #e0e0e0">
		<div class="table-responsive">
			<table id="tblVehiculo" class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 8%">Acciones</th>
						<th style="width: 8%">Id</th>
						<th>Tipo de vehiculo</th>
						<th>Placa</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Color</th>
						<th>Cilindraje</th>
					</tr>
				</thead>	
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$CC = '<?=$this->session->userdata('CEDULA')?>';
</script>