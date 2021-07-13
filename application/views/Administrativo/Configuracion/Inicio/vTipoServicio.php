<div data-auto class="d-none">
	*<label class="mb-0" for="TipoViviendaId">Código</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="TipoServicioId" data-required data-codigo data-identity-insert>
</div>
*<label class="mb-0" for="Nombre">Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="60" data-required>
*<label class="mb-0" for="TipoViviendaId">Estado</label>
<select class="form-control form-control-sm chosen-select" data-db="Estado" data-required>
	<option value="">&nbsp;</option>
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