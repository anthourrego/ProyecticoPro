
var pa = {
	language: {
		"lengthMenu": "Mostrar _MENU_ registros por página.",
		"zeroRecords": "No se ha encontrado ningún registro.",
		"info": "Mostrando página _PAGE_ de _PAGES_",
		"infoEmpty": "Registros no disponibles.",
		"search"   : "",
		searchPlaceholder: "Buscar",
		"loadingRecords": "Cargando...",
		"processing":     "Procesando...",
		"paginate": {
			"first":      "Primero",
			"last":       "Último",
			"next":       "Siguiente",
			"previous":   "Anterior"
		},
		"infoFiltered": "(_MAX_ Registros filtrados en total)"
	}};

	jQuery.fn.selectText = function() {
		var doc = document;
		var element = this[0];
		if (doc.body.createTextRange) {
			var range = document.body.createTextRange();
			range.moveToElementText(element);
			range.select();
		} else if (window.getSelection) {
			var selection = window.getSelection();        
			var range = document.createRange();
			range.selectNodeContents(element);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	};
var selectTiempo = '<select class="form-control contro-input undMedidaTiempo">';
	selectTiempo += '<option></option>';
	selectTiempo += '<option value="001">Dias</option>';
	selectTiempo += '<option value="002">Semanas</option>';
	selectTiempo += '<option value="003">Meses</option>';
	selectTiempo += '<option value="004">Años</option>';
	selectTiempo += '</select>';
var selectTiempoOC;
var selectTipoDatos = '<select class="form-control contro-input tipoDocVehiculo">';
	selectTipoDatos += '<option value="P">Propietario</option>';
	selectTipoDatos += '<option value="C">Conductor</option>';
	selectTipoDatos += '</select>';
var selectUndMedida;

//DECLARO VARIABLES GLOBALES QUE VOY A NECESITAR PARA ACTUALIZAR LAS FICHAS
var idFichaVehiculo;
var idFichaVehiculoOLD;
var idFichaMaquinaria;
var idFichaMaquinariaOLD;
var idFichaEquipo;
var idFichaLocativa;

//INICIALIZO EL DOCUMENT READY PARA OBTENER LA PRIMERA VISTA
$(document).ready(function(){
	$('a[id="fichalistaVehiculo"][data-toggle=tab]').tab('show');
	$(".btnUpInf").not("[data-button=vDB],[data-button=mDB],[data-button=eDB],[data-button=lDB]").click();
	//obtenerUndMedida();
});
	///////////////// ESPACIO PARA LOS EVENTOS DE LOS TAB PANES  /////////////////

		$('a[id="fichalistaVehiculo"][data-toggle=tab]').on('shown.bs.tab', function(e){
			 	var filas = [];
					edicion ='<button class="editarFichaVehiculo btn btn-success btn-xs" value="'+this.id+'" title="Editar documento vigente" style="margin-bottom:3px"><span class="glyphicon glyphicon-pencil" ></span></button>';
					elimina ='<button class="eliminarFichaVehiculo btn btn-danger btn-xs" value="'+this.id+'" title="Eliminar documento vigente" style="margin-bottom:3px"><span class="glyphicon glyphicon-remove" ></span></button>';
					ver ='<button class="verFichaVehiculo btn btn-info btn-xs" value="'+this.id+'" title="Ver documento vigente" style="margin-bottom:3px"><span class="glyphicon glyphicon-search" ></span></button>';

					var fila = {
						0: ver+' '+edicion+' '+elimina,
						1: 'ljv56',
						2: '10/20/2020',
						3: 'felipe perez',
						4: 'Pereira',
						5: 'Centro Producción',
						6: 'Centro Costo',
						7: 'Lavada',
						8: 'Bueno',
						9: '011414141',
						10:'1414141411',
						11:'4444444',
						12:'Particular',
						13:'102020',
						14:'1010100',
						15:'2',
						16:'6',
						17:'si',
						18:'derecha',
						19:'434',
						20:'mecanica',
						21:'6',
						22:'ppp',
						23:'si',
						24:'si',
						25:'18',
						26:'24',
						27:'Aluminio',
						28:'si',
						29:'disco',
						30:'23232332',
						31:'6',
						32:'10 toneladas',
						33:'camion',
						34:'suzuki',
						35:'rojo',
						36: 1010,
						37:'2020',
					};
					filas.push(fila);
			//});
		dtTblListaVehiculo.clear().draw();
		dtTblListaVehiculo.rows.add(filas).draw();
		//});
	});

		$('a[id="fichalistaMaquinariaEquipo"][data-toggle=tab]').on('shown.bs.tab', function(e){
			$("li[id=2]").addClass("hide");
			$("li[id=4]").addClass("hide");
			$("li[id=6]").addClass("hide");
			$("li[id=8]").addClass("hide");
		
				 var filas = [];
		
					edicion ='<button class="editarFichaMaquinaria btn btn-success btn-xs" value="" title="Editar documento vigente" style="margin-bottom:3px"><span class="glyphicon glyphicon-pencil" ></span></button>';
					elimina ='<button class="eliminarFichaMaquinaria btn btn-danger btn-xs" value="" title="Eliminar documento vigente" style="margin-bottom:3px"><span class="glyphicon glyphicon-remove" ></span></button>';
					ver ='<button class="verFichaMaquinaria btn btn-info btn-xs" value="" title="Ver documento vigente" style="margin-bottom:3px"><span class="glyphicon glyphicon-search" ></span></button>';

					var fila = {
						0: ver+' '+edicion+' '+elimina,
						1: 'ljv56',
						2: '10/20/2020',
						3: 'felipe perez',
						4: 'Pereira',
						5: 'Centro Producción',
						6: 'Centro Costo',
						7: 'Lavada',
						8: 'Bueno',
						9: '011414141',
						10:'1414141411',
						11:'4444444',
						12:'Particular',
						13:'102020',
						14:'1010100',
						15:'2',
						16:'6',
						17:'si',
						18:'derecha',
						19:'434',
					};

				
					filas.push(fila);
			
				dtTblListaMaquinaria.clear().draw();
				dtTblListaMaquinaria.rows.add(filas).draw();
		});

		$('a[id="fichalistaEquipoComputo"][data-toggle=tab]').on('shown.bs.tab', function(e){
			
			$("li[id=2]").addClass("hide");
			$("li[id=4]").addClass("hide");
			$("li[id=6]").addClass("hide");
			$("li[id=8]").addClass("hide");
				var filas = [];

					edicion ='<button class="editarFichaEquipoComputo btn btn-success btn-xs" value="'+this.equipocomputoid+'" title="Editar" style="margin-bottom:3px"><span class="glyphicon glyphicon-pencil" ></span></button>';
					elimina ='<button class="eliminarFichaEquipoComputo btn btn-danger btn-xs" value="'+this.equipocomputoid+'" title="Eliminar" style="margin-bottom:3px"><span class="glyphicon glyphicon-remove" ></span></button>';
					ver ='<button class="verFichaEquipoComputo btn btn-info btn-xs" value="'+this.equipocomputoid+'" title="Ver" style="margin-bottom:3px"><span class="glyphicon glyphicon-search" ></span></button>';

					var fila = {
						0: ver+' '+edicion+' '+elimina,
						1: 'ljv56',
						2: '10/20/2020',
						3: 'felipe perez',
						4: 'Pereira',
						5: 'Centro Producción',
						6: 'Centro Costo',
						7: 'Lavada',
						8: 'Bueno',
						9: '011414141',
						10:'1414141411',
						11:'4444444',
						12:'Particular',
						13:'102020',
						14:'1010100',
						15:'2',
						16:'6',
						17:'si',
						18:'derecha',
					};

					filas.push(fila);

				dtTblListaEquipoComputo.clear().draw();
				dtTblListaEquipoComputo.rows.add(filas).draw();
		});

		$('a[id="fichalistaLocativas"][data-toggle=tab]').on('shown.bs.tab', function(e){
			$("li[id=2]").addClass("hide");
			$("li[id=4]").addClass("hide");
			$("li[id=6]").addClass("hide");
			$("li[id=8]").addClass("hide");

			 	var filasL = [];

					edicion ='<button class="editarFichaLocativa btn btn-success btn-xs" value="'+this.locativaid+'" title="Editar" style="margin-bottom:3px"><span class="glyphicon glyphicon-pencil" ></span></button>';
					elimina ='<button class="eliminarFichaLocativa btn btn-danger btn-xs" value="'+this.locativaid+'" title="Eliminar" style="margin-bottom:3px"><span class="glyphicon glyphicon-remove" ></span></button>';
					ver ='<button class="verFichaLocativa btn btn-info btn-xs" value="'+this.locativaid+'" title="Ver" style="margin-bottom:3px"><span class="glyphicon glyphicon-search" ></span></button>';

					var fila = {
						0: ver+' '+edicion+' '+elimina,
						1: 'ljv56',
						2: '10/20/2020',
						3: 'felipe perez',
						4: 'Pereira',
						5: 'Centro Producción',
						6: 'Centro Costo',
						7: 'Lavada',
						8: 'Bueno',
						9: '011414141',
						10:'1414141411',
						11:'4444444',
					};
					filasL.push(fila);
				// });
				dtTblListaLocativa.clear().draw();
				dtTblListaLocativa.rows.add(filasL).draw();
			// });
		});	
	///////////////// FIN ESPACIO EVENTOS DE LOS TABS PANES  /////////////////

	///////////////// ESPACIO PARA LOS EVENTOS DE LOS BOTONES DE CREACION DE FICHAS TECNICAS      /////////////////

		//BOTON CREACION TAB PANE VEHICULO
		$("[id=crearFichaVehivulo]").on("click", function(e){
			e.preventDefault();
			$('a[id="fichalistaVehiculo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaMaquinariaEquipo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaEquipoComputo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaLocativas"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('.nav-tabs a[href="#CRUDvehiculo"]').unbind().on('shown.bs.tab', function(e){
				e.preventDefault();
			
				$("[id=btnCancelarVehiculoEdicion]").addClass("hide");
				$("[id=guardarCambiosVehiculo]").removeClass("hide");
				$("[id=btnCancelarVehiculo]").removeClass("hide");
				$("[id=placaVehiculo]").prop("disabled", false);
				$("[id=placaVehiculo]").val("");
				$("[id=infraestructuraVehiculo]").empty();
				$("[id=sucursalVehiculo]").empty();
				$("[id=procesoVehiculo]").empty();
				var selectVacio = '<option></option>';
				$("li[id=1]").removeClass("active");
				$("li[id=2]").removeClass("hide");
				$("li[id=2]").addClass("active");
			});
			$('.nav-tabs a[href="#CRUDvehiculo"]').tab("show");
		});

		//BOTON CREACION TAB PANE MAQUINARIA EQUIPO
		$("[id=crearMaquinariaEquipo]").on("click", function(e){
			e.preventDefault();
			$('a[id="fichalistaVehiculo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaMaquinariaEquipo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaEquipoComputo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaLocativas"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('.nav-tabs a[href="#CRUDmaquinariaequipo"]').unbind().on('shown.bs.tab', function (e) {
				e.preventDefault();
				innabilitaCamposME();
				$("[id=btnCancelarMaquinariaEquipoEdicion]").addClass("hide");
				$("[id=btnCancelarMaquinariaEquipo]").removeClass("hide");
				$("[id=codigoMaquinariaEquipo]").val("").prop("disabled", false);
				$("[id=guardarCambiosMaquinariaEquipo]").removeClass("hide");
				$("[id=infraestructuraMaquinariaEquipo]").empty();
				$("[id=sucursalMaquinariaEquipo]").empty();
				$("[id=procesoMaquinariaEquipo]").empty();
				$("[id=cUnidadMedidaMaquinariaEquipo]").empty();
				$("[id=cpUndMedidaMaquinariaEquipo]").empty();
				$("[id=mUndMedidaMaquinariaEquipo]").empty();
				$("[clienteInternaMaquinariaEquipo]").empty();
				var selectVacio = '<option></option>';
				$("li[id=3]").removeClass("active");
				$("li[id=4]").removeClass("hide");
				$("li[id=4]").addClass("active");
			});
			$('.nav-tabs a[href="#CRUDmaquinariaequipo"]').tab("show");
		});

		//BOTON CREACION TAB PANE EQUIPO COMPUTO
		$("[id=crearEquipoComputo]").on("click", function(e){
			e.preventDefault();
			$('a[id="fichalistaVehiculo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaMaquinariaEquipo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaEquipoComputo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaLocativas"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('.nav-tabs a[href="#CRUDequipocomputo"]').unbind().on('shown.bs.tab', function (e) {
				e.preventDefault();
				innabilitaCamposEC();
				$("[id=guardarCambiosEquipoComputo]").removeClass("hide");
				$("[id=btnCancelarEdicionEquipoComputo]").addClass("hide");
				$("[id=btnCancelarEquipoComputo]").removeClass("hide");
				$("[id=infraestructuraEquipoComputo]").empty();
				$("[id=sucursalEquipoComputo]").empty();
				$("[id=procesoEquipoComputo]").empty();
				$("[id=proveedorEquipoComputo]").empty();
				$("[clienteInternaEquipoComputo]").empty();
				$("[id=codigoEquipoComputo]").val('').prop("disabled", false);
				var selectVacio = '<option></option>';
				$("li[id=5]").removeClass("active");
				$("li[id=6]").removeClass("hide");
				$("li[id=6]").addClass("active");
			});
			$('.nav-tabs a[href="#CRUDequipocomputo"]').tab("show");
		});

		//BOTON CREACION TAB PANE LOCATIVA
		$("[id=crearLocativa]").on("click", function(e){
			e.preventDefault();
			$('a[id="fichalistaVehiculo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaMaquinariaEquipo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaEquipoComputo"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('a[id="fichalistaLocativas"][data-toggle=tab]').prop("disabled", true).addClass("cursorDisabled");
			$('.nav-tabs a[href="#CRUDlocativas"]').unbind().on('shown.bs.tab', function (e) {
				e.preventDefault();
				inhabilitaCamposLocativa();
				$("[id=infraestructuraLocativa]").empty();
				$("[id=sucursalLocativa]").empty();
				$("[id=procesoLocativa]").empty();
				$("[id=codigoLocativa]").val('').prop("disabled", false);
				var selectVacio = '<option></option>';
				$("li[id=7]").removeClass("active");
				$("li[id=8]").removeClass("hide");
				$("li[id=8]").addClass("active");
			});
			$('.nav-tabs a[href="#CRUDlocativas"]').tab("show");
		});
	///////////////// FIN ESPACIO PARA LOS EVENTOS DE LOS BOTONES DE CREACION DE FICHAS TECNICAS  /////////////////

	$(".btnUpInf").on("click", function(e){
		e.preventDefault();
		if ($(this).find('span').attr('class') == 'glyphicon glyphicon-chevron-down') {
			$(this).find('span').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}else{
			$(this).find('span').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		}
		$('.'+$(this).attr('data-button')+'').fadeToggle('slow');
	});

