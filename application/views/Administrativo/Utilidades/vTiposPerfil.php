<label class="mb-0" for="perfilid"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="perfilid" maxlength="15" data-required data-codigo>
<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm form-group" data-db="nombre" maxlength="50" data-required>

<div class="card border-warning">
	<div class="card-body text-warning">
		<p class="card-text"><i class="fas fa-info-circle"></i> Los perfiles son grupos de usuarios que tienen por definición o por su cargo, los mismos accesos al sistema, cuando usted crea un perfil facilita la asignación de permisos amúltiples usuarios.</p>
	</div>
</div>

<script type="text/javascript">
	$PARAMETROS.createdRow = function(row, data, dataIndex){
		var botones = `<center><div class='btn-group btn-group-xs'>
			<button type='button' class='editar btn btn-success'><span class='far fa-edit' title='Editar'></span></button>
			<a href='`+base_url()+'Administrativo/Utilidades/PerfilesAcceso/Permisos/'+data[1]+`/P' class='btn btn-info'><span class='fas fa-user-shield' title='Accesos'></span></a>
			<button type='button' class='eliminar btn btn-danger'><span class='far fa-trash-alt' title='Eliminar'></span></button>
		</div></center>`;
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