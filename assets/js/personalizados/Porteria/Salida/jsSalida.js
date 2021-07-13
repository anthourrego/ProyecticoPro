var $ProgIngreso = null,
$TerceroVehi 	= null,
$TerceroVivi 	= null,
$TipoIng 		= null;

$('.numerico').inputmask({
	alias 		: 'integer',
	rightAlign 	: false
});


$("#btnCC").on("click",function(e){
	e.preventDefault();
	$(".divCedula").toggleClass('d-none')
	$(".divPlaca").addClass('d-none');
	setTimeout(function(){$("#txtCedula").val("").focus()},0)
});

$("#btnPlaca").on("click",function(e){
	e.preventDefault();
	$(".divPlaca").toggleClass('d-none')
	$(".divCedula").addClass('d-none');
	setTimeout(function(){$("#txtPlaca").val("").focus()},0)
});

$("#txtCedula").off("change").on("change",function(){
	if ($(this).val() != '') {
		verificaTerceroSalida('',$(this).val());
	}
});

$("#txtPlaca").off("change").on("change",function(){
	if ($(this).val() != '') {
		verificaTerceroSalida($(this).val(),'');
	}
});

$("#btnSalida").on("click",function(e){
	e.preventDefault();
	$.ajax({ 
		url: base_url() + "Porteria/Salida/cSalida/registrarSalida",
		type: 'POST',
		async: false,
		data: {
			Id 		: $ProgIngreso,
			Id2 	: $TerceroVehi,
			Id3 	: $TerceroVivi,
			Tipo 	: $TipoIng,
			RASTREO : RASTREO("Registra salida [Documento : "+$("#txtCedulaS").val()+"] [Nombre : "+$("#txtNomVisiS").val()+"]","Salida")
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta == 1) {
				alertify.alert("Atención",msgAlerta.successSimple,function(){
					$("#txtPlaca").val("");
					$("#txtCedula").val("");
				});
				limpiarForm()
			}else{
				alertify.alert("Atención",msgAlerta.errorAdmin);
				return;
			}
		}
	});
})

function limpiarForm(){
	$("#frmIngreso").find('.form-control').each(function(){
		$(this).val("");
	})
	$(".divSalida").addClass('d-none');
}

function verificaTerceroSalida(placa,cedula){
	$.ajax({ 
		url: base_url() + "Porteria/Salida/cSalida/verificaTerceroSalida",
		type: 'POST',
		async: false,
		data: {
			Placa 	: placa,
			Cedula 	: cedula,
		},
		success: function(respuesta){
			try {
				respuesta = JSON.parse(respuesta);
				if (respuesta == 0) {
					alertify.alert("Atención","El numero de [Cedula / Placa] digitado no coincide con ningún residente o visita programada y/o autorizada ó ya se registro su salida.",function(){
						$("#txtPlaca").val("");
						$("#txtCedula").val("");
					})
					limpiarForm();
					return;
				}
				switch (respuesta.Tipo) {
					case 'Residente':
						$("#txtCedulaS").val(respuesta.data[0].TerceroID);
						$("#txtNomVisiS").val(respuesta.data[0].Nombre);
						$("#txtTipoS").val(respuesta.data[0].tipo);
						break;
					case 'PlacaResidente':
					case 'VisitaResidente':
					case 'PlacaVisita':
						$("#txtCedulaS").val(respuesta.data[0].TerceroID);
						$("#txtNomVisiS").val(respuesta.data[0].Nombre);
						$("#txtTipoVehiS").val(respuesta.data[0].nomVehi);
						$("#txtPlacaS").val(respuesta.data[0].Placa);
						$("#txtTipoS").val(respuesta.data[0].tipo);
						break;
					default:
						break;
				}

				switch (respuesta.Tipo) {
					case 'Residente':
						$TerceroVivi = respuesta.data[0].ViviendaTerceroId;
						break;
					case 'PlacaResidente':
						$TerceroVehi = respuesta.data[0].TerceroVehiculoId;
						break;
					case 'VisitaResidente':
					case 'PlacaVisita':
						$TipoIng	 = respuesta.data[0].tipoV;
						$ProgIngreso = respuesta.data[0].ProgIngresoId;
						break;
					default:
						break;
				}
				$(".divSalida").removeClass('d-none');
				setTimeout(function(){$("#btnSalida").focus()},0)
			} catch(e) {
				// statements
				console.log(e);
			}
		}
	});
}
