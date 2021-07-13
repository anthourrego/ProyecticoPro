<style type="text/css">
	textarea {
		height: 100px;
		resize: vertical;
		min-height: 100px;
		max-height: 500px;
	}
	.foto {
		background-repeat: no-repeat;
		background-position: center center;
		background-size: 100%;
	}
	tr.selected {
		background-color: #c2d7e1 !important;
	}
</style>

<div class="row">
	<div class="col-md-3">
		<div class="col-xl-12">
			<div class="row form-group">
				<div class="custom-control custom-checkbox col-6 col-md-12 col-xl-6">
					<input type="checkbox" class="custom-control-input noBloquear" id="Cliente" data-db="EsCliente" readonly disabled data-nombre="Es Cliente" data-permiso="86">
					<label class="custom-control-label" for="Cliente">Es Cliente</label>
				</div>
				<div class="custom-control custom-checkbox col-6 col-md-12 col-xl-6">
					<input type="checkbox" class="custom-control-input noBloquear" id="Proveedor" checked data-db="EsProveedor" readonly disabled data-nombre="Es Proveedor" data-permiso="86">
					<label class="custom-control-label" for="Proveedor">Es Proveedor</label>
				</div>
			</div>
		</div>

		<div class="text-center">
			<form enctype="multipart/form-data">
				<a href="#" style="display: inline-block;position: relative;width: 100%;">
					<div style="margin-top: 75%;"></div>
					<div class="foto" style="border: 1px solid #cccccc;position: absolute;top: 0;bottom: 0;left: 0;right: 0;background-repeat: no-repeat;background-position: center center;background-size: contain;">
						<input type="file" style="opacity: 0.0;width: 100%;height:100%;" accept="image/*" tabindex="-1" data-imagen="foto" data-nombre="Foto" data-permiso="56"/>
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
					<a href="<?= base_url() ?>Administrativo/Configuracion/Terceros/RegistroProveedores/Exportar" target="_blank" class="col-xl-3 btn btn-outline-secondary col-3 col-md-6 col-xl-3 p-0 rounded-0">
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
	<form id="frmRegistroClientes" class="col-md-9">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="#informacionBasica" data-toggle="tab" class="nav-link active" role="tab" aria-selected="true">
					Información Básica
				</a>
			</li>
			<li class="nav-item">
				<a href="#otraInformacionCRM" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
					Otra Información
				</a>
			</li>
			<li class="nav-item">
				<a href="#carteraYCompras" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
					Compras
				</a>
			</li>
			<li class="nav-item">
				<a href="#sucursales" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
					Sucursales
				</a>
			</li>
			<li class="nav-item">
				<a href="#informacionAdicionalCRM" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
					Información Adicional CRM
				</a>
			</li>
			<li class="nav-item">
				<a href="#contactos" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
					Contactos
				</a>
			</li>
			<li class="nav-item">
				<a href="#adjuntos" data-toggle="tab" class="nav-link" role="tab" aria-selected="false">
					Adjuntos
				</a>
			</li>
		</ul>
		<div class="card border-top-0" style="border-top-left-radius: 0;border-top-right-radius: 0;">
			<div class="card-body tab-content">
				<div class="tab-pane fade show active" id="informacionBasica" role="tabpanel">
					<div class="card card-body d-table w-100 form-group pt-0 pb-1">
						<div class="row">
							<b class="w-100">Identificación</b>

							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Código</label>
							<div class="col-md-3 col-xl-2 p-0">
								<input type="text" class="form-control form-control-sm validarCampo" data-db="TerceroID" maxlength="15" data-nombre="Código" required data-codigo="codigo" value="<?= $clienteInicial ?>">
							</div>
							<label class="col-md-2 col-xl-1 col-form-label col-form-label-md text-md-right pl-0 py-0">D.V</label>
							<div class="col-md-3 col-xl-1 p-0">
								<input type="text" class="form-control form-control-sm" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
							</div>
							<label class="col-md-4 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Identificación</label>
							<div class="col-md-8 col-xl-3 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm w-25" data-db="tipodocuid" maxlength="2" data-nombre="Tipo Identificación" data-foranea="tipodocu" data-foranea-codigo="tipodocuid" data-permiso="1">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="tipodocuidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Código de Barras</label>
							<div class="col-md-8 col-xl-2 p-0">
								<input type="text" class="form-control form-control-sm" data-db="barra" maxlength="15" data-nombre="Código de Barras" data-permiso="2">
							</div>
							<label class="col-md-4 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0 offset-xl-2">Estado</label>
							<div class="col-md-8 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="estado" data-nombre="Estado" data-permiso="92">
									<option value="" disabled selected hidden></option>
									<option value="A">A</option>
									<option value="I">I</option>
								</select>
							</div>
						</div>
					</div>

					<div class="card card-body d-table w-100 form-group pt-0 pb-1">
						<div class="row">
							<b class="w-100">Datos Personales</b>

							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Nombre</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombre" maxlength="100" data-nombre="Nombre" readonly>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Razón Social</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="razonsocia" maxlength="100" data-nombre="Razón Social" data-permiso="3">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Nombre Comercial</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombrcomer" maxlength="100" data-nombre="Nombre Comercial" data-permiso="90">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Primer Nombre</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombruno" maxlength="30" data-nombre="Primer Nombre" data-permiso="4">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Segundo Nombre</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="nombrdos" maxlength="30" data-nombre="Segundo Nombre" data-permiso="4">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Primer Apellido</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="apelluno" maxlength="30" data-nombre="Primer Apellido" data-permiso="4">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Segundo Apellido</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="apelldos" maxlength="30" data-nombre="Segundo Apellido" data-permiso="4">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">E-Mail 1</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="email" maxlength="60" data-nombre="E-Mail 1" data-permiso="5">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">E-Mail 2</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="email2" maxlength="60" data-nombre="E-Mail 2" data-permiso="5">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Celular</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="celular" maxlength="50" data-nombre="Celular" data-permiso="6">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Estado Civil</label>
							<div class="col-md-8 col-xl-2 p-0">
								<select class="form-control form-control-sm" data-db="estadocivilid" data-nombre="Estado Civil" data-permiso="7">
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
							<label class="col-md-4 col-xl-1 col-form-label col-form-label-md text-md-right pl-0 py-0">Sexo</label>
							<div class="col-md-8 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="sexo" data-nombre="Sexo" data-permiso="8">
									<option value="" disabled selected hidden></option>
									<option value="F">F</option>
									<option value="M">M</option>
								</select>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">No de Tarjeta</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="numercredi" maxlength="20" data-nombre="Número de Tarjeta" data-permiso="9">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Tipo Tercero</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm w-25" data-db="TipoTercId" data-tabla="Proveedor" maxlength="15" data-nombre="Tipo Tercero" data-foranea="TipoTerc" data-foranea-codigo="tipotercid" data-permiso="80">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="TipoTercIdNombre"></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-body d-table w-100 form-group pt-0 pb-1">
						<div class="row">
							<b class="w-100">Dirección Residencia</b>

							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dirección</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="direccion" maxlength="100" data-nombre="Dirección Residencia" data-permiso="10">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Ciudad</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="ciudadid" maxlength="5" data-nombre="Ciudad Residencia" data-foranea="ciudad" data-foranea-codigo="ciudadid" data-permiso="11">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="ciudadidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Barrio</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="barrioid" maxlength="15" data-nombre="Barrio Residencia" data-foranea="Barrio" data-foranea-codigo="barrioid" data-permiso="12">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="barrioidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dpto</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="dptoid" maxlength="15" data-nombre="Departamento Residencia" data-foranea="dpto" data-foranea-codigo="dptoid" data-permiso="13">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="dptoNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">País</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="paisid" maxlength="15" data-nombre="País Residencia" data-foranea="pais" data-foranea-codigo="paisid" data-permiso="14">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="paisidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Zona</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="zonaid" maxlength="15" data-nombre="Zona Residencia" data-foranea="Zona" data-foranea-codigo="zonaid" data-permiso="15">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="zonaidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Teléfonos</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="telefono" maxlength="50" data-nombre="Teléfonos Residencia" data-permiso="16">
							</div>
						</div>
					</div>

					<div class="card card-body d-table w-100 form-group pt-0 pb-1">
						<div class="row">
							<b class="w-100">Dirección Correspondencia</b>

							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dirección</label>
							<div class="col-md-8 col-xl-10 p-0">
								<input type="text" class="form-control form-control-sm" data-db="direccorre" maxlength="100" data-nombre="Dirección Correspondencia" data-permiso="17">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Ciudad</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="ciudacorre" maxlength="5" data-nombre="Ciudad Correspondencia" data-foranea="ciudad" data-foranea-codigo="ciudadid" data-permiso="18">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="ciudacorreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Barrio</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="barricorre" maxlength="15" data-nombre="Barrio Correspondencia" data-foranea="Barrio" data-foranea-codigo="barrioid" data-permiso="19">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="barricorreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dpto</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="dptocorre" maxlength="15" data-nombre="Departamento Correspondencia" data-foranea="dpto" data-foranea-codigo="dptoid" data-permiso="20">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="dptocorreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">País</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="paiscorre" maxlength="15" data-nombre="País Correspondencia" data-foranea="Pais" data-foranea-codigo="paisid" data-permiso="21">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="paiscorreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0 offset-xl-6">Teléfonos</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="telefcorre" maxlength="50" data-nombre="Teléfonos Correspondencia" data-permiso="22">
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="otraInformacionCRM">
					<div class="card card-body d-table w-100 form-group pt-0 pb-1">
						<div class="row">
							<b class="w-100">Otros Datos</b>

							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Régimen Contributivo</label>
							<div class="col-md-8 col-xl-6 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="regimenid" maxlength="2" data-nombre="Tipo Régimen" data-foranea="TipoRegi" data-foranea-codigo="RegimenID" data-permiso="43">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="regimenidNombre"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Actividad Económica</label>
							<div class="col-md-8 col-xl-6 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="ActividadId" data-tabla="Proveedor" maxlength="15" data-nombre="Actividad Económica" data-foranea="Actividad" data-foranea-codigo="actividadid" data-permiso="49">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="ActividadIdNombre"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Fecha Nacimiento</label>
							<div class="col-md-8 col-xl-3 p-0">
								<div class="input-group datepicker input-group-sm">
									<input type="text" class="form-control dateFecha" value="<?= date('Y-m-d') ?>" data-db="fechanacim" maxlength="10" data-nombre="Fecha Nacimiento" data-permiso="34">
									<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
										<span class="input-group-text fas fa-calendar-alt d-flex"></span>
									</a>
								</div>
							</div>
							<label class="col-md-4 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Ciudad Nacimiento</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="ciudanacim" maxlength="5" data-nombre="Ciudad Nacimiento" data-foranea="ciudad" data-foranea-codigo="ciudadid" data-permiso="35">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="ciudanacimNombre"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Profesión</label>
							<div class="col-md-8 col-xl-6 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="profesionid" maxlength="4" data-nombre="Profesión" data-foranea="Profesion" data-foranea-codigo="profesionid" data-permiso="36">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="profesionidNombre"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Ocupación</label>
							<div class="col-md-8 col-xl-6 p-0">
								<input type="text" class="form-control form-control-sm" data-db="ocupacion" maxlength="50" data-nombre="Ocupación" data-permiso="37">
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Número de Hijos</label>
							<div class="col-md-8 col-xl-1 p-0">
								<input type="text" class="form-control form-control-sm numeric" data-db="hijos" maxlength="2" data-nombre="Número Hijos" value="0" data-permiso="40">
							</div>
							<label class="col-md-8 col-xl-5 col-form-label col-form-label-md text-md-right pl-0 py-0">Autoriza utilizar su información para fines comerciales</label>
							<div class="col-md-4 col-xl-4 p-0">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" data-db="AutorL1581" data-nombre="Autoriza utilizar Información Fines Comerciales" data-permiso="41" id="AutorL1581">
									<label class="custom-control-label" for="AutorL1581">(Ley 1581 de 2012)</label>
								</div>
							</div>
							<!-- <label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Almacén</label>
							<div class="col-md-8 col-xl-6 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="AlmacenId" data-tabla="Cliente" maxlength="4" data-nombre="Almacén" data-foranea="Almacen" data-foranea-codigo="almacenid" data-permiso="85">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="AlmacenIdNombre"></span>
									</div>
								</div>
							</div> -->
						</div>
						<!-- <div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Vendedor</label>
							<div class="col-md-8 col-xl-6 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="VendedorId" data-tabla="Proveedor" maxlength="15" data-nombre="Vendedor" data-foranea="Vendedor" data-foranea-codigo="VendedorId" data-permiso="39">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="VendedorIdNombre"></span>
									</div>
								</div>
							</div>
						</div> -->
						<div class="row">
							<!-- <label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Clasificación</label>
							<div class="col-md-8 col-xl-3 p-0">
								<select class="form-control form-control-sm" data-db="ClasificId" data-tabla="Cliente" data-nombre="Clasificación" data-permiso="88">
									<option value="" disabled selected hidden></option>
									<?php
									if(count($ClasificId) > 0){
										foreach ($ClasificId as $clasificacion) {
											echo "<option value='".$clasificacion->id."' ".($clasificacion->Estado == 'I' ? 'disabled' : '').">".$clasificacion->nombre."</option>";
										}
									}
									?>
								</select>
							</div> -->
							<label class="col-md-4 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0 offset-xl-5">Responsabilidades Fiscales</label>
							<div class="col-md-8 col-xl-4 p-0">
								<select class="form-control form-control-sm" data-db="RespoFisca" data-nombre="Responsabilidades Fiscales" data-permiso="89" multiple maxlength="200">
									<?php if(count($ResponsabilidadFiscal) > 0) {
										foreach ($ResponsabilidadFiscal as $key) {
											echo "<option value='".$key->RespoFiscaId."'>".$key->Nombre."</option>";
										}
									} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="card card-body d-table w-100 form-group pt-0 pb-1">
						<div class="row">
							<b class="w-100">Empresa donde Labora</b>
							
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Empresa</label>
							<div class="col-md-8 col-xl-6 p-0">
								<input type="text" class="form-control form-control-sm" data-db="empresa" maxlength="60" data-nombre="Empresa" data-permiso="23">
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dirección Empresa</label>
							<div class="col-md-8 col-xl-6 p-0">
								<input type="text" class="form-control form-control-sm" data-db="direcempre" maxlength="60" data-nombre="Dirección Empresa" data-permiso="24">
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Ciudad</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="ciudaempre" maxlength="5" data-nombre="Ciudad Empresa" data-foranea="ciudad" data-foranea-codigo="ciudadid" data-permiso="25">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="ciudaempreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Barrio</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="barriempre" maxlength="15" data-nombre="Barrio Empresa" data-foranea="Barrio" data-foranea-codigo="barrioid" data-permiso="26">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="barriempreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dpto</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="dptoempre" maxlength="15" data-nombre="Departamento Empresa" data-foranea="dpto" data-foranea-codigo="dptoid" data-permiso="27">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="dptoempreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">País</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="paisempre" maxlength="15" data-nombre="País Empresa" data-foranea="Pais" data-foranea-codigo="paisid" data-permiso="28">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="paisempreNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Teléfono Empresa</label>
							<div class="col-md-8 col-xl-4 p-0">
								<input type="text" class="form-control form-control-sm" data-db="telefempre" maxlength="20" data-nombre="Teléfonos Empresa" data-permiso="29">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Cargo</label>
							<div class="col-md-8 col-xl-4 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="cargoid" maxlength="15" data-nombre="Cargo" data-foranea="cargo" data-foranea-codigo="cargoid" data-permiso="30">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="cargoidNombre"></span>
									</div>
								</div>
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Contacto</label>
							<div class="col-md-8 col-xl-6 p-0">
								<input type="text" class="form-control form-control-sm" data-db="contacto" maxlength="120" data-nombre="Contacto Empresa" data-permiso="31">
							</div>
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Tipo de Contacto</label>
							<div class="col-md-8 col-xl-2 p-0">
								<select class="form-control form-control-sm" data-db="tipocontac" data-nombre="Tipo Contacto Empresa" data-permiso="32">
									<option value="" disabled selected hidden></option>
									<option value="T">Telefónico</option>
									<option value="V">Visita</option>
									<option value="E">E-Mail</option>
									<option value="C">Correo</option>
									<option value="O">Otros</option>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Sector Económico</label>
							<div class="col-md-8 col-xl-6 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="sectorid" maxlength="15" data-nombre="Sector Económico Empresa" data-foranea="Sector" data-foranea-codigo="sectorid" data-permiso="33">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="sectoridNombre"></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-body d-table w-100 form-group pt-0 py-1">
						<div class="row">
							<label class="col-md-4 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0 offset-xl-3">Fecha Creación</label>
							<div class="col-md-8 col-xl-2 p-0">
								<input type="text" class="form-control form-control-sm" data-db="fechacreac" maxlength="10" data-nombre="Fecha Creación" readonly>
							</div>
						</div>
						<div class="row">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0 ">Observaciones</label>
							<div class="col-md-8 col-xl-10 p-0">
								<textarea class="form-control form-control-sm" data-db="observacio" data-nombre="Observaciones"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="carteraYCompras">
					<div class="card card-body d-table w-100 form-group pt-0 py-1">
						<div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Tarifa Retención en la Fuente</label>
							<div class="col-md-7 col-xl-3 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm numeric4 w-75" data-db="TariReteIdNombre" maxlength="8" data-foranea="TariRete" data-foranea-codigo="tarifa" data-permiso="52">
									<div class="input-group-append w-25">
										<input type="text" class="form-control form-control-sm input-group-addon" data-db="TariReteId" data-tabla="Proveedor" readonly data-nombre="Tarifa Retención en la Fuente" data-foranea="TariRete" data-foranea-codigo="tarireteid" data-permiso="52" style="border-bottom-left-radius: 0;border-top-left-radius: 0;">
									</div>
								</div>
							</div>
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Sobre Base (Sí) o (No)</label>
							<div class="col-md-7 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="SobreBase" data-nombre="Liquida Retención en la FUente Sobre Base" data-tabla="Proveedor" data-permiso="53">
									<option value="" disabled selected hidden></option>
									<option value="S">S</option>
									<option value="N">N</option>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Tarifa Retención IVA</label>
							<div class="col-md-7 col-xl-2 p-0">
								<input type="text" class="form-control form-control-sm numeric4" data-db="TarifRetIv" data-tabla="Proveedor" maxlength="12" data-nombre="Tarifa Retención IVA" data-permiso="51">
							</div>
						</div>
						<!-- <div class="row form-group">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">NO Liquidar IVA</label>
							<div class="col-md-7 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="NoLiquidarIVA" data-tabla="Cliente" data-nombre="NO Liquidar IVA" data-permiso="87">
									<option value="" disabled selected hidden></option>
									<option value="S">S</option>
									<option value="N">N</option>
								</select>
							</div>
						</div> -->

						<!-- <div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Tarifa Retención ICA</label>
							<div class="col-md-7 col-xl-2 p-0">
								<input type="text" class="form-control form-control-sm numeric4" data-db="TarifICA" data-tabla="Cliente" maxlength="12" data-nombre="Tarifa Retención ICA" data-permiso="91">
							</div>
						</div> -->
						
						<div class="row form-group">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Días Crédito</label>
							<div class="col-md-7 col-xl-1 p-0">
								<input type="text" class="form-control form-control-sm numeric" data-db="Dias" maxlength="3" data-nombre="Días Crédito Compras" data-tabla="Proveedor" data-permiso="54">
							</div>
							<!-- <label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Cupo de Crédito</label>
							<div class="col-md-7 col-xl-3 p-0">
								<input type="text" class="form-control form-control-sm numeric" data-db="Monto" data-tabla="Cliente" maxlength="10" data-nombre="Cupo Crédito" data-permiso="46">
							</div> -->
						</div>
						<!-- <div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Tipo de Cartera</label>
							<div class="col-md-7 col-xl-7 p-0">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control form-control-sm" data-db="TipoCartId" data-tabla="Cliente" maxlength="4" data-nombre="Tipo Cartera" data-foranea="TipoCart" data-foranea-codigo="tipocartid" data-permiso="44">
									<div class="input-group-append w-75">
										<span class="input-group-text w-100 ellipsis" data-db="tipoNombre"></span>
									</div>
								</div>
							</div>
						</div> -->
						<!-- <div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Bloqueo por Cupo</label>
							<div class="col-md-7 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="BloquMonto" data-tabla="Cliente" data-nombre="Bloqueo por Monto" data-permiso="81">
									<option value="" disabled selected hidden></option>
									<option value="S">S</option>
									<option value="N">N</option>
								</select>
							</div>
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Bloqueo por Vencimiento</label>
							<div class="col-md-7 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="BloquVenci" data-db="BloquVenci" data-tabla="Cliente" data-nombre="Bloqueo por Vencimiento" data-permiso="82">
									<option value="" disabled selected hidden></option>
									<option value="S">S</option>
									<option value="N">N</option>
								</select>
							</div>
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Aplicar Bloqueos a Pedidos</label>
							<div class="col-md-7 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="BloquPedid" data-tabla="Cliente" data-nombre="Aplicar Bloqueos a Pedidos" data-permiso="83">
									<option value="" disabled selected hidden></option>
									<option value="S">S</option>
									<option value="N">N</option>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Lista de Precio</label>
							<div class="col-md-7 col-xl-1 p-0">
								<input type="number" min="0" max="10" class="form-control form-control-sm numeric" data-db="ListaPrecio" data-tabla="Cliente" maxlength="2" data-nombre="Lista de Precio" value="0" data-permiso="84">
							</div>
						</div> -->
						<!-- <div class="row">
							<label class="col-md-5 col-xl-3 col-form-label col-form-label-md text-md-right pl-0 py-0">Liquida Intéres</label>
							<div class="col-md-7 col-xl-1 p-0">
								<select class="form-control form-control-sm" data-db="Interes" data-tabla="Cliente" data-nombre="Liquida Intéres" data-permiso="48">
									<option value="" disabled selected hidden></option>
									<option value="S">S</option>
									<option value="N">N</option>
								</select>
							</div>
						</div> -->
						<div class="row">
							<div data-crud-tabla="DescuentoFinancieroTercero" data-crud-dt="dtDescuentoFinancieroTercero" data-permiso="45" class="col-xl-4">
								<div class="alert alert-info d-table pt-0 pb-1 w-100">
									<div class="row">
										<b class="w-100">Descuentos Financieros</b>

										<div class="col-xl-12">
											<div class="row">
												<div class="d-none">
													<label class="col-md-5 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
													<div class="col-md-7 col-xl-10 p-0">
														<input type="text" class="form-control form-control-sm" data-crud="DescuFinaTercId" data-crud-codigo="DescuFinaTercId" data-nombre="Id">
													</div>
												</div>
												<label class="col-md-5 col-xl-8 col-form-label col-form-label-md text-md-right pl-0 py-0">Días Máximos de Pago</label>
												<div class="col-md-7 col-xl-4 p-0">
													<input type="text" class="form-control form-control-sm numeric" data-crud="Dias" maxlength="3" data-nombre="Días Descuentos Financieros" data-permiso="45">
												</div>
												<label class="col-md-5 col-xl-8 col-form-label col-form-label-md text-md-right pl-0 py-0">%</label>
												<div class="col-md-7 col-xl-4 p-0">
													<input type="text" class="form-control form-control-sm numeric4" data-crud="Porcentaje" maxlength="12" data-nombre="Porcentaje Descuentos Financieros" data-permiso="45">
												</div>
											</div>
										</div>
										<div class="col-xl-12 p-3 text-center">
											<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem" data-permiso="45">
												<span class="fas fa-plus"></span>
											</button>
											<button type="button" class="btn btn-danger btnEliminar" title="Eliminar" data-permiso="45">
												<span class="far fa-trash-alt"></span>
											</button>
										</div>
									</div>
									<table id="tblDescuentoFinancieroTercero" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Id</th>
												<th>Días Máximos de Pago</th>
												<th>%</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
							<div data-crud-tabla="TarifaICATercero" data-crud-dt="dtTarifaICATercero" data-permiso="50" class="col-xl-8">
								<div class="alert alert-info d-table pt-0 pb-1 w-100">
									<div class="row">
										<b class="w-100">Tarifas de ICA</b>

										<div class="col-xl-12">
											<div class="row">
												<div class="d-none">
													<label class="col-md-5 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
													<div class="col-md-7 col-xl-10 p-0">
														<input type="text" class="form-control form-control-sm" data-crud="Id" data-crud-codigo="Id" data-nombre="Id">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8 p-3 text-center">
											<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem" data-permiso="50">
												<span class="fas fa-plus"></span>
											</button>
											<button type="button" class="btn btn-danger btnEliminar" title="Eliminar" data-permiso="50">
												<span class="far fa-trash-alt"></span>
											</button>
										</div>
										<div class="col-md-4 p-3 text-center">
											<button type="button" class="btn btn-danger btnQuitarTodo w-100" data-permiso="50">
												<span class="fas fa-trash-alt"></span> Quitar Todo
											</button>
										</div>
									</div>
									<table id="tblTarifaICATercero" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Id</th>
												<th>Código</th>
												<th>Nombre</th>
												<th>Tarifa&nbsp;(%)</th>
												<th>Ciudad</th>
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

				<div class="tab-pane fade" id="sucursales" data-crud-tabla="Sucursal" data-crud-dt="dtSucursales" data-permiso="60">
					<div class="alert alert-info d-table w-100 py-1">
						<div class="row">
							<div class="col-xl-11">
								<div class="row">
									<div class="d-none">
										<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
										<div class="col-md-8 col-xl-10 p-0">
											<input type="text" class="form-control form-control-sm" data-crud="sucursalid" maxlength="10" data-crud-codigo="sucursalid" data-nombre="Id">
										</div>
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Nombre</label>
									<div class="col-md-8 col-xl-10 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="nombre" maxlength="100" data-nombre="Razón Social Sucursal" data-permiso="61">
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dirección</label>
									<div class="col-md-8 col-xl-10 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="direccion" maxlength="100" data-nombre="Dirección Sucursal" data-permiso="62">
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Ciudad</label>
									<div class="col-md-8 col-xl-4 p-0">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm" data-crud="ciudadid" maxlength="5" data-nombre="Ciudad Sucursal" data-permiso="63" data-foranea="ciudad" data-foranea-codigo="ciudadid">
											<div class="input-group-append w-75">
												<span class="input-group-text w-100 ellipsis" data-crud="ciudadidNombre"></span>
											</div>
										</div>
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Barrio</label>
									<div class="col-md-8 col-xl-4 p-0">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm" data-crud="barrioid" maxlength="15" data-nombre="Barrio Sucursal" data-permiso="64" data-foranea="barrio" data-foranea-codigo="barrioid">
											<div class="input-group-append w-75">
												<span class="input-group-text w-100 ellipsis" data-crud="barrioidNombre"></span>
											</div>
										</div>
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dpto</label>
									<div class="col-md-8 col-xl-4 p-0">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm" data-crud="dptoid" maxlength="15" data-nombre="Departamento Sucursal" data-permiso="65" data-foranea="dpto" data-foranea-codigo="dptoid">
											<div class="input-group-append w-75">
												<span class="input-group-text w-100 ellipsis" data-crud="dptoidNombre"></span>
											</div>
										</div>
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">País</label>
									<div class="col-md-8 col-xl-4 p-0">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm" data-crud="paisid" maxlength="15" data-nombre="País Sucursal" data-permiso="66" data-foranea="pais" data-foranea-codigo="paisid">
											<div class="input-group-append w-75">
												<span class="input-group-text w-100 ellipsis" data-crud="paisidNombre"></span>
											</div>
										</div>
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Zona</label>
									<div class="col-md-8 col-xl-4 p-0">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm" data-crud="zonaid" maxlength="15" data-nombre="Zona Sucursal" data-permiso="67" data-foranea="zona" data-foranea-codigo="zonaid">
											<div class="input-group-append w-75">
												<span class="input-group-text w-100 ellipsis" data-crud="zonaidNombre"></span>
											</div>
										</div>
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Teléfonos</label>
									<div class="col-md-8 col-xl-4 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="telefono" maxlength="50" data-nombre="Teléfono Sucursal" data-permiso="68">
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">E-Mail</label>
									<div class="col-md-8 col-xl-4 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="email" maxlength="60" data-nombre="E-Mail Sucursal" data-permiso="69">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Vendedor</label>
									<div class="col-md-8 col-xl-4 p-0">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm" data-crud="vendedorid" maxlength="15" data-nombre="Vendedor Sucursal" data-permiso="70" data-foranea="vendedor" data-foranea-codigo="vendedorid">
											<div class="input-group-append w-75">
												<span class="input-group-text w-100 ellipsis" data-crud="vendedoridNombre"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-1 p-3 text-center">
								<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem" data-permiso="60">
									<span class="fas fa-plus"></span>
								</button>
								<button type="button" class="btn btn-danger btnEliminar mt-xl-2" title="Eliminar" data-permiso="60">
									<span class="far fa-trash-alt"></span>
								</button>
							</div>
						</div>
					</div>
					<table id="tblSucursales" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Id</th>
								<th>Nombre</th>
								<th>Ciudad</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="informacionAdicionalCRM" data-crud-tabla="CRMTercero" data-crud-dt="dtInformacionAdicionalCRM" data-permiso="55">
					<div class="alert alert-info d-table w-100 py-1">
						<div class="row">
							<div class="col-xl-11">
								<div class="row d-none">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
									<div class="col-md-8 col-xl-2 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="id" maxlength="10" data-crud-codigo="id" data-nombre="Id">
									</div>
								</div>
							</div>
							<div class="col-xl-1 p-3 text-center">
								<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem" data-permiso="55">
									<span class="fas fa-plus"></span>
								</button>
								<button type="button" class="btn btn-danger btnEliminar mt-xl-2" title="Eliminar" data-permiso="55">
									<span class="far fa-trash-alt"></span>
								</button>
							</div>
						</div>
					</div>

					<table id="tblInformacionAdicionalCRM" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Campo</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="contactos" data-crud-tabla="Contacto" data-crud-dt="dtContactos" data-permiso="71">
					<div class="alert alert-info d-table w-100 py-1">
						<div class="row">
							<div class="col-xl-11">
								<div class="row d-none">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
									<div class="col-md-8 col-xl-2 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="contactoid" maxlength="10" data-crud-codigo="contactoid" data-nombre="Id">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Nombre</label>
									<div class="col-md-8 col-xl-10 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="nombre" maxlength="60" data-nombre="Nombre Contacto" data-permiso="72">
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Dependencia</label>
									<div class="col-md-8 col-xl-10 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="dependencia" maxlength="100" data-nombre="Dependencia Contacto" data-permiso="73">
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Cargo</label>
									<div class="col-md-8 col-xl-10 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="cargo" maxlength="100" data-nombre="Cargo Contacto" data-permiso="74">
									</div>
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Fecha Nacimiento</label>
									<div class="col-md-8 col-xl-3 p-0">
										<div class="input-group datepicker input-group-sm">
											<input type="text" class="form-control form-control-sm datepicker dateFecha" value="<?= date('Y-m-d') ?>" data-crud="fechanacim" maxlength="10" data-nombre="Fecha de Nacimiento Contacto" data-permiso="75">
											<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
												<span class="input-group-text fas fa-calendar-alt d-flex"></span>
											</a>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">E-Mail</label>
									<div class="col-md-8 col-xl-4 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="email" maxlength="60" data-nombre="Email Contacto" data-permiso="76">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Teléfono</label>
									<div class="col-md-8 col-xl-4 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="telefono" maxlength="50" data-nombre="Teléfono Contacto" data-permiso="77">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Celular</label>
									<div class="col-md-8 col-xl-4 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="celular" maxlength="50" data-nombre="Celular Contacto" data-permiso="78">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0" for="idGestionCartera">Gestión de Cartera</label>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" data-crud="GestionCartera" data-nombre="Gestión Cartera" data-permiso="79" class="custom-control-input" id="idGestionCartera">
										<label class="custom-control-label" for="idGestionCartera">&nbsp;</label>
									</div>
								</div>
							</div>
							<div class="col-xl-1 p-3 text-center">
								<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem" data-permiso="71">
									<span class="fas fa-plus"></span>
								</button>
								<button type="button" class="btn btn-danger btnEliminar mt-xl-2" title="Eliminar" data-permiso="71">
									<span class="far fa-trash-alt"></span>
								</button>
							</div>
						</div>
					</div>

					<table id="tblContactos" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Id</th>
								<th>Nombre</th>
								<th>Cargo</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="adjuntos" data-crud-tabla="TerceroAdjunto" data-crud-dt="dtAdjuntos" data-permiso="95">
					<div class="alert alert-info d-table w-100 py-1">
						<div class="row">
							<div class="col-xl-11">
								<div class="row d-none">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Id</label>
									<div class="col-md-8 col-xl-2 p-0">
										<input type="text" class="form-control form-control-sm" data-crud="id" maxlength="10" data-crud-codigo="AdjuntoID" data-nombre="Id">
									</div>
								</div>
								<div class="row">
									<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Adjunto</label>
									<form enctype="multipart/form-data">
										<div class="col-md-8 col-xl-4 p-0">
											<div class="input-group input-group-sm">
												<div class="custom-file custom-file-sm">
													<input type="file" class="custom-file-input custom-file-input-sm" id="adj" lang="es">
													<label class="custom-file-label custom-file-label-sm" data-browse='Elegir' for="adj">Seleccione un archivo...</label>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-xl-1 p-3 text-center">
								<button type="button" class="btn btn-success btnAgregar" title="Agregar Ítem" data-permiso="95">
									<span class="fas fa-plus"></span>
								</button>
								<button type="button" class="btn btn-danger btnEliminar mt-xl-2" title="Eliminar" data-permiso="95">
									<span class="far fa-trash-alt"></span>
								</button>
							</div>
						</div>
					</div>

					<table id="tblAdjuntos" class="table table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>AdjuntoId</th>
								<th>TerceroId</th>
								<th>Adjunto</th>
								<th>Nombre</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	var $TERCModif = JSON.parse("<?= json_encode($TERCModif) ?>");
	var $TERCCrear = JSON.parse("<?= json_encode($TERCCrear) ?>");
	var $TERCElimi = JSON.parse("<?= json_encode($TERCElimi) ?>");
</script>