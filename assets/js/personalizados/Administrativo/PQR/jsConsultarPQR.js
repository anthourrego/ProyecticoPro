$(function(){
	bsCustomFileInput.init();

	$(".chosen-select").chosen({width: '100%'});

	$("[data-nombre=DependenciaId]").val($PQR['DependenciaId']);
	$("[data-nombre=TipoPQRId]").val($PQR['TipoPQRId']);
	$('[data-nombre=Fabricado]').val($PQR['Fabricado']);
	$('[data-nombre=Despachado]').val($PQR['Despachado']);
	$('[data-nombre=Causa]').val($PQR['Causa']);
	$('[data-nombre=Calidad]').val($PQR['Calidad']);
	$('[data-nombre=Responsable]').val($PQR['Responsable']);
	$('[data-nombre=Operacion]').val($PQR['Operacion']);
	$('[data-nombre=Seccion]').val($PQR['Seccion']);
	$('[data-nombre=ReclamoProveedor]').val($PQR['ReclamoProveedor']);
	$('[data-nombre=Costos]').val($PQR['Costos']);

	if($PQR['OtraCausa'] != null && $PQR['OtraCausa'] != '') {
		$('[data-nombre=Causa]').val('otro').change();
		$('[data-nombre=OtraCausa]').val($PQR['OtraCausa']);
	}
	if($PQR['OtraCalidad'] != null && $PQR['OtraCalidad'] != '') {
		$('[data-nombre=Calidad]').val('otro').change();
		$('[data-nombre=OtraCalidad]').val($PQR['OtraCalidad']);
	}
	if($PQR['OtraResponsable'] != null && $PQR['OtraResponsable'] != '') {
		$('[data-nombre=Responsable]').val('otro').change();
		$('[data-nombre=OtraResponsable]').val($PQR['OtraResponsable']);
	}
	if($PQR['OtraOperacion'] != null && $PQR['OtraOperacion'] != '') {
		$('[data-nombre=Operacion]').val('otro').change();
		$('[data-nombre=OtraOperacion]').val($PQR['OtraOperacion']);
	}
	if($PQR['OtraSeccion'] != null && $PQR['OtraSeccion'] != '') {
		$('[data-nombre=Seccion]').val('otro').change();
		$('[data-nombre=OtraSeccion]').val($PQR['OtraSeccion']);
	}

	$("#DetalleNota").keyup(function() {
		if ($("#DetalleNota").val().trim() != "") {
			$("#btn_enviarNota").prop("disabled", false);
		} else {
			$("#btn_enviarNota").prop("disabled", true);
		}
	});
	
	var $CAMPO_ante = '';
	$(".headPQR").on("focusin", function() {
		$CAMPO_ante = $(this).val();
	});
	
	$(".headPQR").on("change", function() {
		var campo = $(this);
		if(campo.val() != 'otro'){
			/* if(!$(this).is('input.otra')) {
				campo.siblings().addClass('d-none').val('');
			} */
			$.ajax({
				url: base_url() + "Administrativo/PQR/TramitarPQR/actualizarPQR",
				data: {
					'PQRId': $PQR['PQRId'],
					'nombre': $(this).attr('data-nombre'),
					'value': $(this).val(),
					'otra': $(this).hasClass('otra')
				},
				type: 'POST',
				success:function(respuesta) {
					if (respuesta == 1) {
						alertify.success('PQR actualizada.');
					} else {
						alertify.error("Ocurrió un problema al momento de actualizar la PQR.");
						campo.val($CAMPO_ante);
					}
				},
				error: function(error) {
					console.log(error);
					alertify.notify('error', 'error', 5);
					$(".headPQR").val($CAMPO_ante);
				}
			});
		} else {
			campo.siblings().removeClass('d-none');
		}
	});

	$("#frmNota").submit(function(e) {
		e.preventDefault();
		var nota = {
			PQRId: $PQR['PQRId'],
			EstadoReporte: $("#EstadoReporte").val(),
			Detalle: $("#DetalleNota").val().trim()
		}
		if ($('#Origen').val() != '') {
			nota['Origen'] = $('#Origen').val();
		}
		if (typeof FormData !== 'undefined') {
			var form_data = new FormData(document.getElementById("frmNota"));
			form_data.append('PQRId', $PQR['PQRId']);
			form_data.append('EstadoReporte', $("#EstadoReporte").val());
			form_data.append('Detalle', $("#DetalleNota").val());
			if ($('#Origen').val() != '') {
				nota['Origen'] = $('#Origen').val();
				form_data.append('Origen', $("#Origen").val());
			}
			$.ajax({
				url: base_url() + "Administrativo/PQR/TramitarPQR/do_upload",
				data: form_data,
				type: "POST",
				async	: false,
				cache	: false,
				contentType : false,
				processData : false,
				success:function(respuesta) {
					try {
						var subidas = JSON.parse(respuesta);
						var html = '';
						if (subidas.length > 0) {
							for (var i = 0; i < subidas.length; i++) {
								if(subidas[i]['estado'] == 1) {
									var alert 	= 'success',
										icon	= 'check-circle';
								} else {
									var alert 	= 'danger',
										icon	= 'fa-exclamation-circle';
								}
								var subida = "<div class='alert alert-"+alert+"' role='alert'>";
								subida += "<span class='fas fa-"+icon+"' aria-hidden='true'></span> "+subidas[i]['nombre'];
								subida += "</div>";
								html += subida;
							}
							alertify.alert('Archivos Subidos',
								html
								,function() {
								$("#frmNota")[0].reset();
								location.reload();
							});
						} else {
							$("#frmNota")[0].reset();
							location.reload();
						}
					} catch(e) {
						if (respuesta == '') {
							location.reload();
						} else {
							alertify.error("Ocurrió un problema al momento de agregar la nota.");
						}
					}
				},
				error: function(error) {
					alertify.notify('error', 'error', 5);
				}
			});
		}
	});

	$(".imgPQR").click(function(e) {
		e.preventDefault();
		window.open($(this).find('img').attr('src'),'_blank','',''); 
	});
	
	//Ocultar las imagenes de las notas
	$('.btn-hidden').on('click', function(e) {
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
