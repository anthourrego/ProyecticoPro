<div data-auto class="d-none">
	<label class="mb-0" for="EstadoId"><span class="text-danger">*</span>EstadoId</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="EstadoId" data-required data-codigo data-identity-insert>
</div>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="60" data-required> 
<label class="mb-0" for="Cierre">Cierre</label>
<select class="custom-select custom-select-sm" data-db="Cierre">
	<option value="1">Sí</option>
	<option value="0">No</option>
</select>
<label class="mb-0" for="Color">Color</label>
<div class="input-group input-group-sm">
	<input type="text" class="form-control form-control-sm" data-db="ColorHexa" maxlength="7">
	<div class="input-group-append input-group-addon" title="Click para abrir el selector de Color">
		<span class="input-group-text w-100"><i></i></span>
	</div>
</div>

<script type="text/javascript">
	var color;
	(function() {
		document.addEventListener('DOMContentLoaded', function (e) {
			color = $(this).find("[data-db=ColorHexa]").closest('div').colorpicker({
				useAlpha:false,
				autoInputFallback:false,
				format:"hex"
			});
		});
		document.addEventListener('editar', function(e) {
			$('[data-db=ColorHexa').change();
		});
		document.addEventListener('crear', function(e) {
			$('[data-db=ColorHexa').val('#e9ecef').change();
		});
	})(); 

	function lightOrDark(color) {

	    // Variables for red, green, blue values
	    var r, g, b, hsp;
	    
	    // Check the format of the color, HEX or RGB?
	    if (color.match(/^rgb/)) {

	        // If HEX --> store the red, green, blue values in separate variables
	        color = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);
	        
	        r = color[1];
	        g = color[2];
	        b = color[3];
	    } 
	    else {

	        // If RGB --> Convert it to HEX: http://gist.github.com/983661
	        color = +("0x" + color.slice(1).replace( 
	        	color.length < 5 && /./g, '$&$&'));

	        r = color >> 16;
	        g = color >> 8 & 255;
	        b = color & 255;
	    }
	    
	    // HSP (Highly Sensitive Poo) equation from http://alienryderflex.com/hsp.html
	    hsp = Math.sqrt(
	    	0.299 * (r * r) +
	    	0.587 * (g * g) +
	    	0.114 * (b * b)
	    	);

	    // Using the HSP value, determine whether the color is light or dark
	    if (hsp>127.5) {
	    	return '#000';
	    	return 'light';
	    } 
	    else {
	    	return '#fff';
	    	return 'dark';
	    }
	}

	$PARAMETROS.createdRow = function(row, data, dataIndex){
		var color = data[4];
		var botones = "<center><div class='btn-group btn-group-xs'>\
			<button type='button' class='editar btn btn-success'><span class='far fa-edit' title='Editar'></span></button>\
			<button type='button' class='eliminar btn btn-danger'><span class='far fa-trash-alt' title='Eliminar'></span></button>\
		</div></center>";
		$(row).find('td:eq(0)').html(botones);
		$(row).find('td:eq(4)').css('background-color', color);
		$(row).find('td:eq(4)').css('color', lightOrDark(color));

		$(row).on("click",'.editar',function(e){
			e.preventDefault();
			$CODIGO = data[1];
			cargar($CODIGO);
		});
		
		$(row).on("click",'.eliminar',function(e){
			e.preventDefault();
			var $CODIGO = data[1],
				$ID = $("[data-codigo]").attr('data-db');
			alertify.confirm('Eliminar', '¿Está seguro de eliminar el registro seleccionado?'
				, function(){
					$.ajax({
						url: base_url() + $DIRECTORY + $CONTROLADOR + "/eliminarCRUD/" + $TABLA,
						type: 'POST',
						data: {
							codigo: $CODIGO
							,ID: $ID
							,controlador: $TABLANOMBRE
							,programa: $TITULO
						},
						success: function(respuesta){
							if(respuesta == true){
								alertify.success('Registro eliminado');
								dataTable.draw();
								$("#frmCRUD").trigger("reset");
								var event = new Event('eliminar');
								document.dispatchEvent(event);
							}else{
								alertify.error('No se pudo eliminar el registro');
							}
						}
					});
				}
				, function(){ alertify.warning('No se eliminó el registro') }
			);
		});
	}
</script>