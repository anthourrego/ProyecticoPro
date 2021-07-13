dataAjax = {
	Id : ''
}

var dtHistorico = $('#tblHistorico').DataTable({
	language,
	dom: domBftrip,
	processing: true,
	pageLength: 10,
	ajax: {
		url: 'cIncidente/qHistorico',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Fecha'},
		{
			data: 'FechaRegis',
			render: function(nTd, sData, oData, iRow, iCol){
				return moment(oData.FechaRegis, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A");
			}
		},
		{data: 'Usuario'},
		{data: 'Zona'},
		{data: 'Observacion'},
	],
	createdRow: function(row, data, dataIndex){
	},
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
		{ extend: 'excel', action: newExportAction, text: 'Excel' },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
		{ extend: 'print', className: 'printButton', text: 'Imprimir' },
		{ extend: 'pageLength'},
	]
});

$('.chosen').chosen({
	placeholder_text_single: 'Seleccione:'
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){
	setTimeout(function(){$("#observacion").focus()},0)
});

$('.date').datetimepicker({
	format: 'YYYY-MM-DD',
	locale: 'es'
});

$("#frmRegistro").submit(function(e){
	e.preventDefault();
	var datos = {
		Fecha 			: $("#fecha").val(),
		HeadZonaPlanoId	: $("#chZona").val(),
		Observacion 	: $("#observacion").val(),
		Tipo 			: 'I',
		Estado 			: 'F'
	}

	$.ajax({ 
		url: base_url() + "Porteria/Incidente/cIncidente/guardarValores",
		type: 'POST',
		async: false,
		data: {
			Data 	: datos,
			RASTREO : RASTREO("Genera nuevo incidente/daño [Fecha : "+$("#fecha").val()+" - "+$("#chTipoSer").find("option:selected").text()+"]","Servicios")
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta == 1) {
				alertify.alert("Atención",msgAlerta.successSimple,function(){
					limpiarForm();
					dtHistorico.ajax.reload();
				});
			}
		}
	});
})

function limpiarForm(){
	$("#frmRegistro").find(".form-control").each(function(){
		$(this).val("").trigger("chosen:updated");
	})
}