<div data-auto class="d-none">
	<label class="mb-0" for="ActividadEquipoId"><span class="text-danger">*</span>ActividadEquipoId</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="ActividadEquipoId" data-required data-codigo data-identity-insert>
</div>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="70" data-required>

<label class="mb-0" for="EquipoId">Equipo</label>
<select class="form-control form-control-sm chosen-select" data-db="EquipoId" data-required>
	<option value="" selected disabled>Seleccione equipo...</option>
	<option value="">&nbsp;</option>
	<?php if(count($Equipo) > 0) {
		foreach ($Equipo as $key) {
			echo "<option value='".$key->EquipoId."'>".$key->Nombre."</option>";
		}
	} ?>
</select>

<label class="mb-0" for="Tipo">Tipo</label>
<select class="form-control form-control-sm chosen-select" data-db="Tipo" data-required>
	<option value="" selected disabled>Seleccione tipo de operación...</option>
	<option value="">&nbsp;</option>
	<option value="T">Tiempo</option>
	<option value="C">Consumo</option>
</select>

<div class="consumo d-none">
	<label class="mb-0" for="UnidadMedidaId">Unidad Medida</label>
	<select class="form-control form-control-sm chosen-select" data-db="UnidadMedidaId">
		<option value="">&nbsp;</option>
		<?php if(count($UnidadMedida) > 0) {
			foreach ($UnidadMedida as $key) {
				echo "<option value='".$key->UnidadMedidaId."'>".$key->Nombre."</option>";
			}
		} ?>
	</select>
</div>
<div class="tiempo d-none">
	<label class="mb-0" for="TiempoOperacion">Tiempo Operacion</label>
	<select class="form-control form-control-sm chosen-select" data-db="TiempoOperacion">
		<option value="" selected disabled>Seleccione tiempo de operación...</option>
		<option value="">&nbsp;</option>
		<option value="001">Dia</option>
		<option value="002">Semana</option>
		<option value="003">Mensual</option>
		<option value="004">Anual</option>
	</select>

	<label class="mb-0" for="DiasAlerta">Dias Alerta</label>
	<input type="text" class="form-control form-control-sm" data-db="DiasAlerta">
</div>




<script type="text/javascript">
	(function() {
		document.addEventListener('DOMContentLoaded', function (e) {
			$('select.chosen-select').chosen({
				placeholder_text_single: 'Seleccione...'
				,width: '100%'
				,no_results_text: 'Oops, no se encuentra'
				,allow_single_deselected: true
			});
			$("[data-db=Tipo]").on("change",function(){
				if ($(this).val() != '' || $(this).val() != null) {
					if ($(this).val() == 'T') {
						$(".consumo").addClass('d-none');
						$(".tiempo").removeClass('d-none');
						$("[data-db=UnidadMedidaId]").val("").trigger("chosen:updated");
					}else{
						$(".tiempo").addClass('d-none');
						$(".consumo").removeClass('d-none');
						$("[data-db=TiempoOperacion]").val("").trigger("chosen:updated");
						$("[data-db=DiasAlerta]").val("");
					}
				}else{
					$(".tiempo, .consumo").addClass('d-none');
				}
			})
		});
		document.addEventListener('editar', function(e) {
			$('select.chosen-select').trigger('chosen:updated');
			if ($("[data-db=Tipo]").val() != null) {
				$("[data-db=Tipo]").change();
			}
		});
		document.addEventListener('crear', function(e) {
			$('select.chosen-select').val('').trigger('chosen:updated');
			$(".tiempo, .consumo").addClass('d-none');
		});
	})();
</script>