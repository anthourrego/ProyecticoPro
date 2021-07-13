<label class="mb-0" for="Dependenciaid"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="Dependenciaid" maxlength="15" data-required data-codigo>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="60" data-required>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Centro Costo</label>
<select class="form-control form-control-sm chosen-select" data-db="CentCostId">
	<option value="">&nbsp;</option>
	<?php if(count($CentCost) > 0) {
		foreach ($CentCost as $key) {
			echo "<option value='".$key->CentCostId."'>".$key->nombre."</option>";
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