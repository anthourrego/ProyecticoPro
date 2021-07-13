(function() {
	document.addEventListener('DOMContentLoaded', function (e) {
		$("#overlay").addClass('d-none');

		window.onscroll = function(){
			if(window.pageYOffset > 0){
				$(".navCabe").addClass("scrolled");
			}else{
				$(".navCabe").removeClass("scrolled");
			}
		}
		
		$(document).on({
			ajaxStart: function() {
				$("#overlay").removeClass('d-none');
			},
			ajaxStop: function() {
				$("#overlay").addClass('d-none');
			},
			ajaxError: function(funcion, request, settings){
				$("#overlay").removeClass('d-none');
				if(request.responseText != '' && request.responseText != undefined){
					if(request.responseText.includes('DELETE') && request.responseText.includes('REFERENCE') && request.responseText.includes('FK')){
						alertify.confirm('Error de Integridad', 'No se puede eliminar, el registro se encuentra referenciado en otras tablas.', function(){
							this.destroy();
							alertify.alert('Error de Integridad', request.responseText, function(){
								this.destroy();
							});
						}, function(){
							this.destroy();
						}).set('labels', {ok: 'Ver Detalle', cancel: 'OK'});
					}else if(request.responseText.includes('Login::$db')){
						location.reload();
					}else{
						alertify.confirm('Error', `Se ha producido un problema al ejecutar el proceso.
							<br/>
							<br/>
							Para obtener más información de este problema y posibles correcciones, pulse el botón "Ver Detalle" y comuniquese a la línea de servicio al cliente.`, function(){
							this.destroy();
							alertify.alert('Error', request.responseText, function(){
								this.destroy();
							});
						}, function(){
							this.destroy();
						}).set('labels', {ok: 'Ver Detalle', cancel: 'OK'})
					}
					console.error(funcion);
					console.error(request);
					console.error(settings);

				}
			}
		});

		window.onerror = function() {
			$("#overlay").addClass('d-none');
		};

		$(".cerrar").on("click",function(e){
			e.preventDefault();
			$.ajax({
				url: base_url()+"login/cierre",
				type: "POST",
				data: {
					RASTREO: RASTREO('Salida del Sistema Residente','Salida Sistema')
				},
				success: function(){
					location.reload();
				}
			});
		});

		$('#btnOcultarHUD').on('click',function(e){
			e.preventDefault();
			$.ajax({
				url: base_url()+"login/ocultarHUD",
				type: "POST",
				data: {},
				success: function(res){
					if(res == 1){
						$('nav.sidebar').removeClass('col-md-1').addClass('col-md-2');
						$('.contenido').removeClass('offset-md-1 col-md-11').addClass('offset-md-2 col-md-10');
					}else{
						$('nav.sidebar').removeClass('col-md-2').addClass('col-md-1');
						$('.contenido').removeClass('offset-md-2 col-md-10').addClass('offset-md-1 col-md-11');
					}
				}
			});
		});

		$(document)
		.on('keydown', "input:not(button, [type=search], .flexdatalist-alias, .chosen-search-input), select", function(evt){
			if (evt.keyCode == 13) {
				var fields = $(this).parents('form:eq(0),body').find('input,a,select,button,textarea,div[contenteditable=true]').filter(':visible:not([disabled], .ajs-close, .ajs-reset, .ajs-ok)');
				var index = fields.index(this);
				if (index > -1 && (index + 1) < fields.length) {
					if( ! fields.eq(index + 1).attr('disabled')){
						if(fields.eq(index).is('button')){
							fields.eq(index).click();
						}else{
							setTimeout(function(){
								fields.eq(index + 1).focus();
							},0);
						}
					}else{
						var self = this;
						setTimeout(function(){
							$(self).change().focusout();
						},0);
					}
				}else if( (index + 1) == fields.length){
					var self = this;
					setTimeout(function(){
						$(self).change().focusout();
					},0);
				}
				return false;
			}
		});

		Notification.requestPermission();
		getNotificaciones();
		setInterval(function() {
			if( ! $.active){
				getNotificaciones();
			}
		}, 1000 * 30);

		$(document).on('click', function(){
			if($(this).closest('[id=liNotificaciones]').length == 0
				&& $(this).closest('#divDropdownAlerta').length == 0){
				if( ! $("#divDropdownAlerta").hasClass('d-none')) {
					$("#divDropdownAlerta").addClass('d-none');
					$("#liNotificaciones").removeClass('active');
					$('#listadoNotificaciones').html('').addClass('d-none');
					$('#NANoti').removeClass('d-none');
				}
			}
		});

		$("[id=liNotificaciones]").click(function(e) {
			e.preventDefault();
			if(!$('#divDropdownAlerta').is(':visible')){
				$('#divDropdownAlerta').removeClass('d-none');
				$('[id=listaAlerta]').html('').addClass('d-none');
				$('.NANoti').removeClass('d-none');
				getNotificaciones();
				$(this).addClass('active');
				$.ajax({
					url: base_url() + "Administrativo/Utilidades/Notificaciones/listaNotificaciones",
					cache: false,
					beforeSend: function(){
						$('.loaderNotificaciones').removeClass('d-none');
					},
					complete: function(){
						$('.loaderNotificaciones').addClass('d-none');
					},
					success: function(notificaciones) {
						console.log(TipoV());
						notificaciones = JSON.parse(notificaciones);
						if(notificaciones.length > 0) {
							$('[id=listaAlerta]').removeClass('d-none');
							$('.NANoti').addClass('d-none');
							$.each(notificaciones, function() {
								switch (TipoV()) {
									case 'A':
										var notificacion = `<a class="list-group list-group-item-action" href="${tipoUrl(this['Tipo'], this['Numero'])}" style="text-decoration: none !important;">
											<div class="panel panel-default panel-noti accionAlerta mb-0 p-0 w-100">
												<div class="panel-body panel-notificacion noti${this['Tipo']} pb-1 pl-2 pr-2 w-100">
													<strong>${tipoAlerta(this['Tipo'])}</strong>
													<small class="horaNotificacion">${this['Programada']}</small><br>
													<p class="ellipsis">${this['Descripcion']}</p>
												</div>
											</div>
										</a>`;
										break;
									case 'PR':
										var notificacion = `<a class="list-group list-group-item-action" href="${tipoUrl(this['Tipo'], this['Numero'])}" style="text-decoration: none !important;">
											<div class="panel panel-default panel-noti accionAlerta mb-0 p-0 w-100">
												<div class="d-flex panel-body panel-notificacion noti${this['Tipo']} pb-1 pl-2 pr-2 w-100">
													<img src="${tipoImagen(this['Tipo'])}" alt="User Avatar" class="img-size-64 img-circle mr-3">
													<div class="w-100">
														<strong>${tipoAlerta(this['Tipo'])}</strong>
														<small class="horaNotificacion">${this['Programada']}</small><br>
														<p class="ellipsis">${this['Descripcion']}</p>
													</div>
												</div>
											</div>
										</a>`;
										break;
								}
								
								$('[id=listaAlerta]').append(notificacion);
							});
						} else {
							$('[id=listaAlerta]').addClass('d-none');
							$('.NANoti').removeClass('d-none');
						}
					}
				});
			}else{
				$('#divDropdownAlerta').addClass('d-none');
			}
		});

		/* $(document).find('#divDropdownAlerta').on('click', '.accionAlerta', function(e){
			e.preventDefault();
			location.href = tipoUrl($(this).data("tipo"), $(this).data("numero"));
			/* id = $(this).attr('data-id');
			descripcion = $(this).attr('data-descripcion');
			fecha = $(this).attr('data-fecha');
			$.ajax({
				url: base_url() + "Administrativo/Utilidades/Notificaciones/actualizarAlerta",
				type: 'post',
				data: {
					id : id
				}, success: function(resp){
					getNotificaciones();
					$("[id=liNotificaciones]").click();
				}, error: function(error){
					console.log(error);
				}
			});
			if($(this).attr('data-tipo') == 'DE'){
			}else if($(this).attr('data-tipo') == 'MA'){
				id = $(this).attr('data-id');
				descripcion = $(this).attr('data-descripcion');
				fecha = $(this).attr('data-fecha');
				alertify.confirm('Memos', 'Alerta de Memo: ' + descripcion + ' <br>Fecha: ' + fecha, function(){
					$.ajax({
						url: base_url() + "Administrativo/Utilidades/Notificaciones/actualizarAlerta",
						type: 'post',
						data: {
							id : id
						}, success: function(resp){
							getNotificaciones();
							$("[id=liNotificaciones]").click();
						}, error: function(error){
							console.log(error);
						}
					});
				}, function(){});
			}else{
				location.href = $(this).closest('a').attr('href');
			} 
		}); */

		function getNotificaciones() {
			$.ajax({
				url 	: base_url() + "Administrativo/Utilidades/Notificaciones/getNotificaciones",
				global	: false,
				success: function(notificaciones) {
					if(notificaciones != ''){
						notificaciones = JSON.parse(notificaciones);
						var total = notificaciones['Total'];
						if(notificaciones['Total'] > 0) {
							$("[id=totalAlertas]").html(notificaciones['Total']);
						} else {
							$("[id=totalAlertas]").html('');
						}
						if(total > 0){ 
							document.title = '(' + total +') Residente - Prosof';
						}else{
							document.title = 'Residente - Prosof';
						}
						if(notificaciones['Nuevas'].length > 0) {
							for (var i = 0; i < notificaciones['Nuevas'].length; i++) {
								notifyMe(notificaciones['Nuevas'][i]);
							}
						}
					}
				}
			});
		}

		function spawnNotification(theBody,theTitle) {
			var options = {
				body: theBody,
				icon: base_url() + 'uploads/'+NIT()+'/InformacionEmpresa/logo_cliente.png'
			}
			var n = new Notification(theTitle,options);
		}

		function notifyMe(alerta) {
			var titulo = tipoAlerta(alerta['Tipo']);
			if(alerta['Numero'] != ''){
				if(alerta['Tipo'] == 'DE'){
					titulo += ' - '+ alerta['Descripcion'].split('-')[1].trim();
				}else if(alerta['Tipo'] == 'MA'){
					titulo += ' alertas';
				}else{
					titulo += ' - '+ alerta['Numero'];
				}
			}
			// Let's check if the browser supports notifications
			if (!("Notification" in window)) {
				alertify.error("Este navegador no soporta las notificaciones de escritorio.");
			}

			// Let's check whether notification permissions have already been granted
			else if (Notification.permission === "granted") {
				// If it's okay let's create a notification
				spawnNotification(alerta['Descripcion'], titulo);
			}

			// Otherwise, we need to ask the user for permission
			else if (Notification.permission !== 'denied') {
				Notification.requestPermission(function (permission) {
					// If the user accepts, let's create a notification
					if (permission === "granted") {
						spawnNotification(alerta['Descripcion'], titulo);
					}
				});
			}
		  // At last, if the user has denied notifications, and you 
		  // want to be respectful there is no need to bother them any more.
		}

		$(document).on('click', '.notiAS', function(e){
			e.preventDefault();
			notiAS($(this).attr("data-id"), $(this).attr("data-descripcion"));
		});

		$(".toUpperTrim").keyup(function(){
			$(this).val($(this).val().toUpperCase().trim());
		});

		function notiAS(id, descripcion){
			alertify.alert('Alerta del Sistema', descripcion, function(){
				$.ajax({
					url: base_url() + "Administrativo/Utilidades/Notificaciones/actualizarAlerta",
					type: 'post',
					data: {
						id: id 
					}, success: function(resp){
						
					}, error: function(error){
						console.log(error);
					}
				});
			});
		}

		function tipoAlerta(tipo) {
			switch(tipo) {
				case 'PQ':
					return "PQR's";
					break;
				case 'QR':
					return "PQR's";
					break
				case 'AC':
					return "Actas";
					break;
				case 'IN':
					return "Incidencias";
					break;
				default:
					return'General';
					break;
			}
		}

		function tipoUrl(tipo, numero) {
			switch(tipo) {
				case 'PQ':
					if (TipoV() == 'A') {
						return base_url() + "Administrativo/PQR/TramitarPQR/ConsultarPQR/" + numero;
					} else {
						return base_url() + "Propietario/PQR/cPQR/index/" + numero;
					}
					break;
				case 'QR':
					if (TipoV() == 'A') {
						return base_url() + "Administrativo/PQR/TramitarPQR/ConsultarPQR/" + numero;
					} else {
						return base_url() + "Propietario/PQR/cPQR/index/" + numero;
					}
					break;
				case 'AC':
					return base_url() + "Administrativo/Actas/Acta/Ver/" + numero;
				case 'IN':
					if (TipoV() == 'A') {
						return base_url() + "Administrativo/Incidencia/cTramitarIncidencia/ConsultarIncidencia/" + numero;
					} else {
						return base_url() + "Propietario/Incidencia/cIncidencia/index/" + numero;
					}
					break;
				default:
					return '#';
					break;

			}
		}

		function tipoImagen(tipo) {
			switch(tipo) {
				case 'PQ':
					return base_url() + "assets/img/iconos/Memos.png";
					break;
				case 'QR':
					return base_url() + "assets/img/iconos/Memos.png";
					break;
				case 'IN':
					return base_url() + "assets/img/iconos/tipoServicio.png";
					break;
				case 'AC':
					return base_url() + "assets/img/iconos/AuditoriaGeneral.png";
					break;
				default:
					return '#';
					break;

			}
		}
	});
})();
var msgAlerta = {
	successSimple 	: '<div class="alert alert-success" role="alert" style="font-size: 15px;"><strong>Confirmación : </strong>Datos guardados exitosamente.</div>',
	succesElimina 	: '<div class="alert alert-success" role="alert" style="font-size: 15px;"><strong>Confirmación : </strong>Datos eliminados exitosamente.</div>',
	errorAdmin 		: '<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error : </strong>Comuniquese con el administrador del sistema.</div>',
	camposObliga 	: 'Debe de diligenciar todos los campos obligatorios (*)'
}