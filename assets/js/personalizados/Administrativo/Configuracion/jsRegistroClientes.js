var $ID = '';
lastFocus = '',
dataAjax = {
	cliente: ''
},
$CREAR = 0,
CRM = {
	CRMDatoid: null,
	CRMTablaid: null,
	dato: '',
	tipo: '',
	nombre: '',
	value: ''
};

var dtResidencia = $('#tblResidencia').DataTable({
	language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroClientes/qResidencia',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Acciones', width: '8%'},
		{data: 'ViviendaTerceroId',visible:false},
		{data: 'nomTV'},
		{data: 'Nomenclatura'},
		{data: 'Propietario'},
		{data: 'Residente'},
		{data: 'Titular'},
		{data: 'ListaGeneral'},
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="eliminar btn btn-danger btn-xs" value="`+data[1]+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>
		`);
		$(row).on("click", '.eliminar', function(e){
			e.preventDefault();
			alertify.confirm('Eliminar vivienda', 'Está seguro de eliminar la vivienda asociada al tercero ?', function(){
				$.ajax({
					url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/eliminarResidencia",
					type: 'POST',
					async: false,
					data: {
						Id 		: data.ViviendaTerceroId,
						RASTREO : RASTREO("Elimina vivienda asociada [Tercero : "+$ID+"] [Vivienda : "+data[3]+"]","Terceros")
					},
					success: function(respuesta){
						if (respuesta == 1) {
							alertify.success("Datos eliminados correctamente.");
							dtResidencia.ajax.reload();
						}else{
							alertify.error("¡Error! los datos no han sido guardados correctamente, comuniquese con el administrador del sistema.");
							return;
						}
					}
				});
			}, function() { dtResidencia.ajax.reload() }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
		})
	}
});

var dtInformacionAdicionalCRM = $('#tblInformacionAdicionalCRM').DataTable({
	language: language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroClientes/qInformacionAdicionalCRM',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Campo'},
		{data: 'Descripcion'},
		{data: 'id', visible: false},
		{data: 'CRMTablaid', visible: false},
		{data: 'CRMDatoid', visible: false},
		{data: 'CRMTablaid', visible: false},
		{data: 'tipo', visible: false}
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.id);
			$('.selected').removeClass('selected');
			$(this).addClass('selected');
		});
	}
});

var dtAdjuntos = $('#tblAdjuntos').DataTable({
	language: language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroClientes/qAdjuntos',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'AdjuntoId', visible: false},
		{data: 'TerceroId', visible: false},
		{data: 'Adjunto', visible: false},
		{data: 'Descripcion'},
		{defaultContent:'', sClass:'tdAdj', width: '2%', orderable: false},
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			$('.selected').removeClass('selected');
			$(this).addClass('selected');
			$(this).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(data.AdjuntoId);
			$(this).closest('[data-crud-tabla]').find('.btnEliminar').prop('disabled', false);
		});
		var ruta = data.Adjunto.split('/');
		var tipoDoc = ruta[3].split('.');
		var nombre = tipoDoc[0];
		var enlace = "";
		var rutaDoc = base_url()+'uploads/'+data.Adjunto;

		if (tipoDoc[1] == "doc" || tipoDoc[1] == "docx") {
			enlace ='<center><a href="'+rutaDoc+'" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-file-word"></i></a></center>';
		}else if(tipoDoc[1] == "xls" || tipoDoc[1] == "xlsx"){
			enlace ='<center><a href="'+rutaDoc+'" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-file-excel"></i></a></center>';
		}else if(tipoDoc[1] == "pdf"){
			enlace ='<center><a href="'+rutaDoc+'" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf"></i></a></center>';
		}else if(tipoDoc[1] == "txt"){
			enlace ='<center><a href="'+rutaDoc+'" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-file"></i></a></center>';
		}else{
			enlace ='<center><a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a></center>';
		}

		$(row).find('.tdAdj').html(enlace);
	}
});

var dtContactos = $('#tblContactos').DataTable({
	language: language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroClientes/qContactos',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'contactoid'},
		{data: 'nombre'},
		{data: 'cargo'},
		{data: 'dependencia', visible: false},
		{data: 'fechanacim', visible: false},
		{data: 'email', visible: false},
		{data: 'telefono', visible: false},
		{data: 'celular', visible: false},
		{data: 'GestionCartera', visible: false}
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.contactoid);
		});
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
	//dtSucursales.ajax.reload();
	dtInformacionAdicionalCRM.ajax.reload();
	dtContactos.ajax.reload();
	dtAdjuntos.ajax.reload();
	dtResidencia.ajax.reload();
	$("#frmRegistroClientes").trigger("reset");
	$('[data-db=RespoFisca]').val('').trigger('chosen:updated');
	$('#adj').next('.custom-file-label').html('Seleccione un archivo...');
	$('#h2Cliente').html('');
	$('.foto').css('background-image', 'none');
	$('input[data-db]:not([data-codigo]), input[data-crud], textarea[data-db]').attr('readonly', true);
	$('select[data-db]:not([data-codigo]), select[data-crud], .btnEliminar, input[type=file]:not(#adj), .btnAgregar, .btnEliminar, #btnEliminarCliente,[data-db]input[type=checkbox]:not(.noBloquear),[data-crud]input[type=checkbox]').attr('disabled', true);
	$('span[data-db]').text('').attr('title', '');
	if($ID != ''){
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/Cargar",
			type: 'POST',
			data: {
				codigo: $ID,
				RASTREO: RASTREO('Carga Cliente '+$ID, 'Terceros')
			},
			success: function(respuesta){
				registro = JSON.parse(respuesta);
				if(registro.length > 0) {
					if(registro[0]['EsProveedor'] == 1 && registro[0]['EsCliente'] == 0){
						alertify.alert('Advertencia', 'El tercero existe pero no está asociado como Cliente: (Es Proveedor)');
					}else{
						for(var key in registro[0]) {
							if(registro[0][key] != null){
								var value = registro[0][key];
								if(key == 'RespoFisca'){
									var RespoFisca = value;
									RespoFisca = RespoFisca.split(';');
									$("[data-db="+key+"]").val(RespoFisca).attr('data-anterior', RespoFisca).prop('disabled', false).trigger('chosen:updated');
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
				}else{
					alertify.confirm('Consultar o Crear', ''
					, function(){
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
												"TerceroID"
												,"nombre"
											],
											table : [
												'Tercero'
												,
												,[
													['EsCliente', 1]
												]
											],
											column_order : [
												"TerceroID"
												,"nombre"
											],
											column_search : [
												"TerceroID"
												,"nombre"
											],
											orden : {
												'nombre': 'asc'
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
										oSearch: { sSearch: $ID },
										createdRow: function(row,data,dataIndex){
											$(row).click(function(){
												$("[data-codigo]").val(data[0]).focusin().change();
												$(self).val(data[0]).change();
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

						this.destroy();
					}
					, function(){
						$.ajax({
							url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/Registrar",
							type: 'POST',
							data: {
								codigo: $ID,
								RASTREO: RASTREO('Registra Cliente '+$ID, 'Terceros')
							},
							success: function(respuesta){
								if(respuesta != '1'){
									alertify.alert('Error', respuesta, function(){
										//console.log(respuesta);
										this.destroy();
									});
								}else{
									$ID = lastID;
								}
								$("[data-codigo]").val($ID).change();
							}
						});
						this.destroy();
					}).set(
						'labels',
						{cancel: 'Crear'}
					).set(
						'labels',
						{ok: 'Búsqueda'}
					).set('closable', false);
					$CREAR = 1;
					//var event = new Event('crear');
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

$("#frmRegistroClientes").on("focusin, click", "[data-db], [data-crud]", function(){
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
		var tabla = $(this).attr('data-foranea');
		if(value != lastFocus){
			var self 	= this;
			if($(self).attr('data-foranea')){
				if(value != ''){
					var antes = lastFocus;
					var nombre = $(self).attr('data-foranea-codigo');
					switch($(self).attr('data-foranea')){
						case 'TariRete':
							var tblNombre = 'tarireteid';
							if(typeof $(this).attr('data-tarireteid') !== 'undefined' && $(this).attr('data-tarireteid') != ''){
								value = $(this).attr('data-tarireteid');
								nombre = 'tarireteid';
							}
						break;
						default:
							var tblNombre = 'nombre';
						break;
					}
					$.ajax({
						url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/CargarForanea",
						type: 'POST',
						data: {
							tabla : tabla,
							value : value,
							nombre: nombre,
							cliente: $ID,
							tblNombre: tblNombre
						},
						success: function(respuesta){
							if(respuesta == 0){
								switch($(self).attr('data-foranea')){
									case 'TariRete':
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
															select: [
																'tarireteid'
																,'descripcion'
																,'tarifa'
																,'base'
															],
															table : [$(self).attr('data-foranea')],
															column_order : [
																'tarireteid'
																,'descripcion'
																,'tarifa'
																,'base'
															],
															column_search : [$(self).attr('data-foranea-codigo'), tblNombre, 'descripcion'],
															orden : {},
															columnas : [
																'tarireteid'
																,'descripcion'
																,'tarifa'
																,'base'
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
																$(self).val(antes).focusin().val(data[2]).attr('data-tarireteid', data[0]).focusout();
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
										var campos = encodeURIComponent(JSON.stringify(['ID', 'Descripción', 'Tarifa', 'Base']));
										alertify.ajaxAlert(base_url()+"Busqueda/DataTable?campos="+campos);
									break;
									default:
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
									break;
								}
							}else{
								lastFocus = antes;
								respuesta = JSON.parse(respuesta);

								switch($(self).attr('data-foranea')){
									case 'TariRete':
										$(self).attr('data-tarireteid', '');
										$(self).closest('.input-group').find('.input-group-addon').focusin().val(respuesta[0][tblNombre]);
										actualizar($(self).closest('.input-group').find('.input-group-addon'), lastFocus);
									break;
									default:
										$(self).closest('.input-group').find('span').text(respuesta[0][tblNombre]).attr('title', respuesta[0][tblNombre]);
										actualizar(self, lastFocus);
									break;
								}
								switch($(self).attr('data-db')){
									case 'ciudadid':
										$('[data-db="dptoid"]').focusin().val(respuesta[0]['dptoid']).focusout();
									break;
									case 'ciudacorre':
										$('[data-db="dptocorre"]').focusin().val(respuesta[0]['dptoid']).focusout();
									break;
								}
							}
						}
					});
				}else{
					switch($(self).attr('data-foranea')){
						case 'TariRete':
							$(self).closest('.input-group').find('.input-group-addon').focusin().val('');
							actualizar($(self).closest('.input-group').find('.input-group-addon'), lastFocus);
						break;
						default:
							$(self).closest('.input-group').find('span').text('').attr('title', '');
							actualizar(self, lastFocus);
						break;
					}
				}
			}else{
				actualizar(self, lastFocus);
			}
		}
	}
});

$(document).on("change", "[data-db]:not([data-codigo])input[type=checkbox]", function(){
	if($(this).is(':checked')){
		var value = '1',
			lastFocus = '0';
	}else{
		var value = '0',
			lastFocus = '1';
	}
	$(this).val(value);
	$(this).focusout();
	actualizar(this, lastFocus);
});

function actualizar(self, lastFocus){
	if($(self).attr('data-db') == 'RespoFisca'){
		var value = $(self).val();
		value = value.join(';');
	}else{
		var value = $(self).val();
	}
	if(value == null){
		value = '';
	}
	if(value != lastFocus && busqueda != true){
		var nombre 	= $(self).attr('data-db'),
		value 		= value,
		tabla 		= $(self).attr('data-tabla') ? $(self).attr('data-tabla') : 'Tercero';
		permiso 	= $(self).attr('data-permiso') ? $(self).attr('data-permiso') : '0';
		stringModif = $CREAR == 1 ? 'Crear' : 'Modificar';
		last 		= lastFocus;
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/Actualizar",
			type: 'POST',
			async: false,
			data: {
				cliente: $ID,
				nombre: nombre,
				value: value,
				tabla: tabla,
				permiso: permiso,
				RASTREO: RASTREO('Modifica Cliente '+$ID+' Cambia '+$(self).attr('data-nombre')+' '+lastFocus+' -> '+value, 'Terceros')
			},
			success: function(respuesta){
				switch(respuesta){
					case '1':
						switch(nombre){
							case 'tipodocuid':
								if(value == '31'){
									$("[data-db=digitverif]").focusin().val(calcularDigitoVerificacion($ID)).focusout();
									$("[data-db=nombre]").focusin().val($('[data-db=razonsocia]').val()).focusout();
									$('#h2Cliente').text($('[data-db=razonsocia]').val());
								}else{
									$("[data-db=digitverif]").focusin().val('').focusout();
									$("[data-db=nombre]").focusin().val($('[data-db=nombruno]').val() + ' ' + $('[data-db=nombrdos]').val() + ' ' + $('[data-db=apelluno]').val() + ' ' + $('[data-db=apelldos]').val()).focusout();
									$('#h2Cliente').text($('[data-db=nombruno]').val() + ' ' + $('[data-db=nombrdos]').val() + ' ' + $('[data-db=apelluno]').val() + ' ' + $('[data-db=apelldos]').val());
								}
							break;
							case 'nombruno':
							case 'nombrdos':
							case 'apelluno':
							case 'apelldos':
								if($('[data-db=tipodocuid]').val() != '31'){
									$("[data-db=nombre]").focusin().val($('[data-db=nombruno]').val() + ' ' + $('[data-db=nombrdos]').val() + ' ' + $('[data-db=apelluno]').val() + ' ' + $('[data-db=apelldos]').val()).focusout();
									$('#h2Cliente').text($('[data-db=nombruno]').val() + ' ' + $('[data-db=nombrdos]').val() + ' ' + $('[data-db=apelluno]').val() + ' ' + $('[data-db=apelldos]').val());
								}
							break;
							case 'razonsocia':
								if($('[data-db=tipodocuid]').val() == '31'){
									$("[data-db=nombre]").focusin().val($('[data-db=razonsocia]').val()).focusout();
									$('#h2Cliente').text($('[data-db=razonsocia]').val());
								}
							break;
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
						lastFocus = $('[data-db]:not([data-codigo]):focus').val();
					break;
					case '2':
						$(self).val(last);
						alertify.alert('Advertencia', 'No posee los permisos para ' + stringModif + ' el ' + $(self).attr('data-nombre'), function(){
							this.destroy();
						});
					break;
					default:
						//console.log(respuesta);
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
					var rastreo = RASTREO('Modifica Cliente '+$ID+' Cambia Foto', 'Terceros');
					var form_data = new FormData();
					form_data.append('file', $(input)[0].files[0]);
					form_data.append('imagen', $(input).attr('data-imagen'));
					form_data.append('cliente', $ID);
					form_data.append('cambio', rastreo.cambio);
					form_data.append('fecha', rastreo.fecha);
					form_data.append('programa', rastreo.programa);
					$.ajax({	
						url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/ActualizarImagen",
						type:"POST",
						async		: false,
						cache		: false,
						contentType : false,
						processData : false,
						data:form_data,	
						success:function(respuesta){
							if(respuesta != 1){
								//console.log(respuesta);
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

$("input[type=file]:not(#adj)").change(function(){
	if($ID != ''){
		leerImg(this);
	}else{
		alertify.error('No hay un Cliente cargado');
	}
});

$(".btn-primary").click(function(e){
	e.preventDefault();
	var btn = $(this).attr('id'),
		TerceroID = $("[data-codigo]").val();
	$.ajax({
		url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/ListaClientes",
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
	if($('[data-codigo]').val() != ''){
		$('[data-permiso]').each(function(){
			//console.log($(this).attr('data-permiso'));
			switch ($(this).attr('data-permiso')) {
				case '0':
				break;
				case '60':
				case '55':
				case '71':
				case '95':
					if ( ($(this).is(':button')) && ($(this).hasClass('btnAgregar')) && ( ! $TERCCrear.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}else if ( ($(this).is(':button')) && ($(this).hasClass('btnEliminar')) && ( ! $TERCElimi.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}
				break;
				case '55':
					if ( ($(this).is(':button')) && ($(this).hasClass('btnAgregar')) && ( ! $TERCCrear.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}else if ( ($(this).is(':button')) && ($(this).hasClass('btnEliminar')) && ( ! $TERCModif.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}
				break;
				case '86':
					$(this).attr('disabled', false).attr('data-deshabilitado', '0').attr('readonly', false);
				break;
				default:
				if ( (! $(this).is(':button')) && ( ! $TERCModif.includes(parseInt($(this).attr('data-permiso')))) ){
					$(this).attr('disabled', true).attr('data-deshabilitado', '1');
				}
				break;
			}
		});
	}else{
		$('[data-permiso]').each(function(){
			if (typeof($TERCcrear) != 'undefined') {
				switch ($(this).attr('data-permiso')) {
					default:
					if( ! $TERCcrear.includes(parseInt($(this).attr('data-permiso')))){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}
					break;
				}
			}
		});
	}
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
							"TerceroID"
							,"nombre"
						],
						table : [
							'Tercero'
							,
							,[
								['EsCliente', 1]
							]
						],
						column_order : [
							"TerceroID"
							,"nombre"
						],
						column_search : [
							"TerceroID"
							,"nombre"
						],
						orden : {
							'nombre': 'asc'
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

// 30/10/2018 JCSM - Cargar en cruds generalizados
$("[data-crud-tabla]").on("change", "[data-crud-codigo]", function(){
	cargarCRUD(this, $(this).val());
});

function cargarCRUD(self, codigo){
	permiso 	= $(self).closest('[data-crud-tabla]').attr('data-permiso') ? $(self).closest('[data-crud-tabla]').attr('data-permiso') : '0';
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
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/cargarCRUD",
			type: 'POST',
			data: {
				tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
				codigo: codigo,
				cliente: $ID,
				nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
				permiso: permiso,
				RASTREO: RASTREO(' de '+$('.nav-link.active[role=tab]').text().trim()+' Cliente '+$ID, 'Terceros')
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
					if(res == -1){
						alertify.alert('Advertencia', 'No posee los permisos para Crear el registro en ' + $('.nav-link.active[role=tab]').text().trim(), function(){
							this.destroy();
						});
					}else{
						$(self).closest('[data-crud-tabla]').find("[data-crud-codigo]").val(res);
						var fn = Function($(self).closest('[data-crud-dt]').attr('data-crud-dt')+'.ajax.reload();');
						fn();
					}
				}
			//document.dispatchEvent(event);
			}
		});
	}
}

$("[data-crud-tabla]").on("focusout", "[data-crud]:not([data-crud-codigo], input[type=checkbox])", function(){
	var self = this,
		value = $(this).val();
		retornar = false;
	if($(this).closest('[data-crud-tabla]').find('[data-crud-codigo]').val() != '' && $ID != ''){
		$(self).closest('[data-crud-tabla]').find('[required]').each(function(){
			if($(this).val() == ""){
				retornar = true;
			}
		});
		if($(this).val() != lastFocus && retornar != true){
			if($(self).attr('data-foranea')){
				if(value != ''){
					var antes = lastFocus;
					var tblNombre = 'nombre';
					$.ajax({
						url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/CargarForanea",
						type: 'POST',
						data: {
							tabla : $(self).attr('data-foranea'),
							value : value,
							nombre: $(self).attr('data-foranea-codigo'),
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
													orden : [],
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
								actualizarCRUD(self);
								
							}
						}
					});
				}else{
					$(self).closest('.input-group').find('span').text('').attr('title', '');
					actualizarCRUD(self);
				}
			}else{
				actualizarCRUD(self);
			}
		}
	}
});

$("[data-crud-tabla]").on("change", "[data-crud]:not([data-crud-codigo])input[type=checkbox]", function(){
	if($(this).is(':checked')){
		var value = '1',
			lastFocus = '0';
	}else{
		var value = '0',
			lastFocus = '1';
	}
	$(this).val(value);
	$(this).focusout();
	actualizarCRUD(this);
});

function actualizarCRUD(self){
	var permiso 	= $(self).attr('data-permiso') ? $(self).attr('data-permiso') : '0';
	$.ajax({
		url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/guardarCRUD",
		type: 'POST',
		data: {
			tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
			nombre: $(self).attr('data-crud'),
			value: $(self).val(),
			codigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(),
			cliente: $ID,
			nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
			permiso: permiso,
			RASTREO: RASTREO(' registro '+$(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val()+' de '+$('.nav-link.active[role=tab]').text().trim()+' Cliente '+$ID+' '+$(self).attr('data-nombre')+' '+lastFocus+' -> '+$(self).val(), 'Terceros')
		},
		success: function(res){
			switch(res){
				case '1':
					var fn = Function($(self).closest('[data-crud-dt]').attr('data-crud-dt')+'.ajax.reload();');
					fn();
					$(self).closest('[data-crud-tabla]').find('.btnEliminar').attr('disabled', false);
				break;
				case '2':
					alertify.alert('Advertencia', 'No posee los permisos para Modificar el '+$(self).attr('data-nombre'), function(){
						this.destroy();
					});
				break;
				default:
					//console.log(res);
					alertify.alert('Error', res, function(){
						this.destroy();
					});
				break;
			}
		}
	});
}

$("[data-crud-tabla]").on("click", ".btnEliminar", function(e){
	e.preventDefault();
	var self = this;
	var permiso 	= $(self).attr('data-permiso') ? $(self).attr('data-permiso') : '0';
	if($(this).closest('[data-crud-tabla]').find('[data-crud-codigo]').val() != '' && $ID != ''){
		alertify.confirm('Advertencia', '¿Está seguro de retirar el registro?', function(){
			$.ajax({
				url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/eliminarCRUD",
				type: 'POST',
				data: {
					tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
					codigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(),
					cliente: $ID,
					permiso: permiso,
					nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
					RASTREO: RASTREO('Elimina registro '+$(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val()+' de '+$('.nav-link.active[role=tab]').text().trim()+' Cliente '+$ID, 'Terceros')
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
						case '2':
							alertify.alert('Advertencia', 'No posee los permisos para Eliminar el registro', function(){
								this.destroy();
							});
						break;
						default:
							//console.log(res);
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

function calcularDigitoVerificacion ( myNit ) {

	var vpri,

	x,

	y,

	z;

	myNit = myNit.replace ( /\s/g, "" ) ; // Espacios

	myNit = myNit.replace ( /,/g, "" ) ; // Comas

	myNit = myNit.replace ( /\./g, "" ) ; // Puntos

	myNit = myNit.replace ( /-/g, "" ) ; // Guiones

	if ( isNaN ( myNit ) ) {

		console.log ("El nit/cédula '" + myNit + "' no es válido(a).") ;

		return "" ;

	};

	vpri = new Array(16) ;

	z = myNit.length ;

	vpri[1] = 3 ;

	vpri[2] = 7 ;

	vpri[3] = 13 ;

	vpri[4] = 17 ;

	vpri[5] = 19 ;

	vpri[6] = 23 ;

	vpri[7] = 29 ;

	vpri[8] = 37 ;

	vpri[9] = 41 ;

	vpri[10] = 43 ;

	vpri[11] = 47 ;

	vpri[12] = 53 ;

	vpri[13] = 59 ;

	vpri[14] = 67 ;

	vpri[15] = 71 ;

	x = 0 ;
	y = 0 ;

	for ( var i = 0; i < z; i++ ) {
		y = ( myNit.substr (i, 1 ) ) ;
		x += ( y * vpri [z-i] ) ;
	}

	y = x % 11 ;

	return ( y > 1 ) ? 11 - y : y ;
}

$(".numeric").inputmask({
	groupSeparator:"",
	alias:"integer",
	placeholder:"0",
	autoGroup:!0,
	digitsOptional:!1,
	clearMaskOnLostFocus:!1
}).click(function(){
	$(this).select();
});

$(".numeric4").inputmask({
	groupSeparator:"",
	alias:"numeric",
	placeholder:"0.0000",
	autoGroup:!0,
	digits:4,
	digitsOptional:!1,
	clearMaskOnLostFocus:!1
});

$('.btnAgregar').click(function(e){
	e.preventDefault();
	if($(this).closest('#informacionAdicionalCRM').length > 0){
		CRM = {
			CRMDatoid: null,
			CRMTablaid: null,
			dato: '',
			tipo: '',
			nombre: '',
			value: ''
		};
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
							select: ['CRMTablaid', 'nombre', 'tipo'],
							table : ['CRMTablas'],
							column_order : ['CRMTablaid', 'nombre'],
							column_search : ['CRMTablaid', 'nombre'],
							orden : {
								'nombre': 'asc'
							},
							columnas : ['CRMTablaid', 'nombre', 'tipo']
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
								CRM.CRMTablaid = data[0];
								CRM.tipo = data[2];
								CRM.nombre = data[1];
								alertify.myAlert().close();
								if(CRM.CRMTablaid != null){
									if(CRM.tipo == 'L'){
										// Seleccionar
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
															if(CRM.CRMDatoid != null){
																guardarCRM();
															}
														},onshow:function(){
															busqueda = true;
														}
													});

													alertify.myAlert(data);

													var $tblID = '#tblBusqueda';
													var config = {
														data:{
															tblID : $tblID,
															select: ['crmdatoid', 'nombre'],
															table : ['CRMDatos',,[['CRMTablaid', CRM.CRMTablaid]]],
															column_order : ['crmdatoid', 'nombre'],
															column_search : ['crmdatoid', 'nombre'],
															orden : {
																'nombre': 'asc'
															},
															columnas : ['crmdatoid', 'nombre']
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
																CRM.CRMDatoid = $(this).closest("tr").find("td").eq(0).text();
																CRM.value = $(this).closest("tr").find("td").eq(1).text();
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
										// Escribir
										alertify.prompt().set({onshow:function(){
												$(document).find(".ajs-input").attr('maxlength', 60).addClass('form-control');
											}
										});
										alertify.prompt(CRM.nombre,'',''
										,function(evt,value){
											CRM.dato = value;
											CRM.value = value;
											guardarCRM();
											this.destroy();
										},function(){
											this.destroy();
										});
									}
								}
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
	}else if($(this).closest('#adjuntos').length > 0){
		if (typeof FormData !== 'undefined') {
			if ($("[id=adj]")[0].files[0] != undefined){ 
				var form_data = new FormData();
				form_data.append('Lista_Anexos', $("[id=adj]")[0].files[0]);
				form_data.append('Id', $ID);
				form_data.append('nombreCliente', $('[data-db="nombre"]').val().trim());
				form_data.append('Tipo', 'TER');

				$.ajax({
					url 		: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/guardarAdjunto",
					type 		: "POST",
					data 		: form_data,
					async		: false,
					cache		: false,
					contentType : false,
					processData : false,
					success: function(resultado){
						if (resultado == 3) {
							alertify.error("No se permiten caracteres especiales en el nombre del adjunto");
						} else if (resultado == 0) {
							alertify.error("No se pudo guardar el adjunto, comuniquese con el administrador del sistema");
						}else{
							alertify.success('Adjunto guardado correctamente');
							$('#adj').val("");
							$('#adj').next('.custom-file-label').html('Seleccione un archivo...');
							dtAdjuntos.ajax.reload();
						}
					}
				});
			} else {
				alertify.error("No ha seleccionado el adjunto");
			}
		}
	}else{
		cargarCRUD($(this).closest('[data-crud-tabla]').find('[data-crud-codigo]'), 0);
	}
});

function guardarCRM(){
	$.ajax({
		url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/guardarCRM",
		type: 'POST',
		data: {
			CRM: CRM,
			cliente: $ID,
			RASTREO: RASTREO('Modifica Cliente '+$ID+' Agrega Campo Adicional '+CRM.nombre+' -> '+CRM.value, 'Terceros')
		},
		success: function(res){
			switch(res){
				case '1':
					var fn = Function($('[data-crud-tabla=CRMTercero]').attr('data-crud-dt')+'.ajax.reload();');
					fn();
					$('[data-crud-tabla=CRMTercero]').find('.btnEliminar').attr('disabled', false);
				break;
				case '2':
					alertify.alert('Advertencia', 'No posee los permisos para Agregar el Campo Adicional', function(){
						this.destroy();
					});
				break;
				default:
					//console.log(res);
					alertify.alert('Error', res, function(){
						this.destroy();
					});
				break;
			}
		}
	});
}

$('#btnEliminarCliente').click(function(e){
	e.preventDefault();
	if(!$(this).is('[disabled]')){
		if($ID != ''){
			alertify.confirm('Advertencia','¿Está seguro de Borrar este registro?', function(){
				$.ajax({
					url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/eliminarCliente",
					type: 'POST',
					data: {
						cliente: $ID,
						RASTREO: RASTREO('Elimina Cliente '+$ID, 'Terceros')
					},
					success: function(res){
						switch(res){
							case '1':
								$ID = '';
								$("[data-codigo]").val('').change();
								alertify.alert('Advertencia', 'Cliente eliminado satisfactoriamente', function(){
									this.destroy();
								});
							break;
							case '2':
								alertify.alert('Advertencia', 'No posee los permisos para Eliminar el Cliente', function(){
									this.destroy();
								});
							break;
							case '3':
								alertify.alert('Advertencia', 'El Tercero posee movimientos, no se puede eliminar', function(){
									this.destroy();
								});
							break;
							default:
								//console.log(res);
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
			alertify.error('No hay un Cliente cargado');
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

$('#adj').on('change', function(e){
	var fileName = e.target.files[0].name;
	$(this).next('.custom-file-label').html(fileName);
});

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

$('a[href="#sucursales"]').on('shown.bs.tab', function(e){
	$('select.chosen-select').chosen({
		placeholder_text_single: ''
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	}).on("change",function(){
		if ($(this).attr('id') == 'chTipoVivienda' && $(this).val() != null && $(this).val() != '') {
			//console.log('Sisas');
			obtenerVivienda($(this).val());
		}
	}).val("").trigger("chosen:updated");


	function obtenerVivienda(id){
		$.ajax({ 
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/obtenerVivienda",
			type: 'POST',
			async: false,
			data: {
				Id : id,
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				$("#chVivienda").empty().append('<option value="" disabled selected>Seleccione</option>');
				if (respuesta.length > 0) {
					$.each(respuesta,function(){
						$("#chVivienda").append('<option value="'+this.id+'">'+this.nombre+'</option>');
					})
				}
				$("#chVivienda").trigger("chosen:updated")
			}
		});
	}

	$("#btnAgregaRes").off('click').on("click",function(e){
		e.preventDefault();
		//console.log($("#chVivienda").val());
		if ($("#chVivienda").val() != null && $("#chVivienda").val() != '') {
			var data = {
				ViviendaId 	: $("#chVivienda").val(),
				TerceroID 	: $ID,
				Propietario : $("#cProp").is(":checked") == true ? 1 : 0,
				ListaGeneral : $("#cDir").is(":checked") == true ? 1 : 0,
				Residente 	: $("#cRes").is(":checked") == true ? 1 : 0,
				Titular 	: $("#cTitular").is(":checked") == true ? 1 : 0
			}
			var rastreo = `Asigna vivienda [Tercero : `+$ID+`] [Vivienda : `+$("#chVivienda").find("option:selected").text()+`]`;
			$.ajax({ 
				url: base_url() + "Administrativo/Configuracion/Terceros/RegistroClientes/guardarResidencia",
				type: 'POST',
				async: false,
				data: {
					Data 	: data,
					RASTREO : RASTREO(rastreo,"Terceros")
				},
				success: function(respuesta){
					respuesta = JSON.parse(respuesta);
					switch (respuesta) {
						case 1:
							alertify.success("Datos guardados exitosamente");
							dtResidencia.ajax.reload();
							break;
						case 2:
							alertify.alert("Atención","El numero de vivienda ya se encuentra asignado al tercero");
							break;
						case 3:
							alertify.alert("Atención","El tercero ya es residente en otra vivienda.");
							break;
						default:
							alertify.error("¡Error! comuniquese con el administrador del sistema.");
							break;
					}
					$("#chVivienda").val("").trigger("chosen:updated");
					$("#cProp,#cDir,#cRes,#cTitular").prop("checked",false);
				}
			});
		}else{
			alertify.alert("Atención","Es necesario diligenciar los campos obligatorios (*)");
			return;
		}
	})
});

$('a[href="#otraInformacionCRM"]').on('shown.bs.tab', function(e){
	$('select[multiple]').chosen('destroy').chosen({
		placeholder_text_multiple:　'Seleccione'
		,no_results_text: 'Oops, no se encuentra'
		,width: '100%'
	});
});

$('[data-db=RespoFisca]').change(function(){
	var RespoFisca = $(this).val();
	RespoFisca = RespoFisca.join(';');
	var Anterior = $(this).attr('data-anterior');
	if(RespoFisca.length > $(this).attr('maxlength')){
		Anterior = Anterior.split(';');
		$(this).val(Anterior).trigger('chosen:updated');
	}else{
		lastFocus = Anterior;
		actualizar(this, lastFocus);
	}
});