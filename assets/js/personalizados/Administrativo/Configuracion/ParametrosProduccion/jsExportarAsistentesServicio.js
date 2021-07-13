var DT;
var config = {data:{
		tblID : "#tblCRUD",
		select: [
			'O.OperarioId'
			,'O.TerceroId'
			,'T.nombre'
			,'T.nombruno'
			,'T.nombrdos'
			,'T.apelluno'
			,'T.apelldos'
			,'T.direccion'
			,'T.ciudadid'
			,'C.nombre AS Ciudad'
			,'T.telefono'
			,'T.celular'
			,'T.email'
			,'T.estadocivilid'
			,'EC.nombre AS EstadoCivil'
			,'T.profesionid'
			,'PR.nombre AS Profesion'
			,'T.fechanacim'
			,'O.ValorHora'
			,'O.Estado'
			,'O.CodigoBarras'
			,`CentroProduccion = STUFF((
				SELECT
					CP.nombre AS small
				FROM OperarioActividad OA
				LEFT JOIN CentroProduccion CP ON OA.CentroProduccionId = CP.centroproduccionid
				WHERE OA.Tipo = 'CP'
				AND OA.OperarioId = O.OperarioId
			FOR XML PATH('p')),1, 0, '')`
		],
		table : [
			'Operario O',
			[
				['Tercero T', 'O.TerceroId = T.TerceroID', 'LEFT']
				,['Ciudad C', 'T.CiudadId = C.CiudadId', 'LEFT']
				,['EstadoCivil EC', 'T.estadocivilid = EC.estadocivilid', 'LEFT']
				,['Profesion PR', 'T.profesionid = PR.profesionid', 'LEFT']
			]
		],
		column_order : [
			'O.OperarioId'
			,'O.TerceroId'
			,'T.nombre'
			,'T.nombruno'
			,'T.nombrdos'
			,'T.apelluno'
			,'T.apelldos'
			,'T.direccion'
			,'T.ciudadid'
			,'Ciudad'
			,'T.telefono'
			,'T.celular'
			,'T.email'
			,'T.estadocivilid'
			,'EstadoCivil'
			,'T.profesionid'
			,'Profesion'
			,'T.fechanacim'
			,'O.ValorHora'
			,'O.Estado'
			,'O.CodigoBarras'
			,`CentroProduccion`
		],
		column_search : ['O.TerceroId','T.nombre','O.OperarioId'],
		orden : {"O.OperarioId": 'DESC'},
		columnas : [
			'OperarioId'
			,'TerceroId'
			,'nombre'
			,'nombruno'
			,'nombrdos'
			,'apelluno'
			,'apelldos'
			,'direccion'
			,'ciudadid'
			,'Ciudad'
			,'telefono'
			,'celular'
			,'email'
			,'estadocivilid'
			,'EstadoCivil'
			,'profesionid'
			,'Profesion'
			,'fechanacim'
			,'ValorHora'
			,'Estado'
			,'CodigoBarras'
			,`CentroProduccion`
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'DESC']],
	draw: 10,
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
	fixedColumns: true,
	pageLength: 10,
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Residente - ' + $TITULO} }
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
	dom: 'Bftri',
	columnDefs:[
		// {visible: false, targets:[0, -1]}
		// ,{width: '125', targets:[3,4,6]}
		// ,{width: '1%', targets:[1,2,7]}
	],
}

$(document).ready(function(){
	DT = dtSS(config);
});