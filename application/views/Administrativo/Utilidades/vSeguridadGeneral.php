<label class="mb-0" for="usuarioId"><span class="text-danger">*</span>Código</label>
<input type="text" class="form-control form-control-sm" data-db="usuarioId" maxlength="15" data-required data-codigo>
<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="50" data-required>
<label class="mb-0" for="password">Contraseña</label>
<input type="password" class="form-control form-control-sm" data-db="password" maxlength="200" autocomplete="off" name="password<?php rand() ?>">
<label class="mb-0" for="cedula">Cédula</label>
<input type="text" class="form-control form-control-sm" data-required data-db="cedula" maxlength="15">
<label class="mb-0" for="estado">Estado</label>
<select class="form-control form-control-sm" data-db="estado">
	<option value="A">Activo</option>
	<option value="I">Inactivo</option>
</select>
<label class="mb-0" for="perfilid">Tipo de Perfil</label>
<select class="form-control form-control-sm" data-db="perfilId">
	<option value="">PERFIL LIBRE</option>
	<?php if(count($Perfiles) > 0) {
		foreach ($Perfiles as $key) {
			echo "<option value='".$key->perfilid."'>".$key->nombre."</option>";
		}
	} ?>
</select>
<label class="mb-0" for="Admin">Administrador</label>
<select class="form-control form-control-sm" data-db="Admin">
	<option value="0">No</option>
	<option value="1">Sí</option>
</select>
<label class="mb-0" for="Propietario">Propietario</label>
<select class="form-control form-control-sm" data-db="Propietario">
	<option value="0">No</option>
	<option value="1">Sí</option>
</select>
<label class="mb-0" for="Porteria">Porteria</label>
<select class="form-control form-control-sm" data-db="Porteria">
	<option value="0">No</option>
	<option value="1">Sí</option>
</select>

<script type="text/javascript">
	$PARAMETROS.columnDefs = [
		{ orderable: false, targets: [0], width: '1%' }
		,{ targets: [3], visible: false }
	];
	
	$PARAMETROS.createdRow = function(row, data, dataIndex){
		var btnAdicional = '';
		if(data[4] == null){
			btnAdicional = `<a href='`+base_url()+'Administrativo/Utilidades/PerfilesAcceso/Permisos/'+data[1]+`/' class='btn btn-info'><span class='fas fa-user-shield' title='Accesos'></span></a>`;
		}
		var botones = `<center><div class='btn-group btn-group-xs'>
			<button type='button' class='editar btn btn-success'><span class='far fa-edit' title='Editar'></span></button>
			`+btnAdicional+`
			<button type='button' class='eliminar btn btn-danger'><span class='far fa-trash-alt' title='Eliminar'></span></button>
		</div></center>`;
		$(row).find('td:eq(0)').html(botones);

		$(row).on("click",'.editar',function(e){
			e.preventDefault();
			$CODIGO = data[1];
			cargar($CODIGO);
		});
		
		$(row).on("click",'.eliminar',function(e){
			console.log(data);
			e.preventDefault();
			var $CODIGO = data[1],
				$NRODOCUMENTO = data[5]
				$ID = $("[data-codigo]").attr('data-db');
			alertify.confirm('Eliminar', '¿Está seguro de eliminar el registro seleccionado?'
				, function(){
					$.ajax({
						url: base_url() + $DIRECTORY + $CONTROLADOR + "/eliminarCRUD/" + $TABLA,
						type: 'POST',
						data: {
							codigo: $CODIGO
							,ID: $ID
							,NRODOCUMENTO: $NRODOCUMENTO 
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