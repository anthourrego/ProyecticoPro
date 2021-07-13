var $ID = '';
lastFocus = '',
dataAjax = {
	cliente: ''
},
dataAjaxActividades = {
	cliente: ''
	,CentroProduccionId: null
}
$CREAR = 0,
$CP = null;

var dtActividadesOperarioAC = $('#tblActividadesOperarioAC').DataTable({
	language,
	dom: domftrip,
	processing: true,
	ajax: {
		url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/qActividadesOperarioAC",
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjaxActividades);
		}
	},
	columns: [
		{data: 'OperarioActividadId', visible: false},
		{data: 'ActividadProduccionId', width: '1%'},
		{data: 'nombre'}
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.OperarioActividadId);
			$('.selected2').removeClass('selected2');
			$(this).addClass('selected2');
		});
	}
	,drawCallback: function(){
		$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnEliminar').attr('disabled', true);
		$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnAgregar').attr('disabled', false);
	}
	,initComplete: function(){
		$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnEliminar').attr('disabled', true);
		$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnAgregar').attr('disabled', true);
	}
});

var dtActividadesOperarioCP = $('#tblActividadesOperarioCP').DataTable({
	language,
	dom: domftrip,
	processing: true,
	ajax: {
		url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/qActividadesOperarioCP",
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'OperarioActividadId', visible: false},
		{data: 'CentroProduccionId', width: '1%'},
		{data: 'nombre'}
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.OperarioActividadId);
			$('.selected').removeClass('selected');
			$(this).addClass('selected');
			$('#bActividades').html('Actividades para: '+data.nombre);
			dataAjaxActividades.CentroProduccionId = data.CentroProduccionId;
			dtActividadesOperarioAC.ajax.reload();
		});
	}
	,drawCallback: function(){
		$('#bActividades').html('Actividades de Servicio');
		dataAjaxActividades.CentroProduccionId = null;
		dtActividadesOperarioAC.ajax.reload();
		setTimeout(function(){
			$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnEliminar').attr('disabled', true);
			$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnAgregar').attr('disabled', true);
		},500);
	}
});

$('[readonly]').each(function(){
	$(this).attr('disabled', true);
});

$('input[data-db]:not([data-codigo]), input[data-crud], textarea[data-db]').attr('readonly', true);
$('select[data-db]:not([data-codigo]), select[data-crud], .btnEliminar, input[type=file]:not(#adj)').attr('disabled', true);

$("#frmRegistroClientes").on("change", "[data-codigo]", function(){
	$ID = $("[data-codigo]").val();
	var lastID = $ID;
	dataAjax.cliente = $ID;
	dataAjaxActividades.cliente = $ID;
	dtActividadesOperarioCP.ajax.reload();
	dtActividadesOperarioAC.ajax.reload();
	$("#frmRegistroClientes").trigger("reset");
	$('#h2Cliente').html('');
	$('.foto').css('background-image', 'none');
	$('input[data-db]:not([data-codigo]), input[data-crud], textarea[data-db]').attr('readonly', true);
	$('select[data-db]:not([data-codigo]), select[data-crud], .btnEliminar, input[type=file]:not(#adj), .btnAgregar, .btnEliminar, #btnEliminarCliente,[data-db]input[type=checkbox]:not(.noBloquear),[data-crud]input[type=checkbox]').attr('disabled', true);
	$('span[data-db]').text('').attr('title', '');
	if($ID != ''){
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/Cargar",
			type: 'POST',
			data: {
				codigo: $ID,
				RASTREO: RASTREO('Carga Asistente Servicio '+$ID, 'Asistentes Servicio')
			},
			success: function(respuesta){
				registro = JSON.parse(respuesta);
				if(registro == -1){
					alertify.confirm('Advertencia', '¿Desea cargar tercero como operario?', function(){
						$.ajax({
							url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/Registrar",
							type: 'POST',
							data: {
								codigo: $ID,
								RASTREO: RASTREO('Carga Tercero '+$ID+' como Asistente Servicio', 'Asistentes Servicio')
							},
							success: function(respuesta){
								if(respuesta > 0){
									$('[data-codigo]').val($ID).change();
									
								}
							}
						});
					},function(){
						$('#btnFastBackward').click();
					});
				}else{
					for(var key in registro[0]) {
						if(registro[0][key] != null){
							var value = registro[0][key];
							if(key == 'RespoFisca'){
								var RespoFisca = value;
								RespoFisca = RespoFisca.split(';');
							}else{
								$("[data-db="+key+"]").val(value);
								$("span[data-db="+key+"]").text(value).attr('title', value);
								if($("[data-db="+key+"]").is('input[type=checkbox]') && value == 1){
									$("[data-db="+key+"]").prop('checked', true);
								}else{
									$("[data-db="+key+"]").prop('checked', false);
									switch(key){
										case 'EsCliente':
											if(value == 0){
												$('[data-db=EsProveedor]').attr('disabled', true);
											}else{
												$('[data-db=EsProveedor]').attr('disabled', false);
											}
										break;
										case 'EsProveedor':
											if(value == 0){
												$('[data-db=EsCliente]').attr('disabled', true);
											}else{
												$('[data-db=EsCliente]').attr('disabled', false);
											}
										break;
									}
								}
							}
						}
					}
					if(registro[0]["foto"] !== "" && registro[0]["foto"] !== null){
						$('[data-imagen=foto]').closest('.foto').css('background-image', ("url(data:image/jpeg;base64," + registro[0]['foto'] +")"));
					}else{
						$('[data-imagen=foto]').closest('.foto').css('background-image', 'none');
					}
					$('#h2Cliente').html(registro[0]['nombre']);
					$('select[data-db]:not([data-codigo]), select[data-crud-codigo], [data-imagen=foto], input[type=checkbox]:not([disabled]), .btnAgregar, #btnEliminarCliente,[data-db]input[type=checkbox]:not(.noBloquear)').attr('disabled', false);
					$('input[data-db]:not([data-codigo]), input[data-crud-codigo], textarea[data-db]').attr('readonly', false);
					$('[data-deshabilitado=1]').each(function(){
						$(this).attr('disabled', true);
					});
					$CREAR = 0;
					//var event = new Event('editar');
				}
				lastFocus = $(':focus').val();
				//document.dispatchEvent(event);
			}
		});
	}else{
		if($('[data-codigo]').val() != ''){
			$('[data-codigo]').val($ID);
		}
	}
});

$("#frmRegistroClientes").on("focusin", "[data-db]", function(){
	lastFocus = $(this).val();
	if(lastFocus == null){
		lastFocus = '';
	}
});

$('#frmRegistroClientes').submit(function(e){
	e.preventDefault();
});

var busqueda = false;

$("#frmRegistroClientes").on("focusout", "[data-db]:not([data-codigo], input[type=checkbox])", function(){
	if($(this).attr('required') && $(this).val() == ''){
		$('#frmRegistroClientes').submit();
		$(this).val(lastFocus);
	}else{
		var value = $(this).val();
		if(value != lastFocus){
			var self 	= this;
			if($(self).attr('data-foranea')){
				if(value != ''){
					var antes = lastFocus;
					var nombre = $(self).attr('data-foranea-codigo');
					var tblNombre = 'nombre';
					$.ajax({
						url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/CargarForanea",
						type: 'POST',
						data: {
							tabla : $(self).attr('data-foranea'),
							value : value,
							nombre: nombre,
							cliente: $ID,
							tblNombre: tblNombre
						},
						success: function(respuesta){
							if(respuesta == 0){
								alertify.ajaxAlert = function(url){
									$.ajax({
										url: url,
										async: false,
										success: function(data){
											alertify.myAlert().set({
												onclose:function(){
													busqueda = false;
													alertify.myAlert().set({onshow:null});
													$(".ajs-modal").unbind();
													delete alertify.ajaxAlert;
													$("#tblBusqueda").unbind().remove();
												},onshow:function(){
													lastFocus = antes;
													busqueda = true;
												}
											});

											alertify.myAlert(data);

											var $tblID = '#tblBusqueda';
											var config = {
												data:{
													tblID : $tblID,
													select: [$(self).attr('data-foranea-codigo'), tblNombre],
													table : [$(self).attr('data-foranea')],
													column_order : [$(self).attr('data-foranea-codigo'), tblNombre],
													column_search : [$(self).attr('data-foranea-codigo'), tblNombre],
													orden : {},
													columnas : [$(self).attr('data-foranea-codigo'), tblNombre]
												},
												bAutoWidth: false,
												processing: true,
												serverSide: true,
												columnDefs: [
													{targets: [0], width: '1%'},
												],
												order: [],
												ordering: false,
												draw: 10,
												language: {
													lengthMenu: "Mostrar _MENU_ registros por página.",
													zeroRecords: "No se ha encontrado ningún registro.",
													info: "Mostrando _START_ a _END_ de _TOTAL_ entradas.",
													infoEmpty: "Registros no disponibles.",
													search   : "",
													searchPlaceholder: "Buscar",
													loadingRecords: "Cargando...",
													processing:     "Procesando...",
													paginate: {
														first:      "Primero",
														last:       "Último",
														next:       "Siguiente",
														previous:   "Anterior"
													},
													infoFiltered: "(_MAX_ Registros filtrados en total)"
												},
												pageLength: 10,
												initComplete: function(){
													setTimeout(function(){
														$('div.dataTables_filter input').focus();
														$('.alertify').animate({
															scrollTop: $('div.dataTables_filter input').offset().top
														}, 2000);
													},500);
													$('div.dataTables_filter input')
													.unbind()
													.change(function(e){
														e.preventDefault();
														table = $("body").find($tblID).dataTable();
														table.fnFilter( this.value );
													});
												},
												oSearch: { sSearch: value },
												createdRow: function(row,data,dataIndex){
													$(row).click(function(){
														$(self).val(antes).focusin().val(data[0]).focusout();
														alertify.myAlert().close();
													});
												},
												deferRender: true,
												scrollY: screen.height - 400,
												scroller: {
													loadingIndicator: true
												},
												dom: 'ftri'
											}
											dtSS(config);
										}
									});
								}
								alertify.ajaxAlert(base_url()+"Busqueda/DataTable");
							}else{
								lastFocus = antes;
								respuesta = JSON.parse(respuesta);

								$(self).closest('.input-group').find('span').text(respuesta[0][tblNombre]).attr('title', respuesta[0][tblNombre]);
								actualizar(self, lastFocus);
							}
						}
					});
				}else{
					$(self).closest('.input-group').find('span').text('').attr('title', '');
					actualizar(self, lastFocus);
				}
			}else{
				actualizar(self, lastFocus);
			}
		}
	}
});

function actualizar(self, lastFocus){
	var value = $(self).val().trim();
	if($(self).hasClass('data-decimal')){
		value = parseFloat(value.replace(/,/g, ''));
	}
	if(value == null){
		value = '';
	}
	if(value != lastFocus && busqueda != true){
		var nombre 	= $(self).attr('data-db'),
		value 		= value,
		tabla 		= $(self).attr('data-tabla') ? $(self).attr('data-tabla') : 'Tercero';
		stringModif = $CREAR == 1 ? 'Crear' : 'Modificar';
		last 		= lastFocus;
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/Actualizar",
			type: 'POST',
			async: false,
			data: {
				cliente: $ID,
				nombre: nombre,
				value: value,
				tabla: tabla,
				RASTREO: RASTREO('Modifica Asistente Servicio '+$ID+' Cambia '+$(self).attr('data-nombre')+' '+lastFocus+' -> '+value, 'Asistentes Servicio')
			},
			success: function(respuesta){
				switch(respuesta){
					case '1':
						switch(nombre){
							case 'nombruno':
							case 'nombrdos':
							case 'apelluno':
							case 'apelldos':
								if($('[data-db=tipodocuid]').val() != '31'){
									$("[data-db=nombre]").focusin().val($('[data-db=nombruno]').val() + ' ' + $('[data-db=nombrdos]').val() + ' ' + $('[data-db=apelluno]').val() + ' ' + $('[data-db=apelldos]').val()).focusout();
									$('#h2Cliente').text($('[data-db=nombruno]').val() + ' ' + $('[data-db=nombrdos]').val() + ' ' + $('[data-db=apelluno]').val() + ' ' + $('[data-db=apelldos]').val());
								}
							break;
						}
						lastFocus = $('[data-db]:not([data-codigo]):focus').val();
					break;
					default:
						console.log(respuesta);
						$(self).val(last);
						alertify.alert('Error', respuesta, function(){
							this.destroy();
						});
					break;
				}
			}
		});
	}
}

function leerImg(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var background = e.target.result;
			$(input).closest('form').off('submit').on('submit',function(e){
				e.preventDefault();
				if(typeof FormData !== 'undefined'){
					var rastreo = RASTREO('Modifica Asistente Servicio '+$ID+' Cambia Foto', 'Asistentes Servicio');
					var form_data = new FormData();
					form_data.append('file', $(input)[0].files[0]);
					form_data.append('imagen', $(input).attr('data-imagen'));
					form_data.append('cliente', $ID);
					form_data.append('cambio', rastreo.cambio);
					form_data.append('fecha', rastreo.fecha);
					form_data.append('programa', rastreo.programa);
					$.ajax({	
						url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/ActualizarImagen",
						type:"POST",
						async		: false,
						cache		: false,
						contentType : false,
						processData : false,
						data:form_data,	
						success:function(respuesta){
							if(respuesta != 1){
								console.log(respuesta);
								alertify.alert('Error', respuesta, function(){
									this.destroy();
								});
							}else{
								$(input).closest('div').css('background-image', ("url('"+background+"')"));
							}
						}
					});
				}
			});
			$(input).closest('form').submit();
		}
		reader.readAsDataURL(input.files[0]);
	}
}

$("input[type=file]").change(function(){
	if($ID != ''){
		leerImg(this);
	}else{
		alertify.error('No hay un Asistente de Servicio cargado');
	}
});

$(".btn-primary").click(function(e){
	e.preventDefault();
	var btn = $(this).attr('id'),
		TerceroID = $("[data-codigo]").val();
	$.ajax({
		url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/ListaClientes",
		type: 'POST',
		data: {
			btn: btn,
			TerceroID: TerceroID
		},
		success: function(respuesta){
			if(respuesta != ''){
				$("[data-codigo]").val(respuesta).focusin().change();
			}
		}
	});
});

$(document).ready(function(){
	$("[data-codigo]").focusin().change();
	getId();
});

$('#btnBusqueda').click(function(e){
	e.preventDefault();
	alertify.ajaxAlert = function(url){
		$.ajax({
			url: url,
			async: false,
			success: function(data){
				alertify.myAlert().set({
					onclose:function(){
						busqueda = false;
						alertify.myAlert().set({onshow:null});
						$(".ajs-modal").unbind();
						delete alertify.ajaxAlert;
						$("#tblBusqueda").unbind().remove();
					},onshow:function(){
						busqueda = true;
					}
				});

				alertify.myAlert(data);

				var $tblID = '#tblBusqueda';
				var config = {
					data:{
						tblID : $tblID,
						select: [
							"O.TerceroID"
							,"T.nombre"
						],
						table : [
							'Operario O'
							,[
								['Tercero T', 'O.TerceroId = T.TerceroId', 'LEFT']
							]
						],
						column_order : [
							"O.OperarioId"
						],
						column_search : [
							"O.TerceroID"
							,"T.nombre"
						],
						orden : {
							'OperarioId': 'asc'
						},
						columnas : [
							"TerceroID"
							,"nombre"
						]
					},
					bAutoWidth: false,
					processing: true,
					serverSide: true,
					columnDefs: [
						{targets: [0], width: '1%'},
					],
					order: [],
					ordering: false,
					draw: 10,
					language: language,
					pageLength: 10,
					initComplete: function(){
						setTimeout(function(){
							$('div.dataTables_filter input').focus();
							$('html, body').animate({
								scrollTop: $('div.dataTables_filter input').offset().top
							}, 2000);
						},500);
						$('div.dataTables_filter input')
						.unbind()
						.change(function(e){
							e.preventDefault();
							table = $("body").find($tblID).dataTable();
							table.fnFilter( this.value );
						});
					},
					oSearch: { sSearch: '' },
					createdRow: function(row,data,dataIndex){
						$(row).click(function(){
							$("[data-codigo]").val(data[0]).focusin().change();
							alertify.myAlert().close();
						});
					},
					deferRender: true,
					scrollY: screen.height - 400,
					scroller: {
						loadingIndicator: true
					},
					dom: 'ftri'
				}
				dtSS(config);
			}
		});
	}
	alertify.ajaxAlert(base_url()+"Busqueda/DataTable");
});

function cargarCRUD(self, codigo){
	$(self).closest('[data-crud-tabla]').find('input, select').val('');
	$(self).closest('[data-crud-tabla]').find('span[data-crud]').text('').attr('title', '');
	$(self).closest('[data-crud-tabla]').find('input[type=checkbox]').prop('checked', false);
	if(codigo === ''){
		$(self).closest('[data-crud-tabla]').find('input[data-crud]:not([data-crud-codigo])').attr('readonly', true);
		$(self).closest('[data-crud-tabla]').find('select[data-crud]:not([data-crud-codigo]), .btnEliminar, input[type=file],[data-crud]input[type=checkbox]').attr('disabled', true);
	}else{
		$(self).closest('[data-crud-tabla]').find('input[data-crud]:not([data-crud-codigo])').attr('readonly', false);
		$(self).closest('[data-crud-tabla]').find('select[data-crud]:not([data-crud-codigo]), .btnEliminar, input[type=file],[data-crud]input[type=checkbox]').attr('disabled', false);
		$(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(codigo);
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/cargarCRUD",
			type: 'POST',
			data: {
				tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
				codigo: codigo,
				cliente: $('[data-db="OperarioId"]').val().trim(),
				nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
				RASTREO: RASTREO(' de '+$('.nav-link.active[role=tab]').text().trim()+' Operario '+$ID, 'Asistentes Servicio')
			},
			success: function(res){
				try{
					var registro = JSON.parse(res);
				}catch(e){
					alertify.alert('Error', res, function(){
						this.destroy();
					});
					return false;
				}
				if(isNaN(registro)){
					if(registro.length > 0) {
						for(var key in registro[0]) {
							if(registro[0][key] != null){
								var value = registro[0][key];
								$(self).closest('[data-crud-tabla]').find("[data-crud="+key+"]").val(value);
								$(self).closest('[data-crud-tabla]').find("span[data-crud="+key+"]").text(value).attr('title', value);
								if($("[data-crud="+key+"]").is('input[type=checkbox]') && value == 1){
									$("[data-crud="+key+"]").prop('checked', true);
								}else{
									$("[data-crud="+key+"]").prop('checked', false);
								}
							}
						}
						//var event = new Event('editar');
					}else{
						$(self).closest('[data-crud-tabla]').find("[data-crud-codigo]").val(res);
						$(self).closest('[data-crud-tabla]').find('.btnEliminar').attr('disabled', true);
						//var event = new Event('crear');
					}
					lastFocus = $(':focus').val();
					$ID = $("[data-codigo]").val();
				}else{
					$(self).closest('[data-crud-tabla]').find("[data-crud-codigo]").val(res);
					var fn = Function($(self).closest('[data-crud-dt]').attr('data-crud-dt')+'.ajax.reload();');
					fn();
				}
			//document.dispatchEvent(event);
			}
		});
	}
}

$("[data-crud-tabla]").on("click", ".btnEliminar", function(e){
	e.preventDefault();
	var self = this;
	if($(this).closest('[data-crud-tabla]').find('[data-crud-codigo]').val() != '' && $ID != ''){
		alertify.confirm('Advertencia', '¿Está seguro de retirar el registro?', function(){
			$.ajax({
				url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/eliminarCRUD",
				type: 'POST',
				data: {
					tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
					codigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(),
					operario: $('[data-db="OperarioId"]').val().trim(),
					cliente: $ID,
					nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
					RASTREO: RASTREO('Elimina registro '+$(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val()+' de '+$('.nav-link.active[role=tab]').text().trim()+' Operario '+$ID, 'Asistentes Servicio')
				},
				success: function(res){
					switch(res){
						case '1':
							var fn = Function($(self).closest('[data-crud-dt]').attr('data-crud-dt')+'.ajax.reload();');
							fn();
							$(self).closest('[data-crud-tabla]').find('input, select').val('');
							$(self).closest('[data-crud-tabla]').find('input[data-crud]:not([data-crud-codigo])').attr('readonly', true);
							$(self).closest('[data-crud-tabla]').find('select[data-crud]:not([data-crud-codigo]), .btnEliminar').attr('disabled', true);
						break;
						default:
							console.log(res);
							alertify.alert('Error', res, function(){
								this.destroy();
							});
						break;
					}
				}
			});
		},function(){});
	}
});

$('#btnEliminarCliente').click(function(e){
	e.preventDefault();
	if(!$(this).is('[disabled]')){
		if($ID != ''){
			alertify.confirm('Advertencia','¿Está seguro de Borrar este registro?', function(){
				$.ajax({
					url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/EliminarCliente",
					type: 'POST',
					data: {
						cliente: $('[data-db="OperarioId"]').val().trim(),
						RASTREO: RASTREO('Elimina Asistente Servicio '+$ID, 'Asistentes Servicio')
					},
					success: function(res){
						switch(res){
							case '1':
								$ID = '';
								$("[data-codigo]").val('').change();
								alertify.alert('Advertencia', 'Asistente de Servicio eliminado satisfactoriamente', function(){
									this.destroy();
								});
							break;
							case '2':
								alertify.alert('Advertencia', 'El Tercero posee movimientos, no se puede eliminar', function(){
									this.destroy();
								});
							break;
							default:
								console.log(res);
								alertify.alert('Error', res, function(){
									this.destroy();
								});
							break;
						}
					}
				});
			},
			function(){});
		}else{
			alertify.error('No hay un Asistente de Servicio cargado');
		}
	}
});

function getId(){
	var url_string = window.location.href;
	var url = new URL(url_string);
	var id = url.searchParams.get("id");
	if (id != null) {
		$("[data-codigo]").val($.trim(id)).change();
	}
}

alertify.myAlert || alertify.dialog('myAlert',function factory(){
	return {
		main:function(content){
			this.setContent(content);
		},
		setup:function(){
			return {
				options:{
					maximizable:false,
					resizable:false,
					padding:false,
					title: 'Búsqueda'
				}
			};
		},
		hooks:{
			onclose:function(){
				setTimeout(function(){
					alertify.myAlert().destroy();
				},500);
			}
		}
	};
});

$(document).on('click', '.col-form-label-md', function(){
	var self = this;
	setTimeout(function(){
		$(self).next().find('input, select, textarea').focus(); 
	},0);
});

$('.data-decimal').each(function(){
	var digitos = $(this).attr('data-digitos');
	var enteros = $(this).attr('data-enteros');
	$(this).inputmask({
		groupSeparator:",",
		alias:"currency",
		placeholder:"0",
		autoGroup:3,
		digits: digitos,
		digitsOptional:!1,
		clearMaskOnLostFocus:!1,
		rightAlign: false,
		prefix:"",
		integerDigits: enteros
	}).focus(function(){
		$(this).select();
	});
});

$('.btnAgregar').click(function(e){
	e.preventDefault();
	if($(this).closest('[data-crud-dt="dtActividadesOperarioCP"]').length > 0){
		alertify.ajaxAlert = function(url){
			$.ajax({
				url: url,
				async: false,
				success: function(data){
					alertify.myAlert().set({
						onclose:function(){
							busqueda = false;
							alertify.myAlert().set({onshow:null});
							$(".ajs-modal").unbind();
							delete alertify.ajaxAlert;
							$("#tblBusqueda").unbind().remove();
							$('.ajs-content').html('');
						},onshow:function(){
							busqueda = true;
						}
					});

					alertify.myAlert(data);

					var $tblID = '#tblBusqueda';
					var config = {
						data:{
							tblID : $tblID,
							select: ['centroproduccionid', 'nombre'],
							table : ['CentroProduccion'
							,
							,[
								["estado <> 'I'"]
								,["centroproduccionid NOT IN (SELECT CentroProduccionId FROM OperarioActividad WHERE OperarioId = '"+$('[data-db="OperarioId"]').val().trim()+"' AND Tipo = 'CP')"]
							]],
							column_order : ['centroproduccionid', 'nombre'],
							column_search : ['centroproduccionid', 'nombre'],
							orden : {
								'nombre': 'asc'
							},
							columnas : ['centroproduccionid', 'nombre']
						},
						bAutoWidth: false,
						processing: true,
						serverSide: true,
						columnDefs: [
							{targets: [0], width: '1%'},
						],
						order: [],
						ordering: false,
						draw: 10,
						language: language,
						pageLength: 10,
						initComplete: function(){
							setTimeout(function(){
								$('div.dataTables_filter input').focus();
								$('html, body').animate({
									scrollTop: $('div.dataTables_filter input').offset().top
								}, 2000);
							},500);
							$('div.dataTables_filter input')
							.unbind()
							.change(function(e){
								e.preventDefault();
								table = $("body").find($tblID).dataTable();
								table.fnFilter( this.value );
							});
						},
						oSearch: { sSearch: '' },
						createdRow: function(row,data,dataIndex){
							$(row).click(function(){
								$.ajax({
									url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/GuardarCP",
									type: 'POST',
									async: false,
									data: {
										CP: data[0],
										operario: $('[data-db="OperarioId"]').val().trim(),
										cliente: $ID,
										RASTREO: RASTREO('Modifica Operario ID '+$('[data-db="OperarioId"]').val().trim()+' Código '+$ID+' Agrega Centro Producción '+data[0], 'Asistentes Servicio')
									},
									success: function(res){
										alertify.myAlert().close();
										switch(res){
											case '1':
												var fn = Function($('[data-crud-dt="dtActividadesOperarioCP"]').attr('data-crud-dt')+'.ajax.reload();');
												fn();
												$('[data-crud-dt="dtActividadesOperarioCP"]').find('.btnEliminar').attr('disabled', true);
											break;
											default:
												console.error(res);
												alertify.alert('Error', res, function(){
													this.destroy();
												});
											break;
										}
									}
								});
							});
						},
						deferRender: true,
						scrollY: screen.height - 400,
						scroller: {
							loadingIndicator: true
						},
						dom: 'ftri'
					}
					dtSS(config);
				}
			});
		}
		alertify.ajaxAlert(base_url()+"Busqueda/DataTable");
	}else if($(this).closest('[data-crud-dt="dtActividadesOperarioAC"]').length > 0){
		alertify.ajaxAlert = function(url){
			$.ajax({
				url: url,
				async: false,
				success: function(data){
					alertify.myAlert().set({
						onclose:function(){
							busqueda = false;
							alertify.myAlert().set({onshow:null});
							$(".ajs-modal").unbind();
							delete alertify.ajaxAlert;
							$("#tblBusqueda").unbind().remove();
							$('.ajs-content').html('');
						},onshow:function(){
							busqueda = true;
						}
					});

					alertify.myAlert(data);

					var $tblID = '#tblBusqueda';
					var config = {
						data:{
							tblID : $tblID,
							select: ['ActividadProduccionId', 'nombre'],
							table : ['ActividadProduccion'
							,
							,[
								["estado <> 'I'"]
								,["ActividadProduccionId NOT IN (SELECT ActividadProduccionId FROM OperarioActividad WHERE CentroProduccionId = '"+$('#tblActividadesOperarioCP').find('.selected').find('td:eq(0)').text().trim()+"' AND OperarioId = '"+$('[data-db="OperarioId"]').val().trim()+"' AND Tipo = 'AC')"]
							]],
							column_order : ['ActividadProduccionId', 'nombre'],
							column_search : ['ActividadProduccionId', 'nombre'],
							orden : {
								'nombre': 'asc'
							},
							columnas : ['ActividadProduccionId', 'nombre']
						},
						bAutoWidth: false,
						processing: true,
						serverSide: true,
						columnDefs: [
							{targets: [0], width: '1%'},
						],
						order: [],
						ordering: false,
						draw: 10,
						language: language,
						pageLength: 10,
						initComplete: function(){
							setTimeout(function(){
								$('div.dataTables_filter input').focus();
								$('html, body').animate({
									scrollTop: $('div.dataTables_filter input').offset().top
								}, 2000);
							},500);
							$('div.dataTables_filter input')
							.unbind()
							.change(function(e){
								e.preventDefault();
								table = $("body").find($tblID).dataTable();
								table.fnFilter( this.value );
							});
						},
						oSearch: { sSearch: '' },
						createdRow: function(row,data,dataIndex){
							$(row).click(function(){
								$.ajax({
									url: base_url() + "Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/GuardarAC",
									type: 'POST',
									async: false,
									data: {
										CP: $('#tblActividadesOperarioCP').find('.selected').find('td:eq(0)').text().trim(),
										AC: data[0],
										operario: $('[data-db="OperarioId"]').val().trim(),
										cliente: $ID,
										RASTREO: RASTREO('Modifica Operario ID '+$('[data-db="OperarioId"]').val().trim()+' Código '+$ID+' Agrega Actividad '+data[0], 'Asistentes Servicio')
									},
									success: function(res){
										alertify.myAlert().close();
										switch(res){
											case '1':
												var fn = Function($('[data-crud-dt="dtActividadesOperarioAC"]').attr('data-crud-dt')+'.ajax.reload();');
												fn();
												$('[data-crud-dt="dtActividadesOperarioAC"]').find('.btnEliminar').attr('disabled', true);
											break;
											default:
												console.error(res);
												alertify.alert('Error', res, function(){
													this.destroy();
												});
											break;
										}
									}
								});
							});
						},
						deferRender: true,
						scrollY: screen.height - 400,
						scroller: {
							loadingIndicator: true
						},
						dom: 'ftri'
					}
					dtSS(config);
				}
			});
		}
		alertify.ajaxAlert(base_url()+"Busqueda/DataTable");
	}else{
		cargarCRUD($(this).closest('[data-crud-tabla]').find('[data-crud-codigo]'), 0);
	}
});