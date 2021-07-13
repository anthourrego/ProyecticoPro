$(document).ready(function(){
	$('#tblVariables').DataTable({
		order: [],
		language: {
			lengthMenu: 		"Mostrar _MENU_ registros por página.",
			zeroRecords: 		"No se ha encontrado ningún registro.",
			info: 				"Mostrando página _PAGE_ de _PAGES_",
			infoEmpty: 			"Registros no disponibles.",
			search   : 			"",
			searchPlaceholder: 	"Buscar",
			loadingRecords: 	"Cargando...",
			processing:     	"Procesando...",
			paginate: {
				first:      	"Primero",
				last:       	"Último",
				next:       	"Siguiente",
				previous:   	"Anterior"
			},
			infoFiltered: 		"(_MAX_ Registros filtrados en total)"
		},
		pageLength: -1,
		dom: "<'row'<'col-12'f>><'row'<'col-md-12't>><'row'<'col-md-6'><'col-md-6'>>r"
	});
});