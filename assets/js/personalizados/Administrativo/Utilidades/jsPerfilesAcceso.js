var dtTerceros;
$(document).ready(function(){
	dtTerceros = $('#tblCRUD').DataTable({
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
		}
		,columnDefs : [
			{ orderable: false, targets: [1,2], width: '1%' }
		]
		,order: []
	});

	$('#btnMarcarCREAR').click(function(e){
		e.preventDefault();
		var length = dtTerceros.page.len();
		var page = dtTerceros.page();
		dtTerceros.page.len(-1).draw();
		$TERCCrear = [];
		$('#tblCRUD').find('[data-per][data-tipo=Crear]').each(function(){
			$(this).prop('checked', true).change();
		});
		dtTerceros.page.len(length).draw();
		dtTerceros.page(page).draw(false);
	});
	$('#btnDesmarcarCREAR').click(function(e){
		e.preventDefault();
		var length = dtTerceros.page.len();
		var page = dtTerceros.page();
		dtTerceros.page.len(-1).draw();
		$TERCCrear = [];
		$('#tblCRUD').find('[data-per][data-tipo=Crear]').each(function(){
			$(this).prop('checked', false);
		});
		dtTerceros.page.len(length).draw();
		dtTerceros.page(page).draw(false);
	});
	$('#btnMarcarMODIFICAR').click(function(e){
		e.preventDefault();
		var length = dtTerceros.page.len();
		var page = dtTerceros.page();
		dtTerceros.page.len(-1).draw();
		$TERCModif = [];
		$('#tblCRUD').find('[data-per][data-tipo=Modif]').each(function(){
			$(this).prop('checked', true).change();
		});
		dtTerceros.page.len(length).draw();
		dtTerceros.page(page).draw(false);
	});
	$('#btnDesmarcarMODIFICAR').click(function(e){
		e.preventDefault();
		var length = dtTerceros.page.len();
		var page = dtTerceros.page();
		dtTerceros.page.len(-1).draw();
		$TERCModif = [];
		$('#tblCRUD').find('[data-per][data-tipo=Modif]').each(function(){
			$(this).prop('checked', false);
		});
		dtTerceros.page.len(length).draw();
		dtTerceros.page(page).draw(false);
	});
});

$(document).on('change', '[data-per]', function(){
	var per = parseInt($(this).attr('data-per'));
	switch($(this).attr('data-tipo')){
		case 'Crear':
			if($(this).is(':checked')){
				$TERCCrear.push(per);
			}else{
				var index = $TERCCrear.indexOf(per);
				if (index !== -1) $TERCCrear.splice(index, 1);
			}
		break;
		case 'Modif':
			if($(this).is(':checked')){
				$TERCModif.push(per);
			}else{
				var index = $TERCModif.indexOf(per);
				if (index !== -1) $TERCModif.splice(index, 1);
			}
		break;
		case 'Elimi':
			if($(this).is(':checked')){
				$TERCElimi.push(per);
			}else{
				var index = $TERCElimi.indexOf(per);
				if (index !== -1) $TERCElimi.splice(index, 1);
			}
		break;
	}
});

$('#btnGuardar').on('click', function () {
	var checkedIds = tree.getCheckedNodes();

	$.ajax({
		url: base_url() + "Administrativo/Utilidades/PerfilesAcceso/GuardarPerfilAcceso",
		type: "POST",
		data: {
			SEGUR: 			JSON.stringify(checkedIds)
			,TERCCrear: 	JSON.stringify($TERCCrear)
			,TERCModif: 	JSON.stringify($TERCModif)
			,TERCElimi: 	JSON.stringify($TERCElimi)
			,id: 			$ID
			,perfil: 		$PERFIL
			,RASTREO: 		RASTREO('Modifica los permisos del '+( $PERFIL == null ? 'Usuario' : 'Perfil' )+' '+$ID, 'Permisos')
		},
		success: function(respuesta){
			if(respuesta == 1){
				if ('referrer' in document) {
					window.location = document.referrer;
				} else {
					window.history.back();
				}
			}else{
				alertify.error("Ocurrió un error al guardar los permisos");
			}
		}
	});
});

var $ARBOL = [
	{id: 1, text: 'Configuración', children: [
		{id: 11, text: 'Terceros', children: [
			{id: 1101, text: 'Registro Clientes'}
			,{id: 1102, text: 'Registro Proveedores'}
			,{id: 1103, text: 'Tipos de Terceros'}
			,{id: 1104, text: 'Definición Campos Adicionales'}
			,{id: 1105, text: 'Clasificación Clientes'}
			,{id: 1106, text: 'Países'}
			,{id: 1107, text: 'Departamentos'}
			,{id: 1108, text: 'Ciudades'}
			,{id: 1109, text: 'Barrios'}
			,{id: 1110, text: 'Zonas'}
			,{id: 1111, text: 'Regiones'}
			,{id: 1112, text: 'Actividades Económicas'}
			,{id: 1113, text: 'Regímenes Contributivos'}
			,{id: 1114, text: 'Sectores Económicos'}
			,{id: 1115, text: 'Estado Civil'}
			,{id: 1116, text: 'Cargos'}
			,{id: 1117, text: 'Profesiones'}
		]}
		,{id: 12, text: 'Parámetros de Facturación y Cartera', children: [
			{id: 1201, text: 'Responsabilidad Fiscal'}
		]}
		,{id: 13, text: 'PQRs', children: [
			{id: 1301, text: 'Estado'}
			,{id: 1302, text: 'Tipo'}
			,{id: 1303, text: 'Causa'}
		]}
		,{id: 14, text: 'Productos', children: [
			{id: 1401, text: 'Centro Costo'}
			,{id: 1402, text: 'Dependencias'}
			,{id: 1403, text: 'Familia'}
			,{id: 1404, text: 'Marcas'}
			,{id: 1405, text: 'Equipos'}
			,{id: 1406, text: 'Hardware'}
			,{id: 1407, text: 'Software'}
			,{id: 1408, text: 'Inventario'}
		]}
		,{id: 15, text: 'Incidencias', children: [
			{id: 1501, text: 'Estado Incidencia'}
			,{id: 1502, text: 'Tipo Incidencia'}
			,{id: 1503, text: 'Tipo Prioridad'}
			,{id: 1504, text: 'Unidad Medida'}
			,{id: 1505, text: 'Tipo Stop'}
			,{id: 1506, text: 'Tipo Actividades'}
			,{id: 1507, text: 'Actividad Equipo'}
		]}
		,{id: 16, text: 'Parámetros de Producción', children: [
			{id: 1601, text: 'Áreas de Servicio'}
			,{id: 1602, text: 'Actividades de Servicio'}
			,{id: 1603, text: 'Operarios'}
		]}
		,{id: 18, text: 'Actas', children: [
			{id: 1801, text: 'Tipo Reunión'}
		]}
		,{id: 17, text: 'Configuración', children: [
			{id: 1701, text: 'Datos del conjunto'}
			,{id: 1702, text: 'Tipos de vivienda / Zonas'}
			,{id: 1703, text: 'Viviendas'}
			,{id: 1704, text: 'Mapa de zonas'}
			,{id: 1705, text: 'Tipos de vehiculos'}
			,{id: 1706, text: 'Tipos de servicios'}
			,{id: 1707, text: 'Tipos de mascotas'}
		]}
	]}
	,{id: 2, text: 'Utilidades', children: [
		{id: 2001, text: 'Auditoría General'}
		,{id: 2002, text: 'Cambio de Clave'}
		,{id: 2003, text: 'Seguridad General'}
		,{id: 2004, text: 'Tipos de Perfil'}
	]}
	,{id: 3, text: 'PQRs', children: [
		{id: 3001, text: 'Capturar'}
		,{id: 3002, text: 'Tramitar'}
		,{id: 3003, text: 'Consultar'}
		,{id: 3004, text: 'Estadísticas'}
	]}
	,{id: 4, text: 'Fichas técnicas'}
	,{id: 5, text: 'Gestión Incidencias', children: [
		{id: 5001, text: 'Capturar'}
		,{id: 5002, text: 'Tramitar'}
		,{id: 5003, text: 'Agendar'}
	]}
	,{id: 6, text: 'Actas', children: [
		{id: 6001, text: 'Actas'}
		,{id: 6002, text: 'Consultas'}
	]}
];

var tree = $('[id=tree]').tree({
	primaryKey: 'id',
	uiLibrary: 'bootstrap',
	dataSource: $ARBOL,
	checkboxes: true,
	cascadeCheck: false
});

var $CHECKS = [];

$(document).ready(function(){
	$.each($SEGUR, function(){
		tree.check($("[data-id="+this+"]"));
	});
	// 25/01/2018 JCSM - Tras cargar los permisos se crea la funcionalidad que permite checkear en cascada
	tree.on('checkboxChange', function (e, $node, record, state) {
		e.stopPropagation();
		if($CHECKS.indexOf(record['id']) < 0){
			$CHECKS.push(record['id']);
			if(state == 'checked'){
				// 04/12/2017 JCSM - Checkea los padres
				$node.closest("[data-id]").parents("li").each(function(){
					$CHECKS.push(parseInt($(this).attr('data-id')));
					tree.check($(this));
				});
				// 04/12/2017 JCSM - Checkea los hijos
				$node.find("li").each(function(){
					$CHECKS.push(parseInt($(this).attr('data-id')));
					tree.check($(this));
				});
			}else{
				// 25/01/2018 JCSM - Quita checks a los hijos
				$node.find("li").each(function(){
					$CHECKS.push(parseInt($(this).attr('data-id')));
					tree.uncheck($(this));
				});
			}
		}
		$CHECKS = [];
	});
});

$("#btnMarcarTODOS").click(function(e){
	e.preventDefault();
	tree.checkAll().expandAll();
});

$("#btnDesmarcarTODOS").click(function(e){
	e.preventDefault();
	tree.uncheckAll().collapseAll();
});