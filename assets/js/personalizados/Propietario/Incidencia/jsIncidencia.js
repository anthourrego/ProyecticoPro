$supported_image = ['.gif', '.jpg', '.jpeg', '.png'];
var altura = $(document).height();
var DT;
var $HEADINCIDENCIA = 0;

var dtTbHistorialIncidencia = $('#TblHistorialIncidencia').DataTable({
	language,
	processing: true,
	pageLength: 10,
	ordering: false,
	dom: domBftrip,
	ajax: {
		url: base_url()+"Propietario/Incidencia/cIncidencia/qHistorialIncidencia",
		type: 'POST',
		data: function(d){
			return  $.extend(d, {HeadIncidenciaId: $HEADINCIDENCIA});
		}
	},
	columns: [
		{
			data: 'FechaRegis',
			render: function(nTd, sData, oData, iRow, iCol){
				return moment(oData.FechaRegis, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A");
			}
		},
		{data: 'nombre'},
		{data: 'DetalleP'}
	],
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel'},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF'},
		{ extend: 'print', className: 'printButton', text: 'Imprimir'},
		{ extend: 'pageLength'}
	] 
});

$(function(){
	lista();
  	bsCustomFileInput.init();

	$('.chosen-select').chosen({
		placeholder_text_single: ''
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	})
	
	//Seteamos los campos al cargar
	$("#TipoIncidencia").val(0);
	//$("#selectFact, #TerceroId, #Descripcion, #form-image").val("");
	$("#form-image-span").text("Seleccione un archivo...");

	$("#btnLimpiarFiltro").on("click", function(){
		$("#fFechaInicio, #fFechaFin").val("");
		$("#EstadoIncidenciaId").val("").trigger("chosen:updated");
	});

	$("#btnFiltrar").on("click", function(){
		filtro = [];
		filtro["fechaInicio"] = "";
		filtro["fechaFin"] = "";
		filtro["EstadoIncidenciaId"] = "";

		fechaInicio = $("#fFechaInicio").val();
		fechaFin = $("#fFechaFin").val();
		EstadoIncidenciaId = $("#EstadoIncidenciaId").val();
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

		if (EstadoIncidenciaId.length > 0) {
			filtro.push(EstadoIncidenciaId.toString());
			filtro["EstadoIncidenciaId"] = EstadoIncidenciaId.toString();
		}


		if (filtro.length > 0 && noFiltra == 0){
			DT.destroy();
			lista(filtro);
		}

	});

	$("#btnFiltrarTodo").on("click", function(){
		DT.destroy();
		lista();
	});
	
	$('#frmRegistrar').on('submit', function(e){
		e.preventDefault();
		
		if ($("#TipoIncidenciaId").val() == null) {
			alertify.error("Seleccione un tipo de incidencia");
			$("#TipoIncidenciaId").focus();
			return false;
		}
		
		if ($("#ItemEquipoId").val() == null) {
			alertify.error("Seleccione un equipo");
			$("#ItemEquipoId").focus();
			return false;
		}

		if ($("#Asunto").val().trim() == "") {
			alertify.error("Ingrese el Asunto");
			$("#Asunto").focus();
			return false;
		}
	
		if ($("#Descripcion").val().trim() == "") {
			alertify.error("Ingrese la Descripción");
			$("#Descripcion").focus();
			return false;
		}
	
		$.ajax({
			url: base_url() + 'Propietario/Incidencia/cIncidencia/crear',
			type:'POST',
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false,
			data: new FormData(this),
			success:function(respuesta) {
				if (respuesta == 0) {
					alertify.error("Registro no guardado");
				} else {
					try {
						respuesta = JSON.parse(respuesta);
						HeadIncidenciaId = respuesta[0];
						Numero = respuesta[1]
						var html = '';
						if(respuesta[2] == '[]'){
							alertify.alert(`
							<div class="navbar-brand border-0 text-center">
								<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
							</div>`, 
							`<div class="item active text-center">
								<span>Incidencia enviada satisfactoriamente</span>
								<h3>N° Incidencia</h3>
								<div class="alert alert-secondary text-center display-4 font-weight-normal">
									${Numero}
								</div>
							</div>`, 
							function() {
								// Si tiene el permiso, me lleva al tramite de la pqr
								DT.draw();
								$("#frmRegistrar")[0].reset();
								$("#frmRegistrar select").trigger('chosen:updated');
							});
						} else {
							var subidas = JSON.parse(respuesta[2]);
							if(subidas.length > 0){
								html += '<div class="text-center">Archivos Subidos</div>';
								for (var i = 0; i < subidas.length; i++) {
									if(subidas[i]['estado'] == 1){
										var alert = 'success',
										icon = 'check-circle';
									} else {
										var alert = 'danger',
										icon = 'fa-exclamation-circle';
									}
									var subida = `<div class='alert alert-${alert}' role='alert'>
													<span class='fas fa-${icon}' aria-hidden='true'></span> ${subidas[i]['nombre']}
												</div>`;
									html += subida;
								}

								html += `<div class="item active text-center">
											<span>Incidencia enviada satisfactoriamente</span>
											<h3>N° Incidencia</h3>
											<div class="alert alert-secondary text-center display-4 font-weight-normal">
												${Numero}
											</div>
										</div>`;

								alertify.alert(`
									<div class="navbar-brand border-0 text-center">
										<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
									</div>`,
									html, function(){
										$("#frmRegistrar")[0].reset();
										$("#frmRegistrar select").trigger('chosen:updated');
										DT.draw();
									}
								);
							} else {
								alertify.alert(`
								<div class="navbar-brand border-0 text-center">
									<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
								</div>`, 
								`<div class="item active text-center">
									<span>Incidencia enviada satisfactoriamente</span>
									<h3>N° Incidencia</h3>
									<div class="alert alert-secondary text-center display-4 font-weight-normal">
										${Numero}
									</div>
								</div>`, 
								function() {
									$("#frmRegistrar")[0].reset();
									$("#frmRegistrar select").trigger('chosen:updated');
									DT.draw();
								});
							}
						}
					} catch(e) {
						console.log(respuesta);
						console.error(e.message);
						alertify.error("Error al guardar los datos");
					}
				}
			}
		});
	});

	//Ocultar las imagenes de las notas
	$(document).on('click', '.btn-hidden', function(e) {
		e.preventDefault();
		var selector = $(this).closest('.div-hidden').find('[data-ocultar]');
		var btn = this;
		selector.slideToggle(400, function() {
			if ($(this).css('display') == 'none') {
				$('span', btn).removeClass('fa-arrow-alt-circle-up').addClass('fa-arrow-alt-circle-down');
			} else {
				$('span', btn).removeClass('fa-arrow-alt-circle-down').addClass('fa-arrow-alt-circle-up');
			}
		});
	});

});

function ver(id){
    $.ajax({
        url: base_url() + 'Propietario/Incidencia/cIncidencia/ver',
        type:'POST',
        dataType: 'json',
        async: false,
        data: {
            id
        },
        success:function(respuesta) {	

			$HEADINCIDENCIA = id;

			setTimeout(() => {
				$("#notas").scrollTop(0);
			}, 100);

			$("#frmVerIncidencia [name='Numero']").val(respuesta['informacion'].Numero);
            $("#frmVerIncidencia [name='TipoIncidencia']").val(respuesta['informacion'].NombreTipoIncidencia);
            $("#frmVerIncidencia [name='Estado']").val(respuesta['informacion'].NombreEstado);
            $("#frmVerIncidencia [name='NombrePrioridad']").val(respuesta['informacion'].NombrePrioridad);
            $("#frmVerIncidencia [name='FechaCreacion']").val(moment(respuesta['informacion'].Fecha, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
            $("#frmVerIncidencia [name='NombreEquipo']").val(respuesta['informacion'].NombreEquipo);
            $("#frmVerIncidencia [name='Serial']").val(respuesta['informacion'].Serial);
            $("#frmVerIncidencia [name='Asunto']").val(respuesta['informacion'].Asunto);
            $("#frmVerIncidencia [name='Descripcion']").val(respuesta['informacion'].Descripcion);
            $("#frmVerIncidencia [name='Operacion']").val(respuesta['informacion'].Operacion);

            $("#tablaNotas").empty();

            if (respuesta['notas'].length > 0) {
                for (let i = 0; i < respuesta['notas'].length; i++) {
                    if (respuesta['notas'][i].Archivo != null) {
                        $adjuntos = '';
    						
                            ext = respuesta['notas'][i].Archivo.substring(respuesta['notas'][i].Archivo.lastIndexOf("."));
    
                             if ($supported_image.includes(ext)) {     
                                 $adjuntos = $adjuntos + '<div class="div-hidden"><a download="' + respuesta['notas'][i].Archivo  + '" href="' + base_url() + respuesta['notas'][i].Archivo  + '"><i class="fas fa-image"></i> ' + respuesta['notas'][i].Archivo + '</a> <a href="#" class="btn-hidden span-hidden" title="Ver imagen"><span class="fas fa-arrow-alt-circle-up"></span></a><div data-ocultar><a href="' + base_url() + respuesta['notas'][i].Archivo + '" target="_blank" class="img-pqr"><img class="w-25" src="' + base_url() + respuesta['notas'][i].Archivo + '"/></a></div></div>';
                             } else {
                                 $adjuntos = $adjuntos + '<a download="' + respuesta['notas'][i].Archivo + '" href="' + base_url() + respuesta['notas'][i].Archivo + '"><i class="fas fa-file"></i> ' + respuesta['notas'][i].Archivo + '</a><br/>';
                             }
                        
                         respuesta['notas'][i].Descripcion = respuesta['notas'][i].Descripcion  + '<br/>' + $adjuntos;
    
                    }

					
					var iconoPublicoPrivado = respuesta['notas'][i].Privado == 'Publico' ? 'fa-eye' : 'fa-eye-slash';

					$("#tablaNotas").append(`
						<tr>
							<td style="width: 35%" class="px-3">
								<div class="row no-gutters">
									<div class="col-9">
										<div class="text-truncate">
											<i class="fas fa-user"></i> <strong>${respuesta['notas'][i].Usuario}</strong>
										</div>
									</div>
									<div class="col-3 text-right">
										<i class="far ${iconoPublicoPrivado}"></i> ${respuesta['notas'][i].Privado}</span>
									</div>
								</div>
								<p class="mt-2"><i class="far fa-clock"></i> ${respuesta['notas'][i].FechaRegis}</p>
							</td>
							<td class="px-3" style="width: 65%; ${respuesta['notas'][i].PrivadoColor}">
								${respuesta['notas'][i].Descripcion}
							</td>
						</tr>
						<tr class="spacer">
							<td colspan="2"></td>
						</tr>
					`);
                }
            } else {
                $("#tablaNotas").html("<div class='text-center'>No se hay notas disponibles.</div>");
            }
			
			dtTbHistorialIncidencia.ajax.reload();

            $("#verIncidencia").modal("show");
        }
    });

}

function lista(filtro = ""){
	var config = {
			data:{
				tblID : "#tblIncidencia",
				select: [
					'HI.HeadIncidenciaid'
					,'HI.Numero'
					,'HI.TipoIncidenciaId'
					,'HI.EstadoIncidenciaId'
					,'HI.TipoPrioridadIncidenciaId'
					,'HI.ItemEquipoId'
					,'OP.Operacion'
					,'HI.Ticket'
					,'HI.Asunto'
					,'HI.Descripcion'
					,'HI.Fecha'
					,'I.Serial'
					,'TI.Nombre as NombreTipoIncidencia'
					,'EI.Nombre as NombreEstado'
					,'TP.Nombre as NombrePrioridad'
					,'E.Nombre as NombreEquipo'
					,'EI.ColorHexa'
				],
				table : [
					"HeadIncidencia HI",
					[
						['TipoIncidencia TI', 'HI.TipoIncidenciaId = TI.TipoIncidenciaId', 'LEFT'],
						['EstadoIncidencia EI', 'HI.EstadoIncidenciaId = EI.EstadoIncidenciaId', 'LEFT'],
						['TipoPrioridadIncidencia TP', 'HI.TipoPrioridadIncidenciaId = TP.TipoPrioridadIncidenciaId', 'LEFT'],
						['ItemEquipo I', 'HI.ItemEquipoId = I.ItemEquipoId', 'LEFT'],
						['Equipo E', 'I.EquipoId = E.EquipoId', 'LEFT'],
						['Operacion OP', 'HI.OperacionId = OP.OperacionId', 'LEFT'],

					],[]
				],
				column_order : [
					'HI.HeadIncidenciaid'
					,'HI.Numero'
					,'HI.TipoIncidenciaId'
					,'HI.EstadoIncidenciaId'
					,'HI.TipoPrioridadIncidenciaId'
					,'HI.ItemEquipoId'
					,'OP.Operacion'
					,'HI.Ticket'
					,'HI.Asunto'
					,'HI.Descripcion'
					,'HI.Fecha'
					,'I.Serial'
					,'TI.Nombre as NombreTipoIncidencia'
					,'EI.Nombre as NombreEstado'
					,'TP.Nombre as NombrePrioridad'
					,'E.Nombre as NombreEquipo'
					,'EI.ColorHexa'
				],
				column_search : [
					'HI.HeadIncidenciaid'
					,'E.Nombre'
				],
				orden : {'HeadIncidenciaid': 'DESC'},
				columnas : [
					'HeadIncidenciaid'
					,'Numero'
					,'NombreEquipo'
					,'Serial'
					,'NombreTipoIncidencia'
					,'NombreEstado'
					,'NombrePrioridad'
					,'Asunto'
					,'Descripcion'
					,'Operacion'
					,'Fecha'
					,'ColorHexa'
				]
			},
			processing: true,
			serverSide: true,
			order: [[0, 'ASC']],
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
			scrollY: altura - 490,
			scroller: {
				loadingIndicator: true
			},
			scrollCollapse: false,
			dom: domBftri,
			columnDefs:[
				{visible: false, targets: [0]}
			],
			createdRow: function(row,data,dataIndex){
				$(row).css('cursor', 'pointer');
				$(row).find('td:eq(4)').css('background-color', data[11]);
				$(row).find('td:eq(9)').text(moment(data[10], "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A"));
				$(row).click(function(){
					ver(data[0]);
				});
			}
		}

	where = [];
	//where.push(["HI.UsuarioId", $USR]);

	if (filtro != "") {
		if (filtro['fechaInicio'] != "" && filtro['fechaFin'] != "") {
			where.push(["HI.Fecha BETWEEN '" + filtro['fechaInicio'] + "' AND '" + filtro['fechaFin'] + "'"]);
		}

		if (filtro['EstadoIncidenciaId'] != "") {
			where.push(['HI.EstadoIncidenciaId IN (' + filtro['EstadoIncidenciaId'] + ')']);
		}
	}

	config.data.table[2] = where;
	DT = dtSS(config);
}