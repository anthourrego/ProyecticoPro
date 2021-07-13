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
		url: 'cServicio/qHistorico',
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
		{data: 'NomSer'},
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
			servicio = data.NomSer;
			alertify.confirm('Entrega de servicio', 'Está seguro de marcar como entregado el servicio ?', function(){
				$.ajax({
					url: base_url() + "Porteria/Servicio/cServicio/actualizarServicio",
					type: 'POST',
					async: false,
					data: {
						Id 		: id,
						RASTREO : RASTREO("Entrega encomienda [Vivienda : "+vivienda+"] [Servicio : "+servicio+"]","Encomienda")
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
		$VIVIENDA = $(this).val();
		$(".divDatos").removeClass('d-none');
		$("#txtDataDir").val($(this).find("option:selected").text());
		setTimeout(function(){$("#chTipoSer").trigger("chosen:open")},0)
	}else{
		if ($(this).val() != '') {
			setTimeout(function(){$("#observacion").focus()},0)
		}
	}
});

$(document).ready(function(){
	obtenerZonas();
	$(document).find('[data-toggle="tooltip"]').tooltip();
})

$("#btnCA").on("click",function(e){
	e.preventDefault();
	limpiarForm();
	$(".divNom,.rowMapa").addClass('d-none');
	$(".divCA").toggleClass('d-none');
	$(".divEmpresa,.divHistorico").removeClass('d-none');
	setTimeout(function(){$("#chVivienda").trigger("chosen:open")},0)
	$("[data-toggle=tooltip]").tooltip('hide');
});

$("#btnMapa").on("click",function(e){
	e.preventDefault();
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
	$VIVIENDA = $(this).attr("data-id");
	$(".divDatos,.divEmpresa,.divHistorico").removeClass('d-none');
	$(".rowMapa").addClass('d-none');
	$("#txtDataDir").val($(this).attr('data-cod'));
	$("#chTipoSer").trigger("chosen:open");
})

$("#btnCancelar").on("click",function(e){
	e.preventDefault();
	limpiarForm();
})

$("#frmRegistro").on("submit",function(e){
	e.preventDefault();
	console.log('Hola');
	if ($VIVIENDA != null && $("#chTipoSer").val() != null) {
		var datos = {
			ViviendaId 		: $VIVIENDA,
			TipoServicioId 	: $("#chTipoSer").val(),
			Observacion 	: $("#observacion").val(),
			Tipo 			: 'S',
			Estado 			: 'A'
		}
		$.ajax({ 
			url: base_url() + "Porteria/Servicio/cServicio/guardarServicio",
			type: 'POST',
			async: false,
			data: {
				Data 	: datos,
				RASTREO : RASTREO("Recibe Servicio [Casa/apto : "+$("#txtDataDir").val()+" - "+$("#chTipoSer").find("option:selected").text()+"]","Servicios")
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
			<strong>*&nbsp;</strong> Verifique que tenga seleccionado como minimo, una vivienda por el boton de vivienda o selección por el mapa.<br><br>
			<strong>*&nbsp;</strong> Verifique que tenga seleccionado como minimo, un servicio para la vivienda.<br><br>
			<strong>*&nbsp;</strong> Si seleccionó una <strong>vivienda</strong>, por favor comuniquese con el administrador del sistema, ha ocurrido un error interno. <br>`
		)
	}
})

function limpiarForm(){
	$("#frmRegistro").each(function(){
		$(this).find('.form-control').val("").trigger("chosen:updated");
	});
	$("#chVivienda").val("").trigger("chosen:updated");
	$("#txtDataDir").val("");
	$(".divDatos").addClass('d-none');
	$VIVIENDA = null
}

function obtenerZonas(){
	$.ajax({ 
		url: base_url() + "Porteria/Servicio/cServicio/obtenerZonas",
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
		url: base_url() + "Porteria/Servicio/cServicio/obtenerDataZona",
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