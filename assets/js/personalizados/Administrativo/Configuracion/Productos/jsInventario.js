var lastFocus = '';
var DT;
$GID = null;
var config = {
	data:{
		tblID : "#tblCRUD",
		select: [
			"'' as accion"
			,"it.ItemEquipoId"
			,"it.EquipoId"
			,"E.Nombre as Equipo"			
			,"it.Serial"				
			,"it.FinGarantia"		
			,"it.CodigoInterno"		
			,"it.CodigoExterno"		
			,"T.Nombre as Proveedor"			
			,"it.Costo"				
			,"it.ValorCop"			
			,"it.ValorUsd"			
			,"P.nombre as PaisOrigen"			
			,"it.FechaCompra"		
			,"it.Color"				
			,"case when it.TipoOrigen = '1' then 'Nacional' else 'Importado' end TipoOrigen"			
			,"it.Descripcion"		
			,"it.FechaAprobacion"	 
			,"case when it.Estado = 'A' then 'Activo' else 'Inactivo' end Estado"	

		],
		table : [
			"Itemequipo it",
			[
				['Equipo E', 'it.EquipoId = E.Equipoid', 'LEFT'],
				['Tercero T', 'T.TerceroID = it.Proveedor', 'LEFT'],
				['Pais P', 'it.PaisOrigen = P.paisid', 'LEFT'],
			]
		],
		column_order : [
			'ItemEquipoId'
			,'Equipo'		
			,'Serial'				
			,'FinGarantia'		
			,'CodigoInterno'		
			,'CodigoExterno'		
			,'Proveedor'			
			,'Costo'				
			,'ValorCop'			
			,'ValorUsd'			
			,'PaisOrigen'			
			,'FechaCompra'		
			,'Color'				
			,'TipoOrigen'			
			,'Descripcion'		
			,'FechaAprobacion'	 
			,'Estado'
		],
		column_search : [
			'it.EquipoId'
			,'it.Serial'
		],
		orden : {'ItemEquipoId': 'DESC'},
		columnas : [
			'accion'
			,'ItemEquipoId'
			,'Equipo'			
			,'Serial'				
			,'FinGarantia'		
			,'CodigoInterno'		
			,'CodigoExterno'		
			,'Proveedor'			
			,'Costo'				
			,'ValorCop'			
			,'ValorUsd'			
			,'PaisOrigen'			
			,'FechaCompra'		
			,'Color'				
			,'TipoOrigen'			
			,'Descripcion'		
			,'FechaAprobacion'
			,'Estado'
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'ASC']],
	columnDefs: [
	{ orderable: false, targets: [0], width: '1%' },
	{ targets: [2], width: '20%' },
	],
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
	scrollY: $(document).height() - 405,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
	],
	createdRow: function(row,data,dataIndex){
		var botones = "<center><div class='btn-group btn-group-xs'>";
		botones += "<button type='button' class='editar btn btn-success' value="+data[1]+" ><span class='far fa-edit' title='Editar'></span></button>";
		botones += " <button type ='button' class='eliminar btn btn-danger' value="+data[1]+" ><span class='far fa-trash-alt' title='Eliminar'></span></button>";
		botones += "</div></center>";
		$(row).find('td:eq(0)').html(botones);


		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var id = $(this).attr("value");

			alertify.confirm('Eliminar Inventario', '¿Está seguro de eliminar el registro?', function(){
				mRastreo = 'Elimina Inventario Id '+ id;
				eliminarA(id, mRastreo);
			}, function(){});
		});

		$(row).on("click", ".editar", function(e){
			e.preventDefault();
			$GID = $(this).attr("value");
			console.log('Hola');
			console.log($(this).attr("value"));
			$("[id=btnFiltros]").click();
			// $("#myModal .modal-content").load('cInventario/modalInventario', function() {
			// 	$("#myModal").modal({
			// 		backdrop: 'static',
			// 		keyboard: true,
			// 		show 	: true
			// 	});
			// 	obtenerInventario(id);

			// 	$('input[id=Serial]').off("change").on("change", function(){

			// 		if($("#EquipoId").val() ==""){
			// 			setTimeout('$("[id=EquipoId]").focus()', 1);
			// 			$("#Serial").val('');
			// 			return;
			// 		}
			// 		console.log($(this).val());
			// 		validarSerial(id)
			// 	});
			// });



			// $("[id=myModal]").unbind().on('shown.bs.modal', function(){
			// 	$("[id=btnGuardarTC]").prop("disabled",false);
			// 	$("[id=btnGuardarTC]").on("click", function(e){
			// 		e.preventDefault();
			// 		GuardarIt(id);
			// 	});
			// });
		});
	}
}

fechas = {
	fechaIni: $('[name=fecha1]').val(),
	fechaFin: $('[name=fecha2]').val()
};


$(document).ready(function(){
	DT = dtSS(config);
	setTimeout(function(){$("[id=btnFiltros]").focus()},550);
})

// $("[id=mModal]").on('shown.bs.modal', function(){
// 	console.log('Sipi')
// });


$("[id=btnFiltros]").on("click", function(e){
	e.preventDefault();
	$("[id=mModal]").modal("show");

	$("[id=mModal]").on("shown.bs.modal",function(){
		$("[id=frmInventario]").trigger('reset');
		$('.chosen').chosen({
			placeholder_text_single: 'Seleccione:'
			,width: '100%'
			,no_results_text: 'Oops, no se encuentra'
			,allow_single_deselected: true
		}).on("change",function(){
			if ($(this).val() != '') {
				switch ($(this).attr('id')) {
					case 'EquipoId':
						setTimeout(function(){$("#Serial").focus()},0)
						break;
					case 'Proveedor':
						setTimeout(function(){$("#costo").focus()},0)
						break;
					case 'PaisOrigen':
						setTimeout(function(){$("#color").focus()},0)
						break;
					case 'tipoOrigen':
						setTimeout(function(){$("#fechaAprob").focus()},0)
						break;
					case 'estadoInv':
						setTimeout(function(){$("#descripcionInv").focus()},0)
						break;
					default:
						break;
				}
			}
		});

		
		$('.numerico').inputmask({
			alias 		: 'decimal',
			rightAlign 	: false,
			integerDigits : 8,
			digits : 2,
			allowMinus : false
		});

		$('.date').datetimepicker({
			format: 'YYYY-MM-DD',
			locale: 'es'
		});
		$('input[id=Serial]').off("change").on("change", function(){
			if($("#EquipoId").val() ==""){
				setTimeout('$("[id=EquipoId]").focus()', 1);
				$("#Serial").val('');
				return;
			}
			validarSerial($GID)
		});
		$(".toUpper").keyup(function(){
			$(this).val($(this).val().toUpperCase());
		});
		obtenerInventario($GID);
		if ($GID == null) {
			setTimeout(function(){$("[id=EquipoId]").trigger("chosen:open")},150)
		}
		$("[id=frmInventario]").unbind().on("submit", function(e){
			e.preventDefault();
			var exepcion = 0;
			GuardarIt($GID);
		});
	})

	$("[id=mModal]").on('hidden.bs.modal', function(){
		$(this).unbind();
		$(".chosen-select").val("").trigger("chosen:updated");
		$(".numerico").val("");
		setTimeout(function(){$("[id=btnFiltros]").focus()},550);
	})
});




function GuardarIt(ItemEquipoId){
	var $DATA = {};
	if($("#EquipoId").val() ==""){
		alertify.warning("Debe de diligenciar los campos obliagtorios(*).");
		setTimeout(function(){$("[id=EquipoId]").trigger("chosen:open")},0)
		return;
	}

	if($("#Serial").val() ==""){
		setTimeout('$("[id=Serial]").focus()', 1);
		return;
	}

	$("#frmInventario").find("[data-db]").each(function(){
		if($(this).val() != ''){
			$DATA[$(this).attr('data-db')] = $(this).val();
		}
	});

	if(Object.keys($DATA).length > 0){
		$.ajax({
			url: base_url()+ "Administrativo/Configuracion/Productos/cInventario/GuardarIt",
			type: 'POST',
			data: {
				ItemEquipoId : ItemEquipoId ,
				valor: $DATA,
				RASTREO: RASTREO('Asigna Equipo  '+ $('#EquipoId').val(), 'Inventario')
			},
			success: function(respuesta){
				switch(respuesta) {
					case '2':
					alertify.success("Datos guardados exitosamente.");
					DT.draw();
					$("[id=mModal]").modal('hide');
					break;
				}
			}
		});
	}
}

function eliminarA(id, rastreo){
	$.ajax({
		url: base_url()+"Administrativo/Configuracion/Productos/cInventario/eliminarA",
		type: "POST",
		async: false,
		data: {
			id: id,
			RASTREO: RASTREO(rastreo, 'Inventario')
		}, success: function(resultado) {
			if(resultado == 1){
				alertify.success("Datos eliminados exitosamente.");
				DT.draw();
			} else {
				alertify.error("!Error, comuniquese con el administrador del sistema");
			}
		}, error: function(error){
			var canDismiss = false;
			var notification = alertify.error("El Inventario esta Asociado a Otros Modulos del Sistema");
			notification.ondismiss = function(){ return canDismiss };
			setTimeout(function(){ 
				canDismiss = true; 
			}, 1000);
			console.log(error);
		}
	});
}

function validarSerial(ItemEquipoId){
	$.ajax({
		url: base_url()+"Administrativo/Configuracion/Productos/cInventario/validarSerial",
		type: "POST",
		async: false,
		data: {
			ItemEquipoId: ItemEquipoId,
			EquipoId : $('#EquipoId').val(),
			Serial : $('#Serial').val(),
	
		}, success: function(resultado) {
			if(resultado == 1){
				$('#Serial').val('');
				alertify.error("Por favor digite un serial diferente, hay un equipo con el mismo serial");
				setTimeout(function(){$('#Serial').focus()},150)
			} 
		}
	});
}

function obtenerInventario(id){
	$.ajax({
		url: base_url()+"Administrativo/Configuracion/Productos/cInventario/obtenerInventario",
		type: "POST",
		async: false,
		data: {
			id: id
		},
		success: function(resultado){
			var resp = resultado;
			
			try{
				var datos = JSON.parse(resultado);
				console.log('datos',datos);
			}catch(e) {
				alertify.error('¡Error! los datos no han podido ser procesados(JSON.parse-Error)');
				console.log(e);
			}

			for(var key in datos[0]){

				valor = datos[0][key];
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
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
		}
	});
}