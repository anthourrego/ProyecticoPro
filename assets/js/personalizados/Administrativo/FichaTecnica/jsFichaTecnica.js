var DTV,DTM,DTE,DTL,
GID 		= null,
CREAR 		= 0,
EDITAR 		= 0,
VER 		= 0,
OBTINF 		= 0,
GTBL 		= '';
TBM 		= 0,
TBC 		= 0,
TBL 		= 0,
MODULO 		= '',
ARRRASTREO 	= [],
ARREDITA 	= [],
lastFocus 	= '';

var config = {
	data:{
		tblID : "#tblCRUDVehiculo",
		select: [
			"'' AS Acciones"
			,"V.VehiculoId"
			,"E.Nombre"
			,"I.Serial "
			,"V.Placa"
			,"V.Linea"
			,"V.Tipo"
			,"V.Color "
			,"V.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado"
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
			,"VehiculoId"
			,'Nombre'			
			,'Serial'
			,'Placa'
			,'Linea'				 
			,'Tipo'				 
			,'Color'				 
			,'Observacion'				 
			,'Estado'			 
		],
		column_search : [
			"V.VehiculoId"
			,"E.Nombre"
			,"I.Serial "
			,"V.Placa"
			,"V.Linea"
			,"V.Tipo"
			,"V.Color "
			,"V.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END"
		],
		orden : {"V.VehiculoId": 'DESC'},
		columnas : [
			"Acciones"
			,"VehiculoId"
			,'Nombre'			
			,'Serial'
			,'Placa'
			,'Linea'				 
			,'Tipo'				 
			,'Color'				 
			,'Observacion'				 
			,'Estado'
		]
	},
	processing: true,
	serverSide: true,
	order: [[1, 'DESC']],
	draw: 10,
	language,
	fixedColumns: true,
	pageLength: 10,
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 500,
	scroller: {
			loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		// {targets: [0], width :'30px'},
		{targets: [1], visible : false},
	],
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)'}}
	],
	initComplete: function(){
	},
	createdRow: function(row,data,dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="ver btn btn-info btn-xs" value="`+data[1]+`" data-class="DataVehi" data-tab="Tvehiculo" data-tipo="Vehiculo" data-clave="VehiculoId" title="Ver" style="margin-bottom:3px"><span class="fas fa-eye"></span></button>
					<button class="editar btn btn-success btn-xs" value="`+data[1]+`" data-class="DataVehi" data-tab="Tvehiculo" data-tipo="Vehiculo" data-clave="VehiculoId" title="Editar" style="margin-bottom:3px"><span class="far fa-edit"></span></button>
					<button class="eliminar btn btn-danger btn-xs" value="`+data[1]+`" data-ficha="Vehículo" data-tipo="Vehiculo" data-tabla="tblCRUDVehiculo" data-clave="VehiculoId" data-equipo="`+data[2]+`" data-serial="`+data[3]+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>
		`);
	}
}

var config2 = {
	data:{
		tblID : "#tblCRUDMaquinaria",
		select: [
			"'' AS Acciones"
			,"M.MaquinariaId"
			,"E.Nombre"
			,"I.Serial "
			,"M.ResponUso"
			,"M.Ubicacion"
			,"M.CodActivoFijo"
			,"M.Caracteristica"
			,"M.Tipo"
			,"M.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado"
		],
		table : [
			'Maquinaria M',
			[
				[`ItemEquipo I`, 'M.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			"Acciones"
			,"MaquinariaId"
			,'Nombre'			
			,'Serial'
			,'ResponUso'
			,'Ubicacion'				 
			,'CodActivoFijo'				 
			,'Caracteristica'				 
			,'Tipo'
			,'Observacion'				 
			,'Estado'			 
		],
		column_search : [
			"M.MaquinariaId"
			,"E.Nombre"
			,"I.Serial "
			,"M.ResponUso"
			,"M.Ubicacion"
			,"M.CodActivoFijo"
			,"M.Caracteristica"
			,"M.Tipo"
			,"M.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END"
		],
		orden : {"M.MaquinariaId": 'DESC'},
		columnas : [
			"Acciones"
			,"MaquinariaId"
			,'Nombre'			
			,'Serial'
			,'ResponUso'
			,'Ubicacion'				 
			,'CodActivoFijo'				 
			,'Caracteristica'				 
			,'Tipo'
			,'Observacion'				 
			,'Estado'	
		]
	},
	processing: true,
	serverSide: true,
	order: [[1, 'DESC']],
	draw: 10,
	language,
	fixedColumns: true,
	pageLength: 10,
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 500,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{targets: [0], width :'30px !important'},
		{targets: [1], visible : false},
	],
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)'}}
	],
	initComplete: function(){
	},
	createdRow: function(row,data,dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="ver btn btn-info btn-xs" value="`+data[1]+`" data-class="DataMaqui" data-tab="TMaquinaria" data-tipo="Maquinaria" data-clave="MaquinariaId" title="Ver" style="margin-bottom:3px"><span class="fas fa-eye"></span></button>
					<button class="editar btn btn-success btn-xs" value="`+data[1]+`" data-class="DataMaqui" data-tab="TMaquinaria" data-tipo="Maquinaria" data-clave="MaquinariaId" title="Editar" style="margin-bottom:3px"><span class="far fa-edit"></span></button>
					<button class="eliminar btn btn-danger btn-xs" value="`+data[1]+`" data-ficha="Maquinaria" data-tipo="Maquinaria" data-tabla="tblCRUDMaquinaria" data-clave="MaquinariaId" data-equipo="`+data[2]+`" data-serial="`+data[3]+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>
		`);
	}
}

var config3 = {
	data:{
		tblID : "#tblCRUDComputo",
		select: [
			"'' AS Acciones"
			,"C.EquipoComputoId "
			,"E.Nombre"
			,"I.Serial "
			,"CAST(C.FechaRegistro AS DATE) AS FechaRegistro"
			,"CASE C.TipoComputo WHEN 'ES' THEN 'Escritorio' WHEN 'PO' THEN 'Portatil' WHEN 'SE' THEN 'Servidor' END AS TipoComputo"
			,"C.Condiciones"
			,"C.Color"
			,"C.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado"
		],
		table : [
			'EquipoComputo C',
			[
				[`ItemEquipo I`, 'C.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			"Acciones"
			,"EquipoComputoId"
			,'Nombre'			
			,'Serial'
			,'FechaRegistro'
			,'TipoComputo'				 
			,'Condiciones'				 
			,'Color'				 
			,'Observacion'
			,'Estado'				 
		],
		column_search : [
			"C.EquipoComputoId "
			,"E.Nombre"
			,"I.Serial "
			,"CAST(C.FechaRegistro AS DATE)"
			,"CASE C.TipoComputo WHEN 'ES' THEN 'Escritorio' WHEN 'PO' THEN 'Portatil' WHEN 'SE' THEN 'Servidor' END"
			,"C.Condiciones"
			,"C.Color"
			,"C.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END"
		],
		orden : {"M.MaquinariaId": 'DESC'},
		columnas : [
			"Acciones"
			,"EquipoComputoId"
			,'Nombre'			
			,'Serial'
			,'FechaRegistro'
			,'TipoComputo'				 
			,'Condiciones'				 
			,'Color'				 
			,'Observacion'
			,'Estado'	
		]
	},
	processing: true,
	serverSide: true,
	order: [[1, 'DESC']],
	draw: 10,
	language,
	fixedColumns: false,
	pageLength: 10,
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 450,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{targets: [0], width :'30px !important'},
		{targets: [1], visible : false},
	],
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)'}}
	],
	initComplete: function(){
	},
	createdRow: function(row,data,dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="ver btn btn-info btn-xs" value="`+data[1]+`" data-class="DataEqui" data-tab="TEquipo" data-tipo="EquipoComputo" data-clave="EquipoComputoId" title="Ver" style="margin-bottom:3px"><span class="fas fa-eye"></span></button>
					<button class="editar btn btn-success btn-xs" value="`+data[1]+`" data-class="DataEqui" data-tab="TEquipo" data-tipo="EquipoComputo" data-clave="EquipoComputoId" title="Editar" style="margin-bottom:3px"><span class="far fa-edit"></span></button>
					<button class="eliminar btn btn-danger btn-xs" value="`+data[1]+`" data-ficha="EquipoComputo" data-tipo="EquipoComputo" data-tabla="tblCRUDComputo" data-clave="EquipoComputoId" data-equipo="`+data[2]+`" data-serial="`+data[3]+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>
		`);
	}
}

var config4 = {
	data:{
		tblID : "#tblCRUDLocativa",
		select: [
			"'' AS Acciones"
			,"L.LocativaId"
			,"E.Nombre"
			,"I.Serial"
			,"L.Estructura"
			,"L.Area"
			,"L.Accesorios"
			,"CAST(L.FechaRegistro AS DATE) AS FechaRegistro"
			,"L.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado"
		],
		table : [
			'Locativa L',
			[
				[`ItemEquipo I`, 'L.ItemEquipoId = I.ItemEquipoId', 'LEFT']	
				,[`Equipo E`, 'I.EquipoId = E.EquipoId', 'LEFT']
			]
		],
		column_order : [
			"Acciones"
			,"LocativaId"
			,'Nombre'			
			,'Serial'
			,'Estructura'
			,'Area'				 
			,'Accesorios'				 
			,'FechaRegistro'				 
			,'Observacion'
			,'Estado'				 
		],
		column_search : [
			"L.LocativaId"
			,"E.Nombre"
			,"I.Serial"
			,"L.Estructura"
			,"L.Area"
			,"L.Accesorios"
			,"CAST(L.FechaRegistro AS DATE) AS FechaRegistro"
			,"L.Observacion"
			,"CASE I.Estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado"
		],
		orden : {"M.MaquinariaId": 'DESC'},
		columnas : [
			"Acciones"
			,"LocativaId"
			,'Nombre'			
			,'Serial'
			,'Estructura'
			,'Area'				 
			,'Accesorios'				 
			,'FechaRegistro'				 
			,'Observacion'
			,'Estado'	
		]
	},
	processing: true,
	serverSide: true,
	order: [[1, 'DESC']],
	draw: 10,
	language,
	fixedColumns: true,
	pageLength: 10,
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 450,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{targets: [0], width :'30px !important'},
		{targets: [1], visible : false},
	],
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)'}}
	],
	initComplete: function(){
	},
	createdRow: function(row,data,dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="ver btn btn-info btn-xs" value="`+data[1]+`" data-class="DataLoca" data-tab="TLocativa" data-tipo="Locativa" data-clave="LocativaId" title="Ver" style="margin-bottom:3px"><span class="fas fa-eye"></span></button>
					<button class="editar btn btn-success btn-xs" value="`+data[1]+`" data-class="DataLoca" data-tab="TLocativa" data-tipo="Locativa" data-clave="LocativaId" title="Editar" style="margin-bottom:3px"><span class="far fa-edit"></span></button>
					<button class="eliminar btn btn-danger btn-xs" value="`+data[1]+`" data-ficha="Locativa" data-tipo="Locativa" data-tabla="tblCRUDLocativa" data-clave="LocativaId" data-equipo="`+data[2]+`" data-serial="`+data[3]+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>
		`);
	}
}

$(document).ready(function(){
	DTV = dtSS(config);
	DTM = dtSS(config2);
	DTE = dtSS(config3);
	DTL = dtSS(config4);
})

$('select.chosen-select').chosen({
	placeholder_text_single: ''
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){
	var self = this;
	if (lastFocus != $(this).find("option:selected").text() && $(this).val() != null && $(this).val() != '') {
		var exep = 0;
		if ($(this).attr('data-db') == 'ItemEquipoId' && verificaEquipo($(this).val(),$(this).attr('data-clave'),$(this).attr('data-tabla')) == 1 && CREAR == 1) {
			exep = 1;
			$(this).val("").trigger("chosen:updated");
			alertify.alert("Atención","El equipo seleccionado ya se encuentra registrado como ficha tecnica de vehículo",function(){
				setTimeout(function(){ $(self).trigger("chosen:open") },350)
			});
		}

		if(exep == 0){
			MODULO = $(this).attr('data-tabla');
			guardarValores(this);
		}
	}
}).on('chosen:showing_dropdown',function(){
	lastFocus = $(this).find("option:selected").text();
});

$("[data-rastreo]").on('focusin',function(){
	if ($(this).is('select')) {
		lastFocus = $(this).find('option:selected').text();
	}else{
		lastFocus = $(this).val();
	}
}).on('focusout',function(){
	var value = $(this).is('select') ? $(this).find("option:selected").text() : $(this).val();
	if (value != lastFocus) {
		guardarValores(this);
	}
})

$(".collapsed").on("click",function(e){
	e.preventDefault();
});

$(".btnRegistro").on("click",function(e){
	e.preventDefault();
	CREAR = 1;
	$(document).find(".btnGuardar").prop("disabled",false);
	$(".txtDisabled").val("");
	$("."+$(this).attr('data-tab')+"").addClass('d-none');
	$("."+$(this).attr('data-class')+"").removeClass('d-none');
	limpiarForm($(this).attr('data-tipo'));
});

$("#tabV, #tabM, #tabC, #tabL").on("click",function(e){
	e.preventDefault();
	switch ($(this).attr('id')) {
		case 'tabV' :
			setTimeout(function(){ DTV.columns.adjust() },100)
			break;
		case 'tabM':
			setTimeout(function(){ DTM.columns.adjust() },100)
			break;
		case 'tabC':
			setTimeout(function(){ DTE.columns.adjust() },100)
			break;
		case 'tabL':
			setTimeout(function(){ DTL.columns.adjust() },100)
			break;
		default:
			break;
	}
});

$(".btnCancelar").on("click",function(e){
	e.preventDefault();
	if (GID != null && CREAR == 1) {
		$.ajax({ 
			url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/eliminarTemporal",
			type: 'POST',
			async: false,
			data: {
				Id 		: GID,
				Tabla 	: $(this).attr("data-tabla"),
				Clave 	: $(this).attr("data-clave")
			},
			success: function(respuesta){
				if (respuesta == 1) {

				}
			}
		});
	}

	$("."+$(this).attr('data-class')+"").addClass('d-none');
	$("."+$(this).attr('data-tab')+"").removeClass('d-none');
	reiniciarVariables();
});

$(".btnOP").on("click",function(e){
	e.preventDefault();
	dt 		= obtenerDT($(this).attr('data-tipo'));
	tabla 	= $(this).attr('data-tabla');
	GTBL 	= $(this).attr('data-tabla');
	if ($(this).attr('data-op') == 'T') {
		var row = {
			0: $INPUTOT,
			1: '<input class="form-control form-control-sm numerico">',
			2: $VALMEDIDA,
			3: $DATETABLAFECHA,
			4: '<input class="form-control form-control-sm" disabled>',
			5: '<input class="form-control form-control-sm numerico diasOP">', 
			6: "<center><div class='btn-group btn-group-xs'><button type='button' class='guardar btn btn-success btn-xs'data-modu='"+$(this).attr('data-modu')+"' data-op='"+$(this).attr('data-op')+"' data-tabla="+tabla+" data-tipo='"+$(this).attr('data-tipo')+"' title='Guardar'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelar' title='Eliminar'><span class='fas fa-times'></span></button></div></center>",
		}
	}else{
		var row = {
			0: $INPUTOC,
			1: '<input class="form-control form-control-sm numerico">',
			2: $UNDMEDIDA,
			3: '<input class="form-control form-control-sm numerico ultOP">',
			4: '<input class="form-control form-control-sm numerico valNOTI">', 
			5: "<center><div class='btn-group btn-group-xs'><button type='button' class='guardar btn btn-success btn-xs'data-modu='"+$(this).attr('data-modu')+"' data-op='"+$(this).attr('data-op')+"' data-tabla="+tabla+" data-tipo='"+$(this).attr('data-tipo')+"' title='Guardar'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelar' title='Eliminar'><span class='fas fa-times'></span></button></div></center>",
		}
	}
	dt.row.add(row).draw();
	dt.order([0,'desc']).draw();
	$("#"+tabla+" tbody tr").first().find("td input").eq(0).focus();
	$(this).attr('disabled', true);
	$('.numerico').inputmask({
		alias 		: 'integer',
		rightAlign 	: false
	});
	$('select.chosen-select').chosen({
		placeholder_text_single: ''
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	})
});

$(".btnANX").on("click", function(e){
	e.preventDefault();
	var dt = obtenerDT($(this).attr('data-tabla'));
	var row = {
		0: "",
		1: '<input type="file"  name="Lista_Anexos[]" id="anexosDoc"  class="anexarArchivos" accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >',
		2: "<center><div class='btn-group btn-group-xs'><button type='button' class='guardar btn btn-success btn-xs' data-tabla='"+$(this).attr('data-tabla')+"' title='Guardar'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelar' title='Eliminar'><span class='fas fa-times'></span></button></div></center>"
	}
	dt.row.add(row).draw();
	dt.order([0,'asc']).draw();
	$(this).attr('disabled', true);
});

$(document).on("click",".cargaOP",function(e){
	e.preventDefault();
	var self = this;
	if (GID != null) {
		$("#mOperacion").unbind().on("shown.bs.modal",function(){
			$(".rowDataOpe").empty();
			var tipo  = $(self).attr('data-tipo');
			var opera = obtenerOperacion($(self).attr('data-tipo'));
			if (opera.length > 0) {
				for (var i = 0; i < opera.length; i++) {
					var x = `
						<div class="col-12 mb-2">
							<div class="input-group">
								<input type="" name="" class="form-control mr-1" readonly value="`+opera[i].Nombre+`" title="`+opera[i].Nombre+`">
								<button type="button" class="btn btn-primary f-r" title="Seleccionar operación" id="btnCA" data-nombre="`+opera[i].Nombre+`" data-id="`+opera[i].ActividadEquipoId+`" data-tiempo="`+opera[i].TiempoOperacion+`" data-dia="`+opera[i].DiasAlerta+`" data-und="`+opera[i].UnidadMedidaId+`"><i class="fas fa-check-circle"></i></button>
							</div>
						</div>
					`;
					$(".rowDataOpe").append(x);
				}
				$(document).on("click","#btnCA",function(e){
					e.preventDefault();
					$(".nomOP").val($(this).attr('data-nombre')).prop("disabled",true);
					$(".nomOP").attr('data-id',$(this).attr('data-id'));
					$(".nomOP").attr('title',$(this).attr('title'));
					if (tipo == 'T') {
						$(".tiempoOP").val($(this).attr('data-tiempo')).prop("disabled",true);
						$(".diasOP").val($(this).attr('data-dia')).prop("disabled",true);
					}else{
						$(".undOP").val($(this).attr('data-und')).prop("disabled",true).trigger("chosen:updated")
					}
					$("#mOperacion").modal("hide");
				})
			}else{
				var x = `
					<div class="col-12">
						<div class="col-12 mb-2 alert alert-danger">
							No hay registros disponibles para seleccionar.
						</div>
					</div>
				`;
				$(".rowDataOpe").append(x);
			}
		}).on("hidden.bs.modal",function(){
			$("#"+GTBL+" tbody tr").first().find("td input").eq(1).focus();
			$("[data-db=ItemEquipoId][data-tabla="+MODULO+"]").prop("disabled",true).trigger("chosen:updated");
		});

		$("#mOperacion").modal("show");
	}else{
		alertify.alert("Atención","Para cargar operaciones debe de seleccionar el equipo para la ficha tecnica.");
	}
});

$(".tblPPAL").on("click",".editar",function(e){
	$("."+$(this).attr('data-tab')+"").addClass('d-none');
	$("."+$(this).attr('data-class')+"").removeClass('d-none');
	$(document).find(".btnGuardar").prop("disabled",false);
	limpiarForm($(this).attr('data-tipo'));
	EDITAR 	= 1;
	OBTINF 	= 1;
	GID 	= $(this).attr('value');
	obtenerDataFT($(this).attr('value'),this);
});

$(".tblPPAL").on("click",".ver",function(e){
	e.preventDefault();
	$(".btnOP").prop("disabled",true);
	$(".btnANX").prop("disabled",true);
	$(".btnEV").prop("disabled",true);

	$("."+$(this).attr('data-tab')+"").addClass('d-none');
	$("."+$(this).attr('data-class')+"").removeClass('d-none');
	$(document).find(".btnGuardar").prop("disabled",true);
	limpiarForm($(this).attr('data-tipo'));
	VER 	= 1;
	OBTINF 	= 1;
	GID 	= $(this).attr('value');
	obtenerDataFT($(this).attr('value'),this);
})

$(".tblPPAL").on("click",".eliminar",function(e){
	e.preventDefault();
	var self = this;
	var rastreo = "Elimina ficha tecnica de ["+$(self).attr('data-ficha')+"] [Id : "+$(self).attr('value')+"] [Equipo : "+$(self).attr('data-equipo')+"] [Serial : "+$(self).attr('data-serial')+"]";
	alertify.confirm('Eliminar ficha tecnica', '¿ Está seguro de eliminar el registro de '+$(self).attr('data-ficha')+' ?', function(){
		eliminarFT($(self).attr('value'),rastreo,self);
	}, function(){});
})

$(".tblOPT, .tblOPC").on("click",".guardar",function(e){
	e.preventDefault();
	var self = this;
	var tipo = "";
	if ($(this).attr('data-op') == 'T') {
		tipo = "Tiempo";
		$data = {
			ItemEquipoId 	: $("[data-db=ItemEquipoId][data-tabla="+MODULO+"]").find("option:selected").val(),
			TipoOperacion 	: 'T',
			Operacion 		: $(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined ? $(this).closest('tr').find('td:eq(0) input').val() : null, 
			ValorFrecuencia	: $(this).closest('tr').find('td:eq(1) input').val(),
			TiempoOperacion	: $(this).closest('tr').find('td:eq(2) select').val(),
			UltimaFecha		: $(this).closest('tr').find('td:eq(3) input').val(),
			ProximaFecha 	: sumaDiasFecha($(this).closest('tr').find('td:eq(3) input').val(),parseInt($(this).closest('tr').find('td:eq(1) input').val()),$(this).closest('tr').find('td:eq(2) select').val()),
			DiasAlerta		: $(this).closest('tr').find('td:eq(5) input').val(),
			ActividadEquipoId : $(this).closest('tr').find('td:eq(0) input').attr('data-id') != undefined ? parseInt($(this).closest('tr').find('td:eq(0) input').attr('data-id')) : null
		}
	}else{
		tipo = "Consumo";
		$data = {
			ItemEquipoId 	: $("[data-db=ItemEquipoId][data-tabla="+MODULO+"]").find("option:selected").val(),
			TipoOperacion 	: 'C',
			Operacion 		: $(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined ? $(this).closest('tr').find('td:eq(0) input').val() : null, 
			ValorFrecuencia	: $(this).closest('tr').find('td:eq(1) input').val(),
			UnidadId		: $(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined ? $(this).closest('tr').find('td:eq(2) select').val() : null,
			ValUltimoConsu	: $(this).closest('tr').find('td:eq(3) input').val(),
			ValNotifica 	: $(this).closest('tr').find('td:eq(4) input').val(),
			ActividadEquipoId : $(this).closest('tr').find('td:eq(0) input').attr('data-id') != undefined ? parseInt($(this).closest('tr').find('td:eq(0) input').attr('data-id')) : null
		}
	}

	if ($data.ItemEquipoId == null || $data.Operacion == '' || $data.ValorFrecuencia == '' || $data.TiempoOperacion == ''
		|| $data.UltimaFecha == '' || $data.ProximaFecha == '' || $data.DiasAlerta == '') {
		alertify.alert("Atención","Para guardar operaciones de tiempo : <br>* Todos los campos deben de estar diligenciados.<br>* Debe tener seleccionado 1(un) equipo (en la parte inicial de la ficha tecnica).");
	}else{
		var rastreo = "Crea operación de ["+tipo+"] [Operación : "+$data.Operacion+"]";
		$.ajax({ 
			url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/guardarOP",
			type: 'POST',
			async: false,
			data: {
				Data 	: $data,
				RASTREO : RASTREO(rastreo,"Fichas tecnicas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					$(".btnOP").prop("disabled",false);

					var dt   = obtenerDT($(self).attr('data-tipo'));
					var tbl  = $(self).attr('data-tabla');
					var tipo = $(self).attr('data-tipo');
					GTBL 	 = '';
					alertify.success("Datos guardados exitosamente.");

					obtenerDataTabla(tabla,dt,$data.TipoOperacion);
				}else{
					alertify.alert("Atención",msgAlerta.errorAdmin);
				}
			}
		});
	}
});

$(".tblOPT, .tblOPC").on("click",".editar",function(e){
	e.preventDefault();
	GTBL = $(this).attr('data-tabla');
	dataRelemento = [];
	dataRelemento.push($(this).closest('tr').find('td:eq(0) input').val());
	dataRelemento.push($(this).closest('tr').find('td:eq(2) select').find('option:selected').attr('data-tipo'));
	if ($(this).attr('data-tipo') == 'T') {
		$(this).closest('tr').find('td:eq(0) button').attr('disabled', false);

		if ($(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined) {
			$(this).closest('tr').find('td:eq(0) input').attr('disabled', false);
			$(this).closest('tr').find('td:eq(0) button').attr('disabled', true);
			$(this).closest('tr').find('td:eq(2) select').attr('disabled', false);
			$(this).closest('tr').find('td:eq(5) input').attr('disabled', false);
		}

		$(this).closest('tr').find('td:eq(1) input').attr('disabled', false);
		fecha = $(this).closest('tr').find('td:eq(3)').text().trim();
		$(this).closest('tr').find('td:eq(3)').html($DATETABLAFECHA);
		$(document).find('.mFecha').val(fecha);
		$(this).closest('tr').find('td:eq(6) .btn-success span').removeClass('far fa-edit').addClass('far fa-save');
		$(this).closest('tr').find('td:eq(6) .btn-success').removeClass("editar").addClass('actualizar').attr("title","Actualizar");
		$(this).closest('tr').find('td:eq(6) .btn-danger span').removeClass('far fa-trash-alt').addClass('fas fa-times');
		$(this).closest('tr').find('td:eq(6) .btn-danger').removeClass("eliminar").addClass('cancelarAC').attr('title', "Cancelar edición");
	}else{
		$(this).closest('tr').find('td:eq(0) button').attr('disabled', false);

		if ($(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined) {
			$(this).closest('tr').find('td:eq(0) input').attr('disabled', false);
			$(this).closest('tr').find('td:eq(0) button').attr('disabled', true);
			$(this).closest('tr').find('td:eq(2) select').attr('disabled', false).trigger("chosen:updated");
		}
		
		$(this).closest('tr').find('td:eq(1) input').attr('disabled', false);
		$(this).closest('tr').find('td:eq(3) input').attr('disabled', false);
		$(this).closest('tr').find('td:eq(4) input').attr('disabled', false);
		$(this).closest('tr').find('td:eq(5) .btn-success span').removeClass('far fa-edit').addClass('far fa-save');
		$(this).closest('tr').find('td:eq(5) .btn-success').removeClass("editar").addClass('actualizar').attr("title","Actualizar");
		$(this).closest('tr').find('td:eq(5) .btn-danger span').removeClass('far fa-trash-alt').addClass('fas fa-times');
		$(this).closest('tr').find('td:eq(5) .btn-danger').removeClass("eliminar").addClass('cancelarAC').attr('title', "Cancelar edición");
	}
	$(this).closest('tr').find('td:eq(0) input').focus();
});

$(".tblOPT, .tblOPC").on("click",".cancelarAC",function(e){
	e.preventDefault();
	var dt = obtenerDT($(this).attr('data-tabla'));
	obtenerDataTabla($(this).attr('data-tabla'),dt,$(this).attr('data-tipo'));
	GTBL = '';
});

$(".tblOPT, .tblOPC").on("click",".actualizar",function(e){
	e.preventDefault();
	var self = this;
	var tipo = '';
	if ($(this).attr('data-tipo') == 'T') {
		tipo = "Tiempo";
		$data = {
			TipoOperacion 	: 'T',
			Operacion 		: $(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined ? $(this).closest('tr').find('td:eq(0) input').val() : null, 
			ValorFrecuencia	: $(this).closest('tr').find('td:eq(1) input').val(),
			TiempoOperacion	: $(this).closest('tr').find('td:eq(2) select').val(),
			UltimaFecha		: $(this).closest('tr').find('td:eq(3) input').val(),
			ProximaFecha 	: sumaDiasFecha($(this).closest('tr').find('td:eq(3) input').val(),parseInt($(this).closest('tr').find('td:eq(1) input').val()),$(this).closest('tr').find('td:eq(2) select').val()),
			DiasAlerta		: $(this).closest('tr').find('td:eq(5) input').val(),
			ActividadEquipoId : $(this).closest('tr').find('td:eq(0) input').attr('data-id') != undefined ? parseInt($(this).closest('tr').find('td:eq(0) input').attr('data-id')) : null
		}
	}else{
		tipo = "Consumo";
		$data = {
			TipoOperacion 	: 'C',
			Operacion 		: $(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined ? $(this).closest('tr').find('td:eq(0) input').val() : null, 
			ValorFrecuencia	: $(this).closest('tr').find('td:eq(1) input').val(),
			UnidadId		: $(this).closest('tr').find('td:eq(0) input').attr('data-id') == undefined ? $(this).closest('tr').find('td:eq(2) select').val() : null,
			ValUltimoConsu	: $(this).closest('tr').find('td:eq(3) input').val(),
			ValNotifica 	: $(this).closest('tr').find('td:eq(4) input').val(),
			ActividadEquipoId : $(this).closest('tr').find('td:eq(0) input').attr('data-id') != undefined ? parseInt($(this).closest('tr').find('td:eq(0) input').attr('data-id')) : null
		}
	}

	if ( ($data.ActividadEquipoId == null && $data.Operacion == null) || $data.ValorFrecuencia == '' || $data.TiempoOperacion == ''
		|| $data.UltimaFecha == '' || $data.ProximaFecha == '' || $data.DiasAlerta == '') {
		alertify.alert("Atención","Para actualizar operaciones de tiempo : <br>* Todos los campos deben de estar diligenciados.<br>* Debe tener seleccionado 1(un) equipo (en la parte inicial de la ficha tecnica).");
	}else{
		var rastreo = "Edita operación de ["+tipo+"] [Id : "+$(self).attr('value')+"] [Operación : "+dataRelemento[0]+" => "+$data.Operacion+"] [Medida : "+dataRelemento[1]+" => "+$(this).closest('tr').find('td:eq(2) select').find("option:selected").attr('data-tipo')+"]";
		$.ajax({ 
			url  : base_url() + "Administrativo/FichaTecnica/cFichaTecnica/actualizarOP",
			type : 'POST',
			async: false,
			data : {
				Id 		: $(self).attr('value'),
				Data 	: $data,
				RASTREO : RASTREO(rastreo,"Fichas tecnicas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					$(".btnOP").prop("disabled",false);

					var dt   = obtenerDT($(self).attr('data-tabla'));
					var tbl  = $(self).attr('data-tabla');
					var tipo = $(self).attr('data-tipo');
					GTBL 	 = '';
					alertify.success("Datos actualizados exitosamente.");

					obtenerDataTabla(tabla,dt,$data.TipoOperacion);
				}else{
					alertify.alert("Atención",msgAlerta.errorAdmin);
				}
			}
		});
	}
});

$(".tblOPT, .tblOPC").on("click",".eliminar",function(e){
	e.preventDefault();
	var self = this;
	var rastreo = "Elimina operación [Id : "+$(self).attr('value')+"] [Operacion : "+$(this).closest('tr').find('td:eq(0) input').val()+"]";
	alertify.confirm('Eliminar operación', '¿ Está seguro de eliminar el registro ?', function(){
		eliminarOperacion($(self).attr('value'),rastreo,self);
	}, function(){});
});

$(".tblANX").on("click",".guardar",function(e){
	e.preventDefault();
	var dt 	 = obtenerDT($(this).attr('data-tabla'));
	var self = this;

	if (typeof FormData !== 'undefined') {
		var form_data = new FormData();
		form_data.append('Lista_Anexos', $("[id=anexosDoc]")[0].files[0]);
		form_data.append('Id', GID);
		$.ajax({
			url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/guardarAnexo",
			type: "POST",
			data: form_data,
			async	: false,
			cache	: false,
			contentType : false,
			processData : false,
			success: function(resultado){
				var resultado = JSON.parse(resultado);
				
				switch (resultado) {
					case 0:
					case 3:
						alertify.alert("Atención",msgAlerta.errorAdmin,function(){
							dt.row( $(self).closest('tr') ).remove().draw();
						});
						break;
					case 1:
						alertify.success("Datos guardados exitosamente.");
						$(".btnANX").attr('disabled', false);
						obtenerDataTabla($(self).attr('data-tabla'),dt,'ANX');
						break;
					case 2:
						alertify.alert("Atención","Debe de seleccionar 1(un) anexo para subir.");
						break;
					case 4:
						alertify.alert("Atención","* El anexo contiene caracteres especiales en el nombre.<br> * El anexo supera el maximo de peso permitido 2MB");
						break;
					default:
						break;
				}
			}
		});
	}
});

$(".tblANX").on("click",".eliminar",function(e){
	e.preventDefault();
	var self = this;
	alertify.confirm('Eliminar anexo', '¿ Está seguro de eliminar el registro ?', function(){
		eliminarAnexo($(self).attr('value'),self);
	}, function(){});
});

$("#frmVehiculo, #frmMaquinaria, #frmComputo, #frmLocativa").on("submit",function(e){
	e.preventDefault();
	console.log("hola");
	var exep = 0;
	var self = this;
	if($(this).valid()){
		if (CREAR == 1) {
			alertify.success("Datos guardados exitosamente.");
			$("."+$(this).find("#btnGuardar").attr('data-class')+"").addClass('d-none');
			$("."+$(this).find("#btnGuardar").attr('data-tab')+"").removeClass('d-none');
			obtenerDT($(this).find("#btnGuardar").attr('data-tabla'));
		}else if (EDITAR == 1 && ARRRASTREO.length > 0) {
			$.ajax({ 
				url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/editarValores",
				type: 'POST',
				async: false,
				data: {
					Tipo 	: 2,
					Id 		: GID,
					Clave 	: $(this).find("#btnGuardar").attr('data-clave'),
					Tabla 	: $(this).find("#btnGuardar").attr('data-tbl'),
					Data 	: ARRRASTREO,
					RASTREO : RASTREO(ARREDITA,"Fichas tecnicas")
				},
				success: function(respuesta){
					if (respuesta == 1) {
						alertify.success("Datos actualizados exitosamente.");
						$("."+$(self).find("#btnGuardar").attr('data-class')+"").addClass('d-none');
						$("."+$(self).find("#btnGuardar").attr('data-tab')+"").removeClass('d-none');
						obtenerDT($(self).find("#btnGuardar").attr('data-tabla'));
					}
				}
			});
		}else{
			alertify.success("Datos actualizados exitosamente.");
			$("."+$(self).find("#btnGuardar").attr('data-class')+"").addClass('d-none');
			$("."+$(self).find("#btnGuardar").attr('data-tab')+"").removeClass('d-none');
			obtenerDT($(self).find("#btnGuardar").attr('data-tabla'));
		}
		reiniciarVariables();
	}else{
		alertify.alert("Atención","Debe diligenciar los campos obligatorios (*)")
	}
})

function guardarValores(self){
	var datoRas = $(self).is("select") ? $(self).find("option:selected").text() : $(self).val();

	if (GID == null) {
		$.ajax({ 
			url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/guardarValores",
			type: 'POST',
			async: false,
			data: {
				Tabla 	: $(self).attr('data-tabla'),
				Campo 	: $(self).attr('data-db'),
				Valor 	: $(self).val(),
				RASTREO : RASTREO("Crea nueva ficha tecnica de ["+$(self).attr('data-tabla')+"] ["+$(self).attr('data-rastreo')+" : "+datoRas+"]","Fichas tecnicas")
			},
			success: function(respuesta){
				try {
					respuesta = JSON.parse(respuesta);
					if (respuesta.Inserta == 1) {
						GID = respuesta.Id;
					}else{
						alertify.alert("Atención",msgAlerta.errorAdmin);	
					}
				} catch(e) {
					alertify.alert("Atención",msgAlerta.errorAdmin);
					console.log(e);
				}
			}
		});
	}else{
		var rastreo = 'Modfica ficha tecnica ['+$(self).attr('data-tabla')+'] ['+$(self).attr('data-db')+' : '+lastFocus+' => '+datoRas+']'; 
		if (EDITAR == 1) {
			if (OBTINF == 0) {
				var obj = {};
				obj[$(self).attr('data-db')] = $(self).val();
				ARRRASTREO.push(obj);
				ARREDITA.push(rastreo);
			}
		}else{

			$.ajax({ 
				url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/editarValores",
				type: 'POST',
				async: false,
				data: {
					Id 		: GID,
					Tabla 	: $(self).attr('data-tabla'),
					Campo 	: $(self).attr('data-db'),
					Valor 	: $(self).val(),
					RASTREO : RASTREO(rastreo,"Fichas tecnicas")
				},
				success: function(respuesta){
					if (respuesta == 0) {
						alertify.alert("Atención",msgAlerta.errorAdmin);
					}
				}
			});
		}
	}
}

function verificaEquipo(id,clave,tabla){
	var resp = 0;
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/verificaEquipo",
		type: 'POST',
		async: false,
		data: {
			Id 		: id,
			Clave 	: clave,
			Tabla 	: tabla
		},
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (respuesta.Equipo.length > 0 && CREAR == 1) {
					resp = 1;
				}else{
					for(var x in respuesta.Data[0]){
						$("[data-db="+x+"]").val(respuesta.Data[0][x]);
					}
				}
			} catch(e) {
				alertify.alert("Error","Comuniquese con el administrador del sistema.");
				console.log(e);
			}
		}
	});
	return resp;
}

function obtenerDataTabla(tabla,dt,tipo){
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/obtenerDataTabla",
		type: 'POST',
		async: false,
		data: {
			Id 		: GID,
			Id2		: $("[data-db=ItemEquipoId][data-tabla="+MODULO+"]").find("option:selected").val(),
			Tabla 	: tabla,
			Tipo 	: tipo
		},
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				dt.clear().draw();
				if (respuesta.length > 0) {
					var filas = [];
					switch (tabla) {
						case 'ElementoVehiculo':
							$.each(respuesta,function(){
								var fila = {
									0 : this.Elemento,
									1 : this.Cantidad,
									2 : "<center><div class='btn-group btn-group-xs'><button type='button' class='editar btn btn-success btn-xs' title='Editar' data-tipo='"+tipo+"' value='"+this.ElementoVehiculoId+"' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-edit'></span></button><button type='button' class='btn btn-danger btn-xs eliminar' data-tipo="+tipo+" value='"+this.ElementoVehiculoId+"' title='Eliminar' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-trash-alt'></span></button></div></center>"
								}
								filas.push(fila);
							})
							break;
						case 'tblOperacionTV' :
						case 'tblOperacionTM':
						case 'tblOperacionTE':
						case 'tblOperacionTL':
							$.each(respuesta,function(){
								$INPUT = `
									<div class="input-group">
										<button class="btn btn-sm btn-primary mr-1 cargaOP" title="Cargar operación" data-tipo="T" disabled>
											<i class="fas fa-upload"></i>
										</button>
										<input class="form-control form-control-sm nomOP" `+(this.ActividadEquipoId == null ? '' : 'data-id="'+this.ActividadEquipoId+'"')+` title="`+this.Operacion+`" value="`+this.Operacion+`" disabled>
									</div>
								`;
								$MEDIDA = `
									<select class="form-control form-control-sm undMedidaTiempo tiempoOP w-100" disabled>
										<option value="001" `+(this.Tiempo == 'Dias' ? 'selected' : '')+`>Dias</option>
										<option value="002" `+(this.Tiempo == 'Semanas' ? 'selected' : '')+`>Semanas</option>
										<option value="003" `+(this.Tiempo == 'Meses' ? 'selected' : '')+`>Meses</option>
										<option value="004" `+(this.Tiempo == 'Anios' ? 'selected' : '')+`>Años</option>
									</select>
								`;
								var fila = {
									0 : $INPUT,
									1 : '<input class="form-control form-control-sm numerico" value="'+this.ValorFrecuencia+'" disabled>',
									2 : $MEDIDA,
									3 : this.UltimaFecha,
									4 : '<input class="form-control form-control-sm" value="'+this.ProximaFecha+'" disabled>',
									5 : '<input class="form-control form-control-sm numerico" value="'+this.DiasAlerta+'" disabled>',
									6 : "<center><div class='btn-group btn-group-xs'><button type='button' class='editar btn btn-success btn-xs' data-tabla='"+tabla+"' data-tipo='"+tipo+"' title='Editar' value='"+this.OperacionId+"' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-edit'></span></button><button type='button' class='btn btn-danger btn-xs eliminar' data-tabla='"+tabla+"' data-tipo='"+tipo+"' value='"+this.OperacionId+"' title='Eliminar' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-trash-alt'></span></button></div></center>"
								}
								filas.push(fila);
							});
							break;
						case 'tblOperacionCV' :
						case 'tblOperacionCM' :
						case 'tblOperacionCE' :
						case 'tblOperacionCL' :
							$.each(respuesta,function(){
								$INPUT = `
									<div class="input-group">
										<button class="btn btn-sm btn-primary mr-1 cargaOP" title="Cargar operación" data-tipo="C" disabled>
											<i class="fas fa-upload"></i>
										</button>
										<input class="form-control form-control-sm nomOP" `+(this.ActividadEquipoId == null ? '' : 'data-id="'+this.ActividadEquipoId+'"')+` title="`+this.Operacion+`" value="`+this.Operacion+`" disabled>
									</div>
								`;

								$UND = `
									<select class="form-control form-control-sm chosen-select undOP" id="equipoOC" disabled>
										<option value="" disabled>Seleccione unidad de medida...</option>
										<option value="">&nbsp;</option>
								`;
								for (var i = 0; i < $UNIDADES.length; i++) {
									$UND += '<option value="'+$UNIDADES[i].id+'" '+(this.undMedida == $UNIDADES[i].id ? 'selected' : '')+'>'+$UNIDADES[i].nombre+'</option>';
								}
								$UND += '</select>';

								var fila = {
									0 : $INPUT,
									1 : '<input class="form-control form-control-sm numerico" value="'+this.ValorFrecuencia+'" disabled>',
									2 : $UND,
									3 : '<input class="form-control form-control-sm numerico ultOP" value="'+this.ValUltimoConsu+'" disabled>',
									4 : '<input class="form-control form-control-sm numerico valNOTI" value="'+this.ValNotifica+'" disabled>', 
									5 : "<center><div class='btn-group btn-group-xs'><button type='button' class='editar btn btn-success btn-xs' data-tabla='"+tabla+"' data-tipo='"+tipo+"' title='Editar' value='"+this.OperacionId+"' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-edit'></span></button><button type='button' class='btn btn-danger btn-xs eliminar' data-tabla='"+tabla+"' data-tipo='"+tipo+"' value='"+this.OperacionId+"' title='Eliminar' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-trash-alt'></span></button></div></center>"
								}
								filas.push(fila);
							});
							break;
						case 'tblAnexoV' :
						case 'tblAnexoM' :
						case 'tblAnexoE' :
						case 'tblAnexoL' :
							$.each(respuesta, function(){
								var tipoDoc 	= this.ruta.split('.')[2];
								var rutaDoc 	= base_url()+this.ruta;
								var enlace 		= "";
								var eliminar 	= "";

								switch (tipoDoc) {
									case 'doc':
									case 'docx':
										enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-file-word-o"></i></a>';
										break;
									case 'xls':
									case 'xlsx':
										enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>';
										break;
									case 'pdf':
										enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></a>';
										break;
									case 'txt':
										enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-file-text-o"></i></a>';
										break;
									default:
										enlace ='<a href="'+rutaDoc+'" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>';
										break;
								}

								var fila = {
									0: this.ruta.split('.')[1].split('/')[5].split('_')[2].toUpperCase(),
									1: enlace,
									2: "<center><button type='button' class='btn btn-danger btn-xs eliminar' data-tabla='"+tabla+"' data-tipo='"+tipo+"' value='"+this.AnexoId+"' title='Eliminar' "+(VER == 1 ? 'disabled' : '')+"><span class='far fa-trash-alt'></span></button></center>"
								}
								filas.push(fila);
							});
							break;
						default:
							break;
					}
					dt.rows.add(filas).draw();
					$('select.chosen-select').chosen({
						placeholder_text_single: ''
						,width: '100%'
						,no_results_text: 'Oops, no se encuentra'
						,allow_single_deselected: true
					});
				}
			} catch(e) {
				alertify.alert("Error","Comuniquese con el administrador del sistema.");
				console.log(e);
			}
		}
	});
}

function obtenerDT(tipo){
	switch (tipo) {
		case 'TV':
		case 'tblOperacionTV':
			return dtOperacionTV; 
		case 'CV':
		case 'tblOperacionCV':
			return dtOperacionCV; 
		case 'tblAnexoV':
			return dtAnexoV;
		case 'TM':
		case 'tblOperacionTM':
			return dtOperacionTM; 
		case 'CM':
		case 'tblOperacionCM':
			return dtOperacionCM; 
		case 'tblAnexoM':
			return dtAnexoM;
		case 'TE':
		case 'tblOperacionTE':
			return dtOperacionTE; 
		case 'CE':
		case 'tblOperacionCE':
			return dtOperacionCE; 
		case 'tblAnexoE':
			return dtAnexoE;
		case 'TL':
		case 'tblOperacionTL':
			return dtOperacionTL; 
		case 'CL':
		case 'tblOperacionCL':
			return dtOperacionCL; 
		case 'tblAnexoL':
			return dtAnexoL;
		case 'tblCRUDVehiculo':
			DTV.draw();
			break;
		case 'tblCRUDMaquinaria':
			DTM.draw();
			break;
		case 'tblCRUDComputo':
			DTE.draw();
			break;
		case 'tblCRUDLocativa':
			DTL.draw();
			break;
		default:
			break;
	}
}

function obtenerOperacion(tipo){
	var resp = [];
	$.ajax({ 
		url: base_url()+"Administrativo/FichaTecnica/cFichaTecnica/obtenerOperacion",
		type: 'POST',
		async: false,
		data: {
			Id 	 : $("[data-db=ItemEquipoId][data-tabla="+MODULO+"]").find("option:selected").attr('data-equipo'),
			Tipo : tipo
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta.length > 0) {
				resp = respuesta;
			}
		}
	});
	return resp;
}

function sumaDiasFecha(fecha,frec,tipo){
	if (fecha != '') {
		var nf 	= new Date(fecha);
		switch (tipo) {
			case '001':
				nf = new Date(nf.setDate(nf.getDate() + frec));
				break;
			case '002':
				nf = new Date(nf.setDate(nf.getDate() + frec*7));
				break;
			case '003':
				nf = new Date(nf.setMonth(nf.getMonth() + frec));
				break;
			case '004':
				nf = new Date(nf.setFullYear(nf.getFullYear() + frec));
				break;
			default:
				break;
		}

		dia 	= (nf.getDate()+1) < 10 ? '0'+(nf.getDate()+1) : (nf.getDate()+1);
		mes 	= (nf.getMonth()+1) < 10 ? '0'+(nf.getMonth()+1) : (nf.getMonth()+1);
		anio 	= nf.getFullYear();

		return anio+'-'+mes+'-'+dia;
	}else{
		return '';
	}
}

function eliminarOperacion(id,rastreo,self){
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/eliminarOperacion",
		type: 'POST',
		async: false,
		data: {
			Id 		: id,
			RASTREO : RASTREO(rastreo,"Fichas tecnicas")
		},
		success: function(respuesta){
			if (respuesta == 1) {
				var dt = obtenerDT($(self).attr('data-tabla'));
				alertify.success("Datos eliminados exitosamente.");
				obtenerDataTabla($(self).attr('data-tabla'),dt,$(self).attr('data-tipo'));
			}else{
				alertify.alert("Atención",msgAlerta.errorAdmin);
			}
		}
	});
}

function eliminarAnexo(id,self){
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/eliminarAnexo",
		type: 'POST',
		async: false,
		data: {
			Id : id
		},
		success: function(respuesta){
			if (respuesta == 1) {
				var dt = obtenerDT($(self).attr('data-tabla'));
				alertify.success("Datos eliminados exitosamente.");
				obtenerDataTabla($(self).attr('data-tabla'),dt,'ANX');
			}else{
				alertify.alert("Atención",msgAlerta.errorAdmin);
			}
		}
	});
}

function limpiarForm(tipo){
	switch (tipo) {
		case 'Vehiculo':
			$("#frmVehiculo").find(".form-control").not("input[type=search], .txtDisabled").each(function(){ $(this).val("").prop("disabled",false).trigger("chosen:updated") });
			break;
		case 'Maquinaria':
			$("#frmMaquinaria").find(".form-control").not("input[type=search], .txtDisabled").each(function(){ $(this).val("").prop("disabled",false).trigger("chosen:updated") });
			break;
		case 'EquipoComputo':
			$("#frmComputo").find(".form-control").not("input[type=search], .txtDisabled").each(function(){ $(this).val("").prop("disabled",false).trigger("chosen:updated") });
			break;
		case 'Locativa':
			$("#frmLocativa").find(".form-control").not("input[type=search], .txtDisabled").each(function(){ $(this).val("").prop("disabled",false).trigger("chosen:updated") });
			break;
		default:
			break;
	}
}

function eliminarFT(id,rastreo,self,dt){
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/eliminarFT",
		type: 'POST',
		async: false,
		data: {
			Id 		: id,
			Tipo 	: $(self).attr('data-tipo'),
			Clave 	: $(self).attr('data-clave'),
			RASTREO : RASTREO(rastreo,"Fichas tecnicas")
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta.RES == 1) {
				alertify.success("Datos eliminados exitosamente.");
				obtenerDT($(self).attr('data-tabla'));
			}else{
				var cadena = '';
				for (var i = 0; i < respuesta.Data.length; i++) {
					cadena +=  "<strong>* Asunto : </strong>"+respuesta.Data[i].Asunto+" | <strong>Operación : </strong>"+respuesta.Data[i].Operacion+" <br>";
				}
				alertify.alert("Atención","La ficha tecnica no puede ser eliminada, tiene operaciones gestionadas en las siguientes incidencias : <br><br> "+cadena+" ");
			}
		}
	});
}

function reiniciarVariables(){
	GID 		= null;
	CREAR 		= 0;
	EDITAR 		= 0;
	VER 		= 0;
	GTBL 		= '';
	TBM 		= 0;
	TBC 		= 0;
	TBL 		= 0;
	lastFocus 	= '';
	ARRRASTREO 	= [];
	ARREDITA 	= [];
	$("[data-db=ItemEquipoId]").prop("disabled",false).trigger("chosen:updated");
}

function obtenerDataFT(id,self){
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/obtenerDataFT",
		type: 'POST',
		async: false,
		data: {
			Id 	 : id,
			Tipo : $(self).attr('data-tipo'),
			Clave: $(self).attr('data-clave')
		},
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (respuesta.length > 0) {
					for(var x in respuesta[0]){
						$("[data-db="+x+"]").val(respuesta[0][x]);
						if (x == 'ItemEquipoId') {
							$("[data-db="+x+"]").change();
							$("[data-db="+x+"]").prop("disabled",true).trigger("chosen:updated");
						}
						if (VER == 1) {
							$("[data-db="+x+"]").prop("disabled",true).trigger("chosen:updated");	
						}
					}
					var item = "";
					switch ($(self).attr('data-tipo')) {
						case 'Vehiculo':
							obtenerDataTabla('ElementoVehiculo',dtCajaHerramienta,'H');
							obtenerDataTabla('ElementoVehiculo',dtEquipoCarretera,'E');
							obtenerDataTabla('ElementoVehiculo',dtBotiquin,'B');
							obtenerDataTabla('tblOperacionTV',dtOperacionTV,'T');
							obtenerDataTabla('tblOperacionCV',dtOperacionCV,'C');
							obtenerDataTabla('tblAnexoV',dtAnexoV,'ANX');
							break;
						case 'Maquinaria':
							obtenerDataTabla('tblOperacionTM',dtOperacionTM,'T');
							obtenerDataTabla('tblOperacionCM',dtOperacionCM,'C');
							obtenerDataTabla('tblAnexoM',dtAnexoM,'ANX');
							break;
						case 'EquipoComputo':
							obtenerDataTabla('tblOperacionTE',dtOperacionTE,'T');
							obtenerDataTabla('tblOperacionCE',dtOperacionCE,'C');
							obtenerDataTabla('tblAnexoE',dtAnexoE,'ANX');
							break;
						case 'Locativa':
							obtenerDataTabla('tblOperacionTL',dtOperacionTL,'T');
							obtenerDataTabla('tblOperacionCL',dtOperacionCL,'C');
							obtenerDataTabla('tblAnexoL',dtAnexoL,'ANX');
							break;
						default:
							break;
					}
					if(EDITAR == 1)
						OBTINF = 0;
				}
			} catch(e) {
				alertify.alert("Error","Comuniquese con el administrador del sistema.");
				console.log(e);
			}
		}
	});
}