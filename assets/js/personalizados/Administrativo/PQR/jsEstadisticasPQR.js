var lastFocus = '';

fechas = {
	fechaIni: $('[name=fecha1]').val(),
	fechaFin: $('[name=fecha2]').val()
};

var tbl = "(SELECT * FROM HeadPQR HPQR ";

var DTtblDependencia
	,DTtblReclamo
	,DTtblSeccion
	,DTtblResponsable
	,DTtblCausa
	,DTtblClasificacion
	,DTtblEstado
	,DTtblOperacion
	,DTtblProblema
	,DTtblCiudad
	,DTtblUsuario
	,DTtblProducto
	,DTtblMaterial;
	//,DTtblVendedor;

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
	cliente = '',
	clienteNombre = '',
	//asesor = '',
	//dependencia = '',	
	//producto = '',
	//productoNombre = '',
	//material = '',
	//materialNombre = '';
	//vendedor = '',

$(function(){
	$(".chosen-select").chosen({width: '100%'});

	getId();

	tbl += "WHERE CAST(HPQR.Fecha AS DATE) BETWEEN '" + fecha1 + "' AND '" + fecha2 + "' ";

	/* if(procal != '' && procal != null){
		procal = organizarCadena(procal);
		tbl += "AND HPQR.Calidad IN ("+procal+") ";
	} */

	/* if(operacion != '' && operacion != null){
		operacion = organizarCadena(operacion);
		tbl += "AND HPQR.Operacion IN ("+operacion+") ";
	} */

	if(causapqr != '' && causapqr != null){
		causapqr = organizarCadena(causapqr);
		tbl += "AND HPQR.Causa IN ("+causapqr+") ";
	}

	/* if(responsable != '' && responsable != null){
		responsable = organizarCadena(responsable);
		tbl += "AND HPQR.Responsable IN ("+responsable+") ";
	} */

	/* if(seccion != '' && seccion != null){
		seccion = organizarCadena(seccion);
		tbl += "AND H.Seccion IN ("+seccion+") ";
	} */

	if(estado != '' && estado != null){
		estado = organizarCadena(estado);
		tbl += "AND HPQR.EstadoId IN ("+estado+") ";
	}
	if(tipo != '' && tipo != null){
		tipo = organizarCadena(tipo);
		tbl += "AND HPQR.TipoPQRId IN ("+tipo+") ";
	}

	if(ciudad != '' && ciudad != null){
		ciudad = organizarCadena(ciudad);
		tbl += "AND HPQR.TerceroID IN (SELECT T1.TerceroId FROM Tercero T1 WHERE T1.Ciudadid IN ("+ciudad+")) ";
	}

	if(cliente != '' && cliente != null){
		cliente = organizarCadena(cliente);
		tbl += "AND HPQR.TerceroID IN ("+cliente+") ";
	}

	/* if(asesor != '' && asesor != null){
		asesor = organizarCadena(asesor);
		tbl += "AND HPQR.UsuarioId IN ("+asesor+") ";
	} */

	/* if(dependencia != '' && dependencia != null){
		dependencia = organizarCadena(dependencia);
		tbl += "AND HPQR.DependenciaId IN ("+dependencia+") ";
	} */

	/* if(producto != '' && producto != null){
		producto = organizarCadena(producto);
		tbl += "AND HPQR.PQRId IN (SELECT P1.PQRId FROM ProductoPQR P1 WHERE P1.ProductoId IN ("+producto+")) ";
	} */
/* 
	if(material != '' && material != null){
		material = organizarCadena(material);
		tbl += "AND HPQR.PQRId IN (SELECT P2.PQRId FROM ProductoPQR P2 WHERE P2.MaterialId IN ("+material+")) ";
	}

	if(vendedor != '' && vendedor != null){
		vendedor = organizarCadena(vendedor);
		tbl += `AND HPQR.PQRId IN (SELECT
										HPQ.pqrid
									FROM HeadPQR HPQ
									LEFT JOIN PWEBHeadPedi HP1 ON HPQ.Pedido = HP1.pedido
									LEFT JOIN PWEBHeadPedi HP2 ON HPQ.PedidoId = HP2.pedidoid
									WHERE CASE WHEN HP2.vendedorid IS NOT NULL THEN HP2.vendedorid ELSE HP1.vendedorid END IN (`+vendedor+`))`;
	} */

	tbl += ') H';

	// Dependencia
	/* var config = {
		data: {
			tblID: "#tblDependencia",
			select: [
				'RTRIM(LTRIM(D.Nombre)) AS Nombre',
				'COUNT(H.PQRId) AS Total'
			],
			table: [
				tbl,
				[
					['Dependencia D', 'H.DependenciaId = D.DependenciaId', 'LEFT']
				]
			],
			group_by: [
				'D.Nombre'
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['D.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblDependencia = dtSS(config); */

	// Reclamo Proveedor
	/* var config = {
		data: {
			tblID: "#tblReclamo",
			select: [
				'RTRIM(LTRIM(H.ReclamoProveedor)) AS Nombre',
				'COUNT(H.PQRId) AS Total'
			],
			table: [
				tbl
			],
			group_by: [
				'H.ReclamoProveedor'
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['H.ReclamoProveedor'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
			if(data[0] == '1'){
				$(row).find('td:eq(0)').text('Sí');
			}else if(data[0] == '0'){
				$(row).find('td:eq(0)').text('No');
			}
		}
	};
	DTtblReclamo = dtSS(config); */

	// Sección
	/* var config = {
		data: {
			tblID: "#tblSeccion",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT C.Nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN CausaPQR C ON H.Seccion = C.CausaPQRId AND C.Tipo = 'S' \
				GROUP BY C.Nombre \
				UNION \
				SELECT 'Otra Sección' AS Nombre, COUNT(PQRId) AS Total \
				FROM "+tbl+" WHERE OtraSeccion IS NOT NULL) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblSeccion = dtSS(config); */

	// Responsable
	/* var config = {
		data: {
			tblID: "#tblResponsable",
			select:	[
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT C.Nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN CausaPQR C ON H.Responsable = C.CausaPQRId AND C.Tipo = 'R' \
				GROUP BY C.Nombre \
				UNION \
				SELECT 'Otro Responsable' AS Nombre, COUNT(PQRId) \
				FROM "+tbl+" WHERE OtraResponsable IS NOT NULL) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblResponsable = dtSS(config); */

	// Causa
	var config = {
		data: {
			tblID: "#tblCausa",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT C.Nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN CausaPQR C ON H.Causa = C.CausaPQRId AND C.Tipo = 'C' \
				GROUP BY C.Nombre \
				UNION \
				SELECT 'Otra Causa' AS Nombre, COUNT(PQRId) AS Total \
				FROM "+tbl+" WHERE OtraCausa IS NOT NULL) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: domBftrip,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			},
			{ extend: 'pageLength'}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblCausa = dtSS(config);

	// TipoPQRId (Clasificación)
	var config = {
		data: {
			tblID: "#tblClasificacion",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT T.Nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN TipoPQR T ON H.TipoPQRId = T.TipoPQRId \
				GROUP BY T.Nombre) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: domBftrip,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			},
			{ extend: 'pageLength'}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblClasificacion = dtSS(config);

	// Cliente
	var config = {
		data: {
			tblID: "#tblCliente",
			select: [
				'RTRIM(LTRIM(x.TerceroID)) AS TerceroID',
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT T.TerceroID, T.nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN Tercero T ON H.TerceroId = T.TerceroID \
				GROUP BY T.TerceroID, T.nombre) X"
			],
			column_order: [
				'TerceroID',
				'Nombre',
				'Total'
			],
			column_search: ['x.TerceroID','x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'TerceroID',
				'Nombre',
				'Total'
			]
		},
		dom: domBftrip,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}, 
			{ extend: 'pageLength'}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblCliente = dtSS(config);

	// Estado
	var config = {
		data: {
			tblID: "#tblEstado",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT E.nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN EstadoPQR E ON H.EstadoId = E.EstadoId \
				GROUP BY E.Nombre) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: domBftrip,
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			},
			{ extend: 'pageLength'}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblEstado = dtSS(config);

	// Operación
	/* var config = {
		data: {
			tblID: "#tblOperacion",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT C.Nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN CausaPQR C ON H.Operacion = C.CausaPQRId AND C.Tipo = 'O' \
				GROUP BY C.Nombre \
				UNION \
				SELECT 'Otra Operación' AS Nombre, COUNT(PQRId) AS Total \
				FROM "+tbl+" WHERE OtraOperacion IS NOT NULL) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblOperacion = dtSS(config); */

	// Problema de Calidad
	/* var config = {
		data: {
			tblID: "#tblProblema",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT C.Nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN CausaPQR C ON H.Operacion = C.CausaPQRId AND C.Tipo = 'O' \
				GROUP BY C.Nombre \
				UNION \
				SELECT 'Otra Operación' AS Nombre, COUNT(PQRId) AS Total \
				FROM "+tbl+" WHERE OtraOperacion IS NOT NULL) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblProblema = dtSS(config); */

	// Ciudad / Asesor
	/* var config = {
		data: {
			tblID: "#tblCiudad",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT C.nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN Tercero T ON H.TerceroId = T.TerceroID \
				LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid \
				GROUP BY C.nombre) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblCiudad = dtSS(config); */

	// Usuario
	/* var config = {
		data: {
			tblID: "#tblUsuario",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT S.nombre, COUNT(H.PQRId) AS Total FROM "+tbl+" \
				LEFT JOIN Segur S ON H.UsuarioId = S.usuarioId \
				GROUP BY S.nombre) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblUsuario = dtSS(config); */

	// Producto
	/* var config = {
		data: {
			tblID: "#tblProducto",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT 'Otro Producto' AS Nombre, COUNT(PQRId) AS Total \
				FROM "+tbl+" WHERE Producto IS NOT NULL \
				UNION \
				SELECT HP.nombre, COUNT(P.PQRId) AS Total FROM ProductoPQR P \
				INNER JOIN "+tbl+" ON P.PQRId = H.PQRId \
				LEFT JOIN Producto PP ON P.ProductoId = PP.productoid \
				LEFT JOIN HeadProd HP ON PP.headprodid = HP.headprodid \
				GROUP BY HP.nombre) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblProducto = dtSS(config); */

	// Material
	/* var config = {
		data: {
			tblID: "#tblMaterial",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				"(SELECT 'Otro Material' AS Nombre, COUNT(PQRId) AS Total \
				FROM "+tbl+" WHERE Material IS NOT NULL \
				UNION \
				SELECT HP.nombre, COUNT(P.PQRId) AS Total FROM ProductoPQR P \
				INNER JOIN "+tbl+" ON P.PQRId = H.PQRId \
				LEFT JOIN Producto PP ON P.MaterialId = PP.productoid \
				LEFT JOIN HeadProd HP ON PP.headprodid = HP.headprodid \
				GROUP BY HP.nombre) X"
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblMaterial = dtSS(config); */

	// Vendedor
	/* var config = {
		data: {
			tblID: "#tblVendedor",
			select: [
				'RTRIM(LTRIM(x.Nombre)) AS Nombre',
				'X.Total'
			],
			table: [
				`(SELECT
					V.nombre
					,COUNT(*) Total
				FROM `+tbl+` 
				LEFT JOIN PWEBHeadPedi HP1 ON H.Pedido = HP1.pedido
				LEFT JOIN PWEBHeadPedi HP2 ON H.PedidoId = HP2.pedidoid
				LEFT JOIN Vendedor V ON CASE WHEN HP2.vendedorid IS NOT NULL THEN HP2.vendedorid ELSE HP1.vendedorid END = V.vendedorId 
				GROUP BY V.nombre ) X`
			],
			column_order: [
				'Nombre',
				'Total'
			],
			column_search: ['x.nombre'],
			orden: {'Total': 'DESC'},
			columnas: [
				'Nombre',
				'Total'
			]
		},
		dom: 'lBfrtip',
		pageLength: 10,
		buttons: [
			{ extend: 'copy', className: 'copyButton', text: 'Copiar' },
			{ extend: 'csv', className: 'csvButton', text: 'CSV' },
			{ extend: 'excel', action: newExportAction, text: 'Excel' },
			{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
			{ extend: 'print', className: 'printButton', text: 'Imprimir' },
			{ extend: 'excel', action: graficarAction, text: 'Graficar', 
				columnas: {
					data: [0],
					value: [1]
				}
			}
		],
		createdRow: function(row, data, dataIndex){
			$(row).find('td:eq(1)').text(addCommas(data[1]));
		}
	};
	DTtblVendedor = dtSS(config); */

	$("#btnCargar").click(function(e){
		e.preventDefault();
		var url = base_url()+"Administrativo/PQR/EstadisticasPQR?\
		fecha1="+$('#fecha1').val()+'&\
		fecha2='+$('#fecha2').val()+'&\
		causapqr='+$('#causapqr').val()+'&\
		estado='+$('#estado').val()+'&\
		tipo='+$('#tipo').val()+'&\
		ciudad='+$('#ciudad').val()+'&\
		cliente='+$('#TerceroId').val();
		window.location.href = url;
	});
    
/* 
	$(document).on("focusout", "#ProductoId", function(){
		if($(this).val().trim() != ''){
			consultaProducto($(this).val().trim(), this);
		} else {
			$("#ProductoId").val("");
			$("#ProductoNombre").text("Todos");
		}
	});

	$(document).on("focusout", "#MaterialId", function(){
		if($(this).val().trim() != ''){
			cargarMaterial($(this).val().trim(), this);
		} else {
			$("#MaterialId").val("");
			$("#MaterialNombre").text("Todos");
		}
	}); */
});

function getId(){

	url = new URL(url_string);

	fecha1 = url.searchParams.get("fecha1");
	if(fecha1 != null && fecha1 != ''){
		$('#fecha1').val(fecha1);
	}else{
		fecha1 = $('#fecha1').val(); //moment($('#fecha1').val(), 'DD-MM-YYYY').format("YYYY-MM-DD");
	}

	fecha2 = url.searchParams.get("fecha2");
	if(fecha2 != null && fecha2 != ''){
		$('#fecha2').val(fecha2);
	}else{
		fecha2 = $('#fecha2').val(); //moment($('#fecha2').val(), 'DD-MM-YYYY').format("YYYY-MM-DD");
	}

	//procal = url.searchParams.get("procal");
	//operacion = url.searchParams.get("operacion");
	causapqr = url.searchParams.get("causapqr");
	//responsable = url.searchParams.get("responsable");
	//seccion = url.searchParams.get("seccion");
	estado = url.searchParams.get("estado");
	tipo = url.searchParams.get("tipo");
	ciudad = url.searchParams.get("ciudad");
	//asesor = url.searchParams.get("asesor");
	//dependencia = url.searchParams.get("dependencia");
	//vendedor = url.searchParams.get("vendedor");

	cliente = url.searchParams.get("cliente");
	if(cliente != null && cliente != ''){
		$('#TerceroId').val(cliente).trigger("chosen:updated");
	}

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
	}
	

	materialNombre = url.searchParams.get("materialNombre");
	if(materialNombre != null && materialNombre != ''){
		$('#MaterialNombre').text(materialNombre);
	} else {
		$('#MaterialNombre').text("Todos");
	} */
	
}
/* 
function consultaProducto(id, input) { 
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
}

function cargarMaterial(id, input) {
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

// Recibe 05004,27006 y retorna '05004','27006'
function organizarCadena(string){
	string = string.split(',');
	var cadena = "";
	for (var i = 0; i < string.length; i++) {
		if(i!=0){
			cadena += ',';
		}
		cadena += "'" + string[i] + "'";
	}
	return cadena;
}

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