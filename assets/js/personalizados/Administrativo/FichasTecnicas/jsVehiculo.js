var dtTblAnexosVehiculo = $('#TblAnexosVehiculo').DataTable({
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
	processing: true,
	pageLength: 5,
	order: [[1, 'asc']],
	columnDefs: [
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [0,1,2]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [0,1,2]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [0,1,2]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".eliminarAnexoEquipo", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(0) .eliminarAnexoEquipo').val();
		
			alertify.confirm('Eliminar Anexo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina anexo Vehiculo Id '+ id;
				eliminarItemAnexo(mRastreo,id);
			}, function(){});
		});
	}
});


$("[id=CrearAnexosVehiculo]").on("click", function(e){
	e.preventDefault();
	var row = {
		0: "<center><button type='button' class='btnGuardarAN btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs LimpiarAN' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
		1: '<input type="file"  name="Lista_Anexos[]" id="anexosDoc"  class="anexarArchivos" accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >',
		2: '',
		3: ''

	}
	dtTblAnexosVehiculo.row.add(row).draw();
	$(this).attr('disabled', true);
});

$("[id=TblAnexosEquipoVehiculo]").on("click", ".LimpiarAN", function(e){
	e.preventDefault();
	dtTblAnexosVehiculo.row( $(this).closest('tr') ).remove().draw();
	$("#CrearAnexosEquipoVehiculo").attr('disabled', false);
});


var dtTblOperacionesTiempo = $('#TblOperacionesTiempo').DataTable({
	language: pa.language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
		//{width: '1%', targets: [2]},
		//{targets: [1], widht:'5%'}
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2,3,4,5]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2,3,4,5]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2,3,4,5]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html('<center>'+data[0]+'</center>');
		$(row).on("click", ".btnEditarOT", function(e){
			e.preventDefault();
			$("[id=CrearOperacionTiempo]").prop("disabled", true);
			var tiempo = $(row).find('td:eq(3)').text();
			var tipo = '';
			if (tiempo == "Dias") {
				tipo = '001';
			}else if (tiempo == "Semanas") {
				tipo = '002';
			}else if (tiempo == "Meses") {
				tipo = '003';
			}else if (tiempo == "Años") {
				tipo = '004';
			}
			$(row).find('td:eq(1)').attr('contenteditable', true);
			$(row).find('td:eq(2)').attr('contenteditable', true);
			$(row).find('td:eq(3)').html(selectTiempo);
			$(row).find('td:eq(3) select').val(tipo);
			$(row).find('td:eq(4)').html('<input tipe="text" class="form-control contro-input date">');
			$(row).find('td:eq(4) input').val(data[3]);
			$(row).find('td:eq(5)').attr('contenteditable', true);
			$(row).find('td:eq(0) .btnEditarOT span').removeClass("far fa-edit");
			$(row).find('td:eq(0) .btnEditarOT span').addClass("far fa-save");
			$(row).find('td:eq(0) .btn-primary').removeClass("btnEditarOT");
			$(row).find('td:eq(0) .btn-primary').addClass("btnActualizarOT");
			$(row).find('td:eq(0) .btn-primary').attr('title', "Actualizar");
			$(row).find('td:eq(0) .btn-danger').removeClass("btnEliminarItemOT");
			$(row).find('td:eq(0) .btn-danger').addClass("btnCancelarEdicion");
			$(row).find('td:eq(0) .btn-danger').attr('title', "Cancelar edición");
			$(row).find('td:eq(1)').focus();
			$('.date').datetimepicker({
				format: 'YYYY-MM-DD',
				locale: 'es'
			});
		});
		$(row).on("click", ".btnActualizarOT", function(e){
			e.preventDefault();
			var $data = {
				operacion 		: $(this).closest('tr').find('td:eq(1)').text().trim(),
				valorfrecuencia : $(this).closest('tr').find('td:eq(2)').text().trim(),
				TiempoOperacion : $(this).closest('tr').find('td:eq(3) select').val(),
				ultimafecha 	: $(this).closest('tr').find('td:eq(4) input').val(),
				diasalerta 		: $(this).closest('tr').find('td:eq(5)').text().trim(),
				vehiculocod 	: $("[id=placaVehiculo]").val(),
				tipooperacion 	: 't',
			};
			
			var tipo = $(this).closest("[id=TblOperacionesTiempo]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(0) .btnActualizarOT').val();
			

			mRastreo = 'Actualiza Ficha tecnica Oreción Tiempo  '+ $data.operacion;
			actualizarDatos($data,tipo,'Operacion',mRastreo,$ID,'ItemEquipoId',id,'OperacionId',);

		});
		

		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(0) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Oprecion Tiempo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Operación Tiempo Id '+ id;
				eliminarOperacion(id, mRastreo, 'Registro eliminado exitosamente','Vehiculo');
			}, function(){});
		});
		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$(".CrearOperacionTiempo").prop("disabled", false);
			cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OT');
		});
		$(row).on("click", ".cancelarOPT", function(e){
			e.preventDefault();
			dtTblOperacionesTiempo.row( $(this).closest('tr') ).remove().draw();
			$("#CrearOperacionTiempo").attr('disabled', false);
		});
	}
});

$("[id=CrearOperacionTiempo]").on("click", function(e){
	e.preventDefault();
	var row = {
		0: '<input class="form-control nomOP"><button class="btn btn-sm btn-primary mt-1 cargaOP" title="Cargar operación" data-tipo="T"><i class="fas fa-upload"></i></button>',
		1: '<input class="form-control numerico">',
		2: $STIEMPO,
		3: $DATE,
		4: '<input class="form-control" disabled>',
		5: '<input class="form-control numerico diasOP">', 
		6: "<button type='button' class='btnGuardarOPT btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelarOPT' title='Eliminar'><span class='far fa-trash-alt'></span></button>",
	}
	dtTblOperacionesTiempo.row.add(row).draw();
	// $("#TblOperacionesTiempo tbody tr").first().find("td").not(":eq(0),:eq(3),:eq(4)").attr('contenteditable', true).on('keydown paste', function(e){
	// 	if($(this).index() == 1){
	// 		var tamano = 100;
	// 	}else if($(this).index() == 2){
	// 		var tamano = 10;
	// 	}
	// 	if ($(this).text().length >= tamano && e.keyCode != 8) {
	// 		e.preventDefault();
	// 	}
	// });
	$("#TblOperacionesTiempo tbody tr").first().find("td input").eq(0).focus();
	$(this).attr('disabled', true);
	$('.date').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'es'
	});
});

var dtTblOperacionesConsumo = $('#TblOperacionesConsumo').DataTable({
	language: pa.language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
	{width: '1%', targets: [2]},
	//{visible: false, targets: [0, 1]}
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2,3,4,5]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2,3,4,5]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2,3,4,5]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html('<center>'+data[0]+'</center>');
		$(row).on("click", ".btnEditarOT", function(e){
			e.preventDefault();
			$("[id=CrearOperacionTiempo]").prop("disabled", true);
			var tiempo = $(row).find('td:eq(3)').text();
			var tipo = '';
			if (tiempo == "Dias") {
				tipo = '001';
			}else if (tiempo == "Semanas") {
				tipo = '002';
			}else if (tiempo == "Meses") {
				tipo = '003';
			}else if (tiempo == "Años") {
				tipo = '004';
			}
			$(row).find('td:eq(1)').attr('contenteditable', true);
			$(row).find('td:eq(2)').attr('contenteditable', true);
			$(row).find('td:eq(3)').html(selectTiempo);
			$(row).find('td:eq(3) select').val(tipo);
			$(row).find('td:eq(4)').attr('contenteditable', true);
			$(row).find('td:eq(5)').attr('contenteditable', true);
			$(row).find('td:eq(0) .btnEditarOT span').removeClass("far fa-edit");
			$(row).find('td:eq(0) .btnEditarOT span').addClass("far fa-save");
			$(row).find('td:eq(0) .btn-primary').removeClass("btnEditarOT");
			$(row).find('td:eq(0) .btn-primary').addClass("btnActualizarOT");
			$(row).find('td:eq(0) .btn-primary').attr('title', "Actualizar");
			$(row).find('td:eq(0) .btn-danger').removeClass("btnEliminarItemOT");
			$(row).find('td:eq(0) .btn-danger').addClass("btnCancelarEdicion");
			$(row).find('td:eq(0) .btn-danger').attr('title', "Cancelar edición");
			$(row).find('td:eq(1)').focus();
			$('.date').datetimepicker({
				format: 'YYYY-MM-DD',
				locale: 'es'
			});
		});
		$(row).on("click", ".btnActualizarOT", function(e){
			e.preventDefault();
			var $data = {
				operacion: $(this).closest('tr').find('td:eq(1)').text().trim(),
				valorfrecuencia: $(this).closest('tr').find('td:eq(2)').text().trim(),
				TiempoOperacion: $(this).closest('tr').find('td:eq(3) select').val(),
				valultimoconsu: $(this).closest('tr').find('td:eq(4)').text().trim(),
				valnotifica: $(this).closest('tr').find('td:eq(5)').text().trim(),
				ItemEquipoId 	: $ID,
				tipooperacion: 'c',
			};

			var tipo = $(this).closest("[id=TblOperacionesConsumo]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(0) .btnActualizarOT').val();
			
			mRastreo = 'Actualiza Ficha tecnica Oreción Consumo  '+ $data.operacion;
			actualizarDatos($data,tipo,'Operacion',mRastreo,$ID,'ItemEquipoId',id,'OperacionId',);

		});
		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(0) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Oprecion Consumo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Operación Consumo Id '+ id;
				eliminarOperacion(id, mRastreo, 'Registro eliminado exitosamente','Vehiculo');
			}, function(){});
		});
		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$(".CrearOperacionTiempo").prop("disabled", false);
			cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OC');
		});
		/*$(row).on('focusin', 'td:eq(1),td:eq(2),td:eq(5)', function(){
			//$(this).selectText();
		}).on('focusout', 'td:eq(2),td:eq(5)', function(){
			var parsero = parseInt($(this).text().trim());
			if(isNaN(parsero)){
				parsero = 0;
			}
			if (parsero != 0 && parsero.toString().length > 10) {
				alertify.warning('maximo de caracteres permitidos (10)');
				parsero = 0;	
			}
			$(this).text(parsero);
		});*/
	}
});

$("[id=CrearOperacionConsumoVehiculo]").on("click", function(e){
	e.preventDefault();
	var undMedida = '<select class="form-control form-control-sm undMedidaTiempo">';
	undMedida += '<option value="001">Dias</option>';
	undMedida += '<option value="002">Semanas</option>';
	undMedida += '<option value="003">Meses</option>';
	undMedida += '<option value="004">Años</option>';
	undMedida += '</select>';
	var fecha = '<input class="form-control form-control-sm date">';
	var row = {
		0: "<center><button type='button' class='btnGuardarOPT btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelarOPT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
		1: '',
		2: '',
		3: '<center>'+undMedida+'</center>',
		4: '',
		5:  '' 
	}
	dtTblOperacionesConsumo.row.add(row).draw();
	$("#TblOperacionesConsumo tbody tr").first().find("td").not(":eq(0)").attr('contenteditable', true).on('keydown paste', function(e){
		
		if($(this).index() == 1){
			var tamano = 100;
		}else if($(this).index() == 2){
			var tamano = 10;
		}else if($(this).index() == 3){
			var tamano = 10;
		}else if($(this).index() == 4){
			var tamano = 10;
		}
		if ($(this).text().length >= tamano && e.keyCode != 8) {
			e.preventDefault();
		}

	});
	$("#TblOperacionesConsumo tbody tr").first().find("td").eq(1).focus();
	$(this).attr('disabled', true);
	$('.date').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'es'
	});
});

$("[id=TblOperacionesConsumo]").on("click", ".cancelarOPT", function(e){
	e.preventDefault();
	dtTblOperacionesConsumo.row( $(this).closest('tr') ).remove().draw();
	$(".CrearOperacionConsumo").attr('disabled', false);
});

var dtTblcajaheramienta = $('#Tblcajaheramienta').DataTable({
	language: pa.language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[0, 'asc']],
	orderable: false,
	columnDefs: [
		{targets: [0], className : 'txtJusty'},
		{targets: [1], className : 'txtCenter'},
		{width: '1%', targets: [2]},
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html('<center>'+data[0]+'</center>');
		$(row).on("click", ".btnEditarOT", function(e){
			e.preventDefault();
			$("[id=CrearElementoCaja]").prop("disabled", true);


			$(row).find('td:eq(0)').attr('contenteditable', true);
			$(row).find('td:eq(1)').attr('contenteditable', true);
			$(row).find('td:eq(2) .btnEditarOT span').removeClass("far fa-edit");
			$(row).find('td:eq(2) .btnEditarOT span').addClass("far fa-save");
			$(row).find('td:eq(2) .btn-primary').removeClass("btnEditarOT");
			$(row).find('td:eq(2) .btn-primary').addClass("btnActualizarOT");
			$(row).find('td:eq(2) .btn-primary').attr('title', "Actualizar");
			$(row).find('td:eq(2) .btn-danger').removeClass("btnEliminarItemOT");
			$(row).find('td:eq(2) .btn-danger').addClass("btnCancelarEdicion");
			$(row).find('td:eq(2) .btn-danger').attr('title', "Cancelar edición");
			$(row).find('td:eq(0)').focus();
		});
		$(row).on("click", ".btnActualizarOT", function(e){
			e.preventDefault();
			var $data = {
				Elemento: $(this).closest('tr').find('td:eq(0)').text().trim(),
				Cantidad: $(this).closest('tr').find('td:eq(1)').text().trim(),
			};

			var tipo = $(this).closest("[id=Tblcajaheramienta]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(2) .btnActualizarOT').val();
			
			mRastreo = 'Actualiza Elemento Vehiculo Caja Herramienta Ficha tecnica   '+ $data.Elemento;
			actualizarDatoSElemento($data,mRastreo,id);
		});
		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(2) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Elemento Vehiculo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Elemento Vehiculo Id '+ id;
				eliminarElemento(id, mRastreo, 'Registro eliminado exitosamente','ElementoVehiculo','ElementoVehiculoId','H');
			}, function(){});
		});
		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$("[id=CrearElementoCaja]").attr('disabled', false);
			cargarDatosTablasVehiculo();
		});
		$(row).on("click", ".cancelarOPT", function(e){
			e.preventDefault();
			dtTblcajaheramienta.row( $(this).closest('tr') ).remove().draw();
			$("[id=CrearElementoCaja]").attr('disabled', false);
		});
	}
});

$("[id=CrearElementoCaja]").on("click", function(e){
	e.preventDefault();
	var row = {
		0: '',
		1: '',
		2: "<center><button type='button' class='btnGuardarOPT btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelarOPT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
	}
	dtTblcajaheramienta.row.add(row).draw();
	$("#Tblcajaheramienta tbody tr").first().find("td").not(":eq(2)").attr('contenteditable', true).on('keydown paste', function(e){
		
		if($(this).index() == 1){
			var tamano = 100;
		}
		if ($(this).text().length >= tamano && e.keyCode != 8) {
			e.preventDefault();
		}

	});
	$("#Tblcajaheramienta tbody tr").first().find("td").eq(0).focus();
	$(this).attr('disabled', true);
});

var dtTblEquipoCarretera = $('#TblEquipoCarretera').DataTable({
	language: pa.language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
		{targets: [0], className : 'txtJusty'},
		{targets: [1], className : 'txtCenter'},
		{width: '1%', targets: [2]},
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html('<center>'+data[0]+'</center>');
		$(row).on("click", ".btnEditarOT", function(e){
			e.preventDefault();
			$("[id=CrearEquipoCarretera]").attr('disabled', true);


			$(row).find('td:eq(0)').attr('contenteditable', true);
			$(row).find('td:eq(1)').attr('contenteditable', true);
			$(row).find('td:eq(2) .btnEditarOT span').removeClass("far fa-edit");
			$(row).find('td:eq(2) .btnEditarOT span').addClass("far fa-save");
			$(row).find('td:eq(2) .btn-primary').removeClass("btnEditarOT");
			$(row).find('td:eq(2) .btn-primary').addClass("btnActualizarOT");
			$(row).find('td:eq(2) .btn-primary').attr('title', "Actualizar");
			$(row).find('td:eq(2) .btn-danger').removeClass("btnEliminarItemOT");
			$(row).find('td:eq(2) .btn-danger').addClass("btnCancelarEdicion");
			$(row).find('td:eq(2) .btn-danger').attr('title', "Cancelar edición");
			$(row).find('td:eq(0)').focus();
		});
		$(row).on("click", ".btnActualizarOT", function(e){
			e.preventDefault();
			var $data = {
				Elemento: $(this).closest('tr').find('td:eq(0)').text().trim(),
				Cantidad: $(this).closest('tr').find('td:eq(1)').text().trim(),
			};

			var tipo = $(this).closest("[id=TblEquipoCarretera]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(2) .btnActualizarOT').val();
			
			mRastreo = 'Actualiza Elemento Vehiculo Equipo Carretera Ficha tecnica   '+ $data.Elemento;
			actualizarDatoSElemento($data,mRastreo,id);
		});
		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(2) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Elemento Vehiculo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Elemento Vehiculo Id '+ id;
				eliminarElemento(id, mRastreo, 'Registro eliminado exitosamente','ElementoVehiculo','ElementoVehiculoId','E');
			}, function(){});
		});
		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$("[id=CrearEquipoCarretera]").attr('disabled', false);
			cargarDatosTablasVehiculo();
		});
		$(row).on("click", ".cancelarOPT", function(e){
			e.preventDefault();
			dtTblEquipoCarretera.row( $(this).closest('tr') ).remove().draw();
			$("[id=CrearEquipoCarretera]").attr('disabled', false);
		});
	}
});

$("[id=CrearEquipoCarretera]").on("click", function(e){
	e.preventDefault();
	var row = {
		0: '',
		1: '',
		2: "<center><button type='button' class='btnGuardarOPT btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelarOPT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
	}
	dtTblEquipoCarretera.row.add(row).draw();
	$("#TblEquipoCarretera tbody tr").first().find("td").not(":eq(2)").attr('contenteditable', true).on('keydown paste', function(e){
		
		if($(this).index() == 0){
			var tamano = 100;
		}
		if ($(this).text().length >= tamano && e.keyCode != 8) {
			e.preventDefault();
		}

	});
	$("#TblEquipoCarretera tbody tr").first().find("td").eq(0).focus();
	$(this).attr('disabled', true);
});

var dtTblBotiquin = $('#TblBotiquin').DataTable({
	language: pa.language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
		{targets: [0], className : 'txtJusty'},
		{targets: [1], className : 'txtCenter'},
		{width: '1%', targets: [2]},
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2]}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html('<center>'+data[0]+'</center>');
		$(row).on("click", ".btnEditarOT", function(e){
			e.preventDefault();
			$("[id=CrearBotiquin]").attr('disabled', true);


			$(row).find('td:eq(0)').attr('contenteditable', true);
			$(row).find('td:eq(1)').attr('contenteditable', true);
			$(row).find('td:eq(2) .btnEditarOT span').removeClass("far fa-edit");
			$(row).find('td:eq(2) .btnEditarOT span').addClass("far fa-save");
			$(row).find('td:eq(2) .btn-primary').removeClass("btnEditarOT");
			$(row).find('td:eq(2) .btn-primary').addClass("btnActualizarOT");
			$(row).find('td:eq(2) .btn-primary').attr('title', "Actualizar");
			$(row).find('td:eq(2) .btn-danger').removeClass("btnEliminarItemOT");
			$(row).find('td:eq(2) .btn-danger').addClass("btnCancelarEdicion");
			$(row).find('td:eq(2) .btn-danger').attr('title', "Cancelar edición");
			$(row).find('td:eq(0)').focus();
		});
		$(row).on("click", ".btnActualizarOT", function(e){
			e.preventDefault();
			var $data = {
				Elemento: $(this).closest('tr').find('td:eq(0)').text().trim(),
				Cantidad: $(this).closest('tr').find('td:eq(1)').text().trim(),
			};

			var tipo = $(this).closest("[id=TblBotiquin]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(2) .btnActualizarOT').val();
			
			mRastreo = 'Actualiza Elemento Vehiculo Botiquin Ficha tecnica   '+ $data.Elemento;
			actualizarDatoSElemento($data,mRastreo,id);
		});
		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(2) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Elemento Vehiculo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Elemento Vehiculo Id '+ id;
				eliminarElemento(id, mRastreo, 'Registro eliminado exitosamente','ElementoVehiculo','ElementoVehiculoId','B');
			}, function(){});
		});
		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$("[id=CrearBotiquin]").attr('disabled', false);
			cargarDatosTablasVehiculo();
		});
		$(row).on("click", ".cancelarOPT", function(e){
			e.preventDefault();
			dtTblBotiquin.row( $(this).closest('tr') ).remove().draw();
			$("[id=CrearBotiquin]").attr('disabled', false);
		});
	}
});

$("[id=CrearBotiquin]").on("click", function(e){
	e.preventDefault();
	var row = {
		0: '',
		1: '',
		2: "<center><button type='button' class='btnGuardarOPT btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelarOPT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
	}
	dtTblBotiquin.row.add(row).draw();
	$("#TblBotiquin tbody tr").first().find("td").not(":eq(2)").attr('contenteditable', true).on('keydown paste', function(e){
		
		if($(this).index() == 0){
			var tamano = 100;
		}
		if ($(this).text().length >= tamano && e.keyCode != 8) {
			e.preventDefault();
		}

	});
	$("#TblBotiquin tbody tr").first().find("td").eq(0).focus();
	$(this).attr('disabled', true);
});

$(document).on("click",".cargaOP",function(e){
	e.preventDefault();
	var self = this;
	if ($ID != 0) {
		$("#mOperacion").unbind().on("shown.bs.modal",function(){
			$(".rowDataOpe").empty();
			var opera = obtenerOperacion($(self).attr('data-tipo'));
			if (opera.length > 0) {
				for (var i = 0; i < opera.length; i++) {
					var x = `
						<div class="col-10 mb-2">
							<input type="" name="" class="form-control" readonly value="`+opera[i].Nombre+`">
						</div>
						<div class="col-2" title="seleccionar tercero">
							<button type="button" class="btn btn-primary f-r" id="btnCA" data-nombre="`+opera[i].Nombre+`" data-id="`+opera[i].ActividadEquipoId+`" data-tiempo="`+opera[i].TiempoOperacion+`" data-dia="`+opera[i].DiasAlerta+`"><i class="fas fa-check-circle"></i></button>
						</div> `;
					$(".rowDataOpe").append(x);
				}
				$(document).on("click","#btnCA",function(e){
					e.preventDefault();
					$(".nomOP").val($(this).attr('data-nombre')).prop("disabled",true);
					$(".nomOP").attr('data-id',$(this).attr('data-id'));
					$(".tiempoOP").val($(this).attr('data-tiempo')).prop("disabled",true);
					$(".diasOP").val($(this).attr('data-dia')).prop("disabled",true);
					$("#mOperacion").modal("hide");
				})
			}else{
				var x = `
					<div class="col-12 mb-2 alert alert-danger">
						No hay registros disponibles para seleccionar.
					</div>
				`;
				$(".rowDataOpe").append(x);
			}
		}).on("hidden.bs.modal",function(){
			$("#TblOperacionesTiempo tbody tr").first().find("td input").eq(1).focus();
		});

		$("#mOperacion").modal("show");
	}else{
		alertify.alert("Atención","Para cargar operaciones debe de seleccionar el equipo para la ficha tecnica.");
	}
});

function obtenerOperacion(tipo){
	var resp = [];
	$.ajax({ 
		url: base_url()+"Administrativo/FichasTecnicasB4/cFichasTecnicas/obtenerOperacion",
		type: 'POST',
		async: false,
		data: {
			Id 	 : $EQUIPOID,
			Tipo : tipo
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta.length > 0) {
				resp = respuesta;
			}
		}
	});
	return resp;
}