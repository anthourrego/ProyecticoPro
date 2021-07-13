<div data-auto class="d-none">
	<label class="mb-0" for="TipoActividadId"><span class="text-danger">*</span>TipoActividadId</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="TipoActividadId" data-required data-codigo data-identity-insert>
</div>

<label class="mb-0" for="Codigo"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="Codigo" maxlength="5" data-required data-codigo>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="70" data-required>
<label class="mb-0" for="FamiliaId">Familia</label>
<select class="custom-select custom-select-sm chosen-select" data-db="FamiliaId">
	<option value="">Seleccione</option>
	<?php if(count($Familia) > 0) {
		foreach ($Familia as $key) {
			echo "<option value='".$key->FamiliaId."'>".$key->Nombre."</option>";
		}
	} ?>
</select>

<label class="mb-0" for="Duracion">Duracion</label>
<input type="text" class="form-control form-control-sm" data-db="Duracion" maxlength="20">

<label class="mb-0" for="ValorHoraOrdinaria">Valor Hora Ordinaria</label>
<input type="text" class="form-control form-control-sm" data-db="ValorHoraOrdinaria" maxlength="14">
<label class="mb-0" for="ValorHoraNocturna">Valor Hora Nocturna</label>
<input type="text" class="form-control form-control-sm" data-db="ValorHoraNocturna" maxlength="14">
<label class="mb-0" for="ValorHoraDominical">Valor Hora Dominical</label>
<input type="text" class="form-control form-control-sm" data-db="ValorHoraDominical" maxlength="14">


<label class="mb-0" for="Estado">Estado</label>
<select class="custom-select custom-select-sm " data-db="Estado">
	<option value="A">Activo</option>
	<option value="I">Incactivo</option>
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