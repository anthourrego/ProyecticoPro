var dtTblListadoVencimiento = $('#TblListadoVencimiento').DataTable({
	language,
	processing: true,
	pageLength: 30,
	bLengthChange: false,
	order: [[1, 'asc']],
	orderable: false,
	columnDefs: [
		{width: '1%', targets: [0]}
		,{className: 'text-center', targets: [0]}
	],
	dom: "<'row'<'col-sm-12 col-md-6 mb-2 mb-md-0'B><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
	buttons: [
	{ extend: 'excel', className: 'excelButton', text: 'Excel' , exportOptions:{columns: [1,2,3,4,5]}},
	{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' , exportOptions:{columns: [1,2,3,4,5]}},
	{ extend: 'print', className: 'printButton', text: 'Imprimir' , exportOptions:{columns: [1,2,3,4,5]}}
	],
	createdRow: function(row, data, dataIndex){
	
	}
});

$(function(){
	$('#Ficha').val('005');
	ListadoVencimiento();
	$('.chosen-select').chosen({
		placeholder_text_single: 'Seleccione'
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	});
});

$("#btnCargar").click(function(e){
	e.preventDefault();
	ListadoVencimiento();
});


function ListadoVencimiento() { 
	
	$.ajax({
		url: base_url() + "Administrativo/Incidencia/cRegistroOperaciones/ListadoVencimiento",
		type: 'POST',
		dataType: 'json'
		,data: {
			id : $('#Ficha').val()
		},
		success: function(respuesta){
		
			if(respuesta){
				var filas = [];
				$.each(respuesta, function(){
					let cadena; 

					switch (this.vencimiento) {
						case 'aldia':
							cadena = '<button class="btn btn-success btn-sm btn-block">Al día</button>';
							break;
						case 'porvencer':
							cadena = '<button class="btn btn-warning btn-sm btn-block">Próxima a vencer</button>';
							break;
						default:
							cadena = '<button class="btn btn-danger btn-sm btn-block">Vencido</button>';
							break;
					};
			
				var fila = {
						0: cadena,
						1: this.Placa,
						2: this.ficha,
						3: this.nombreequipo,
						4: this.serial,
						5: this.Operacion,
						6: this.nombrefamilia,
						7: this.ValorFrecuencia,
						8: this.nombretiempooperacion, 
						9: this.UltimaFecha,
						10: this.PROXIMA
					}
					filas.push(fila);
				}); 
				dtTblListadoVencimiento.clear().draw();
				dtTblListadoVencimiento.rows.add(filas).draw();
			}
		},
		error: function(error){
			alertify.alert('Error', error.responseText);
			console.log(error);
		}
	});
}