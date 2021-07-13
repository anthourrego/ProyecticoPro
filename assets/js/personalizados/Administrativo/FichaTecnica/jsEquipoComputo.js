var dtOperacionTE = $('#tblOperacionTE').DataTable({
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
			dtOperacionTE.row( $(this).closest('tr') ).remove().draw();
			$(".btnOP").attr('disabled', false);
			GTBL = '';
		});
	}
});

var dtOperacionCE = $('#tblOperacionCE').DataTable({
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
			dtOperacionCE.row( $(this).closest('tr') ).remove().draw();
			$(".btnOP").attr('disabled', false);
			GTBL = '';
		});
	}
});

var dtAnexoE = $('#tblAnexoE').DataTable({
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
			dtAnexoE.row( $(this).closest('tr') ).remove().draw();
			$(".btnANX").attr('disabled', false);
		});
	}
});