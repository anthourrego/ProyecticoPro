var valorAnt = '';
var calendar;
var $HEADINCIDENCIA = 0;
var selectActividades;
var listatecnicosInc;
var cerrarActividadesEditar = true;
var FechaInicioAgenda;
var FechaFinAgenda;

var FechaInicialActividad = $DATETABLAFECHA;
var HoraInicialActividad = $DATETABLAHORA;
var FechaFinalActividad = $DATETABLAFECHA;
var HoraFinalActividad = $DATETABLAHORA;

var dtTbActividadIncidencia = $('#TblActividadIncidencia').DataTable({
	language,
	processing: true,
	pageLength: 25,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
		{width: '2%', targets: [0]}
		,{className: 'text-center', targets: [0]}
	],
	ajax: {
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/qListaActividades",
		type: 'POST',
		data: function(d){
			return  $.extend(d, {HeadIncidenciaId: $HEADINCIDENCIA});
		}
	},
	columns: [
		{
			'render': function(nTd, sData, oData, iRow, iCol){
				if(oData.Estado == 1){
					return "<div class='btn-group btn-group-xs'><button type='button' value='"+oData.TipoActividadId+"' class='Eliminar btn btn-danger' title='Editar'><i class='far fa-trash-alt'></i></button></div>";
				}else{
					return "<div class='btn-group btn-group-xs'><button value='"+oData.TipoActividadId+"' type='button' class='asignado btn btn-info' title='Asignar'><i class='fas fa-check'></i></button></div>";
				}
			}
		},
		{data: 'Nombre'},
		{data: 'EstadoActual'}
	],
	dom: domBftrip,
	buttons: [
		/* { extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2,3,4,5]}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2,3,4,5]}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2,3,4,5]}} */
		{ extend: 'pageLength'}
	],
	createdRow: function(row, data, dataIndex){

		$(row).on("click", ".asignado", function(e){
			e.preventDefault();

			var id = $(this).closest('tr').find('td:eq(0) .asignado').val();
			var nombreactividad =  $(this).closest('tr').find('td:eq(1)').text().trim();
			
			$detalleIncidencia = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				Descripcion      : 'Agrega Actividad '+ nombreactividad,
			}

			mRastreo = 'Asigna Actividad [id: '+ id + ', nombre: ' + nombreactividad + '] a la Incidencia [id: ' + $HEADINCIDENCIA + ', Nro: ' + $("#Numero").val() + ']';
			eliminarAgregaActividad(id, mRastreo, 'Agendar Incidencia', data.Estado, $detalleIncidencia);
		});

		$(row).on("click", ".Eliminar", function(e){
			e.preventDefault();

			var id = $(this).closest('tr').find('td:eq(0) .Eliminar').val();
			var nombreactividad =  $(this).closest('tr').find('td:eq(1)').text().trim();

			$detalleIncidencia = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				Descripcion      : 'Elimina Actividad '+ nombreactividad,
			}
			
			alertify.confirm('Eliminar actividad', '¿Está seguro de eliminar la actividad?', function(){
				mRastreo = 'Elimina actividad [Id: ' + id + ', nombre: ' + nombreactividad + '], Incidencia [id: ' + $HEADINCIDENCIA +'. Nro: ' + $("#numero").val() + ']';
				eliminarAgregaActividad(id, mRastreo, 'Agendar Incidencia', data.Estado, $detalleIncidencia);

				cerrarActividadesEditar = true;
			}, function(){});
		});
	}
});

var dtTbTecnicosAsignados = $('#TblTecnicosAsignados').DataTable({
	language,
	processing: true,
	pageLength: 25,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
		{width: '2%', targets: [0]}
		,{className: 'text-center', targets: [0]}
	],
	ajax: {
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/qListaTecnicosAsignados",
		type: 'POST',
		data: function(d){
			return  $.extend(d, {HeadIncidenciaId: $HEADINCIDENCIA});
		}
	},
	columns: [
		{
			data: 'Accion',
			render: function(nTd, sData, oData, iRow, iCol){
				if(oData.Accion == undefined){
					return "<div class='btn-group btn-group-xs'><button type='button' value='"+oData.TecnicoIncidenciaId+"' class='Eliminar btn btn-danger' title='Eliminar'><i class='far fa-trash-alt'></i></button></div>";
				} else {
					return oData.Accion;
				}
			}
		},
		{data: 'Nombre'},
		{data: 'Cedula'},
	],
	dom: domBftrip,
	buttons: [
		/* { extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2,3,4,5]}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2,3,4,5]}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2,3,4,5]}} */
		{ extend: 'pageLength'}
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".Eliminar", function(e){
			e.preventDefault();
			var id = $(this).closest('tr').find('td:eq(0) .Eliminar').val();
			var tecnico = $(this).closest('tr').find('td:eq(1)').text();

			$detalleIncidencia = {
                HeadIncidenciaId : $HEADINCIDENCIA,
                Descripcion      : 'Elimina Técnico '+ tecnico,
			}

			alertify.confirm('Eliminar Técnico Incidencia', '¿Está seguro de eliminar el tecnico ' + tecnico + ' de la asignación?', function(){
				mRastreo = 'Eliminar Técnico [id: ' + data.Cedula + ', nombre: ' + tecnico + '] Incidencia [Id: '+ id + ', Nro: ' + $HEADINCIDENCIA  + ']';
				eliminarTecnicosAsignados(id, mRastreo, 'Agendar Incidencia', data.Cedula, $detalleIncidencia, tecnico);
			}, function(){});
		});

		$(row).on("click", ".btnCancelarEdicion", function(e){
			e.preventDefault();
			$("#CrearAsignarTecnicos").prop("disabled", false);
			dtTbTecnicosAsignados.ajax.reload();
			listaTecnicos();
		});
	} 
});

var dtTbCerrarActividad = $('#TblCerrarActividad').DataTable({
	language,
	processing: true,
	pageLength: 25,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
		{width: '1%', targets: [0]}
		,{className: 'text-center', targets: [0]}
	],
	ajax: {
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/qListaActividadesLogTiempo",
		type: 'POST',
		data: function(d){
			return  $.extend(d, {HeadIncidenciaId: $HEADINCIDENCIA});
		}
	},
	columns: [
		{
			data: 'Accion',
			render: function(nTd, sData, oData, iRow, iCol){
				if(oData.Accion == undefined){
					return `<div class="btn-group btn-group-xs">
								<button type="button" logIni="${oData.logTiempoInico}" logFin="${oData.logTiempoFin}" class="editar btn btn-success" title="Editar"><i class="far fa-edit"></i></button>
								<button type="button" logIni="${oData.logTiempoInico}" logFin="${oData.logTiempoFin}" class="eliminar btn btn-danger" title="Eliminar"><i class="far fa-trash-alt"></i></button>
							</div>`;
				} else {
					return oData.Accion;
				}
			}
		},
		{data: 'NombreUsuario'},
		{data: 'NombreActividad'},
		{data: 'FechaInicio'},
		{
			data: 'HoraInicio',
			render: function(nTd, sData, oData, iRow, iCol){
				if(oData.Nuevo == 1){
					return oData.HoraInicio;
				} else {
					return moment(oData.HoraInicio, 'HH:mm:ss').format('hh:mm A')
				}
			}
		},
		{data: 'FechaFin'},
		{
			data: 'HoraFin',
			render: function(nTd, sData, oData, iRow, iCol){
				if(oData.Nuevo == 1){
					return oData.HoraFin;
				} else {
					return moment(oData.HoraFin, 'HH:mm:ss').format('hh:mm A')
				}
			}
		},
	],
	dom: domBftrip,
	buttons: [
		/* { extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2,3,4,5]}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2,3,4,5]}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2,3,4,5]}} */
		{ extend: 'pageLength'}
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var logini   = $(this).closest('tr').find('td:eq(0) .eliminar').attr("logini");
			var logfin   = $(this).closest('tr').find('td:eq(0) .eliminar').attr("logfin");

			var nombreactividad =  $(this).closest('tr').find('td:eq(2)' ).text().trim();
			var nombretecnico   =  $(this).closest('tr').find('td:eq(1)').text().trim();

			$detalleIncidencia = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				Descripcion      : 'Elimina Actividad '+ nombreactividad +  ' Tecnico : ' + nombretecnico,
			}

			alertify.confirm('Eliminar Registro log tiempo', '¿Está seguro de eliminar el registro de la actividad?', function(){
				mRastreo = 'Eliminar Registro LogTiempo Incidencia [id: ' + $HEADINCIDENCIA + ', Nro: ' + $("#Numero").val() +'],  Inicio ' + logini + ' log tiempo Fin ' + logfin;
				eliminarLogTiempo(logini,logfin, mRastreo,$detalleIncidencia);
			}, function(){});
		});

		$(row).on("click", ".editar", function(e){
			e.preventDefault();
			if (cerrarActividadesEditar == true) {
				cerrarActividadesEditar = false;

				$("[id=btnCerrarActividad]").prop("disabled", true);
		   
				$(row).find('td:eq(1)').attr('contenteditable', false);
				$(row).find('td:eq(2)').attr('contenteditable', false);
				$(row).find('td:eq(3)').attr('contenteditable', true);
				$(row).find('td:eq(4)').attr('contenteditable', true);
				$(row).find('td:eq(5)').attr('contenteditable', true);
				$(row).find('td:eq(6)').attr('contenteditable', true);
	
				$(row).find('td:eq(2)').html(selectActividades);
				$(row).find('td:eq(3)').html(FechaInicialActividad);
				$(row).find('td:eq(4)').html(HoraInicialActividad);
				$(row).find('td:eq(5)').html(FechaFinalActividad);
				$(row).find('td:eq(6)').html(HoraFinalActividad);
	
				$(row).find('td:eq(2) select').val(data.TipoActividadId);
				$(row).find('td:eq(3) input').val(data.FechaInicio);
				$(row).find('td:eq(4) input').val(moment(data.HoraInicio, 'HH:mm:ss').format('hh:mm A'));
				$(row).find('td:eq(5) input').val(data.FechaFin);
				$(row).find('td:eq(6) input').val(moment(data.HoraFin, 'HH:mm:ss').format('hh:mm A'));
	
				$(row).find('td:eq(0) .editar i').removeClass("far fa-edit").addClass('far fa-save');
				$(row).find('td:eq(0) .editar').attr('title', "Actualizar").removeClass('editar').addClass("actualizar");
				$(row).find('td:eq(0) .btn-danger').attr('title', "Cancelar edición").removeClass("eliminar").addClass('btnCancelarEdicionAct');
				$(row).find('td:eq(0) .btnCancelarEdicionAct i').removeClass("far fa-trash-alt").addClass("fas fa-times");
				$(row).find('td:eq(2)').focus();
	
				$(row).find('.datepicker').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es'
				});
	
				$(row).find('.timepickerLT').datetimepicker({
					format: 'hh:mm A'
				});
	
				$('.chosen-select').chosen({
					placeholder_text_single: 'Seleccione'
					,width: '100%'
					,no_results_text: 'Oops, no se encuentra'
					,allow_single_deselected: true
				});
			} else {
				alertify.warning("Ya hay una activdad creandose o editandose actualmente");
			}
		});

		$(row).on("click", ".actualizar", function(e){
			e.preventDefault();

			if ($(this).closest('tr').find('td:eq(2) select').val() == '' || $(this).closest('tr').find('td:eq(3) input').val() == ''
				|| $(this).closest('tr').find('td:eq(4) input').val() == '' || $(this).closest('tr').find('td:eq(5) input').val() == ''
				|| $(this).closest('tr').find('td:eq(6) input').val() == '') {
				alertify.warning("Verificar que todos los campos esten llenos");
				return;
			}

			var FechaIni =  moment($(this).closest('tr').find('td:eq(3) input').val() + ' ' + $(this).closest('tr').find('td:eq(4) input').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");
			var FechaFin =  moment($(this).closest('tr').find('td:eq(5) input').val() + ' ' + $(this).closest('tr').find('td:eq(6) input').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");
			var logini   =  $(this).closest('tr').find('td:eq(0) .actualizar').attr("logini");
			var logfin   =  $(this).closest('tr').find('td:eq(0) .actualizar').attr("logfin");

			if(FechaIni > FechaFin){
				alertify.warning("Verificar que la Fecha y Hora inical no sea Mayor a la Final");
				return;
			}

			var nombreactividad =  $(this).closest('tr').find('td:eq(2) select option:selected' ).text().trim();
			var nombretecnico   =  $(this).closest('tr').find('td:eq(1)').text().trim();

			$dataIni = {
				Fecha        : FechaIni,
				TipoActividadId : $(this).closest('tr').find('td:eq(2) select').val(),
			}

			$dataFin = {
				Fecha        : FechaFin,
				TipoActividadId : $(this).closest('tr').find('td:eq(2) select').val(),
			}

			 $detalleIncidencia = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				Descripcion      : 'Actualiza Actividad '+ nombreactividad +  ', Técnico: ' + nombretecnico + ', Tiempos: '+ moment(FechaIni, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A') +' - ' + moment(FechaFin, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A'),
			}

			mRastreo = 'Actualiza registro log de tiempo en agendamiento: Actividad '+ nombreactividad + ', Inicidencia [id: ' + $HEADINCIDENCIA + ', Nro: ' + $("#Numero").val() + ']';
			actualizarLogTiempo($dataIni,$dataFin,logini,logfin,mRastreo,$detalleIncidencia);
			cerrarActividadesEditar = true;
		});

		$(row).on("click", ".btnGuardarACT", function(e){
			e.preventDefault();

			if ($(this).closest('tr').find('td:eq(1) select').val() == '' || $(this).closest('tr').find('td:eq(2) select').val() == '' 
				|| $(this).closest('tr').find('td:eq(3) input').val() == ''
				|| $(this).closest('tr').find('td:eq(4) input').val() == '' || $(this).closest('tr').find('td:eq(5) input').val() == ''
				|| $(this).closest('tr').find('td:eq(6) input').val() == '') {
				alertify.warning("Verificar que todos los campos esten llenos");
				return;
			}

			var FechaIni = moment($(this).closest('tr').find('td:eq(3) input').val() + ' ' + $(this).closest('tr').find('td:eq(4) input').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");
			var FechaFin = moment($(this).closest('tr').find('td:eq(5) input').val() + ' ' + $(this).closest('tr').find('td:eq(6) input').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");

			if(FechaIni > FechaFin){
				alertify.warning("Verificar que la Fecha y Hora inical no sea Mayor a la Final");
				return
			}

			var nombreactividad =  $(this).closest('tr').find('td:eq(2) select option:selected' ).text().trim();
			var nombretecnico   =  $(this).closest('tr').find('td:eq(1) select option:selected').text().trim();


			$dataIni = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				UsuarioId        : $(this).closest('tr').find('td:eq(1) select').val(),
				Fecha            : FechaIni,
				Estado           : 'I',
				TipoActividadId  : $(this).closest('tr').find('td:eq(2) select').val(),
			}

			$dataFin = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				UsuarioId        : $(this).closest('tr').find('td:eq(1) select').val(),
				Fecha            : FechaFin,
				Estado           : 'T',
				TipoActividadId  : $(this).closest('tr').find('td:eq(2) select').val(),
			}

			$detalleIncidencia = {
				HeadIncidenciaId : $HEADINCIDENCIA,
				Descripcion      : 'Guarda Actividad '+ nombreactividad +  ', Técnico: ' + nombretecnico + ', Tiempos: '+ moment(FechaIni, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A') +' - ' + moment(FechaFin, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A'),
			}

			mRastreo = 'Guarda registro log de tiempo en agendamiento: Actividad '+ nombreactividad + ', Inicidencia [id: ' + $HEADINCIDENCIA + ', Nro: ' + $("#Numero").val() + ']';
			guardarLogTiempo($dataIni,$dataFin,mRastreo,$detalleIncidencia);

			cerrarActividadesEditar = true;
		});

		$(row).on("click", ".btnCancelarEdicionAct", function(e){
			e.preventDefault();
			$("#btnCerrarActividad").prop("disabled", false);
			cerrarActividadesEditar = true;
			listaActividadesLogTiempo();
			dtTbCerrarActividad.ajax.reload();
		});

		$(row).find('.datepicker').datetimepicker({
			format: 'YYYY-MM-DD',
			locale: 'es'
		});

		$(row).find('.timepickerLT').datetimepicker({
			format: 'hh:mm A'
		});

		$(row).click('.input-group-append.input-group-addon', function(e){
			e.preventDefault();
		});
	} 
});

var dtTbHistorialIncidencia = $('#TblHistorialIncidencia').DataTable({
	language,
	processing: true,
	pageLength: 25,
	ordering: false,
	dom: domBftrip,
	lengthMenu: [
		[10, 25, 50, -1]
		,['10', '25', '50', 'Todo']
	],
	ajax: {
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/qHistorialIncidencia",
		type: 'POST',
		data: function(d){
			return  $.extend(d, {HeadIncidenciaId: $HEADINCIDENCIA});
		}
	},
	columns: [
		{
			data: 'FechaRegis',
			render: function(nTd, sData, oData, iRow, iCol){
				return moment(oData.FechaRegis, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A");
			}
		},
		{data: 'nombre'},
		{data: 'DetalleP'}
	],
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel'},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF'},
		{ extend: 'print', className: 'printButton', text: 'Imprimir'},
		{ extend: 'pageLength'}
	] 
});

$(function(){

	bsCustomFileInput.init();

	$('.chosen-select').chosen({
		placeholder_text_single: 'Seleccione'
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	});

	$("#TipoPrioridadIncidenciaId").on('change', function(){
		var Tiempo = $(this).find("option:selected").data("tiempo");
		var frecuencia = $(this).find("option:selected").data("frecuencia");
		
		$('#tiemporespuesta input').val(Tiempo);
		$('#tiemporespuesta span').text(frecuencia);
	});

	$("#EstadoIncidenciaId").on('change', function(){
		var color = $('#EstadoIncidenciaId option:selected').data("color");
		var cierre = $('#EstadoIncidenciaId option:selected').data("cierre");
		$('#color').css('background',color);
		
		//Validamos que la incidencia la esten editando
		if($HEADINCIDENCIA > 0){
			if (cierre == 1) {
				$(".dateFecha, #CrearAsignarTecnicos, .asignado, .Eliminar, #DetalleNota, #form-imageAnexos, #btnCerrarActividad, .editar, .eliminar, .btnCancelarEdicionAct, .btnGuardarACT").prop("disabled", true);
				$("#TipoPrioridadIncidenciaId, #TipoIncidenciaId, #OperacionId, #Privado").prop("disabled", true).trigger("chosen:updated");
			} else {
				$(".dateFecha, #CrearAsignarTecnicos, .asignado, .Eliminar, #DetalleNota, #form-imageAnexos, #btnCerrarActividad, .editar, .eliminar, .btnCancelarEdicionAct, .btnGuardarACT").prop("disabled", false);	
				$("#TipoPrioridadIncidenciaId, #TipoIncidenciaId, #OperacionId, #Privado").prop("disabled", false).trigger("chosen:updated");
			}
		}
	});

	$("#frmRegistrarAgendamiento")[0].reset();

	//Cambio del itemEquipo para cambiar la operación y el serial
	$("#ItemEquipoId").on("change", function(){
		selectOperaciones($(this).val());
		$("#Serial").val($('#ItemEquipoId option:selected').data("serial"));
	});

	var calendarEl = document.getElementById('calendar');
	calendar = new FullCalendar.Calendar(calendarEl, {
		headerToolbar: {
			left: 'prev,next today',
			center: 'title', 
			right: 'dayGridMonth,timeGridWeek,timeGridDay'
		} 
		,locale: 'es-us'
		,timeZone: 'local'
		,initialDate: new Date()
		,nowIndicator: true
		,navLinks: true // can click day/week names to navigate views
		,weekNumbers: true
		,selectable: true
		,selectMirror: true
		,selectOverlap: true
		,allDaySlot: false
		,select: function(arg) {
			$("#frmRegistrarAgendamiento")[0].reset();

			$("#Asunto, #Descripcion").prop("disabled", false);
			
			$("#FechaIni").val(moment(arg.start).format('YYYY-MM-DD'));
			$("#HoraIni").val(moment(arg.start).format('hh:mm A'));

			if(arg.view.type == 'dayGridMonth'){
				$("#FechaFin").val(moment(arg.end).add("-1", "days").format('YYYY-MM-DD'));
				$("#HoraFin").val(moment(arg.end).add("+30", "minutes").format('hh:mm A'));
			} else {
				$("#FechaFin").val(moment(arg.end).format('YYYY-MM-DD'));
				$("#HoraFin").val(moment(arg.end).format('hh:mm A'));
			}
			
			$('#color').css('background', '');
			$("#tiemporespuesta span").html('&nbsp;&nbsp;&nbsp;');
			$('.chosen-select').trigger('chosen:updated');

			$(".verEditarCol").removeClass("col-md-2").addClass("col-md-3");
			$("#calendar, .verEditar").addClass('d-none');
			$("#CrearEditar, .verCrear").removeClass('d-none');

			$(".dateFecha, #CrearAsignarTecnicos, .asignado, .Eliminar, #DetalleNota, #form-imageAnexos, #btnCerrarActividad, .editar, .eliminar, .btnCancelarEdicionAct, .btnGuardarACT").prop("disabled", false);	
			$("#TipoPrioridadIncidenciaId, #ItemEquipoId, #TipoIncidenciaId, #OperacionId, #Privado").prop("disabled", false).trigger("chosen:updated");
		}
		,eventClick: function(arg) {
			mostrarIncidencia(arg.event.extendedProps);
		}
		,eventDidMount: function(info) {
			if (info.event.extendedProps.Numero != undefined) {
				$(info.el).attr("title", "Nro " + info.event.extendedProps.Numero + ' | ' + info.event.extendedProps.Asunto);
				$(info.el).attr("data-content", info.event.extendedProps.Descripcion);
				$(info.el).attr("data-toggle", "popover");
				$(info.el).attr("data-trigger", "hover");
	
				$(info.el).popover();
			}
		}
		,editable: true
		,dayMaxEvents: true // allow "more" link when too many events
		,events: {
			url: base_url() + "Administrativo/Incidencia/cAgendarIncidencia/incidencias"
			,type: 'GET'
			,cache: false
			,display: 'block'
		}
		,eventResize: function(arg){
			var idInci = arg.event.extendedProps.HeadIncidenciaId; 
			var FechaIni = moment(arg.event.start).format("YYYY-MM-DD HH:mm:ss");
			var FechaFin = moment(arg.event.end).format("YYYY-MM-DD HH:mm:ss");
			actualizarFechas(FechaIni, FechaFin, idInci);
			$(".popover").removeClass("show");
			//calendar.refetchEvents();
		}
		,eventDrop: function(arg){
			var idInci = arg.event.extendedProps.HeadIncidenciaId; 
			var FechaIni = moment(arg.event.start).format("YYYY-MM-DD HH:mm:ss");
			var FechaFin = moment(arg.event.end).format("YYYY-MM-DD HH:mm:ss");
			actualizarFechas(FechaIni, FechaFin, idInci);
			$(".popover").removeClass("show");
			//calendar.refetchEvents();
		}
	});

	calendar.render();

	$("#CrearAsignarTecnicos").on("click", function(e){
		e.preventDefault();
		var row = {
			'Accion': "<button type='button' class='btnGuardarOPT btn btn-success btn-xs mr-1' title='Guardar'><i class='far fa-save'></i></button><button type='button' class='btn btn-danger btn-xs btnCancelarEdicion' title='Cancelar'><i class='fas fa-times'></i></button>",
			'Nombre': selectTecnicosIncidencia,
			'Cedula': '' 
		}

		dtTbTecnicosAsignados.row.add(row).draw();
		$("#TblTecnicosAsignados tbody tr").first().find("td").eq(1).focus();
		$(this).attr('disabled', true);

		$('.unico').chosen({
			placeholder_text_single: 'Seleccione'
			,width: '100%'
			,no_results_text: 'Oops, no se encuentra'
			,allow_single_deselected: true
		});

	});

	$("#Cancelar").on("click", function(e){
		$HEADINCIDENCIA = 0;
		$("#frmRegistrarAgendamiento")[0].reset();
		$("#calendar").removeClass('d-none');
		$("#CrearEditar").addClass('d-none');
		$(document).scrollTop(0);
		calendar.refetchEvents();
	});

	//Esta funcion falta por verificar
	$('#ActualizarAgenda').on('click', function(e){
		$HEADINCIDENCIA = 0;
		$("#frmRegistrarAgendamiento")[0].reset();
		$("#calendar").removeClass('d-none');
		$("#CrearEditar").addClass('d-none');
		calendar.refetchEvents();
		alertify.success('Incidencia actualizada.');
		$(document).scrollTop(0);
	});

	$("#TblTecnicosAsignados").on("click", ".btnGuardarOPT", function(e){
		e.preventDefault();
		if ($(this).closest('tr').find('td:eq(1)').text().trim() == '') {
			alertify.warning("Verificar que todos los campos esten llenos");
			return;
		}
	
		var tecnicoId = $(this).closest('tr').find('td:eq(1) select').val();
		var tecnico = $(this).closest('tr').find("td:eq(1) select option[value='" + tecnicoId + "']").text(); 
	
		var $data = {
			UsuarioId   : $(this).closest('tr').find('td:eq(1) select').val(),
			HeadIncidenciaId : $HEADINCIDENCIA,
			Estado  : 'A'
		};
	
		$detalleIncidencia = {
			HeadIncidenciaId : $HEADINCIDENCIA,
			Descripcion      : 'Asigna Técnico '+ tecnico,
		}
		
		mRastreo = 'Asigna Tecnico Incidencia: [id: ' + tecnicoId + ', nombre: ' + tecnico + '], Incidencia [id: ' + $HEADINCIDENCIA + ', Nro: ' + $("#Numero").val() + ']';
	
		agregarTecnicos($data, 'Agendar Incidencia', mRastreo, tecnicoId, tecnico, $detalleIncidencia);
	});

	$("#btnCerrarActividad").on("click", function(e){
		e.preventDefault();
		
		var row = {
			'Accion': `<div class="btn-group btn-group-xs">
					<button type="button" class="btnGuardarACT btn btn-success" title="Guardar"><i class="fas fa-save"></i></button>
					<button type="button" class="btnCancelarEdicionAct btn btn-danger" title="Cancelar"><i class="fas fa-times"></i></button>
				</div>`,
			'NombreUsuario': listatecnicosInc,
			'NombreActividad': selectActividades, 
			'FechaInicio': FechaInicialActividad,
			'HoraInicio': HoraInicialActividad,
			'FechaFin': FechaFinalActividad,
			'HoraFin': HoraFinalActividad,
			'Nuevo': '1'
		}

		dtTbCerrarActividad.row.add(row).draw();
		$("#TblCerrarActividad tbody tr").first().find("td").eq(1).focus();
		$(this).attr('disabled', true);

		cerrarActividadesEditar = false;

		$('.unico').chosen({
			placeholder_text_single: 'Seleccione'
			,width: '100%'
			,no_results_text: 'Oops, no se encuentra'
			,allow_single_deselected: true
		});
		
	});

	// Formulario de guardar incidencia
	$('#guardarAgenda').on('click', function(e){
		e.preventDefault();	   
		
		if ($("#ItemEquipoId").val() == null) {
			alertify.error("Seleccion un Equipo");
			$("#ItemEquipoId").focus();
			return false;
		}

		if ($("#TipoIncidenciaId").val() == null) {
			alertify.error("Seleccione un tipo de incidencia");
			$("#TipoIncidenciaId").focus();
			return false;
		}
	
		if ($("#Asunto").val().trim() == "") {
			alertify.error("Ingrese el Asunto");
			$("#Asunto").focus();
			return false;
		}
	
		if ($("#Descripcion").val().trim() == "") {
			alertify.error("Ingrese la Descripción");
			$("#Descripcion").focus();
			return false;
		}
	
		var form_data = new FormData(document.getElementById("frmRegistrarAgendamiento"));
	  
		$.ajax({
			url: base_url() + 'Administrativo/Incidencia/cAgendarIncidencia/crear',
			type:'POST',
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false,
			data: form_data,
			success:function(respuesta) {
				if (respuesta == 0) {
					alertify.error("Registro no guardado");
				} else {
					try {
						respuesta = JSON.parse(respuesta);
						HeadIncidenciaId = respuesta[0];
						$HEADINCIDENCIA = respuesta[0];
						Numero = respuesta[1];
						var html = '';
						if(respuesta[2] == '[]'){
							alertify.alert(`
							<div class="navbar-brand border-0 text-center">
								<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
							</div>`, 
							`<div class="item active text-center">
								<span>Incidencia enviada satisfactoriamente</span>
								<h3>N° Incidencia</h3>
								<div class="alert alert-secondary text-center display-4 font-weight-normal">
									${Numero}
								</div>
							</div>`, 
							function() {
								$("#Numero").val(Numero);
								mostrarIncidencia(0);
							});
						} else {
							var subidas = JSON.parse(respuesta[2]);
							if(subidas.length > 0){
								html += '<div class="text-center">Archivos Subidos</div>';
								for (var i = 0; i < subidas.length; i++) {
									if(subidas[i]['estado'] == 1){
										var alert = 'success',
										icon = 'check-circle';
									} else {
										var alert = 'danger',
										icon = 'fa-exclamation-circle';
									}
									var subida = `<div class='alert alert-${alert}' role='alert'>
													<span class='fas fa-${icon}' aria-hidden='true'></span> ${subidas[i]['nombre']}
												</div>`;
									html += subida;
								}

								html += `<div class="item active text-center">
											<span>Incidencia enviada satisfactoriamente</span>
											<h3>N° Incidencia</h3>
											<div class="alert alert-secondary text-center display-4 font-weight-normal">
												${Numero}
											</div>
										</div>`;

								alertify.alert(`
									<div class="navbar-brand border-0 text-center">
										<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
									</div>`,
									html, function(){
										$("#Numero").val(Numero);
										mostrarIncidencia(0);
									}
								);
							} else {
								alertify.alert(`
								<div class="navbar-brand border-0 text-center">
									<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
								</div>`, 
								`<div class="item active text-center">
									<span>Incidencia enviada satisfactoriamente</span>
									<h3>N° Incidencia</h3>
									<div class="alert alert-secondary text-center display-4 font-weight-normal">
										${Numero}
									</div>
								</div>`, 
								function() {
									$("#Numero").val(Numero);
									mostrarIncidencia(0);
								});
							}
						}
					} catch(e) {
						//console.log(respuesta);
						//console.error(e.message);
						alertify.error("Error al guardar los datos");
					}
				}
			}
		});
	});

	$(".chosen-container").on("click", function(){
		valorAnt = $(this).siblings('select').val();
		if(valorAnt == null){
			valorAnt = '';
		}
	});

	$(".headIncidencia").on("change", function() {
		if($HEADINCIDENCIA > 0){
			campo = $(this).attr('name');
			valor = $(this).val();
			valorAnterior = $(this).find("option[value='" + valorAnt + "']").text();
			valorNuevo = $(this).find("option[value='" + valor + "']").text();
			
			if (valorAnt == '') {
				msj = 'Se actualiza incidencia nro ' + $("#Numero").val() + ' campo ' + $(this).data("nombre") + ' a "' + valorNuevo + '".';
				historial = "Cambio de " + $(this).data("nombre") + " a " + valorNuevo;
			} else {
				msj = 'Se actualiza incidencia nro ' + $("#Numero").val() + ' campo ' + $(this).data("nombre") + ' de "' + valorAnterior + '" a "' + valorNuevo + '".';
				historial = "Cambio de " + $(this).data("nombre") + " (" + valorAnterior + " => " + valorNuevo + ")";
			}

			$.ajax({
				url: base_url() + "Administrativo/Incidencia/cTramitarIncidencia/actualizar",
				data: {
					HeadIncidenciaId: $HEADINCIDENCIA
					,campo
					,valor
					,RASTREO: RASTREO(msj, 'Agendar Incidencia')
					,historial
				},
				type: 'POST',
				success:function(respuesta) {
					if (respuesta == 1) {
						alertify.success('Incidencia actualizada.');
	
						if(campo == 'ItemEquipoId'){
							dtTbActividadIncidencia.ajax.reload();
						}

						dtTbHistorialIncidencia.ajax.reload();
					} else {
						alertify.error("Ocurrió un problema al momento de actualizar la Inciencia.");
						
					}
				},
				error: function(error) {
					console.log(error);
					alertify.notify('error', 'error', 5);
				}
			});
			
		}
	});

	$("#DetalleNota").keyup(function() {
		if ($("#DetalleNota").val().trim() != "") {
			$("#btn_enviarNota").prop("disabled", false);
		} else {
			$("#btn_enviarNota").prop("disabled", true);
		}
	});

	$("#frmNota").submit(function(e) {
		e.preventDefault();

		if (typeof FormData !== 'undefined') {
			var form_data = new FormData(document.getElementById("frmNota"));
			form_data.append('HeadIncidenciaId', $HEADINCIDENCIA);
			form_data.append('Estado', 'A');
			form_data.append('Privado', $("#Privado").val());
			form_data.append('Descripcion', $("#DetalleNota").val());
			form_data.append('cambio', 'Asigna Nota a la incidencia [id: ' + $HEADINCIDENCIA + ', Nro: ' + $('#Numero').val() + ', Descripcion: ' + $("#DetalleNota").val() + ']');
			form_data.append('programa', 'Agendar Incidencia');

	
			$.ajax({
				url: base_url() + "Administrativo/Incidencia/cTramitarIncidencia/do_upload",
				data: form_data,
				type: "POST",
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success:function(respuesta) {
					try {
						var subidas = JSON.parse(respuesta);
						var html = '';
						if (subidas.length > 0) {
							for (var i = 0; i < subidas.length; i++) {
								if(subidas[i]['estado'] == 1) {
									var alert   = 'success',
										icon    = 'check-circle';
								} else {
									var alert   = 'danger',
										icon    = 'fa-exclamation-circle';
								}
								html = `<div class='alert alert-${alert}' role='alert'>
											<span class='fas fa-${icon}' aria-hidden='true'></span> ${subidas[i]['nombre']}
										</div>`;
							}
							
							alertify.alert('Archivos Subidos',
								html
								,function() {
								
							});
							
						} else {
							alertify.success("Se agrego una nota.");
						}
						
						$("#frmNota")[0].reset();
						$('.chosen-select').trigger("chosen:updated");
						anexosAgenda();

					} catch(e) {
						alertify.error("Ocurrió un problema al momento de agregar la nota.");
					}
				},
				error: function(error) {
					alertify.notify('error', 'error', 5);
				}
			});
		}
	});
	
	//Ocultar las imagenes de las notas
	$(document).on('click', '.btn-hidden', function(e) {
		e.preventDefault();
		var selector = $(this).closest('.div-hidden').find('[data-ocultar]');
		var btn = this;
		selector.slideToggle(400, function() {
			if ($(this).css('display') == 'none') {
				$('span', btn).removeClass('fa-arrow-alt-circle-up').addClass('fa-arrow-alt-circle-down');
			} else {
				$('span', btn).removeClass('fa-arrow-alt-circle-down').addClass('fa-arrow-alt-circle-up');
			}
		});
	});

	//Guardamos los cambios en la fechas
	$(".datepicker, .timepickerLT").on("dp.change", function(e){
		var FechaIni = moment($('#FechaIni').val() + ' ' + $('#HoraIni').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");
		var FechaFin = moment($('#FechaFin').val() + ' ' + $('#HoraFin').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");

		if ((FechaIni != FechaInicioAgenda || FechaFin != FechaFinAgenda) && $HEADINCIDENCIA > 0) {
			actualizarFechas(FechaIni, FechaFin)
		}
	});
	
	//Colocar el scroll en 0 para la notas
	$("#collapseNotas").on('shown.bs.collapse', function(){
		$("#contenedorNotas").scrollTop(0);
	});
});

function mostrarIncidencia(incidencia){
	if (incidencia != '0') {
		$HEADINCIDENCIA = incidencia.HeadIncidenciaId;
		
		for(var key in incidencia){
			valor = incidencia[key];
			if($('#'+key).is('select')){
				if($('#'+key).not('.chos-unit').hasClass('chosen-select') && valor != null){
					$('#'+key).val(valor).trigger('chosen:updated');
				}else{
					$('#'+key).val(valor).trigger('chosen:updated');
				}
			}else{
				$('#'+key).val(valor);
			}
		}
	
		var Tiempo = $('#TipoPrioridadIncidenciaId option:selected').data("tiempo");
		var frecuencia = $('#TipoPrioridadIncidenciaId option:selected').data("frecuencia");
	
		var color = $('#EstadoIncidenciaId option:selected').data("color");
		$('#color').css('background', color);
		
		$('#tiemporespuesta input').val(Tiempo);
		$('#tiemporespuesta span').text(frecuencia);
	
		$("#FechaIni").val(moment(incidencia.FechaIni).format('YYYY-MM-DD'));
		$("#FechaFin").val(moment(incidencia.FechaFin).format('YYYY-MM-DD'));
		$("#HoraIni").val(moment(incidencia.FechaIni).format('hh:mm A'));
		$("#HoraFin").val(moment(incidencia.FechaFin).format('hh:mm A'));
		
		selectOperaciones(incidencia.ItemEquipoId, incidencia.OperacionId);

		// Guardamos las fechas del agendamiento
		FechaInicioAgenda = moment(incidencia.FechaIni).format("YYYY-MM-DD HH:mm:ss");
		FechaFinAgenda = moment(incidencia.FechaFin).format("YYYY-MM-DD HH:mm:ss");
 	}else{
		// Guardamos las fechas del agendamiento
		FechaInicioAgenda = moment($('#FechaIni').val() + ' ' + $('#HoraIni').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");
		FechaFinAgenda = moment($('#FechaFin').val() + ' ' + $('#HoraFin').val(), 'YYYY-MM-DD hh:mm A').format("YYYY-MM-DD HH:mm:ss");
	}

	$("#Asunto, #Descripcion").prop("disabled", true);
	$("#ItemEquipoId").prop("disabled", true).trigger("chosen:updated");
		
	dtTbActividadIncidencia.ajax.reload();
	dtTbHistorialIncidencia.ajax.reload();
	listaTecnicos();
	listaActividadesLogTiempo();
	anexosAgenda();
	actualizarAlertaIncidencia();
	
	$(".card-header").addClass("collapsed");
	$(".collapse").removeClass("show");

	$(".verEditarCol").removeClass("col-md-3").addClass("col-md-2");
	$("#CrearEditar, .verEditar").removeClass('d-none');
	$("#calendar, .verCrear").addClass('d-none');

	//Validamos si estado tiene cierre
	setTimeout(() => {
		if ($('#EstadoIncidenciaId option:selected').data("cierre") == 1) {
			$(".dateFecha, #CrearAsignarTecnicos, .asignado, .Eliminar, #DetalleNota, #form-imageAnexos, #btnCerrarActividad, .editar, .eliminar, .btnCancelarEdicionAct, .btnGuardarACT").prop("disabled", true);
			$("#TipoPrioridadIncidenciaId, #TipoIncidenciaId, #OperacionId, #Privado").prop("disabled", true).trigger("chosen:updated");
		} else {
			$(".dateFecha, #CrearAsignarTecnicos, .asignado, .Eliminar, #DetalleNota, #form-imageAnexos, #btnCerrarActividad, .editar, .eliminar, .btnCancelarEdicionAct, .btnGuardarACT").prop("disabled", false);	
			$("#TipoPrioridadIncidenciaId, #TipoIncidenciaId, #OperacionId, #Privado").prop("disabled", false).trigger("chosen:updated");
		}
	}, 1000);
}

function selectOperaciones(ItemEquipoId, OperacionId = ''){	
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cAgendarIncidencia/listaOperacion",
		type  : "POST",
		dataType: 'json',
		data: {
			ItemEquipoId
		},
		success: function(resultado){			
			$("#OperacionId").empty();
			$("#OperacionId").append('<option value="" disabled selected>Seleccione</option>');
			
			$.each(resultado, function(){
				$("#OperacionId").append('<option value="'+this.OperacionId+'">'+this.Operacion+'</option>');
			});

			$('#OperacionId').val(OperacionId).trigger('chosen:updated');
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}

function listaTecnicos(){
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/listaTecnicos",
		type  : "POST",
		dataType: 'json',
		data: {
			HeadIncidenciaId : $HEADINCIDENCIA,
		},
		success: function(resultado){

			selectTecnicosIncidencia = '<select class="unico chosen-select custom-select custom-select-sm">';
			$.each(resultado, function(){
			   selectTecnicosIncidencia += '<option value="'+this.UsuarioId+'">'+this.Nombre+'</option>';
			});
			selectTecnicosIncidencia += '</select>';

			$("#CrearAsignarTecnicos").attr('disabled', false);
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}

function eliminarAgregaActividad(id, rastreo, mensaje, estado, $detalleIncidencia){
	
	var datos = {
			HeadIncidenciaId : $HEADINCIDENCIA,
			TipoActividadId  : id
		}

	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/eliminarAgregaActividad",
		type: "POST",
		async: false,
		data: {
			id: id,
			estado :estado,
			datos  :datos,
			HeadIncidenciaId : $HEADINCIDENCIA,
			detalleIncidencia : $detalleIncidencia,
			RASTREO: RASTREO(rastreo, mensaje)
		}, success: function(resultado) {
			if(resultado == 1){
				alertify.success($detalleIncidencia["Descripcion"]);
				dtTbActividadIncidencia.ajax.reload();
				$("#CrearAsignarTecnicos").attr('disabled', false);
				dtTbHistorialIncidencia.ajax.reload();
			} else {
				alertify.error("!Error, comuniquese con el administrador del sistema");
			}
		}
	});
}

function agregarTecnicos(data, mensaje, Rastreo, tecnicoId, tecnico, $detalleIncidencia){
	var datosUpdate = {
			Estado :'A'
		}

	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/agregarTecnicos",
		type: "POST",
		async: false,
		data: {
			id: tecnicoId,
			datos: data,
			datosUpdate: datosUpdate,
			HeadIncidenciaId: $HEADINCIDENCIA,
			detalleIncidencia : $detalleIncidencia,
			RASTREO: RASTREO(Rastreo, mensaje)
		}, 
		success: function(resultado) {
			if(resultado == 1){
				
				alertify.success("Se asigna técnico: " + tecnico);
				dtTbTecnicosAsignados.ajax.reload();
				listaTecnicos();
				listaActividadesLogTiempo();
				dtTbHistorialIncidencia.ajax.reload();
			} else {
				alertify.error("!Error, no se guardo el registro; comuniquese con el administrador del sistema");
			}
		}
	});
}

function eliminarTecnicosAsignados(id, rastreo, mensaje, UsuarioId, $detalleIncidencia, tecnico){
	
	var datos = {
			Estado : 'I'
		}

	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/eliminarTecnicosAsignados",
		type: "POST",
		async: false,
		data: {
			id: id,
			UsuarioId: UsuarioId,
			HeadIncidenciaId : $HEADINCIDENCIA,
			detalleIncidencia : $detalleIncidencia,
			datos  :datos,
			RASTREO: RASTREO(rastreo, mensaje)
		}, success: function(resultado) {
			html = '';
			if(resultado == 1){

				alertify.success("Se elimina técnico " + tecnico);
				dtTbTecnicosAsignados.ajax.reload();
				listaTecnicos();
				listaActividadesLogTiempo();
				dtTbHistorialIncidencia.ajax.reload();
			} else {
				alertify.error("!Error, no se eliminar el registro; comuniquese con el administrador del sistema");
			}
		}
	});
}

function listaActividadesLogTiempo(){
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/listaActividadesLogTiempo",
		type  : "POST",
		dataType: 'json',
		data: {
			HeadIncidenciaId : $HEADINCIDENCIA,
		},
		success: function(datos){
			
			selectActividades = '<select class="unico chosen-select  custom-select custom-select-sm">';
			$.each(datos[0], function(){
			   selectActividades += '<option value="'+this.TipoActividadId+'">'+this.Nombre+'</option>';
			});
			selectActividades += '</select>';

			listatecnicosInc = '<select class="unico chosen-select custom-select custom-select-sm">';
			$.each(datos[1], function(){
			   listatecnicosInc += '<option value="'+this.UsuarioId+'">'+this.Nombre+'</option>';
			});
			listatecnicosInc += '</select>';

			$("#CrearAsignarTecnicos").attr('disabled', false);
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}

function actualizarLogTiempo($dataIni,$dataFin,$logini,$logfin,mRastreo, $detalleIncidencia){
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/actualizarLogTiempo",
		type  : "POST",
		data: {
			dataIni : $dataIni,
			dataFin : $dataFin,
			logini  : $logini,
			logfin  : $logfin,
			detalleIncidencia : $detalleIncidencia,
			RASTREO: RASTREO(mRastreo, 'Agendar Incidencia')
		},
		success: function(resultado){
			datos =JSON.parse(resultado);
			if(datos == 1){
				alertify.success('Registro Actualizado exitosamente.');
				$("#btnCerrarActividad").prop("disabled", false);
				listaActividadesLogTiempo();
				dtTbCerrarActividad.ajax.reload();
				dtTbHistorialIncidencia.ajax.reload();
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}

function guardarLogTiempo($dataIni,$dataFin,mRastreo,$detalleIncidencia){
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/guardarLogTiempo",
		type  : "POST",
		data: {
			dataIni : $dataIni,
			dataFin : $dataFin,
			detalleIncidencia : $detalleIncidencia,
			RASTREO: RASTREO(mRastreo, 'Agendar Incidencia')
		},
		success: function(resultado){
			datos =JSON.parse(resultado);
		   if(datos == 1){
				alertify.success('Registro Guardado exitosamente.');
				$("#btnCerrarActividad").prop("disabled", false);
				listaActividadesLogTiempo();
				dtTbCerrarActividad.ajax.reload();
				dtTbHistorialIncidencia.ajax.reload();
		   }
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}

function eliminarLogTiempo($logini,$logfin,mRastreo,$detalleIncidencia){
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/eliminarLogTiempo",
		type  : "POST",
		data: {
			logini : $logini,
			logfin : $logfin,
			detalleIncidencia : $detalleIncidencia,
			RASTREO: RASTREO(mRastreo, 'Agendar Incidencia')
		},
		success: function(resultado){
			datos =JSON.parse(resultado);
		   if(datos == 1){
				alertify.success('Registro eliminado exitosamente.');
				$("#btnCerrarActividad").prop("disabled", false);
				listaActividadesLogTiempo();
				dtTbCerrarActividad.ajax.reload();
		   }
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}

function actualizarFechas(FechaIni, FechaFin, idIncidencia = 0){
	if (FechaIni > FechaFin) {
		alertify.error("La fecha final es mayor a la incial.");
		return;
	}

	var data = {
		FechaIni : FechaIni,
		FechaFin : FechaFin
	}

	if(idIncidencia == 0){
		idIncidencia = $HEADINCIDENCIA;
	}
  
	$.ajax({
		url: base_url() + "Administrativo/Incidencia/cAgendarIncidencia/actualiarFechaAgenda",
		data: {
		   data : data,
		   HeadIncidenciaId:  idIncidencia
		},
		type: 'POST',
		success:function(respuesta) {
			if (respuesta == 1) {
				FechaInicioAgenda = FechaIni;
				FechaFinAgenda = FechaFin;
				alertify.success('Incidencia actualizada.');
			} else {
				alertify.error("Ocurrió un problema al momento de actualizar la Inciencia.");    
			}
		},
		error: function(error) {
			console.log(error);
			alertify.notify('error', 'error', 5);
		}
	});
}

function actualizarAlertaIncidencia(){
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cAgendarIncidencia/actualizarAlertaIncidencia",
		type  : "POST",
		dataType: 'json',
		data: {
			HeadIncidenciaId: $HEADINCIDENCIA,
		},
		success: function(resp){			
			if (resp == 0) {
				alertify.error("No se ha actualizado el estado de la alerta de esta incidencia.");
			}
		},
		error: function(error){
			alertify.alert('Error, no se ha actualizado el estado de la incidencia');
			//console.log(error);
		}
	});
}

function anexosAgenda(){
	$("#notas").empty();
	$.ajax({
		url: base_url()+"Administrativo/Incidencia/cTramitarIncidencia/anexosAgenda",
		type: "POST",
		dataType: 'json',
		data: {
			HeadIncidenciaId : $HEADINCIDENCIA,
		},
		success: function(resultado){
			for (var i = 0; i < resultado.length; i++) {
				 $("#notas").append(resultado[i]);
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			//console.log(error);
		}
	});
}