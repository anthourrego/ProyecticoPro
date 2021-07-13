<label class="mb-0" for="ciudaid"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="ciudadid" maxlength="5" data-required data-codigo>
<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="80" data-required>
<label class="mb-0" for="dptoid">Departamento</label>
<select class="form-control form-control-sm chosen-select" data-db="dptoid">
	<option value="">Seleccione</option>
	<?php if(count($Departamentos) > 0) {
		foreach ($Departamentos as $key) {
			echo "<option value='".$key->dptoid."'>".$key->nombre."</option>";
		}
	} ?>
</select>

<script type="text/javascript">
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