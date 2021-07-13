var $TERCERO = null,
$VIVIENDA = null,
dataAjax = {
	Id : ''
}

var dtHistorico = $('#tblTareas').DataTable({
	language,
	dom: domftrip,
	processing: true,
	pageLength: 5,
	ajax: {
		url: 'cEncomienda/qHistorico',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Acciones'},
		{data: 'Id', visible:false},
		{data: 'Estado'},
		{data: 'Usuario'},
		{data: 'Vivienda'},
		{data: 'NomRes'},
		{data: 'Documento'},
		{data: 'Nombre'},
		{data: 'Observacion'},
		{
			data: 'FechaRegis',
			render: function(nTd, sData, oData, iRow, iCol){
				return moment(oData.FechaRegis, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD hh:mm:ss A");
			}
		},
	],
	createdRow: function(row, data, dataIndex){
		if (data.Estado == 'Pendiente') {
			$(row).find('td:eq(0)').html(`
				<center>
					<div class="btn-group btn-group-xs">
						<button class="btnActualizar btn btn-success btn-xs" value="`+data.Id+`" data-toggle="tooltip" data-placement="top" title="Marcar como entregado" style="margin-bottom:3px"><span class="fas fa-clipboard-check"></span></button>
					</div>
				</center>
			`);

			$(row).find('td:eq(1)').html(`
				<center>
					<div class="btn-group btn-group-xs">
						<button class="btn btn-warning btn-xs btnSE" style="margin-bottom:3px"><span>Pendiente</span></button>
					</div>
				</center>
			`);
		}else{
			$(row).find('td:eq(1)').html(`
				<center>
					<div class="btn-group btn-group-xs">
						<button class="btn btn-primary btn-xs btnSE" style="margin-bottom:3px"><span>Entregado</span></button>
					</div>
				</center>
			`);
		}

		$(row).on("click", '.btnSE', function(e){
			e.preventDefault();
		});

		$(row).on("click", '.btnActualizar', function(e){
			e.preventDefault();
			var id = $(this).val(),
			vivienda = data.Vivienda,
			residente = data.NomRes;
			console.log(vivienda,residente);
			alertify.confirm('Entrega de encomiendas', 'Está seguro de marcar como entregada la encomienda ?', function(){
				$.ajax({
					url: base_url() + "Porteria/Encomienda/cEncomienda/actualizarEncomienda",
					type: 'POST',
					async: false,
					data: {
						Id 		: id,
						RASTREO : RASTREO("Entrega encomienda [Vivienda : "+vivienda+"] [Residente : "+residente+"]","Encomienda")
					},
					success: function(respuesta){
						if (respuesta == 1) {
							alertify.alert("Atención",msgAlerta.successSimple,function(){
								dtHistorico.ajax.reload();
							})
						}else{
							alertify.error("¡Error! los datos no han sido guardados correctamente, comuniquese con el administrador del sistema.");
							return;
						}
					}
				});
			}, function() { dtHistorico.ajax.reload() }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
		})
	}
});

$('.chosen').chosen({
	placeholder_text_single: 'Seleccione:'
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){
	if ($(this).attr('id') == 'chVivienda') {
		var terceros = obtenerTerceroVivienda($(this).val()); 
		if (terceros.length > 0) {
			$VIVIENDA = $(this).val();
			modalTercero(terceros);
			$("#txtDataDir").val($(this).find("option:selected").text());
		}else{
			alertify.alert("Atención","La vivienda seleccionada no tiene residentes asociados.");
			return;
		}
	}else{
		$TERCERO  = $(this).val();
		$VIVIENDA = $(this).find("option:selected").attr('data-vivienda');

		$("#txtDataDir").val($(this).find("option:selected").attr('data-cod'));
		$("#txtDataTer").val($(this).find("option:selected").text());
		$(".divDatos").removeClass('d-none');
		setTimeout(function(){$("#cedula").focus()},0)
	}
});

$(document).ready(function(){
	obtenerZonas();
	$(document).find('[data-toggle="tooltip"]').tooltip();
})

$('.numerico').inputmask({
	alias 		: 'integer',
	rightAlign 	: false
});

$("#btnNom").on("click",function(e){
	e.preventDefault();
	limpiarForm();
	$(".divCA,.rowMapa").addClass('d-none');
	$(".divNom").toggleClass('d-none');
	$(".divEmpresa,.divHistorico").removeClass('d-none');
	$("[data-toggle=tooltip]").tooltip('hide');
	setTimeout(function(){$("#chResidente").trigger("chosen:open")},0);
});

$("#btnCA").on("click",function(e){
	e.preventDefault();
	limpiarForm();
	$(".divNom,.rowMapa").addClass('d-none');
	$(".divCA").toggleClass('d-none');
	$(".divEmpresa,.divHistorico").removeClass('d-none');
	$("[data-toggle=tooltip]").tooltip('hide');
	setTimeout(function(){$("#chVivienda").trigger("chosen:open")},0);
});

$("#btnMapa").on("click",function(e){
	e.preventDefault();
	//$("#btnLimpiar").click();
	$(".divCA,.divNom,.divDatos,.divEmpresa,.divHistorico").addClass('d-none');


	$(".rowMapa").toggleClass('d-none');
	$("[data-toggle=tooltip]").tooltip('show');
});

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

$(document).on("click",'.localizacion',function(){
	$("[data-toggle=tooltip]").tooltip('update');
	var terceros = obtenerTerceroVivienda($(this).attr("data-id")); 
	if (terceros.length > 0) {
		$VIVIENDA = $(this).attr("data-id");
		$(".divDatos,.divEmpresa,.divHistorico").removeClass('d-none');
		$(".rowMapa").addClass('d-none');
		$("#txtDataDir").val($(this).attr('data-cod'));
		modalTercero(terceros);
	}else{
		alertify.alert("Atención","La vivienda seleccionada no tiene residentes asociados.",function(){
			$("[data-toggle=tooltip]").tooltip('show');
			return;
		});
	}
})

$("#btnCancelar").on("click",function(e){
	e.preventDefault();
	limpiarForm();
})

$("#frmRegistro").on("submit",function(e){
	e.preventDefault();
	if ($TERCERO != null && $VIVIENDA != null) {
		var datos = {
			TerceroID 	: $TERCERO,
			ViviendaId 	: $VIVIENDA,
			Documento 	: $("#cedula").val(),
			Nombre 		: $("#nombre").val(),
			Observacion : $("#observacion").val(),
			Tipo 		: 'E',
			Estado 		: 'A'
		}
		$.ajax({ 
			url: base_url() + "Porteria/Encomienda/cEncomienda/guardarEncomienda",
			type: 'POST',
			async: false,
			data: {
				Data 	: datos,
				RASTREO : RASTREO("Recibe encomienda [Casa/apto : "+$("#txtDataDir").val()+"] [Residente : "+$("#txtDataTer").val()+"]","Encomiendas")
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				if (respuesta == 1) {
					alertify.alert("Atención",msgAlerta.successSimple,function(){
						limpiarForm();
						dtHistorico.ajax.reload();
					});
				}
			}
		});
	}else{
		alertify.alert("Atencion",`
			<strong>*&nbsp;</strong> Verifique que tenga seleccionado como minimo, una vivienda o un tercero.<br><br>
			<strong>*&nbsp;</strong> Si seleccionó una <strong>vivienda</strong>, no selecciono el tercero para el cual va dirigida la encomienda. <br><br>
			<strong>*&nbsp;</strong> Si selecciono un <strong>Tercero</strong>, por favor comuniquese con el administrador del sistema, ha ocurrido un error interno.`
		)
	}
})

function modalTercero(arr){
	$("#mIngreso").modal('show');

	$("#mIngreso").unbind().on('shown.bs.modal', function(){
		$(".rowData").empty();
		for (var i = 0; i < arr.length; i++) {
			$(".rowData").append(`
				<div class="col-10 mb-2" title="`+arr[i].nombre+`">
					<input type="" name="" class="form-control" readonly value="`+arr[i].nombre+`">
				</div>
				<div class="col-2" title="seleccionar tercero">
					<button type="button" class="btn btn-primary btn-block f-r btnSelect" id="btnSelect" data-nombre="`+arr[i].nombre+`" value="`+arr[i].TerceroID+`"><i class="fas fa-check-circle"></i></button>
				</div>`
			);
		}
		$(document).on("click",".btnSelect",function(e){
			e.preventDefault();
			$TERCERO = $(this).val();
			$("#txtDataTer").val($(this).val()+' | '+$(this).attr('data-nombre'));
			$("#mIngreso").modal('hide');
		})
		$("#btnCerrar").on("click",function(e){
			e.preventDefault();
			$("#mIngreso").modal('hide');
		})
	})

	$("#mIngreso").on('hidden.bs.modal', function(){
		if ($TERCERO == null) {
			$("#txtDataTer").val("");
			$("#txtDataDir").val("");
			$VIVIENDA = null;
		}else{
			$(".divDatos").removeClass('d-none');
			setTimeout(function(){$("#cedula").focus()},0)
		}
	})
}

function obtenerTerceroVivienda(id){
	var resp = [];
	$.ajax({ 
		url: base_url() + "Porteria/Encomienda/cEncomienda/obtenerTerceroVivienda",
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

function limpiarForm(){
	$("#frmRegistro").each(function(){
		$(this).find('.form-control').val("");
	});
	$("#chVivienda, #chResidente").val("").trigger("chosen:updated");
	$("#txtDataDir, #txtDataTer").val("");
	$(".divDatos").addClass('d-none');
	$TERCERO = null,
	$VIVIENDA = null
}

function obtenerZonas(){
	$.ajax({ 
		url: base_url() + "Porteria/Encomienda/cEncomienda/obtenerZonas",
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
									<button class="btn btn-light shadow-sm border col-12 btnZonaMapa" data-id="`+this.id+`">`+this.nombre+`</button>
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
		url: base_url() + "Porteria/Encomienda/cEncomienda/obtenerDataZona",
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
					}else{
						$("[data-toggle=tooltip]").tooltip('hide');
						$(".localizacion").remove();
					}
				}
			} catch(e) {
				alertify.alert('Atención',msgAlerta.errorAdmin);
				console.log(e);
			}
		}
	});
}