<style type="text/css">
	td.text-center {
		width: 1%;
	}
	.gj-checkbox-glyphicons input[type="checkbox"]:checked + span::after {
		content: '\2714';
	}
	.glyphicon.glyphicon-plus::after {
		content: '\2795';
	}
	.glyphicon.glyphicon-minus::after {
		content: '\2796';
	}
	#accesosGenerales .list-group-item {
		background-color: transparent;
	}
</style>

<div class="row form-group">
	<div class="col-md-2">
		<button class="btn btn-success w-100" id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
	</div>
	<label class="col-md-2 col-form-label col-form-label-md text-md-right">Permisos&nbsp;para</label>
	<div class="col-md-8">
		<input type="text" class="form-control" readonly value="<?= $perfil ?>">
	</div>
</div>
<ul class="nav nav-tabs">
	<li class="nav-item">
		<a href="#accesosGenerales" data-toggle="tab" class="nav-link active" role="tab" aria-selected="true">
			Accesos Generales
		</a>
	</li>
	<!-- <li class="nav-item">
		<a href="#autorizaciones" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
			Autorizaciones
		</a>
	</li> -->
	<li class="nav-item">
		<a href="#terceros" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
			Terceros
		</a>
	</li>
</ul>

<div class="card border-top-0" style="border-top-left-radius: 0;border-top-right-radius: 0;">
	<div class="card-body tab-content">
		<div class="tab-pane fade show active" id="accesosGenerales" role="tabpanel">
			<div class="row form-group">
				<div class="col-md-3">
					<button class="btn btn-light btn-outline-secondary w-75 p-0 mx-auto d-block" id="btnMarcarTODOS">
						<span class="far fa-edit"></span>
						<small><br/>Marcar<br/>TODOS</small>
					</button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-light btn-outline-secondary w-75 p-0 mx-auto d-block" id="btnDesmarcarTODOS">
						<span class="far fa-trash-alt"></span>
						<small><br/>Desmarcar<br/>TODOS</small>
					</button>
				</div>
			</div>
			<div class="row">
				<div id="tree"></div>
			</div>
		</div>
		<div class="tab-pane fade" id="autorizaciones">
			<div class="row">
				<div id="tree2"></div>
			</div>
		</div>
		<div class="tab-pane fade" id="terceros">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<b class="col-md-4">Terceros</b>
						<div class="custom-control custom-checkbox col-md-4">
							<input type="checkbox" class="custom-control-input" id="CrearTercero" <?= ( in_array(0, $permisos['TERCCrear']) ? 'checked' : '' ) ?> data-per="0" data-tipo="Crear">
							<label class="custom-control-label" for="CrearTercero">Crear</label>
						</div>
						<div class="custom-control custom-checkbox col-md-4">
							<input type="checkbox" class="custom-control-input" id="EliminarTercero" <?= ( in_array(0, $permisos['TERCElimi']) ? 'checked' : '' ) ?> data-per="0" data-tipo="Elimi">
							<label class="custom-control-label" for="EliminarTercero">Eliminar</label>
						</div>
						<b class="col-md-4">Sucursales</b>
						<div class="custom-control custom-checkbox col-md-4">
							<input type="checkbox" class="custom-control-input" id="CrearSucursal" <?= ( in_array(60, $permisos['TERCCrear']) ? 'checked' : '' ) ?> data-per="60" data-tipo="Crear">
							<label class="custom-control-label" for="CrearSucursal">Crear</label>
						</div>
						<div class="custom-control custom-checkbox col-md-4">
							<input type="checkbox" class="custom-control-input" id="EliminarSucursal" <?= ( in_array(60, $permisos['TERCElimi']) ? 'checked' : '' ) ?> data-per="60" data-tipo="Elimi">
							<label class="custom-control-label" for="EliminarSucursal">Eliminar</label>
						</div>
						
					</div>
				</div>
				<div class="col-md-6">
					<div class="custom-control custom-checkbox row">
						<input type="checkbox" class="custom-control-input" id="HabilitarClienteProveedor" <?= ( in_array(86, $permisos['TERCModif']) ? 'checked' : '' ) ?> data-per="86" data-tipo="Modif">
						<label class="custom-control-label" for="HabilitarClienteProveedor">Habilitar como Cliente / Proveedor</label>
					</div>
					<div class="row">
						<b class="col-md-4">Contactos</b>
						<div class="custom-control custom-checkbox col-md-4">
							<input type="checkbox" class="custom-control-input" id="CrearContacto" <?= ( in_array(71, $permisos['TERCCrear']) ? 'checked' : '' ) ?> data-per="71" data-tipo="Crear">
							<label class="custom-control-label" for="CrearContacto">Crear</label>
						</div>
						<div class="custom-control custom-checkbox col-md-4">
							<input type="checkbox" class="custom-control-input" id="EliminarContacto" <?= ( in_array(71, $permisos['TERCElimi']) ? 'checked' : '' ) ?> data-per="71" data-tipo="Elimi">
							<label class="custom-control-label" for="EliminarContacto">Eliminar</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-3">
					<button class="btn btn-light btn-outline-secondary w-75 p-0 mx-auto d-block" id="btnMarcarCREAR">
						<span class="far fa-edit"></span>
						<small><br/>Marcar<br/>CREAR</small>
					</button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-light btn-outline-secondary w-75 p-0 mx-auto d-block" id="btnDesmarcarCREAR">
						<span class="far fa-trash-alt"></span>
						<small><br/>Desmarcar<br/>CREAR</small>
					</button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-light btn-outline-secondary w-75 p-0 mx-auto d-block" id="btnMarcarMODIFICAR">
						<span class="far fa-edit"></span>
						<small><br/>Marcar<br/>MODIFICAR</small>
					</button>
				</div>
				<div class="col-md-3">
					<button class="btn btn-light btn-outline-secondary w-75 p-0 mx-auto d-block" id="btnDesmarcarMODIFICAR">
						<span class="far fa-trash-alt"></span>
						<small><br/>Desmarcar<br/>MODIFICAR</small>
					</button>
				</div>
			</div>
			<div class="row d-block">
				<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUD" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Campo</th>
							<th>Crear</th>
							<th>Modificar</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($perfilesTercero as $key => $value) { ?>
							<tr>
								<td><?= $value ?></td>
								<td class="text-center">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="PTC<?= $key ?>" <?= ( in_array($key, $permisos['TERCCrear']) ? 'checked' : '' ) ?> data-per="<?= $key ?>" data-tipo="Crear">
										<label class="custom-control-label" for="PTC<?= $key ?>"></label>
									</div>
								</td>
								<td class="text-center">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="PTM<?= $key ?>" <?= ( in_array($key, $permisos['TERCModif']) ? 'checked' : '' ) ?> data-per="<?= $key ?>" data-tipo="Modif">
										<label class="custom-control-label" for="PTM<?= $key ?>">&nbsp;</label>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var $SEGUR = <?= json_encode($permisos['SEGUR']) ?>;
	var $TERCCrear = <?= json_encode($permisos['TERCCrear']) ?>;
	var $TERCModif = <?= json_encode($permisos['TERCModif']) ?>;
	var $TERCElimi = <?= json_encode($permisos['TERCElimi']) ?>;
	var $ID = "<?= $id; ?>";
	var $PERFIL = "<?= $tipo; ?>";
</script>