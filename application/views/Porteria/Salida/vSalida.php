<style type="text/css">
	.telF{
		font-size: 35px;
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-12 col-sm-12 col-md-5 col-xl-5">
		<div class="btn-group col-12 pr-xl-0" role="group">
			<button type="button" class="btn btn-primary" id="btnCC"><i class="fas fa-address-card mr-1"></i> Cedula</button>
			<button type="button" class="btn btn-warning" id="btnPlaca"><i class="fas fa-car mr-1"></i>&nbsp;Placa&nbsp;</button>
		</div>
		<div class="chos-unit mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divPlaca d-none">
			<input type="text" class="form-control telF toUpperTrim" id="txtPlaca" placeholder="Ej: SFT289 " autocomplete="off">
		</div>
		<div class="chos-unit mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divCedula d-none">
			<input type="text" class="form-control telF numerico" id="txtCedula" placeholder="Ej: 10105023 " autocomplete="off">
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-7 col-xl-7 divSalida d-none">
		<form id="frmIngreso" autocomplete="off">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-4 col-xl-4">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Cedula: </label>
					<input type="text" id="txtCedulaS" class="form-control txtInput numerico valida" placeholder="Cedula..." readonly>
				</div>
				<div class="col-8">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Nombre: </label>
					<input type="text" id="txtNomVisiS" class="form-control txtInput valida" placeholder="Nombre visitante..." readonly>
				</div>
				<div class="col-6">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Tipo de vehículo: </label>
					<input type="text" id="txtTipoVehiS" class="form-control txtInput" placeholder="Nombre visitante..." readonly>
				</div>
				<div class="col-12 col-sm-12 col-md-3 col-xl-3">
					<label class="mb-0 txtLabel">Placa: </label>
					<input type="text" id="txtPlacaS" class="form-control txtInput toUpperTrim" placeholder="Placa..." readonly>
				</div>
				<div class="col-12 col-sm-12 col-md-3 col-xl-3">
					<label class="mb-0 txtLabel">Tipo: </label>
					<input type="text" id="txtTipoS" class="form-control txtInput toUpperTrim" placeholder="Tipo..." readonly>
				</div>
				<div class="btn-group col-12 mt-2" role="group">
					<button type="button" class="btn btn-primary col-4 ml-auto" id="btnSalida"><i class="fas fa-check-circle"></i>&nbsp;Dar salida&nbsp;</button>
				</div>
			</div>
		</form>
	</div>
</div>