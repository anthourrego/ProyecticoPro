<style type="text/css">
	.ajs-content{
	    padding: 0px 10px !important;
	}
	#tblBusqueda,#tblBusqueda td,#tblBusqueda tr,#tblBusqueda th{
		border-color: #ccc;
	}
	#tblBusqueda_filter label, #tblBusqueda_filter label input {
		width: 100%;
		margin: 0;
	}
	.ajs-footer {
		display: none;
	}
	.ajs-header {
		border: 0 !important;
	}
	#tblBusqueda td:not(.dataTables_empty) {
		cursor: pointer;
	}
</style>
<table class="table table-bordered table-sm table-hover table-fixed table-striped" id="tblBusqueda" cellspacing="0" width="100%">
	<thead>
		<tr>
		<?php if(count($campos) > 0){
			foreach ($campos as $key) { ?>
				<th><?= $key ?></th>
			<?php }
		}else{ ?>
			<th>Código</th>
			<th>Nombre</th>
		<?php } ?>
		</tr>
	</thead>
	<tbody></tbody>
</table>