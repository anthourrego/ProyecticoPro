<style>
	.wizard {
		margin: 0px auto;
		background: #fff;
	}

	.wizard .nav-tabs {
		position: relative;
		margin: 0px auto;
		margin-bottom: 0;
		border-bottom-color: #e0e0e0;
	}

	.wizard > div.wizard-inner {
		position: relative;
	}

	.connecting-line {
		height: 2px;
		background: #e0e0e0;
		position: absolute;
		width: 80%;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: 50%;
		z-index: 1;
	}

	.wizard .nav-tabs > li.active > a,
	.wizard .nav-tabs > li.active > a:hover,
	.wizard .nav-tabs > li.active > a:focus {
		color: #555555;
		cursor: default;
		border: 0;
		border-bottom-color: transparent;
	}

	span.round-tab {
		width: 70px;
		height: 70px;
		line-height: 70px;
		display: inline-block;
		border-radius: 100px;
		background: #fff;
		border: 2px solid #e0e0e0;
		z-index: 2;
		position: absolute;
		left: 0;
		text-align: center;
		font-size: 25px;
	}

	span.round-tab i {
		color: #555555;
	}

	.wizard li a.active span.round-tab {
		background: #fff;
		border: 2px solid #3a77bc;

	}

	.wizard li a.active span.round-tab i {
		color: #3a77bc;
	}

	span.round-tab:hover {
		color: #333;
		border: 2px solid #333;
	}

	.wizard .nav-tabs > li {
		width: 19%;
	}

	.wizard li a:after {
		content: " ";
		position: relative;
		left: 46%;
		top: -20px;
		opacity: 0;
		margin: 0 auto;
		bottom: 0px;
		border: 5px solid transparent;
		border-bottom-color: #3a77bc;
		transition: 0.1s ease-in-out;
	}

	.wizard li.active.nav-item:after {
		content: " ";
		position: relative;
		left: 46%;
		top: -20px;
		opacity: 1;
		margin: 0 auto;
		bottom: 0px;
		border: 10px solid transparent;
		border-bottom-color: #5bc0de;
	}

	.wizard .nav-tabs > li a {
		width: 70px;
		height: 70px;
		margin: 20px auto;
		border-radius: 100%;
		padding: 0;
		position: relative;
	}

	.wizard .nav-tabs > li a:hover {
		background: transparent;
	}

	.wizard .tab-pane {
		position: relative;
		padding-top: 15px;
	}

	.wizard h3 {
		margin-top: 0;
	}

	@media( max-width: 585px) {

		.wizard {
			width: 90%;
			height: auto !important;
		}

		span.round-tab {
			font-size: 16px;
			width: 50px;
			height: 50px;
			line-height: 50px;
		}

		.wizard .nav-tabs > li a {
			width: 50px;
			height: 50px;
			line-height: 50px;
		}

		.wizard li.active:after {
			content: " ";
			position: absolute;
			left: 35%;
		}
	}

	.chosen-container-single a{
		background:white !important;
		min-height: calc(1.5em + .5rem + 2px) !important;
		height: calc(1.5em + .5rem + 2px) !important;
		box-shadow: none !important;
		text-align: left !important;
	}

	.chosen-container-active {
		border-color: #80bdff;
		outline: 0;
		border-radius: .25rem;
		box-shadow: 0 0 0 0.2rem rgba(0,123,255, 0.25);
	}
</style>

<div class="wizard">
	<div class="wizard-inner">
		<div class="connecting-line"></div>
		<ul class="nav nav-tabs justify-content-between" role="tablist">
			<li role="presentation" class="nav-item">
				<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Información Principal" class="nav-link active">
					<span class="round-tab">
						<i class="fas fa-list-alt"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Compromisos" class="nav-link disabled">
					<span class="round-tab">
						<i class="fa fa-list-ol"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Anexar Evidencia " class="nav-link disabled">
					<span class="round-tab">
						<i class="fa fa-upload"></i>
					</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="container-fluid mt-3">
		<div class="row">
			<?php if($modificar != 1) { ?>
			<div class="col-12 col-md-4 col-lg-3 col-xl-2">
				<button class="btn btn-info btn-sm btn-block" id="btnTiempo"><i class="fas fa-stopwatch"></i> <span>Iniciar</span></button>
			</div>
			<div class="col-12 col-md-4 col-lg-3 col-xl-2 divRestablecer d-none mt-2 mt-md-0">
				<button class="btn btn-warning btn-sm btn-block"  id="btnRestablecer"><i class="fas fa-history"></i> Restablecer</button>
			</div>
			<?php }  ?>
			<div class="col-12 col-md-4 col-lg-3 col-xl-2 mt-2 mt-md-0">
				<input  type="text" class="form-control form-control-sm" data-db="Tiempo" data-nombre="Tiempo" id="txtTiempo" value="00:00:00" readonly="true" type="text">
			</div>
		</div>
	</div>
	<div class="tab-content"> 
		<div class="tab-pane active container-fluid" role="tabpanel" id="step1">
			<h4>Información Principal</h4>
			<form id="formCrear" class="form-row" autocomplete="off">
				<div class="col-12 col-sm-6 col-md-3 form-valid">
					<label class="col-form-label col-form-label-sm" for="TipoReunionId"><span class="text-danger">*</span>Tipo Reunión</label>
					<select id="TipoReunionId" <?= $modificar == 1 ? 'disabled' : '' ?> data-db="TipoReunionId" data-nombre="Tipo Reunión" class="chosen-select custom-select custom-select-sm" autocomplete="off" required name="tipoReunion">
						<option value="" disabled selected>Seleccione</option>
						<?php 
							if(count($selectTipoReunion) > 0){
								foreach ($selectTipoReunion as $key) {
									echo "<option value='".$key->TipoReunionId."'>".$key->Nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12 col-sm-6 col-md-3 form-valid">
					<label class="col-form-label col-form-label-sm" for="Tema"><span class="text-danger">*</span>Tema</label>
					<input type="text" <?= $modificar == 1 ? 'disabled' : '' ?> data-db="Tema" data-nombre="Tema" id="Tema" name="tema" autocomplete="off" value="<?= isset($datosActa) ? $datosActa->Tema : '' ?>" required class="form-control form-control-sm">
				</div>
				<div class="col-12 col-sm-6 col-md-3 form-valid">
					<label class="col-form-label col-form-label-sm" for="UsrElaboraId"><span class="text-danger">*</span>Quién Elabora</label>
					<select class="chosen-select custom-select custom-select-sm" id="UsrElaboraId" data-db="UsrElaboraId" data-nombre="Quién Elabora" <?= $modificar == 1 ? 'disabled' : '' ?> autocomplete="off" required name="quienElabora">
						<option value="" disabled selected>Seleccione</option>
						<?php 
							if(count($selectUsuario) > 0){
								foreach ($selectUsuario as $key) {
									echo "<option value='".$key->usuarioId."'>".$key->nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<label class="col-form-label col-form-label-sm" for="Fecha">Fecha</label>
					<input type="text" name="Fecha" id="Fecha" required disabled autocomplete="off" value="<?= isset($datosActa) ? $datosActa->Fecha : date("Y-m-d") ?>" class="form-control form-control-sm">
				</div>
				<div class="col-12 col-sm-6 col-md-4 form-valid">
					<label class="col-form-label col-form-label-sm" for="permisoVisualizacion"><span class="text-danger">*</span>Permiso Visualizacíon</label>
					<select id="permisoVisualizacion" class="chosen-select custom-select custom-select-sm" <?= $modificar == 1 ? 'disabled' : '' ?> data-db="Visualiza" data-nombre="Permiso Visualizacíon" autocomplete="off" required name="permisoVisualizacion[]" multiple>
						<?php 
							if(count($selectUsuario) > 0){
								foreach ($selectUsuario as $key) {
									echo "<option value='".$key->usuarioId."'>".$key->nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12 col-sm-6 col-md-4 form-valid">
					<label class="col-form-label col-form-label-sm" for="permisoModificacion"><span class="text-danger">*</span>Permiso Modificación</label>
					<select id="permisoModificacion" class="chosen-select custom-select custom-select-sm" <?= $modificar == 1 ? 'disabled' : '' ?> data-db="Modifica" data-nombre="Permiso Modificación" autocomplete="off" required name="permisoModificacion[]" multiple>
						<?php 
							if(count($selectUsuarioAdmin) > 0){
								foreach ($selectUsuarioAdmin as $key) {
									echo "<option value='".$key->usuarioId."'>".$key->nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12 col-sm-6 col-md-4 form-valid">
					<label class="col-form-label col-form-label-sm" for="permisoAnulacion"><span class="text-danger">*</span>Permiso Anulación</label>
					<select id="permisoAnulacion" class="chosen-select custom-select custom-select-sm" <?= $modificar == 1 ? 'disabled' : '' ?> data-db="Anula" data-nombre="Permiso Anulación" autocomplete="off" required name="permisoAnulacion[]" multiple>
						<?php 
							if(count($selectUsuarioAdmin) > 0){
								foreach ($selectUsuarioAdmin as $key) {
									echo "<option value='".$key->usuarioId."'>".$key->nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12">
					<label class="col-form-label col-form-label-sm" for="asistentes">Asistentes</label>
					<select id="asistentes" class="chosen-select custom-select custom-select-sm" <?= $modificar == 1 ? 'disabled' : '' ?> data-db="Asistente" data-nombre="Asistentes" autocomplete="off" name="asistentes[]" multiple>
						<?php 
							if(count($selectUsuario) > 0){
								foreach ($selectUsuario as $key) {
									echo "<option value='".$key->usuarioId."'>".$key->nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12">
					<label class="col-form-label col-form-label-sm" for="otrosAsistentes">Otros Asistentes</label>
					<textarea id="otrosAsistentes" name="otrosAsistentes" <?= $modificar == 1 ? 'disabled' : '' ?> data-nombre="Otros Asistentes" data-db="OtroAsistente" class="form-control form-control-sm" autocomplete="off" style="min-height: 30px; height: 30px"><?= isset($datosActa) ? $datosActa->OtroAsistente : '' ?></textarea>
				</div>
				<div class="col-12">
					<label class="col-form-label col-form-label-sm" for="objetivoReunion">Objetivo de la Reunión</label>
					<textarea id="objetivoReunion" name="objetivoReunion" <?= $modificar == 1 ? 'disabled' : '' ?> data-nombre="Objetivo de la Reunión" data-db="ObjetivoReunion" class="form-control form-control-sm" autocomplete="off" style="min-height: 30px; height: 30px"><?= isset($datosActa) ? $datosActa->ObjetivoReunion : '' ?></textarea>
				</div>
				<div class="col-12">
					<label class="col-form-label col-form-label-sm" for="temasTratados">Temas Tratados</label>
					<textarea id="temasTratados" name="temasTratados" <?= $modificar == 1 ? 'disabled' : '' ?> data-nombre="Temas Tratados" data-db="TemaTratado" class="form-control form-control-sm" autocomplete="off" style="min-height: 30px; height: 30px"><?= isset($datosActa) ? $datosActa->TemaTratado : '' ?></textarea>
				</div>
				<div class="col-12 mt-2 text-right border-top mt-3 pt-2">
					<button type="submit" id="btnRegistro" class="btn btn-success"><i class="fas fa-save"></i> Registrar acta</button>
					<button type="button" id="btnSiguiente"  class="btn btn-primary next-step d-none"> Siguiente <i class="fas fa-arrow-right"></i></button>
				</div>
			</form>
		</div>
		<div class="tab-pane container-fluid" role="tabpanel" id="step2">
			<h4>Compromisos</h4>
			<?php 
			if($modificar != 1) {
			?>
			<form id="formCompromisos" class="form-row mb-3">
				<div class="col-12 col-sm-6 col-md-3 form-valid">
					<label class="col-form-label col-form-label-sm" for="usuario"><span class="text-danger">*</span>Usuario</label>
					<select class="chosen-select custom-select custom-select-sm" disabled autocomplete="off" required name="usuario" id="usuario">
						<option value="0" selected disabled>Seleccione</option>
						<?php 
							if(count($selectUsuario) > 0){
								foreach ($selectUsuario as $key) {
									echo "<option value='".$key->usuarioId."'>".$key->nombre."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="col-12 col-sm-6 col-md-3 col-lg-2 form-valid">
					<label class="col-form-label col-form-label-sm" for="fechaMax"><span class="text-danger">*</span>Fecha Maxima</label>
					<div class="input-group datepicker">
						<input id="fechaMax" type="text" name="fecha" required class="form-control form-control-sm dateFecha" disabled maxlength="15" value="<?= date('Y-m-d') ?>">
						<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
							<span class="input-group-text fas fa-calendar-alt d-flex"></span>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3 col-lg-2 form-valid">
					<label class="col-form-label col-form-label-sm" for="prioridad"><span class="text-danger">*</span>Prioridad</label>
					<select id="prioridad" class="chosen-select custom-select custom-select-sm" autocomplete="off" disabled required name="prioridad">
						<option value="" selected disabled>Seleccione</option>
						<option value="B">Baja</option>
						<option value="M">Media</option>
						<option value="A">Alta</option>
						
					</select>
				</div>
				<div class="col-12 col-sm-6 col-md-3 ml-auto mt-2 mt-md-0 order-2 order-sm-1 align-self-end">
					<button type="submit" class="btn btn-success btn-block btn-sm" disabled><i class="fas fa-save"></i> Agregar compromiso</button>
				</div>
				<div class="col-12 order-1 order-sm-2 form-valid">
					<label class="col-form-label col-form-label-sm"><span class="text-danger">*</span>Descripción</label>
					<textarea class="form-control form-control-sm" disabled required name="descripcion" rows="2"></textarea>
				</div>
				
			</form>
			<?php	
			}
			?>
			
			<table class="table table-bordered table-sm table-hover table-fixed table-striped w-100" id="tblCompromisos" cellspacing="0">
				<thead>
					<tr>
						<th>Acciones</th>
						<th>Id</th>
						<th>Usuario Asignó</th>
						<th>Usuario Asignado</th>
						<th>Prioridad</th>
						<th>Descripción</th>
						<th>Fecha Máxima</th>
						<th>Fecha Creción</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			
			<div class="d-flex justify-content-between border-top mt-3 pt-2">
				<button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Atrás</button>
				<button type="button" class="btn btn-primary next-step"> Siguiente <i class="fas fa-arrow-right"></i></button>
			</div>
		</div>
		<div class="tab-pane container-fluid" role="tabpanel" id="step3">
			<h4>Anexar Evidencia</h4>
			<?php 
			if ($modificar != 1) {
			?>
			<form id="formAnexos" class="form-row mb-3 align-items-end">
				<div class="col-12 col-md-9">
					<label class="col-form-label col-form-label-sm" for="archivoEvidencia"><span class="text-danger">*</span>Anexo</label>
					<div class='custom-file custom-file-sm form-valid'>
						<input id="archivoEvidencia" type='file' class='custom-file-input custom-file-input-sm' required disabled name="Lista_Anexos" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
						<label class='custom-file-label custom-file-label-sm' for='archivos' data-browse='Elegir'>
							<span id="form-image-span" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
						</label>
					</div>
				</div>
				<div class="col-12 col-md-3 mt-2 mt-md-0">
					<button type="submit" disabled class="btn btn-success btn-block btn-sm"><i class="fas fa-upload"></i> Agregar</button>
				</div>
			</form>
			<?php
			}
			?>
			<div class="w-100">
				<table class="table table-bordered table-sm table-hover table-fixed table-striped display w-100" id="tblAnexos" cellspacing="0">
					<thead class="w-100">
						<tr>
							<th>Id</th>
							<th>Anexo</th>
							<th>Nombre</th>
							<th>Documento</th>
							<th>Fecha</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="d-flex justify-content-between border-top mt-3 pt-2">
				<button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Atrás</button>
				<button id="finalizar" type="button" class="btn btn-success"> Finalizar <i class="fas fa-arrow-right"></i></button>
			</div>	
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalSeguimiento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalSeguimientoLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalSeguimientoLabel">Seguimiento Compromiso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					if($modificar != 1) {
				?>
				<form id="formSeguimientoCompromisos" class="row align-items-end" action="">
					<input type="hidden" name="idSeguimientoCompromiso">
					<div class="col-12 col-lg-10 form-valid form-group form-group-sm">
						<label class="mb-0" for="segDescripcion"><span class="text-danger">*</span>Descripción:</label>
						<textarea id="segDescripcion" name="descripcion" class="form-control form-control-sm" required autocomplete="off" style="min-height: 40px; height: 40px"></textarea>
					</div>
					<div class="col-12 col-lg-2">
						<div class="form-group form-group-sm">
							<button class="btn btn-success btn-block" type="submit"><i class="fas fa-save"></i> Agregar</button>
						</div>
					</div>
				</form>
				<?php
					}
				?>

				<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblSeguimientoCompromisos" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Descripción</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
	var $IDACTA = <?= isset($datosActa) ? $datosActa->ActaId : '0' ?>;
	var $DATOSACTA = <?= isset($datosActa) ? json_encode($datosActa) : '0' ?>;
	var $MODIFICAR = <?= $modificar ?>;
</script>
