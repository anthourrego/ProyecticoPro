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

	span.round-tab2 {
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

	span.round-tab2 i {
		color: #555555;
	}

	.wizard li a.active span.round-tab2 {
		background: #fff;
		border: 2px solid #3a77bc;

	}

	.wizard li a.active span.round-tab2 i {
		color: #3a77bc;
	}

	span.round-tab2:hover {
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
		padding-left: 0;
		padding-right: 0;
	}

	.wizard h3 {
		margin-top: 0;
	}

	@media( max-width: 585px) {

		.wizard {
			width: 90%;
			height: auto !important;
		}

		span.round-tab2 {
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
	.btnCollapse{
		font-size: 16px !important;
	}
	.box{
		-webkit-transition: 3s ease;
		-moz-transition: 3s ease;
		-o-transition: 3s ease;
		transition: 3s ease;
	}
</style>

<div class="wizard">
	<div class="wizard-inner">
		<div class="connecting-line"></div>
		<ul class="nav nav-tabs justify-content-between" role="tablist">
			<li role="presentation" class="nav-item">
				<a href="#tabVehi" id="tab1" data-toggle="tab" aria-controls="tabVehi" role="tab" title="Vehiculo" class="nav-link active">
					<span class="round-tab2">
						<i class="fas fa-car"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabMaqui"  id="tab2"  data-toggle="tab" aria-controls="tabMaqui" role="tab" title="Maquinaria y equipo" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-tractor"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabEqui"  id="tab3" data-toggle="tab" aria-controls="tabEqui" role="tab" title="Equipo de computo" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-laptop"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabLoca"  id="tab4" data-toggle="tab" aria-controls="tabLoca" role="tab" title="Locativa" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-home"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabInf"  id="tab5" data-toggle="tab" aria-controls="tabInf" role="tab" title="Informes" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-chart-area"></i>
					</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="tab-content">
		<!-- Tab contenido de vehiculo -->
		<div class="tab-pane active container-fluid" role="tabpanel" id="tabVehi">
			<div class="Tvehiculo box">
				<div class="col-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block" id="crearFichaVehivulo">Registrar vehiculo</button>
				</div>
				<div id="divTbl w-100">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDVehiculo" width="100%"  cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>VehiculoId</th>		
								<th>ItemEquipoId</th>
								<th>Placa</th>				 
								<th>Linea</th>				 
								<th>Tipo</th>				 
								<th>Color</th>				 
								<th>NumChasis</th>			 
								<th>NumMotor</th>			 
								<th>Cilindraje</th>			 
								<th>UsoVehiculo</th> 
								<th>NumInterno</th>			 
								<th>NumLicenciaTrans</th>	 
								<th>CantValvulas</th>		 
								<th>CantCilindros</th>		 
								<th>Turbo</th>				 
								<th>Orientacion</th>		 
								<th>TipoDireccion</th>		 
								<th>TipoTransmision</th>	 
								<th>NumVelocidades</th>		 
								<th>TipoRodamiento</th>		 
								<th>SuspenDelantera</th>	 
								<th>SuspenTrasera</th>		 
								<th>NumLlantas</th>			 
								<th>DimeRines</th>			 
								<th>MaterialRines</th>		 
								<th>TipoFrenost</th>		 
								<th>TipoFrenosd</th>		 
								<th>NumSerieCarroce</th>	 
								<th>NumVentas</th>			 
								<th>CapCargaPasajeros</th>	 
								<th>Observacion</th> 
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataVehi box d-none ">
				<div id="accordion"> 
					<div class="card mb-0">
						<form id="frmVehiclulo">
							<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
								<h5 class="mb-0">
									<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#datosEquipo" aria-expanded="true" aria-controls="datosEquipo">
										Datos de equipo
									</button>
								</h5>
							</div>

							<div id="datosEquipo" class="collapse show collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-12 col-sm-6 col-md-6 col-xl-3">
											*<label class="mb-0" for="TipoViviendaId">Equipo</label>
											<select class="form-control form-control-sm chosen-select" data-db="TipoViviendaId" data-required>
												<option value="">&nbsp;</option>
												<option value="">Primer equipo</option>
												<option value="">Segundo equipo</option>
												<?php if(count($TipoVivienda) > 0) {
													foreach ($TipoVivienda as $key) {
														echo "<option value='".$key->id."'>".$key->nombre."</option>";
													}
												} ?>
											</select>
										</div>
										<div class="col-7">
											<label class="labelForm" for="nombre">*Nombre</label>
											<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
										</div>
										<div class="col-2">
											<label class="labelForm" for="fecha">*Fecha</label>
											<input type="text" class="form-control form-control-sm date" id="fecha" required>
										</div>
										<div class="col-12">
											<label class="labelForm" for="observacion">Observaciones</label>
											<textarea class="form-control form-control-sm" id="observacion" rows="1" maxlength="450"></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
								<h5 class="mb-0">
									<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#datosBasicos" aria-expanded="true" aria-controls="datosBasicos">
										Datos basicos
									</button>
								</h5>
							</div>

							<div id="datosBasicos" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<label class="labelForm" for="cedula">*Cedula</label>
											<input type="text" class="form-control form-control-sm numerico" id="cedula" required autofocus maxlength="15">
										</div>
										<div class="col-7">
											<label class="labelForm" for="nombre">*Nombre</label>
											<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
										</div>
										<div class="col-2">
											<label class="labelForm" for="fecha">*Fecha</label>
											<input type="text" class="form-control form-control-sm date" id="fecha" required>
										</div>
										<div class="col-12">
											<label class="labelForm" for="observacion">Observaciones</label>
											<textarea class="form-control form-control-sm" id="observacion" rows="1" maxlength="450"></textarea>
										</div>
										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Motor</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-3">
											<label class="labelForm" for="cedula">*Cedula</label>
											<input type="text" class="form-control form-control-sm numerico" id="cedula" required autofocus maxlength="15">
										</div>
										<div class="col-7">
											<label class="labelForm" for="nombre">*Nombre</label>
											<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
										</div>
										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Dirección / Transmisión / Suspensión</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-3">
											<label class="labelForm" for="cedula">*Cedula</label>
											<input type="text" class="form-control form-control-sm numerico" id="cedula" required autofocus maxlength="15">
										</div>
										<div class="col-7">
											<label class="labelForm" for="nombre">*Nombre</label>
											<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
										</div>
										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Frenos</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-3">
											<label class="labelForm" for="cedula">*Cedula</label>
											<input type="text" class="form-control form-control-sm numerico" id="cedula" required autofocus maxlength="15">
										</div>
										<div class="col-7">
											<label class="labelForm" for="nombre">*Nombre</label>
											<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
										</div>
										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Carroceria</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-3">
											<label class="labelForm" for="cedula">*Cedula</label>
											<input type="text" class="form-control form-control-sm numerico" id="cedula" required autofocus maxlength="15">
										</div>
										<div class="col-7">
											<label class="labelForm" for="nombre">*Nombre</label>
											<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
										</div>
									</div>
								</div>
							</div>
						</form>

						<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
							<h5 class="mb-0">
								<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#elementosVehi" aria-expanded="true" aria-controls="elementosVehi">
									Elementos del vehiculo
								</button>
							</h5>
						</div>

						<div id="elementosVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
							<div class="card-body">
								<form id="frmIngreso" autocomplete="off">
									<div class="row">
										<div class="col-12 col-sm-6 col-md-6 col-xl-4">
											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
													<label class="labelLink">Caja de herramientas</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>
											<div class="col-5 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa">Agregar</button>
											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="Tblcajaheramienta" width="100%"  cellspacing="0">
														<thead>
															<tr>
																<th>Acciones</th>
																<th>Elemento</th>		
																<th>Cantidad</th>
															</tr>
														</thead>
														<tbody></tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-6 col-xl-4">
											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Equipo de carretera</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>
											<div class="col-5 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa">Agregar</button>
											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="TblEquipoCarretera" width="100%"  cellspacing="0">
														<thead>
															<tr>
																<th>Acciones</th>
																<th>Elemento</th>		
																<th>Cantidad</th>
															</tr>
														</thead>
														<tbody></tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-6 col-xl-4">
											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Botiquin</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>
											<div class="col-5 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa">Agregar</button>
											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="TblBotiquin" width="100%"  cellspacing="0">
														<thead>
															<tr>
																<th>Acciones</th>
																<th>Elemento</th>		
																<th>Cantidad</th>
															</tr>
														</thead>
														<tbody></tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
							<h5 class="mb-0">
								<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#opeTiempoVehi" aria-expanded="true" aria-controls="opeTiempoVehi">
									Operaciones de tiempo
								</button>
							</h5>
						</div>

						<div id="opeTiempoVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
							<div class="card-body">
								<form id="frmIngreso" autocomplete="off">
									<div class="row">
										<div class="col-2 mb-2">
											<button class="btn btn-sm btn-primary btn-block registrarActa">Agregar</button>
										</div>
										<div class="col-12">
											<div id="divTbl w-100">
												<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="TblOperacionesTiempo" width="100%"  cellspacing="0">
													<thead>
														<tr>
															<th>Acciones</th>
															<th>Operación</th>		
															<th>Valor frecuencia</th>
															<th>Valor de medida</th>
															<th title="Fecha última operación">Fecha última op.</th>
															<th>Días de alerta</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
							<h5 class="mb-0">
								<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#opeConsuVehi" aria-expanded="true" aria-controls="opeConsuVehi">
									Operaciones de consumo
								</button>
							</h5>
						</div>

						<div id="opeConsuVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
							<div class="card-body">
								<form id="frmIngreso" autocomplete="off">
									<div class="row">
										<div class="col-2 mb-2">
											<button class="btn btn-sm btn-primary btn-block registrarActa">Agregar</button>
										</div>
										<div class="col-12">
											<div id="divTbl w-100">
												<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="TblOperacionesConsumo" width="100%"  cellspacing="0">
													<thead>
														<tr>
															<th>Acciones</th>
															<th>Operación</th>		
															<th>Valor frecuencia</th>
															<th title="Valor última operación">Valor última op.</th>
															<th>Valor de notificación</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
							<h5 class="mb-0">
								<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#anexosVehi" aria-expanded="true" aria-controls="anexosVehi">
									Anexos
								</button>
							</h5>
						</div>

						<div id="anexosVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
							<div class="card-body">
								<form id="frmIngreso" autocomplete="off">
									<div class="row">
										<div class="col-2 mb-2">
											<button class="btn btn-sm btn-primary btn-block registrarActa">Agregar</button>
										</div>
										<div class="col-12">
											<div id="divTbl w-100">
												<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="TblAnexosVehiculo" width="100%"  cellspacing="0">
													<thead>
														<tr>
															<th>Acción</th>
															<th>Anexo</th>		
															<th>Nombre</th>
															<th>Documento</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="btn-group col-12 mt-2 p-0" role="group">
					<button type="button" class="btn btn-danger col-2 ml-auto" id="btnCancelar">&nbsp;Cancelar&nbsp;</button>
					<button type="submit" class="btn btn-success col-2 " form="frmIngreso" id="btnGuardar">&nbsp;Guardar&nbsp;</button>
				</div>
			</div>
		</div>

		<!-- Tab contenido de maquinaria y equipo -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabMaqui">
			<div class="TMaquinaria box">
				<div class="col-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block" id="crearFichaVehivulo">Registrar maquinaria</button>
				</div>
				<div id="divTbl w-100">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDMaquinaria" width="100%"  cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>MaquinariaId</th>
								<th>ItemEquipoId</th>	
								<th>ResponUso</th>		 
								<th>ResponOperacion</th>  
								<th>Ubicacion</th>		 
								<th>CodActivoFijo</th> 
								<th>Tolerancia</th>		 
								<th>Caracteristica</th>  
								<th>Gas</th>		 
								<th>Motor</th>		 
								<th>Aire</th>		 
								<th>Presion</th>	 
								<th>Agua</th>		 
								<th>Volumen</th>	 
								<th>Electivoltaje</th> 
								<th>amp</th>		 
								<th>Combustible</th> 
								<th>Tipo</th>		 
								<th>Potencia</th>	 
								<th>Capacidad</th>	 
								<th>rpm</th>		 
								<th>Lubricacion</th> 
								<th>Observacion</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataMaqui box d-none ">
			</div>
		</div>

		<!-- Tab contenido de equipo computo -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabEqui">
			<div class="TEquipo box">
				<div class="col-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block" id="crearFichaVehivulo">Registrar equipo</button>
				</div>
				<div id="divTbl w-100">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDComputo" width="100%"  cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>EquipoComputoId</th>
								<th>ItemEquipoId</th>
								<th>FechaRegistro</th>
								<th>TipoComputo</th>
								<th>Condiciones</th>	
								<th>Color</th>			
								<th>Observacion</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataEqui box d-none ">
			</div>
		</div>

		<!-- Tab contenido de locativa -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabLoca">
			<div class="TLocativa box">
				<div class="col-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block" id="crearFichaVehivulo">Registrar locativa</button>
				</div>
				<div id="divTbl w-100">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDLocativa" width="100%"  cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>EquipoComputoId</th>
								<th>ItemEquipoId</th>
								<th>FechaRegistro</th>
								<th>TipoComputo</th>
								<th>Condiciones</th>	
								<th>Color</th>			
								<th>Observacion</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataLoca box d-none ">
			</div>
		</div>

		<!-- Tab contenido de informes -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabInf">
		</div>
	</div>
</div>