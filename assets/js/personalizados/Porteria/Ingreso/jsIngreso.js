dataAjax = {
	residente : '',
	vivienda  : ''
},
$GID = null,
$GetMapa = 0,
$TipoRes = null,
$ProgIng = null,
$IniMapa = 0;

var dtProgramado = $('#tblProgramado').DataTable({
	language,
	dom: domftrip,
	processing: true,
	pageLength: 5,
	ajax: {
		url: 'cIngreso/qProgramado',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Acciones'},
		{data: 'ProgIngresoId', visible:false},
		{data: 'Cedula'},
		{data: 'Nombre'},
		{data: 'Placa'},
		{data: 'Estado'},
		{data: 'Observacion'},
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html(`
			<center>
				<div class="btn-group btn-group-xs">
					<button class="autorizar btn btn-success btn-xs" value="`+data.IngresoId+`" title="Confirmar ingreso" style="margin-bottom:3px"><span class="fas fa-clipboard-check"></span></button>
				</div>
			</center>
		`);
		
		$(row).on("click", '.btnSE', function(e){
			e.preventDefault();
		})
		$(row).on("click", '.autorizar', function(e){
			e.preventDefault();
			$GID = $(this).val();
			$(".dataResidente,.rowIngreso,.divObserV").removeClass('d-none');
			$(".rowData").addClass('d-none');
			$("#ccV").val(data.Cedula).attr("disabled",true);
			$("#nomV").val(data.Nombre).attr("disabled",true);
			$("#obserV").val(data.Observacion).attr("disabled",true);
			setTimeout(function(){ $("#acomV").focus() },0)
		})
	}
});

var dtHistorico = $('#tblHistorico').DataTable({
	language,
	dom: domftrip,
	processing: true,
	pageLength: 5,
	ajax: {
		url: 'cIngreso/qHistorico',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Acciones'},
		{data: 'ProgIngresoId', visible:false},
		{data: 'Cedula'},
		{data: 'Nombre'},
		{data: 'Estado'},
		{data: 'Observacion'},
	],
	createdRow: function(row, data, dataIndex){
		switch (data.Estado) {
			case 'Ingreso':
				$(row).find('td:eq(3)').html(`
					<center>
						<div class="btn-group btn-group-xs">
							<button class="btn btn-primary btn-xs btnSE" style="margin-bottom:3px"><span>Ingresó</span></button>
						</div>
					</center>
				`);
				break;
			case 'Finalizado':
				$(row).find('td:eq(3)').html(`
					<center>
						<div class="btn-group btn-group-xs">
							<button class="btn btn-dark btn-xs btnSE" style="margin-bottom:3px"><span>Finalizado</span></button>
						</div>
					</center>
				`);
				break;
			default:
				break;
		}

		$(row).on("click", '.btnSE', function(e){
			e.preventDefault();
		})
		$(row).on("click", '.autorizar', function(e){
			e.preventDefault();
			$GID = $(this).val();
			$(".dataResidente,.rowIngreso,.divObserV").removeClass('d-none');
			$(".rowData").addClass('d-none');
			$("#ccV").val(data.Cedula).attr("disabled",true);
			$("#nomV").val(data.Nombre).attr("disabled",true);
			$("#obserV").val(data.Observacion).attr("disabled",true);
			setTimeout(function(){ $("#acomV").focus() },0)
		})
	}
});

$(document).ready(function(){
	obtenerZonas();
})

$('.chosen').chosen({
	placeholder_text_single: 'Seleccione:'
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){
	if ($(this).val() != '') {
		if ($(this).attr('id') == 'chVivienda') {
			obtenerTercero($(this).val(),$(this).attr('data-tipo'),$(this).find("option:selected").attr('data-citofono'),$(this).find("option:selected").attr('data-cod'),$(this).val(),$(this).val(),'Vivienda');
		}else{
			obtenerTercero($(this).val(),$(this).attr('data-tipo'),$(this).find("option:selected").attr('data-citofono'),$(this).find("option:selected").attr('data-cod'),$(this).find("option:selected").attr('data-tercero'),$(this).find("option:selected").attr('data-vivienda'),'Residente')
		}
	}
});

$('.numerico').inputmask({
	alias 		: 'integer',
	rightAlign 	: false
});

$("#btnNom").on("click",function(e){
	e.preventDefault();
	$("#chVivienda").val([]).trigger("chosen:updated");
	$("#txtPlaca").val("");
	$(".divCA,.divPlaca,.rowMapa").addClass('d-none');
	$(".divNom").toggleClass('d-none');
	$("[data-toggle=tooltip]").tooltip('hide');
	setTimeout(function(){$("#chResidente").trigger("chosen:open")},0);
});

$("#btnCA").on("click",function(e){
	e.preventDefault();
	$("#chResidente").val([]).trigger("chosen:updated");
	$("#txtPlaca").val("");
	$(".divNom,.divPlaca,.rowMapa").addClass('d-none');
	$(".divCA").toggleClass('d-none');
	$("[data-toggle=tooltip]").tooltip('hide');
	setTimeout(function(){$("#chVivienda").trigger("chosen:open")},0);
});

$("#btnPlaca").on("click",function(e){
	e.preventDefault();
	$("#btnLimpiar").click();
	$("#chVivienda,#chResidente").val([]).trigger("chosen:updated");
	$(".divCA,.divNom,.rowMapa").addClass('d-none');
	$(".divPlaca").toggleClass('d-none');
	setTimeout(function(){ $("#txtPlaca").focus() })
});

$("#btnMapa").on("click",function(e){
	e.preventDefault();
	$("#btnLimpiar").click();
	$(".divCA,.divNom,.divPlaca").addClass('d-none');
	$(".rowMapa").toggleClass('d-none');
	$("[data-toggle=tooltip]").tooltip('show');
})

$("#ccV").off("change").on("change",function(){
	if ($(this).val() != '') {
		$.ajax({ 
			url: base_url() + "Porteria/Ingreso/cIngreso/obtenerData",
			type: 'POST',
			async: false,
			data: {
				Id 	: $(this).val(),
				Id2 : dataAjax.residente 
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				if (respuesta == 2) {
					alertify.alert("Atención","El documento que desea ingresar, ya se encuentra con registro en el sistema el día de hoy y se debe de gestionar su salida para volver a registrar el ingreso.",function(){
						$("#ccV").val("");
						setTimeout(function(){$("#ccV").focus()},1050)
					});
					return;
				}
				if (respuesta.length > 0) {
					$("#nomV").val(respuesta[0].nombre).prop("disabled",true);
					$("#placaV").val(respuesta[0].placa).prop("disabled",true);
					$("#chTipoVehi").val(respuesta[0].tipovehiculoid).prop("disabled",true).trigger("chosen:updated");
					if (respuesta[0].email != null) {
						$("#mailV").val(respuesta[0].email).prop("disabled",true);
					}
					if (respuesta[0].tipo == 'A') {
						$ProgIng = respuesta[0].ProgIngresoId;
						$TipoRes = respuesta[0].tipo;
						if (respuesta[0].Foto != null) {
							$(".foto-usuario").css('background-image', ("url('"+base_url()+respuesta[0].Foto+"')"));
						}
					}
					setTimeout(function(){ $("#acomV").focus() })
				}
			}
		});
	}
});

$("#txtPlaca").off("change").on("change",function(){
	if ($(this).val() != '') {
		verificaPlaca($(this).val());
	}
})

$("#btnIngreso").on("click",function(e){
	e.preventDefault();
	if ($("#chVivienda").val() != null || $("#chResidente").val() != null || $IniMapa != 0) {
		$("#ccV,#nomV,#obserV,#acomV,#mailV,#obserI").val("").attr("disabled",false);
		$(".divObserV,.rowData").addClass('d-none')
		$(".dataResidente,.rowIngreso").removeClass('d-none');
		setTimeout(function(){$("#ccV").focus()})
	}else{
		alertify.alert('Alerta de registro', 'Para ingresar un nuevo visitante debe de digitar el numero de (casa / apto) ó seleccionar el residente.');
		return;
	}
});

$("#btnCancelar").on("click",function(e){
	e.preventDefault();
	$("#ccV,#nomV,#obserV,#acomV,#mailV,#obserI, #placaV").val("").attr("disabled",false);
	$(".rowData").removeClass('d-none');
	$(".rowIngreso").addClass('d-none');
	$(".foto-usuario").css('background-image', "none");
	$("#chTipoVehi").val("").attr("disabled",false).trigger("chosen:updated");

});

$("#btnLimpiar").on("click",function(e){
	e.preventDefault();
	$("#chResidente,#chVivienda").val([]).trigger("chosen:updated");
	$(".divDP").empty();
	$(".dataResidente,.rowIngreso,.divIngresosProg,.divBtn").addClass('d-none');
});

$("#btnResidente").on("click",function(e){
	e.preventDefault();
	if ($("#chVivienda").val() != null || $("#chResidente").val() != null) {
		if ($("#chVivienda").val() != null) {
			var terceros = obtenerTerceroVivienda($("#chVivienda").val());
			if (terceros.length > 0) {
				$("#mResidente").modal('show');

				$("#mResidente").off('shown.bs.modal').on('shown.bs.modal', function(){
					$(".rowDataTer").empty();
					for (var i = 0; i < terceros.length; i++) {
						$(".rowDataTer").append(`
							<div class="col-10 mb-2" title="`+terceros[i].nombre+`">
								<input type="" name="" class="form-control" readonly value="`+terceros[i].nombre+`">
							</div>
							<div class="col-2" title="seleccionar tercero">
								<button type="button" class="btn btn-block btn-primary f-r btnSelect" id="btnSelect" data-nombre="`+terceros[i].nombre+`" value="`+terceros[i].ViviendaTerceroId+`"><i class="fas fa-check-circle"></i></button>
							</div>`
						);
					}
					$(document).on("click",'.btnSelect',function(e){
						e.preventDefault();
						$.ajax({ 
							url: base_url() + "Porteria/Ingreso/cIngreso/guardarIngresoResidente",
							type: 'POST',
							data : {
								Tipo 	: 'Vivienda',
								Id 		: $(this).val(),
								RASTREO : RASTREO("Ingresa residente [Nombre: "+$(this).attr("data-nombre")+"] [ViviendaId : "+$(this).val()+"]","Ingresos/Porteria")
							},
							async: false,
							success: function(respuesta){
								respuesta = JSON.parse(respuesta);
								if (respuesta == 1) {
									alertify.alert('Atención',msgAlerta.successSimple,function(){
										$("#mResidente").modal('hide');
										dtHistorico.ajax.reload();
										$("#ccV, #nomV, #obserV, #acomV, #mailV, #obserI, #placaV").val("").attr("disabled",false);
										$("#chTipoVehi").val("").attr("disabled",false).trigger("chosen:updated");
										$(".divObserV, .rowData, .divIngresosProg, .divBtn").addClass('d-none')
										$("#chResidente, #chVivienda").val("").trigger("chosen:updated");
										setTimeout(function(){$("#ccV").focus()},1100)
									});
									return;
								}else{

								}
							}
						});
					})
				});
				$("#mResidente").on('hidden.bs.modal', function(){
					$(this).unbind();
				})
			}
		}
		if ($("#chResidente").val() != null) {
			$.ajax({ 
				url: base_url() + "Porteria/Ingreso/cIngreso/guardarIngresoResidente",
				type: 'POST',
				data : {
					Tipo 	: 'Residente',
					Id 		: $("#chResidente").find("option:selected").attr('data-vivienda'),
					RASTREO : RASTREO("Ingresa residente [Nombre: "+$("#chResidente").find("option:selected").text()+"] [ViviendaId : "+dataAjax.vivienda+"]","Ingresos/Porteria")
				},
				async: false,
				success: function(respuesta){
					respuesta = JSON.parse(respuesta);
					if (respuesta == 1) {
						alertify.alert('Atención',msgAlerta.successSimple,function(){
							dtHistorico.ajax.reload();
							$("#ccV, #nomV, #obserV, #acomV, #mailV, #obserI, #placaV").val("").attr("disabled",false);
							$("#chTipoVehi").val("").attr("disabled",false).trigger("chosen:updated");
							$(".divObserV, .rowData, .divIngresosProg, .divBtn").addClass('d-none')
							$("#chResidente").val("").trigger("chosen:updated");
							setTimeout(function(){$("#ccV").focus()},1100)
						});
						return;
					}else{

					}
				}
			});
		}
	}else{

	}
})

$("#placaV").off("change").on("change",function(){
	if ($(this).val() != '') {
		verificaPlaca($(this).val(),'Ingreso')
	}
})

$(document).on("click",'.btnZonaMapa',function(e){
	if ($(this).hasClass('ultimo')) {
		$gID = null;
		$(this).removeClass('ultimo');
		$(this).removeClass('btn-secondary').addClass('btn-light');
		borrarPlano();
	}else{
		$gID = parseInt($(this).attr('data-id'));
		$(".btnZonaMapa").removeClass('ultimo');
		$(".btnZonaMapa").removeClass('btn-secondary').addClass('btn-light');
		$(this).addClass('ultimo');
		$(this).removeClass('btn-light').addClass('btn-secondary');
		obtenerDataZona()
	}
})

$("#btnGuardar").on("click",function(e){
	e.preventDefault();
	var exep = 0;
	$(".valida").filter(':visible').each(function(){
		if ($(this).val() == '') {
			alertify.alert("Advertencia","Debe de diligenciar todos los campos obligatorios (*)");
			exep = 1;
			return;
		}
	});
	if (exep == 0) {
		var cod 	= ($("#chVivienda").val() != '' && $("#chVivienda").val() != null) ? $("#chVivienda").find("option:selected").attr('data-cod') : $("#chResidente").find("option:selected").attr('data-cod') ;
		var rastreo = "Registra ingreso de visitante [Vivienda : "+cod+"] [CC : "+$("#ccV").val()+"] [Nombre : "+$("#nomV").val()+"] [Acomp : "+$("#acomV").val()+"]";

		$data = {
			Cedula 			: $("#ccV").val(),
			Nombre 			: $("#nomV").val(),
			Acomp 			: $("#acomV").val() != '' ? $("#acomV").val() : null,
			Email 			: $("#mailV").val() != '' ? $("#mailV").val() : null,
			Observacion  	: $("#obserV").val() != '' ?  $("#obserV").val() : null,
			ObservacionI 	: $("#obserI").val() != '' ? $("#obserI").val() : null,
			Placa 			: $("#placaV").val() != '' ? $("#placaV").val() : null,
			TipoVehiculoId	: $("#chTipoVehi").val() != null ? $("#chTipoVehi").val() : null,
			Estado 			: 'I'
		}

		$data2 = {
			ProgIngresoId : $ProgIng,
			Acomp 		: $("#acomV").val(),
			Observacion : $("#obserI").val(),
			Estado 		: 'I'
		}

		$.ajax({ 
			url: base_url() + "Porteria/Ingreso/cIngreso/guardarIngreso",
			type: 'POST',
			async: false,
			data: {
				Id 		: dataAjax,
				Gid 	: $GID,
				Data 	: ($ProgIng != null ? $data2 : $data),
				Tipo  	: ($TipoRes != null ? $TipoRes : 'I'),
				Email 	: $("#mailV").val(),
				RASTREO : RASTREO(rastreo,"Ingresos/Porteria")
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				switch (respuesta) {
					case 0:
						alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
						break;
					case 1:
						alertify.alert('Atención','<div class="alert alert-success" role="alert" style="font-size: 15px;"><strong>Confirmación </strong> - Registro guardado exitosamente.</div>',function(){
							dtHistorico.ajax.reload();
							$("#ccV, #nomV, #obserV, #acomV, #mailV, #obserI, #placaV").val("").attr("disabled",false);
							$("#chTipoVehi").val("").attr("disabled",false).trigger("chosen:updated");
							$(".divObserV,.rowData").addClass('d-none')
							setTimeout(function(){$("#ccV").focus()},1100)
						});
						break;
					default:
						break;
				}
			}
		});
	}
});

$(document).on("click",'.localizacion',function(){
	$GetMapa = 1;
	$IniMapa = 1;
	$("[data-toggle=tooltip]").tooltip('update');
	obtenerTercero($(this).attr("data-id"),'Vivienda',$(this).attr("data-citof"),$(this).attr("data-cod"),$(this).attr("data-id"),$(this).attr("data-id"))
})

function obtenerTercero(id,tipo,citof,codigo,tercero,idvivienda,tipo2){
	$.ajax({ 
		url: base_url() + "Porteria/Ingreso/cIngreso/obtenerTercero",
		type: 'POST',
		async: false,
		data: {
			Id 	 : id,
			Tipo : tipo,
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			switch (respuesta) {
				case 0:
					alertify.alert("Error",'<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
					break;
				case 1:
					alertify.alert("Atención","La vivienda seleccionada actualmente no tiene residentes asociados y/o no esta habitada.",function(){
						$("#btnLimpiar").click();
						if ($GetMapa == 1) {
							$GetMapa = 0;
							$("[data-toggle=tooltip]").tooltip('show');
						}
					});
					break;
				default:
					if (respuesta.length > 0) {
						dtHistorico.clear().draw();
						$(".divDP").empty();

						var citofono 	= citof;
						var cod 		= codigo;
						var terceroId 	= obtenerNumDocu(tercero);
						var viviendaId	= idvivienda;
						
						dataAjax.residente 	= terceroId;
						dataAjax.vivienda 	= viviendaId;
						dtHistorico.ajax.reload();
						dtProgramado.ajax.reload();

						var viewI = `<div class="col-12 mb-1">
							<div class="alert alert-secondary" role="alert">
								<h4 class="infoTel hCenter">Citofono : `+citofono+`</h4>
								<hr>
								<h5 class="infoDir hCenter">`+cod+`</h5>
							</div>
						</div>`;
						$(".divDP").append(viewI);
						var cont = 0;
						$.each(respuesta,function(){
							var viewD = `<div class="col-12">
								<ul class="list-unstyled shadow p-2">
									<li class="media">
										<div class="mr-3 col-12 col-md-3 col-xl-3 foto foto`+cont+`"></div>
										<div class="media-body">
											<h5 class="mt0-0 mb-1">`+this.nombre+`</h5>
											<p class="mb-0"><strong>Telefono : </strong> `+this.telefono+`</p>
											<p class="mb-0"><strong>Celular : </strong> `+this.celular+`</p>
											<p class="mb-0"><strong>Tipo : </strong> `+this.Tipo+`</p>
										</div>
									</li>
								</ul>
							</div>`;
							$(".divDP").append(viewD);
							if(this.foto !== "" && this.foto !== null){
								$('.foto'+cont).css('background-image', ("url(data:image/jpeg;base64," + this.foto +")"));
							}
							cont ++;
						});
						if ($GetMapa == 1) {
							$("[data-toggle=tooltip]").tooltip('hide');
							$(".rowMapa").toggleClass('d-none');
						}
						$("#btnIngreso, #btnLimpiar, #btnResidente, .dataResidente, .rowData, .divIngresosProg, .divBtn").removeClass('d-none');
					}
					break;
			}
		}
	});
}

function obtenerNumDocu(id){
	var resp = [];
	$.ajax({ 
		url: base_url() + "Porteria/Ingreso/cIngreso/obtenerNumDocu",
		type: 'POST',
		async: false,
		data: {
			Id 	: id,
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta == 0) {
				alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
				return;
			}else{
				$.each(respuesta,function(){
					resp.push(this.TerceroID);
				})
			}
		}
	});
	return resp;
}

function obtenerZonas(){
	$.ajax({ 
		url: base_url() + "Porteria/Ingreso/cIngreso/obtenerZonas",
		type: 'POST',
		async: false,
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (respuesta.length > 0) {
					$(".rowZonas").empty();
					$.each(respuesta,function(){
						var btnHtml = `
						<div class="col-12 mt-3 p-0">
							<div class="row">
								<div class="col-12">
									<button class="btn btn-light border shadow-sm col-12 btnZonaMapa" data-id="`+this.id+`">`+this.nombre+`</button>
								</div>
							</div>
						</div>`;
						$(".rowZonas").append(btnHtml);
					});
				}
			} catch(e) {
				alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
				console.log(e);
			}
		}
	});
}

function obtenerDataZona(tipo=null){
	$.ajax({ 
		url: base_url() + "Porteria/Ingreso/cIngreso/obtenerDataZona",
		type: 'POST',
		data : {
			Id : $gID,
		},
		async: false,
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (tipo == null) {
					$(".rowVivienda").empty();
					$('.fotoPlano').css('background-image', "none");

					if (respuesta.Head.length > 0) {
						if (respuesta.Head[0].Imagen != null)
							$('.fotoPlano').css('background-image', ("url('"+base_url()+respuesta.Head[0].Imagen+"')"));
					}
				}
				if (tipo == null || tipo == 1) {
					if (respuesta.Zona.length > 0) {
						$("[data-toggle=tooltip]").tooltip('hide')
						$(".rowVivienda").empty();
						$('.divLocaliza').empty();
						$.each(respuesta.Zona, function(){
							spl = this.Posicion.split("-");
							$('.divLocaliza').append('<div data-pos="'+this.Posicion+'" data-citof="'+this.Citofono+'" data-cod="'+this.nombre+'" data-id="'+this.ViviendaId+'" data-toggle="tooltip" data-placement="top" title="" class="localizacion" id="btnMp" style="position:absolute;left:'+spl[0]+'px;top:'+spl[1]+'px"><i class="fas fa-map-marker-alt localiza" ></i></div>')
							$("[data-pos="+this.Posicion+"]").attr('title',this.Nomenclatura);
						})
						$('[data-toggle="tooltip"]').tooltip();
						$("[data-toggle=tooltip]").tooltip('show');
					}
				}
			} catch(e) {
				alertify.alert('Atención',msgAlerta.errorAdmin);
				console.log(e);
			}
		}
	});
}

function verificaPlaca(placa,tipo=null){
	$.ajax({
		url: base_url() + "Porteria/Ingreso/cIngreso/verificaPlaca",
		type: 'POST',
		async: false,
		data: {
			Placa : placa,
			Tipo  : tipo
		},
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (tipo != null) {
					if (respuesta == 1) {
						alertify.alert("Atención","La placa que se digitó, ya tiene registrado el ingreso y falta dar gestión a su salida del conjunto residencial.",function(){
							$("#placaV").val("");
							setTimeout(function(){$("#placaV").focus();},1050)
						});
					}
					if (respuesta == 2) {
						alertify.alert("Atención","La placa que se digitó, pertenece a un residente del conjunto, esta se debe ingresar por el botón de [Placa(Color : Amarillo)]",function(){
							$("#placaV").val("");
							setTimeout(function(){$("#placaV").focus();},1050)
						});
					}
				}else{
					if (respuesta == 1) {
						alertify.alert("Atención","La placa que se digitó, ya tiene registrado el ingreso y falta dar gestión a su salida del conjunto residencial.",function(){
							setTimeout(function(){$("#txtPlaca").val("").focus();},1005)
						});
						return;
					}
					if (respuesta.ceroRecord == 1) {
						alertify.alert("Atención","La placa digitada no coincide con ningún vehiculo visitante autorizado y/o programado.",function(){
							$("#txtPlaca").val("");
							setTimeout(function(){$("#txtPlaca").focus()},0)
							return;
						});
					}
					if (respuesta.autorizado == 1) {
						alertify.alert("Atención"
							,`	<div class="alert alert-success" role="alert" style="font-size: 15px;">
									<h5>
										<strong>Confirmación : </strong>Ingreso guardado exitosamente. <br><br>
										<strong>`+respuesta.dataAut[0].tipo+` : </strong>`+respuesta.dataAut[0].nombreRes+`. <br>
										<strong>`+respuesta.dataAut[0].nomTipoV+` : </strong>`+respuesta.dataAut[0].Nomenclatura+`. <br>
										<strong>Tipo de vehículo : </strong>`+respuesta.dataAut[0].nombreRes+`. <br>
									</h3>
								</div>`
						,function(){
							var rastreo = "Registra ingreso ["+respuesta.dataAut[0].tipo+" : "+respuesta.dataAut[0].nombreRes+"] ["+respuesta.dataAut[0].nomTipoV+" : "+respuesta.dataAut[0].Nomenclatura+"]";
							$.ajax({ 
								url: base_url() + "Porteria/Ingreso/cIngreso/guardarIngreso",
								type: 'POST',
								async: false,
								data: {
									Tipo 	: 'R',
									Id 		: respuesta.dataAut[0].TerceroVehiculoId,
									RASTREO : RASTREO(rastreo,"Ingresos/Porteria")
								},
								success: function(respuesta){
									respuesta = JSON.parse(respuesta);
									if (respuesta == 0) {
										alertify.alert("Atención",msgAlerta.errorAdmin);
										return;
									}
								}
							});
							$("#txtPlaca").val("");
							setTimeout(function(){$("#txtPlaca").focus()})
						});
					}
					if (respuesta.programado == 1) {
						$("#mIngreso").modal('show');

						$("#mIngreso").unbind().on('shown.bs.modal', function(){
							var idProg = respuesta.dataProg[0].ProgIngresoId;
							$("#frmCRUD").find(".form-control").each(function(){
								$(this).val("");
							})
							$("#txtCasa").val(respuesta.dataProg[0].casa);
							$("#ccVP").val(respuesta.dataProg[0].Cedula);
							$("#tipoVehiVP").val(respuesta.dataProg[0].tipo)
							$("#placaVP").val(respuesta.dataProg[0].Placa);
							$("#nomVP").val(respuesta.dataProg[0].nomVis);
							$("#obserVP").val(respuesta.dataProg[0].Observacion);
							if (respuesta.dataProg[0].Email != null) {
								$("#mailVP").val(respuesta.dataProg[0].Email);
							}
							if (respuesta.dataProg[0].Foto != null) {
								$('.fotoIngreso').css('background-image', ("url('"+base_url()+respuesta.dataProg[0].Foto+"')"));
							}
							setTimeout(function(){$("#acomVP").focus()},0)

							$("#frmCRUD").unbind().on("submit",function(e){
								e.preventDefault();
								var datos = {
									ProgIngresoId : idProg,
									Acomp 		: $("#acomVP").val(),
									Observacion : $("#obserIP").val(),
									Estado 		: 'I'
								}
								var rastreo = "Registra ingreso autorizado [Visitante : "+respuesta.dataProg[0].nombreRes+"] ["+respuesta.dataProg[0].nomTipoV+" : "+respuesta.dataProg[0].Nomenclatura+"]";
								
								$.ajax({ 
									url: base_url() + "Porteria/Ingreso/cIngreso/guardarIngreso",
									type: 'POST',
									async: false,
									data: {
										Data 	: datos,
										Email 	: $("#mailVP").val(),
										Tipo  	: 'A',
										RASTREO : RASTREO(rastreo,"Ingresos/Porteria")
									},
									success: function(respuesta){
										respuesta = JSON.parse(respuesta);
										if (respuesta == 0) {
											alertify.alert("Atención",msgAlerta.errorAdmin);
											return;
										}
										if (respuesta == 1) {
											alertify.alert("Atención",msgAlerta.successSimple,function(){
												$("#mIngreso").modal('hide');
											});
										}
									}
								});
							})

							$("#btnCerrar").on("click",function(e){
								e.preventDefault();
								$("#mIngreso").modal('hide');
							})
						})
						$("#mIngreso").on('hidden.bs.modal', function(){
							$("#txtPlaca").val("");
							setTimeout(function(){$("#txtPlaca").focus()},0)
						})
					}
				}
			} catch(e) {
				// statements
				console.log(e);
			}
		}
	});
}

function modalFoto(input){
    input = input.closest(".adicional").find(".foto-usuario");
    /*
        Tomar una fotografía y guardarla en un archivo v3
        @date 2018-10-22
        @author parzibyte
        @web parzibyte.me/blog
    */
	const tieneSoporteUserMedia = () =>
		!!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
	const _getUserMedia = (...arguments) =>
	    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
    
    // Declaramos elementos del DOM
	const $video 			= document.querySelector("#video"),
	$canvas 				= document.querySelector("#canvas"),
	$estado 				= document.querySelector("#estado"),
	$boton 					= document.querySelector("#btnFoto"),
	$listaDeDispositivos 	= document.querySelector("#listaDeDispositivos");

	const limpiarSelect = () => {
		for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
			$listaDeDispositivos.remove(x);
	};
	const obtenerDispositivos = () => navigator
	.mediaDevices
	.enumerateDevices();
    
    // La función que es llamada después de que ya se dieron los permisos
    // Lo que hace es llenar el select con los dispositivos obtenidos
	const llenarSelectConDispositivosDisponibles = () => {
    
		limpiarSelect();
		obtenerDispositivos()
		.then(dispositivos => {
			const dispositivosDeVideo = [];
			dispositivos.forEach(dispositivo => {
				const tipo = dispositivo.kind;
				if (tipo === "videoinput") {
					dispositivosDeVideo.push(dispositivo);
				}
			});

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
			if (dispositivosDeVideo.length > 0) {
                // Llenar el select
				dispositivosDeVideo.forEach(dispositivo => {
					const option = document.createElement('option');
					option.value = dispositivo.deviceId;
					option.text = dispositivo.label;
					$listaDeDispositivos.appendChild(option);
				});
			}
		});
	}
    
    (function() {
        // Comenzamos viendo si tiene soporte, si no, nos detenemos
        if (!tieneSoporteUserMedia()) {
            alert("Lo siento. Tu navegador no soporta esta característica");
            $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
            return;
        }
        //Aquí guardaremos el stream globalmente
        let stream;
    
    
        // Comenzamos pidiendo los dispositivos
        obtenerDispositivos()
            .then(dispositivos => {
                // Vamos a filtrarlos y guardar aquí los de vídeo
                const dispositivosDeVideo = [];
    
                // Recorrer y filtrar
                dispositivos.forEach(function(dispositivo) {
                    const tipo = dispositivo.kind;
                    if (tipo === "videoinput") {
                        dispositivosDeVideo.push(dispositivo);
                    }
                });
    
                // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
                // y le pasamos el id de dispositivo
                if (dispositivosDeVideo.length > 0) {
                    // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                    mostrarStream(dispositivosDeVideo[0].deviceId);
                }
            });
    
    
    
        const mostrarStream = idDeDispositivo => {
            _getUserMedia({
                    video: {
                        // Justo aquí indicamos cuál dispositivo usar
                        deviceId: idDeDispositivo,
                    }
                },
                (streamObtenido) => {
                    // Aquí ya tenemos permisos, ahora sí llenamos el select,
                    // pues si no, no nos daría el nombre de los dispositivos
                    llenarSelectConDispositivosDisponibles();
    
                    // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                    $listaDeDispositivos.onchange = () => {
                        // Detener el stream
                        if (stream) {
                            stream.getTracks().forEach(function(track) {
                                track.stop();
                            });
                        }
                        // Mostrar el nuevo stream con el dispositivo seleccionado
                        mostrarStream($listaDeDispositivos.value);
                    }
    
                    // Simple asignación
                    stream = streamObtenido;
    
                    // Mandamos el stream de la cámara al elemento de vídeo
                    $video.srcObject = stream;
                    $video.play();
    
                    //Escuchar el click del botón para tomar la foto
                    //Escuchar el click del botón para tomar la foto
                    $boton.addEventListener("click", function() {
    
                        //Pausar reproducción
                        $video.pause();
    
                        //Obtener contexto del canvas y dibujar sobre él
                        let contexto = $canvas.getContext("2d");
                        $canvas.width = $video.videoWidth;
                        $canvas.height = $video.videoHeight;
                        contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
    
                        let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
						input.attr('src', foto);
						input.data("cambio", "1");
                        //Reanudar reproducción
                        $video.play();
                    });
                }, (error) => {
                    console.log("Permiso denegado o error: ", error);
                    $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
                });
        }
    })();  
}

function reinicioVariables(){
	$GID = null,
	$GetMapa = 0,
	$TipoRes = null,
	$ProgIng = null,
	$IniMapa = 0;
}

function obtenerTerceroVivienda(id){
	var resp = [];
	$.ajax({ 
		url: base_url() + "Porteria/Ingreso/cIngreso/obtenerTerceroVivienda",
		type: 'POST',
		async: false,
		data: {
			Id 	: id,
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta.length > 0) {
				resp = respuesta
			}
		}
	});
	return resp;
}