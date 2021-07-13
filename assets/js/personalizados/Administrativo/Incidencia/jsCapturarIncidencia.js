$(function(){
  	bsCustomFileInput.init();
	
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
			url: base_url() + 'Administrativo/Incidencia/cCapturarIncidencia/crear',
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
								location.href = base_url()+'Administrativo/Incidencia/cTramitarIncidencia/ConsultarIncidencia/'+HeadIncidenciaId;
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
										location.href = base_url()+'Administrativo/Incidencia/cTramitarIncidencia/ConsultarIncidencia/'+HeadIncidenciaId;
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
									location.href = base_url()+'Administrativo/Incidencia/cTramitarIncidencia/ConsultarIncidencia/'+HeadIncidenciaId;
								});
							}
						}
					} catch(e) {
						//console.log(respuesta);
						//.error(e.message);
						alertify.error("Error al guardar los datos");
					}
				}
			}
		});
	});

	$("#ItemEquipoId").on("change", function(){
		$("#Serial").val($('#ItemEquipoId option:selected').data("serial"));
	});

	$('.custom-select').chosen({
		placeholder_text_single: 'Seleccione'
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	});

});
