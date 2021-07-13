$(function(){
	$("input[type='file']").change(function(){
		if ($(this).data("tipo") == 'logo') {
			leerImg(this);
		} else {
			leerFondo(this);
		}
	});

	$("#eliminarFondo").on("click", function(){
		$.ajax({
			url: base_url() + 'Administrativo/Configuracion/InformacionEmpresa/QuitarFondo',
			type:"POST",
			async		: false,
			data: {
				RASTREO: RASTREO('Quita Fondo del login del conjunto', 'Datos del Conjunto')
			},	
			success:function(respuesta){
				if(respuesta != 1){
					alertify.alert('Error', respuesta, function(){
						this.destroy();
					});
				}else{
					$("#fondo").closest('div').css('background-image', ("url('')"));
					$("#eliminarFondo").addClass("d-none");
				}
			}
		});
	});

	$(".chosen-select").chosen();

	$('select[multiple]').chosen({
		placeholder_text_multiple:　'Seleccione'
		,no_results_text: 'Oops, no se encuentra'
	});
	
	if($Empresa.length > 0) {
		$('form [id]').each(function(){
			if($(this).is('select')){
				var RespoFisca = $Empresa[0][$(this).attr('id')];
				RespoFisca = RespoFisca.split(';');
				$(this).val(RespoFisca).attr('data-anterior', $Empresa[0][$(this).attr('id')]).trigger('chosen:updated');
			}else{
				$(this).val($Empresa[0][$(this).attr('id')]).attr('data-anterior', $Empresa[0][$(this).attr('id')]);
				if($(this).attr('data-foranea')){
					$(this).val($Empresa[0][$(this).attr('id')]).attr('data-anterior', $Empresa[0][$(this).attr('id')]);
					$(this).closest('.input-group').find('span').text($Empresa[0][$(this).attr('id') + 'Nombre']).attr('title', $Empresa[0][$(this).attr('id') + 'Nombre']);
				}
			}
		});
	}

	$('[data-db]').change(function(){
		var actualizar = actualizarDB($(this).attr('id'), $(this).val(), $(this).attr('data-anterior'));
		if(actualizar == 1){
			if($(this).attr('id') == 'nit'){
				$('[id=digitverif]').val(calcularDigitoVerificacion($(this).val())).change();
			}
		}
	});

	alertify.myAlert || alertify.dialog('myAlert',function factory(){
		return {
			main:function(content){
				this.setContent(content);
			},
			setup:function(){
				return {
					options:{
						maximizable:false,
						resizable:false,
						padding:false,
						title: 'Búsqueda'
					}
				};
			},
		};
	});
	
	$('[data-foranea]').change(function(){
		var self = this;
		var $Campo = $(this).attr('id');
		var $Valor = $(this).val();
		var $ValorAnterior = $(this).attr('data-anterior');
		var $tabla = $(self).attr('data-foranea');
		var $nombre = $(self).attr('data-foranea-codigo');
		if($Valor != ''){
			$.ajax({
				url: base_url() + "Administrativo/Configuracion/InformacionEmpresa/CargarForanea",
				type: 'POST',
				data: {
					tabla : $tabla,
					value : $Valor,
					nombre: $nombre
				},
				async: false,
				success: function(respuesta){
					if(respuesta == 0){
						$('[id='+$Campo+']').val($ValorAnterior);
						alertify.ajaxAlert = function(url){
							$.ajax({
								url: url,
								async: false,
								success: function(data){
									alertify.myAlert().set({
										onclose:function(){
											alertify.myAlert().set({onshow:null});
											$(".ajs-modal").unbind();
											delete alertify.ajaxAlert;
											$("#tblBusqueda").unbind().remove();
										},onshow:function(){
	
										}
									});
	
									alertify.myAlert(data);
	
									var $tblID = '#tblBusqueda';
									var config = {
										data:{
											tblID : $tblID,
											select: [
												$nombre + " codigo"
												,"nombre"
											],
											table : [
												$tabla
											],
											column_order : [
												$nombre
												,"nombre"
											],
											column_search : [
												$nombre
												,"nombre"
											],
											orden : {
												'nombre': 'asc'
											},
											columnas : [
												"codigo"
												,"nombre"
											]
										},
										bAutoWidth: false,
										processing: true,
										serverSide: true,
										columnDefs: [
											{targets: [0], width: '1%'},
										],
										order: [],
										ordering: false,
										draw: 10,
										language: {
											lengthMenu: "Mostrar _MENU_ registros por página.",
											zeroRecords: "No se ha encontrado ningún registro.",
											info: "Mostrando _START_ a _END_ de _TOTAL_ entradas.",
											infoEmpty: "Registros no disponibles.",
											search   : "",
											searchPlaceholder: "Buscar",
											loadingRecords: "Cargando...",
											processing:     "Procesando...",
											paginate: {
												first:      "Primero",
												last:       "Último",
												next:       "Siguiente",
												previous:   "Anterior"
											},
											infoFiltered: "(_MAX_ Registros filtrados en total)"
										},
										pageLength: 10,
										initComplete: function(){
											setTimeout(function(){
												$('div.dataTables_filter input').focus();
												$('body').scrollTo('div.dataTables_filter input');
											},500);
											$('div.dataTables_filter input')
											.unbind()
											.change(function(e){
												e.preventDefault();
												table = $("body").find($tblID).dataTable();
												table.fnFilter( this.value );
											});
										},
										oSearch: { sSearch: $Valor },
										createdRow: function(row,data,dataIndex){
											$(row).click(function(){
												$(self).val(data[0]).change();
												alertify.myAlert().close();
											});
										},
										deferRender: true,
										scrollY: $(document).height() - 225,
										scroller: {
											loadingIndicator: true
										},
										dom: 'ftri'
									}
									dtSS(config);
								}
							});
						}
						alertify.ajaxAlert(base_url()+"Busqueda/DataTable");
					}else{
						respuesta = JSON.parse(respuesta);
						var actualizar = actualizarDB($Campo, $Valor, $ValorAnterior);
						if(actualizar == 1){
							$(self).closest('.input-group').find('span').text(respuesta[0]['nombre']).attr('title', respuesta[0]['nombre']);
						}
					}
				}
				,error:function(){
					$('[id='+$Campo+']').val($ValorAnterior);
				}
			});
		}else{
			actualizarDB($Campo, $Valor, $ValorAnterior);
			$(self).closest('.input-group').find('span').text('').attr('title', '');
		}
	});
	
	$('#RespoFisca').change(function(){
		var RespoFisca = $(this).val();
		RespoFisca = RespoFisca.join(';');
		var Anterior = $(this).attr('data-anterior');
		if(RespoFisca.length > $(this).attr('maxlength')){
			Anterior = Anterior.split(';');
			$(this).val(Anterior).trigger('chosen:updated');
		}else{
			var actualizar = actualizarDB($(this).attr('id'), RespoFisca, Anterior);
			if(actualizar == 0){
				Anterior = Anterior.split(';');
				$(this).val(Anterior).trigger('chosen:updated');
			}
		}
	});
});

function actualizarDB($Campo, $Valor, $ValorAnterior){
	var $return = 0;
	if($Valor != $ValorAnterior){
		$.ajax({
			url: base_url() + 'Administrativo/Configuracion/InformacionEmpresa/ActualizarBD',
			type: 'POST',
			async: false,
			data: {
				campo 				: $Campo
				,valor 				: $Valor
				,valorAnterior 		: $ValorAnterior
				,RASTREO 			: RASTREO('Modifica '+$('[for='+$Campo+']').text()+' '+$ValorAnterior+' -> '+$Valor, 'Información del Hotel')
			}
			,success:function(res){
				if(res != 1){
					alertify.alert('Error', 'No se pudo actualizar el campo en la base de datos');
				}else{
					$('[id='+$Campo+']').attr('data-anterior', $Valor);
					$return = 1;
				}
			},error:function(){
				$('[id='+$Campo+']').val($ValorAnterior);
			}
		});
	}else{
		$return = 1;
	}
	return $return;
}

function calcularDigitoVerificacion ( myNit ) {

	var vpri,

	x,

	y,

	z;

	myNit = myNit.replace ( /\s/g, "" ) ; // Espacios

	myNit = myNit.replace ( /,/g, "" ) ; // Comas

	myNit = myNit.replace ( /\./g, "" ) ; // Puntos

	myNit = myNit.replace ( /-/g, "" ) ; // Guiones

	if ( isNaN ( myNit ) ) {

		console.log ("El nit/cédula '" + myNit + "' no es válido(a).") ;

		return "" ;

	};

	vpri = new Array(16) ;

	z = myNit.length ;

	vpri[1] = 3 ;

	vpri[2] = 7 ;

	vpri[3] = 13 ;

	vpri[4] = 17 ;

	vpri[5] = 19 ;

	vpri[6] = 23 ;

	vpri[7] = 29 ;

	vpri[8] = 37 ;

	vpri[9] = 41 ;

	vpri[10] = 43 ;

	vpri[11] = 47 ;

	vpri[12] = 53 ;

	vpri[13] = 59 ;

	vpri[14] = 67 ;

	vpri[15] = 71 ;

	x = 0 ;
	y = 0 ;

	for ( var i = 0; i < z; i++ ) {
		y = ( myNit.substr (i, 1 ) ) ;
		x += ( y * vpri [z-i] ) ;
	}

	y = x % 11 ;

	return ( y > 1 ) ? 11 - y : y ;
}

function leerImg(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var background = e.target.result;
			$(input).closest('form').off('submit').on('submit',function(e){
				e.preventDefault();
				if(typeof FormData !== 'undefined'){
					var rastreo = RASTREO('Modifica Logotipo Corporativo', 'Información del Hotel');
					var form_data = new FormData();
					form_data.append('Lista_Anexos', $(input)[0].files[0]);
					form_data.append('cambio', rastreo.cambio);
					form_data.append('fecha', rastreo.fecha);
					form_data.append('programa', rastreo.programa);
					$.ajax({
						url: base_url() + 'Administrativo/Configuracion/InformacionEmpresa/ActualizarImagen',
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
								$(input).closest('div').css('background-image', ("url('"+background+"')"));
							}
						}
					});
				}
			});
			$(input).closest('form').submit();
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function leerFondo(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var background = e.target.result;
			$(input).closest('form').off('submit').on('submit',function(e){
				e.preventDefault();
				if(typeof FormData !== 'undefined'){
					var rastreo = RASTREO('Actualiza Fondo del login del conjunto', 'Datos del Conjunto');
					var form_data = new FormData();
					form_data.append('Lista_Anexos', $(input)[0].files[0]);
					form_data.append('cambio', rastreo.cambio);
					form_data.append('fecha', rastreo.fecha);
					form_data.append('programa', rastreo.programa);
					$.ajax({
						url: base_url() + 'Administrativo/Configuracion/InformacionEmpresa/ActualizarFondo',
						type:"POST",
						async		: false,
						cache		: false,
						contentType : false,
						processData : false,
						data:form_data,	
						success:function(respuesta){
							if(respuesta != 1){
								alertify.alert('Error', respuesta, function(){
									this.destroy();
								});
							}else{
								$(input).closest('div').css('background-image', ("url('"+background+"')"));
								$("#eliminarFondo").removeClass("d-none");
							}
						}
					});
				}
			});
			$(input).closest('form').submit();
		}
		reader.readAsDataURL(input.files[0]);
	}
}
