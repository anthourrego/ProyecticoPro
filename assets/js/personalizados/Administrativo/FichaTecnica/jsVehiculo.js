var dtCajaHerramienta = $('#tblCajaHerramienta').DataTable({
	language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
	],
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [0,1]}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [0,1]}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [0,1]}},
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".cancelar", function(e){
			e.preventDefault();
			dtCajaHerramienta.row( $(this).closest('tr') ).remove().draw();
			$(".btnEV").attr('disabled', false);
		});
		$(row).on("click", ".cancelarAC", function(e){
			e.preventDefault();
			$(".btnEV").prop("disabled",false);
			obtenerDataTabla('ElementoVehiculo',dtCajaHerramienta,'H');
		});
		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var rastreo = "Elimina elemento de vehiculo [Caja de herramientas] [Elemento : "+data[0]+"]";
			var id 		= $(this).attr('value');

			alertify.confirm('Eliminar elemento', '¿ Está seguro de eliminar el registro ?', function(){
				eliminaElemento(id,dtCajaHerramienta,'H',rastreo);
			}, function(){});
		});
	}
});

var dtEquipoCarretera = $('#tblEquipoCarretera').DataTable({
	language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
	],
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: ':not(:first-child)'}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".cancelar", function(e){
			e.preventDefault();
			dtEquipoCarretera.row( $(this).closest('tr') ).remove().draw();
			$(".btnEV").attr('disabled', false);
		});
		$(row).on("click", ".cancelarAC", function(e){
			e.preventDefault();
			$(".btnEV").prop("disabled",false);
			obtenerDataTabla('ElementoVehiculo',dtEquipoCarretera,'E');
		});
		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var rastreo = "Elimina elemento de vehiculo [Equipo de carretera] [Elemento : "+data[0]+"]";
			var id 		= $(this).attr('value');

			alertify.confirm('Eliminar elemento', '¿ Está seguro de eliminar el registro ?', function(){
				eliminaElemento(id,dtEquipoCarretera,'E',rastreo);
			}, function(){});
		});
	}
});

var dtBotiquin = $('#tblBotiquin').DataTable({
	language,
	processing: true,
	pageLength: 5,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
	],
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: ':not(:first-child)'}}
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".cancelar", function(e){
			e.preventDefault();
			dtBotiquin.row( $(this).closest('tr') ).remove().draw();
			$(".btnEV").attr('disabled', false);
		});
		$(row).on("click", ".cancelarAC", function(e){
			e.preventDefault();
			$(".btnEV").prop("disabled",false);
			obtenerDataTabla('ElementoVehiculo',dtBotiquin,'B');
		});
		$(row).on("click", ".eliminar", function(e){
			e.preventDefault();
			var rastreo = "Elimina elemento de vehiculo [Botiquin] [Elemento : "+data[0]+"]";
			var id 		= $(this).attr('value');

			alertify.confirm('Eliminar elemento', '¿ Está seguro de eliminar el registro ?', function(){
				eliminaElemento(id,dtBotiquin,'B',rastreo);
			}, function(){});
		});
	}
});

var dtOperacionTV = $('#tblOperacionTV').DataTable({
	language,
	processing: true,
	pageLength: 10,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
		{targets : [3], className : 'txtCenter'}
	],
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'pageLength'},
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".cancelar", function(e){
			e.preventDefault();
			dtOperacionTV.row( $(this).closest('tr') ).remove().draw();
			$(".btnOP").attr('disabled', false);
			GTBL = '';
		});
	}
});

var dtOperacionCV = $('#tblOperacionCV').DataTable({
	language,
	processing: true,
	pageLength: 10,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
	],
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: ':not(:first-child)'}},
		{ extend: 'pageLength'},
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".cancelar", function(e){
			e.preventDefault();
			dtOperacionCV.row( $(this).closest('tr') ).remove().draw();
			$(".btnOP").attr('disabled', false);
			GTBL = '';
		});
	}
});

var dtAnexoV = $('#tblAnexoV').DataTable({
	language,
	processing: true,
	pageLength: 10,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	autoWidth : false,
	columnDefs: [
		{targets : [0,1,2] , className : 'txtCenter'}
	],
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: ':not(:last-child)'}},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: ':not(:last-child)'}},
		{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: ':not(:last-child)'}},
		{ extend: 'pageLength'},
	],
	createdRow: function(row, data, dataIndex){
		$(row).on("click", ".cancelar", function(e){
			e.preventDefault();
			dtAnexoV.row( $(this).closest('tr') ).remove().draw();
			$(".btnANX").attr('disabled', false);
		});
	}
});

var dataRelemento = [];

$(".btnEV").on("click",function(e){
	e.preventDefault();
	var tabla = "#"+$(this).attr('data-tabla');
	var row = {
		0: '',
		1: '',
		2: "<center><div class='btn-group btn-group-xs'><button type='button' class='guardar btn btn-success btn-xs' title='Guardar' data-tipo='"+$(this).attr("data-tipo")+"' data-nombre='"+$(this).attr("data-nombre")+"'><span class='far fa-save'></span></button><button type='button' class='btn btn-danger btn-xs cancelar' title='Eliminar'><span class='fas fa-times'></span></button></div></center>",
	}
	switch ($(this).attr("data-tipo")) {
		case 'H':
			dtCajaHerramienta.row.add(row).draw();
			break;
		case 'E':
			dtEquipoCarretera.row.add(row).draw();
			break;
		case 'B':
			dtBotiquin.row.add(row).draw();
			break;
		default:
			break;
	}
	$(""+tabla+" tbody tr").first().find("td").not(":eq(2)").attr('contenteditable', true).on('keydown paste', function(e){
		
		if($(this).index() == 1){
			var tamano = 100;
		}
		if ($(this).text().length >= tamano && e.keyCode != 8) {
			e.preventDefault();
		}

	});
	$(""+tabla+" tbody tr").first().find("td").eq(0).focus();
	$(this).attr('disabled', true);
});

$("#tblCajaHerramienta, #tblEquipoCarretera, #tblBotiquin").on("click",".guardar",function(e){
	e.preventDefault();
	var self = this;
	var tabla;

	switch ($(this).attr('data-tipo')) {
		case 'H':
			tabla = dtCajaHerramienta;
			break;
		case 'E':
			tabla = dtEquipoCarretera;
			break;
		case 'B':
			tabla = dtBotiquin;
			break;
		default:
			break;
	}

	$data = {
		VehiculoId 	: GID,
		Elemento 	: $(this).closest('tr').find('td:eq(0)').text().trim(),
		Cantidad 	: $(this).closest('tr').find('td:eq(1)').text().trim(),
		Tipo 	 	: $(this).attr("data-tipo")
	}

	if ($data.Elemento == '' || isNaN(parseInt($data.Cantidad))) {
		alertify.alert("Atención","* Todos los campos de la tabla deben de estar diligenciados<br> * Verifique que este digitando un valor numerico en el campo (Cantidad) de la tabla.",function(){
			setTimeout(function(){$(self).closest('tr').find('td:eq(0)').focus()},1050)
		});
	}else{
		var rastreo = "Crea elemento de vehiculo ["+$(this).attr("data-nombre")+"] [Elemento : "+$data.Elemento+"] [Cantidad : "+$data.Cantidad+"]";

		$.ajax({ 
			url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/guardarElementoVehiculo",
			type: 'POST',
			async: false,
			data: {
				Data 	: $data,
				RASTREO : RASTREO(rastreo,"Fichas tecnicas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					$(".btnEV").prop("disabled",false);
					alertify.success("Datos guardado exitosamente.");
					obtenerDataTabla('ElementoVehiculo',tabla,$(self).attr('data-tipo'));
				}else {
					alertify.alert("Atención",msgAlerta.errorAdmin);
				}
			}
		});
	}
});

$("#tblCajaHerramienta, #tblEquipoCarretera, #tblBotiquin").on("click",".editar",function(e){
	e.preventDefault();
	dataRelemento = [];
	dataRelemento.push($(this).closest('tr').find('td:eq(0)').text().trim());
	dataRelemento.push($(this).closest('tr').find('td:eq(1)').text().trim());
	$(this).closest('tr').find('td:eq(0)').attr('contenteditable', true);
	$(this).closest('tr').find('td:eq(1)').attr('contenteditable', true);
	$(this).closest('tr').find('td:eq(2) .btn-success span').removeClass('far fa-edit').addClass('far fa-save');
	$(this).closest('tr').find('td:eq(2) .btn-success').removeClass("editar").addClass('actualizar');
	$(this).closest('tr').find('td:eq(2) .btn-success').attr('title', "Actualizar");
	$(this).closest('tr').find('td:eq(2) .btn-danger span').removeClass('far fa-trash-alt').addClass('fas fa-times');
	$(this).closest('tr').find('td:eq(2) .btn-danger').removeClass("eliminar").addClass('cancelarAC');
	$(this).closest('tr').find('td:eq(2) .btn-danger').attr('title', "Cancelar edición");
	$(this).closest('tr').find('td:eq(0)').focus();
	$(".btnEV").prop("disabled",true);
});

$("#tblCajaHerramienta, #tblEquipoCarretera, #tblBotiquin").on("click",".actualizar",function(e){
	var self = this;
	var id 	 = $(this).attr('value');
	var tabla,nombre;

	switch ($(this).attr('data-tipo')) {
		case 'H':
			tabla 	= dtCajaHerramienta;
			nombre 	= 'Caja de herramienta';
			break;
		case 'E':
			tabla 	= dtEquipoCarretera;
			nombre 	= 'Equipo de carretera';
			break;
		case 'B':
			tabla 	= dtBotiquin;
			nombre 	= 'Botiquin';
			break;
		default:
			break;
	}

	$data = {
		VehiculoId 	: GID,
		Elemento 	: $(this).closest('tr').find('td:eq(0)').text().trim(),
		Cantidad 	: $(this).closest('tr').find('td:eq(1)').text().trim(),
		Tipo 	 	: $(this).attr("data-tipo")
	}

	if ($data.Elemento == '' || isNaN(parseInt($data.Cantidad))) {
		alertify.alert("Atención","* Todos los campos de la tabla deben de estar diligenciados<br> * Verifique que este digitando un valor numerico en el campo (Cantidad) de la tabla.",function(){
			setTimeout(function(){$(self).closest('tr').find('td:eq(0)').focus()},1050)
		});
	}else{
		var rastreo = "Edita elemento de vehiculo ["+nombre+"] [Elemento : "+dataRelemento[0]+" => "+$data.Elemento+"] [Cantidad : "+dataRelemento[1]+" => "+$data.Cantidad+"]";

		$.ajax({ 
			url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/editarElementoVehiculo",
			type: 'POST',
			async: false,
			data: {
				Id 		: id,
				Data 	: $data,
				RASTREO : RASTREO(rastreo,"Fichas tecnicas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					$(".btnEV").prop("disabled",false);
					alertify.success("Datos actualizados exitosamente.");
					obtenerDataTabla('ElementoVehiculo',tabla,$(self).attr('data-tipo'));
				}else {
					alertify.alert("Atención",msgAlerta.errorAdmin);
				}
			}
		});
	}
});

function eliminaElemento(id,tabla,tipo,rastreo){
	$.ajax({ 
		url: base_url() + "Administrativo/FichaTecnica/cFichaTecnica/eliminaElemento",
		type: 'POST',
		async: false,
		data: {
			Id 		: id,
			RASTREO : RASTREO(rastreo,"Fichas tecnicas")
		},
		success: function(respuesta){
			if (respuesta == 1) {
				alertify.success("Datos eliminados exitosamente.");
				obtenerDataTabla('ElementoVehiculo',tabla,tipo);
			}
		}
	});
}