var DTtblCRUD,
$IDGlobal = '';
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
			,"PIN.FechaRegis"
			,"PIN.Observacion"
			,"CASE PIN.Estado WHEN 'A' THEN 'Activo' ELSE '' END AS Estado"
		],
		table : [
			"ProgIngreso PIN",
			[
				["TipoVehiculo TV","PIN.TipoVehiculoId = TV.TipoVehiculoId","LEFT"]
			],
			[
				["PIN.TerceroId = '"+$CC+"' AND PIN.ViviendaId = '"+$ID+"' AND PIN.Tipo = 'A' AND PIN.Estado = 'A'"]
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
			,"FechaRegis"
			,"Observacion"
			,"Estado"
		],
		column_search : [
			"PIN.ProgIngresoId"
			,"PIN.Cedula"
			,"PIN.Nombre"
			,"TV.Nombre"
			,"PIN.Placa"
			,"PIN.FechaRegis"
			,"CASE PIN.Estado WHEN 'A' THEN 'Activo' ELSE '' END"
		],
		orden : {"Cedula": 'desc'},
		columnas : [
			"Acciones"
			,"ProgIngresoId"
			,"Cedula"
			,"Nombre"
			,"nomVehi"
			,"Placa"
			,"FechaRegis"
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

		$(row).find("td:eq(5)").html(moment(data[6], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
		$(row).on("click", '.eliminar', function(e){
			e.preventDefault();
			alertify.confirm('Eliminar autorización', 'Está seguro de eliminar la autorización del visitante ?', function(){
				$.ajax({
					url: base_url() + "Propietario/AutorizarVisitante/cAutorizarVisitante/eliminarAutorizacion",
					type: 'POST',
					async: false,
					data: {
						Id 		: data[1],
						RASTREO : RASTREO("Elimina autorizacion visitante [Cedula : "+data[2]+"] [Visitante : "+data[3]+"]","Autorizar visitantes")
					},
					success: function(respuesta){
						if (respuesta == 1) {
							alertify.alert("Atención",msgAlerta.succesElimina);
							DTtblCRUD.draw();
						}else{
							alertify.alert("Atención",msgAlerta.errorAdmin);
							return;
						}
					}
				});
			}, function() { DTtblCRUD.draw() }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
		});
	},
	columnDefs:[
		{visible: false, targets:[1], width: '5%'},
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

$(document).ready(function(){
	DTtblCRUD = dtSS(config);
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

$("#invi").on("shown.bs.collapse",function(){
	DTtblCRUD.draw();
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

$("#cedula").on("change",function(){
	if ($(this).val() != '') {
		obtenerDataCedula($(this).val());
	}
});

$("input[type=file]").change(function(){
	leerImg(this);
});

$("#frmIngreso").on('submit',function(e){
	e.preventDefault();
	datos = {
		TipoVehiculoId 	: $("#tipoVehi").val() != '' ? $("#tipoVehi").val() : null,
		Placa 			: $("#placa").val() != '' ? $("#placa").val() : null,
		Cedula 			: $("#cedula").val(),
		Nombre 			: $("#nombre").val(),
		Observacion 	: $("#observacion").val() != '' ? $("#observacion").val() : null,
		Tipo 			: 'A',
		Estado 			: 'A',
		ViviendaId 		: $ID,
		TerceroID 		: $CC,
		Id 				: $IDGlobal
	}

	if ($IDGlobal == '' && $(".anexo").val() == '') {
		alertify.alert("Atención","Debe de diligenciar todos los campos obligatorios (*)");
		return;
	}

	if(typeof FormData !== 'undefined'){
		var datos = {
			TipoVehiculoId 	: $("#tipoVehi").val() != '' ? $("#tipoVehi").val() : null,
			Placa 			: $("#placa").val() != '' ? $("#placa").val() : null,
			Cedula 			: $("#cedula").val(),
			Nombre 			: $("#nombre").val(),
			Observacion 	: $("#observacion").val() != '' ? $("#observacion").val() : null,
			Tipo 			: 'A',
			Estado 			: 'A',
			ViviendaId 		: $ID,
			TerceroID 		: $CC,
		}

		var rastreo = ''+($IDGlobal != '' ? "Actualiza autorizacion" : "Registra nueva")+' autorización de visitante [Tipo : Autorización] [Cedula: '+datos.Cedula+'] [Nombre: '+datos.Nombre+'] [Tipo de vehiculo : '+(datos.TipoVehiculoId == null ? "Sin vehiculo" :  ($("#tipoVehi").find("option:selected").text() +" : "+datos.Placa))+']';
		
		var form_data = new FormData();
		form_data.append('file', $('.anexo')[0].files[0]);
		form_data.append('TipoVehiculoId', datos.TipoVehiculoId);
		form_data.append('Placa', datos.Placa);
		form_data.append('Cedula', datos.Cedula);
		form_data.append('Nombre', datos.Nombre);
		form_data.append('Observacion', datos.Observacion);
		form_data.append('Tipo', datos.Tipo);
		form_data.append('Estado', datos.Estado);
		form_data.append('ViviendaId', datos.ViviendaId);
		form_data.append('TerceroID', datos.TerceroID);
		form_data.append('GID', $IDGlobal);
		form_data.append('RASTREO', RASTREO(rastreo,"Autorizar visitantes"));
		$.ajax({	
			url: base_url() + "Propietario/AutorizarVisitante/cAutorizarVisitante/guardarDatos",
			type:"POST",
			async		: false,
			cache		: false,
			contentType : false,
			processData : false,
			data:form_data,	
			success:function(respuesta){
				respuesta = JSON.parse(respuesta);
				switch (respuesta.Tipo) {
					case 'NA':
						$('.fotoIngreso').css('background-image', "none");
						break;
					case 'ERROR':
						$('.fotoIngreso').css('background-image', "none");
						break;
					case 'CREA':
						alertify.alert("Atención",msgAlerta.successSimple,function(){
							DTtblCRUD.draw();
							limpiarForm();
						})
						break;
					case 'ACTUALIZA':
						alertify.alert("Atención",msgAlerta.successSimple,function(){
							DTtblCRUD.draw();
							limpiarForm();
						})
						break;
					default:
						// statements_def
						break;
				}
			}
		});
	}
})

function verificaPlaca(placa){
	var resp = 0;
	$.ajax({ 
		url: base_url() + "Propietario/AutorizarVisitante/cAutorizarVisitante/verificaPlaca",
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
		url: base_url() + "Propietario/AutorizarVisitante/cAutorizarVisitante/obtenerDataCedula",
		type: 'POST',
		async: false,
		data: {
			Num	: cedula,
		},
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (respuesta.nombre != '')
					$("#nombre").val(respuesta.nombre[0].Nombre);
				if (respuesta.data.length > 0) {
					$IDGlobal = respuesta.data[0].ProgIngresoId;
					$("#tipoVehi").val(respuesta.data[0].TipoVehiculoId).trigger("chosen:updated");
					$("#placa").val(respuesta.data[0].Placa);
					$("#nombre").val(respuesta.data[0].Nombre);
					$("#observacion").val(respuesta.data[0].Observacion);
					$('.fotoIngreso').css('background-image', ("url('"+base_url()+respuesta.data[0].Foto+"')"));
				}
			} catch(e) {
				alertify.alert("Atención",msgAlerta.errorAdmin)
				console.log(e);
			}
		}
	});
}

function leerImg(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		var bg = null;
		reader.onload = function (e) {
			var background = e.target.result;
			bg = background;
			$('.fotoIngreso').css('background-image', ("url('"+background+"')"));
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function limpiarForm(){
	$("#cedula,#nombre,#placa,#observacion, .anexo").val("");
	$('.fotoIngreso').css('background-image', "none");
	$("#tipoVehi").val("").trigger("chosen:updated");
	$IDGlobal = '';
	setTimeout(function(){ $("#cedula").focus() },1020)
}