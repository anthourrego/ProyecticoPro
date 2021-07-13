<div class="row form-group">
	<div class="col-md-3 col-xl-2">
		<button class="btn btn-primary botones" form="frmModificar" type="submit">Guardar</button>
	</div>
</div>

<form id="frmModificar" autocomplete="off">
	<div id="editor">
		<?= $reporte; ?>
	</div>
</form>

<script type="text/javascript">
	var $REPORTE = "<?= $nom_reporte; ?>"
</script>