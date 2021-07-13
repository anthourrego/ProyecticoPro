var nombreOpcion = '',
cAlertify;

var dataTbl = {};

var dtTblTiempoAsistentes = $('#tblTiempoAsistentes').DataTable({
	language,
	processing: true,
	ajax: {
		url: base_url()+'Administrativo/Actas/Consultas/qTiempoAsistentes',
		type: 'POST',
		data: function(d){
			return $.extend(d, dataTbl);
		}
	},
	columns: [
		{data: 'Asistente', width: '60%'},
		{data: 'Cantidad', width: '20%'},
		{data: 'Tiempo', width: '20%'},
	],
	pageLength: 10,
	autoWidth: false,
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
		{ extend: 'print', className: 'printButton', text: 'Imprimir' },
		{ extend: 'excel', action: newGraficarAction, text: 'Graficar', 
			columnas: {
				data: [0],
				value: [2]
			} 
		},
		{ extend: 'pageLength'}
	],
	createdRow:function(row, data, dataIndex){
		if(data.Tiempo == null || data.Tiempo == '.00'){
			data.Tiempo = 0;
		}
		$(row).find('td:eq(2)').html(segundosDias(parseInt(data.Tiempo)));
	}
});

var dtTblTiempoMes = $('#tblTiempoMes').DataTable({
	language,
	processing: true,
	ajax: {
		url: base_url()+'Administrativo/Actas/Consultas/qTiempoMes',
		type: 'POST',
		data: function(d){
			return $.extend(d, dataTbl);
		}
	},
	columns: [
		{data: 'Mes', width: '60%'},
		{data: 'Cantidad', width: '20%'},
		{data: 'Tiempo', width: '20%'},
	],
	pageLength: 10,
	autoWidth: false,
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
		{ extend: 'print', className: 'printButton', text: 'Imprimir' },
		{ extend: 'excel', action: newGraficarAction, text: 'Graficar', 
			columnas: {
				data: [0],
				value: [2]
			} 
		},
		{ extend: 'pageLength'}
	],
	createdRow:function(row, data, dataIndex){
		if(data.Tiempo == null || data.Tiempo == '.00'){
			data.Tiempo = 0;
		}
		$(row).find('td:eq(2)').html(segundosDias(parseInt(data.Tiempo)));
	}
});

var dtTblTiempoTipoReunion = $('#tblTiempoTipoReunion').DataTable({
	language,
	processing: true,
	ajax: {
		url: base_url()+'Administrativo/Actas/Consultas/qTiempoTipoReunion',
		type: 'POST',
		data: function(d){
			return $.extend(d, dataTbl);
		}
	},
	columns: [
		{data: 'TipoReunion', width: '60%'},
		{data: 'Cantidad', width: '20%'},
		{data: 'Tiempo', width: '20%'},
	],
	pageLength: 10,
	autoWidth: false,
	dom: domBftrip,
	buttons: [
		{ extend: 'excel', className: 'excelButton', text: 'Excel' },
		{ extend: 'pdf', className: 'pdfButton', tex: 'PDF' },
		{ extend: 'print', className: 'printButton', text: 'Imprimir' },
		{ extend: 'excel', action: newGraficarAction, text: 'Graficar', 
			columnas: {
				data: [0],
				value: [2]
			} 
		},
		{ extend: 'pageLength'}
	],
	createdRow:function(row, data, dataIndex){
		if(data.Tiempo == null || data.Tiempo == '.00'){
			data.Tiempo = 0;
		}
		$(row).find('td:eq(2)').html(segundosDias(parseInt(data.Tiempo)));
	}
});

$(function(){
    $("#fTipo").val("");

    $(".chosen-select").chosen();

    $('#fTipo, .cargaFiltro').on('change', function(){
        cargarCondiciones();
        tab = $('#list-tab a.active')
        tab.removeClass("active");
        tab.tab('show');
    });

    var valueFocus;
    $('#fInicio, #fFin, #fAnio').off('focusin').on('focusin', function(){
        valueFocus = $(this).val();
    }).off('focusout').on('focusout', function(){
        if($(this).val() != valueFocus){
            cargarCondiciones();
            tab = $('#list-tab a.active')
            tab.removeClass("active");
            tab.tab('show');
        }
    });

    $('a[data-toggle=list]').on('show.bs.tab', function(){
        nombreOpcion = $(this).text();
        $('.contenidoGrafica').remove();
        $('#list-tab a[data-toggle=list]').removeClass('active');
        $(this).addClass('active');
        var tabla = $(this).attr('data-tabla');
    
        eval(tabla+'.ajax.reload();');
    });
});

function cargarCondiciones(){
    value = $('#fTipo').val();
	if(value != ''){
		$('.'+value).removeClass('d-none');
		$('.divFiltro').not('.'+value).addClass('d-none');
		//campo = $('#list-tab a.active').attr('campo-fecha');
		dataTbl.opcionFecha = value;
		switch (value){
			case 'fechas':
				dataTbl.fechaIni = $('#fInicio').val();
				dataTbl.fechaFin = $('#fFin').val();
			break;
			case 'mes':
				dataTbl.mes = $('#fMes').val();
				dataTbl.anio = $('#fAnio2').val();
			break;
			case 'anio':
				dataTbl.anio = $('#fAnio').val();
			break;
			default:
				delete(dataTbl.opcionFecha);
				delete(dataTbl.fechaIni);
				delete(dataTbl.fechaFin);
				delete(dataTbl.mes);
				delete(dataTbl.anio);
			break;
		}
	}else{
		$('.divFiltro').addClass('d-none');
		delete(dataTbl.opcionFecha);
		delete(dataTbl.fechaIni);
		delete(dataTbl.fechaFin);
		delete(dataTbl.mes);
		delete(dataTbl.anio);
	}
}

function segundosDias(Tiempo){
	var seconds = parseInt(Tiempo, 10);
	var days = Math.floor(seconds / (3600 * 24));

	seconds -= days * 3600 * 24;
	var hrs = Math.floor(seconds / 3600);
	seconds -= hrs*3600;
	var mnts = Math.floor(seconds / 60);
	seconds -= mnts*60;

	if(days > 0){
		if(days > 99)
			return (addCommas(days) + ':' + ('0' + hrs).slice(-2) + ':' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
		else
			return (('0' + days).slice(-2) + ':' + ('0' + hrs).slice(-2) + ':' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
	}else if(hrs > 0){
		return (('0' + hrs).slice(-2) + ':' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
	}else{
		return ( '00:' + ('0' + mnts).slice(-2) + ':' + ('0' + seconds).slice(-2));
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