var $gID = null,
$gFila = 0;

$(document).ready(function(){
	obtenerZonas();
})

$("input[type=file]").change(function(){
	//console.log('Hello');
	leerImg(this);
});

$("#pixeles").on("change",function(){
	$(".btnData").css("padding",""+$(this).val()+"");
	guardarConfiguracion('Pixel',$(this).val());
})

$("#columnas").on("change",function(){
	cont = ($(this).val() != '' && $(this).val() < 16) ? $(this).val() : 0; 
	var view = ""
	for (var i = 0; i < cont; i++) {
		for (var j = 0; j < 12; j++) {
			view += `<div class="col-1">
						<button class="btn btn-light btnData" data-pos="`+(i+1)+`-`+(j+1)+`">&nbsp;&nbsp;&nbsp;&nbsp;</button>
					</div>`;
		}
	}
	$gFila += cont;
	$(".rowBotonera").append(view);
	$("#pixeles").change();
	guardarConfiguracion('fila',$gFila);
	$(this).val('');
})

$("#btnVer").on("click",function(e){
	e.preventDefault();
	$(".divLocaliza").removeClass('divLocaliza').addClass('divLocaliza2');
})

$(document).on("click",'.btnEditaViviendaAsociada',function(e){
	e.preventDefault();
	$(".localizacion").tooltip('hide');
	var pos 	= $(this).attr('data-posi'),
	viviendaId 	= null,
	obtiene 	= 0;

	if ($("#btnVer").text() == "Editar")
		return;

	$("#myModal .modal-content").load('cMapa/modalData', function() {
		$("#myModal").modal('show');
	});
	
	$("#myModal").unbind().on('shown.bs.modal', function(){
		$('.chosen-select').chosen({
			placeholder_text_single: 'Seleccione:'
			,width: '100%'
			,no_results_text: 'Oops, no se encuentra'
			,allow_single_deselected: true
		}).on("change",function(){
			if ($(this).val() != '' && $(this).attr('id') == 'chTipoVivienda') {
				$(".dVi").val("");
				viviendaId = null;
				obtenerVivienda($(this).val());
			}
			if ($(this).val() != '' && $(this).attr('id') == 'chVivienda') {
				viviendaId = $(this).val();
				obtenerDataVivienda($(this).val());
			}
		});
		obtenerDataSeleccion();

		$("#btnGuardar").on("click",function(e){
			e.preventDefault();
			if ($("#chTipoVivienda").val() != '' && viviendaId != null) {
				$.ajax({ 
					url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/guardarPosicionMapa",
					type: 'POST',
					async: false,
					data: {
						Id 		: viviendaId,
						Id2 	: $gID,
						Pos 	: pos,
						RASTREO : RASTREO("Reserva posicion ["+pos+"] [Vivienda : "+$("#chVivienda").find("option:selected").text()+"]","Administrativo / Mapa")
					},
					success: function(respuesta){
						respuesta = JSON.parse(respuesta);
						if (respuesta == 1) {
							alertify.alert('Atención','<div class="alert alert-success" role="alert" style="font-size: 15px;"><strong>Confirmación </strong> - Datos guardados exitosamente.</div>',function(){
								$("[data-pos="+pos+"]").removeClass('btn-light btnData').addClass('btnClick');
								obtenerDataZona();
								$("#myModal").modal('hide');
							})
						}else{
							alertify.alert("Error","Comuniquese con el administrador del sistema.");
							return;
						}
					}
				});
			}else{
				alertify.alert("Atención","Debe diligenciar los campos obligatorios (*)");
				return;
			}
		})

		function obtenerVivienda(id){
			$.ajax({ 
				url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerVivienda",
				type: 'POST',
				async: false,
				data: {
					Id 	: id,
				},
				success: function(respuesta){
					respuesta = JSON.parse(respuesta);
					$("#chVivienda").empty().append('<option value="">&nbsp;</option>');
					if (respuesta.length > 0) {
						$.each(respuesta,function(){
							$("#chVivienda").append('<option value="'+this.id+'" data-nomen="'+this.codigo+'">'+this.codigo+'</option>');
						})
						$("#chVivienda").trigger("chosen:updated");
					}else{
						alertify.alert('Atención','El tipo de vivienda, no tiene viviendas asociadas.');
						return;
					}
				}
			});
		}
		function obtenerDataVivienda(id){
			$.ajax({ 
				url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerDataVivienda",
				type: 'POST',
				async: false,
				data: {
					Id 	: id,
					Obt	: obtiene,
				},
				success: function(respuesta){
					try {
						respuesta = JSON.parse(respuesta);
						
						if (respuesta == 1) {
							alertify.alert("Atención","La vivienda ya esta relacionada en el mapa de zonas.");
							$("#chVivienda").val("").trigger("chosen:updated");
							viviendaId = null;
							return;
						}

						if (obtiene == 0) {
							$("#chVivienda").empty().append('<option value="">&nbsp;</option>');
						}
						if (respuesta.length > 0) {
							$("[data-db=Nomenclatura]").val(respuesta[0].Nomenclatura);
							$("[data-db=Citofono]").val(respuesta[0].Citofono);
							$("[data-db=Terreno]").val(respuesta[0].Terreno);
							$("[data-db=Construido]").val(respuesta[0].Construido);
							$("[data-db=Pisos]").val(respuesta[0].Pisos);
							$("[data-db=VidaUtil]").val(respuesta[0].VidaUtil);
							$("[data-db=NumHabitacion]")	.val(respuesta[0].NumHabitacion	);
							$("[data-db=NumBano]").val(respuesta[0].NumBano);
							$("[data-db=NumVentana]").val(respuesta[0].NumVentana);
							$("[data-db=Matricula]").val(respuesta[0].Matricula);
							$("[data-db=CedulaCatastral]").val(respuesta[0].CedulaCatastral);
							$("[data-db=Valor]").val(respuesta[0].Valor);
							$("[data-db=Estado]") .val(respuesta[0].Estado);
						}else{
							alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
							return;
						}
					} catch(e) {
						alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
						console.log(e);
					}
				}
			});
		}
		function obtenerDataSeleccion(){
			$.ajax({ 
				url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerDataSeleccion",
				type: 'POST',
				async: false,
				data: {
					Id 	: $gID,
					Pos : pos
				},
				success: function(respuesta){
					try {
						respuesta = JSON.parse(respuesta);
						
						if (respuesta.length > 0) {
							obtiene = 1;
							$("#chTipoVivienda").val(respuesta[0].TipoViviendaId).change();
							$("#chVivienda").val(respuesta[0].ViviendaId).change();
							$(".chosen-select").trigger("chosen:updated");
							obtiene = 0;
						}
					} catch(e) {
						alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
						console.log(e);
					}
				}
			});
		}
	})
})

$(document).on("click",".btnEliminaViviendaAsociada",function(e){
	e.preventDefault();
	$(".localizacion").tooltip('hide');
	var self = this;
	alertify.confirm('Eliminar vivienda asociada', 'Está seguro de eliminar la vivienda asociada en el plano ?', function(){
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/eliminarVivienda",
			type: 'POST',
			async: false,
			data: {
				Id 		: $(self).attr('data-id'),
				RASTREO : RASTREO("Elimina asociación de vivienda [Id : "+$(self).attr('data-id')+"] [Zona : "+$('.ultimo').text()+"] [Vivienda : "+$("[data-pos="+$(self).attr('data-posi')+"]").attr('data-original-title')+"]","Mapa de zonas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					alertify.alert('Atención',msgAlerta.succesElimina,function(){
						console.log($("[data-pos="+$(self).attr('data-posi')+"]"));
						$("[data-pos="+$(self).attr('data-posi')+"]").remove();
						obtenerDataZona(1);
					});
				}else{
					alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
					return;
				}
			}
		});
	}, function() { $(".localizacion").tooltip('show'); }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
})

$("#btnZona").on("click",function(e){
	e.preventDefault();
	if ($("#nomZona").val() != '') {
		$.ajax({ 
			url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/guardarZona",
			type: 'POST',
			data : {
				Nombre 	: $("#nomZona").val(),
				RASTREO : RASTREO("Crea zona [Nombre : "+$("#nomZona").val()+"]","Mapa")
			},
			async: false,
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				if (respuesta != 0) {
					alertify.success("Datos guardados exitosamente.");
					$("#nomZona").val("");
					obtenerZonas();
				}else{
					alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
					return;
				}
			}
		});
	}else{
		alertify.alert("Atención","Para crear una zona es necesario diligenciar el nombre de esta.",function(){
			setTimeout(function(){ $("#nomZona").focus() },0);
		});
	}
});

$(document).on("click",'.btnZonaMapa',function(e){
	if ($(this).hasClass('ultimo')) {
		$(".localizacion").tooltip('hide');
		$gID = null;
		$(this).removeClass('ultimo');
		$(this).removeClass('btn-secondary').addClass('btn-light');
		$(".divLocaliza").removeClass('divLocaliza').addClass('divLocaliza2');
		borrarPlano();
	}else{
		$(".divLocaliza2").removeClass('divLocaliza2').addClass('divLocaliza');
		$gID = parseInt($(this).attr('data-id'));
		$(".btnZonaMapa").removeClass('ultimo');
		$(".btnZonaMapa").removeClass('btn-secondary').addClass('btn-light');
		$(this).addClass('ultimo');
		$(this).removeClass('btn-light').addClass('btn-secondary');
		obtenerDataZona()
	}
})

$(document).on("click",".btnEliminaZona",function(e){
	e.preventDefault();
	var id = $(this).attr('data-id');
	var zona = $("[data-id="+id+"]")[0].innerText;

	alertify.confirm('Eliminar zona', 'Está seguro de eliminar la zona ?', function(){
		$.ajax({
			url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/eliminarZona",
			type: 'POST',
			async: false,
			data: {
				Id 		: id,
				RASTREO : RASTREO("Elimina zona [Id : "+id+"] [Nombre : "+zona+"]","Mapa de zonas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					alertify.alert('Atención','<div class="alert alert-success" role="alert" style="font-size: 15px;"><strong>Confirmación </strong> - Registro eliminado exitosamente.</div>',function(){
						obtenerZonas();
						borrarPlano();
						setTimeout(function(){ $("#nomZona").focus() },0)
					});
				}else{
					alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
					return;
				}
			}
		});
	}, function() { }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
})

$(document).on("click",".divLocaliza",function(e){
	e.preventDefault();
	$(".localizacion").tooltip('hide');
	x 	= e.offsetX-14;
	y 	= e.offsetY-40;
	obtiene 	= 0;	
	pos = x+'-'+y;
	rg 	= 0;
	$(this).append('<div data-pos="'+x+'-'+y+'" data-toggle="tooltip" data-placement="top" title="" class="localizacion" id="btnMp" style="position:absolute;left:'+x+'px;top:'+y+'px"><i class="fas fa-map-marker-alt localiza" ></i></div>')
	
	$("#myModal .modal-content").load('cMapa/modalData', function() {
		$("#myModal").modal('show');
	});

	$("#myModal").unbind().on('shown.bs.modal', function(){
		$('.chosen-select').chosen({
			placeholder_text_single: 'Seleccione:'
			,width: '100%'
			,no_results_text: 'Oops, no se encuentra'
			,allow_single_deselected: true
		}).on("change",function(){
			if ($(this).val() != '' && $(this).attr('id') == 'chTipoVivienda') {
				$(".dVi").val("");
				viviendaId = null;
				obtenerVivienda($(this).val());
			}
			if ($(this).val() != '' && $(this).attr('id') == 'chVivienda') {
				viviendaId  = $(this).val();
				txtVivienda = $(this).find("option:selected").text();
				obtenerDataVivienda($(this).val());
			}
		});

		$("#btnGuardar").on("click",function(e){
			e.preventDefault();
			if ($("#chTipoVivienda").val() != '' && viviendaId != null) {
				$.ajax({ 
					url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/guardarPosicionMapa",
					type: 'POST',
					async: false,
					data: {
						Id 		: viviendaId,
						Id2 	: $gID,
						Pos 	: pos,
						RASTREO : RASTREO("Reserva posicion ["+pos+"] [Vivienda : "+$("#chVivienda").find("option:selected").text()+"]","Administrativo / Mapa")
					},
					success: function(respuesta){
						respuesta = JSON.parse(respuesta);
						if (respuesta == 1) {
							rg = 1;
							alertify.alert('Atención','<div class="alert alert-success" role="alert" style="font-size: 15px;"><strong>Confirmación </strong> - Datos guardados exitosamente.</div>',function(){
								$("[data-pos="+pos+"]").attr("title",txtVivienda);
								$("#myModal").modal('hide');
							})
						}else{
							alertify.alert("Error","Comuniquese con el administrador del sistema.");
							return;
						}
					}
				});
			}else{
				alertify.alert("Atención","Debe diligenciar los campos obligatorios (*)");
				return;
			}
		})

		function obtenerVivienda(id){
			$.ajax({ 
				url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerVivienda",
				type: 'POST',
				async: false,
				data: {
					Id 	: id,
				},
				success: function(respuesta){
					respuesta = JSON.parse(respuesta);
					$("#chVivienda").empty().append('<option value="">&nbsp;</option>');
					if (respuesta.length > 0) {
						$.each(respuesta,function(){
							$("#chVivienda").append('<option value="'+this.id+'" data-nomen="'+this.codigo+'">'+this.codigo+'</option>');
						})
						$("#chVivienda").trigger("chosen:updated");
					}else{
						alertify.alert('Atención','El tipo de vivienda, no tiene viviendas asociadas.');
						return;
					}
				}
			});
		}
		function obtenerDataVivienda(id){
			$.ajax({ 
				url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerDataVivienda",
				type: 'POST',
				async: false,
				data: {
					Id 	: id,
					Obt	: obtiene,
				},
				success: function(respuesta){
					try {
						respuesta = JSON.parse(respuesta);
						exp = 0;
						if (respuesta == 1) {
							alertify.alert("Atención","La vivienda ya esta relacionada en el mapa de zonas.");
							$("#chVivienda").val("").trigger("chosen:updated");
							viviendaId = null;
							exp = 1;
						}
						if (exp == 0) {
							if (obtiene == 0) {
								$("#chVivienda").empty().append('<option value="">&nbsp;</option>');
							}
							if (respuesta.length > 0) {
								$("[data-db=Nomenclatura]").val(respuesta[0].Nomenclatura);
								$("[data-db=Citofono]").val(respuesta[0].Citofono);
								$("[data-db=Terreno]").val(respuesta[0].Terreno);
								$("[data-db=Construido]").val(respuesta[0].Construido);
								$("[data-db=Pisos]").val(respuesta[0].Pisos);
								$("[data-db=VidaUtil]").val(respuesta[0].VidaUtil);
								$("[data-db=NumHabitacion]")	.val(respuesta[0].NumHabitacion	);
								$("[data-db=NumBano]").val(respuesta[0].NumBano);
								$("[data-db=NumVentana]").val(respuesta[0].NumVentana);
								$("[data-db=Matricula]").val(respuesta[0].Matricula);
								$("[data-db=CedulaCatastral]").val(respuesta[0].CedulaCatastral);
								$("[data-db=Valor]").val(respuesta[0].Valor);
								$("[data-db=Estado]") .val(respuesta[0].Estado);
							}else{
								alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
								return;
							}
						}
					} catch(e) {
						alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
						console.log(e);
					}
				}
			});
		}
	})

	$("#myModal").on('hidden.bs.modal', function(){
		if (rg == 0) {
			$("[data-pos="+x+"-"+y+"]").remove();
		}
		$('[data-toggle="tooltip"]').tooltip();
		obtenerDataZona(1);
	})
})

$(document).on("click",".btnSA",function(e){
	e.preventDefault();
});

$("[data-widget=pushmenu]").on("click",function(e){
	e.preventDefault();
	$("[data-toggle=tooltip]").tooltip('update');
});

function obtenerDataZona(tipo=null){
	$.ajax({ 
		url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerDataZona",
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
					$('.foto').css('background-image', "none");

					if (respuesta.Head.length > 0) {
						if (respuesta.Head[0].Imagen != null)
							$('.foto').css('background-image', ("url('"+base_url()+respuesta.Head[0].Imagen+"')"));
					}
				}
				if (tipo == null || tipo == 1) {
					if (respuesta.Zona.length > 0) {
						$(".rowVivienda").empty();
						$.each(respuesta.Zona, function(){
							spl = this.Posicion.split("-");
							$('.divLocaliza').append('<div data-pos="'+this.Posicion+'" data-toggle="tooltip" data-placement="top" title="" class="localizacion" id="btnMp" style="position:absolute;left:'+spl[0]+'px;top:'+spl[1]+'px"><i class="fas fa-map-marker-alt localiza" ></i></div>')
							$("[data-pos="+this.Posicion+"]").attr('title',this.Nomenclatura);

							var btnHtml = `
							<div class="col-12 mt-3 p-0">
								<div class="row">
									<div class="col-8">
										<button class="btn btn-light shadow-sm col-12 btnSA" data-id="`+this.Posicion+`">`+this.Nomenclatura+`</button>
									</div>
									<div class="col-2 pl-0">
										<button class="btn btnEditaViviendaAsociada btn-success col-12" data-posi="`+this.Posicion+`" data-id="`+this.ZonaPlanoId+`"><span class="fas fa-edit" title="Editar" ></span></button>
									</div>
									<div class="col-2 pl-0">
										<button class="btn btnEliminaViviendaAsociada btn-danger col-12" data-posi="`+this.Posicion+`" data-id="`+this.ZonaPlanoId+`"><span class="far fa-trash-alt" title="Eliminar" ></span></button>
									</div>
								</div>
							</div>`;
							$(".rowVivienda").append(btnHtml);
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

function leerImg(input) {
	if ($gID != null) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			var bg = null;
			reader.onload = function (e) {
				var background = e.target.result;
				bg = background;
				//$('.foto').css('background-image', ("url('"+background+"')"));
			}
			reader.readAsDataURL(input.files[0]);
			if(typeof FormData !== 'undefined'){
				//var rastreo = RASTREO('Modifica Cliente '+$ID+' Cambia Foto', 'Terceros');
				var form_data = new FormData();
				form_data.append('file', $(input)[0].files[0]);
				form_data.append('Id', $gID);
				$.ajax({	
					url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/ActualizarImagen",
					type:"POST",
					async		: false,
					cache		: false,
					contentType : false,
					processData : false,
					data:form_data,	
					success:function(respuesta){
						if(respuesta != 1){
							console.log(respuesta);
							alertify.alert('Error', respuesta, function(){
								this.destroy();
							});
						}else{
							$('.foto').css('background-image', ("url('"+bg+"')"));
							$(".divLocaliza2").removeClass('divLocaliza2').addClass('divLocaliza');
						}
					}
				});
			}
		}
	}else{
		alertify.alert("Atención","Para gestionar el mapa, es necesario seleccionar la zona.",function(){
			setTimeout(function(){ $("#nomZona").focus() },0)
		})
	}
}

function obtenerZonas(){
	$.ajax({ 
		url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/obtenerZonas",
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
								<div class="col-10">
									<button class="btn btn-light shadow-sm col-12 btnZonaMapa" data-id="`+this.id+`">`+this.nombre+`</button>
								</div>
								<div class="col-2 pl-0">
									<button class="btn btnEliminaZona btn-danger col-12" data-id="`+this.id+`"><span class="far fa-trash-alt" title="Eliminar" ></span></button>
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

function guardarConfiguracion(tipo,valor){
	$.ajax({ 
		url: base_url() + "Administrativo/Configuracion/Inicio/cMapa/guardarConfiguracion",
		type: 'POST',
		data : {
			Tipo 	: tipo,
			Valor 	: valor,
			Id 		: $gID,
			RASTREO : RASTREO("Modifica mapa [Zona: "+$(".ultimo").text()+"] [Tipo : "+tipo+" = "+valor+"]","Mapa")
		},
		async: false,
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta == 0) {
				alertify.alert('Error','<div class="alert alert-danger" role="alert" style="font-size: 15px;"><strong>Error </strong> - Comuniquese con el administrador del sistema.</div>');
				return;
			}
		}
	});
}

function borrarPlano(){
	$(".divLocaliza,.divLocaliza2,.rowVivienda").empty();
	$('.foto').css('background-image', "none");
	$gFila = 0;
	$("#nomZona,#pixeles").val("");
}