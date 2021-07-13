<div data-auto class="d-none">
	<label class="mb-0" for="TipoStopId"><span class="text-danger">*</span>Código</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="TipoStopId" data-required data-codigo data-identity-insert>
</div>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="60" data-required>
<label class="mb-0" for="Estado"><span class="text-danger">*</span>Estado</label>
<select class="custom-select custom-select-sm chosen-select" data-db="Estado" data-required>
	<option value="">Seleccione</option>
	<option value="A">Activo</option>
	<option value="I">Inactivo</option>
</select>

<script type="text/javascript">
	$PARAMETROS.columnDefs = [
		{ targets: [0], width: '8%' },
		{ targets: [1], visible: false }
	];
	(function() {
		document.addEventListener('DOMContentLoaded', function (e) {
			$('select.chosen-select').chosen({
				placeholder_text_single: ''
				,width: '100%'
				,no_results_text: 'Oops, no se encuentra'
				,allow_single_deselected: true
			});
		});
		document.addEventListener('editar', function(e) {
			$('select.chosen-select').trigger('chosen:updated');
		});
		document.addEventListener('crear', function(e) {
			$('select.chosen-select').val('').trigger('chosen:updated');
		});
	})();
</script>
