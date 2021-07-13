var DT;
var config = {data:{
		tblID : "#tblCRUD",
		select: [
			'R.rastreoid'
			,'R.usuarioid'
			,'R.almacenid'
			,"FORMAT(R.fecha,'dd/MM/yyyy HH:mm:ss') fecha"
			,"FORMAT(R.fechaservidor,'dd/MM/yyyy HH:mm:ss') fechaservidor"
			,'R.cambio'
			,'R.programa'
			,'R.equipo'
			,'R.Aplicacion'
		],
		table : [
			"Rastreo R",
			null
		],
		column_order : [
			'R.rastreoid'
			,'R.usuarioid'
			,'R.almacenid'
			,'R.fecha'
			,'R.fechaservidor'
			,'R.cambio'
			,'R.programa'
			,'R.equipo'
			,'R.Aplicacion'
		],
		column_search : [
			'R.cambio'
			,'R.programa'
		],
		orden : {"R.rastreoid": 'DESC'},
		columnas : [
			'rastreoid'
			,'usuarioid'
			,'almacenid'
			,'fecha'
			,'fechaservidor'
			,'cambio'
			,'programa'
			,'equipo'
			,'Aplicacion'
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'DESC']],
	draw: 10,
	language,
	fixedColumns: true,
	pageLength: 10,
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Residente - ' + $TITULO} },
		{ className: 'btnFiltros', text: 'Filtros'}
	],
	initComplete: function(){
		$('div.dataTables_filter input').unbind();
		$("div.dataTables_filter input").keyup( function (e) {
			e.preventDefault();
			if (e.keyCode == 13) {
				table = $("body").find("#tblCRUD").dataTable();
				table.fnFilter( this.value );
			}
		} );
		$('div.dataTables_filter input').focus();
	},
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 295,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{visible: false, targets:[0, -1]}
		,{width: '125', targets:[3,4,6]}
		,{width: '1%', targets:[1,2,7]}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find("td:eq(2)").html(moment(data[3], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
		$(row).find("td:eq(3)").html(moment(data[4], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
	}
}

$(document).on('click', '.btnFiltros', function(e){
	e.preventDefault();
	$('#myModal').modal('show');
});

function filtrojson(){
	var filtros = {
		UsuarioId: $('#UsuarioId').val()
		,Opciones: $('#Opciones').val()
		,fInicial: $('#fInicial').val()
		,fFinal: $('#fFinal').val()
	}
	$('[name=json]').val(JSON.stringify(filtros));
}

$('.chos-unit select').chosen({
	placeholder_text_single: 'Usuario:'
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
});

$('select').change(function(){
	filtrojson();
});

$('#frmCRUD').on('focusout', '.datepicker input', function(){
	filtrojson();
});

$(document).ready(function(){
	if($JSON != ''){
		$JSON = JSON.parse($JSON);
		var WHERES = [];

		if($JSON.UsuarioId && $JSON.UsuarioId != ''){
			$('#UsuarioId').val($JSON.UsuarioId).trigger('chosen:updated');
			var WHERE = "R.UsuarioId = '"+$JSON.UsuarioId+"'";
			WHERES.push([WHERE]);
		}
		if($JSON.Opciones && $JSON.Opciones != ''){
			$('#Opciones').val($JSON.Opciones).trigger('chosen:updated');
			var WHERE = "R.programa = '"+$JSON.Opciones+"'";
			WHERES.push([WHERE]);
		}

		if($JSON.fInicial){
			$('#fInicial').val($JSON.fInicial);
		}
		if($JSON.fFinal){
			$('#fFinal').val($JSON.fFinal);
		}
		if(($JSON.fInicial && $JSON.fInicial != '') && ($JSON.fFinal && $JSON.fFinal != '')){
			var WHERE = "CAST(R.Fecha AS DATE) BETWEEN '"+$JSON.fInicial+"' AND '"+$JSON.fFinal+"'";
			WHERES.push([WHERE]);
		}else if($JSON.fInicial && $JSON.fInicial != ''){
			var WHERE = "CAST(R.Fecha AS DATE) >= '"+$JSON.fInicial+"'";
			WHERES.push([WHERE]);
		}else if($JSON.fFinal && $JSON.fFinal != ''){
			var WHERE = "CAST(R.Fecha AS DATE) <= '"+$JSON.fFinal+"'";
			WHERES.push([WHERE]);
		}

		config.data.table.push(WHERES);
	}
	filtrojson();

	config.data.select.push("'"+$JSON.fInicial+"' AS PInicial");
	config.data.select.push("'"+$JSON.fFinal+"' AS PFinal");

	DT = dtSS(config);
});