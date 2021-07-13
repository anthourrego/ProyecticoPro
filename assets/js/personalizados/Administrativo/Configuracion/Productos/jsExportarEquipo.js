var DT;
var config = {data:{
		tblID : "#tblCRUD",
		select: [
			'E.EquipoId'
			,'E.Codigo'
			,'E.Nombre'
			,'E.Modelo'
			,'M.nombre  AS Marca'
			,'F.Nombre AS Familia'
			,'E.Dimensiones'
			,'E.TipoInfra'
			,"case when E.Estado = 'A' then 'Activo' else 'Inactivo' End Estado"
		],
		table : [
			'Equipo E',
			[
				['marca M', 'E.MarcaId = M.marcaid', 'LEFT']
				,['Familia F', 'E.FamiliaId = F.FamiliaId', 'LEFT']
			]
		],
		column_order : [
			'EquipoId'
			,'Codigo'
			,'Nombre'
			,'Marca'
			,'Familia'
			,'Dimensiones'
			,'TipoInfra'
			,'Estado'
		],
		column_search : ['E.EquipoId','E.Nombre','E.Codigo'],
		orden : {"Codigo": 'DESC'},
		columnas : [
			'EquipoId'
			,'Codigo'
			,'Nombre'
			,'Modelo'
			,'Marca'
			,'Familia'
			,'Dimensiones'
			,'TipoInfra'
			,'Estado'
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
	dom: domBftri,
	columnDefs:[
		// {visible: false, targets:[0, -1]}
		// ,{width: '125', targets:[3,4,6]}
		// ,{width: '1%', targets:[1,2,7]}
	],
}

$(document).ready(function(){
	DT = dtSS(config);
});