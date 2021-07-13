<div data-auto class="d-none">
	<label class="mb-0" for="ViviendaId"><span class="text-danger">*</span>Código</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="ViviendaId" data-required data-codigo data-identity-insert>
</div>
<div class="row">
	<div class="col-12 col-sm-6 col-md-6 col-xl-5">
		<label class="mb-0" for="TipoViviendaId"><span class="text-danger">*</span>Tipo de vivienda</label>
		<select class="form-control form-control-sm chosen-select" data-db="TipoViviendaId" data-required>
			<option value="">Seleccione</option>
			<?php if(count($TipoVivienda) > 0) {
				foreach ($TipoVivienda as $key) {
					echo "<option value='".$key->id."'>".$key->nombre."</option>";
				}
			} ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-4">
		<label class="mb-0" for="Nomenclatura"><span class="text-danger">*</span>Nomenclatura</label>
		<input type="text" class="form-control form-control-sm toUpper" data-db="Nomenclatura" maxlength="15" data-required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3">
		<label class="mb-0" for="Nomenclatura">Citófono</label>
		<input type="text" class="form-control form-control-sm data-int" data-db="Citofono" maxlength="6" >
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3">
		<label class="mb-0" for="Terreno">M2 Terreno</label>
		<input type="text" class="form-control form-control-sm data-decimal" data-db="Terreno" data-enteros="4">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3" title="Metros cuadrados construidos">
		<label class="mb-0" for="Construido">M2 Constr.</label>
		<input type="text" class="form-control form-control-sm data-decimal" data-db="Construido" data-enteros="4">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3">
		<label class="mb-0" for="Pisos">N° pisos</label>
		<input type="text" class="form-control form-control-sm data-int" data-db="Pisos">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3">
		<label class="mb-0" for="VidaUtil">Años vida util</label>
		<input type="text" class="form-control form-control-sm data-int" data-db="VidaUtil">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3" title="Numero de habitaciones">
		<label class="mb-0" for="NumHabitacion">N° habitacio.</label>
		<input type="text" class="form-control form-control-sm data-int" data-db="NumHabitacion">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3">
		<label class="mb-0" for="NumBano">N° baños</label>
		<input type="text" class="form-control form-control-sm data-int" data-db="NumBano">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-3">
		<label class="mb-0" for="NumVentana">N° ventanas</label>
		<input type="text" class="form-control form-control-sm data-int" data-db="NumVentana">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-6">
		<label class="mb-0" for="Matricula">N° matricula</label>
		<input type="text" class="form-control form-control-sm toUpper" data-db="Matricula" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-6" title="Cedula catastral">
		<label class="mb-0" for="CedulaCatastral">N° cedula cat.</label>
		<input type="text" class="form-control form-control-sm toUpper" data-db="CedulaCatastral" maxlength="25">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-6">
		<label class="mb-0" for="Valor">Valor $COP</label>
		<input type="text" class="form-control form-control-sm data-decimal2" data-db="Valor" data-enteros="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-xl-4">
		<label class="mb-0" for="Estado"><span class="text-danger">*</span>Estado</label>
		<select class="custom-select custom-select-sm" data-db="Estado" data-required>
			<option value="">Seleccione</option>
			<option value="A">Activo</option>
			<option value="I">Inactivo</option>
		</select>
	</div>
	<div class="col-12 mt-2">
		<div class="form-check">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Antejardin" data-on="1" data-off="0">
					<label class="mb-0" for="Antejardin">Antejardin</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Patio" data-on="1" data-off="0">
					<label class="mb-0" for="Patio">Patio</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Terraza" data-on="1" data-off="0">
					<label class="mb-0" for="Terraza">Terraza</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Cocina" data-on="1" data-off="0">
					<label class="mb-0" for="Cocina">Cocina</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Acueducto" data-on="1" data-off="0">
					<label class="mb-0" for="Acueducto">Acueducto</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Alcantarillado" data-on="1" data-off="0">
					<label class="mb-0" for="Alcantarillado">Alcantarillado</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Energia" data-on="1" data-off="0">
					<label class="mb-0" for="Energia">Energia</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3" title="Cocina integral">
					<input type="checkbox" class="form-check-input" data-db="Integral" data-on="1" data-off="0">
					<label class="mb-0" for="Integral">Cocina int</label>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-xl-3">
					<input type="checkbox" class="form-check-input" data-db="Gas" data-on="1" data-off="0">
					<label class="mb-0" for="Gas">Gas</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-2">
		<label class="mb-0" for="Observacion">Observaciones</label>
		<textarea class="form-control form-control-sm" rows="2" data-db="Observacion"></textarea>
	</div>
</div>
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
			$(".toUpper").keyup(function(){
				$(this).val($(this).val().toUpperCase());
			});
			$("[data-db=Nomenclatura]").on("change",function(){
				if ($(this).val() != '') {
					$.ajax({
						url: base_url() + 'Administrativo/Configuracion/Inicio/vivienda/validaNomenclatura',
						type: 'POST',
						data: {
							Num : $(this).val().trim()
						},
						success: function(respuesta){
							if (respuesta == 1) {
								alertify.alert("Error","El numero de nomenclatura ya se encuentra registrado en el sistema.",function(){
									$("[data-db=Nomenclatura]").val("");
									setTimeout(function(){$("[data-db=Nomenclatura]").focus()},0);
									return;
								});
							}
						}
					});
				}
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