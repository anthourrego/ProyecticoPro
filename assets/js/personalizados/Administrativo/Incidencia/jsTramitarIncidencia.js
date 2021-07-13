var DT;
var tblIncidencias = false;
var altura = $(document).height();

$(function(){
	$(".chosen-select").chosen({width: '100%'});

	cargarFiltros();
	
	$("#btnCargar").click(function(e){

		filtros = [];
		filtros["fechaIni"] = $("#fecha1").val();
		filtros["fechaFin"] = $("#fecha2").val();

		if ($("#fecha1").val() > $("#fecha2").val()) {
			return alertify.warning("La fecha inicial es menor a la fecha final.");
		}

		if ($("#TipoPrioridadIncidenciaId").val().length > 0) {
			filtros["TipoPrioridad"] = $("#TipoPrioridadIncidenciaId").val().toString();
		}

		if($("#EstadoIncidenciaId").val().length > 0){
			filtros["Estado"] = $("#EstadoIncidenciaId").val().toString();
		}

		if($("#TipoIncidenciaId").val().length > 0){
			filtros["Tipo"] = $("#TipoIncidenciaId").val().toString();
		}

		if($("#ItemEquipoId").val() != ""){
			filtros["Equipo"] = $("#TipoIncidenciaId").val()
		}

		if($("#nIncidencia").val() != ""){
			filtros["nIncidencia"] = $("#nIncidencia").val();
		}

		cargarFiltros(filtros);
	});
});

function cargarFiltros(filtros = ''){
	
	if (tblIncidencias == false) {
		tblIncidencias = true;
	} else {
		DT.destroy();
	}
	
	var config = {
		data:{
			tblID : "#tblIncidencias",
			select: [
				'HI.HeadIncidenciaid'
				,'HI.Numero'
				,'HI.TipoIncidenciaId'
				,'HI.EstadoIncidenciaId'
				,'HI.TipoPrioridadIncidenciaId'
				,'HI.ItemEquipoId'
				,'OP.Operacion'
				,'HI.Ticket'
				,'HI.Asunto'
				,'HI.Descripcion'
				,'HI.Fecha'
				,'I.Serial'
				,'TI.Nombre as NombreTipoIncidencia'
				,'EI.Nombre as NombreEstado'
				,'TP.Nombre as NombrePrioridad'
				,'E.Nombre as NombreEquipo'
				,'EI.ColorHexa'
			],
			table : [
				"HeadIncidencia HI",
				[
					['TipoIncidencia TI', 'HI.TipoIncidenciaId = TI.TipoIncidenciaId', 'LEFT'],
					['EstadoIncidencia EI', 'HI.EstadoIncidenciaId = EI.EstadoIncidenciaId', 'LEFT'],
					['TipoPrioridadIncidencia TP', 'HI.TipoPrioridadIncidenciaId = TP.TipoPrioridadIncidenciaId', 'LEFT'],
					['ItemEquipo I', 'HI.ItemEquipoId = I.ItemEquipoId', 'LEFT'],
					['Equipo E', 'I.EquipoId = E.EquipoId', 'LEFT'],
					['Operacion OP', 'HI.OperacionId = OP.OperacionId', 'LEFT'],
	
				],[]
			],
			column_order : [
				'HI.HeadIncidenciaid'
				,'HI.Numero'
				,'HI.TipoIncidenciaId'
				,'HI.EstadoIncidenciaId'
				,'HI.TipoPrioridadIncidenciaId'
				,'HI.ItemEquipoId'
				,'OP.Operacion'
				,'HI.Ticket'
				,'HI.Asunto'
				,'HI.Descripcion'
				,'HI.Fecha'
				,'I.Serial'
				,'TI.Nombre as NombreTipoIncidencia'
				,'EI.Nombre as NombreEstado'
				,'TP.Nombre as NombrePrioridad'
				,'E.Nombre as NombreEquipo'
				,'EI.ColorHexa'
			],
			column_search : [
				'HI.HeadIncidenciaid'
				,'E.Nombre'
			],
			orden : {'HeadIncidenciaid': 'DESC'},
			columnas : [
				'HeadIncidenciaid'
				,'Numero'
				,'NombreEquipo'
				,'Serial'
				,'NombreTipoIncidencia'
				,'NombreEstado'
				,'NombrePrioridad'
				,'Asunto'
				,'Descripcion'
				,'Operacion'
				,'Fecha'
				,'ColorHexa'
			]
		},
		processing: true,
		serverSide: true,
		order: [[0, 'ASC']],
		draw: 10,
		language,
		fixedColumns: true,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente'},
			{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente'},
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente'},
			{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Residente'} }
		],
		deferRender: true,
		scrollX: '100%',
		scrollY: altura - 405,
		scroller: {
			loadingIndicator: true
		},
		scrollCollapse: false,
		dom: domBftri,
		columnDefs:[
			{visible: false, targets: [0]}
		],
		createdRow: function(row,data,dataIndex){
			$(row).css('cursor', 'pointer');
	
			$(row).find('td:eq(4)').css('background-color', data[11]);
			$(row).click(function(){
				var url = base_url() + 'Administrativo/Incidencia/cTramitarIncidencia/ConsultarIncidencia/' + data[0];
				location.href = url;
			});
			$(row).find('td:eq(9)').text(moment(data[10]).format("YYYY-MM-DD hh:mm:ss A"));
		}
	}

	if(Array.isArray(filtros)){
		where = [];

		console.log(filtros);

		where.push(["HI.Fecha BETWEEN '" + filtros['fechaIni'] + "' AND '" + filtros['fechaFin'] + "'"]);

		if(filtros.TipoPrioridad != undefined){
			where.push(['HI.TipoPrioridadIncidenciaId IN (' + filtros.TipoPrioridad + ')']);
		}

		if(filtros.Estado != undefined) {
			where.push(['HI.EstadoIncidenciaId IN (' + filtros.Estado + ')']);
		}

		if(filtros.Tipo != undefined) {
			where.push(['HI.TipoPrioridadIncidenciaId IN (' + filtros.Estado + ')']);
		}

		if(filtros.Equipo != undefined) {
			where.push(['HI.ItemEquipoId', filtros.Equipo]);
		}

		if(filtros.nIncidencia != undefined){
			where.push(['HI.Numero', filtros.nIncidencia]);
		}

		config.data.table[2] = where; 
	}

	DT = dtSS(config);
}
