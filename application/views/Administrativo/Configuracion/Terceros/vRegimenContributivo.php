<label class="mb-0" for="RegimenID"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="RegimenID" maxlength="2" data-required data-codigo>
<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="30" data-required>
<b>Cuando usted compra realiza</b>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="cretefuent" id="cretefuent" data-on="S" data-off="N">
	<label class="custom-control-label" for="cretefuent">Calcula Retención en la Fuente</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="civa" id="civa" data-on="S" data-off="N">
	<label class="custom-control-label" for="civa">Calcula el IVA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="creteica" id="creteica" data-on="S" data-off="N">
	<label class="custom-control-label" for="creteica">Calcula Retención del ICA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="creteiva" id="creteiva" data-on="S" data-off="N">
	<label class="custom-control-label" for="creteiva">Calcula Retención del IVA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="ccree" id="ccree" data-on="S" data-off="N">
	<label class="custom-control-label" for="ccree">Calcula el CREE</label>
</div>
<b>Cuando usted vende realiza</b>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="vretefuent" id="vretefuent" data-on="S" data-off="N">
	<label class="custom-control-label" for="vretefuent">Practica Retención en la Fuente</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="vreteiva" id="vreteiva" data-on="S" data-off="N">
	<label class="custom-control-label" for="vreteiva">Calcula Retención del IVA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="vreteica" id="vreteica" data-on="S" data-off="N">
	<label class="custom-control-label" for="vreteica">Practica Retención del ICA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="vcree" id="vcree" data-on="S" data-off="N">
	<label class="custom-control-label" for="vcree">Calcula el CREE</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="vreteotro" id="vreteotro" data-on="S" data-off="N">
	<label class="custom-control-label" for="vreteotro">Otro Impuesto</label>
</div>
<b>Estos tipos de terceros realizan</b>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="treteiva" id="treteiva" data-on="S" data-off="N">
	<label class="custom-control-label" for="treteiva">Liquidación de IVA en las Facturas de Venta</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="tretefuent" id="tretefuent" data-on="S" data-off="N">
	<label class="custom-control-label" for="tretefuent">Autoretención en la Fuente </label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="tliquiva" id="tliquiva" data-on="S" data-off="N">
	<label class="custom-control-label" for="tliquiva">Autoretención de IVA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="treteica" id="treteica" data-on="S" data-off="N">
	<label class="custom-control-label" for="treteica">Autoretención de ICA</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="tcree" id="tcree" data-on="S" data-off="N">
	<label class="custom-control-label" for="tcree">Calcula el CREE</label>
</div>
<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input" data-db="treteotro" id="treteotro" data-on="S" data-off="N">
	<label class="custom-control-label" for="treteotro">Otro Impuesto</label>
</div>
<label class="mb-0" for="CodigoDIAN"><b>Régimen según FE</b></label>
<select class="custom-select custom-select-sm" data-db="CodigoDIAN">
	<option value="">Seleccione</option>
	<option value="04">Régimen Simple</option>
	<option value="05">Régimen Ordinario</option>
</select>

<script type="text/javascript">
	$PARAMETROS.columnDefs = [
		{ orderable: false, targets: [0], width: '1%' }
		,{ targets: [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], visible: false }
	];
</script>