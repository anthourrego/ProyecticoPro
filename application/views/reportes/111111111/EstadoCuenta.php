<table cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td colspan="8" style="text-align:center"><span style="font-size:11px"><strong><?= $Empresa ?></strong></span></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1" style="text-align:center"><span style="font-size:11px"><strong>NIT : <?= $NIT ?></strong></span></td>
		</tr>
		<tr>
			<td colspan="7" style="text-align:center"><span style="font-size:11px"><strong><?= $Regimen ?></strong></span></td>
		</tr>
		<tr>
			<td colspan="7" style="text-align:center"><span style="font-size:11px"><strong>DIRECCION : <?= $Direccion ?></strong></span></td>
		</tr>
		<tr>
			<td colspan="7" style="text-align:center"><span style="font-size:11px"><strong>Tel&eacute;fonos: <?= $Telefono ?> | <?= $Ciudad ?></strong></span></td>
		</tr>
		<tr>
			<td colspan="7">
			<hr /></td>
		</tr>
		<tr>
			<td colspan="5" rowspan="1" style="text-align:center"><span style="font-size:11px"><strong>ESTADO DE CUENTA</strong></span></td>
			<td colspan="2" rowspan="1"><span style="font-size:11px"><strong>Fecha : </strong><?= $Fecha ?></span></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1"><span style="font-size:11px"><strong>En este estado de cuenta se muestran los consumos y el alojamiento de forma detallada si tiene alg&uacute;n reparo haganoslo saber.</strong></span></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1">
			<hr /></td>
		</tr>
		<tr>
			<td style="text-align:right"><span style="font-size:11px"><strong>NIT / CC :</strong></span></td>
			<td><span style="font-size:11px">&nbsp;<?= $DocumentoFacturado ?></span></td>
			<td colspan="3" style="text-align:right"><span style="font-size:11px"><strong>Reserva : </strong></span></td>
			<td colspan="2" rowspan="1"><span style="font-size:11px">&nbsp;<?= $Reserva ?></span></td>
		</tr>
		<tr>
			<td style="text-align:right"><span style="font-size:11px"><strong>Nombre / Empresa :</strong></span></td>
			<td><span style="font-size:11px">&nbsp;<?= $TerceroFacturado ?></span></td>
			<td colspan="3" style="text-align:right"><span style="font-size:11px"><strong>Fecha Ingreso :</strong></span></td>
			<td colspan="2" rowspan="1"><span style="font-size:11px">&nbsp;<?= $Llegada ?></span></td>
		</tr>
		<tr>
			<td style="text-align:right"><span style="font-size:11px"><strong>Ciudad y Direcci&oacute;n :</strong></span></td>
			<td><span style="font-size:11px">&nbsp;<?= $Ciudad ?> <?= $Direccion ?></span></td>
			<td colspan="3" style="text-align:right"><span style="font-size:11px"><strong>Fecha Salida :</strong></span></td>
			<td colspan="2" rowspan="1"><span style="font-size:11px">&nbsp;<?= $Salida ?></span></td>
		</tr>
		<tr>
			<td style="text-align:right"><span style="font-size:11px"><strong>Tel&eacute;fono :</strong></span></td>
			<td><span style="font-size:11px">&nbsp;<?= $Telefono ?></span></td>
			<td colspan="3">&nbsp;</td>
			<td colspan="2" rowspan="1">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1">
			<hr /></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1"><span style="font-size:11px"><?= $EstadoCuenta ?></span></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1">
			<hr /></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align:right"><span style="font-size:11px"><strong>TOTAL ALOJAMIENTOS Y CONSUMOS</strong></span></td>
			<td colspan="2" style="text-align:right"><span style="font-size:12px">$ <?= $AlojamientoConsumos ?></span></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align:right"><span style="font-size:11px"><strong>IVA</strong></span></td>
			<td colspan="2" style="text-align:right"><span style="font-size:12px">$ <?= $Iva ?></span></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align:right"><span style="font-size:11px"><strong>TOTAL</strong></span></td>
			<td colspan="2" style="text-align:right"><span style="font-size:12px">$ <?= $ValorTotal ?></span></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align:right"><span style="font-size:11px"><strong>Anticipos</strong></span></td>
			<td colspan="2" style="text-align:right"><span style="font-size:12px">$ <?= $Anticipos ?></span></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align:right"><span style="font-size:11px"><strong>TOTAL A CANCELAR</strong></span></td>
			<td colspan="2" style="text-align:right"><span style="font-size:12px"><strong>$ <?= $TotalCancelar ?></strong></span></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="4" style="text-align:center">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center"><span style="font-size:11px"><strong>____________________________________________</strong></span></td>
			<td>&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:center"><span style="font-size:11px"><strong>____________________________________________</strong></span></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center"><span style="font-size:11px"><strong>Firma de la Empresa</strong></span></td>
			<td>&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:center"><span style="font-size:11px"><strong>Recib&iacute; Conforme CC. O NIT</strong></span></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1">
			<hr /></td>
		</tr>
		<tr>
			<td colspan="7" rowspan="1"><span style="font-size:10px">ESTE DOCUMENTO NO ES CONSTANCIA DE PAGO, SOLO ES UNA RELACION PARCIAL DEL PAGO FINAL DE LA CUENTA NO VALIDO COMO DOCUMENTO CONTABLE</span></td>
		</tr>
		<tr>
			<td colspan="7"><span style="font-size:10px">Usuario: <?= $UsuarioActual ?> Fecha: <?= $FechaHora ?></span></td>
		</tr>
	</tbody>
</table>
