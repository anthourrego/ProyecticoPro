var DT;
var config = {data:{
		tblID : "#tblCRUD",
		select : [
			'A.Numero'
			,'A.Descripcion'
			,"FORMAT(A.Creada,'dd/MM/yyyy HH:mm:ss') AS Creada"
			,"FORMAT(A.Programada,'dd/MM/yyyy HH:mm:ss') AS Programada"
			,"FORMAT(A.Ejecutada,'dd/MM/yyyy HH:mm:ss') AS Ejecutada"
			,`CASE
				WHEN A.Tipo = 'PQ' THEN 'PQR'
				WHEN A.Tipo = 'QR' THEN 'PQR'
				WHEN A.Tipo = 'IN' THEN 'Incidencia'
			END AS Tipo`
		],
		table : [
			'Alerta A'
			,[]
			,[
				["A.AsignadoA", $USR]
				,["A.Tipo NOT IN ('MN')"]
			]
		],
		column_order : [
			'A.Numero'
			,'A.Descripcion'
			,'Creada'
			,"Programada"
			,'A.Ejecutada'
			,'Tipo'
		],
		column_search : [
			'A.Numero'
        	,'A.Descripcion'
        	,'Creada'
        	,"Programada"
        	,'A.Ejecutada'
        	,'Tipo'
		],
		orden : {"Creada": 'ASC'},
		columnas : [
			'Descripcion'
			,'Creada'
			,'Programada'
			,'Ejecutada'
			,'Tipo'
		],
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
	scrollY: $(document).height() - 360,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{width: '25%', targets:[0]}
		,{width: '10%', targets:[1,2,3]}
		,{width: '15%', targets:[4]}
	],
	createdRow: function(row, data, dataIndex){
		$(row).find("td:eq(1)").html(moment(data[1], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
		$(row).find("td:eq(2)").html(moment(data[2], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
	}
}

$(document).on('click', '.btnFiltros', function(e){
	e.preventDefault();
	$('#myModal').modal('show');
});

function filtrojson(){
	var filtros = {
		Tipo: $('#tipo').val()
		,TipoFecha: $('#tipoFecha').val()
		,fInicial: $('#fInicial').val()
		,fFinal: $('#fFinal').val()
	}
	$('[name=json]').val(JSON.stringify(filtros));
}

$('.chos-unit').chosen({
	placeholder_text_single: 'Opción:'
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
		var tipo = $JSON.Tipo.split(',');
		var stringTipo = ''

		if($JSON.Tipo && $JSON.Tipo != ''){
			console.log(tipo);
			for (let i = 0; i < tipo.length; i++) {
				if (i == 0) {
					stringTipo = "'" + tipo[i] + "'";
				} else {
					stringTipo = stringTipo + ", '" + tipo[i] + "'";
				}
			}

			$('#tipo').val($JSON.Tipo).trigger('chosen:updated');
			var WHERE = "A.Tipo IN ("+stringTipo+")";
			config.data.table[2].push([WHERE]);
		}
		if($JSON.fInicial){
			$('#fInicial').val($JSON.fInicial);
		}
		if($JSON.fFinal){
			$('#fFinal').val($JSON.fFinal);
		}
		if(($JSON.fInicial && $JSON.fInicial != '') && ($JSON.fFinal && $JSON.fFinal != '')){
			var WHERE = "CAST(A."+$JSON.TipoFecha+" AS DATE) BETWEEN '"+$JSON.fInicial+"' AND '"+$JSON.fFinal+"'";
			config.data.table[2].push([WHERE]);
		}else if($JSON.fInicial && $JSON.fInicial != ''){
			var WHERE = "CAST(A."+$JSON.TipoFecha+" AS DATE) >= '"+$JSON.fInicial+"'";
			config.data.table[2].push([WHERE]);
		}else if($JSON.fFinal && $JSON.fFinal != ''){
			var WHERE = "CAST(A."+$JSON.TipoFecha+" AS DATE) <= '"+$JSON.fFinal+"'";
			config.data.table[2].push([WHERE]);
		}
	}
	filtrojson();

	config.data.select.push("'"+$JSON.fInicial+"' AS PInicial");
	config.data.select.push("'"+$JSON.fFinal+"' AS PFinal");

	DT = dtSS(config);
});