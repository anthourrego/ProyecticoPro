var DTActas;
var DTCompromisos;
var DTSeguimientoCompromisos;
var tblCompromiso = 0;
var tblSeguimientoCompromisos = 0;

$(function(){
	$(".chosen-select").chosen();

	$(".registrarActa").on("click", function(event){
		event.preventDefault();
		window.location.href = base_url() + "Administrativo/Actas/Acta/crear"
	});

	listaActas();

	$("#btnLimpiarFiltro").on("click", function(){
		$("#fFechaInicio, #fFechaFin").val("");
		$("#fTipoReunion").val("").trigger("chosen:updated");
	});

	$("#btnFiltrar").on("click", function(){
		filtro = [];
		filtro["fechaInicio"] = "";
		filtro["fechaFin"] = "";
		filtro["tipoReunion"] = "";

		fechaInicio = $("#fFechaInicio").val();
		fechaFin = $("#fFechaFin").val();
		tipoReunion = $("#fTipoReunion").val();
		noFiltra = 0;
		
		if (fechaInicio != "" && fechaFin != "") {
			filtro.push(fechaInicio);
			filtro.push(fechaFin);
			filtro["fechaInicio"] = fechaInicio;
			filtro["fechaFin"] = fechaFin;
		} else {
			if (fechaInicio != "" || fechaFin != "") {
				alertify.warning("Ingrese un rango de fechas.");
			}
		}

		if (tipoReunion.length > 0) {
			filtro.push(tipoReunion.toString());
			filtro["tipoReunion"] = tipoReunion.toString();
		}


		if (filtro.length > 0 && noFiltra == 0){
			DTActas.destroy();
			listaActas(filtro);
		}

	});

	$("#btnFiltrarTodo").on("click", function(){
		DTActas.destroy();
		listaActas();
	});

	$("#btnRegresar").on("click", function(){
		$("#divCompromisos").removeClass("d-none");
		$("#divSeguimientoCompromisos").addClass("d-none");
	});

	$("#formSeguimientoCompromisos").submit(function(event){
		event.preventDefault();
		$.ajax({
			url: base_url() + 'Administrativo/Actas/Acta/crearCompromisoSeguimiento',
			type:'POST',
			dataType: 'json',
			processData: false,
			contentType: false,
			cache: false,
			data: new FormData(this),
			success:function(resp) {
				if (resp) {
					$("#formSeguimientoCompromisos")[0].reset();
					DTSeguimientoCompromisos.ajax.reload();
					alertify.success("Se ha creado el seguimiento compromiso");
				} else {
					alertify.error("Error al crear un seguimineto compromiso");
				}
			}
		});
	});
});

function eliminarActa(id, nroActa){
	alertify.confirm(
		'Eliminar acta', 
		"¿Estas seguro de eliminar el acta?", 
		function(){ 
			$.ajax({
				url: base_url() + 'Administrativo/Actas/Acta/eliminarActa',
				type:'POST',
				data:{
					idActa: id,
					RASTREO: RASTREO("Se elimina el acta nro " + nroActa, "Actas")
				},
				success: function(resp){
					if (resp == 1) {
						DTActas.ajax.reload();
						alertify.success("Se ha eliminador el acta");
					} else {
						alertify.error("No se ha eliminado el acta");
					}
				}
			});
		}, 
		function(){}
	);
}

function listaActas(filtro = ""){
	var configActas = {data:{
		tblID : "#tblActas",
			select: [
				,"A.ActaId"
				,"A.Fecha"
				,"A.Radicado"
				,"TR.Nombre AS TipoReu"
				,"A.Tema"			
				,"S.nombre"
				,"A.ObjetivoReunion"
				,"'' AS acciones"
				,"A.UsrElaboraId AS Creador"
				,"AP.Visualiza"
				,"AP.Modifica"
				,"AP.Anula"
				,"AA.UsuarioId AS Asistente"
			],
			table : [
				`Acta A`
				,[
					[`TipoReunion TR`, 'A.TipoReunionId = TR.TipoReunionId', 'LEFT']	
					,[`Segur S`, 'A.UsrElaboraId = S.usuarioId', 'LEFT']
					,[`ActaPermiso AP`, `A.ActaId = AP.ActaId AND AP.UsuarioId = '${$USR}'`, 'LEFT']
					,[`ActaAsistente AA`, `A.ActaId = AA.ActaId AND AA.UsuarioId = '${$USR}'`, 'LEFT']
				],[]
			],
			column_order : [
				'ActaId'
				,"Fecha"
				,'Radicado'
				,'TipoReu'
				,'Tema'
				,'nombre'
				,'ObjetivoReunion'
				,"acciones"
			],
			column_search : [
				'Ruta'
			],
			orden : {"ActaId": 'ASC'},
			columnas : [
				'ActaId'
				,'Fecha'
				,'Radicado'
				,'TipoReu'
				,'Tema'
				,'nombre'
				,'ObjetivoReunion'
				,"acciones"
				,"Creador"
				,"Visualiza"
				,"Modifica"
				,"Anula"
				,"Asistente"
			],
		},
		processing: true,
		serverSide: true,
		order: [[0, 'ASC']],
		draw: 10,
		language,
		fixedColumns: true,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Anexos' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Anexos'},
			{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Anexos'},
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Anexos'},
			{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Anexos'} }
		],
		initComplete: function(){
			$('div.dataTables_filter input').unbind();
			$("div.dataTables_filter input").keyup( function (e) {
				e.preventDefault();
				if (e.keyCode == 13) {
					table = $("body").find("#tblActas").dataTable();
					table.fnFilter( this.value );
				}
			} );
			$('div.dataTables_filter input').focus();
		},
		createdRow: function(row,data,dataIndex){
			var btnVer = ''
				,btnModificar = ''
				,btnAnular = ''
	
			//Visualizar
			if (data[9] == 1 || data[8] == $USR || data[12] == $USR) {
				btnVer = `<a href="${base_url()}Administrativo/Actas/Acta/Ver/${data[0]}" type="button" class="btn btn-info" title="Ver acta"><i class='fas fa-eye'></i></a>`;
			}
	
			//Modificar
			if (data[10] == 1 || data[8] == $USR) {
				btnModificar = `<a href="${base_url()}Administrativo/Actas/Acta/Editar/${data[0]}" type="button" class="btn btn-success" title="Editar acta"><i class='fas fa-edit'></i></a>`;
			}
	
			//Eliminar
			if (data[11] == 1 || data[8] == $USR) {
				btnAnular = `<button type="button" class="btn btn-danger" onClick="eliminarActa(${data[0]}, ${data[1]})" title="Eliminar acta"><i class='far fa-trash-alt'></i></button>`;
			}
	
			var boton = `<div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-primary" onClick="compromisos(${data[0]})" title="Compromisos"><i class='fas fa-list'></i></button>
							${btnVer}
							${btnModificar}
							${btnAnular}
						</div>`;
	
			$(row).find('td:eq(6)').addClass("text-center").html(boton);
		},
		deferRender: true,
		scrollX: '100%',
		scrollY: $(document).height() - 500,
		scroller: {
			loadingIndicator: true
		},
		scrollCollapse: false,
		dom: domBftri,
		columnDefs:[
			{visible: false, targets:[0]}
		]
	}

	where = [];
	where.push(['A.Estado', 'A']);
	where.push([`(AP.UsuarioId = '${$USR}' OR AA.UsuarioId = '${$USR}' OR UsrElaboraId = '${$USR}')`]);

	if (filtro != "") {
		if (filtro['fechaInicio'] != "" && filtro['fechaFin'] != "") {
			where.push(["A.Fecha BETWEEN '" + filtro['fechaInicio'] + "' AND '" + filtro['fechaFin'] + "'"]);
		}

		if (filtro['tipoReunion'] != "") {
			where.push(['A.TipoReunionId IN (' + filtro['tipoReunion'] + ')']);
		}
	}

	configActas.data.table[2] = where;
	DTActas = dtSS(configActas);
}

function compromisos(id){
	if(tblCompromiso == 1){
		DTCompromisos.destroy();
	} else {
		tblCompromiso = 1;
	}

	var configCompromisos = {data:{
		tblID : "#tblCompromisos",
			select: [
				"'' AS accion"
				,"AC.ActaCompromisoId"
				,"S1.nombre AS UsuarioAsigna"
				,"S.nombre"
				,`CASE AC.Prioridad
						WHEN 'B' THEN 'Baja'
						WHEN 'M' THEN 'Media'
						WHEN 'A' THEN 'Alta'
					END AS Prioridad`
				,"AC.Descripcion"
				,"AC.FechaMax"
				,"FORMAT(FechaRegis , 'yyyy-MM-dd HH:mm:ss') AS FechaRegis"
				,"AC.UsuarioId"
			],
			table : [
				`ActaCompromiso AC`
				,[
					[`Segur S`, 'AC.UsuarioId = S.usuarioId', 'LEFT']	
					,[`Segur S1`, 'AC.UsuarioAsignaId = S1.usuarioId', 'LEFT']		
				],[]
			],
			column_order : [
				'accion'
				,'AC.ActaCompromisoId'
				,'S1.nombre'
				,'S.nombre'
				,'Prioridad'
				,'AC.Descripcion'
				,'AC.FechaMax'
				,'AC.FechaRegis'
			],
			column_search : [
				'S.nombre'
				,'S1.nombre'
				,'Prioridad'
				,'AC.Descripcion'
			],
			orden : {"AC.ActaCompromisoId": 'ASC'},
			columnas : [
				'accion'
				,'ActaCompromisoId'
				,'UsuarioAsigna'
				,'nombre'
				,'Prioridad'
				,'Descripcion'
				,'FechaMax'
				,'FechaRegis'
				,'UsuarioId'
			],
		},
		processing: true,
		serverSide: true,
		order: [[0, 'ASC']],
		draw: 10,
		language,
		fixedColumns: true,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos'},
			{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos'},
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos'},
			{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Compromisos'} }
		],
		initComplete: function(){
			$('div.dataTables_filter input').unbind();
			$("div.dataTables_filter input").keyup( function (e) {
				e.preventDefault();
				if (e.keyCode == 13) {
					table = $("body").find("#tblCompromisos").dataTable();
					table.fnFilter( this.value );
				}
			} );
			$('div.dataTables_filter input').focus();
		},
		createdRow: function(row,data,dataIndex){
			var boton = `<div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-info" onClick="listaSeguimiento(${data[1]}, '${data[8]}')" title="Seguimiento"><i class='far fa-clipboard'></i></button>
						</div>`;
	
			$(row).find('td:eq(0)').addClass("text-center").html(boton);
			$(row).find('td:eq(6)').html(moment(data[7], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
		},
		deferRender: true,
		scrollX: '100%',
		scrollY: $(document).height() - 620,
		scroller: {
			loadingIndicator: true
		},
		scrollCollapse: false,
		dom: domBftri,
		columnDefs:[
			{visible: false, targets:[1]}		
		]
	}

	where = [];
	where.push(['AC.ActaId', id]);
	where.push(['AC.Estado', 'A']);
	configCompromisos.data.table[2] = where;

	setTimeout(() => {
		DTCompromisos = dtSS(configCompromisos);
	}, 100);


	$("#divCompromisos").removeClass("d-none");
	$("#divSeguimientoCompromisos").addClass("d-none");

	$("#modalCompromiso").modal("show");
}

function listaSeguimiento(id, usuario){
	
	if (usuario == $USR) {
		$("#formSeguimientoCompromisos").removeClass("d-none");
		$("#idUsuarioCompromiso").val(usuario);
		$("#idSeguimientoCompromiso").val(id);
	} else {
		$("#formSeguimientoCompromisos").addClass("d-none");
		$("#idUsuarioCompromiso").val('');
		$("#idSeguimientoCompromiso").val('');
	}

	var configSeguimientoCompromisos = {data:{
		tblID : "#tblSeguimientoCompromisos",
			select: [
				"SC.SeguimientoCompromisoId"
				,"FORMAT(FechaRegis , 'yyyy-MM-dd HH:mm:ss') AS FechaRegis"
				,"SC.Seguimiento"
			],
			table : [
				`SeguimientoCompromiso SC`
				,[],[
					['ActaCompromisoId', id]
				]
			],
			column_order : [
				"SeguimientoCompromisoId"
				,"FechaRegis"
				,"Seguimiento"
			],
			column_search : [
				"Seguimiento"
				,"FechaRegis"
			],
			orden : {"SC.SeguimientoCompromisoId": 'ASC'},
			columnas : [
				"SeguimientoCompromisoId"
				,"FechaRegis"
				,"Seguimiento"
			],
		},
		processing: true,
		serverSide: true,
		order: [[0, 'ASC']],
		draw: 10,
		language,
		fixedColumns: true,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos'},
			{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos'},
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Compromisos'},
			{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Compromisos'} }
		],
		initComplete: function(){
			$('div.dataTables_filter input').unbind();
			$("div.dataTables_filter input").keyup( function (e) {
				e.preventDefault();
				if (e.keyCode == 13) {
					table = $("body").find("#tblSeguimientoCompromisos").dataTable();
					table.fnFilter( this.value );
				}
			} );
			$('div.dataTables_filter input').focus();
		},
		createdRow: function(row,data,dataIndex){
			$(row).find('td:eq(0)').html(moment(data[1], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
		},
		deferRender: true,
		scrollX: '100%',
		scrollY: $(document).height() - 620,
		scroller: {
			loadingIndicator: true
		},
		scrollCollapse: false,
		dom: domBftri,
		columnDefs:[
			{visible: false, targets:[0]}
		]
	}

	if (tblSeguimientoCompromisos == 0){
		tblSeguimientoCompromisos = 1;
	} else {
		DTSeguimientoCompromisos.destroy();
	}

	DTSeguimientoCompromisos = dtSS(configSeguimientoCompromisos);

	$("#divSeguimientoCompromisos").removeClass("d-none");
	$("#divCompromisos").addClass("d-none");

}