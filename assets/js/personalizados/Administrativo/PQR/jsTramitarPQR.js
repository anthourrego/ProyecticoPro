var lastFocus = '';

fechas = {
	fechaIni: $('[name=fecha1]').val(),
	fechaFin: $('[name=fecha2]').val()
};

var DT;
var url_string = window.location.href,
	fecha1 = '',
	fecha2 = ''
	//procal = '',
	//operacion = '',
	causapqr = '',
	//responsable = '',
	//seccion = '',
	estado = '',
	tipo = '',
	ciudad = '',
	//pedido = '', 
	factura = '', 
	nPqr = '', 
	cliente = '';
	//clienteNombre = '';
	//asesor = '',
	//dependencia = '',
	//producto = '',
	//productoNombre = '',
	//material = '',
	//materialNombre = '';

var config = {
	data:{
		tblID : "#tblCRUD",
		select: [
			"DISTINCT hpqr.PQRId"
			,"CAST(hpqr.Fecha AS DATE) AS Fecha"
			,"hpqr.Pedido"
			,"hpqr.Factura"
			,"hpqr.Fabricado"
			,"hpqr.Asunto"
			,"d.nombre AS Dependencia"
			,"epqr.ColorHexa AS Color"
			,`CASE WHEN hpqr.Producto IS NULL THEN 
				STUFF(( SELECT
						CAST(ROW_NUMBER() OVER (ORDER BY pq2.ProductoPQRId DESC) AS VARCHAR) + ' : '+ CASE WHEN pq2.ProductoId = '' OR pq2.ProductoId IS NULL THEN pq2.Producto ELSE hp.nombre END 
						+ '\r' FROM ProductoPQR pq2 
						LEFT JOIN Producto P2 ON pq2.ProductoId = P2.productoid 
						LEFT JOIN HeadProd hp ON P2.headprodid = hp.headprodid 
						WHERE pq2.PQRId = hpqr.PQRId FOR XML PATH('p') 
					), 1, 0, '')
			ELSE hpqr.Producto END Producto`
			,`CASE WHEN hpqr.Material IS NULL THEN 
				STUFF(( SELECT 
						CAST(ROW_NUMBER() OVER (ORDER BY pq2.ProductoPQRId DESC) AS VARCHAR) + ' : '+ CASE WHEN pq2.MaterialId = '' OR pq2.MaterialId IS NULL THEN pq2.Material ELSE hpM.nombre END 
						+ '\r' FROM ProductoPQR pq2
						LEFT JOIN Producto M ON pq2.MaterialId = M.productoid 
						LEFT JOIN HeadProd hpM ON M.headprodid = hpM.headprodid 
						WHERE pq2.PQRId = hpqr.PQRId FOR XML PATH('p') 
					), 1, 0, '') 
			ELSE hpqr.Material END Material`
			,`CASE WHEN hpqr.Producidos IS NULL THEN 
				STUFF(( SELECT 
					CAST(ROW_NUMBER() OVER (ORDER BY pq2.ProductoPQRId DESC) AS VARCHAR) + ' : '+ CASE WHEN pq2.Producidos IS NULL THEN CONCAT('(', CAST(hpqr.Producidos AS VARCHAR), ')') ELSE CONCAT('(', CAST(pq2.Producidos AS VARCHAR), ')') END 
							+ '\r' FROM ProductoPQR pq2 
							WHERE pq2.PQRId = hpqr.PQRId FOR XML PATH('p') 
						), 1, 0, '') 
				ELSE CAST(hpqr.Producidos AS VARCHAR) END Producidos`
			,"hpqr.TerceroId AS ClienteID"
			,"CASE WHEN hpqr.TerceroId IS NULL THEN hpqr.OtroCliente ELSE t.nombre END AS Cliente"
			,"c.nombre AS CiudadCliente"
			,"hpqr.Descripcion"
			,"REVISION = STUFF((SELECT  CAST(n.Fecha AS varchar)+ ': ' + n.Detalle + '\r'  FROM DetallePQR n LEFT JOIN EstadoPQR e ON e.EstadoId = n.EstadoReporte WHERE n.PQRId = hpqr.PQRId and e.Cierre <> 'TRUE' FOR XML PATH('p')),1, 0, '')"
			,"SOLUCION = STUFF((SELECT  CAST(n.Fecha AS varchar) + ': ' + n.Detalle  +  '\r' FROM DetallePQR n LEFT JOIN EstadoPQR e ON e.EstadoId = n.EstadoReporte WHERE n.PQRId = hpqr.PQRId and e.Cierre = 'TRUE' FOR XML PATH('p')),1, 0, '')",
			,"tpqr.Nombre AS TipoPQR"
			,"hpqr.Devoluciones AS Devoluciones"
			,"hpqr.FechaCierre AS FechaSolucion"
			,"hpqr.Costos AS CostosPQR"
			,"CASE WHEN hpqr.OtraCausa IS NOT NULL THEN hpqr.OtraCausa ELSE ca.Nombre End AS CausaPQR"
			,"CASE WHEN hpqr.OtraCalidad IS NOT NULL THEN hpqr.OtraCalidad ELSE q.Nombre End AS ProblemaCalidad"
			,"CASE WHEN hpqr.OtraResponsable IS NOT NULL THEN hpqr.OtraResponsable ELSE r.Nombre End AS Responsable"
			,"CASE WHEN hpqr.OtraOperacion IS NOT NULL THEN hpqr.OtraOperacion ELSE o.Nombre End AS Operacion"
			,"CASE WHEN hpqr.OtraSeccion IS NOT NULL THEN hpqr.OtraSeccion ELSE s.Nombre End AS Seccion"
			,"DATEPART(year, hpqr.Fecha) AS Ano"
			,"DATEPART(month,  hpqr.Fecha) AS Mes"
			,"DATEPART(day,  hpqr.Fecha) AS Dia"
			,"ESPUESTACLIENTE = STUFF((SELECT  cast(n.Fecha AS varchar) + ': ' + n.Detalle  +  '\r' FROM DetallePQR n LEFT JOIN EstadoPQR e ON e.EstadoId = n.EstadoReporte WHERE n.PQRId = hpqr.PQRId and n.Origen = 'c' FOR XML PATH('p')),1, 0, '')"
			,"hpqr.FechaCierre AS FechaCierre"
			,"epqr.Nombre AS Estado"
			,"CASE WHEN hpqr.ReclamoProveedor = 1 THEN 'SI' ELSE 'NO' End AS GeneraReclamoProveedor"
			,"'' AS EmpresaExterno"
			,"DATEDIFF (DAY, hpqr.Fecha, hpqr.FechaCierre ) AS TiempoSolucionPQR"
			,"DATEPART(WEEk, hpqr.Fecha) AS Semana"
			,"hpqr.PQR"
		],
		table : [
			"HeadPQR hpqr",
			[
				['Tercero t', 't.TerceroId = hpqr.TerceroId', 'LEFT'],
				['Ciudad c', 'c.ciudadid = t.ciudadid', 'LEFT'],
				['TipoPQR tpqr', 'tpqr.TipoPQRId = hpqr.TipoPQRId', 'LEFT'],
				['EstadoPQR epqr', 'epqr.EstadoId = hpqr.EstadoId', 'LEFT'],
				['CausaPQR ca', 'hpqr.Causa = ca.CausaPQRId', 'LEFT'],
				['CausaPQR q', 'hpqr.Calidad = q.CausaPQRId', 'LEFT'],
				['CausaPQR r', 'hpqr.Responsable = r.CausaPQRId', 'LEFT'],
				['CausaPQR o', 'hpqr.Operacion = o.CausaPQRId', 'LEFT'],
				['CausaPQR s', 'hpqr.Seccion = s.CausaPQRId', 'LEFT'],
				['ProductoPqr pq', 'hpqr.PQRId = pq.PQRId', 'LEFT'],
				['Dependencia d', 'hpqr.DependenciaId = d.DependenciaId', 'LEFT'],
				['Producto P', 'pq.ProductoId = P.productoid', 'LEFT'],
				['HeadProd hp', 'P.headprodid = hp.headprodid', 'LEFT'],
				['Producto P2', 'pq.MaterialId = P2.productoid', 'LEFT'],
				['HeadProd hp2', 'P2.headprodid = hp2.headprodid', 'LEFT'],

			],[]
		],
		column_order : [
			'hpqr.PQR'
			,'hpqr.PQRId'
			,'Estado'
			,'hpqr.Factura'
			,'ClienteID'
			,'Cliente'
			,'CiudadCliente'
			,'TipoPQR'
			,'Fecha'
			,"FechaSolucion"
			,'hpqr.Asunto'
		],
		column_search : [
			'hpqr.PQR'
			,'t.nombre'
		],
		orden : {'PQRid': 'DESC'},
		columnas : [
			'PQR'
			,'PQRId'
			,'Estado'
			,'Factura'
			,'ClienteID'
			,'Cliente'
			,'CiudadCliente'
			,'TipoPQR'
			,'Fecha'
			,"FechaSolucion"
			,'Asunto'
		]
	},
	processing: true,
	serverSide: true,
	order: [[0, 'ASC']],
	draw: 10,
	language,
	fixedColumns: true,
	pageLength: 10,
	buttons: [
		{ extend: 'copy', className: 'copyButton', text: 'Copiar', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente' },
		{ extend: 'csv', className: 'csvButton', text: 'CSV', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente'},
		{ extend: 'excel', action: newExportAction, text: 'Excel', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente'},
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF', exportOptions: {columns: ':not(:first-child)'}, title: 'Residente'},
		{ extend: 'print', className: 'printButton', text: 'Imprimir', exportOptions: {columns: ':not(:first-child)', title: 'Residente'} }
	],
	deferRender: true,
	scrollX: '100%',
	scrollY: $(document).height() - 405,
	scroller: {
		loadingIndicator: true
	},
	scrollCollapse: false,
	dom: domBftri,
	columnDefs:[
		{visible: false, targets: [1]}
	],
	createdRow: function(row,data,dataIndex){
		$(row).css("cursor", "pointer");
		$(row).find('td:eq(0)').css('background-color', data[12]);
		$(row).click(function(){
			var url = base_url() + 'Administrativo/PQR/TramitarPQR/ConsultarPQR/' + data[1];
			location.href = url;
		});
	}
}

$(function(){
	$(".chosen-select").chosen({width: '100%'});

	getId();

	//$procal = JSON.stringify($('#procal').val());
	//$operacion = JSON.stringify($('#operacion').val());
	$causapqr = JSON.stringify($('#causapqr').val());
	//$responsable = JSON.stringify($('#responsable').val());
	//$seccion = JSON.stringify($('#seccion').val());
	$estado = JSON.stringify($('#estado').val());
	$tipo = JSON.stringify($('#tipo').val());
	$ciudad = JSON.stringify($('#ciudad').val());
	//$pedido = JSON.stringify($('#pedido').val());
	$factura = JSON.stringify($('#factura').val());
	$nPqr = JSON.stringify($('#nPqr').val());
	$cliente = JSON.stringify($('#cliente').val());
	//$asesor = JSON.stringify($('#asesor').val());
	//$dependencia = JSON.stringify($('#dependencia').val());
	//$producto = JSON.stringify($('#ProductoId2').val());
	//$material = JSON.stringify($('#MaterialId2').val());

	var where = [];
	
	var validarPedido = false;
	//var validarProductos = false;

	/* if(procal != '' && procal != null){
		where.push(['hpqr.Calidad IN ('+procal+')', null]);
	} */	

	/* if(operacion != '' && operacion != null){
		where.push(['hpqr.Operacion IN ('+operacion+')', null]);
	} */
	if(causapqr != '' && causapqr != null){
		where.push(['hpqr.Causa IN ('+causapqr+')', null]);
	}
	/* if(responsable != '' && responsable != null){
		where.push(['hpqr.Responsable IN ('+responsable+')', null]);
	} */
	/* if(seccion != '' && seccion != null){
		where.push(['hpqr.Seccion IN ('+seccion+')', null]); 
	} */
	if(estado != '' && estado != null){
		where.push(['epqr.EstadoId IN ('+estado+')', null]);
	}
	if(tipo != '' && tipo != null){
		where.push(['tpqr.TipoPQRId IN ('+tipo+')', null]);
	}
	if(ciudad != '' && ciudad != null){
		where.push(['c.ciudadid IN ('+ciudad+')', null]);
	}
	if(cliente != '' && cliente != null){
		where.push(['t.TerceroId', cliente]);
	}
	/* if(pedido != '' && pedido != null){
		validarPedido = true;
		where.push(['hpqr.Pedido', pedido]);
	} */
	if(factura != '' && factura != null){
		where.push(['hpqr.Factura', factura]);
	}
	if(nPqr != '' && nPqr != null){
		validarPedido = true;
		where.push(['hpqr.PQR', nPqr]);
		/* if(producto != '' && producto != null){
			validarProductos = true;
			where.push(['pq.ProductoId', producto]);
		}
		if(material != '' && material != null){
			validarProductos = true;
			where.push(['pq.MaterialId', material]);
		} */
	}
	/* if(asesor != '' && asesor != null){
		asesor = asesor.split(',');
		var cadena = "";
		for (var i = 0; i < asesor.length; i++) {
			cadena += "'" + asesor[i] + "',";
		}
		// Valido si al final de la cadena hay una ','.
		//  En caso de que sea así, se quita de la cadena
		if (cadena.substr(-1) == ",") {
			cadena = cadena.slice(0, -1);
		}

		where.push(["hpqr.UsuarioId IN ("+cadena+")", null]);
	} */
	
	/* if(dependencia != '' && dependencia != null){
		where.push(['hpqr.DependenciaId IN ('+dependencia+')', null]);
	} */
	
	/* if (!validarProductos){
		if(producto != '' && producto != null){
			where.push(['hpqr.ProductoId', producto]);
		}
		if(material != '' && material != null){
			where.push(['pq.MaterialId', material]);
		}
	} */
	
	if (!validarPedido){
		var inicio =  moment($('[name=fecha1]').val(), 'YYYY-MM-DD').format("YYYY-MM-DD");
		var fin = moment($('[name=fecha2]').val(), 'YYYY-MM-DD').format("YYYY-MM-DD");
		where.push(
			["CAST(hpqr.Fecha AS DATE) BETWEEN '" + inicio + "' AND '" + fin + "'"]
		);
	}

	config.data.table[2] = where;
	
	DT = dtSS(config);

	/* $(document).on("focusout", "#ProductoId", function(){
		if($(this).val().trim() != ''){
			consultaProducto($(this).val().trim(), this);
		} else {
			$("#ProductoId").val("");
			$("#ProductoNombre").text("Todos");
		}
	}); */

	/* $(document).on("focusout", "#MaterialId", function(){
		if($(this).val().trim() != ''){
			cargarMaterial($(this).val().trim(), this);
		} else {
			$("#MaterialId").val("");
			$("#MaterialNombre").text("Todos");
		}
	}); */
	
	
	$("#btnCargar").click(function(e){
		e.preventDefault();
		var url = base_url()+"Administrativo/PQR/TramitarPQR?\
		fecha1="+$('#fecha1').val()+'&\
		fecha2='+$('#fecha2').val()+'&\
		causapqr='+$('#causapqr').val()+'&\
		estado='+$('#estado').val()+'&\
		tipo='+$('#tipo').val()+'&\
		ciudad='+$('#ciudad').val()+'&\
		cliente='+$('#TerceroId').val()+'&\
		factura='+$('#factura').val()+'&\
		nPqr='+$('#nPqr').val();
		window.location.replace(url);
	});
});

function getId(){
	url = new URL(url_string);
	fecha1 = url.searchParams.get("fecha1");
	
	if(fecha1 != null && fecha1 != ''){
		$('#fecha1').val(fecha1);
	}

	fecha2 = url.searchParams.get("fecha2");
	if(fecha2 != null && fecha2 != ''){
		$('#fecha2').val(fecha2);
	}
	//procal = url.searchParams.get("procal");
	//operacion = url.searchParams.get("operacion");
	causapqr = url.searchParams.get("causapqr");
	//responsable = url.searchParams.get("responsable");
	//seccion = url.searchParams.get("seccion");
	estado = url.searchParams.get("estado");
	tipo = url.searchParams.get("tipo");
	ciudad = url.searchParams.get("ciudad");
	cliente = url.searchParams.get("cliente");
	if(cliente != null && cliente != ''){
		$('#TerceroId').val(cliente).trigger("chosen:updated");
	}
	/* pedido = url.searchParams.get("pedido");
	if(pedido != null && pedido != ''){
		$('#pedido').val(pedido);
	} */
	factura = url.searchParams.get("factura");
	if(factura != null && factura != ''){
		$('#factura').val(factura);
	}
	nPqr = url.searchParams.get("nPqr");
	if(nPqr != null && nPqr != ''){
		$('#nPqr').val(nPqr);
	}
	//asesor = url.searchParams.get("asesor");
	//dependencia = url.searchParams.get("dependencia");
	/* producto = url.searchParams.get("producto");
	if(producto != null && producto != ''){
		$('#ProductoId').val(producto);
	}
	productoNombre = url.searchParams.get("productoNombre");
	if(productoNombre != null && productoNombre != ''){
		$('#ProductoNombre').text(productoNombre);
	} else {
		$('#ProductoNombre').text("Todos");
	}
	material = url.searchParams.get("material");
	if(material != null && material != ''){
		$('#MaterialId').val(material);
	}
	materialNombre = url.searchParams.get("materialNombre");
	if(materialNombre != null && materialNombre != ''){
		$('#MaterialNombre').text(materialNombre);
	} else {
		$('#MaterialNombre').text("Todos");
	} */
}

/* function consultaProducto(id, input) { 
	var self = input,
		value = id;
	if(value != lastFocus){
		var antes = lastFocus;
		$.ajax({
			url: base_url() + "Busqueda/consultaProducto",
			type: 'POST',
			data: {
				cod: id
			},
			success: function(respuesta){
				if(respuesta == 0){
					$(self).val('').closest('.input-group').find('span').text('Todos').attr('title', 'Todos');
					alertify.ajaxAlert = function(url){
						$.ajax({
							url: url,
							async: false,
							success: function(data){
								alertify.myAlert().set({
									onclose:function(){
										busqueda = false;
										alertify.myAlert().set({onshow:null});
										$(".ajs-modal").unbind();
										delete alertify.ajaxAlert;
										$("#tblBusqueda").unbind().remove();
									},onshow:function(){
										lastFocus = antes;
										busqueda = true;
									}
								});

								alertify.myAlert(data);

								var $tblID = '#tblBusqueda';
								var config = {
									data:{
										tblID : $tblID,
										select: ['P.productoid', 'H.headprodid', 'H.nombre'],
										table : [
												'HeadProd H',
												[['Producto P', 'H.headprodid = P.headprodid', 'INNER']]
											],
										column_order : ['P.productoid', 'H.headprodid', 'H.nombre'],
										column_search : ['P.productoid', 'H.headprodid','H.nombre'],
										orden : [],
										columnas : ['productoid', 'headprodid', 'nombre']
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
									language: language,
									pageLength: 10,
									initComplete: function(){
										setTimeout(function(){
											$('div.dataTables_filter input').focus();
										},1000);
										
										$('div.dataTables_filter input')
										.unbind()
										.change(function(e){
											e.preventDefault();
											table = $("body").find($tblID).dataTable();
											table.fnFilter( this.value );
										});
									},
									oSearch: { sSearch: value },
									createdRow: function(row,data,dataIndex){
										$(row).click(function(){
											$(self).val(antes).focusin().val(data[0]).focusout();
											alertify.myAlert().close();
										});
									},
									deferRender: true,
									scrollY: screen.height - 400,
									scroller: {
										loadingIndicator: true
									},
									dom: 'ftri'
								}
								dtSS(config);
							}
						});
					}
					var campos = encodeURIComponent(JSON.stringify(['Código', 'Id', 'Nombre']));
					alertify.ajaxAlert(base_url()+"Busqueda/DataTable?campos=" + campos);
				}else{
					lastFocus = antes;
					respuesta = JSON.parse(respuesta);
					doc = $(self).closest('.input-group').find("input").val();
					$(self).closest('.input-group').find('span').text(respuesta[0]['nombre']).attr('title', respuesta[0]['nombre']);      
				}
			}
		});
	}
} */

/* function cargarMaterial(id, input) {
	var self = input,
		value = id;
	if(value != lastFocus){
		var antes = lastFocus;
		$.ajax({
			url: base_url() + "Busqueda/consultarTipoMaterial",
			type: 'POST',
			data: {
				cod: id
			},
			success: function(respuesta){
				if(respuesta == 0){
					$(self).val('').closest('.input-group').find('span').text('Todos').attr('title', 'Todos');
					alertify.ajaxAlert = function(url){
						$.ajax({
							url: url,
							async: false,
							success: function(data){
								alertify.myAlert().set({
									onclose:function(){
										busqueda = false;
										alertify.myAlert().set({onshow:null});
										$(".ajs-modal").unbind();
										delete alertify.ajaxAlert;
										$("#tblBusqueda").unbind().remove();
									},onshow:function(){
										lastFocus = antes;
										busqueda = true;
									}
								});

								alertify.myAlert(data);

								var $tblID = '#tblBusqueda';
								var config = {
									data:{
										tblID : $tblID,
										select: ['DISTINCT P.productoid', 'HP.headprodid', 'hp.nombre'],
										table : [
												'Producto P',
												[
													['HeadProd HP', 'P.headprodid = hp.headprodid', 'LEFT'],
													['Color C', 'P.colorid = C.colorid', 'LEFT'],
													['PWEBMaterialGrupo M', 'HP.HeadProdId = M.HeadProdId', 'INNER']
												]
											],
										column_order : ['P.productoid', 'HP.headprodid', 'hp.nombre'],
										column_search : ['P.productoid','HP.headprodid', 'HP.nombre'],
										orden : {"P.productoid": 'DESC'},
										columnas : ['productoid','headprodid', 'nombre'],
										group_by : ['P.productoid','HP.headprodid', 'hp.nombre']
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
									language: language,
									pageLength: 10,
									initComplete: function(){
										setTimeout(function(){
											$('div.dataTables_filter input').focus();
										},1000);
										
										$('div.dataTables_filter input')
										.unbind()
										.change(function(e){
											e.preventDefault();
											table = $("body").find($tblID).dataTable();
											table.fnFilter( this.value );
										});
									},
									oSearch: { sSearch: value },
									createdRow: function(row,data,dataIndex){
										$(row).click(function(){
											$(self).val(antes).focusin().val(data[0]).focusout();
											alertify.myAlert().close();
										});
									},
									deferRender: true,
									scrollY: screen.height - 400,
									scroller: {
										loadingIndicator: true
									},
									dom: 'ftri'
								}
								dtSS(config);
							}
						});
					}
					var campos = encodeURIComponent(JSON.stringify(['Código', 'Id', 'Nombre']));
					alertify.ajaxAlert(base_url()+"Busqueda/DataTable?campos=" + campos);
				}else{
					lastFocus = antes;
					respuesta = JSON.parse(respuesta);
					doc = $(self).closest('.input-group').find("input").val();
					$(self).closest('.input-group').find('span').text(respuesta[0]['nombre']).attr('title', respuesta[0]['nombre']);      
				}
			}
		});
	}
} */

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

function addCommas(nStr) {
	if (nStr != 'null') {
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}else{
		return '0';
	}
}