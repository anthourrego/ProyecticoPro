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
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="#datosBasicos" data-toggle="tab" class="nav-link active" role="tab" aria-selected="true">
				Datos Básicos
			</a>
		</li>
		<li class="nav-item">
			<a href="#actividades" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
				Actividades
			</a>
		</li>
	</ul>
	<div class="card border-top-0" style="border-top-left-radius: 0;border-top-right-radius: 0;">
		<div class="card-body tab-content">
			<div class="tab-pane fade show active" id="datosBasicos" role="tabpanel">
				<div class="row">
					<div class="col-md-9">
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Código</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="OperarioId" data-nombre="Código" readonly>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0"><span class="text-danger">*</span>No. Identificación</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm validarCampo" data-db="TerceroID" maxlength="15" data-nombre="No. Identificación" required data-codigo="codigo" value="<?= $clienteInicial ?>">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Código Barras</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="CodigoBarras" maxlength="30" data-nombre="Código Barras" data-tabla="Operario">
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Nombre</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="100" data-nombre="Nombre" readonly>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Primer Nombre</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombruno" maxlength="30" data-nombre="Primer Nombre">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Segundo Nombre</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombrdos" maxlength="30" data-nombre="Segundo Nombre">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Primer Apellido</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="apelluno" maxlength="30" data-nombre="Primer Apellido">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Segundo Apellido</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="apelldos" maxlength="30" data-nombre="Segundo Apellido">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dirección</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="direccion" maxlength="100" data-nombre="Dirección Correspondencia">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Ciudad</label>
							<div class="col-md-8 col-xl-10 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="ciudadid" maxlength="5" data-nombre="Ciudad Residencia" data-foranea="ciudad" data-foranea-codigo="ciudadid">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="ciudadidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Teléfonos</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="telefono" maxlength="50" data-nombre="Teléfonos">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Celular</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="celular" maxlength="50" data-nombre="Celular">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">E-Mail</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="email" maxlength="60" data-nombre="E-Mail">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Profesión</label>
							<div class="col-md-8 col-xl-10 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="profesionid" maxlength="4" data-nombre="Profesión" data-foranea="Profesion" data-foranea-codigo="profesionid">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="profesionidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Fecha Nacimiento</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group datepicker input-group-sm">
									<input type="text" class="form-control dateFecha" value="<?= date('Y-m-d') ?>" data-db="fechanacim" maxlength="10" data-nombre="Fecha Nacimiento">
									<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
										<span class="input-group-text fas fa-calendar-alt d-flex"></span>
									</a>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Estado Civil</label>
							<div class="col-md-8 col-xl-4 p-0">
								<select class="custom-select custom-select-sm" data-db="estadocivilid" data-nombre="Estado Civil">
									<option value="" disabled selected hidden></option>
									<?php
									if(count($estadocivilid) > 0){
										foreach ($estadocivilid as $estadocivil) {
											echo "<option value='".$estadocivil->estadocivilid."'>".$estadocivil->nombre."</option>";
										}
									}
									?>
								</select>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Valor Hora</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm data-decimal inputmask" data-db="ValorHora" data-nombre="Valor Hora" data-digitos="2" data-enteros="10" data-tabla="Operario">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Estado</label>
							<div class="col-md-8 col-xl-1 p-0">
								<select class="custom-select custom-select-sm" data-db="Estado" data-nombre="Estado" data-tabla="Operario">
									<option value="" disabled selected hidden></option>
									<option value="A">A</option>
									<option value="I">I</option>
								</select>
							</div>
						</div>
					</div>
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

									<div class="col-xl-3 btn btn-danger col-3 col-md-6 col-xl-3 p-0 offset-3 offset-md-0 offset-xl-3 rounded-0" id="btnEliminarCliente">
										<span class="far fa-trash-alt w-100"></span>
										<small>Eliminar</small>
									</div>
									<div class="col-xl-3 btn btn-outline-secondary col-3 col-md-6 col-xl-3 p-0 rounded-0" id="btnBusqueda">
										<span class="fas fa-search w-100"></span>
										<small>Búsqueda</small>
									</div>
									<a href="<?= base_url() ?>Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio/Exportar" target="_blank" class="col-xl-3 btn btn-outline-secondary col-3 col-md-6 col-xl-3 p-0 rounded-0">
										<span class="fas fa-file w-100"></span>
										<small>Exportar</small>
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<h2 id="h2Cliente"></h2>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="actividades">
				<div class="row">
					<div data-crud-tabla="OperarioActividad" data-crud-dt="dtActividadesOperarioCP" class="col-xl-6">
						<div class="alert alert-info d-table pt-0 pb-1 w-100">
							<div class="row">
								<b class="w-100">Áreas de Servicio</b>

								<div class="col-xl-12">
									<div class="row">
										<div class="d-none">
											<label class="col-md-5 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
											<div class="col-md-7 col-xl-10 p-0">
												<input type="text" class="form-control form-control-sm" data-crud="OperarioActividadId" data-crud-codigo="OperarioActividadId" data-nombre="OperarioActividadId">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8 p-3 text-center">
									<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem">
										<span class="fas fa-plus"></span>
									</button>
									<button type="button" class="btn btn-danger btnEliminar" title="Eliminar">
										<span class="far fa-trash-alt"></span>
									</button>
								</div>
							</div>
							<table id="tblActividadesOperarioCP" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Id</th>
										<th>Código</th>
										<th>Nombre</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div data-crud-tabla="OperarioActividad" data-crud-dt="dtActividadesOperarioAC" class="col-xl-6">
						<div class="alert alert-info d-table pt-0 pb-1 w-100">
							<div class="row">
								<b class="w-100" id="bActividades">Actividades de Servicio</b>

								<div class="col-xl-12">
									<div class="row">
										<div class="d-none">
											<label class="col-md-5 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
											<div class="col-md-7 col-xl-10 p-0">
												<input type="text" class="form-control form-control-sm" data-crud="OperarioActividadId" data-crud-codigo="OperarioActividadId" data-nombre="OperarioActividadId">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8 p-3 text-center">
									<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem">
										<span class="fas fa-plus"></span>
									</button>
									<button type="button" class="btn btn-danger btnEliminar" title="Eliminar">
										<span class="far fa-trash-alt"></span>
									</button>
								</div>
							</div>
							<table id="tblActividadesOperarioAC" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Id</th>
										<th>Código</th>
										<th>Nombre</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>