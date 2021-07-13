var DT;
var config = {data:{
		tblID : "#tblCRUDVehiculo",
		select: [
		"'' AS Acciones"
		,'V.VehiculoId'			
		,'V.ItemEquipoId'
		,'V.Placa'				 
		,'V.Linea'				 
		,'V.Tipo'				 
		,'V.Color'				 
		,'V.NumChasis'			 
		,'V.NumMotor'			 
		,'V.Cilindraje'			 
		,'V.UsoVehiculo'
		,'V.NumInterno'			 
		,'V.NumLicenciaTrans'	 
		,'V.CantValvulas'		 
		,'V.CantCilindros'		 
		,'V.Turbo'				 
		,'V.Orientacion'		 
		,'V.TipoDireccion'		 
		,'V.TipoTransmision'	 
		,'V.NumVelocidades'		 
		,'V.TipoRodamiento'		 
		,'V.SuspenDelantera'	 
		,'V.SuspenTrasera'		 
		,'V.NumLlantas'			 
		,'V.DimeRines'			 
		,'V.MaterialRines'		 
		,'V.TipoFrenost'		 
		,'V.TipoFrenosd'		 
		,'V.NumSerieCarroce'	 
		,'V.NumVentas'			 
		,'V.CapCargaPasajeros'	 
		,'V.Observacion' 
		],
		table : [
		'Vehiculo V',
		[

		]
		],
		column_order : [
		"Acciones"
		,'V.VehiculoId'			
		,'V.ItemEquipoId'
		,'V.Placa'				 
		,'V.Linea'				 
		,'V.Tipo'				 
		,'V.Color'				 
		,'V.NumChasis'			 
		,'V.NumMotor'			 
		,'V.Cilindraje'			 
		,'V.UsoVehiculo'
		,'V.NumInterno'			 
		,'V.NumLicenciaTrans'	 
		,'V.CantValvulas'		 
		,'V.CantCilindros'		 
		,'V.Turbo'				 
		,'V.Orientacion'		 
		,'V.TipoDireccion'		 
		,'V.TipoTransmision'	 
		,'V.NumVelocidades'		 
		,'V.TipoRodamiento'		 
		,'V.SuspenDelantera'	 
		,'V.SuspenTrasera'		 
		,'V.NumLlantas'			 
		,'V.DimeRines'			 
		,'V.MaterialRines'		 
		,'V.TipoFrenost'		 
		,'V.TipoFrenosd'		 
		,'V.NumSerieCarroce'	 
		,'V.NumVentas'			 
		,'V.CapCargaPasajeros'	 
		,'V.Observacion'
		],
		column_search : ['O.TerceroId','T.nombre','O.OperarioId'],
		orden : {"O.OperarioId": 'DESC'},
		columnas : [
		"Acciones"
		,'VehiculoId'			
		,'ItemEquipoId'
		,'Placa'				 
		,'Linea'				 
		,'Tipo'				 
		,'Color'				 
		,'NumChasis'			 
		,'NumMotor'			 
		,'Cilindraje'			 
		,'UsoVehiculo' 
		,'NumInterno'			 
		,'NumLicenciaTrans'	 
		,'CantValvulas'		 
		,'CantCilindros'		 
		,'Turbo'				 
		,'Orientacion'		 
		,'TipoDireccion'		 
		,'TipoTransmision'	 
		,'NumVelocidades'		 
		,'TipoRodamiento'		 
		,'SuspenDelantera'	 
		,'SuspenTrasera'		 
		,'NumLlantas'			 
		,'DimeRines'			 
		,'MaterialRines'		 
		,'TipoFrenost'		 
		,'TipoFrenosd'		 
		,'NumSerieCarroce'	 
		,'NumVentas'			 
		,'CapCargaPasajeros'	 
		,'Observacion' 
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
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)'}}
	],
	initComplete: function(){
		$('div.dataTables_filter input').unbind();
		$("div.dataTables_filter input").keyup( function (e) {
			e.preventDefault();
			if (e.keyCode == 13) {
				table = $("body").find("#tblCRUDVehiculo").dataTable();
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
	dom: 'Bftri',
	columnDefs:[

	],

	createdRow: function(row,data,dataIndex){
		var botones = "<center><div class='btn-group btn-group-xs'>";
		botones += "<button type='button' class='editar btn btn-success' value="+data[2]+" ><span class='far fa-edit' title='Editar'></span></button>";
		botones += " <button type ='button' class='eliminar btn btn-danger' value="+data[2]+" ><span class='far fa-trash-alt' title='Eliminar'></span></button>";
		botones += "<button type ='button' class='ver btn btn-info' value="+data[2]+" ><span class='fa fa-search' title='Ver'></span></button>";
		botones += "</div></center>";
		$(row).find('td:eq(0)').html(botones);


		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var id = $(this).attr("value");

			alertify.confirm('Eliminar Ficha Tecnica', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Ficha tecnica Id '+ id;
				eliminarF(id, mRastreo, 'Registro eliminado exitosamente','Vehiculo');
			}, function(){});
		});

		$(row).on("click", ".editar", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'Vehiculo';
			$("li[id=2]").removeClass("collapse");
			$('.nav-tabs a[href="#CRUDvehiculoCrea"]').tab("show");
			disabledtab();


			habilitaCamposLocativa();
			$('[data-dbItem]').val('');
			$('[data-nombre]').val('');
			SelectItemequipo(1);
			DatosEquipoFicha(id);

			$('[data-tabla="Vehiculo"]').val(id).prop("disabled", true);
		});

		$(row).on("click", ".ver", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'Vehiculo';

			$("li[id=2]").removeClass("collapse");
			$('.nav-tabs a[href="#CRUDvehiculoCrea"]').tab("show");
			disabledtab();

			inhabilitaCamposLocativa();
			$('[data-dbItem]').val('').prop("disabled", true);
			$('[data-nombre]').val('').prop("disabled", true);

			$(".btnGuardar").addClass('d-none');
			SelectItemequipo(1);
			DatosEquipoFicha(id);

			$CREAR = 3;
			$('[data-tabla="Vehiculo"]').val(id).prop("disabled", true);
			$(".btnEditarOT").prop("disabled", true);
			$(".btnEliminarItemOT").prop("disabled", true);
			$('[data-nombre]').prop("disabled", true);
			$('[data-dbItem]').prop("disabled", true);
		});
	}
}

$(document).ready(function(){
	DT  = dtSS(config);
})

$("#crearFichaVehivulo").on("click",function(e){
	e.preventDefault();
	$(".Tvehiculo").addClass('d-none');
	$(".DataVehi").removeClass('d-none');
	
	
});

$("#crearFichaVehivulo").on("click",function(e){
	e.preventDefault();
	$(".Tvehiculo").addClass('d-none');
	$(".DataVehi").removeClass('d-none');
});

$('.chosen-select').chosen({
	placeholder_text_single: 'Seleccione:'
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){
	if ($(this).val() != '') {
		obtenerTercero($(this).val(),$(this).attr('data-tipo'));
	}
});