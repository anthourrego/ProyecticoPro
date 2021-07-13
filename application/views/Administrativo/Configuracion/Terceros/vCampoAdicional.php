<div data-auto class="d-none">
	<label class="mb-0" for="crmtablaid"><span class="text-danger">*</span>Código</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="crmtablaid" data-required data-codigo data-identity-insert>
</div>

<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="50" data-required>
<label class="mb-0" for="tipo"><span class="text-danger">*</span>Tipo</label>
<select class="chosen-select custom-select custom-select-sm" data-db="tipo" data-required>
	<option value="" disabled selected>Seleccione</option>
	<option value="L">Lista Selección</option>
	<option value="A">Abierto</option>
</select>

<script type="text/javascript">
	$PARAMETROS.createdRow = function(row, data, dataIndex){
		var botonesAdicionales = '';
		if(data[3] == 'Lista Selección'){
			var nombre = encodeURI(data[2]);
			var boton = "<a href='"+base_url()+'Administrativo/Configuracion/Terceros/ItemCampoAdicional?crmtablaid='+data[1]+"&nombre="+nombre+"' class='btn btn-info'><span class='fas fa-list' title='Items de Selección'></span></a>";
			botonesAdicionales += boton;
		}
		var botones = "<center><div class='btn-group btn-group-xs'>\
			<button type='button' class='editar btn btn-success'><span class='far fa-edit' title='Editar'></span></button>"+botonesAdicionales+"\
			<button type='button' class='eliminar btn btn-danger'><span class='far fa-trash-alt' title='Eliminar'></span></button>\
		</div></center>";

		$(row).find('td:eq(0)').html(botones);

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