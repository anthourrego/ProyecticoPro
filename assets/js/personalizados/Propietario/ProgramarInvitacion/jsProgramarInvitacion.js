var DTtblCRUD, DTtblCRUD2;
var config = {
	data:{
		tblID : "#tblIngreso",
		select: [
			"'' AS Acciones"
			,"PIN.ProgIngresoId"
			,"PIN.Cedula"
			,"PIN.Nombre"
			,"TV.Nombre AS nomVehi"
			,"PIN.Placa"
			,"PIN.Fecha"
			,"PIN.Observacion"
			,"CASE PIN.Tipo WHEN 'P' THEN 'Pendiente' ELSE '' END AS Estado"
		],
		table : [
			"ProgIngreso PIN",
			[
				["TipoVehiculo TV","PIN.TipoVehiculoId = TV.TipoVehiculoId","LEFT"]
			],
			[
				["PIN.TerceroId = '"+$CC+"' AND PIN.ViviendaId = '"+$ID+"' AND PIN.Tipo = 'P' AND PIN.Estado = 'A'"]
			]
		],
		group_by: [
		],
		column_order : [
			"Acciones"
			,"ProgIngresoId"
			,"Cedula"
			,"Nombre"
			,"nomVehi"
			,"Placa"
			,"Fecha"
			,"Observacion"
			,"Estado"
		],
		column_search : [
			"PIN.ProgIngresoId"
			,"PIN.Cedula"
			,"PIN.Nombre"
			,"TV.Nombre"
			,"PIN.Placa"
			,"PIN.Fecha"
			,"PIN.Observacion"
			,"CASE PIN.Estado WHEN 'P' THEN 'Pendiente' ELSE '' END"
		],
		orden : {"Cedula": 'desc'},
		columnas : [
			"Acciones"
			,"ProgIngresoId"
			,"Cedula"
			,"Nombre"
			,"nomVehi"
			,"Placa"
			,"Fecha"
			,"Observacion"
			,"Estado"
		]
	},
	autoWidth: false,
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="eliminar btn btn-danger btn-xs" value="`+data[1]+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>
		`);
		if (data[8] == 'Pendiente') {
			$(row).find('td:eq(7)').html(`
				<center>
					<div class="btn-group btn-group-xs">
						<button class="btn btn-warning btn-xs" style="margin-bottom:3px"><span>Pendiente</span></button>
					</div>
				</center>
			`);
		}
		$(row).on("click", '.eliminar', function(e){
			e.preventDefault();
			alertify.confirm('Eliminar invitación', 'Está seguro de eliminar la invitación ?', function(){
				$.ajax({
					url: base_url() + "Propietario/Ingreso/cIngreso/eliminarInvitacion",
					type: 'POST',
					async: false,
					data: {
						Id 		: data[1],
						RASTREO : RASTREO("Elimina invitacion [Cedula : "+data[2]+"] [Visitante : "+data[3]+"] [Fecha : "+data[4]+"]","Programar invitaciones")
					},
					success: function(respuesta){
						if (respuesta == 1) {
							alertify.success("Datos eliminados correctamente.");
							DTtblCRUD.draw();
						}else{
							alertify.alert("Atención","¡Error! los datos no han sido guardados correctamente, comuniquese con el administrador del sistema.");
							return;
						}
					}
				});
			}, function() { DTtblCRUD.draw() }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
		});
	},
	columnDefs:[
		{visible: false, targets:[1]},
		{width: '5%', targets:[1]}
	],
	deferRender: true,
	scrollY: $(document).height() - 520,
	scrollX: true,
	scroller: {
	    loadingIndicator: true
	},
	dom: domBftri,
	pageLength: 3,
	processing: true,
	serverSide: true,
	order: [],
	draw: 3,
	language,
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
		{ extend: 'csv', className: 'csvButton', text: 'CSV' },
		{ extend: 'excel', action: newExportAction, text: 'Excel' },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
		{ extend: 'print', className: 'printButton', text: 'Imprimir' }
	]
}
var config2 = {
	data:{
		tblID : "#tblHistorico",
		select: [
			"Cedula"
			,"Nombre"
			,"I.Acomp"
			,"PIN.Email"
			,"CASE I.Estado WHEN 'I' THEN PIN.Fecha ELSE null END AS FechaIng"
			,"CASE I.Estado WHEN 'I' THEN 'Ingreso' ELSE 'Salida' END AS Tipo"
			,"I.Fecha"
			,"I.Observacion"
		],
		table : [
			"ProgIngreso PIN",
			[
				["Ingreso I","PIN.ProgIngresoId = I.ProgIngresoId","LEFT"]
			],
			[
				["Tipo = 'P' AND PIN.Estado IN('A','F') AND (TerceroID = '"+$CC+"') "]
			]
		],
		group_by: [
		],
		column_order : [
			"Cedula"
			,"Nombre"
			,"Acomp"
			,"Email"
			,"FechaIng"
			,"Tipo"
			,"Fecha"
			,"Observacion"
		],
		column_search : [
			"Cedula"
			,"Nombre"
			,"I.Acomp"
			,"PIN.Email"
			,"CASE I.Estado WHEN 'I' THEN PIN.Fecha ELSE '' END"
			,"CASE I.Estado WHEN 'I' THEN 'Ingreso' ELSE 'Salida' END"
			,"I.Fecha"
			,"I.Observacion"
		],
		orden : {"Cedula": 'desc'},
		columnas : [
			"Cedula"
			,"Nombre"
			,"Acomp"
			,"Email"
			,"FechaIng"
			,"Tipo"
			,"Fecha"
			,"Observacion"
		]
	},
	autoWidth: false,
	createdRow: function(row, data, dataIndex){
		switch (data[5]) {
			case 'Ingreso':
				$(row).find('td:eq(5)').html(`
					<center>
						<div class="btn-group btn-group-xs w-100">
							<button class="btn btn-primary btn-xs btnSE" style="margin-bottom:3px"><span>Ingreso</span></button>
						</div>
					</center>
				`);
				break;
			case 'Salida':
				$(row).find('td:eq(5)').html(`
					<center>
						<div class="btn-group btn-group-xs w-100">
							<button class="btn btn-secondary btn-xs btnSE " style="margin-bottom:3px"><span>Salida</span></button>
						</div>
					</center>
				`);
				break;
			default:
				break;
		}
	},
	columnDefs:[
		//{visible: false, targets:[1]}
	],
	deferRender: true,
	scrollY: $(document).height() - 620,
	scrollX: true,
	scroller: {
	    loadingIndicator: true
	},
	dom: domBftri,
	pageLength: 3,
	processing: true,
	serverSide: true,
	order: [],
	draw: 3,
	language,
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
		{ extend: 'csv', className: 'csvButton', text: 'CSV' },
		{ extend: 'excel', action: newExportAction, text: 'Excel' },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
		{ extend: 'print', className: 'printButton', text: 'Imprimir' }
	]
}

$(document).ready(function(){
	DTtblCRUD = dtSS(config);
	DTtblCRUD2 = dtSS(config2);
	if ($ID == '') {
		alertify.alert("Atención","No es posible programar invitaciones dado que no tiene una vivienda asignada.",function(){
			$("#cedula,#nombre,#fecha,#observacion,#placa").prop("disabled",true);
			$("#tipoVehi").prop("disabled",true).trigger("chosen:updated");
		});
	}
})

$('select.chosen-select').chosen({
	placeholder_text_single: ''
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
});

$(".toUpper").keyup(function(){
	if ($(this).attr('id') == 'placa') {
		$(this).val($(this).val().toUpperCase().trim());
	}else{
		$(this).val($(this).val().toUpperCase());
	}
});

$('.numerico').inputmask({
	alias 		: 'integer',
	rightAlign 	: false
});

$('.date').datetimepicker({
	format: 'YYYY-MM-DD',
	locale: 'es'
});

$("#invi").on("shown.bs.collapse",function(){
	DTtblCRUD.draw();
})

$("#hInvi").on("shown.bs.collapse",function(){
	DTtblCRUD2.draw();
})

$("#cedula").on("change",function(){
	if ($(this).val() != '') {
		obtenerDataCedula($(this).val());
	}
})

$("#placa").on("change",function(){
	if ($(this).val() != '') {
		var self = this;
		if (verificaPlaca($(this).val()) == 1) {
			$(this).val("");
			alertify.alert("Atención","El numero de placa digitado ya existe en el sistema y pertenece a un (Propietario,residente,arrendatario) del conjunto.",function(){
				setTimeout(function(){ $(self).focus() },0)
			});
		}
	}
});

$("#btnCancelar").on("click",function(e){
	e.preventDefault();
	$("#cedula,#nombre,#fecha,#observacion").val("");
})

$("#frmIngreso").on('submit',function(e){
	e.preventDefault();
	datos = {
		TipoVehiculoId 	: $("#tipoVehi").val() != '' ? $("#tipoVehi").val() : null,
		Placa 			: $("#placa").val() != '' ? $("#placa").val() : null,
		Cedula 			: $("#cedula").val(),
		Nombre 			: $("#nombre").val(),
		Fecha			: $("#fecha").val(),
		Observacion 	: $("#observacion").val(),
		Tipo 			: 'P',
		Estado 			: 'A',
		ViviendaId 		: $ID
	}

	$.ajax({ 
		url: base_url() + "Propietario/ProgramarInvitacion/cProgramarInvitacion/guardarDatos",
		type: 'POST',
		async: false,
		data: {
			Data 	: datos,
			RASTREO : RASTREO('Registra nuevo ingreso [Tipo : Visita] [Cedula: '+datos.Cedula+'] [Nombre: '+datos.Nombre+'] [Fecha : '+datos.Fecha+']','Programar visitas')
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta == 1) {
				alertify.alert("Registro guardado exitosamente",'<div class="alert alert-success" role="alert" style="font-size: 15px;">La invitación a sido programada exitosamente, recuerde validar en invitaciones pendientes.</div>',function(){
					DTtblCRUD.draw();
					$("#frmIngreso").find(".form-control").each(function(){
						if ($(this).is("select")) {
							$(this).val("").trigger("chosen:updated");
						}else{
							$(this).val("");
						}
					})
				});
			}else{
				alertify.alert("Error","La invitación no ha podido ser guardada exitosamente, comuniquese con el administrador del sistema.");
				return;
			}
		}
	});
});

$(document).on("click",".btnSE",function(e){
	e.preventDefault();
})

function validarVivienda(){
	$.ajax({ 
		url: base_url() + "Propietario/ProgramarInvitacion/cProgramarInvitacion/validarVivienda",
		type: 'POST',
		async: false,
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta.length > 0) {
				$ID = respuesta[0].ViviendaId;
			}else{
				alertify.alert("Atención","No es posible programar invitaciones dado que no tiene una vivienda asignada.");
				$("#cedula,#nombre,#fecha,#observacion").prop("disabled",true);
				return;
			}
		}
	});
}

function verificaPlaca(placa){
	var resp = 0;
	$.ajax({ 
		url: base_url() + "Propietario/ProgramarInvitacion/cProgramarInvitacion/verificaPlaca",
		type: 'POST',
		async: false,
		data: {
			Placa 	: placa,
		},
		success: function(respuesta){
			resp = JSON.parse(respuesta);
		}
	});
	return resp;
}

function obtenerDataCedula(cedula){
	$.ajax({ 
		url: base_url() + "Propietario/ProgramarInvitacion/cProgramarInvitacion/obtenerDataCedula",
		type: 'POST',
		async: false,
		data: {
			Num	: cedula,
		},
		success: function(respuesta){
			if (respuesta == 1) {
				alertify.alert("Atención","El numero de cedula digitado ya se encuentra programado, porfavor verificar en invitaciones pendientes.",function(){
					$("#cedula").val("");
				});
			}
			if (respuesta == 2) {
				alertify.alert("Atención","El numero de cedula digitado ya se encuentra registrado en el sistema como ingreso autorizado, verificar en opcion(Autorizar visitantes).",function(){
					$("#cedula").val("");
				});
			}
		}
	});
}
