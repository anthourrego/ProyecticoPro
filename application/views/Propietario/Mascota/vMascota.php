<style type="text/css">
	.divMascota{
		height: 550px;
		overflow-x: auto;
		overflow-y: auto;
	}
	.fotoM{
		border-right: 1px solid rgba(0,0,0,.125);
		height: 110px;
		background-repeat: no-repeat;
		background-position: center center;
		background-size: contain;
	}
	.date{
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-12 col-md-12 col-xl-6" style="border-right: 1px solid #e0e0e0">
		<form id="frmRegistro" autocomplete="off" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-md-4 col-xl-4">
					<label class="labelForm" for="tipoVehi"><span class="text-danger">*</span>Foto</label>
					<div style="margin-top: 95%;"></div>
					<div class="fotoMascota" style="border: 1px solid #cccccc;position: absolute;top: 20px;bottom: 0;background-repeat: no-repeat;background-position: center center;background-size: contain;right: 15px;left: 15px">
						<input type="file" class="anexo" style="opacity: 0.0;width: 100%;height:100%;" accept="image/*" tabindex="-1" data-imagen="foto"/>
					</div>
				</div>
				<div class="col-12 col-md-8">
					<div class="row">
						<div class="col-12 col-md-12 col-xl-5">
							<label class="labelForm" for="chTipoMascota"><span class="text-danger">*</span>Tipo de mascota</label>
							<select class="form-control form-control-sm chosen-select valida" id="chTipoMascota">
								<option value="">&nbsp;</option>
								<?php if(count($TipoMascota) > 0) {
									foreach ($TipoMascota as $key) {
										echo "<option value='".$key->id."'>".$key->nombre."</option>";
									}
								} ?>
							</select>
						</div>
						<div class="col-12 col-md-12 col-xl-7">
							<label class="labelForm" for="nombre"><span class="text-danger">*</span>Nombre</label>
							<input type="text" class="form-control form-control-sm valida" id="nombre" maxlength="60" disabled>
						</div>
						<div class="col-12 col-md-6 col-xl-6">
							<label class="labelForm" for="raza">Raza</label>
							<input type="text" class="form-control form-control-sm" id="raza" maxlength="50" disabled>
						</div>
						<div class="col-12 col-md-6 col-xl-6">
							<label class="labelForm" for="chSexo"><span class="text-danger">*</span>Sexo</label>
							<select class="form-control form-control-sm chosen-select valida" id="chSexo" disabled>
								<option value="">&nbsp;</option>
								<option value="M">Macho</option>
								<option value="F">Hembra</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-xl-6">
							<label class="labelForm" for="tamano">Tamaño</label>
							<input type="text" placeholder="Ej : 1.25" class="form-control form-control-sm" id="tamano" maxlength="4" disabled>
						</div>
						<div class="col-12 col-md-6 col-xl-6">
							<label class="labelForm" for="fechaNac"><span class="text-danger">*</span>Fecha de nacimiento</label>
							<!-- <input type="text" class="form-control form-control-sm date valida" id="fechaNac" disabled> -->
							<div class="input-group date datepicker">
								<input type="text" class="form-control form-control-sm dateFecha valida" name="fechaNac" id="fechaNac" maxlength="15" value="" disabled>
								<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
									<span class="input-group-text fas fa-calendar-alt d-flex"></span>
								</a>
							</div>
						</div>
						<div class="col-12">
							<label class="labelForm" for="observacion">Observaciones</label>
							<textarea class="form-control form-control-sm" rows="1" id="observacion" disabled></textarea >
						</div>
						<div class="col-12 mt-1">
							<div class="btn-group col-12 p-0" role="group">
								<button type="button" class="btn btn-success btn-sm ml-auto col-12 col-md-4 col-xl-4" id="btnGuardar" title="Editar"><i class="fas fa-save mr-1"></i>Guardar</button>
								<button type="button" class="btn btn-danger btn-sm col-12 col-md-4 col-xl-4" id="btnLimpiar" title="Eliminar"><i class="fas fa-times mr-1"></i>Cancelar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row">
						<div class="col-12">
							<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
							<label class="labelLink">Vacunación</label>
							</a>
							<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
						</div>
						<div class="col-12 col-md-4 col-xl-4">
							<label class="labelForm" for="chMascota"><span class="text-danger">*</span>Mascota</label>
							<select class="form-control form-control-sm chosen-select valida2" id="chMascota">
								<option value="">&nbsp;</option>
								<?php if(count($TipoMascota) > 0) {
									foreach ($TipoMascota as $key) {
										echo "<option value='".$key->id."'>".$key->nombre."</option>";
									}
								} ?>
							</select>
						</div>
						<div class="col-12 col-md-4 col-xl-4">
							<label class="labelForm" for="vacuna"><span class="text-danger">*</span>Vacuna</label>
							<input type="text" class="form-control form-control-sm valida2" id="vacuna">
						</div>
						<div class="col-6 col-md-3">
							<label class="labelForm" for="fecha"><span class="text-danger">*</span>Fecha</label>
							<!-- <input type="text" class="form-control form-control-sm date valida2" id="fecha"> -->
							<div class="input-group date datepicker">
								<input type="text" class="form-control form-control-sm dateFecha valida2" id="fecha" maxlength="15" value="">
								<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
									<span class="input-group-text fas fa-calendar-alt d-flex"></span>
								</a>
							</div>
						</div>
						<div class="col-2 col-md-1 col-xl-1 pl-0 align-self-end">
							<button type="button" class="btn btn-sm btn-block btn-success" id="btnVacuna" title="Guardar"><i class="fas fa-save"></i></button>
						</div>
						<div class="col-12 mt-2 table-responsive">
							<table id="tblHistorico" class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th style="width: 8%">Acciones</th>
										<th style="width: 8%">Id</th>
										<th>Vacuna</th>
										<th>Fecha</th>
									</tr>
								</thead>	
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-12 col-md-12 col-xl-6 divMascota">
	</div>
</div>
<script type="text/javascript">
	$CC = '<?=$this->session->userdata('CEDULA')?>';
	$ID = '<?=$ViviendaId[0]->ViviendaId?>';
</script>