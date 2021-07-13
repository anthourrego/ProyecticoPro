$supported_image = ['.gif', '.jpg', '.jpeg', '.png'];

var DT;
var alto = $(document).height();

$(function(){
    lista();
    bsCustomFileInput.init();

    $('.chosen-select').chosen({
        placeholder_text_single: ''
        ,width: '100%'
        ,no_results_text: 'Oops, no se encuentra'
        ,allow_single_deselected: true
    });


    $('#frmRegistrarPQR').on('submit', function(e){
		e.preventDefault();
	
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
			url: base_url() + 'Propietario/PQR/cPQR/crear',
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
                    DT.ajax.reload();
                    $("#frmRegistrarPQR")[0].reset();
                    $("#TipoPQR").val("0").trigger("chosen:updated");
					try {
						respuesta = JSON.parse(respuesta);
						var html = '';
						if(respuesta[2] == '[]'){
							alertify.alert(`
							<div class="navbar-brand border-0 text-center">
								<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
							</div>`, 
							`<div class="item active text-center">
								<span>PQR enviada satisfactoriamente</span>
								<h3>N° PQR</h3>
								<div class="alert alert-secondary text-center display-4 font-weight-normal">
									${respuesta[1]}
								</div>
							</div>`, 
							function() {
                                
							});
						}else{
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
											<span>PQR enviada satisfactoriamente</span>
											<h3>N° PQR</h3>
											<div class="alert alert-secondary text-center display-4 font-weight-normal">
												${respuesta[1]}
											</div>
										</div>`;

								alertify.alert(`
									<div class="navbar-brand border-0 text-center">
										<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
									</div>`,
									html, function(){
										
									}
								);
							} else {
								alertify.alert(`
									<div class="navbar-brand border-0 text-center">
										<img src="${base_url()}uploads/${NIT()}/InformacionEmpresa/logo_cliente.png" class="w-25">
									</div>`, 
									`<div class="item active text-center">
										<span>PQR enviada satisfactoriamente</span>
										<h3>N° PQR</h3>
										<div class="alert alert-secondary text-center display-4 font-weight-normal">
											${respuesta[1]}
										</div>
									</div>`, function() {
									
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
	
	if($idPQR != ''){
		verPQR($idPQR);
	}

	$("#btnLimpiarFiltro").on("click", function(){
		$("#fFechaInicio, #fFechaFin").val("");
		$("#tipoPQR").val("").trigger("chosen:updated");
	});

	$("#btnFiltrar").on("click", function(){
		filtro = [];
		filtro["fechaInicio"] = "";
		filtro["fechaFin"] = "";
		filtro["tipoPQR"] = "";

		fechaInicio = $("#fFechaInicio").val();
		fechaFin = $("#fFechaFin").val();
		tipoPQR = $("#tipoPQR").val();
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

		if (tipoPQR.length > 0) {
			filtro.push(tipoPQR.toString());
			filtro["tipoPQR"] = tipoPQR.toString();
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

    
});

function verPQR(id){
    $.ajax({
        url: base_url() + 'Propietario/PQR/cPQR/ver',
        type:'POST',
        dataType: 'json',
        async: false,
        data: {
            id
        },
        success:function(respuesta) {
            $("#frmVerPQR [name='TipoPQR']").val(respuesta['informacion'].Clasificacion);
            $("#frmVerPQR [name='Estado']").val(respuesta['informacion'].Estado);
            $("#frmVerPQR [name='FechaCreacion']").val(respuesta['informacion'].Fecha);
            $("#frmVerPQR [name='FechaCierre']").val(respuesta['informacion'].FechaCierre);
            $("#frmVerPQR [name='Asunto']").val(respuesta['informacion'].Asunto);
            $("#frmVerPQR [name='Descripcion']").val(respuesta['informacion'].Descripcion);

            $("#historialPQR").empty();
            $("#tablaNotas").empty();

            if (respuesta['notas'].length > 0) {
                for (let i = 0; i < respuesta['notas'].length; i++) {
                    if (respuesta['notas'][i].Adjuntos != null) {
                        $adjuntos = '';
    
                        for (let j = 0; j < respuesta['notas'][i].Adjuntos.length; j++) {
                            ext = respuesta['notas'][i].Adjuntos[j].Archivo.substring(respuesta['notas'][i].Adjuntos[j].Archivo.lastIndexOf("."));
    
                            if ($supported_image.includes(ext)) {     
                                $adjuntos = $adjuntos + '<div class="div-hidden"><a download="' + respuesta['notas'][i].Adjuntos[j].Archivo  + '" href="' + base_url() + '/uploads/' + NIT() + '/pqr/' + respuesta['notas'][i].Adjuntos[j].Archivo  + '"><i class="fas fa-image"></i> ' + respuesta['notas'][i].Adjuntos[j].Archivo + '</a> <a href="#" class="btn-hidden span-hidden" title="Ver imagen"><span class="fas fa-arrow-alt-circle-up"></span></a><div data-ocultar><a href="' + base_url() + '/uploads/' + NIT() +'/pqr/' + respuesta['notas'][i].Adjuntos[j].Archivo + '" target="_blank" class="img-pqr"><img class="w-25" src="' + base_url() + '/uploads/' + NIT() + '/pqr/' + respuesta['notas'][i].Adjuntos[j].Archivo + '"/></a></div></div>';
                            } else {
                                $adjuntos = $adjuntos + '<a download="' + respuesta['notas'][i].Adjuntos[j].Archivo + '" href="' + base_url() + '/uploads/' + NIT() + '/pqr/' + respuesta['notas'][i].Adjuntos[j].Archivo + '"><i class="fas fa-file"></i> ' + respuesta['notas'][i].Adjuntos[j].Archivo + '</a><br/>';
                            }
                        }
                        respuesta['notas'][i].DetalleP = respuesta['notas'][i].DetalleP  + '<br/>' + $adjuntos;
    
                    }
                    $("#tablaNotas").append(`
                        <tr>
                            <td class='col-4 px-3'>
                                <p>
                                    <i class='fas fa-user'></i><strong> ${respuesta['notas'][i].nombre}</strong>
                                </p>
                                <p>
                                    <i class='far fa-clock'></i> ${respuesta['notas'][i].FechaRegis}
                                </p>
                                ${respuesta['notas'][i].Dependencia == null ? '' : "<span class='badge badge-secondary'>" + respuesta['notas'][i].Dependencia + "</span>"}
                                ${respuesta['notas'][i].Origen == 'C' ? "<span class='badge badge-secondary'>Cliente</span>" : ""}
                            </td>
                            <td class='col-8 px-3'>
                                ${respuesta['notas'][i].DetalleP}
                            </td>
                        </tr>
                        <tr class='spacer'>
                            <td colspan='2'></td>
                        </tr>
                    `);
                }
            } else {
                $("#tablaNotas").html("<div class='text-center'>No se hay notas disponibles.</div>");
            }

            $("#historialPQR").append(`
                <tr>
                    <td>${respuesta['informacion'].Fecha}</td>
                    <td>${respuesta['informacion'].Usuario}</td>
                    <td>Nueva PQR</td>
                </tr>
            `);

            for (let i = 0; i < respuesta['notas'].length; i++) {
                cambio = '';
                if (i == 0) {
                    cambio = "Cambio estado Abierto => " + respuesta['notas'][i].Estado ;
                } else {
                    if (respuesta['notas'][i-1].Estado != respuesta['notas'][i].Estado) {
                        cambio = "Cambio estado " + respuesta['notas'][i-1].Estado + " => " + respuesta['notas'][i].Estado;
                    }
                }
                $("#historialPQR").append(`
                    <tr>
                        <td>${respuesta['notas'][i].Fecha}</td>
                        <td>${respuesta['notas'][i].nombre}</td>
                        <td>${cambio}</td>
                    </tr>
                `);
            }

            $("#verPQR").modal("show");
        }
    });

}

function lista(filtro = ""){
	var config = {
		data:{
			tblID : "#tblCRUD",
			select: [
				"HP.PQRId"
				,"HP.Pqr"
				,"EP.Nombre AS Estado"
				,"TP.Nombre AS Clasificacion"
				,"HP.Asunto"
				,"HP.Descripcion"
				,"HP.Fecha"
				,"HP.FechaCierre"
			],
			table : [
				"HeadPQR HP",
				[
					['EstadoPQR EP', 'HP.EstadoId = EP.EstadoId', 'LEFT'],
					['TipoPQR TP', 'HP.TipoPQRId = TP.TipoPQRId', 'LEFT']
				],[
					
				]
			],
			column_order : [
				'PQRId'
				,'Pqr'
				,'Estado'
				,'Clasificacion'
				,'Asunto'
				,'Descripcion'
				,'Fecha'
				,'FechaCierre'
			],
			column_search : [
				'HP.Pqr'
				,'HP.Asunto'
			],
			orden : {'PQRid': 'DESC'},
			columnas : [
				'PQRId'
				,'Pqr'
				,'Estado'
				,'Clasificacion'
				,'Asunto'
				,'Descripcion'
				,'Fecha'
				,'FechaCierre'
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
		scrollY: alto - 505,
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
			$(row).click(function(){
				verPQR(data[0]);
				//var url = base_url() + 'Administrativo/PQR/TramitarPQR/ConsultarPQR/' + data[1];
				//location.href = url;
			});
			//$(row).find('td:eq(7)').addClass("text-center").html(`<button type="button" class="btn btn-sm btn-info" onClick="" title="Ver PQR"><i class='fas fa-eye'></i></button>`);
		}
	}

	where = [];
	where.push(["HP.UsuarioId", $USR]);

	if (filtro != "") {
		if (filtro['fechaInicio'] != "" && filtro['fechaFin'] != "") {
			where.push(["HP.Fecha BETWEEN '" + filtro['fechaInicio'] + "' AND '" + filtro['fechaFin'] + "'"]);
		}

		if (filtro['tipoPQR'] != "") {
			where.push(['HP.TipoPQRId IN (' + filtro['tipoPQR'] + ')']);
		}
	}

	config.data.table[2] = where;
	DT = dtSS(config);
}