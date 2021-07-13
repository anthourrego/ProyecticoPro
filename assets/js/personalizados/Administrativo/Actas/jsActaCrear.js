var tblCompromiso = 0;
var lastFocus = '';
var tblAnexos = 0;
var tblSeguimientoCompromisos = 0;
var nroActa = '';

var tiempo = 0;
var tiempoAnt = 0;
var timer;

var selects = {
	permisoVisualizacion: ''
	,permisoModificacion: ''
	,permisoAnulacion: ''
	,asistentes: ''
}

var DTCompromiso;
var DTSeguimientoCompromisos;
var DTAnexos;

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

		var btnEliminar = $MODIFICAR != 1 ? `<button type="button" class="btn btn-danger" onClick="eliminarCompromiso(${data[1]})" title="Eliminar"><i class='far fa-trash-alt'></i></button>` : '';

		var boton = `<div class="btn-group btn-group-xs">
						<button type="button" class="btn btn-info" onClick="listaSeguimiento(${data[1]})" title="Seguimiento"><i class='far fa-clipboard'></i></button>
						${btnEliminar}
					</div>`;

		$(row).find('td:eq(0)').addClass("text-center").html(boton);
		$(row).find('td:eq(6)').html(moment(data[7], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
	},
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 810,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{visible: false, targets:[1]}		
	]
}

var configAnexos = {data:{
	tblID : "#tblAnexos",
		select: [
			,"AnexoId"
			,"'' AS Tipo"
			,"'' AS Nombre"			
			,"Ruta"
			,"FORMAT(Fecha, 'yyyy-MM-dd HH:mm:ss') AS Fecha"
			,"'' AS accion"
		],
		table : [
			`Anexo`
			,[],[]
		],
		column_order : [
			'AnexoId'
			,'Tipo'
			,'Nombre'
			,'Ruta'
			,'Fecha'
			,'accion'
		],
		column_search : [
			'Ruta'
		],
		orden : {"AnexoId": 'ASC'},
		columnas : [
			'AnexoId'
			,'Tipo'
			,'Nombre'
			,'Ruta'
			,'Fecha'
			,'accion'
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
				table = $("body").find("#tblAnexos").dataTable();
				table.fnFilter( this.value );
			}
		} );
		$('div.dataTables_filter input').focus();
	},
	createdRow: function(row,data,dataIndex){
		var ruta = data[3].split('/');
		var tipoDoc = ruta[4].split('.');
		var nombre = tipoDoc[0];
		var enlace = "";
		var rutaDoc = base_url()+data[3];
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
		$(row).find('td:eq(0)').addClass("text-center").html(tipoDoc[1].toUpperCase());
		$(row).find('td:eq(1)').addClass("text-center").html(nombre);
		$(row).find('td:eq(2)').addClass("text-center").html(enlace);
		$(row).find('td:eq(3)').addClass("text-center").html(moment(data[4], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));

		boton = $MODIFICAR != 1 ? `<div class="btn-group btn-group-xs">
					<button type="button" class="btn btn-danger" onClick="eliminarAnexo(${data[0]})" title="Eliminar"><i class='far fa-trash-alt'></i></button>
				</div>` : '';

		$(row).find('td:eq(4)').addClass("text-center").html(boton);

	},
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 730,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{visible: false, targets:[0]}
		,{visible: ($MODIFICAR != 1 ? true : false), targets:[5]}
	]
}

$(function(){
	bsCustomFileInput.init();

	$('.chosen-select').chosen({
		placeholder_text_single: 'Seleccione'
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	});

	if($IDACTA != 0){

		$("[data-toggle='tab']").removeClass("disabled");

		$("#btnRegistro").addClass("d-none");
		$("#btnSiguiente").removeClass("d-none");

		$("#formCrear select[name='tipoReunion']").val($DATOSACTA['TipoReunionId']).trigger("chosen:updated");
		$("#formCrear select[name='quienElabora']").val($DATOSACTA['UsrElaboraId']).trigger("chosen:updated");

		selects['permisoVisualizacion'] = $DATOSACTA['visualiza'];
		selects['permisoModificacion'] = $DATOSACTA['modifica'];
		selects['permisoAnulacion'] = $DATOSACTA['anula'];
		selects['asistentes'] = $DATOSACTA['asistentes'];
		nroActa = $DATOSACTA['Radicado']; 

		if($DATOSACTA['Tiempo'] == null || $DATOSACTA['Tiempo'] == '.00'){
			$DATOSACTA['Tiempo'] = 0;
		}

		tiempo = parseInt($DATOSACTA['Tiempo']);
		$('#txtTiempo').val(segundosDias($DATOSACTA['Tiempo']));

		$("#formCrear select[name='permisoVisualizacion[]']").val($DATOSACTA['visualiza']).trigger("chosen:updated");
		$("#formCrear select[name='permisoModificacion[]']").val($DATOSACTA['modifica']).trigger("chosen:updated");
		$("#formCrear select[name='permisoAnulacion[]']").val($DATOSACTA['anula']).trigger("chosen:updated");
		$("#formCrear select[name='asistentes[]']").val($DATOSACTA['asistentes']).trigger("chosen:updated");		

		$("#formCompromisos select").prop("disabled", false).trigger("chosen:updated");
		$("#formCompromisos select, #formCompromisos button, #formCompromisos textarea, #formCompromisos input").prop("disabled", false);
		$("#formAnexos input, #formAnexos button").prop("disabled", false);

	}

	$("#formCrear").submit(function(event){
		dataForm = new FormData(this)
		dataForm.append("tiempo", tiempo);
		event.preventDefault();

		if ($("#formCrear").valid()) {
			$.ajax({
				url: base_url() + 'Administrativo/Actas/Acta/crearActa',
				type:'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				cache: false,
				data: dataForm,
				success:function(resp) {
					if (resp != 0) {
						$IDACTA = resp['idActa'];
						nroActa = resp['nroActa'];
						selects['permisoVisualizacion'] = $("#formCrear select[name='permisoVisualizacion[]']").val();
						selects['permisoModificacion'] = $("#formCrear select[name='permisoModificacion[]']").val();
						selects['permisoAnulacion'] = $("#formCrear select[name='permisoAnulacion[]']").val();
						selects['asistentes'] = $("#formCrear select[name='asistentes[]']").val();
						tiempoAnt = tiempo;
						$MODIFICAR = 2;
						alertify.success("Se ha registrado el acta");
						$("#btnRegistro").addClass("d-none");
						$("#btnSiguiente").removeClass("d-none").click();
						
						$("#formCompromisos select").prop("disabled", false).trigger("chosen:updated");
						$("#formCompromisos select, #formCompromisos button, #formCompromisos textarea, #formCompromisos input").prop("disabled", false);
						$("#formAnexos input, #formAnexos button").prop("disabled", false);
						$("#formCrear").validate().resetForm();
						
					} else {
						alertify.error("No se ha registrado el acta");
					}
				}
			});
		}else{
			alertify.alert("Atención","Debe diligenciar los campos obligatorios (*)");
		}
	});

	$("#formCompromisos").submit(function(event){
		event.preventDefault();
		
		if($IDACTA != 0) {

			if ($("#formCompromisos").valid()) {
				form = new FormData(this);
				form.append("idActa", $IDACTA);
				form.append("nroActa", nroActa);
				form.append("asignado", $(this).find("select[name='usuario'] option[value='" + $("#formCompromisos select[name='usuario']").val() + "']").text());
				form.append("prioridadNombre", $(this).find("select[name='prioridad'] option[value='" + $("#formCompromisos select[name='prioridad']").val() + "']").text());
				$.ajax({
					url: base_url() + 'Administrativo/Actas/Acta/crearCompromiso',
					type:'POST',
					dataType: 'json',
					processData: false,
					contentType: false,
					cache: false,
					data: form,
					success:function(resp) {
						$("#formCompromisos select[name='usuario'], #formCompromisos select[name='prioridad']").val("").trigger("chosen:updated");
						$("#formCompromisos")[0].reset();
						$("#formCompromisos").validate().resetForm();
						DTCompromiso.ajax.reload();
					}
				});
			}
		} else {
			alertify.error("No se ha creado el compromiso");
		}
	});

	$("#formSeguimientoCompromisos").submit(function(event){
		event.preventDefault();
		if($IDACTA != 0) {
			if ($("#formSeguimientoCompromisos").valid()) {
				form = new FormData(this);
				$.ajax({
					url: base_url() + 'Administrativo/Actas/Acta/crearCompromisoSeguimiento',
					type:'POST',
					dataType: 'json',
					processData: false,
					contentType: false,
					cache: false,
					data: form,
					success:function(resp) {
						if (resp) {
							$("#formSeguimientoCompromisos")[0].reset();
							$("#formSeguimientoCompromisos").validate().resetForm();
							DTSeguimientoCompromisos.ajax.reload();
							alertify.success("Se ha creado el seguimiento compromiso");
						} else {
							alertify.error("Error al crear un seguimineto compromiso");
						}
					}
				});
			}
		} else {
			alertify.error("No se ha registrado un seguimiento compromiso");
		}
	});

	$("#formAnexos").submit(function(e){
		e.preventDefault();
		if ($("#formAnexos").valid()) {
			if (typeof FormData !== 'undefined' && $IDACTA != 0) {
				var form_data = new FormData(this);
				form_data.append('codigo', $IDACTA);
				form_data.append("nroActa", nroActa);
				$.ajax({
					url: base_url() + 'Administrativo/Actas/Acta/anexoArchivo',
					type: "POST",
					data: form_data,
					async	: false,
					cache	: false,
					contentType : false,
					processData : false,
					success: function(resultado){
						if (resultado != 0) {
							DTAnexos.ajax.reload();
							$("#formAnexos")[0].reset();
							$("#form-image-span").text('Seleccione un archivo...');
							setTimeout(() => {
								$("#formAnexos").validate().resetForm();
							}, 100);
							alertify.success("Anexo guardado exitosamente");
						}else{
							alertify.error("!Error, no se pudieron guardar los anexos; comuniquese con el administrador del sistema");
						}
					},
					error: function(error){
						alertify.alert('Error', error.responseText);
						console.log(error);
					}
				});
			} else {
				alertify.error("No se ha cargado el anexo");
			}
		}
	});

	$("#finalizar").on("click", function(){
		if($('#btnTiempo').find('span').text() == 'Detener' && $MODIFICAR == 2 && tiempo != tiempoAnt){
			actualizar(tiempoAnt, $('#txtTiempo'));
		}

		window.location.href = base_url() + 'Administrativo/Actas/Acta';
	});

	//Initialize tooltips
	$('.nav-tabs > li a[title]').tooltip();

	//Wizard
	$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
	
		var $target = $(e.target);
	
		if ($target.hasClass('disabled')) {
			return false;
		}

		if ($target.attr("aria-controls") == "step2" && tblCompromiso == 0 && $IDACTA != 0 ) {

			where = [];
			where.push(['AC.ActaId', $IDACTA]);
			where.push(['AC.Estado', 'A']);
			configCompromisos.data.table[2] = where;
			DTCompromiso = dtSS(configCompromisos);

			tblCompromiso = 1;
		}

		if ($target.attr("aria-controls") == "step2" && tblCompromiso == 1 && $IDACTA != 0) {
			setTimeout(() => {
				DTCompromiso.columns.adjust();
			}, 100);
		}

		if ($target.attr("aria-controls") == "step3" && tblAnexos == 0 && $IDACTA != 0) {
			where = [];
			where.push(['Id', $IDACTA]);
			where.push(['Tipo', 'ACTA']);					
			configAnexos.data.table[2] = where;
			DTAnexos = dtSS(configAnexos);
			tblAnexos = 1;
		}

		if ($target.attr("aria-controls") == "step3" && tblAnexos == 1 && $IDACTA != 0) {
			setTimeout(() => {
				DTAnexos.columns.adjust();
			}, 100);
		}

	});
	
	$(".next-step").click(function (e) {
		var $active = $('.wizard .nav-tabs .nav-item .active');
		var $activeli = $active.parent(".nav-item");
	
		$($activeli).next(".nav-item").find('a[data-toggle="tab"]').removeClass("disabled");
		$($activeli).next(".nav-item").find('a[data-toggle="tab"]').click();

	});
	
	$(".prev-step").click(function (e) {
	
		var $active = $('.wizard .nav-tabs .nav-item .active');
		var $activeli = $active.parent(".nav-item");
	
		$($activeli).prev(".nav-item").find('a[data-toggle="tab"]').removeClass("disabled");
		$($activeli).prev(".nav-item").find('a[data-toggle="tab"]').click();

	});

	$(".chosen-container").on("click", function(){
		lastFocus = $(this).siblings('select').val();
		if(lastFocus == null){
			lastFocus = '';
		}
	});

	$("#formCrear").on("focusin", "[data-db]", function(){
		lastFocus = $(this).val();
		if(lastFocus == null){
			lastFocus = '';
		}
	});
	
	$("#formCrear input[data-db], #formCrear select:not([multiple])[data-db], #formCrear textarea[data-db]").on("change", function(){
		if ($MODIFICAR == 2 && $IDACTA != 0 && lastFocus != $(this).val()) {
			actualizar(lastFocus, $(this));
		}
	});

	$("#formCrear select[multiple][data-db]").chosen().change(function(){
		if($MODIFICAR == 2 && $IDACTA != 0) {
			nombreSelect = $(this).attr("name").slice(0, -2)
			array = selects[nombreSelect];
	
			if($(this).val().length > 0){
				if (array.length < $(this).val().length) {
					id = diferenciaDeArreglos($(this).val(), array)[0];
					if (nombreSelect == 'asistentes') {
						actualizarAsistentes(id, $(this), 1);
					} else {
						actualizarPermisos(id, $(this), 1);
					}
				} else {
					id = diferenciaDeArreglos(array, $(this).val())[0];
					
					if (nombreSelect == 'asistentes') {
						actualizarAsistentes(id, $(this), 0);
					} else {
						actualizarPermisos(id, $(this), 0);
					}
				}
			} else {
				if (nombreSelect == 'asistentes') {
					id = diferenciaDeArreglos(array, $(this).val())[0];
					actualizarAsistentes(id, $(this), 0);
				} else {
					$(this).val(array).trigger("chosen:updated");
					alertify.warning("El campo " + $(this).data("nombre") + " no puede estar vacio.");
				}
			}
		}
	});

	$('#btnTiempo').on('click', function(e){
		e.preventDefault();
		if($(this).find('span').text() == 'Iniciar'){
			timer = window.setInterval(function(){
				tiempo++;
				$('#txtTiempo').val(segundosDias(tiempo));
			},1000);
			$('.divRestablecer').addClass('d-none');
			$(this).find('span').text('Detener');
		}else{
			if($MODIFICAR == 2 && tiempo != tiempoAnt){
				actualizar(tiempoAnt, $('#txtTiempo'));
			}

			$(this).find('span').text('Iniciar');
			$('.divRestablecer').removeClass('d-none');
			window.clearInterval(timer);
		}
	});

	$('#btnRestablecer').on('click', function(e){
		e.preventDefault();
		alertify.confirm('Advertencia', '¿Está seguro de restablecer el tiempo?', function(){

			$('.divRestablecer').addClass('d-none');
			tiempo = 0;
			timer = undefined;
			$('#txtTiempo').val(segundosDias(tiempo));

			if($MODIFICAR == 2 && tiempo != tiempoAnt){
				actualizar(tiempoAnt, $('#txtTiempo'));
			}
		}, function(){

		});
	});
	
});

function eliminarCompromiso(id){
	alertify.confirm(
		'Eliminar compromiso', 
		"¿Estas seguro de eliminar el compromiso?", 
		function(){ 
			$.ajax({
				url: base_url() + 'Administrativo/Actas/Acta/eliminarCompromiso',
				type:'POST',
				data:{
					idCompromiso: id,
					RASTREO: RASTREO("Se cancela el compromiso ID " + id, "Actas")
				},
				success: function(resp){
					if (resp == 1) {
						DTCompromiso.ajax.reload();
						alertify.success("Se ha eliminado el compromiso");
					} else {
						alertify.error("No se ha eliminado el compromiso");
					}
				}
			});
		}, 
		function(){}
	);
}

function listaSeguimiento(id){
	var configSeguimientoCompromisos = {data:{
		tblID : "#tblSeguimientoCompromisos",
			select: [
				"SC.SeguimientoCompromisoId"
				,"FORMAT(FechaRegis , 'yyyy-MM-dd') AS FechaRegis"
				,"SC.Seguimiento"
				,"'' AS accion"
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
				,'accion'
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
				,'accion'
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
	
			var boton = $MODIFICAR != 1 ? `<div class="btn-group btn-group-xs">
							<button type="button" class="btn btn-danger" onClick="eliminarSeguimientoCompromiso(${data[0]})" title="Eliminar"><i class='far fa-trash-alt'></i></button>						
						</div>` : '';
	
			$(row).find('td:eq(2)').addClass("text-center").html(boton);
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
			,{visible: ($MODIFICAR != 1 ? true : false),targets:[3]}
		]
	}

	if (tblSeguimientoCompromisos == 0){
		tblSeguimientoCompromisos = 1;
	} else {
		DTSeguimientoCompromisos.destroy();
	}

	setTimeout(() => {
		DTSeguimientoCompromisos = dtSS(configSeguimientoCompromisos);
	}, 100);

	$("#formSeguimientoCompromisos :input[name='idSeguimientoCompromiso']").val(id);

	$("#modalSeguimiento").modal("show");
}

function eliminarSeguimientoCompromiso(id){
	alertify.confirm(
		'Eliminar el seguimineto compromiso', 
		"¿Estas seguro de eliminar el compromiso?", 
		function(){ 
			$.ajax({
				url: base_url() + 'Administrativo/Actas/Acta/eliminarSeguimientoCompromiso',
				type:'POST',
				data:{
					id,
					RASTREO: RASTREO("Se elimina el Seguimiento Compromiso ID " + id, "Actas")
				},
				success: function(resp){
					if (resp == 1) {
						DTSeguimientoCompromisos.ajax.reload();
						alertify.success("Se ha eliminado el seguimiento compromiso");
					} else {
						alertify.error("No se ha eliminado el seguimiento compromiso");
					}
				}
			});
		}, 
		function(){}
	);
}

function actualizar(valorAnt, input){
	campo = input.data("db");
	valor = input.val();
	msj = 'Se actualiza el acta nro ' + nroActa + ' campo ' + input.data("nombre") + ' de "' + valorAnt + '" a "' + valor + '".';
	if(input.data("db") == "Tiempo") {
		valor = tiempo;
		msj = 'Se actualiza el acta nro ' + nroActa + ' campo ' + input.data("nombre") + ' de "' + valorAnt + '" segundos a "' + valor + '" segundos.';
	}
	$.ajax({
		type: "POST",
		url: base_url()+'Administrativo/Actas/Acta/ActualizarActa',
		async: false,
		data: {
			campo
			,valor
			,idActa: $IDACTA
			,RASTREO: RASTREO(msj, 'Actas')
		},
		success: function(datos){
			if(datos == 0){
				alerify.error("No se ha actualizado.");
			} else {
				if(input.data("db") == "Tiempo") {
					tiempoAnt = tiempo;
				}

				alertify.success("Se ha actualizado correctamente.");
			}

		}
	}); 
}

function actualizarPermisos(valor, input, tipo){
	campo = input.data("db");
	msj = 'Se ' + (tipo == 1 ? 'agrega' : 'elimina') + ' usuario ' + input.find("option[value='" + id + "']").text() + '(' + valor + ') de ' + input.data("nombre") + ' del acta nro ' + nroActa;
	$.ajax({
		type: "POST",
		url: base_url()+'Administrativo/Actas/Acta/actualizarPermisos',
		async: false,
		data: {
			campo
			,valor
			,tipo
			,idActa: $IDACTA
			,RASTREO: RASTREO(msj, 'Actas')
		},
		success: function(datos){
			if(datos == 0){
				alerify.error("No se ha actualizado.");
			} else {
				nombreArray = input.attr("name").slice(0, -2); 
				selects[nombreArray] = input.val();
				alertify.success("Se ha actualizado correctamente.");
			}
		}
	}); 
}

function actualizarAsistentes(valor, input, tipo){
	msj = 'Se ' + (tipo == 1 ? 'agrega' : 'elimina') + ' usuario ' + input.find("option[value='" + id + "']").text() + '(' + valor + ') de ' + input.data("nombre") + ' del acta nro ' + nroActa;
	$.ajax({
		type: "POST",
		url: base_url()+'Administrativo/Actas/Acta/actualizarAsistentes',
		async: false,
		data: {
			valor
			,tipo
			,idActa: $IDACTA
			,RASTREO: RASTREO(msj, 'Actas')
		},
		success: function(datos){
			if(datos == 0){
				alerify.error("No se ha actualizado.");
			} else {
				nombreArray = input.attr("name").slice(0, -2); 
				selects[nombreArray] = input.val();
				alertify.success("Se ha actualizado correctamente.");
			}
		}
	}); 
}

function diferenciaDeArreglos(arr1, arr2){
	return arr1.filter(elemento => arr2.indexOf(elemento) == -1);
}

function eliminarAnexo(id){
	alertify.confirm(
		'Eliminar anexo', 
		"¿Estas seguro de eliminar anexo?", 
		function(){ 
			$.ajax({
				url: base_url() + 'Administrativo/Actas/Acta/eliminarAnexo',
				type:'POST',
				data:{
					id
					,RASTREO: RASTREO("Se elimina anexo ID " + id, "Actas")
				},
				success: function(resp){
					if (resp == 1) {
						DTAnexos.ajax.reload();
						alertify.success("Se ha eliminado el anexo");
					} else {
						alertify.error("No se ha eliminado el anexo");
					}
				}
			});
		}, 
		function(){}
	);
}

function segundosDias(Tiempo){
	var seconds = parseInt(Tiempo, 10);
	var days = Math.floor(seconds / (3600 * 24));

	seconds -= days * 3600 * 24;
	var hrs = Math.floor(seconds / 3600);
	seconds -= hrs*3600;
	var mnts = Math.floor(seconds / 60);
	seconds -= mnts*60;

	if(days > 0){
		if(days > 99)
			return (addCommas(days) + ':' + ('0' + hrs).slice(-2) + ':' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
		else
			return (('0' + days).slice(-2) + ':' + ('0' + hrs).slice(-2) + ':' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
	}else if(hrs > 0){
		return (('0' + hrs).slice(-2) + ':' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
	}else{
		return '00:' + (('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
	}
}

function addCommas(nStr) {
	if (nStr != 'null') {
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}else{
		return '0';
	}
}