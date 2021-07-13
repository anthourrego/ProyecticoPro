<div data-auto class="d-none">
	<label class="mb-0" for="crmdatoid"><span class="text-danger">*</span>Código</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="crmdatoid" data-required data-codigo data-identity-insert>
</div>
<label class="mb-0" for="nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="60" data-required>
<div class="d-none">
	<label class="mb-0" for="crmtablaid">crmtablaid</label>
	<input type="text" class="form-control form-control-sm" data-db="crmtablaid" data-required value="<?= $_GET['crmtablaid'] ?>">
</div>

<script type="text/javascript">
	$PARAMETROS.columnDefs = [
		{ orderable: false, targets: [0], width: '5%' }
		,{ targets: [1], width: '1%' }
		,{ targets: [3], visible: false }
	];
	var url_string = window.location.href;
	var url = new URL(url_string);
	var crmtablaid = url.searchParams.get("crmtablaid");
	$PARAMETROS.ajax = {
		url: "<?= base_url() ?>Administrativo/Configuracion/Terceros/ItemCampoAdicional/dataTableSSCRUD",
		type: 'POST',
		data: {
			crmtablaid: crmtablaid
		}
	};
</script>