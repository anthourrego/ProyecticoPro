var pa = {
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
	}
};

var dtValida = $('#tblFecha').DataTable({
	language: pa.language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [],
	orderable: false,
	columnDefs: [
	],
	dom: 'Bfrtip',
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2]}}
	],
	createdRow: function(row, data, dataIndex){
	}
});

jQuery.fn.selectText = function() {
	var doc = document;
	var element = this[0];
	if (doc.body.createTextRange) {
		var range = document.body.createTextRange();
		range.moveToElementText(element);
		range.select();
	} else if (window.getSelection) {
		var selection = window.getSelection();        
		var range = document.createRange();
		range.selectNodeContents(element);
		selection.removeAllRanges();
		selection.addRange(range);
	}
};

var selectTiempo = '<select class="form-control contro-input undMedidaTiempo">';
selectTiempo += '<option></option>';
selectTiempo += '<option value="001">Dias</option>';
selectTiempo += '<option value="002">Semanas</option>';
selectTiempo += '<option value="003">Meses</option>';
selectTiempo += '<option value="004">Años</option>';
selectTiempo += '</select>';
var selectTiempoOC;
var selectTipoDatos = '<select class="form-control contro-input tipoDocVehiculo">';
selectTipoDatos += '<option value="P">Propietario</option>';
selectTipoDatos += '<option value="C">Conductor</option>';
selectTipoDatos += '</select>';
var selectUndMedida;

var $ID = 0,$CREAR = 0, $tabla = '',$EQUIPOID = null;
var lastFocus = '';
var crearficha = 0;

var D,DT2,DT3,DT4,tblID,tblTiempo ;

var config = {
	data:{
		tblID : "#tblCRUDVehiculo",
		select: [
			"'' AS Acciones"
			,'V.VehiculoId'			
			,'V.ItemEquipoId'
			,'E.Nombre'
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
			,'V.NumSerieCarroce'	 
			,'V.Observacion' 
		],
		table : [
			'Vehiculo V',
			[
				[`ItemEquipo I`, 'V.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			"Acciones"
			,'VehiculoId'			
			,'ItemEquipoId'
			,'Nombre'
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
			,'NumSerieCarroce'	 
			,'Observacion'
		],
		column_search : ['O.TerceroId','T.nombre','O.OperarioId'],
		orden : {"V.VehiculoId": 'DESC'},
		columnas : [
			"Acciones"
			,'VehiculoId'			
			,'ItemEquipoId'
			,'Nombre'
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
			,'NumSerieCarroce'	 
			,'Observacion' 
		]
	},
	processing: true,
	serverSide: true,
	order: [[1, 'DESC']],
	draw: 10,
	language: pa.language,
	fixedColumns: true,
	pageLength: 10,
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 450,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: 'Bftri',
	columnDefs:[
	],
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente - ' + $TITULO },
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Residente - ' + $TITULO} }
	],
	initComplete: function(){
	},
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
			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").removeClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").addClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").addClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").addClass('d-none');

			$('#tabMaquib').addClass('disabled');
			$('#tabEquib').addClass('disabled');
			$('#tabLocab').addClass('disabled');
			$('#tabInfb').addClass('disabled');	


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

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").removeClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").addClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").addClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").addClass('d-none');

			$('#tabMaquib').addClass('disabled');
			$('#tabEquib').addClass('disabled');
			$('#tabLocab').addClass('disabled');
			$('#tabInfb').addClass('disabled');
			
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

var config2 = {
	data:{
		tblID : "#tblCRUDMaquinaria",
		select: [
			"'' AS Acciones"
			,'M.MaquinariaId'	
			,'M.ItemEquipoId'	
			,'E.Nombre'
			,'M.ResponUso'		 
			,'M.ResponOperacion'  
			,'M.Ubicacion'		 
			,'M.CodActivoFijo' 
			,'M.Tolerancia'		 
			,'M.Caracteristica'  
			,'M.Gas'		 
			,'M.Motor'		 
			,'M.Aire'		 
			,'M.Presion'	 
			,'M.Agua'		 
			,'M.Volumen'	 
			,'M.Electivoltaje' 
			,'M.amp'		 
			,'M.Combustible' 
			,'M.Tipo'		 
			,'M.Potencia'	 
			,'M.Capacidad'	 
			,'M.rpm'		 
			,'M.Lubricacion' 
			,'M.Observacion' 
		],
		table : [
			'Maquinaria M',
			[
				[`ItemEquipo I`, 'M.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			'Acciones'
			,'M.MaquinariaId'	
			,'M.ItemEquipoId'
			,'E.Nombre'	
			,'M.ResponUso'		 
			,'M.ResponOperacion'  
			,'M.Ubicacion'		 
			,'M.CodActivoFijo' 
			,'M.Tolerancia'		 
			,'M.Caracteristica'  
			,'M.Gas'		 
			,'M.Motor'		 
			,'M.Aire'		 
			,'M.Presion'	 
			,'M.Agua'		 
			,'M.Volumen'	 
			,'M.Electivoltaje' 
			,'M.amp'		 
			,'M.Combustible' 
			,'M.Tipo'		 
			,'M.Potencia'	 
			,'M.Capacidad'	 
			,'M.rpm'		 
			,'M.Lubricacion' 
			,'M.Observacion'
		],
		column_search : ['O.TerceroId','T.nombre','O.OperarioId'],
		orden : {"O.OperarioId": 'DESC'},
		columnas : [
			'Acciones'
			,'MaquinariaId'	
			,'ItemEquipoId'	
			,'Nombre'
			,'ResponUso'		 
			,'ResponOperacion'  
			,'Ubicacion'		 
			,'CodActivoFijo' 
			,'Tolerancia'		 
			,'Caracteristica'  
			,'Gas'		 
			,'Motor'		 
			,'Aire'		 
			,'Presion'	 
			,'Agua'		 
			,'Volumen'	 
			,'Electivoltaje' 
			,'amp'		 
			,'Combustible' 
			,'Tipo'		 
			,'Potencia'	 
			,'Capacidad'	 
			,'rpm'		 
			,'Lubricacion' 
			,'Observacion' 
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'DESC']],
	draw: 10,
	language: pa.language,
	fixedColumns: true,
	pageLength: 10,
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
				table = $("body").find("#tblCRUDVehiculo").dataTable();
				table.fnFilter( this.value );
			}
		} );
		$('div.dataTables_filter input').focus();
	},
	createdRow: function(row,data,dataIndex){
		var botones = "<center><div class='btn-group btn-group-xs'>";
		botones += "<button type='button' class='editar btn btn-success' value="+data[2]+" ><span class='far fa-edit' title='Editar'></span></button>";
		botones += "<button type ='button' class='eliminar btn btn-danger' value="+data[2]+" ><span class='far fa-trash-alt' title='Eliminar'></span></button>";
		botones += "<button type ='button' class='ver btn btn-info' value="+data[2]+" ><span class='fa fa-search' title='Ver'></span></button>";
		botones += "</div></center>";
		$(row).find('td:eq(0)').html(botones);

		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var id = $(this).attr("value");

			alertify.confirm('Eliminar Ficha Tecnica', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Ficha tecnica Id '+ id;
				eliminarF(id, mRastreo, 'Registro eliminado exitosamente','Maquinaria');
			}, function(){});
		});

		$(row).on("click", ".editar", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'Maquinaria';

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").addClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").removeClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").addClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").addClass('d-none');

			$('#tabVehib').addClass('disabled');
			$('#tabEquib').addClass('disabled');
			$('#tabLocab').addClass('disabled');
			$('#tabInfb').addClass('disabled');


			disabledtab();


			habilitaCamposLocativa();
			$('[data-dbItem]').val('');
			$('[data-nombre]').val('');
			SelectItemequipo(2);
			DatosEquipoFicha(id);
			$CREAR = 2;
			$('[data-tabla="Maquinaria"]').val(id).prop("disabled", true);

		});

		$(row).on("click", ".ver", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'Maquinaria';

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").addClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").removeClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").addClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").addClass('d-none');

			$('#tabVehib').addClass('disabled');
			$('#tabEquib').addClass('disabled');
			$('#tabLocab').addClass('disabled');
			$('#tabInfb').addClass('disabled');

			disabledtab();

			inhabilitaCamposLocativa();
			$('[data-dbItem]').val('').prop("disabled", true);
			$('[data-nombre]').val('').prop("disabled", true);
			$(".btnGuardar").addClass('d-none');
			SelectItemequipo(2);
			DatosEquipoFicha(id);
			$(".btnEditarOT").prop("disabled", true);
			$(".btnEliminarItemOT").prop("disabled", true);
			$CREAR = 3;
			$('[data-tabla="Maquinaria"]').val(id).prop("disabled", true);
		});
	}
}

var config3 = {
	data:{
		tblID : "#tblCRUDComputo",
		select: [
			"'' AS Acciones"
			,'C.EquipoComputoId'
			,'E.Nombre'
			,'C.ItemEquipoId'
			,'C.FechaRegistro'	
			,'C.TipoComputo'	
			,'C.Condiciones'	
			,'C.Color'			
			,'C.Observacion'
		],
		table : [
			'EquipoComputo C',
			[
				[`ItemEquipo I`, 'C.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			'Acciones'
			,'C.EquipoComputoId'
			,'C.ItemEquipoId'
			,'E.Nombre'
			,'C.FechaRegistro'	
			,'C.TipoComputo'	
			,'C.Condiciones'	
			,'C.Color'			
			,'C.Observacion'
		],
		column_search : ['O.TerceroId','T.nombre','O.OperarioId'],
		orden : {"O.OperarioId": 'DESC'},
		columnas : [
			'Acciones'
			,'EquipoComputoId'
			,'ItemEquipoId'
			,'Nombre'
			,'FechaRegistro'	
			,'TipoComputo'	
			,'Condiciones'	
			,'Color'			
			,'Observacion'
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'DESC']],
	draw: 10,
	language: pa.language,
	fixedColumns: true,
	pageLength: 10,
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
				table = $("body").find("#tblCRUDVehiculo").dataTable();
				table.fnFilter( this.value );
			}
		} );
		$('div.dataTables_filter input').focus();
	},
	createdRow: function(row,data,dataIndex){
		var botones = "<center><div class='btn-group btn-group-xs'>";
		botones += "<button type='button' class='editar btn btn-success' value="+data[2]+" ><span class='far fa-edit' title='Editar'></span></button>";
		botones += " <button type ='button' class='eliminar btn btn-danger' value="+data[2]+" ><span class='far fa-trash-alt' title='Eliminar'></span></button>";
		botones += " <button type ='button' class='ver btn btn-info' value="+data[2]+" ><span class='fa fa-search' title='Ver'></span></button>";
		botones += "</div></center>";
		$(row).find('td:eq(0)').html(botones);

		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var id = $(this).attr("value");
			disabledtab();

			alertify.confirm('Eliminar Ficha Tecnica', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Ficha tecnica Id '+ id;
				eliminarF(id, mRastreo, 'Registro eliminado exitosamente','EquipoComputo');
			}, function(){});
		});

		$(row).on("click", ".editar", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'EquipoComputo';

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").addClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").addClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").removeClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").addClass('d-none');

			$('#tabVehib').addClass('disabled');
			$('#tabMaquib').addClass('disabled');
			$('#tabLocab').addClass('disabled');
			$('#tabInfb').addClass('disabled');	
			disabledtab();

			habilitaCamposLocativa();
			$('[data-dbItem]').val('');
			$('[data-nombre]').val('');
			SelectItemequipo(3);
			DatosEquipoFicha(id);
			$CREAR = 2;
			$('[data-tabla="EquipoComputo"]').val(id).prop("disabled", true);
		});

		$(row).on("click", ".ver", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'EquipoComputo';

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").addClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").addClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").removeClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").addClass('d-none');

			$('#tabVehib').addClass('disabled');
			$('#tabMaquib').addClass('disabled');
			$('#tabLocab').addClass('disabled');
			$('#tabInfb').addClass('disabled');	

			disabledtab();

			inhabilitaCamposLocativa();
			$('[data-dbItem]').val('').prop("disabled", true);
			$('[data-nombre]').val('').prop("disabled", true);
			$(".btnGuardar").addClass('d-none');
			SelectItemequipo(3);
			DatosEquipoFicha(id);
			$(".btnEditarOT").prop("disabled", true);
			$(".btnEliminarItemOT").prop("disabled", true);
			$CREAR = 3;
			$('[data-tabla="EquipoComputo"]').val(id).prop("disabled", true);
		});
	}
}

var config4 = {
	data:{
		tblID : "#tblCRUDLocativa",
		select: [
			"'' as Acciones"
			,'L.LocativaId'		
			,'L.ItemEquipoId'
			,'E.Nombre'	
			,'L.Estructura'		
			,'L.Area'			
			,'L.Accesorios'		
			,'L.FechaRegistro'	
			,'L.Observacion'
			,'I.Color'
			,'I.Serial'
		],
		table : [
			'Locativa L',
			[
				[`ItemEquipo I`, 'L.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			'Acciones'
			,'L.LocativaId'		
			,'L.ItemEquipoId'
			,'E.Nombre'	
			,'L.FechaRegistro'		
			,'L.Estructura'		
			,'I.Serial'			
			,'I.Color'		
			,'L.Observacion'
		],
		column_search : ['O.TerceroId','T.nombre','O.OperarioId'],
		orden : {"O.OperarioId": 'DESC'},
		columnas : [
			'Acciones'
			,'LocativaId'		
			,'ItemEquipoId'
			,'Nombre'	
			,'FechaRegistro'	
			,'Estructura'		
			,'Serial'			
			,'Color'			
			,'Observacion'
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'DESC']],
	draw: 10,
	language: pa.language,
	fixedColumns: true,
	pageLength: 10,
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
				table = $("body").find("#tblCRUDVehiculo").dataTable();
				table.fnFilter( this.value );
			}
		} );
		$('div.dataTables_filter input').focus();
	},
	createdRow: function(row,data,dataIndex){
		var botones = "<center><div class='btn-group btn-group-xs'>";
		botones += "<button type='button' class='editar btn btn-success' value="+data[2]+" ><span class='far fa-edit' title='Editar'></span></button>";
		botones += " <button type ='button' class='eliminar btn btn-danger' value="+data[2]+" ><span class='far fa-trash-alt' title='Eliminar'></span></button>";
		botones += " <button type ='button' class='ver btn btn-info' value="+data[2]+" ><span class='fa fa-search' title='Ver'></span></button>";
		botones += "</div></center>";
		$(row).find('td:eq(0)').html(botones);

		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var id = $(this).attr("value");

			alertify.confirm('Eliminar Ficha Tecnica', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Ficha tecnica Id '+ id;
				eliminarF(id, mRastreo, 'Registro eliminado exitosamente','Locativa');
			}, function(){});
		});

		$(row).on("click", ".editar", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'Locativa';

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").addClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").addClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").addClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").removeClass('d-none');	

			$('#tabVehib').addClass('disabled');
			$('#tabMaquib').addClass('disabled');
			$('#tabEquib').addClass('disabled');
			$('#tabInfb').addClass('disabled');

			disabledtab();

			habilitaCamposLocativa();
			$('[data-dbItem]').val('');
			$('[data-nombre]').val('');
			SelectItemequipo(4);
			DatosEquipoFicha(id);
			$CREAR = 2;
			$('[data-tabla="Locativa"]').val(id).prop("disabled", true);
		});

		$(row).on("click", ".ver", function(e){
			e.preventDefault();

			var id = $(this).attr("value");
			$ID = id;
			$tabla = 'Locativa';

			$(".Tvehiculo").addClass('d-none');
			$(".DataVehi").addClass('d-none');
			$(".TMaquinaria").addClass('d-none');
			$(".DataMaqui").addClass('d-none');
			$(".TEquipo").addClass('d-none');
			$(".DataEqui").addClass('d-none');
			$(".TLocativa").addClass('d-none');
			$(".DataLoca").removeClass('d-none');

			$('#tabVehib').addClass('disabled');
			$('#tabMaquib').addClass('disabled');
			$('#tabEquib').addClass('disabled');
			$('#tabInfb').addClass('disabled');
			disabledtab();

			inhabilitaCamposLocativa();
			$('[data-dbItem]').val('').prop("disabled", true);
			$('[data-nombre]').val('').prop("disabled", true);
			$(".btnGuardar").addClass('d-none');
			SelectItemequipo(4);
			DatosEquipoFicha(id);
			$(".btnEditarOT").prop("disabled", true);
			$(".btnEliminarItemOT").prop("disabled", true);
			$CREAR = 3;
			$('[data-tabla="Locativa"]').val(id).prop("disabled", true);
		});
	}
}


function obtenerDatos(tabla){
	switch(tabla){
		case 'Vehiculo':
			DT.draw();
			break;
		case 'Maquinaria':
			DT2.draw();
			break;
		case 'EquipoComputo':
			DT3.draw();
			break;
		case 'Locativa':
			DT4.draw();
			break;
	}
}

$(document).ready(function(){
	$("[id=TblAnexosVehiculo]").DataTable();
	$("[id=TblAnexosMaquinaria]").DataTable();
	$("[id=TblAnexosComputo]").DataTable();
	$("[id=TblAnexosLocativa]").DataTable();
	
	DT  = dtSS(config);
	DT2 = dtSS(config2);
	DT3 = dtSS(config3);
	DT4 = dtSS(config4);
}); 

$("[id=MaquinariaEquipo]").on("click", function(e){
	obtenerDatos('Maquinaria');
});

$("[id=EquipoComputo]").on("click", function(e){
	obtenerDatos('EquipoComputo');
});

$("[id=Locativa]").on("click", function(e){
	obtenerDatos('Locativa');
});

$("#crearFichaVehivulo").on("click",function(e){
	e.preventDefault();
	$tabla = 'Vehiculo';
	disabledtab();
	$(".Tvehiculo, .TMaquinaria, .DataMaqui, .TEquipo, .DataEqui, .TLocativa, .DataLoca").addClass('d-none');
	$(".DataVehi").removeClass('d-none');
	$CREAR = 1;
});

$("#crearMaquinariaEquipo").on("click",function(e){
	e.preventDefault();
	$tabla = 'Maquinaria';
	disabledtab();
	$(".Tvehiculo, .DataVehi, .TMaquinaria, .TEquipo, .DataEqui, .TLocativa, .DataLoca").addClass('d-none');
	$(".DataMaqui").removeClass('d-none');
	$CREAR = 1;
});

$("#crearEquipoComputo").on("click",function(e){
	e.preventDefault();
	$tabla = 'EquipoComputo';
	disabledtab();
	$(".Tvehiculo, .DataVehi, .TMaquinaria, .DataMaqui, .TEquipo, .TLocativa, .DataLoca").addClass('d-none');
	$(".DataEqui").removeClass('d-none');
	$CREAR = 1;
});

$("#crearLocativa").on("click",function(e){
	e.preventDefault();
	$tabla = 'Locativa';
	disabledtab();
	$(".Tvehiculo, .DataVehi, .TMaquinaria, .DataMaqui, .TEquipo, .DataEqui, .TLocativa").addClass('d-none');
	$(".DataLoca").removeClass('d-none');
	$CREAR = 1;
});

$(".myaccordion").on("hide.bs.collapse show.bs.collapse", e => {
	$(e.target)
	.prev()
	.find("i:last-child")
	.toggleClass("fa-minus fa-plus");
});

$('select[id=ItemEquipoId]').off("change").on("change", function(){
	console.log('Iteme',$(this).val());
	$('[data-dbItem]').val('');
	$EQUIPOID = $('select[id=ItemEquipoId]').find("option:selected").attr("data-equipo");
	validarItemequipoEquipo($(this).val());
});


$('[data-db]').on('focusin', function(){
	if ($(this).is("select")) {
		lastFocus = $(this).find("option:selected").text();
	}else{
		lastFocus = $(this).val();
	}
}).on('focusout', function(){
	if ($(this).attr("required") && $(this).val() == "") {
		var self = this;
		setTimeout(function(){
			alertify.warning("el campo "+$(self).attr("data-db")+" no puede estar vacio.");
			$(self).focus();
		},0);
	}else{
		var value = $(this).is("select") ? $(this).find("option:selected").text() : $(this).val();
		if (value != lastFocus) {
			actualizar(this);
		}
	}
});


$("[id=btnCancelar]").on("click", function(e){
	var self = this;
	if ($ID != 0  &&  $CREAR == 1) {
		$.ajax({
			url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/eliminarDatosFicha",
			type: "POST",
			data: {
				ItemEquipoId : $ID,
				tabla        : $tabla
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				if (respuesta == 1) {
					cargarVista($(self).attr('data-tipo'));
					LimpiarForm();
				}else{
					alertify.alert("Atención",msgAletrta.errorAdmin)
				}
			}
		});  
	}else{
		cargarVista($(self).attr('data-tipo'));
		LimpiarForm();
	}
});

$("[id=btnGuardar]").on("click", function(e){
	e.preventDefault();
	$("#btnGuardar").attr('disabled',true);
	alertify.success("Datos guardados exitosamente");
	cargarVista($(this).attr('data-tipo'));
	LimpiarForm();
});

$("[id=tabMaquib]").on("click", function(e){
	e.preventDefault();
	$(".TMaquinaria").removeClass('d-none');
	DT2.draw();  
});

$("[id=tabEquib]").on("click", function(e){
	e.preventDefault();
	$(".TEquipo").removeClass('d-none'); 
	DT3.draw();   
});

$("[id=tabLocab]").on("click", function(e){
	e.preventDefault();
	$(".TLocativa").removeClass('d-none');
	DT4.draw();    
});

$('.chosen').chosen({
	placeholder_text_single: 'Seleccione:'
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){

})

function habilitaCamposLocativa(){
	$('.campo').prop("disabled", false);
}

function inhabilitaCamposLocativa(){
	$('.campo').prop("disabled", true);
}

function LimpiarForm(){
	$("[data-db]").each(function(){
		$(this).val("");
	});
	$(".chosen-select").val("").trigger("chosen:updated");
	$ID 		= 0;
	$CREAR 		= 0; 
	$tabla 		= '';
	lastFocus 	= '';
	crearficha 	= 0;
	$EQUIPOID 	= null;
}

function cargarVista(tipo){
	switch (tipo) {
		case 'vehiculo':
			$(".DataVehi").addClass('d-none');
			$(".Tvehiculo").removeClass('d-none');
			DT.draw();
			break;
		case 'maquinaria':
			$(".DataMaqui").addClass('d-none');
			$(".TMaquinaria").removeClass('d-none');
			DT2.draw();
			break;
		case 'computo':
			$(".DataEqui").addClass('d-none');
			$(".TEquipo").removeClass('d-none');
			DT3.draw();
			break;
		case 'locativa':
			$(".DataLoca").addClass('d-none');
			$(".TLocativa").removeClass('d-none');
			DT4.draw();
			break;
		default:
			break;
	}
}

function SelectItemequipo(TipoInfra){
	// $.ajax({
	// 	url: base_url()+"Administrativo/Fichastecnicas/cFichasTecnicas/SelectItemequipo",
	// 	type: "POST",
	// 	async: false,
	// 	data: {
	// 		TipoInfra: TipoInfra

	// 	}, 
	// 	success: function(resultado) {
	// 		registro = JSON.parse(resultado);
	// 		if(registro){
	// 			$.each(registro, function(){
	// 				var inf = '<option value="'+this.ItemEquipoId+'">'+this.Nombre+'</option>';
	// 				$("[id=ItemEquipoId]").append(inf);
	// 			});
	// 			$('.ItemEquipoId').chosen({width: '100%'});
	// 		} 
	// 	}
	// });
}

function validarItemequipoEquipo(ItemEquipoId){

	datos = {
		ItemEquipoId 	: ItemEquipoId,
	}
	$ID = $ID ? $ID : 0;

	$.ajax({
		url: base_url()+"Administrativo/Fichastecnicas/cFichasTecnicas/validarItemequipoEquipo",
		type: "POST",
		async: false,
		data: {
			Data         			: datos,
			ItemEquipoId 			: ItemEquipoId,
			Ficha        			: $tabla,
			ItemeEquipoIdAnterior   : $ID 
		}, 
		success: function(resultado){
			var datos = JSON.parse(resultado);

			if(datos === 1){
				alertify.error('El Equipo de la ficha tecnica ya existe, ingrese de nuevo Equipo');
				$('[data-tabla="'+$tabla+'"]').val('');
				ItemEquipoId ='';
				$ID = 0;
				return;
			}

			$ID = datos.ItemEquipoId;

			if(datos.datosEquipo){
				habilitaCamposLocativa();
			}

			for(var key in datos.datosEquipo[0]){

				valor = datos.datosEquipo[0][key];
				if($('[data-dbItem="'+key+'"]').is('select')){
					if($('[data-dbItem="'+key+'"]').not('.chos-unit').hasClass('chosen-select') && valor != null){
						$('[data-dbItem='+key+']').val(valor).trigger('chosen:updated');
					}else{
						$('[data-dbItem='+key+']').val(valor).trigger('chosen:updated');
					}
				}else{
					$('[data-dbItem='+key+']').val(valor);
				}
			}
			$('[data-nombre]').prop("disabled", false);
			$('[data-dbItem]').prop("disabled", true);
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}


function DatosEquipoFicha(ItemEquipoId){

	$.ajax({
		url: base_url()+"Administrativo/Fichastecnicas/cFichasTecnicas/DatosEquipoFicha",
		type: "POST",
		async: false,
		data: {
			ItemEquipoId : ItemEquipoId,
			Ficha        : $tabla
		}, 
		success: function(resultado){
			console.log('validacion',resultado);

			var datos = JSON.parse(resultado);

			if(datos.datosEquipo){
				habilitaCamposLocativa();
			}
			

			for(var key in datos.datosEquipo[0]){


				valor = datos.datosEquipo[0][key];
				if($('[data-dbItem="'+key+'"]').is('select')){
					if($('[data-dbItem="'+key+'"]').not('.chos-unit').hasClass('chosen-select') && valor != null){
						$('[data-dbItem='+key+']').val(valor).trigger('chosen:updated');
					}else{
						$('[data-dbItem='+key+']').val(valor).trigger('chosen:updated');
					}
				}else{
					$('[data-dbItem='+key+']').val(valor);
				}
				$('.ItemEquipoId').val(ItemEquipoId).trigger('chosen:updated');
			}

			for(var key in datos.datosficha[0]){

				valor = datos.datosficha[0][key];
				if($('[data-db="'+key+'"]').is('select')){
					if($('[data-db="'+key+'"]').not('.chos-unit').hasClass('chosen-select') && valor != null){
						$('[data-db='+key+']').val(valor).trigger('chosen:updated');
					}else{
						$('[data-db='+key+']').val(valor).trigger('chosen:updated');
					}
				}else{
					$('[data-db='+key+']').val(valor);
				}

			}

			cargarDatosTablas('Operacion',ItemEquipoId,'ItemEquipoId','OT');
			cargarDatosTablas('Operacion',ItemEquipoId,'ItemEquipoId','OC');
			cargarDatosTablasVehiculo('H');
			cargarAnexos();

			

		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}


var busqueda = false;
function actualizar(self, lastFocus){
	var value = $(self).val().trim();
	if($(self).hasClass('data-decimal')){
		value = parseFloat(value.replace(/,/g, ''));
	}
	if(value == null){
		value = '';
	}

	if(value != lastFocus && busqueda != true){
		var nombre 	= $(self).attr('data-db'),
		value 		= value,
		stringModif = $CREAR == 1 ? 'Crear' : 'Modificar';
		last 		= lastFocus;

		$.ajax({
			url: base_url() + "Administrativo/Fichastecnicas/cFichastecnicas/Actualizar",
			type: 'POST',
			async: false,
			data: {
				cliente: $ID,
				nombre: nombre,
				value: value,
				tabla: $tabla,
				RASTREO: RASTREO('Modifica Ficha '+$ID+' Cambia '+$(self).attr('data-nombre')+' '+lastFocus+' -> '+value, 'Fichas Tecnicas')
			},
			success: function(respuesta){
				console.log('respuesta de actualizar',respuesta);
			}
		});
	}
}


function eliminarF(id, rastreo, mensaje,tabla){
	$.ajax({
		url: base_url()+"Administrativo/Fichastecnicas/cFichastecnicas/eliminar",
		type: "POST",
		async: false,
		data: {
			tabla : tabla,
			id: id,
			RASTREO: RASTREO(rastreo, $tabla)
		}, success: function(resultado) {
			if(resultado == 1){
				alertify.success("Datos eliminados exitosamente.");
				obtenerDatos(tabla);
			} else {
				alertify.error("!Error, no se eliminar el registro; comuniquese con el administrador del sistema");
			}
		}
	});
}


function eliminarOperacion(id, rastreo, mensaje,tabla){
	$.ajax({
		url: base_url()+"Administrativo/Fichastecnicas/cFichastecnicas/eliminarOperacion",
		type: "POST",
		async: false,
		data: {
			tabla : tabla,
			id: id,
			RASTREO: RASTREO(rastreo, $tabla)
		}, success: function(resultado) {
			if(resultado == 1){
				var canDismiss = false;
				var notification = alertify.error(mensaje);
				notification.ondismiss = function(){ return canDismiss };
				setTimeout(function(){ 
					canDismiss = true; 
					cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OT');
					cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OC');
					cargarDatosTablasVehiculo('H');
				}, 1000);
			} else {
				alertify.error("!Error, no se eliminar el registro; comuniquese con el administrador del sistema");
			}
		}
	});
}

function eliminarElemento(id, rastreo, mensaje,tabla,value,tipo=null){
	$.ajax({
		url: base_url()+"Administrativo/Fichastecnicas/cFichastecnicas/eliminarElemento",
		type: "POST",
		async: false,
		data: {
			tabla : tabla,
			id    : id,
			value : value,
			RASTREO: RASTREO(rastreo, $tabla)
		}, success: function(resultado) {
			if(resultado == 1){
				alertify.success("Datos eliminados exitosamente.")
				cargarDatosTablasVehiculo(tipo);
			} else {
				alertify.error("!Error, no se eliminar el registro; comuniquese con el administrador del sistema");
			}
		}
	});
}

$(".TblAnexos").on("click", ".btnGuardarAN", function(e){
	e.preventDefault();
	guardarAnexos();
});

function guardarAnexos(){
	var tipo ='ficha' 
	var codigo = $ID;
	if (typeof FormData !== 'undefined') {
		var form_data = new FormData();
		form_data.append('Lista_Anexos', $("[id=anexosDoc]")[0].files[0]);
		form_data.append('codigo', codigo);
		$.ajax({
			url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/guardarAnexosEquipoComputo",
			type: "POST",
			data: form_data,
			async	: false,
			cache	: false,
			contentType : false,
			processData : false,
			success: function(resultado){
				var resp = resultado;
				
				if (resultado != 0) {
					alertify.success("Ficha tecnica actualizada");
					cargarAnexos();
				}else{
					alertify.error("!Error, no se pudieron guardar los anexos; comuniquese con el administrador del sistema");
				}
			},
			error: function(error){
				alertify.alert('Error', error.responseText);
				console.log(error);
			}
		});
	}
};

$(".TblOperacionesTiempo").on("click", ".btnGuardarOPT", function(e){
	e.preventDefault();
	if ($(this).closest('tr').find('td:eq(1)').text().trim() == '' || $(this).closest('tr').find('td:eq(2)').text().trim() == ''
		|| $(this).closest('tr').find('td:eq(3) select').val() == '' || $(this).closest('tr').find('td:eq(4) input').val() == ''
		|| $(this).closest('tr').find('td:eq(5)').text().trim() == '') {
		alertify.warning("Verificar que todos los campos esten llenos");
	return;
}
var $data = {
	operacion 		: $(this).closest('tr').find('td:eq(1)').text().trim(),
	valorfrecuencia : $(this).closest('tr').find('td:eq(2)').text().trim(),
	TiempoOperacion : $(this).closest('tr').find('td:eq(3) select').val(),
	ultimafecha 	: $(this).closest('tr').find('td:eq(4) input').val(),
	diasalerta 		: $(this).closest('tr').find('td:eq(5)').text().trim(),
	ItemEquipoId 	: $ID,
	tipooperacion 	: 't'

};
var tipo = $(this).closest(".TblOperacionesTiempo").attr("data-tipo");
console.log('$data',$data);
mRastreo = 'Crea Ficha tecnica Oreción Tiempo  '+ $data.operacion;
guardarValores($data,tipo,'Operacion',mRastreo,$ID,'ItemEquipoId');
cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OT');

});


$(".TblOperacionesConsumo").on("click", ".btnGuardarOPT", function(e){
	e.preventDefault();
	if ($(this).closest('tr').find('td:eq(1)').text().trim() == '' || $(this).closest('tr').find('td:eq(2)').text().trim() == ''
		|| $(this).closest('tr').find('td:eq(3) select').val() == '' || $(this).closest('tr').find('td:eq(4) input').val() == ''
		|| $(this).closest('tr').find('td:eq(5)').text().trim() == '') {
		alertify.warning("Verificar que todos los campos esten llenos");
	return;
}

var $data = {
	operacion: $(this).closest('tr').find('td:eq(1)').text().trim(),
	valorfrecuencia: $(this).closest('tr').find('td:eq(2)').text().trim(),
	TiempoOperacion: $(this).closest('tr').find('td:eq(3) select').val(),
	valultimoconsu: $(this).closest('tr').find('td:eq(4)').text().trim(),
	valnotifica: $(this).closest('tr').find('td:eq(5)').text().trim(),
	ItemEquipoId 	: $ID,
	tipooperacion: 'c',
};

var tipo = $(this).closest(".TblOperacionesConsumo").attr("data-tipo");
console.log('$data',$data);
mRastreo = 'Crea Ficha tecnica Oreción Consumo  '+ $data.operacion;
guardarValores($data,tipo,'Operacion',mRastreo,$ID,'ItemEquipoId');
cargarDatosTablas('Operacion',$ID,'ItemEquipoId','OC');
});




$(".TblElemento").on("click", ".btnGuardarOPT", function(e){
	e.preventDefault();
	if ($(this).closest('tr').find('td:eq(0)').text().trim() == '' || $(this).closest('tr').find('td:eq(1)').text().trim() == '') {
		alertify.warning("Verificar que todos los campos esten llenos");
		return;
	}

	var tipo = $(this).closest(".TblElemento").attr("data-tipo");
	var $data = {
		Elemento: $(this).closest('tr').find('td:eq(0)').text().trim(),
		Cantidad: $(this).closest('tr').find('td:eq(1)').text().trim(),
		Tipo    : tipo,
	};

	mRastreo = 'Crea Elemento Ficha tecnica'+ $data.Elemento;
	guardarValoresVehiculo($data,'ElementoVehiculo',mRastreo,tipo);
});


function guardarValoresVehiculo($data,$tabla,rastreo,$tipo){
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/guardarValoresVehiculo",
		type  : "POST",
		data: {
			ItemEquipoId : $ID,
			data         : $data,
			tabla        : $tabla,
			RASTREO: RASTREO(rastreo, 'ElementoVehiculo')
		},
		success: function(resultado){
			var resp = resultado;

			if (resultado == 1) {
				alertify.success("Datos guardados correctamente");
				cargarDatosTablasVehiculo($tipo);
			}else{
				alertify.error("!Error, no se pudieron guardar los datos; comuniquese con el administrador del sistema");
			}
		}
	});
}

function guardarValores($data, $tipo,tblNombre,rastreo,value,nombre){
	
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/guardarValores",
		type  : "POST",
		data: {
			tabla : tblNombre,
			data  : $data,
			RASTREO: RASTREO(rastreo, tblNombre)
		},
		success: function(resultado){
			var resp = resultado;

			if (resultado == 1) {
				alertify.success("Datos guardados correctamente");
				cargarDatosTablas(tblNombre,value,nombre,$tipo);
				
			}else{
				alertify.error("!Error, no se pudieron guardar los datos; comuniquese con el administrador del sistema");
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}

function actualizarDatos($data, $tipo,tblNombre,rastreo,value,nombre,valueActulizar,nombreActualizar){
	
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/actualizarDatos",
		type  : "POST",
		data: {
			tabla : tblNombre,
			data  : $data,
			value : valueActulizar,
			nombre: nombreActualizar,
			RASTREO: RASTREO(rastreo, tblNombre)
		},
		success: function(resultado){
			var resp = resultado;

			if (resultado == 1) {
				alertify.success("Datos Actualizados correctamente");
				cargarDatosTablas(tblNombre,value,nombre,$tipo);
				
			}else{
				alertify.error("!Error, no se pudieron guardar los datos; comuniquese con el administrador del sistema");
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}

function cargarAnexos(){
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/obtenerAnexos",
		type  : "POST",
		data: {
			ItemEquipoId : $ID
		},
		success: function(resultado){
			var datos = JSON.parse(resultado);
			var filas = [];
			$.each(datos, function(){
				var ruta = this.Ruta.split('/');
				console.log('ruta',ruta);
				var tipoDoc = ruta[5].split('.');
				var nombre = tipoDoc[0].split('_');
				nombre = nombre[2];
				var enlace = "";
				var rutaDoc = base_url()+ruta[1]+'/'+ruta[2]+'/'+ruta[3]+'/'+ruta[4]+'/'+ruta[5];
				var eliminar = "";
				if (tipoDoc[1] == "doc") {
					enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-word-o"></i></a>';
				}else if(tipoDoc[1] == "xls" || tipoDoc[1] == "xlsx"){
					enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>';
				}else if(tipoDoc[1] == "pdf"){
					enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></a>';
				}else if(tipoDoc[1] == "txt"){
					enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-file-text-o"></i></a>';
				}else{
					enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>';
				}
				eliminar = '<button class="btn btnEliminarItemOT eliminarAnexoEquipo btn-xs btn-danger" value="'+this.AnexoId+'"><span class="far fa-trash-alt"></span></button>';
				var fila = {
					0: eliminar,
					1: tipoDoc[1].toUpperCase(),
					2: nombre,
					3: enlace
				}
				filas.push(fila);
			});
			dtTblAnexosVehiculo.clear().draw();
			dtTblAnexosVehiculo.rows.add(filas).draw();
			dtTblAnexosMaquinaria.clear().draw();
			dtTblAnexosMaquinaria.rows.add(filas).draw();
			dtTblAnexosComputo.clear().draw();
			dtTblAnexosComputo.rows.add(filas).draw();
			dtTblAnexoslocativa.clear().draw();
			dtTblAnexoslocativa.rows.add(filas).draw();

			$(".btnAnexo").prop('disabled', false);
			$("[id=codigoEquipoComputo]").prop("disabled", true);

			if($CREAR  == 3){
				disabledBtn();
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}

function cargarDatosTablas(tblNombre, $value,$nombre,tipo){
	console.log('tabla',tblNombre);
	console.log('$value',$value);
	console.log('$nombre',$nombre);
	console.log('$tipo',tipo);
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/cargarDatosTablas",
		type  : "POST",
		data: {
			tabla : tblNombre,
			value : $value,
			nombre : $nombre,
		},
		success: function(resultado){
			datos = JSON.parse(resultado);
			var filas = [];
			switch (tipo) {
				case 'OT':
				
				if (datos != null) {

					$.each(datos, function(){
						if(this.TipoOperacion == 't' ){
							if (this.TiempoOperacion == '001') {
								tiempo = 'Dias';
							}else if (this.TiempoOperacion == '002') {
								tiempo = 'Semanas';
							}else if (this.TiempoOperacion == '003') {
								tiempo = 'Meses';
							}else if (this.TiempoOperacion == '004') {
								tiempo = 'Años';
							}
							var fila = {
								0: "<center><button type='button' value='"+this.OperacionId+"' class='btnEditarOT btn btn-primary btn-xs' title='Editar' style='margin-right:5px'><span class='far fa-edit'></span></button><button type='button' value='"+this.OperacionId+"' class='btn btn-danger btn-xs btnEliminarItemOT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
								1: this.Operacion,
								2: this.ValorFrecuencia,
								3: tiempo,
								4: this.UltimaFecha,
								5: this.DiasAlerta,

							}
							filas.push(fila);
						}
					});
					dtTblOperacionesTiempo.clear().draw();
					dtTblOperacionesTiempo.rows.add(filas).draw();
					dtTblOperacionesTiempoMaquinaria.clear().draw();
					dtTblOperacionesTiempoMaquinaria.rows.add(filas).draw();
					dtTblOperacionesTiempoComputo.clear().draw();
					dtTblOperacionesTiempoComputo.rows.add(filas).draw();
					dtTblOperacionesTiempoLocativa.clear().draw();
					dtTblOperacionesTiempoLocativa.rows.add(filas).draw();
					$(".CrearOperacionTiempo").attr('disabled', false);
				}else{
					tblTiempo.clear().draw();
				}
				
				break;
				case 'OC':
				
				if (datos != null) {
					$.each(datos, function(){
						if(this.TipoOperacion == 'c' ){
							if (this.TiempoOperacion == '001') {
								tiempo = 'Dias';
							}else if (this.TiempoOperacion == '002') {
								tiempo = 'Semanas';
							}else if (this.TiempoOperacion == '003') {
								tiempo = 'Meses';
							}else if (this.TiempoOperacion == '004') {
								tiempo = 'Años';
							}

							var fila = {
								0: "<center><button type='button' value='"+this.OperacionId+"' class='btnEditarOT btn btn-primary btn-xs' title='Editar' style='margin-right:5px'><span class='far fa-edit'></span></button><button type='button' value='"+this.OperacionId+"' class='btn btn-danger btn-xs btnEliminarItemOT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
								1: this.Operacion,
								2: this.ValorFrecuencia,
								3: tiempo,
								4: this.ValUltimoConsu,
								5: this.ValNotifica,

							}
							filas.push(fila);
						}
					});
					dtTblOperacionesConsumo.clear().draw();
					dtTblOperacionesConsumo.rows.add(filas).draw();
					dtTblOperacionesConsumoMaquinaria.clear().draw();
					dtTblOperacionesConsumoMaquinaria.rows.add(filas).draw();
					dtTblOperacionesConsumoComputo.clear().draw();
					dtTblOperacionesConsumoComputo.rows.add(filas).draw();
					dtTblOperacionesConsumoLocativa.clear().draw();
					dtTblOperacionesConsumoLocativa.rows.add(filas).draw();
					$(".CrearOperacionConsumo").attr('disabled', false);
				}else{
					tbl.clear().draw();
				}
				
				break;
				case 'DV':
				
				$.each(datos, function(){
					if (this.tipopersonal == 'C') {
						inf = 'Conductor';
					}else{
						inf = 'Propietario';
					}
					var fila = {
						0: this.nombre,
						1: inf+'<input type="text" class="hidden" value="'+this.tipopersonal+'">',
						2: this.telefono,
						3: this.correo,
						4: "<button type='button' value='"+this.personalvehiculoid+"' class='btnEditarDV btn btn-primary btn-xs' title='Editar' style='margin-right:5px'><span class='glyphicon glyphicon-pencil'></span></button><button type='button' value='"+this.personalvehiculoid+"' class='btn btn-danger btn-xs btnEliminarItemDV' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button>"
					}
					filas.push(fila);
				});
				tbl.clear().draw();
				tbl.rows.add(filas).draw();
				$("#CrearDatosVehiculo").attr('disabled', false);
				$("[id=placaVehiculo]").prop("disabled", true);
				
				break;
				
				default:
				alertify.error("!Error, comuniquese con el administrador del sistema.");
				break;

				if($CREAR  == 3){
					disabledBtn();
				}
			}
			
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}

function cargarDatosTablasVehiculo(tipo){
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/cargarDatosTablasVehiculo",
		type  : "POST",
		data: {
			tipo : tipo,
			ItemEquipoId : $ID,
		},
		success: function(resultado){
			datos = resultado ?  JSON.parse(resultado) : '';
			if(datos){
				var filas 	= [];
				var filas2 	= [];
				var filas3 	= [];

				dtTblcajaheramienta.clear().draw();
				dtTblEquipoCarretera.clear().draw();
				dtTblBotiquin.clear().draw();

				$.each(datos, function(){
					var fila = {
						0: this.Elemento,
						1: this.Cantidad,
						2: "<center><button type='button' value='"+this.ElementoVehiculoId+"' class='btnEditarOT btn btn-primary btn-xs' title='Editar' style='margin-right:5px'><span class='far fa-edit'></span></button><button type='button' value='"+this.ElementoVehiculoId+"' class='btn btn-danger btn-xs btnEliminarItemOT' title='Eliminar'><span class='far fa-trash-alt'></span></button></center>",
					}
					switch (this.Tipo) {
						case 'H':
							filas.push(fila);
							dtTblcajaheramienta.rows.add(filas).draw();
							break;
						case 'E':
							filas2.push(fila);
							dtTblEquipoCarretera.rows.add(filas2).draw();
							break;
						case 'B':
							filas3.push(fila);
							dtTblBotiquin.rows.add(filas3).draw();
							break;
					}
				});
				if($CREAR  == 3){
					disabledBtn();
				}
			}
			$(".CrearElemento").attr('disabled', false);
		}
	});
}

function disabledtab(){
	$('#tabVehib').addClass('disabled');
	$('#tabMaquib').addClass('disabled');
	$('#tabEquib').addClass('disabled');
	$('#tabLocab').addClass('disabled');
	$('#tabInfb').addClass('disabled');
}

function disabledBtn(){
	$(".btnEditarOT").prop("disabled", true);
	$(".btnAgregar").prop("disabled", true);
	$(".btnEliminarItemOT").prop("disabled", true);
}

function actualizarDatoSElemento($data,rastreo,id){
	
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/actualizarDatoSElemento",
		type  : "POST",
		data: {
			data  : $data,
			id    : id,
			RASTREO: RASTREO(rastreo, 'Elemento Vehiculo')
		},
		success: function(resultado){
			var resp = resultado;

			if (resultado == 1) {
				alertify.success("Datos Actualizados correctamente");
				cargarDatosTablasVehiculo();
				
			}else{
				alertify.error("!Error, no se pudieron guardar los datos; comuniquese con el administrador del sistema");
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}

function eliminarItemAnexo(rastreo,id){
	
	$.ajax({
		url: base_url()+"Administrativo/FichasTecnicas/cFichasTecnicas/eliminarItemAnexo",
		type  : "POST",
		data: {
			id    : id,
			RASTREO: RASTREO(rastreo, 'Elemento Anexo')
		},
		success: function(resultado){
			var resp = resultado;

			if (resultado == 1) {
				alertify.success("Datos Actualizados correctamente");
				cargarAnexos();
				
			}else{
				alertify.error("!Error, no se pudieron guardar los datos; comuniquese con el administrador del sistema");
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}


