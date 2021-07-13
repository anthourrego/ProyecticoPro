var $ID = '';
lastFocus = '',
dataAjax = {
	cliente: ''
},
$CREAR = 0,
$ArrayTarifas = [],
CRM = {
	CRMDatoid: null,
	CRMTablaid: null,
	dato: '',
	tipo: '',
	nombre: '',
	value: ''
};

var dtSucursales = $('#tblSucursales').DataTable({
	language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroProveedores/qSucursales',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'sucursalid', width: '1%'},
		{data: 'nombre'},
		{data: 'ciudadidNombre'},
		{data: 'terceroid', visible: false},
		{data: 'direccion', visible: false},
		{data: 'barrioid', visible: false},
		{data: 'barrioidNombre', visible: false},
		{data: 'ciudadid', visible: false},
		{data: 'dptoid', visible: false},
		{data: 'dptoidNombre', visible: false},
		{data: 'paisid', visible: false},
		{data: 'paisidNombre', visible: false},
		{data: 'regionid', visible: false},
		{data: 'regionidNombre', visible: false},
		{data: 'zonaid', visible: false},
		{data: 'zonaidNombre', visible: false},
		{data: 'telefono', visible: false},
		{data: 'email', visible: false},
		{data: 'vendedorid', visible: false},
		{data: 'vendedoridNombre', visible: false},
		{data: 'estado', visible: false}
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.sucursalid);
		});
	}
});

var dtInformacionAdicionalCRM = $('#tblInformacionAdicionalCRM').DataTable({
	language: language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroProveedores/qInformacionAdicionalCRM',
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
		url: 'RegistroProveedores/qAdjuntos',
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
		url: 'RegistroProveedores/qContactos',
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

var dtDescuentoFinancieroTercero = $('#tblDescuentoFinancieroTercero').DataTable({
	language: language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroProveedores/qDescuentoFinancieroTercero',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'DescuFinaTercId', width: '1%', visible: false},
		{data: 'Dias'},
		{data: 'Porcentaje'}
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.DescuFinaTercId);
		});
	}
});

var dtTarifaICATercero = $('#tblTarifaICATercero').DataTable({
	language: language,
	dom: domBftrip,
	processing: true,
	ajax: {
		url: 'RegistroProveedores/qTarifaICATercero',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Id', width: '1%', visible: false}
		,{data: 'TarifICAId'}
		,{data: 'Nombre'}
		,{data: 'Porcentaje'}
		,{data: 'CiudadNombre'}
	],
	buttons: [
		{ extend: 'pageLength' }
	],
	drawCallback: function(settings) {
		var api = this.api();
		if(api.data().length > 0){
			$('.btnQuitarTodo').attr('disabled', false);
		}else{
			$('.btnQuitarTodo').attr('disabled', true);
		}
	},
	createdRow: function(row, data, dataIndex){
		$(row).click(function(){
			cargarCRUD(row, data.Id);
			$('.selected').removeClass('selected');
			$(this).addClass('selected');
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
	dtSucursales.ajax.reload();
	dtInformacionAdicionalCRM.ajax.reload();
	dtContactos.ajax.reload();
	dtAdjuntos.ajax.reload();
	dtDescuentoFinancieroTercero.ajax.reload();
	dtTarifaICATercero.ajax.reload();
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
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/Cargar",
			type: 'POST',
			data: {
				codigo: $ID,
				RASTREO: RASTREO('Carga Proveedor '+$ID, 'Terceros')
			},
			success: function(respuesta){
				registro = JSON.parse(respuesta);
				if(registro.length > 0) {
					if(registro[0]['EsProveedor'] == 0 && registro[0]['EsCliente'] == 1){
						alertify.alert('Advertencia', 'El tercero existe pero no está asociado como Proveedor: (Es Cliente)');
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
													['EsProveedor', 1]
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
							url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/Registrar",
							type: 'POST',
							data: {
								codigo: $ID,
								RASTREO: RASTREO('Registra Proveedor '+$ID, 'Terceros')
							},
							success: function(respuesta){
								if(respuesta != '1'){
									alertify.alert('Error', respuesta, function(){
										console.log(respuesta);
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

$("#frmRegistroClientes").on("focusin", "[data-db], [data-crud]", function(){
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
						url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/CargarForanea",
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
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/Actualizar",
			type: 'POST',
			async: false,
			data: {
				cliente: $ID,
				nombre: nombre,
				value: value,
				tabla: tabla,
				permiso: permiso,
				RASTREO: RASTREO('Modifica Proveedor '+$ID+' Cambia '+$(self).attr('data-nombre')+' '+lastFocus+' -> '+value, 'Terceros')
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
					var rastreo = RASTREO('Modifica Proveedor '+$ID+' Cambia Foto', 'Terceros');
					var form_data = new FormData();
					form_data.append('file', $(input)[0].files[0]);
					form_data.append('imagen', $(input).attr('data-imagen'));
					form_data.append('cliente', $ID);
					form_data.append('cambio', rastreo.cambio);
					form_data.append('fecha', rastreo.fecha);
					form_data.append('programa', rastreo.programa);
					$.ajax({	
						url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/ActualizarImagen",
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

$("input[type=file]:not(#adj)").change(function(){
	if($ID != ''){
		leerImg(this);
	}else{
		alertify.error('No hay un Proveedor cargado');
	}
});

$(".btn-primary").click(function(e){
	e.preventDefault();
	var btn = $(this).attr('id'),
		TerceroID = $("[data-codigo]").val();
	$.ajax({
		url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/ListaClientes",
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
			switch ($(this).attr('data-permiso')) {
				case '0':
				case '60':
				case '71':
				case '95':
					if ( ($(this).is(':button')) && ($(this).hasClass('btnAgregar')) && ( ! $TERCCrear.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}else if ( ($(this).is(':button')) && ( $(this).hasClass('btnEliminar') || $(this).hasClass('btnQuitarTodo')) && ( ! $TERCElimi.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}
				break;
				case '45':
				case '50':
				case '55':
					if ( ($(this).is(':button')) && ($(this).hasClass('btnAgregar')) && ( ! $TERCCrear.includes(parseInt($(this).attr('data-permiso')))) ){
						$(this).attr('disabled', true).attr('data-deshabilitado', '1');
					}else if ( ($(this).is(':button')) && ( $(this).hasClass('btnEliminar') || $(this).hasClass('btnQuitarTodo')) && ( ! $TERCModif.includes(parseInt($(this).attr('data-permiso')))) ){
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
			if (typeof($TERCCrear) != 'undefined') {
				switch ($(this).attr('data-permiso')) {
					case '86':
					break;
					default:
					if( ! $TERCCrear.includes(parseInt($(this).attr('data-permiso')))){
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
								['EsProveedor', 1]
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
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/cargarCRUD",
			type: 'POST',
			data: {
				tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
				codigo: codigo,
				cliente: $ID,
				nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
				permiso: permiso,
				RASTREO: RASTREO(' de '+$('.nav-link.active[role=tab]').text().trim()+' Proveedor '+$ID, 'Terceros')
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
						url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/CargarForanea",
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
		url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/guardarCRUD",
		type: 'POST',
		data: {
			tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
			nombre: $(self).attr('data-crud'),
			value: $(self).val(),
			codigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(),
			cliente: $ID,
			nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
			permiso: permiso,
			RASTREO: RASTREO(' registro '+$(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val()+' de '+$('.nav-link.active[role=tab]').text().trim()+' Proveedor '+$ID+' '+$(self).attr('data-nombre')+' '+lastFocus+' -> '+$(self).val(), 'Terceros')
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
					console.log(res);
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
				url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/eliminarCRUD",
				type: 'POST',
				data: {
					tabla: $(self).closest('[data-crud-tabla]').attr('data-crud-tabla'),
					codigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val(),
					cliente: $ID,
					permiso: permiso,
					nombreCodigo: $(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').attr('data-crud-codigo'),
					RASTREO: RASTREO('Elimina registro '+$(self).closest('[data-crud-tabla]').find('[data-crud-codigo]').val()+' de '+$('.nav-link.active[role=tab]').text().trim()+' Proveedor '+$ID, 'Terceros')
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
	clearMaskOnLostFocus:!1,
	integerDigits:3
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
					url 		: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/guardarAdjunto",
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
	}else if($(this).closest('[data-crud-tabla=TarifaICATercero]').length > 0){
		$ArrayTarifas = [];
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
							if($ArrayTarifas.length > 0){
								$.ajax({
									url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/guardarICA",
									type: 'POST',
									async: false,
									data: {
										TarifICAId: JSON.stringify($ArrayTarifas),
										cliente: $ID,
										RASTREO: RASTREO('', 'Terceros')
									},
									success: function(res){
										switch(res){
											case '1':
												var fn = Function($('[data-crud-tabla=TarifaICATercero]').attr('data-crud-dt')+'.ajax.reload();');
												fn();
												$('[data-crud-tabla=TarifaICATercero]').find('.btnEliminar').attr('disabled', false);
											break;
											case '2':
												alertify.alert('Advertencia', 'No posee los permisos para Agregar Tarifas de ICA', function(){
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
							select: [
								'TI.TarifICAId'
								,'TI.Nombre'
								,'TI.Porcentaje'
								,'TI.Base'
								,'C.Nombre AS CiudadNombre'
								,'TI.CiudadId'
							],
							table : [
								'TarifaICA TI'
								,[
									['Ciudad C', 'TI.CiudadId = C.ciudadid', 'LEFT']
								],[
									['TI.Estado', 'A']
									,["TI.TarifICAId NOT IN (SELECT TarifICAId FROM TarifaICATercero WHERE TerceroId = '"+$ID+"')"]
								]
							],
							column_order : [
								'TI.TarifICAId'
								,'TI.Nombre'
								,'TI.Porcentaje'
								,'TI.Base'
								,'C.Nombre AS CiudadNombre'
								,'TI.CiudadId'
							],
							column_search : [
								'TI.TarifICAId'
								,'TI.Nombre'
							],
							orden : {
								'TarifICAId': 'asc'
							},
							columnas : [
								'TarifICAId'
								,'Nombre'
								,'Porcentaje'
								,'Base'
								,'CiudadNombre'
								,'CiudadId'
							]
						},
						bAutoWidth: false,
						processing: true,
						serverSide: true,
						columnDefs: [
							{targets: [0,2,3], width: '1%'},
							{targets: [4], width: '35%'}
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
							if($ArrayTarifas.includes(data[0])){
								$(row).addClass('selected');
							}
							$(row).click(function(){
								$(this).toggleClass('selected');
								if($(this).hasClass('selected')){
									$ArrayTarifas.push(data[0]);
								}else{
									var index = $ArrayTarifas.indexOf(data[0]);
									if (index !== -1) $ArrayTarifas.splice(index, 1);
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
		var campos = encodeURIComponent(JSON.stringify(['ID', 'Descripción', 'Tarifa', 'Base', 'Ciudad']));
		alertify.ajaxAlert(base_url()+"Busqueda/DataTable?campos="+campos);
	}else{
		cargarCRUD($(this).closest('[data-crud-tabla]').find('[data-crud-codigo]'), 0);
	}
});

function guardarCRM(){
	$.ajax({
		url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/guardarCRM",
		type: 'POST',
		data: {
			CRM: CRM,
			cliente: $ID,
			RASTREO: RASTREO('Modifica Proveedor '+$ID+' Agrega Campo Adicional '+CRM.nombre+' -> '+CRM.value, 'Terceros')
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
					console.log(res);
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
					url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/eliminarCliente",
					type: 'POST',
					data: {
						cliente: $ID,
						RASTREO: RASTREO('Elimina Proveedor '+$ID, 'Terceros')
					},
					success: function(res){
						switch(res){
							case '1':
								$ID = '';
								$("[data-codigo]").val('').change();
								alertify.alert('Advertencia', 'Proveedor eliminado satisfactoriamente', function(){
									this.destroy();
								});
							break;
							case '2':
								alertify.alert('Advertencia', 'No posee los permisos para Eliminar el Proveedor', function(){
									this.destroy();
								});
							break;
							case '3':
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
			alertify.error('No hay un Proveedor cargado');
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

$('.btnQuitarTodo').click(function(e){
	e.preventDefault();
	alertify.confirm('Advertencia', '¿Está seguro de retirar todos los registros?',function(){
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/Terceros/RegistroProveedores/QuitarICA",
			type: 'POST',
			async: false,
			data: {
				cliente: $ID,
				RASTREO: RASTREO('Modifica Tercero '+$ID+' Elimina Todas las Tarifas ICA del Tercero Tipo PR', 'Terceros')
			},
			success: function(res){
				switch(res){
					case '1':
						var fn = Function($('[data-crud-tabla=TarifaICATercero]').attr('data-crud-dt')+'.ajax.reload();');
						fn();
						$('[data-crud-tabla=TarifaICATercero]').find('.btnEliminar').attr('disabled', true);
					break;
					case '2':
						alertify.alert('Advertencia', 'No posee los permisos para Eliminar el registro', function(){
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
	},function(){})
});