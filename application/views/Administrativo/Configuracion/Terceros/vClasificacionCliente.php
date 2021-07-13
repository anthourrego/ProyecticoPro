<label class="mb-0" for="idClasificacion"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="idClasificacion" maxlength="15" data-required data-codigo>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="60" data-required>
<label class="mb-0" for="Estado">Estado</label>
<select class="custom-select custom-select-sm" data-db="Estado">
	<option value="A">Activo</option>
	<option value="I">Inactivo</option>
</select>
<label class="mb-0"><b>Rango de Ventas</b></label>
<div class="row">
	<div class="col-sm-12">
		<label class="mb-0" for="VentasInicial">Rango Inicial de Ventas</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="VentasInicial" data-digitos="2" data-enteros="12">
		<label class="mb-0" for="VentasFinal">Rango Final de Ventas</label>
		<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="VentasFinal" data-digitos="2" data-enteros="12">
	</div>
</div>

<script type="text/javascript">
	$PARAMETROS.columnDefs = [
		{ orderable: false, targets: [0], width: '1%' }
		,{ targets: [3,4,5], visible: false }
	];
	(function() {
		document.addEventListener('DOMContentLoaded', function (e) {
			$('[data-db=VentasInicial]').change(function(){
				if($(this).val() == ''){
					var VentasInicial = 0;
				}else{
					var VentasInicial = parseFloat($(this).val().replace(/,/g,''));
				}
				if($('[data-db=VentasFinal]').val() == ''){
					var VentasFinal = 0;
				}else{
					var VentasFinal = parseFloat($(this).val().replace(/,/g,''));
				}
				if(VentasFinal < VentasInicial){
					$('[data-db=VentasFinal]').val($(this).val());
				}
			});
			$('[data-db=VentasFinal]').change(function(){
				if($(this).val() == ''){
					var VentasFinal = 0;
				}else{
					var VentasFinal = parseFloat($(this).val().replace(/,/g,''));
				}
				if($('[data-db=VentasInicial]').val() == ''){
					var VentasInicial = 0;
				}else{
					var VentasInicial = parseFloat($(this).val().replace(/,/g,''));
				}
				if(VentasFinal < VentasInicial){
					$('[data-db=VentasFinal]').val($('[data-db=VentasInicial]').val());
				}
			});
			$('[data-db=VentasFinal], [data-db=VentasInicial]').change(function(){
				if($('[data-db=VentasInicial]').val() == ''){
					var VentasInicial = 0;
				}else{
					var VentasInicial = parseFloat($(this).val().replace(/,/g,''));
				}
				if($('[data-db=VentasFinal]').val() == ''){
					var VentasFinal = 0;
				}else{
					var VentasFinal = parseFloat($(this).val().replace(/,/g,''));
				}
				$.ajax({
					url: base_url() + $DIRECTORY + $CONTROLADOR + "/ValidarRangos",
					type: 'POST',
					data: {
						VentasInicial: VentasInicial
						,VentasFinal: VentasFinal
						,codigo: $('[data-codigo]').val()
					},
					success: function(respuesta){
						if(respuesta != ''){
							alertify.alert('Advertencia', 'El rango indicado se cruza con el rango definido para las siguientes clasificaciones: ' + respuesta);
						}
					}
				});
			});
		});
	})();
</script>