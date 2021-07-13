var dtTblAnexoslocativa = $('#TblAnexoslocativa').DataTable({
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
				mRastreo = 'Elimina anexo Locativa Id '+ id;
				eliminarItemAnexo(mRastreo,id);
			}, function(){});
		});
	}
});


$("[id=CrearAnexosLocativa]").on("click", function(e){
	e.preventDefault();
	var row = {
		0: "<center><button type='button' class='btnGuardarAN btn btn-primary btn-xs' title='Guardar' style='margin-right:5px'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs LimpiarAN' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
		1: '<input type="file"  name="Lista_Anexos[]" id="anexosDoc"  class="anexarArchivos" accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >',
		2: '',
		3: ''

	}
	dtTblAnexoslocativa.row.add(row).draw();
	$(this).attr('disabled', true);
});

$("[id=TblAnexoslocativa]").on("click", ".LimpiarAN", function(e){
	e.preventDefault();
	dtTblAnexoslocativa.row( $(this).closest('tr') ).remove().draw();
	$("#CrearAnexoslocativa").attr('disabled', false);
});


var dtTblOperacionesTiempoLocativa= $('#TblOperacionesTiempoLocativa').DataTable({
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
			
			var tipo = $(this).closest("[id=TblOperacionesTiempoLocativa]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(0) .btnActualizarOT').val();
			

			mRastreo = 'Actualiza Ficha tecnica Oreción Tiempo  '+ $data.operacion;
			actualizarDatos($data,tipo,'Operacion',mRastreo,$ID,'ItemEquipoId',id,'OperacionId',);

		});
		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(0) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Oprecion Tiempo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Operación Tiempo Id '+ id;
				eliminarOperacion(id, mRastreo, 'Registro eliminado exitosamente','Locativa');
			}, function(){});
		});
		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$(".CrearOperacionTiempo").prop("disabled", false);
			cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OT');
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

$("[id=CrearOperacionTiempo]").on("click", function(e){
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
		4: '<center>'+fecha+'</center>',
		5:  '' 
	}
	
	dtTblOperacionesTiempoLocativa.row.add(row).draw();
	$("#TblOperacionesTiempoLocativa tbody tr").first().find("td").not(":eq(0),:eq(3),:eq(4)").attr('contenteditable', true).on('keydown paste', function(e){
		if($(this).index() == 1){
			var tamano = 100;
		}else if($(this).index() == 2){
			var tamano = 10;
		}
		if ($(this).text().length >= tamano && e.keyCode != 8) {
			e.preventDefault();
		}
	});
	$("#TblOperacionesTiempoLocativa tbody tr").first().find("td").eq(1).focus();
	$(this).attr('disabled', true);
	$('.date').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'es'
	});
});

$("[id=TblOperacionesTiempoLocativa]").on("click", ".cancelarOPT", function(e){
	e.preventDefault();
	dtTblOperacionesTiempoMaquinaria.row( $(this).closest('tr') ).remove().draw();
	$("#CrearOperacionTiempo").attr('disabled', false);
});



var dtTblOperacionesConsumoLocativa = $('#TblOperacionesConsumoLocativa').DataTable({
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

			var tipo = $(this).closest("[id=TblOperacionesConsumoLocativa]").attr("data-tipo");
			var id = $(this).closest('tr').find('td:eq(0) .btnActualizarOT').val();
			
			mRastreo = 'Actualiza Ficha tecnica Oreción ConsumoLocativa  '+ $data.operacion;
			actualizarDatos($data,tipo,'Operacion',mRastreo,$ID,'ItemEquipoId',id,'OperacionId',);

		});
		$(row).on("click", ".btnEliminarItemOT", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(0) .btnEliminarItemOT').val();
			alertify.confirm('Eliminar Oprecion Consumo', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Operación Consumo Id '+ id;
				eliminarOperacion(id, mRastreo, 'Registro eliminado exitosamente','Locativa');
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

$("[id=CrearOperacionConsumoLocativa]").on("click", function(e){
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
	dtTblOperacionesConsumoLocativa.row.add(row).draw();
	$("#TblOperacionesConsumoLocativa tbody tr").first().find("td").not(":eq(0)").attr('contenteditable', true).on('keydown paste', function(e){
		
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
	$("#TblOperacionesConsumoLocativa tbody tr").first().find("td").eq(1).focus();
	$(this).attr('disabled', true);
	$('.date').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'es'
	});
});

$("[id=TblOperacionesConsumoLocativa]").on("click", ".cancelarOPT", function(e){
	e.preventDefault();
	dtTblOperacionesConsumoLocativa.row( $(this).closest('tr') ).remove().draw();
	$(".CrearOperacionConsumo").attr('disabled', false);
});