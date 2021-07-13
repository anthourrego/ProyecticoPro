var $GID = null,
dataAjax = {
	Id : ''
}

var dtHistorico = $('#tblHistorico').DataTable({
	language,
	dom: domftrip,
	processing: true,
	pageLength: 5,
	ajax: {
		url: 'cMascota/qHistorico',
		type: 'POST',
		data: function(d){
			return  $.extend(d, dataAjax);
		}
	},
	columns: [
		{data: 'Acciones'},
		{data: 'Id', visible:false},
		{data: 'Vacuna'},
		{data: 'Fecha'},
	],
	createdRow: function(row, data, dataIndex){
		$(row).find('td:eq(0)').html(
			`<center>
				<div class="btn-group btn-group-xs">
					<button class="btnEliminar btn btn-danger btn-xs" value="`+data.Id+`" title="Eliminar" style="margin-bottom:3px"><span class="far fa-trash-alt"></span></button>
				</div>
			</center>`
		);
	}
});

$('select.chosen-select').chosen({
	placeholder_text_single: ''
	,width: '100%'
	,no_results_text: 'Oops, no se encuentra'
	,allow_single_deselected: true
}).on("change",function(){
	switch ($(this).attr('id')) {
		case 'chTipoMascota':
			habilitaForm();
			break;
		case 'chMascota':
			dataAjax.Id = $(this).val();
			dtHistorico.ajax.reload();
			break;
		default:
			// statements_def
			break;
	}
});

$('.date').datetimepicker({
	format: 'YYYY-MM-DD',
	locale: 'es'
});

$(document).ready(function(){
	obtenerMascotaTercero();
	$("#chTipoMascota").trigger("chosen:open");
})

$("input[type=file]").change(function(){
	leerImg(this);
});

$("#btnGuardar").on("click",function(e){
	e.preventDefault();
	var exep = 0;
	$(".valida").each(function(){
		if ($(this).val() == '' || $(this).val() == null) {
			exep = 1;
			return;
		}
	})
	if (exep == 1) {
		alertify.alert("Atención","Debe de diligenciar todos los campos obligatorios (*)");
		return;
	}
	if ($GID == null && $(".anexo").val() == '') {
		alertify.alert("Atención","Debe de diligenciar todos los campos obligatorios (*)");
		return;
	}
	if(typeof FormData !== 'undefined'){
		var rastreo = '';
		var datos = {
			TipoMascotaId 	: $("#chTipoMascota").val(),
			TerceroID 		: $CC,
			ViviendaId		: $ID,
			Nombre 			: $("#nombre").val(),
			Raza 			: $("#raza").val(),
			Sexo 			: $("#chSexo").val(),
			Tamano 			: $("#tamano").val(),
			FechaNac 		: $("#fechaNac").val(),
			Observacion 	: $("#observacion").val(),
		}
		if ($GID == null) {
			rastreo = 'Crea mascota [Tipo : '+$("#chTipoMascota").find('option:selected').text()+'] [Nombre : '+datos.Nombre+'] [Fecha nacimiento : '+datos.FechaNac+']';
		}else{
			rastreo = 'Edita mascota [Id : '+$GID+'] [Tipo : '+$("#chTipoMascota").find('option:selected').text()+'] [Nombre : '+datos.Nombre+'] [Fecha nacimiento : '+datos.FechaNac+']';		
		}
		var form_data = new FormData();
		form_data.append('file', $('.anexo')[0].files[0]);
		form_data.append('TipoMascotaId', datos.TipoMascotaId);
		form_data.append('TerceroID', datos.TerceroID);
		form_data.append('ViviendaId', datos.ViviendaId);
		form_data.append('Nombre', datos.Nombre);
		form_data.append('Raza', datos.Raza);
		form_data.append('Sexo', datos.Sexo);
		form_data.append('Tamano', datos.Tamano);
		form_data.append('FechaNac', datos.FechaNac);
		form_data.append('Observacion', datos.Observacion);
		form_data.append('GID', $GID);
		form_data.append('RASTREO', RASTREO(rastreo,"Mascotas"));
		$.ajax({	
			url: base_url() + "Propietario/Mascota/cMascota/ActualizarImagen",
			type:"POST",
			async		: false,
			cache		: false,
			contentType : false,
			processData : false,
			data:form_data,	
			success:function(respuesta){
				respuesta = JSON.parse(respuesta);
				switch (respuesta.Tipo) {
					case 'NA':
						$('.fotoMascota').css('background-image', "none");
						break;
					case 'ERROR':
						$('.fotoMascota').css('background-image', "none");
						break;
					case 'CREA':
						alertify.alert("Atención",msgAlerta.successSimple,function(){
							limpiarForm();
							obtenerMascotaTercero();
						})
						break;
					case 'ACTUALIZA':
						alertify.alert("Atención",msgAlerta.successSimple,function(){
							limpiarForm();
							obtenerMascotaTercero();
						})
						break;
					default:
						// statements_def
						break;
				}
			}
		});
	}
});

$("#btnVacuna").on("click",function(e){
	e.preventDefault();
	var exep = 0;
	$(".valida2").each(function(){
		if ($(this).val() == '' || $(this).val() == null) {
			exep = 1;
			return;
		}
	});

	if (exep == 0) {
		var datos = {
			TerceroMascotaId 	: $("#chMascota").val(),
			Vacuna 				: $("#vacuna").val(),
			Fecha 				: $("#fecha").val(),
		}
		$.ajax({ 
			url: base_url() + "Propietario/Mascota/cMascota/guardarVacuna",
			type: 'POST',
			async: false,
			data: {
				Data 	: datos,
				RASTREO : RASTREO('Registra nueva vacuna [Mascota : '+$("#chMascota").find("option:selected").text()+'] [Vacuna: '+datos.Vacuna+'] [Fecha: '+datos.Fecha+'] ','Mascotas')
			},
			success: function(respuesta){
				respuesta = JSON.parse(respuesta);
				if (respuesta == 1) {
					alertify.alert("Atención",msgAlerta.successSimple,function(){
						$("#vacuna").val("");
						$("#fecha").val("");
						dtHistorico.ajax.reload();
						obtenerMascotaTercero('R');
					})
				}else{
					alertify.alert("Error","La invitación no ha podido ser guardada exitosamente, comuniquese con el administrador del sistema.");
					return;
				}
			}
		});
	}else{

	}
})

$(document).on("click",".btnEditaM",function(e){
	e.preventDefault();
	$GID = $(this).val();
	obtenerDataMascota($(this).val());
})

$(document).on("click",".btnEliminaM",function(e){
	e.preventDefault();
	var self = this;
	alertify.confirm('Eliminar mascota', 'Está seguro de eliminar la mascota ?', function(){
		$.ajax({
			url: base_url() + "Propietario/Mascota/cMascota/eliminarMascota",
			type: 'POST',
			async: false,
			data: {
				Id 		: $(self).val(),
				RASTREO : RASTREO("Elimina Mascota [Id : "+$(self).val()+"] [Mascota : "+$(self).attr('data-nom')+"]","Mascotas")
			},
			success: function(respuesta){
				if (respuesta == 1) {
					alertify.alert("Atención",msgAlerta.succesElimina,function(){
						limpiarForm();
						obtenerMascotaTercero();
					});
				}else{
					alertify.alert("Atención",msgAlerta.errorAdmin);
					return;
				}
			}
		});
	}, function() { }).set('labels', {ok: 'Ok', cancel: 'Cancelar'});
})

$("#btnLimpiar").on("click",function(e){
	e.preventDefault();
	limpiarForm();
})

function leerImg(input) {
	console.log('Hola');
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		var bg = null;
		reader.onload = function (e) {
			var background = e.target.result;
			bg = background;
			$('.fotoMascota').css('background-image', ("url('"+background+"')"));
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function habilitaForm(){
	$("#frmRegistro").find(".form-control").each(function(){
		$(this).attr("disabled",false).trigger("chosen:updated");
	});
	$("#btnVacuna").attr("disabled",false);
}

function limpiarForm(){
	$("#frmRegistro").find(".form-control").each(function(){
		$(this).val("").trigger("chosen:updated");
	});
	$('.fotoMascota').val("");
	$('.fotoMascota').css('background-image', "none");
	$GID = null;
	dataAjax.Id = '';
	dtHistorico.ajax.reload();
}

function obtenerMascotaTercero(tipo=null){
	$.ajax({ 
		url: base_url() + "Propietario/Mascota/cMascota/obtenerMascotaTercero",
		type: 'POST',
		async: false,
		data: {
			Id  : $CC,
			Id2 : $ID,
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (tipo == null) {
				$("#chMascota").empty().append('<option value="">&nbsp;</option>');
			}
			$(".divMascota").empty();
			if (respuesta.length > 0) {
				var cont = 0;
				$.each(respuesta,function(){
					if (tipo == null) {
						$("#chMascota").append('<option value="'+this.id+'">'+this.nombre+'</option>');
					}
					var x = `
					<ul class="list-unstyled shadow p-2">
						<li>
							<div class="offset-9 col-2 offset-md-10 col-md-2 offset-xl-10 col-xl-2">
								<div class="btn-group col-12 p-0" role="group">
									<button type="button" class="btn btn-success btn-sm btnEditaM" value="`+this.id+`" id="btnLimpiar" title="Editar"><i class="fas fa-edit"></i></button>
									<button type="button" class="btn btn-danger btn-sm btnEliminaM" value="`+this.id+`" data-nom="`+this.nombre+`" id="btnLimpiar" title="Eliminar"><i class="fas fa-window-close"></i></button>
								</div>
							</div>
						</li>
						<li class="media">
							<div class="mr-3 col-5 col-md-3 col-xl-3 fotoM foto`+cont+`"></div>
							<div class="media-body">
								<h5 class="mt0-0 mb-1"></h5>
								<p class="mb-0"><strong>Nombre : </strong> `+this.nombre+` </p>
								<p class="mb-0"><strong>Raza : </strong> `+(this.Raza != null ? this.Raza : '')+` </p>
								<p class="mb-0"><strong>Sexo : </strong> `+this.Sexo+` </p>
								<p class="mb-0"><strong>Tamaño : </strong> `+(this.Tamano != null ? this.Tamano : '')+` </p>
								<p class="mb-0"><strong>Fecha de nacimiento : </strong> `+this.FechaNac+` </p>
								<p class="mb-0"><strong>Observaciones : </strong> `+(this.Observacion != null ? this.Observacion : '')+` </p>
								<hr class="w-100">
								<p class="mb-0"><strong>Vacunacion : </strong>`+(this.Vacuna != null ? this.Vacuna : '')+`</p>
							</div>
						</li>
					</ul>`;
					$(".divMascota").append(x);
					if(this.Foto !== "" && this.Foto !== null){
						//$().css('background-image', ("url(" + this.foto +")"));
						$('.foto'+cont).css('background-image', ("url('"+base_url()+this.Foto+"')"));
					}
					cont ++;
				})
			}
			$("#chMascota").trigger("chosen:updated");
		}
	});
}

function obtenerDataMascota(id){
	$.ajax({ 
		url: base_url() + "Propietario/Mascota/cMascota/obtenerMascotaTercero",
		type: 'POST',
		async: false,
		data: {
			Id  : id,
			Tipo : 'Id'
		},
		success: function(respuesta){
			respuesta = JSON.parse(respuesta);
			if (respuesta.length > 0) {
				$("#chTipoMascota").val(respuesta[0].TipoMascotaId).trigger("chosen:updated");
				$("#nombre").val(respuesta[0].nombre)
				$("#raza").val(respuesta[0].Raza)
				$("#chSexo").val((respuesta[0].Sexo == 'Hembra' ? 'F' : 'M')).trigger("chosen:updated");
				$("#tamano").val(respuesta[0].Tamano)
				$("#fechaNac").val(respuesta[0].FechaNac)
				$("#observacion").val(respuesta[0].Observacion)
				$("#chMascota").val(id).trigger("chosen:updated").change();
				$('.fotoMascota').css('background-image', ("url('"+base_url()+respuesta[0].Foto+"')"));
				habilitaForm()
			}
		}
	});
}