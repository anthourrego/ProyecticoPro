<label class="mb-0" for="tipotercid"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="tipotercid" maxlength="15" data-required data-codigo>
<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="60" data-required>
<label class="mb-0">Aplica Para:</label>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="Cliente" id="Cliente" data-on="1" data-off="0">
	<label class="custom-control-label" for="Cliente">Cliente</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="Proveedor" id="Proveedor" data-on="1" data-off="0">
	<label class="custom-control-label" for="Proveedor">Proveedor</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="empleado" id="empleado" data-on="1" data-off="0">
	<label class="custom-control-label" for="empleado">Empleado</label>
</div>
<label class="mb-0"><b>% Descuento Ventas</b></label>
<div class="row">
	<div class="col-sm-6">
		<label class="mb-0" for="porcelunes">Lunes</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porcelunes" data-digitos="4" data-enteros="3">
	</div>
	<div class="col-sm-6">
		<label class="mb-0" for="porcemarte">Martes</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porcemarte" data-digitos="4" data-enteros="3">
	</div>
	<div class="col-sm-6">
		<label class="mb-0" for="porcemierc">Miércoles</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porcemierc" data-digitos="4" data-enteros="3">
	</div>
	<div class="col-sm-6">
		<label class="mb-0" for="porcejueve">Jueves</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porcejueve" data-digitos="4" data-enteros="3">
	</div>
	<div class="col-sm-6">
		<label class="mb-0" for="porceviern">Viernes</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porceviern" data-digitos="4" data-enteros="3">
	</div>
	<div class="col-sm-6">
		<label class="mb-0" for="porcesabad">Sábado</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porcesabad" data-digitos="4" data-enteros="3">
	</div>
	<div class="col-sm-6">
		<label class="mb-0" for="porcedomin">Domingo</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="porcedomin" data-digitos="4" data-enteros="3">
	</div>
</div>
<label class="mb-0" for="DescuentoMax">% Descuento Máximo</label>
<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="DescuentoMax" data-digitos="4" data-enteros="3">

<script type="text/javascript">
	$PARAMETROS.columnDefs = [
		{ orderable: false, targets: [0], width: '1%' }
		,{ targets: [3,4,5,6,7,8,9,10,11,12], visible: false }
	];
</script>