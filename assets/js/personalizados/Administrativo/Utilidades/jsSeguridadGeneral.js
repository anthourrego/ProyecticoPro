$('.cambiarClave').click(function(e){
	e.preventDefault();
	alertify.confirm()
	.setting({
		label:'Aceptar',
		message: "<form id='frmClave'><table style='margin-top: 10px; width: 100%;'>\
			<tr>\
				<td><p>Contraseña Actual: &nbsp;</p></td>\
				<td><p><input type='password' required data-password='actual' class='form-control input-sm'></p></td>\
			</tr>\
			<tr>\
				<td><p>Contraseña Nueva: &nbsp;</p></td>\
				<td><p><input type='password' required data-password='nueva' class='form-control input-sm'></p></td>\
			</tr>\
			<tr>\
				<td><p>Confirme Contraseña: &nbsp;</p></td>\
				<td><p><input type='password' required data-password='confirme' class='form-control input-sm'></p></td>\
			</tr>\
		</table></form>",
		onok: function(){
			$.ajax({
				url: base_url()+'Administrativo/Utilidades/CambioClave/CambiarClave',
				type:'POST',
				data:{
					actual 		: 	$('[data-password=actual]').val(),
					nueva 		: 	$('[data-password=nueva]').val(),
					confirme 	: 	$('[data-password=confirme]').val(),
					RASTREO 	: 	RASTREO('Cambio de Clave', 'Cambio de Clave')
				},
				success: function(res){
					switch(res){
						case '0':
							alertify.error('Ocurrió un problema al momento de cambiar la clave');
						break;
						case '1':
							alertify.error('Confirmación de clave incorrecta');
						break;
						case '2':
							alertify.error('La clave nueva no presenta cambio');
						break;
						case '3':
							alertify.error('Clave incorrecta');
						break;
						case '4':
							alertify.success('Su clave ha sido cambiada con éxito');
							alertify.alert('Advertencia', 'Su clave ha sido cambiada con éxito');
						break;
						default:
							alertify.alert('Error', res);
						break;
					}
				}
			});
		},
		title:'Cambio de Clave'
	}).set({
		onshow:function(){
			$('#frmClave').trigger('reset');
			setTimeout(function(){
				$('[data-password=actual]').focus();
			},1000);
		}
	}).show();
});