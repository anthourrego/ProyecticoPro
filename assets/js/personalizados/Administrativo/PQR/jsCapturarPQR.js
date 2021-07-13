var lastFocus = '';

$(function(){
  	bsCustomFileInput.init();
	//$("#Producidos").inputmask('integer');
	
	//Seteamos los campos al cargar
	$("#TipoPQR").val(0);
	$("#selectFact, #TerceroId, #Descripcion, #form-image").val("");
	$("#form-image-span").text("Seleccione un archivo...");

	$('.chosen-select').chosen({
		placeholder_text_single: 'Seleccione'
		,width: '100%'
		,no_results_text: 'Oops, no se encuentra'
		,allow_single_deselected: true
	});

	//Validamos el tipo PQR para validar el pedido
	/* if ($("#TipoPQR option:selected").attr("data-validar") == 0) {
		$(".verificar").addClass("d-none");
		$(".tipo").removeClass("col-md-3");
		$(".tipo").addClass("col-md-11");
		$("#selectFact").val("");
	} else {
		$(".verificar").removeClass("d-none");
		$(".tipo").removeClass("col-md-11");
		$(".tipo").addClass("col-md-3");
		$("#selectFact").val("");
	}   */


	$("#TipoPQR").on('change', function(){
		//var validar = $("#TipoPQR option:selected").attr("data-validar");
		$("#selectFact").val("").change();
		/* $("#PQRPedido").val(validar);

		if(validar == 0){
			$(".verificar").addClass("d-none");
			$(".tipo").removeClass("col-md-3");
			$(".tipo").addClass("col-md-11");
		}else{
			$(".verificar").removeClass("d-none");
			$(".tipo").removeClass("col-md-11");
			$(".tipo").addClass("col-md-3");
		} */
	});

	//validamos si existe un pedido
	/* var pedidoAnt;

	$("#Pedido").on("focusin", function(){
		pedidoAnt = $(this).val().trim();
	});

	$("#Pedido").on("focusout", function(){
		if ($(this).val().trim() != "") {
			if (pedidoAnt != $(this).val().trim()) {
				var pedidoid = $(this).val();
				$.ajax({
					url: base_url() + "Administrativo/PQR/CapturarPQR/verificarPedido",
					type: "POST",
					data: {
						pedidoid: pedidoid
					},
					success: function(respuesta){
						var r = JSON.parse(respuesta);
						var resp = r.dataProductos;
						var respFact = r.dataFacturas;
						if(resp.length > 0){
							if(resp[0].terceroid != null){
								$("#checkCliente").prop("checked", true);
								$(".esCliente").removeClass("d-none");
								$(".noEsCliente").addClass("d-none");
								$("#TerceroId").focus();
								$(".TerceroId").val(resp[0].terceroid);
								$(".ClienteNombre").text(resp[0].Cliente);
							} else {
								$(".TerceroId").val("");
								$(".ClienteNombre").val("Cliente");
							}
	
							vaciarCampos();
							for(var i = 0; i < resp.length; i++){
								$("#Producto").append(`
									<option value='${resp[i].productoId}' data-cantidad='${parseInt(resp[i].cantidad)}' data-Id='${resp[i].id}'>${resp[i].producto} (${parseInt(resp[i].cantidad)})</option>
								`);
							}
						} else {
							$(".TerceroId").val("");
							$(".ClienteNombre").text("Cliente");
	
							vaciarCampos();
							$("#Material option").remove();
							$("#Material").append(`
								<option value="0" selected disabled>Seleccione</option>
								<option value="otro" data-id="otro">Otro</option>
							`);
							$("#Material option:eq(0)").prop("selected", true);
							$("#MaterialNombre").val("");
						}
	
						$("#selectFact option").remove();
						$("#selectFact").append(`
							<option value="" selected>N/A</option>
							<option value="DGFact">Digitar Factura</option>
						`);
	
						$("#selectFact").siblings().addClass('hidden').val('').closest('.my-group').find('.form-control').css('width', '100%');
						$("#selectFact option:eq(0)").prop("selected", true);
	
						if(respFact.length > 0){
							for(var i = 0; i < respFact.length; i++){
								$('#selectFact').append(`<option value="${respFact[i].factura}">${respFact[i].factura}</option>`);
							}
						}
					}
				});
			}
		} else {
			$(".TerceroId").val("");
			$(".ClienteNombre").text("Cliente");

			$("#Producto").val("0");
		}
	}); */

	$(document).on("change", "#Factura", function(){
		if($(this).val().trim() != ""){
			var factura = $(this).val();
			productosFact(factura);
		} else {
			$(".TerceroId").val("");
			$(".ClienteNombre").text("");
			$("#selectFact").val("").change();
	
			/* $(".contenido_div:not(.principal)").remove();
	
			$("#Producto option").remove();
			$("#Producto").append(`
				<option value="0" selected disabled>Seleccione</option>
				<option value="otro">Otro</option>
			`);
	
			if($('#Pedido').val().trim() != ""){
				$('#Pedido').focusout();
			} */
		}
	});
/* 
	$(document).on("change", ".selector", function() {
		var campo = $(this);
		if(campo.val() != 'otro'){
			if(!$(this).is('input.otro')) {
				campo.siblings().addClass('d-none').val('').closest('.my-group').find('.form-control').css('width', '100%');
			}
		} else {
			campo.siblings().removeClass('d-none').closest('.my-group').find('.form-control').css('width', '50%');
		}
	});
 */
	$(document).on("change", '#selectFact', function(){
		var factura = $(this).val();
		if(factura == "DGFact"){
			//vaciarCampos();
			$("#selectFact").siblings().removeClass('d-none').closest('.my-group').find('.form-control').css('width', '50%');
			$("#Factura").val("");
		}else if(factura == ''){
			//vaciarCampos();
			//$('.verificarMaterial').removeClass('d-none');
			$("#selectFact").siblings().addClass('d-none').val('').closest('.my-group').find('.form-control').css('width', '100%');
		}else{
			$("#selectFact").siblings().addClass('d-none').val('').closest('.my-group').find('.form-control').css('width', '100%');
			productosFact(factura);
		}
	});

	/* var prodAnt;
	$('.div_contenido').on("click", ".Producto:not(option)", function(){
		var contenedor = $(this).closest('.contenido_div');
		var pedidoid = contenedor.find(".Producto option:selected").data("id");
		if($(this).val() != "" && $(this).val() != null)
			prodAnt = contenedor.find("option:selected").data("id");
	});

	$('.div_contenido').on("change", ".Producto", function(){
		var contenedor = $(this).closest('.contenido_div');

		if($(this).val() == "otro"){
			contenedor.find("#Material").siblings().removeClass('d-none').closest('.my-group').find('.form-control').css('width', '50%');
			contenedor.find("#Material").prop("disabled", false);
			contenedor.find("#Material option:eq(1)").prop("selected", true);
			contenedor.find("#Material option").remove();
			contenedor.find("#Material").append(`
				<option value="0" selected disabled>Seleccione</option>
				<option value="otro" data-id="otro">Otro</option>
			`);
			contenedor.find("#Material option:eq(0)").prop("selected", false);
			contenedor.find("#MaterialNombre").val("");
			contenedor.find("#Producitos").val("");
		}else{
			var pedidoid = contenedor.find("#Producto option:selected").data("id");

			contenedor.find("#Material").siblings().addClass('d-none').val('').closest('.my-group').find('.form-control').css('width', '100%');
			contenedor.find("#Material option:eq(0)").prop("selected", true);
			contenedor.find("#Material").prop("disabled", false);
			contenedor.find("#Producidos").val(contenedor.find("#Producto option:selected").data("cantidad"));
			if(pedidoid != null && pedidoid != 'null'){
				$.ajax({
					url: base_url() + "Administrativo/PQR/CapturarPQR/listaMateriales",
					type: 'POST',
					data: {
						pedidoid: pedidoid
					},
					success: function(respuesta){
						var resp = JSON.parse(respuesta);
						if(resp.length > 0){
							if(resp[0].nombre != null){
								contenedor.find("#Material option").remove();
								contenedor.find("#Material").append(`
									<option value="0" selected disabled>Seleccione</option>
									<option value="otro" data-id="otro">Otro</option>`
								);
								contenedor.find("#Material option:eq(0)").prop("selected", true);
								for(var i = 0; i < resp.length; i++){
									contenedor.find("#Material").append(`<option value='${resp[i].nombre}' data-Id='${resp[i].productoid}'>${resp[i].nombre}</option>`);
								}
							}
						} else {
							contenedor.find("#Material option").remove();
							contenedor.find("#Material").append(`
								<option value="0" selected disabled>Seleccione</option>
								<option value="otro" data-id="otro">Otro</option>
							`);
						}
					}
				});

				$.each($(".Producto").not($(this)), function(){
					$(this).find("option[data-id='"+pedidoid+"']").prop("disabled", true);
				});
			}else{
				contenedor.find("#Material option").remove();
				contenedor.find("#Material").append(`
					<option value="0" selected disabled>Seleccione</option>
					<option value="otro" data-id="otro">Otro</option>
				`);
			}
		}
	});

	$('.div_contenido').on("change", ".Material", function(){
		var contenedor = $(this).closest('.contenido_div');
		if($(this).val().trim() != "otro" && $(this).val().trim() != null){
			contenedor.find("#MaterialNombre").val($(this).val());
		} else {
			contenedor.find("#MaterialNombre").val("");
		}
	});
 */
	$(document).on("change", "#checkCliente", function(){
		if($(this).is(":checked")){
			$(".esCliente").removeClass("d-none");
			$(".noEsCliente").addClass("d-none");
			$("#OtroCliente").val("");
		} else {
			$(".esCliente").addClass("d-none");
			$(".noEsCliente").removeClass("d-none");
			$("#TerceroId").val("");
			$("#ClienteNombre").text("Cliente");
		}
	});

	/* $("#btn_agregar").click(function(e){
		e.preventDefault();
		if($(".Producto:last").val() != null && 
		$(".Producto:last").val() != "" && 
		$(".Producidos:last").val() != "" &&
		$(".OtroProducto:last:visible").val() != ""){
			clase = '';
			if($('.verificarMaterial').is('.d-none')){
				clase = 'd-none';
			}else{
				if($(".Material:last").val() == null || 
					$(".Material:last").val() == "" || 
					$(".MaterialNombre:last:visible").val() == ""){
					return false;
				}
			}

			var contenido = `
				<div class="form-row contenido_div mt-2">
					<label class="col-12 col-sm-1 font-weight-bold my-auto verificar">Producto: </label>
					<div class="col-12 col-md-4 verificar">
						<div class="input-group my-group">
							<select class="custom-select custom-select-sm form-control selector otro Producto" name="Producto" id="Producto">
								<option value="0" selected disabled>Seleccione</option>
								<option value="otro">Otro</option>
							</select>
							<input type="text" class="form-control-sm form-control selector otro d-none" id="OtroProducto" name="OtroProducto" maxlength="100" autocomplete="off">
						</div>
					</div>
					<label for="Material" class="col-12 col-sm-1 font-weight-bold my-auto verificar ${clase} verificarMaterial">Material: </label>
					<div class="col-sm-3 verificar ${clase} verificarMaterial">
						<div class="input-group my-group">
							<select class="custom-select custom-select-sm form-control selector otro Material" name="Material" id="Material" disabled>
								<option value="0" selected disabled>Seleccione</option>
								<option value="otro" data-id="otro">Otro</option>
							</select>
							<input type="text" class="form-control-sm form-control d-none selector otro MaterialNombre" id="MaterialNombre" name="MaterialNombre" maxlength="100" autocomplete="off">
						</div>
					</div>
					<label for="Producidos" class="col-12 col-sm-1 font-weight-bold my-auto verificar">Cantidad: </label>
					<div class="col-sm-1 verificar">
						<input name="Producidos" id="Producidos" class="form-control form-control-sm Producidos text-right" type="text"  onKeyPress="return soloNumeros(event)" maxlength="5" autocomplete="off">
					</div>
					<div class="col-sm-1 verificar mt-2 mt-md-0">
						<button class="btn btn-danger btn-block btn-sm btn_quitar">
							<i class="fas fa-minus"></i>
						</button>
					</div>

				</div>
			`;
	
			$(".div_contenido").append(contenido);
	
			var valoresProductos = [];
			if($(".principal #Producto option").length > 2) {
				$.each($(".Producto:first option"), function(){
					if($(this).val() != "" && $(this).val() != "otro")
						valoresProductos.push({valor: $(this).val(), cantidad: $(this).attr("data-cantidad"), id: $(this).attr("data-id"), nombre: $(this).text().trim()});
				});
			}
	
			var valoresExistentes = [];
			$.each($(".Producto option:selected"), function(){
				if($(this).val() != "" && $(this).val() != "otro"){
					if($('.verificarMaterial').is('.d-none')){
						valoresExistentes.push($(this).val());
					}else{
						valoresExistentes.push($(this).attr("data-id"));
					}
				}
			});
	
			if(valoresProductos.length > 0){
				var verificar = false;
				var cadena = "";
				for(var i = 0; i < valoresProductos.length; i++){
					for(var x = 0; x < valoresExistentes.length; x++){
						if($('.verificarMaterial').is('.d-none')){
							if(valoresExistentes[x] == valoresProductos[i].valor){
								verificar = true;
							}
						}else{
							if(valoresExistentes[x] == valoresProductos[i].id){
								verificar = true;
							}
						}
					}
					if (verificar){
						verificar = false;
					} else {
						cadena += "<option value='"+valoresProductos[i].valor+"' data-cantidad='"+valoresProductos[i].cantidad+"' data-id='"+valoresProductos[i].id+"'>"+valoresProductos[i].nombre+"</option>";
					}
				}
				$(".Producto:last").append(cadena);
			}
		}
	}); */

	/* $('.div_contenido').on('click', '.btn_quitar', function(e){
		e.preventDefault();
		var contenedor = $(this).closest('.contenido_div');
		var pedidoid = contenedor.find(".Producto option:selected").attr("data-Id");
	
		$.each($(".Producto").not(contenedor.find(".Producto")), function(){
			$(this).find("option[data-id='"+pedidoid+"']").prop("disabled", false);
		});
	
		$(this).closest('.contenido_div').remove();
	});
	
	$(".div_contenido").on("focusout", ".Producidos", function(){
		var contenedor = $(this).closest('.contenido_div');
		if($(this).val().trim() != ""){
			if(parseInt($(this).val()) > parseInt(contenedor.find("#Producto option:selected").attr("data-cantidad"))) {
				contenedor.find("#Producidos").val(parseInt(contenedor.find("#Producto option:selected").attr("data-cantidad")));
			}
		}
	}); */

	$('#frmRegistrarPQR').on('submit', function(e){
		e.preventDefault();

		if ($("#TipoPQR").val() == null) {
			alertify.error("Seleccione tipo PQR");
			$("#TipoPQR").focus();
			return false;
		}
		
		if($("#selectFact").val() == "DGFact"){
			if($("#Factura").val().trim() == ""){
				alertify.error("Ingrese la Factura");
				$("#Factura").focus();
				return false;
			}
		}
		//Valido el tipo de cliente: Existente u Otro
		if($(".esCliente").is(":visible")){
			if ($("#TerceroId").val() == null) {
				alertify.error("Ingrese un cliente");
				$("#TerceroId").focus();
				return false;
			}
		} else if($(".noEsCliente").is(":visible")){
			if ($("#OtroCliente:visible").val().trim() == "") {
				alertify.error("Ingrese un cliente");
				$("#OtroCliente:visible").focus();
				return false;
			}
		}
	
		/* var validarDatos = true;
		var productosPedido = [];
		$.each($(".contenido_div"), function(){
			var contenedor = $(this);
			if(contenedor.find(".verificar").is(":visible")){
				if (contenedor.find("#Producto:visible").val() == "" || contenedor.find("#Producto:visible").val() == null) {
					alertify.error("Ingrese el Producto");
					contenedor.find("#Producto").focus();
					validarDatos = false;
					return false;
				} else if (contenedor.find(".verificar:visible #Producto:visible").val() == "otro") {
					if (contenedor.find("#OtroProducto:visible").val().trim() == ""){
						alertify.error("Ingrese el Producto");
						contenedor.find("#OtroProducto:visible").focus();
						validarDatos = false;
						return false;
					}
				} else {
					validarDatos = true;
				}
			}
		
			if(contenedor.find(".verificar").is(":visible") && !$('.verificarMaterial').is('.d-none')){
				if (contenedor.find("#Material:visible").val() == "" || contenedor.find("#Material:visible").val() == null) {
					alertify.error("Ingrese el Material");
					contenedor.find("#Material").focus();
					validarDatos = false;
					return false;
				} else if (contenedor.find("#Material:visible").val() == "otro") {
					if (contenedor.find("#MaterialNombre:visible").val().trim() == ""){
						alertify.error("Ingrese el Material");
						contenedor.find("#MaterialNombre:visible").focus();
						validarDatos = false;
						return false;
					}
				} else {
					validarDatos = true;
				}
			}
	
			if (contenedor.find("#Producidos:visible").val() == "") {
				alertify.error("Ingrese la Cantidad");
				contenedor.find("#Producidos").focus();
				validarDatos = false;
				return false;
			} else {
				validarDatos = true;
			}
	
			if(contenedor.find(".verificar").is(":visible")){
				if (contenedor.find("#Producto:visible option:selected").val() == '' ||
				contenedor.find("#Producto:visible option:selected").val() == null ||
				contenedor.find("#Producto:visible option:selected").val() == 'otro') {
					productosPedido.push({
						ProductoId: 'otro',
						Producto: contenedor.find("#OtroProducto:visible").val(),
						MaterialId: contenedor.find("#Material:visible option:selected").attr("data-id"),
						Material: contenedor.find("#MaterialNombre:visible").val(),
						Producidos: contenedor.find("#Producidos:visible").val()
					});
				} else {
					productosPedido.push({
						ProductoId: contenedor.find("#Producto:visible option:selected").val(),
						Producto:  contenedor.find("#Producto:visible option:selected").text().trim(),
						MaterialId: contenedor.find("#Material:visible option:selected").attr("data-id"),
						Material: contenedor.find("#MaterialNombre:visible").val(),
						Producidos: contenedor.find("#Producidos:visible").val()
					});
				}
			}
		}); */
	
		/* if(!validarDatos){
			return false;
		} */
	
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
	
		//var fd = new FormData($(this)[0]); 
		var form_data = new FormData(document.getElementById("frmRegistrarPQR"));
		//form_data.append('productosPedido', JSON.stringify(productosPedido));
		if ($("#OtroCliente").is(":visible")){
			form_data.append('OtroCliente', $("#OtroCliente").val());
		}
	
		$.ajax({
			url: base_url() + 'Administrativo/PQR/CapturarPQR/crear',
			type:'POST',
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false,
			data:form_data,
			success:function(respuesta) {
				if (respuesta == 0) {
					alertify.error("Registro no guardado");
				} else {
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
								// Si tiene el permiso, me lleva al tramite de la pqr
								if ($permisoTramite == 1) {
									location.href = base_url()+'Administrativo/PQR/TramitarPQR/ConsultarPQR/'+respuesta[0];
								} else {
									location.reload();
								}
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
										// Si tiene el permiso, me lleva al tramite de la pqr
										if ($permisoTramite == 1) {
											location.href = base_url()+'Administrativo/PQR/TramitarPQR/ConsultarPQR/'+respuesta[0];
										} else {
											location.reload();
										}
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
									// Si tiene el permiso, me lleva al tramite de la pqr
									if ($permisoTramite == 1) {
										location.href = base_url()+'Administrativo/PQR/TramitarPQR/ConsultarPQR/'+respuesta[0];
									} else {
										location.reload();
									}
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
		
});

//Validaciones Numeros
function soloNumeros(e) {
	key = e.keyCode || e.which;
	teclado = String.fromCharCode(key);

	numeros = "0123456789";
	especiales = ["8","9","37","38","46"]; //array especiales

	teclado_especial = false;

	for(var i in especiales)
	{
		if(key == especiales[i])
		{
			teclado_especial = true;
		}
	}

	if(numeros.indexOf(teclado) == -1 && !teclado_especial){
		return false;
	}
}

/* function vaciarCampos(){
	$(".contenido_div:not(.principal)").remove();

	$("#Producto option").remove();
	$("#Producto").append(`
		<option value="0" selected disabled>Seleccione</option>
		<option value="otro" data-id="otro">Otro</option>
	`);
	$("#Producto").siblings().addClass('hidden').val('').closest('.my-group').find('.form-control').css('width', '100%');
	$("#Material").siblings().addClass('hidden').val('').closest('.my-group').find('.form-control').css('width', '100%');
	$("#Material option:eq(0)").prop("selected", true);
	$("#Material").prop("disabled", true);

	$("#Producidos").val("");
} */

function productosFact(factura){
	$.ajax({
		url: base_url() + "Administrativo/PQR/CapturarPQR/verificarFactura",
		type: 'POST',
		data: {
			factura: factura
		},
		success: function(respuesta){
			var r = JSON.parse(respuesta);
			var resp = r.dataFactura;
			var respPed = r.dataPedido;
			//$('.verificarMaterial').addClass('d-none');
			if(resp.length > 0){
				//$("#Pedido").val("");
				if(resp[0].terceroid != null){
					$("#checkCliente").prop("checked", true);
					$(".esCliente").removeClass("d-none");
					$(".noEsCliente").addClass("d-none");
					$("#TerceroId").focus();
					$(".TerceroId").val(resp[0].terceroid);
					$(".ClienteNombre").text(resp[0].Cliente);
				} else {
					$(".TerceroId").val("");
					$(".ClienteNombre").val("Cliente");
				}

				//vaciarCampos();
				/* $("#Material").prop("disabled", true);
				for(var i = 0; i < resp.length; i++){
					$(".contenidoValidado #Producto").append(`
						<option value='${resp[i].productoId}' data-cantidad='${parseInt(resp[i].cantidad)}' data-Id='${null}'>${resp[i].producto} (${parseInt(resp[i].cantidad)})</option>`);
				} */

				/* if(respPed.length > 0){
					$("#Pedido").val(respPed[0].Pedido);
				} */
			} else {
				$(".TerceroId").val("");
				$(".ClienteNombre").val("Cliente");

				alertify.warning("La factura digitada no existe");

				//vaciarCampos();
				/* $("#Material option").remove();
				$("#Material").append(`
					<option value="" selected disabled></option>
					<option value="otro" data-id="otro">Otro</option>`
				);

				$("#Material option:eq(0)").prop("selected", true);
				$("#MaterialNombre").val(""); */
			}
		}
	});
}