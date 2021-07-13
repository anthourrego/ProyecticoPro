//CODIGO CREADO EN SU TOTALIDAD POR JOSE DAVID SANZ MARTINEZ 19/12/2018

//DATATABLES DE INFORME DETALLADO
	var dtTblVehiculoID = $('#TblVehiculoID').DataTable({
		language: pa.language,
		processing: true,
		pageLength: 10,
			columnDefs: [
			{	targets: [9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37],
				visible: false},
			],
			dom: 'lBfrtip',
			buttons: [
			{ extend: 'colvis', text: 'Visualización columnas'},
			{ extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions:{columns: ':visible'} },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions:{columns: ':visible'} },
			{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions:{columns: ':visible'} }
			],
			createdRow: function(row, data, dataIndex){
			}
	});
	$("[id=TblVehiculoID] thead").addClass("thTDocs");
	$("[id=TblVehiculoID]").DataTable();
	$("[id=TblVehiculoID] tbody").addClass("tdTDocs");

	var dtTblMaquinariaIDNoProsof = $('#TblMaquinariaIDNoProsof').DataTable({
		language: pa.language,
		processing: true,
		pageLength: 10,
				columnDefs: [
					{targets: [8,9,10,11,12,13,14,15,16,17,18],
					visible: false},
				],
				dom: 'lBfrtip',
				buttons: [
				{ extend: 'colvis', text: 'Visualización columnas'},
				{ extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions:{columns: ':visible'} },
				{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions:{columns: ':visible'} },
				{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions:{columns: ':visible'} }
				],
				createdRow: function(row, data, dataIndex){
				}
			});
	$("[id=TblMaquinariaIDNoProsof] thead").addClass("thTDocs");
	$("[id=TblMaquinariaIDNoProsof]").DataTable();
	$("[id=TblMaquinariaIDNoProsof] tbody").addClass("tdTDocs");

	var dtTblMaquinariaIDSiProsof = $('#TblMaquinariaIDSiProsof').DataTable({
		language: pa.language,
		processing: true,
		pageLength: 10,
				columnDefs: [
				{	targets: [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28],
					visible: false},
				],
				dom: 'lBfrtip',
				buttons: [
				{ extend: 'colvis', text: 'Visualización columnas'},
				{ extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions:{columns: ':visible'} },
				{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions:{columns: ':visible'} },
				{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions:{columns: ':visible'} }
				],
				createdRow: function(row, data, dataIndex){
				}
			});
	$("[id=TblMaquinariaIDSiProsof] thead").addClass("thTDocs");
	$("[id=TblMaquinariaIDSiProsof]").DataTable();
	$("[id=TblMaquinariaIDSiProsof] tbody").addClass("tdTDocs");

	var dtTblEquipoComputoIDNoProsof = $('#TblEquipoComputoIDNoProsof').DataTable({
		language: pa.language,
		processing: true,
		pageLength: 10,
				columnDefs: [
				{	targets: [8,9,10,11,12,13,14,15,16,17],
					visible: false},
				],
				dom: 'lBfrtip',
				buttons: [
				{ extend: 'colvis', text: 'Visualización columnas'},
				{ extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions:{columns: ':visible'} },
				{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions:{columns: ':visible'} },
				{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions:{columns: ':visible'} }
				],
				createdRow: function(row, data, dataIndex){
				}
			});
	$("[id=TblEquipoComputoIDNoProsof] thead").addClass("thTDocs");
	$("[id=TblEquipoComputoIDNoProsof]").DataTable();
	$("[id=TblEquipoComputoIDNoProsof] tbody").addClass("tdTDocs");

	var dtTblEquipoComputoIDSiProsof = $('#TblEquipoComputoIDSiProsof').DataTable({
		language: pa.language,
		processing: true,
		pageLength: 10,
				columnDefs: [
				{	targets: [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26],
					visible: false},
				],
				dom: 'lBfrtip',
				buttons: [
				{ extend: 'colvis', text: 'Visualización columnas'},
				{ extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions:{columns: ':visible'} },
				{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions:{columns: ':visible'} },
				{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions:{columns: ':visible'} }
				],
				createdRow: function(row, data, dataIndex){
				}
			});
	$("[id=TblEquipoComputoIDSiProsof] thead").addClass("thTDocs");
	$("[id=TblEquipoComputoIDSiProsof]").DataTable();
	$("[id=TblEquipoComputoIDSiProsof] tbody").addClass("tdTDocs");

	var dtTblLocativaID = $('#TblLocativaID').DataTable({
		language: pa.language,
		processing: true,
		pageLength: 10,
				columnDefs: [
				{	targets: [7,8,9,10],
					visible: false},
				],
				dom: 'lBfrtip',
				buttons: [
				{ extend: 'colvis', text: 'Visualización columnas'},
				{ extend: 'excel', className: 'excelButton', text: 'Excel', exportOptions:{columns: ':visible'} },
				{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions:{columns: ':visible'} },
				{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions:{columns: ':visible'} }
				],
				createdRow: function(row, data, dataIndex){
				}
			});
	$("[id=TblLocativaID] thead").addClass("thTDocs");
	$("[id=TblLocativaID]").DataTable();
	$("[id=TblLocativaID] tbody").addClass("tdTDocs");

	$('a[id="crearInformeIndividual"][data-toggle=tab]').on('shown.bs.tab', function (e) {
		$("li[id=2]").addClass("hide");
		$("li[id=4]").addClass("hide");
		$("li[id=6]").addClass("hide");
		$("li[id=8]").addClass("hide");
		$("[id=vehiculoInfD]").addClass("hide");
		$("[id=maquinariaInfDNoProsof]").addClass("hide");
		$("[id=maquinariaInfDSiProsof]").addClass("hide");
		$("[id=equipoInfD]").addClass("hide");
		$("[id=locativaInfD]").addClass("hide");
		$("[id=tipoFichaInformeD]").val("");
	});

	$('a[id="crearInformeDetalladoEncabezado"][data-toggle=tab]').on('shown.bs.tab', function (e) {
		$("[id=divInformeEncabezado]").addClass("hide");
		$("[id=tablaInformeDEnca] tbody").empty();
		$("[id=btnGenerarInfD]").prop("disabled",true);
		$("[id=btnImprimirInfD]").prop("disabled",true);
		$("[id=tipoFichaInformeDEnc]").val("");
	});

	$("[id=tipoFichaInformeD]").on("change",function(){
		if ($(this).val() == "001") {
			var filas = [];
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$(this).val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var tipoV = "";
				$.each(datos,function(){
					if (this.desvinculado == 'V') {
						tipoV = 'Activo';
					}else{
						tipoV = 'Inactivo';
					}
					var fila = {
						0: this.Codigo,
						1: this.Placa,
						2: this.Fechaaprobacion,
						3: this.nombreInfraestructura,
						4: this.nombreSucursal,
						5: this.nombreCT,
						6: this.nombreCC,
						7: this.nombreP,
						8: tipoV,
						9: this.Numchasis,
						10:this.Nummotor,
						11:this.Cilindraje,
						12:this.usovehiculo,
						13:this.Numinterno,
						14:this.numlicenciatrans,
						15:this.cantvalvulas,
						16:this.canticilindros,
						17:this.Turbo,
						18:this.Orientacion,
						19:this.tipodireccion,
						20:this.Tipotransmision,
						21:this.numvelocidades,
						22:this.Tiporodamiento,
						23:this.Suspendelantera,
						24:this.Suspentrasera,
						25:this.numllantas,
						26:this.Dimenrines,
						27:this.materialrines,
						28:this.tipofrenosdel,
						29:this.tipofrenostras,
						30:this.Numseriecarroce,
						31:this.Numventanas,
						32:this.Capcargapasajeros,
						33:this.Linea,
						34:this.Marca,
						35:this.tipo,
						36:this.Color,
						37:this.modelo
					}
					filas.push(fila);
				});
				dtTblVehiculoID.clear().draw();
				dtTblVehiculoID.rows.add(filas).draw();
			});
			$("[id=vehiculoInfD]").removeClass("hide");
			$("[id=maquinariaInfDNoProsof]").addClass("hide");
			$("[id=maquinariaInfDSiProsof]").addClass("hide");
			$("[id=equipoInfDNoProsof]").addClass("hide");
			$("[id=equipoInfDSiProsof]").addClass("hide");
			$("[id=equipoInfD]").addClass("hide");
			$("[id=locativaInfD]").addClass("hide");
		}else if ($(this).val() == "002") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$(this).val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var filas = [];
				if (datos.esProsof == "no") { 
					$.each(datos.info,function(){
						var estado = "";
						if (this.estado == 'A') {
							estado = "Activo";
						}else{
							estado = "Inactivo";
						}
						var fila = {
							0:  this.codigo,
							1:  this.fechaaprobacion,
							2:  this.nombreInfraestructura,
							3:  this.nombreSucursal,
							4:  this.nombreCT,
							5:  this.nombreCC,
							6:  this.nombreP,
							7:  estado,
      						8:  this.nombre,
      						9:  this.reponuso,
      						10: this.responoperacion,
      						11: this.ubicacion,
      						12: this.marcar,
      						13: this.modelo,
      						14: this.serial,
      						15: this.codactifijo,
      						16: this.tolerancia,
      						17: this.fechacompra,
      						18: this.caracteristica
						};
						filas.push(fila);
					});
					dtTblMaquinariaIDNoProsof.clear().draw();
					dtTblMaquinariaIDNoProsof.rows.add(filas).draw();
					$("[id=vehiculoInfD]").addClass("hide");
					$("[id=maquinariaInfDNoProsof]").removeClass("hide");
					$("[id=maquinariaInfDSiProsof]").addClass("hide");
					$("[id=equipoInfDNoProsof]").addClass("hide");
					$("[id=equipoInfDSiProsof]").addClass("hide");
					$("[id=locativaInfD]").addClass("hide");
				}else{
					$.each(datos.info,function(){
						var estado = "";
						if (this.estado == 'A') {
							estado = "Activo";
						}else{
							estado = "Inactivo";
						}
						var fila = {
							0:  this.codigo,
							1:  this.fechaaprobacion,
							2:  this.nombreInfraestructura,
							3:  this.nombreSucursal,
							4:  this.nombreCT,
							5:  this.nombreCC,
							6:  this.nombreP,
							7:  estado,
      						8:  this.nombre,
      						9:  this.reponuso,
      						10: this.responoperacion,
      						11: this.ubicacion,
      						12: this.marcar,
      						13: this.modelo,
      						14: this.serial,
      						15: this.codactifijo,
      						16: this.tolerancia,
      						17: this.fechacompra,
      						18: this.caracteristica,
      						19: this.fechaInicio,
      						20: this.fechaFin,
      						21: this.periodicidad,
      						22: this.nombreCliente,
      						23: this.procesador,
      						24: this.discoDuro,
      						25: this.memoria,
      						26: this.ups,
      						27: this.ubicacionEquipo,
      						28: this.sucursal
						};
						filas.push(fila);
					});
					dtTblMaquinariaIDSiProsof.clear().draw();
					dtTblMaquinariaIDSiProsof.rows.add(filas).draw();
					$("[id=vehiculoInfD]").addClass("hide");
					$("[id=maquinariaInfDNoProsof]").addClass("hide");
					$("[id=maquinariaInfDSiProsof]").removeClass("hide");
					$("[id=equipoInfDNoProsof]").addClass("hide");
					$("[id=equipoInfDSiProsof]").addClass("hide");
					$("[id=locativaInfD]").addClass("hide");
				}
			});
		}else if ($(this).val() == "003") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$(this).val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var filas = [];
				if (datos.esProsof == "no") {
					$.each(datos.info,function(){
						var estado = "";
						if (this.estado == 'a' || this.estado == 'A') {
							estado = "Activo";
						}else{
							estado = "Inactivo";
						}
						var fila = {
							0: this.codigo,
							1: this.fechaaprobacion,
							2: this.nombreInfraestructura,
							3: this.nombreSucursal,
							4: this.nombreCT,
							5: this.nombreCC,
							6: this.nombreP,
							7: estado,
							8: this.nombreProvee,
							9: this.marca,
							10: this.modelo,
							11: this.serial,
							12: this.fecharegistro,
							13: this.tipocomputo,
							14: this.condiciones,
							15: this.color,
							16: this.fechacompra,
							17: this.observacion
						};
						filas.push(fila);
					});
					dtTblEquipoComputoIDNoProsof.clear().draw();
					dtTblEquipoComputoIDNoProsof.rows.add(filas).draw();
					$("[id=vehiculoInfD]").addClass("hide");
					$("[id=maquinariaInfDNoProsof]").addClass("hide");
					$("[id=maquinariaInfDSiProsof]").addClass("hide");
					$("[id=equipoInfDNoProsof]").removeClass("hide");
					$("[id=equipoInfDSiProsof]").addClass("hide");
					$("[id=locativaInfD]").addClass("hide");
				}else{
					$.each(datos.info,function(){
						var estado = "";
						if (this.estado == 'a' || this.estado == 'A') {
							estado = "Activo";
						}else{
							estado = "Inactivo";
						}
						var fila = {
							0: this.codigo,
							1: this.fechaaprobacion,
							2: this.nombreInfraestructura,
							3: this.nombreSucursal,
							4: this.nombreCT,
							5: this.nombreCC,
							6: this.nombreP,
							7: estado,
							8: this.nombreProvee,
							9: this.marca,
							10: this.modelo,
							11: this.serial,
							12: this.fecharegistro,
							13: this.tipocomputo,
							14: this.condiciones,
							15: this.color,
							16: this.fechacompra,
							17: this.observacion,
							18: this.fechaInicio,
							19: this.fechaFin,
							20: this.periodicidad,
							21: this.nombreCliente,
							22: this.procesador,
							23: this.discoDuro,
							24: this.memoria,
							25: this.ups,
							26: this.ubicacion,
							27: this.sucursal
						};
						filas.push(fila);
					});
					dtTblEquipoComputoIDSiProsof.clear().draw();
					dtTblEquipoComputoIDSiProsof.rows.add(filas).draw();
					$("[id=vehiculoInfD]").addClass("hide");
					$("[id=maquinariaInfDNoProsof]").addClass("hide");
					$("[id=maquinariaInfDSiProsof]").addClass("hide");
					$("[id=equipoInfDNoProsof]").addClass("hide");
					$("[id=equipoInfDSiProsof]").removeClass("hide");
					$("[id=locativaInfD]").addClass("hide");
				}
			});
		}else if ($(this).val() == "004") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$(this).val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var filas = [];
				$.each(datos,function(){
					var fila = {
						0: this.codigo,
						1: this.fecharegistro,
						2: this.nombreInfraestructura,
						3: this.nombreSucursal,
						4: this.nombreCT,
						5: this.nombreCC,
						6: this.nombreP,
						7: this.descripcion,
						8: this.estructura,
						9: this.area,
						10: this.accesorios
					};
					filas.push(fila);
				});
				dtTblLocativaID.clear().draw();
				dtTblLocativaID.rows.add(filas).draw();
			});
			$("[id=vehiculoInfD]").addClass("hide");
			$("[id=maquinariaInfDNoProsof]").addClass("hide");
			$("[id=maquinariaInfDSiProsof]").addClass("hide");
			$("[id=equipoInfDNoProsof]").addClass("hide");
			$("[id=equipoInfDSiProsof]").addClass("hide");
			$("[id=locativaInfD]").removeClass("hide");
		}else if ($(this).val() == ""){
			$("[id=vehiculoInfD]").addClass("hide");
			$("[id=maquinariaInfDNoProsof]").addClass("hide");
			$("[id=maquinariaInfDSiProsof]").addClass("hide");
			$("[id=equipoInfDNoProsof]").addClass("hide");
			$("[id=equipoInfDSiProsof]").addClass("hide");
			$("[id=locativaInfD]").addClass("hide");
		}
	});
	
	$("[id=tipoFichaInformeDEnc]").on("change",function(){
		if ($(this).val() != "") {
			$("[id=btnGenerarInfD]").prop("disabled",false);
		}else{
			$("[id=btnGenerarInfD]").prop("disabled",true);
			$("[id=btnImprimirInfD]").prop("disabled",true);
		}
	});

	$("[id=btnGenerarInfD]").on("click",function(e){
		e.preventDefault();
		if ($("[id=tipoFichaInformeDEnc]").val() == "001") {
			var filas = [];
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$("[id=tipoFichaInformeDEnc]").val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var tipoV = "";
				var tabla = '<td colspan="3"><table class="table-responsive table-bordered tbl-border col-md-12" id="tablaFichasALL">'+
				'<thead>'+
				'<tr>'+
				'<th style="width:148px">Placa</th>'+
				'<th style="width:148px">Código</th>'+
				'<th style="width:147px">Fecha registro</th>'+
				'<th style="width:197px">Infraestructura</th>'+
				'<th style="width:197px">Sucursal</th>'+
				'<th style="width:197px">Centro de trabajo</th>'+
				'<th style="width:148px">Centro de costos</th>'+
				'<th style="width:148px">Proceso</th>'+
				'<th style="width:148px">Estado</th>'+
				'</tr>'+
				'</thead>'+
				'<tbody>';
				$.each(datos,function(){
					var sema;
					var tipoOpe = '';
					if (this.desvinculado == 'V') {
						tipoV = 'Activo';
					}else{
						tipoV = 'Inactivo';
					}
					tabla += '<tr>'+
					'<td>'+this.Codigo+'</td>'+
					'<td>'+this.Placa+'</td>'+
					'<td>'+this.Fechaaprobacion+'</td>'+
					'<td>'+this.nombreInfraestructura+'</td>'+
					'<td>'+this.nombreSucursal+'</td>'+
					'<td>'+this.nombreCT+'</td>'+
					'<td>'+this.nombreCC+'</td>'+
					'<td>'+this.nombreP+'</td>'+
					'<td>'+tipoV+'</td>'+
					'</tr>';
				});
				tabla += '</td></tbody>';
				$("[id=divInformeEncabezado]").removeClass("hide");
				$("[id=tablaInformeDEnca] tbody").empty();
				var label = $("[id=TextoEncabezadoInfEnc]").text();
				if (label == "Informe ficha tecnica") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica","Informe ficha tecnica vehículo"));
				}
				if (label == "Informe ficha tecnica maquinaria") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica maquinaria","Informe ficha tecnica vehículo"));
				}
				if (label == "Informe ficha tecnica equipo computo") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica equipo computo","Informe ficha tecnica vehículo"));
				}
				if (label == "Informe ficha tecnica locativa") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica locativa","Informe ficha tecnica vehículo"));
				}
				$("[id=tablaInformeDEnca] tbody").append(tabla);
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] th").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"text-align":"center"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"padding":"3px"});
				$("[id=btnImprimirInfD]").prop("disabled",false);
			});
		}else if ($("[id=tipoFichaInformeDEnc]").val() == "002") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$("[id=tipoFichaInformeDEnc]").val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var filas = [];
				var tabla = '<td colspan="3"><table class="table-responsive table-bordered tbl-border col-md-12" id="tablaFichasALL">'+
				'<thead>'+
				'<tr>'+
				'<th style="width:148px">Código</th>'+
				'<th style="width:147px">Fecha registro</th>'+
				'<th style="width:197px">Infraestructura</th>'+
				'<th style="width:197px">Sucursal</th>'+
				'<th style="width:197px">Centro de trabajo</th>'+
				'<th style="width:148px">Centro de costos</th>'+
				'<th style="width:148px">Proceso</th>'+
				'<th style="width:148px">Estado</th>'+
				'</tr>'+
				'</thead>'+
				'<tbody>';
				$.each(datos.info,function(){
					var sema;
					var tipoOpe = '';
					if (this.estado == 'A') {
						estado = "Activo";
					}else{
						estado = "Inactivo";
					}
					tabla += '<tr>'+
					'<td>'+this.codigo+'</td>'+
					'<td>'+this.fechaaprobacion+'</td>'+
					'<td>'+this.nombreInfraestructura+'</td>'+
					'<td>'+this.nombreSucursal+'</td>'+
					'<td>'+this.nombreCT+'</td>'+
					'<td>'+this.nombreCC+'</td>'+
					'<td>'+this.nombreP+'</td>'+
					'<td>'+estado+'</td>'+
					'</tr>';
				});
				tabla += '</td></tbody>';
				$("[id=divInformeEncabezado]").removeClass("hide");
				$("[id=tablaInformeDEnca] tbody").empty();
				var label = $("[id=TextoEncabezadoInfEnc]").text();
				if (label == "Informe ficha tecnica") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica","Informe ficha tecnica maquinaria"));
				}
				if (label == "Informe ficha tecnica vehículo") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica vehículo","Informe ficha tecnica maquinaria"));
				}
				if (label == "Informe ficha tecnica equipo computo") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica equipo computo","Informe ficha tecnica maquinaria"));
				}
				if (label == "Informe ficha tecnica locativa") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica locativa","Informe ficha tecnica maquinaria"));
				}
				$("[id=tablaInformeDEnca] tbody").append(tabla);
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] th").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"text-align":"center"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"padding":"3px"});
				$("[id=btnImprimirInfD]").prop("disabled",false);
			});
		}else if ($("[id=tipoFichaInformeDEnc]").val() == "003") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$("[id=tipoFichaInformeDEnc]").val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var filas = [];
				var tabla = '<td colspan="3"><table class="table-responsive table-bordered tbl-border col-md-12" id="tablaFichasALL">'+
				'<thead>'+
				'<tr>'+
				'<th style="width:148px">Código</th>'+
				'<th style="width:147px">Fecha registro</th>'+
				'<th style="width:197px">Infraestructura</th>'+
				'<th style="width:197px">Sucursal</th>'+
				'<th style="width:197px">Centro de trabajo</th>'+
				'<th style="width:148px">Centro de costos</th>'+
				'<th style="width:148px">Proceso</th>'+
				'<th style="width:148px">Estado</th>'+
				'</tr>'+
				'</thead>'+
				'<tbody>';
				$.each(datos.info,function(){
					var estado = "";
					if (this.estado == 'a' || this.estado == 'A') {
						estado = "Activo";
					}else{
						estado = "Inactivo";
					}
					tabla += '<tr>'+
					'<td>'+this.codigo+'</td>'+
					'<td>'+this.fechaaprobacion+'</td>'+
					'<td>'+this.nombreInfraestructura+'</td>'+
					'<td>'+this.nombreSucursal+'</td>'+
					'<td>'+this.nombreCT+'</td>'+
					'<td>'+this.nombreCC+'</td>'+
					'<td>'+this.nombreP+'</td>'+
					'<td>'+estado+'</td>'+
					'</tr>';
				});
				tabla += '</td></tbody>';
				$("[id=divInformeEncabezado]").removeClass("hide");
				$("[id=tablaInformeDEnca] tbody").empty();
				var label = $("[id=TextoEncabezadoInfEnc]").text();
				if (label == "Informe ficha tecnica") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica","Informe ficha tecnica equipo computo"));
				}
				if (label == "Informe ficha tecnica vehículo") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica vehículo","Informe ficha tecnica equipo computo"));
				}
				if (label == "Informe ficha tecnica maquinaria") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica maquinaria","Informe ficha tecnica equipo computo"));
				}
				if (label == "Informe ficha tecnica locativa") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica locativa","Informe ficha tecnica equipo computo"));
				}
				$("[id=tablaInformeDEnca] tbody").append(tabla);
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] th").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"text-align":"center"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"padding":"3px"});
				$("[id=btnImprimirInfD]").prop("disabled",false);
			});
		}else if ($("[id=tipoFichaInformeDEnc]").val() == "004") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeDetalleFicha",{Tipo:$("[id=tipoFichaInformeDEnc]").val()},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var filas = [];
				var tabla = '<td colspan="3"><table class="table-responsive table-bordered tbl-border col-md-12" id="tablaFichasALL">'+
				'<thead>'+
				'<tr>'+
				'<th style="width:148px">Código</th>'+
				'<th style="width:147px">Fecha registro</th>'+
				'<th style="width:197px">Infraestructura</th>'+
				'<th style="width:197px">Sucursal</th>'+
				'<th style="width:197px">Centro de trabajo</th>'+
				'<th style="width:148px">Centro de costos</th>'+
				'<th style="">Proceso</th>'+
				'</tr>'+
				'</thead>'+
				'<tbody>';
				$.each(datos,function(){
					
					tabla += '<tr>'+
					'<td>'+this.codigo+'</td>'+
					'<td>'+this.fechaaprobacion+'</td>'+
					'<td>'+this.nombreInfraestructura+'</td>'+
					'<td>'+this.nombreSucursal+'</td>'+
					'<td>'+this.nombreCT+'</td>'+
					'<td>'+this.nombreCC+'</td>'+
					'<td>'+this.nombreP+'</td>'+
					'</tr>';
				});
				tabla += '</td></tbody>';
				$("[id=divInformeEncabezado]").removeClass("hide");
				$("[id=tablaInformeDEnca] tbody").empty();
				var label = $("[id=TextoEncabezadoInfEnc]").text();
				if (label == "Informe ficha tecnica") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica","Informe ficha tecnica locativa"));
				}
				if (label == "Informe ficha tecnica vehículo") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica vehículo","Informe ficha tecnica locativa"));
				}
				if (label == "Informe ficha tecnica maquinaria") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica maquinaria","Informe ficha tecnica locativa"));
				}
				if (label == "Informe ficha tecnica equipo computo") {
					$("[id=TextoEncabezadoInfEnc]").text(label.replace("Informe ficha tecnica equipo computo","Informe ficha tecnica locativa"));
				}
				$("[id=tablaInformeDEnca] tbody").append(tabla);
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] th").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"border":"1px solid #4894d7"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"text-align":"center"});
				$("[id=tablaInformeDEnca],[id=tablaFichasALL] td").css({"padding":"3px"});
				$("[id=btnImprimirInfD]").prop("disabled",false);
				$.each(datos,function(){
					var fila = {
						0: this.codigo,
						1: this.fecharegistro,
						2: this.nombreInfraestructura,
						3: this.nombreSucursal,
						4: this.nombreCT,
						5: this.nombreCC,
						6: this.nombreP,
						7: this.descripcion,
						8: this.estructura,
						9: this.area,
						10: this.accesorios
					};
					filas.push(fila);
				});
				dtTblLocativaID.clear().draw();
				dtTblLocativaID.rows.add(filas).draw();
			});
			$("[id=vehiculoInfD]").addClass("hide");
			$("[id=maquinariaInfDNoProsof]").addClass("hide");
			$("[id=maquinariaInfDSiProsof]").addClass("hide");
			$("[id=equipoInfDNoProsof]").addClass("hide");
			$("[id=equipoInfDSiProsof]").addClass("hide");
			$("[id=locativaInfD]").removeClass("hide");
		}
	});

	$("[id=btnLimpiarInfD]").on("click",function(e){
		e.preventDefault();
		$("[id=divInformeEncabezado]").addClass("hide");
		$("[id=tablaInformeDEnca] tbody").empty();
		$("[id=btnGenerarInfD]").prop("disabled",true);
		$("[id=btnImprimirInfD]").prop("disabled",true);
		$("[id=tipoFichaInformeDEnc]").val("");
	});
//FIN INFORME DETALLADO

//CODIGO PARA INFORME INDIVIDUAL
	var selectVacio = '<option value=""></option>';
	$('a[id="crearInformeIndividual"][data-toggle=tab]').on('shown.bs.tab', function (e) {
		$("li[id=2]").addClass("hide");
		$("li[id=4]").addClass("hide");
		$("li[id=6]").addClass("hide");
		$("li[id=8]").addClass("hide");
		$("[id=codigoFichaInforme]").empty();
		$("[id=divInformeIndividual]").addClass('hide');
		$("[id=codigoFichaInforme]").prop("disabled",true);
		$("[id=btnGenerar]").prop("disabled",true);
		$("[id=btnImprimir]").prop("disabled",true);
	});

	$("[id=tipoFichaInforme]").on("change",function(){
		var tipoFicha = $("[id=tipoFichaInforme]").val();
		if (tipoFicha != "") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerCodigosFichas",{Tipo:tipoFicha},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				$("[id=codigoFichaInforme]").empty();
				$("[id=codigoFichaInforme]").append(selectVacio);
				if (tipoFicha == '001') {
					$.each(datos, function(){
						$("[id=codigoFichaInforme]").append('<option value="'+this.Codigo+'">'+this.Codigo+'</option>');
						$("[id=codigoFichaInforme]").prop("disabled",false);
					});
				}else{
					$.each(datos, function(){
						$("[id=codigoFichaInforme]").append('<option value="'+this.codigo+'">'+this.codigo+'</option>');
						$("[id=codigoFichaInforme]").prop("disabled",false);
					});
				}
			});
		}else {
			$("[id=codigoFichaInforme]").prop("disabled",true);
		}
	});

	$("[id=codigoFichaInforme]").on("change", function(){
		if($(this).val() != "") {$("[id=btnGenerar]").prop("disabled",false);}else{$("[id=btnGenerar]").prop("disabled",true);}
	});
	//BOTON GENERACION DE INFORMES DE LAS FICHAS TECNICAS
	$("[id=btnGenerar]").on("click", function(e){
		e.preventDefault();
		var tipo = $("[id=tipoFichaInforme]").val();
		var codigo = $("[id=codigoFichaInforme]").val();
		if (tipo != "" && codigo != "") {
			$.post(base_url()+"index.php/FichasTecnicas/cFichasTecnicas/obtenerInfoInformeFicha",{Tipo:tipo,Codigo:codigo},function(resultado){
				var resp = resultado;
				if (Permiso(resp)){
					return 0;
				}
				var datos = JSON.parse(resultado);
				var tipoV;
				var tipoM;
				var tipoE;
				$("[id=TblInformeIndividual] tbody").empty();
				if(tipo == '001'){
					if (datos.info[0].desvinculado == 'V') {
						tipoV = 'Activo';
					}else{
						tipoV = 'Inactivo';
					}
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h2>Especificaciones vehículo</h2></center></td></tr>');
					var info = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Placa : </strong>'+datos.info[0].Codigo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha registro : </strong>'+datos.info[0].Fechaaprobacion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Infraestructura : </strong>'+datos.info[0].nombreInfraestructura+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Sucursal : </strong>'+datos.info[0].nombreSucursal+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro trabajo : </strong>'+datos.info[0].nombreCT+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro costo : </strong>'+datos.info[0].nombreCC+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Proceso : </strong>'+datos.info[0].nombreP+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Código : </strong>'+datos.info[0].Placa+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Linea : </strong>'+datos.info[0].Linea+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Tipo : </strong>'+datos.info[0].tipoV+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Marca : </strong>'+datos.info[0].Marca+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Modelo : </strong>'+datos.info[0].modelo+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Cilindraje : </strong>'+datos.info[0].Cilindraje+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>N° chasis : </strong>'+datos.info[0].Numchasis+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>N° motor : </strong>'+datos.info[0].Nummotor+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>N°licencia : </strong>'+datos.info[0].numlicenciatrans+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Uso vehiculo : </strong>'+datos.info[0].usovehiculo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Estado : </strong>'+tipoV+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Cant. valvulas : </strong>'+datos.info[0].cantvalvulas+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Cant. cilindros : </strong>'+datos.info[0].canticilindros+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Turbo : </strong>'+datos.info[0].Turbo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Orientacion : </strong>'+datos.info[0].Orientacion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Tipo dirección : </strong>'+datos.info[0].tipodireccion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Tipo transmisión : </strong>'+datos.info[0].Tipotransmision+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>N° velocidades : </strong>'+datos.info[0].numvelocidades+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Tipo rodamiento : </strong>'+datos.info[0].Tiporodamiento+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Suspensión delantera : </strong>'+datos.info[0].Suspendelantera+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Suspensión trasera : </strong>'+datos.info[0].Suspentrasera+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>N° llantas : </strong>'+datos.info[0].numllantas+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Dimension rines : </strong>'+datos.info[0].Dimenrines+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Material rines : </strong>'+datos.info[0].materialrines+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Frenos delanteros : </strong>'+datos.info[0].tipofrenosdel+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Frenos traseros : </strong>'+datos.info[0].tipofrenostras+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>N° serie carroceria : </strong>'+datos.info[0].Numseriecarroce+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>N° ventanas : </strong>'+datos.info[0].Numventanas+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Pasajeros : </strong>'+datos.info[0].Capcargapasajeros+'</h5>'+
						'</div>'+
					'</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append(info);
					var cuartoTR = '<tr>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.anexos, function(){
						cuartoTR +='<div class="col-xs-12" style="margin-left:15px">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - </strong>'+this.documento+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.elementos, function(){
						var tipoElemento = "";
						if (this.tipo == 'C') {tipoElemento =  "Caja Herramienta: ";}
						else if (this.tipo == 'E') {tipoElemento =  "Equipo carretera: ";}
						else if (this.tipo == 'B') {tipoElemento =  "Botiquin: ";}
						cuartoTR +='<div class="col-xs-12" style="margin-left:15px">'+
							'<div class="col-xs-6">'+
								'<h5><strong> - '+tipoElemento+'</strong>'+this.elemento+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.personal, function(){
						var tipoPersonal = "";
						if (this.tipopersonal == 'P') { tipoPersonal = 'Propietario';}
						else{tipoPersonal = 'Conductor';}
						cuartoTR +='<div class="col-xs-12" style="">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - Tipo: </strong>'+tipoPersonal+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Nombre: </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Correo: </strong>'+this.correo+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Telefono: </strong>'+this.telefono+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'</tr>';
					var sextoTR = '<tr>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operacionc, function(){
						sextoTR +='<div class="col-xs-12">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Ultimo consumo:  </strong>'+this.valultimoconsu+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proximo consumo:  </strong>'+this.proximoconsumo+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
							'</div>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operaciont, function(){
						var tiempoOpe = "";
						if (this.TiempoOperacion == '001') {tiempoOpe = "Días";}
						else if (this.TiempoOperacion == '002') {tiempoOpe = "Semanas";}
						else if (this.TiempoOperacion == '003') {tiempoOpe = "Meses";}
						else if (this.TiempoOperacion == '004') {tiempoOpe = "Años";}
						sextoTR +='<div class="col-xs-6">'+
							'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
							'<h5><strong>   Ultima fecha:  </strong>'+this.ultimafecha+'</h5>'+
							'<h5><strong>   Tiempo:  </strong>'+this.valorfrecuencia+' '+tiempoOpe+'</h5>'+
							'<h5><strong>   Estado:  </strong>'+this.estado+'</h5>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.solicitud, function(){
						sextoTR +='<div class="col-xs-12">'+
							'<h5><strong> - Descripción:  </strong>'+this.descripcion+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Fecha solicitud:  </strong>'+this.fechasolicitud+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Justificación:  </strong>'+this.justificacion+'</h5>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'</tr>';
					var octavoTR = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.registroOP, function(){
						if (typeof this.proxima === 'undefined') {
							octavoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}else{
							octavoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proxima fecha:  </strong>'+this.proxima+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}
					});
					octavoTR +='</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" style="border-color: #4894d7"><center><h3>Anexos </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Elementos </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Personal </h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(cuartoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" style="border-color: #4894d7"><center><h3>Operaciones consumo</h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Operaciones tiempo</h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Solicitud de operaciones</h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(sextoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h3>Registro de operaciones</h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(octavoTR);
				}
				if (tipo == '002') {
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h2>Especificaciones maquinaria y equipo</h2></center></td></tr>');
					if (datos.info[0].estado == 'A') {
						tipoM = 'Activo';
					}else{
						tipoM = 'Inactivo';
					}
					var info = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Código : </strong>'+datos.info[0].codigo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha registro : </strong>'+datos.info[0].fechaaprobacion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Infraestructura : </strong>'+datos.info[0].nombreInfraestructura+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Sucursal : </strong>'+datos.info[0].nombreSucursal+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro trabajo : </strong>'+datos.info[0].nombreCT+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro costo : </strong>'+datos.info[0].nombreCC+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Proceso : </strong>'+datos.info[0].nombreP+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Nombre : </strong>'+datos.info[0].nombre+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Marca : </strong>'+datos.info[0].marcar+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Modelo : </strong>'+datos.info[0].modelo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Serial : </strong>'+datos.info[0].serial+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Codigo del activo : </strong>'+datos.info[0].codactifijo+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha compra : </strong>'+datos.info[0].fechacompra+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Caracteristica : </strong>'+datos.info[0].caracteristica+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Estado : </strong>'+tipoM+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Ubicacion : </strong>'+datos.info[0].ubicacion+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Responsable uso : </strong>'+datos.info[0].reponuso+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Responsable operación : </strong>'+datos.info[0].responoperacion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Tolerancia : </strong>'+datos.info[0].tolerancia+'</h5>'+
						'</div>'+
					'</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append(info);
					var cuartoTR = '<tr>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.anexos, function(){
						cuartoTR +='<div class="col-xs-12" style="margin-left:15px">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - </strong>'+this.documento+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operacion, function(){
						var tiempoOpe = "";
						if (this.TiempoOperacion != 'null' || this.TiempoOperacion != null) {
							if (this.TiempoOperacion == '001') {tiempoOpe = "Días";}
							else if (this.TiempoOperacion == '002') {tiempoOpe = "Semanas";}
							else if (this.TiempoOperacion == '003') {tiempoOpe = "Meses";}
							else if (this.TiempoOperacion == '004') {tiempoOpe = "Años";}
						}else{
							tiempoOpe = this.nombreUnidad;
						}
						cuartoTR +='<div class="col-xs-6">'+
							'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
							'<h5><strong>   Ultima fecha:  </strong>'+this.ultimafecha+'</h5>'+
							'<h5><strong>   Tiempo:  </strong>'+this.valorfrecuencia+' '+tiempoOpe+'</h5>'+
							'<h5><strong>   Estado:  </strong>'+this.estado+'</h5>'+
						'</div>';
					});
					cuartoTR +='</div>'+
					'</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.solicitud, function(){
						cuartoTR +='<div class="col-xs-12">'+
							'<h5><strong> - Descripción:  </strong>'+this.descripcion+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Fecha solicitud:  </strong>'+this.fechasolicitud+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Justificación:  </strong>'+this.justificacion+'</h5>'+
						'</div>';
					});
					cuartoTR +='</div>'+
					'</td>'+
					'</tr>';
					var sextoTR = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.registroOP, function(){
						if (typeof this.proxima === 'undefined') {
							sextoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}else{
							sextoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proxima fecha:  </strong>'+this.proxima+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}
					});
					sextoTR +='</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" style="border-color: #4894d7"><center><h3>Anexos </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Operaciones </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Solicitud de operaciones </h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(cuartoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h3>Registro de operaciones</h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(sextoTR);
				}
				if (tipo == '003') {
					if (datos.info[0].estado == 'a' || datos.info[0].estado == 'A') {
						tipoE = 'Activo';
					}else{
						tipoE = 'Inactivo';
					}
					var condicion = "";
					if (datos.info[0].condiciones == 'b') {condicion = "Bueno";}
					else if (datos.info[0].condiciones == 'r') {condicion = "Regular";}
					else if (datos.info[0].condiciones == 'm') {condicion = "Malo";}
					var TipoPC = "";
					if (datos.info[0].tipocomputo == 'e') {condicion = "Escritorio";}
					else if (datos.info[0].tipocomputo == 'p') {condicion = "Portatil";}
					else if (datos.info[0].tipocomputo == 's') {condicion = "Servidor";}
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h2>Especificaciones equipo computo</h2></center></td></tr>');
					var info = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Código : </strong>'+datos.info[0].codigo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha registro : </strong>'+datos.info[0].fechaaprobacion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Infraestructura : </strong>'+datos.info[0].nombreInfraestructura+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Sucursal : </strong>'+datos.info[0].nombreSucursal+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro trabajo : </strong>'+datos.info[0].nombreCT+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro costo : </strong>'+datos.info[0].nombreCC+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Proceso : </strong>'+datos.info[0].nombreP+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Nombre : </strong>'+datos.info[0].marca+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Modelo : </strong>'+datos.info[0].modelo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Serial : </strong>'+datos.info[0].serial+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha registro : </strong>'+datos.info[0].fecharegistro+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha compra : </strong>'+datos.info[0].fechacompra+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Condiciones : </strong>'+condicion+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Tipo PC : </strong>'+TipoPC+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Color : </strong>'+datos.info[0].color+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Proveedor : </strong>'+datos.info[0].nombreProvee+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Estado : </strong>'+tipoE+'</h5>'+
						'</div>'+
					'</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append(info);
					var cuartoTR = '<tr>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.anexos, function(){
						cuartoTR +='<div class="col-xs-12" style="margin-left:15px">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - </strong>'+this.documento+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.software, function(){
						cuartoTR +='<div class="col-xs-12" style="margin-left:15px">'+
							'<div class="col-xs-6">'+
								'<h5><strong> - Nombre: </strong>'+this.nombreSoft+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Licencia: </strong>'+this.licencia+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Caracteristica: </strong>'+this.caracteristica+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.hardware, function(){
						cuartoTR +='<div class="col-xs-12" style="">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - Nombre: </strong>'+this.nombreHard+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Marca: </strong>'+this.marca+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Modelo: </strong>'+this.modelo+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Caracteristica: </strong>'+this.caracteristica+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'</tr>';
					var sextoTR = '<tr>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operacionc, function(){
						sextoTR +='<div class="col-xs-12">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Ultimo consumo:  </strong>'+this.valultimoconsu+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proximo consumo:  </strong>'+this.proximoconsumo+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
							'</div>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operaciont, function(){
						var tiempoOpe = "";
						if (this.TiempoOperacion == '001') {tiempoOpe = "Días";}
						else if (this.TiempoOperacion == '002') {tiempoOpe = "Semanas";}
						else if (this.TiempoOperacion == '003') {tiempoOpe = "Meses";}
						else if (this.TiempoOperacion == '004') {tiempoOpe = "Años";}
						sextoTR +='<div class="col-xs-6">'+
							'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
							'<h5><strong>   Ultima fecha:  </strong>'+this.ultimafecha+'</h5>'+
							'<h5><strong>   Tiempo:  </strong>'+this.valorfrecuencia+' '+tiempoOpe+'</h5>'+
							'<h5><strong>   Estado:  </strong>'+this.estado+'</h5>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.solicitud, function(){
						sextoTR +='<div class="col-xs-12">'+
							'<h5><strong> - Descripción:  </strong>'+this.descripcion+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Fecha solicitud:  </strong>'+this.fechasolicitud+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Justificación:  </strong>'+this.justificacion+'</h5>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'</tr>';
					var octavoTR = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.registroOP, function(){
						if (typeof this.proxima === 'undefined') {
							octavoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}else{
							octavoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proxima fecha:  </strong>'+this.proxima+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}
					});
					octavoTR +='</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" style="border-color: #4894d7"><center><h3>Anexos </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Software </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Hardware </h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(cuartoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" style="border-color: #4894d7"><center><h3>Operaciones consumo</h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Operaciones tiempo</h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Solicitud de operaciones</h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(sextoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h3>Registro de operaciones</h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(octavoTR);
				}
				if (tipo == '004') {
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h2>Especificaciones Ficha locativa</h2></center></td></tr>');
					var info = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Código : </strong>'+datos.info[0].codigo+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Fecha registro : </strong>'+datos.info[0].fecharegistro+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Infraestructura : </strong>'+datos.info[0].nombreInfraestructura+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Sucursal : </strong>'+datos.info[0].nombreSucursal+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro trabajo : </strong>'+datos.info[0].nombreCT+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Centro costo : </strong>'+datos.info[0].nombreCC+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Proceso : </strong>'+datos.info[0].nombreP+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Descripción : </strong>'+datos.info[0].descripcion+'</h5>'+
						'</div>'+
					'</div>'+
					'<div class="col-xs-12" style="margin-left:5px">'+
						'<div class="col-xs-3">'+
							'<h5><strong>Estructura : </strong>'+datos.info[0].estructura+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Accesorio : </strong>'+datos.info[0].accesorios+'</h5>'+
						'</div>'+
						'<div class="col-xs-3">'+
							'<h5><strong>Area : </strong>'+datos.info[0].area+'</h5>'+
						'</div>'+
					'</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append(info);
					var cuartoTR = '<tr>'+
					'<td class="tdTDocs" style="border-color: #4894d7">';
					$.each(datos.anexos, function(){
						cuartoTR +='<div class="col-xs-12" style="margin-left:15px">'+
							'<div class="col-xs-12">'+
								'<h5><strong> - </strong>'+this.documento+'</h5>'+
							'</div>'+
						'</div>';
					});
					cuartoTR +='</td>'+
					'<td class="tdTDocs" colspan="2" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operacionc, function(){
						cuartoTR +='<div class="col-xs-6">'+
								'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Ultimo consumo:  </strong>'+this.valultimoconsu+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proximo consumo:  </strong>'+this.proximoconsumo+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
						'</div>';
					});
					cuartoTR +='</div>'+
					'</td>'+
					'</tr>';
					var sextoTR = '<tr>'+
					'<td class="tdTDocs" colspan="2" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.operaciont, function(){
						var tiempoOpe = "";
						if (this.TiempoOperacion == '001') {tiempoOpe = "Días";}
						else if (this.TiempoOperacion == '002') {tiempoOpe = "Semanas";}
						else if (this.TiempoOperacion == '003') {tiempoOpe = "Meses";}
						else if (this.TiempoOperacion == '004') {tiempoOpe = "Años";}
						sextoTR +='<div class="col-xs-6">'+
							'<h5><strong> - Operación:  </strong>'+this.operacion+'</h5>'+
							'<h5><strong>   Ultima fecha:  </strong>'+this.ultimafecha+'</h5>'+
							'<h5><strong>   Tiempo:  </strong>'+this.valorfrecuencia+' '+tiempoOpe+'</h5>'+
							'<h5><strong>   Estado:  </strong>'+this.estado+'</h5>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'<td class="tdTDocs" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.solicitud, function(){
						sextoTR +='<div class="col-xs-12">'+
							'<h5><strong> - Descripción:  </strong>'+this.descripcion+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Estado:  </strong>'+this.estado+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Fecha solicitud:  </strong>'+this.fechasolicitud+'</h5>'+
							'<h5 style="margin-left: 10px"><strong>   Justificación:  </strong>'+this.justificacion+'</h5>'+
						'</div>';
					});
					sextoTR +='</div>'+
					'</td>'+
					'</tr>';
					var octavoTR = '<tr>'+
					'<td class="tdTDocs" colspan="3" style="border-color: #4894d7">'+
					'<div class="col-xs-12" style="">';
					$.each(datos.registroOP, function(){
						if (typeof this.proxima === 'undefined') {
							octavoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}else{
							octavoTR +='<div class="col-xs-4">'+
								'<h5><strong> - Operación:  </strong>'+this.nombre+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Fecha ejecutada:  </strong>'+this.fecha+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Proxima fecha:  </strong>'+this.proxima+'</h5>'+
								'<h5 style="margin-left: 10px"><strong>   Resultado:  </strong>'+this.resultado+'</h5>'+
							'</div>';
						}
					});
					octavoTR +='</div>'+
					'</td>'+
					'</tr>';
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" style="border-color: #4894d7"><center><h3>Anexos </h3></center></td>'+
						'<td class="tdTDocs" colspan="2" style="border-color: #4894d7"><center><h3>Operaciones de consumo </h3></center></td>');
					$("[id=TblInformeIndividual] tbody").append(cuartoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="2" style="border-color: #4894d7"><center><h3>Operaciones de tiempo </h3></center></td>'+
						'<td class="tdTDocs" style="border-color: #4894d7"><center><h3>Solicitud de operaciones </h3></center></td>');
					$("[id=TblInformeIndividual] tbody").append(sextoTR);
					$("[id=TblInformeIndividual] tbody").append('<tr><td class="tdTDocs" colspan="3" style="border-color: #4894d7"><center><h3>Registro de operaciones</h3></center></td></tr>');
					$("[id=TblInformeIndividual] tbody").append(octavoTR);
				}
				$("[id=divInformeIndividual]").removeClass('hide');
				$("[id=btnImprimir]").prop("disabled",false);
			});
		}else{
			alertify.warning("Debe seleccionar como minimo un tipo de ficha tecnica y un codigo.");
			return;
		}
	});

	$("[id=btnLimpiarFiltrosInforme]").on("click",function(e){
		e.preventDefault();
		$("[id=divInformeIndividual]").addClass('hide');
		$("[id=TblInformeIndividual] tbody").empty();
		$("[id=tipoFichaInforme]").val("");
		$("[id=codigoFichaInforme]").val("");
		$("[id=btnGenerar]").prop("disabled",true);
		$("[id=btnImprimir]").prop("disabled",true);
		$("[id=codigoFichaInforme]").prop("disabled",true);
	});
//FIN CODIGO INFORME INDIVIDUAL