var dtVehiculo;
var config = {
	data:{
		tblID : "#tblVehiculo",
		select: [
			"'' AS Acciones"
			,"TV.TerceroVehiculoId"
			,"TVE.Nombre"
			,"TV.Placa"
			,"Tv.Marca"
			,"TV.Modelo"
			,"TV.Color"
			,"TV.Cilindraje"
		],
		table : [
			"TerceroVehiculo TV",
			[
				["TipoVehiculo TVE","TV.TipoVehiculoId = TVE.TipoVehiculoId","LEFT"]
			],
			[
				["TV.TerceroID = '"+$CC+"'"]
			]
		],
		group_by: [
		],
		column_order : [
			"Acciones"
			,"TerceroVehiculoId"
			,"Nombre"
			,"Placa"
			,"Marca"
			,"Modelo"
			,"Color"
			,"Cilindraje"
		],
		column_search : [
			"TV.TerceroVehiculoId"
			,"TVE.Nombre"
			,"TV.Placa"
			,"Tv.Marca"
			,"TV.Modelo"
			,"TV.Color"
			,"TV.Cilindraje"
		],
		orden : {"TV.TerceroVehiculoId": 'desc'},
		columnas : [
			"Acciones"
			,"TerceroVehiculoId"
			,"Nombre"
			,"Placa"
			,"Marca"
			,"Modelo"
			,"Color"
			,"Cilindraje"
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
		$(row).on("click", '.eliminar', function(e){
			e.preventDefault();
			alertify.confirm('Eliminar vehículo', 'Está seguro de eliminar el vehículo ?', function(){
				$.ajax({
					url: base_url() + "Propietario/TerceroVehiculo/cTerceroVehiculo/eliminarVehiculo",
					type: 'POST',
					async: false,
					data: {
						Id 		: data[1],
						RASTREO : RASTREO("Elimina vehiculo [Tipo de vehiculo : "+data[2]+" - "+data[3]+"]","Autorizar visitantes")
					},
					success: function(respuesta){
						if (respuesta == 1) {
							alertify.alert("Atención",msgAlerta.succesElimina,function(){
								dtVehiculo.draw();
							});
						}else{
							alertify.alert("Atención",msgAlerta.errorAdmin);
							return;
						}
					}
				});
			}, function() { }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
		});
	},
	columnDefs:[
		{visible: false, targets:[1], width: '5%'},
	],
	deferRender: true,
	scrollY: $(document).height() - 420,
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
	dtVehiculo = dtSS(config);
});

$('select.chosen-select').chosen({
	placeholder_text_single: ''
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
});

$(".toUpper").keyup(function(){
	$(this).val($(this).val().toUpperCase().trim());
});

$("#placa").on("change",function(){
	if ($(this).val() != '') {
		var self = this;
		if (verificaPlaca($(this).val()) == 1) {
			$(this).val("");
			alertify.alert("Atención","El numero de placa digitado ya existe en el sistema.",function(){
				setTimeout(function(){ $(self).focus() },0)
			});
		}
	}
})

$("#frmVehiculo").on('submit',function(e){
	e.preventDefault();
	if ($("#tipoVehi").val() != '') {
		var datos = {
			TerceroID 		: $CC,
			TipoVehiculoId 	: $("#tipoVehi").val(),
			Placa 			: $("#placa").val().trim(),
			Marca 			: $("#marca").val(),
			Modelo 			: $("#modelo").val(),
			Color 			: $("#color").val(),
			Cilindraje 		: $("#cilindraje").val()
		}

		$.ajax({ 
			url: base_url() + "Propietario/TerceroVehiculo/cTerceroVehiculo/guardarDatos",
			type: 'POST',
			async: false,
			data: {
				Data 	: datos,
				RASTREO : RASTREO('Registra nuevo vehiculo [Tipo de vehiculo : '+(datos.TipoVehiculoId == null ? "Sin vehiculo" :  ($("#tipoVehi").find("option:selected").text() +" : "+datos.Placa))+']','Autorizar visitantes')
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				if (respuesta == 1) {
					alertify.alert("Atención",msgAlerta.successSimple,function(){
						dtVehiculo.draw();
						$("#frmVehiculo").find(".form-control").each(function(){
							if ($(this).is("select")) {
								$(this).val("").trigger("chosen:updated");
							}else{
								$(this).val("");
							}
						})
					});
				}else{
					alertify.alert("Atención",msgAlerta.errorAdmin);
					return;
				}
			}
		});
	}else{
		alertify.alert("Atención",msgAlerta.camposObliga);
		return;
	}
})

function verificaPlaca(placa){
	var resp = 0;
	$.ajax({ 
		url: base_url() + "Propietario/TerceroVehiculo/cTerceroVehiculo/verificaPlaca",
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