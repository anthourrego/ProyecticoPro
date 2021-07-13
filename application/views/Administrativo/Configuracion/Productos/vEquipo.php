<style type="text/css">
	.foto {
		background-repeat: no-repeat;
		background-position: center center;
		background-size: 100%;
	}
	tr.selected, tr.selected2 {
		background-color: #c2d7e1 !important;
	}
</style>

<form id="frmRegistroClientes">
	<!-- <ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="#datosBasicos" data-toggle="tab" class="nav-link active" role="tab" aria-selected="true">
				Datos Equipo
			</a>
		</li>
	</ul> -->
	<div class="row">
		<div class="col-md-3">
			<div class="text-center">
				<form enctype="multipart/form-data">
					<a href="#" style="display: inline-block;position: relative;width: 100%;">
						<div style="margin-top: 75%;"></div>
						<div class="foto" style="border: 1px solid #cccccc;position: absolute;top: 0;bottom: 0;left: 0;right: 0;background-repeat: no-repeat;background-position: center center;background-size: contain;">
							<input type="file" style="opacity: 0.0;width: 100%;height:100%;" accept="image/*" tabindex="-1" data-imagen="foto" data-nombre="Foto"/>
						</div>
					</a>
				</form>

				<div class="col">
					<div class="row">
						<div class="col-xl-3 btn btn-primary col-3 col-md-6 col-xl-3 p-0 rounded-0" id="btnFastBackward">
							<span class="fas fa-fast-backward w-100"></span>
							<small>Primero</small>
						</div>
						<div class="col-xl-3 btn btn-primary col-3 col-md-6 col-xl-3 p-0 rounded-0 rounded-0" id="btnBackward">
							<span class="fas fa-step-backward w-100"></span>
							<small>Anterior</small>
						</div>
						<div class="col-xl-3 btn btn-primary col-3 col-md-6 col-xl-3 p-0 rounded-0 rounded-0" id="btnForward">
							<span class="fas fa-step-forward w-100"></span>
							<small>Siguiente</small>
						</div>
						<div class="col-xl-3 btn btn-primary col-3 col-md-6 col-xl-3 p-0 rounded-0" id="btnFastForward">
							<span class="fas fa-fast-forward w-100"></span>
							<small>Último</small>
						</div>

						<div class="col-xl-3 btn btn-danger col-3 col-md-6 col-xl-3 p-0 offset-3 offset-md-0 offset-xl-3 rounded-0" id="btnEliminarEquipo">
							<span class="far fa-trash-alt w-100"></span>
							<small>Eliminar</small>
						</div>
						<div class="col-xl-3 btn btn-outline-secondary col-3 col-md-6 col-xl-3 p-0 rounded-0" id="btnBusqueda">
							<span class="fas fa-search w-100"></span>
							<small>Búsqueda</small>
						</div>
						<a href="<?= base_url() ?>Administrativo/Configuracion/Productos/cEquipo/Exportar" target="_blank" class="col-xl-3 btn btn-outline-secondary col-3 col-md-6 col-xl-3 p-0 rounded-0">
							<span class="fas fa-file w-100"></span>
							<small>Exportar</small>
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row">
					<h4 id="h2Cliente"></h4>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="form-row">
				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0 d-none">EquipoId</label>
				<div class="col-md-8 col-xl-4 p-0 d-none">
					<input type="text" class="form-control form-control-sm" data-db="EquipoId" data-nombre="EquipoId" readonly>
				</div>
				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Código</label>
				<div class="col-md-8 col-xl-4 p-0">
					<input type="text" class="form-control form-control-sm validarCampo" data-db="Codigo" maxlength="15" data-nombre="Codigo" required data-codigo="codigo" value="">
				</div>
				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0"><span class="text-danger">*</span>Nombre</label>
				<div class="col-md-8 col-xl-4 p-0">
					<input type="text" class="form-control form-control-sm validarCampo" data-db="Nombre" maxlength="60" data-nombre="Nombre" required  value="">
				</div>
				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dimensión</label>
				<div class="col-md-8 col-xl-4 p-0">
					<input type="text" class="form-control form-control-sm" data-db="Dimensiones" maxlength="255" data-nombre="Dimensiones" data-tabla="Equipo">
				</div>
			</div>
			<div class="form-row">
				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Familia</label>
				<div class="col-md-8 col-xl-4 p-0">
					<select class="custom-select custom-select-sm" data-db="FamiliaId" data-nombre="FamiliaId">
						<option value="" disabled selected hidden></option>
						<?php
						if(count($familia) > 0){
							foreach ($familia as $familia) {
								echo "<option value='".$familia->FamiliaId."'>".$familia->Nombre."</option>";
							}
						}
						?>
					</select>
				</div>
				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Marca</label>
				<div class="col-md-8 col-xl-4 p-0">
					<select class="custom-select custom-select-sm" data-db="MarcaId" data-nombre="MarcaId">
						<option value="" disabled selected hidden></option>
						<?php
						if(count($marca) > 0){
							foreach ($marca as $marca) {
								echo "<option value='".$marca->marcaid."'>".$marca->nombre."</option>";
							}
						}
						?>
					</select>
				</div>

				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Modelo</label>
				<div class="col-md-8 col-xl-4 p-0">
					<input type="text" class="form-control form-control-sm" data-db="Modelo" maxlength="30" data-nombre="Modelo">
				</div>

				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Infraestructura</label>
				<div class="col-md-8 col-xl-4 p-0">
					<select class="custom-select custom-select-sm" data-db="TipoInfra" data-nombre="TipoInfra" data-tabla="Equipo">
						<option value="" disabled selected hidden>Seleccione</option>
						<option value="1">VEHICULO</option>
						<option value="2">MAQUINARIA EQUIPO</option>
						<option value="3">COMPUTO</option>
						<option value="4">LOCATIVA</option>
					</select>
				</div>

				<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Estado</label>
				<div class="col-md-8 col-xl-4 p-0">
					<select class="custom-select custom-select-sm" data-db="Estado" data-nombre="Estado" data-tabla="Equipo">
						<option value="" disabled selected hidden>Seleccione</option>
						<option value="A">Activo</option>
						<option value="I">Inactivo</option>
					</select>
				</div>

			</div>
		</div>
	</div>
</form>