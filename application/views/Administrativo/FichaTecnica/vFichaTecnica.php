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

	.wizard>div.wizard-inner {
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

	.wizard .nav-tabs>li.active>a,
	.wizard .nav-tabs>li.active>a:hover,
	.wizard .nav-tabs>li.active>a:focus {
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

	.wizard .nav-tabs>li {
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

	.wizard .nav-tabs>li a {
		width: 70px;
		height: 70px;
		margin: 20px auto;
		border-radius: 100%;
		padding: 0;
		position: relative;
	}

	.wizard .nav-tabs>li a:hover {
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

	@media(max-width: 585px) {

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

		.wizard .nav-tabs>li a {
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

	/*.btnCollapse{
		font-size: 16px !important;
	}*/
	.box {
		-webkit-transition: 3s ease;
		-moz-transition: 3s ease;
		-o-transition: 3s ease;
		transition: 3s ease;
	}

	[data-toggle="collapse"]:after {
		display: inline-block;
		display: inline-block;
		font-family: 'Font Awesome 5 Free';
		font: normal normal normal 15px/1;
		font-size: 2em;
		font-weight: bold;
		text-rendering: auto;
		-webkit-font-mdoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		content: "\f105";
		transform: rotate(90deg);
		transition: all linear 0.25s;
		float: right;
	}

	[data-toggle="collapse"].collapsed:after {
		transform: rotate(0deg);
	}

	[data-toggle="collapse"].navbar-toggler:after {
		content: none;
	}

	.btn-collapse {
		color: #fff;
		background-color: #4894d7;
		border-color: #4894d7;
	}

	.btn-collapse:hover {
		color: #fff !important;
		background-color: #3289d7;
		border-color: #3289d7;
	}

	.btn-collapse:focus,
	.btn-collapse.focus {
		outline: 0 !important;
		box-shadow: 0 0 0 0 !important;
	}

	.accordion>.card {
		overflow: visible !important;
	}

	.txtCenter {
		text-align: center !important;
	}
</style>

<div class="wizard">
	<div class="wizard-inner">
		<div class="connecting-line"></div>
		<ul class="nav nav-tabs justify-content-between" role="tablist">
			<li role="presentation" class="nav-item">
				<a href="#tabVehi" id="tabV" data-toggle="tab" aria-controls="tabVehi" role="tab" title="Vehiculo" class="nav-link active">
					<span class="round-tab2">
						<i class="fas fa-car"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabMaqui" id="tabM" data-toggle="tab" aria-controls="tabMaqui" role="tab" title="Maquinaria y equipo" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-tractor"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabEqui" id="tabC" data-toggle="tab" aria-controls="tabEqui" role="tab" title="Equipo de computo" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-laptop"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabLoca" id="tabL" data-toggle="tab" aria-controls="tabLoca" role="tab" title="Locativa" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-home"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabInf" id="tab5" data-toggle="tab" aria-controls="tabInf" role="tab" title="Informes" class="nav-link ">
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
				<div class="col-12 col-sm-4 col-xl-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block btnRegistro" data-tab="Tvehiculo" data-class="DataVehi" data-tipo="Vehiculo"><i class="fas fa-plus mr-1"></i>Registrar vehiculo</button>
				</div>
				<div class=" col-12 table-responsive p-0">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display w-100 tblPPAL" id="tblCRUDVehiculo" cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>VehiculoId</th>
								<th>Nombre</th>
								<th>Serial</th>
								<th>Placa</th>
								<th>Linea</th>
								<th>Tipo</th>
								<th>Color</th>
								<th>Observacion</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="DataVehi box d-none">
				<form id="frmVehiculo" autocomplete="off">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-4 col-xl-3 form-valid">
							<span class="text-danger">*</span><label class="mb-0" for="TipoViviendaId">Equipo:</label>
							<select class="form-control form-control-sm chosen-select ignore" data-db="ItemEquipoId" data-tabla="Vehiculo" data-rastreo="Equipo" data-clave="VehiculoId" required>
								<option value="" selected disabled>Seleccione equipo...</option>
								<option value="">&nbsp;</option>
								<?php
								foreach ($Vehiculo as $value) {
									echo '<option value="' . $value->ItemEquipoId . '" data-equipo="' . $value->EquipoId . '">' . $value->nombre . '</option>';
								}
								?>
							</select>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Serial:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Serial" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Marca:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="marcaid" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Familia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FamiliaId" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Modelo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Modelo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Color:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="colorEquipo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código interno">
							<label class="mb-0" for="">Cód. interno:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoInterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código externo">
							<label class="mb-0" for="">Cód. externo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoExterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Fin de garantia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FinGarantia" disabled>
						</div>
					</div>
					<div class="accordion col-12 mt-2 p-0 verEditar" id="accDBV">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllDBV" aria-expanded="true" aria-controls="cllDBV">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clipboard-list"></i> Datos básicos
								</h5>
							</button>
							<div id="cllDBV" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accDBV">
								<div class="row">
									<div class="col-sm-6 col-md-4 col-xl-2 form-valid">
										<span class="text-danger">*</span><label class="mb-0" for="">Placa:</label>
										<input type="text" class="form-control form-control-sm ignore toUpperTrim" data-db="Placa" data-tabla="Vehiculo" name="placa" data-rastreo="Placa" required>
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Linea:</label>
										<input type="text" class="form-control form-control-sm" data-db="Linea" data-tabla="Vehiculo" data-rastreo="Linea">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Tipo:</label>
										<input type="text" class="form-control form-control-sm" data-db="Tipo" data-tabla="Vehiculo" data-rastreo="Tipo">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3" title="Numero de chasis">
										<label class="mb-0" for="">Num. Chasis:</label>
										<input type="text" class="form-control form-control-sm" data-db="NumChasis" data-tabla="Vehiculo" data-rastreo="Numero de chasis">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3" title="Numero de motor">
										<label class="mb-0" for="">Num. Motor:</label>
										<input type="text" class="form-control form-control-sm" data-db="NumMotor" data-tabla="Vehiculo" data-rastreo="Numero de motor">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Cilindraje:</label>
										<input type="text" class="form-control form-control-sm numerico" data-db="Cilindraje" data-tabla="Vehiculo" data-rastreo="Cilindraje">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Uso de vehículo:</label>
										<input type="text" class="form-control form-control-sm numerico" data-db="UsoVehiculo" data-tabla="Vehiculo" data-rastreo="Uso de vehiculo">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3" title="Numero interno">
										<label class="mb-0" for="">Num. Interno:</label>
										<input type="text" class="form-control form-control-sm" data-db="NumInterno" data-rastreo="Numero interno">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-4" title="Numero de licencia de transporte">
										<label class="mb-0" for="">Num. Lic. Transporte:</label>
										<input type="text" class="form-control form-control-sm" data-db="NumLicenciaTrans" data-tabla="Vehiculo" data-rastreo="Numero de licencia de transporte">
									</div>

									<!-- TITULO INTERNO -->
									<div class="col-12">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
											<label class="labelLink">Motor</label>
										</a>
										<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
									</div>

									<div class="col-sm-6 col-md-4 col-xl-2" title="Cantidad de válvulas">
										<label class="mb-0" for="">Cant. Válvulas:</label>
										<input type="text" class="form-control form-control-sm" data-db="CantValvulas" data-tabla="Vehiculo" data-rastreo="Cantidad de valvulas">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Cantidad de cilindros">
										<label class="mb-0" for="">Cant. Cilindros:</label>
										<input type="text" class="form-control form-control-sm" data-db="CantCilindros" data-tabla="Vehiculo" data-rastreo="Cantidad de cilindros">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Turbo:</label>
										<input type="text" class="form-control form-control-sm" data-db="Turbo" data-tabla="Vehiculo" data-rastreo="Turbo">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Orientación:</label>
										<input type="text" class="form-control form-control-sm" data-db="Orientacion" data-tabla="Vehiculo" data-rastreo="Orientacion">
									</div>

									<!-- TITULO INTERNO -->
									<div class="col-12">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
											<label class="labelLink">Dirección / Trasmisión / Suspensión</label>
										</a>
										<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Tipo dirección:</label>
										<input type="text" class="form-control form-control-sm" data-db="TipoDireccion" data-tabla="Vehiculo" data-rastreo="Tipo de direccion">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Tipo transmisión:</label>
										<input type="text" class="form-control form-control-sm" data-db="TipoTransmision" data-tabla="Vehiculo" data-rastreo="Tipo de transmision">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Numero de velocidades">
										<label class="mb-0" for="">Num. Velocidades:</label>
										<input type="text" class="form-control form-control-sm numerico" data-db="NumVelocidades" data-tabla="Vehiculo" data-rastreo="Numero de velocidades">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Tipo rodamiento:</label>
										<input type="text" class="form-control form-control-sm" data-db="TipoRodamiento" data-tabla="Vehiculo" data-rastreo="Tipo de rodamiento">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Suspensión delantera">
										<label class="mb-0" for="">Susp. Delantera:</label>
										<input type="text" class="form-control form-control-sm" data-db="SuspenDelantera" data-tabla="Vehiculo" data-rastreo="Suspension delantera">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Suspensión trasera">
										<label class="mb-0" for="">Susp. Trasera:</label>
										<input type="text" class="form-control form-control-sm" data-db="SuspenTrasera" data-tabla="Vehiculo" data-rastreo="Suspension trasera">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Numero de llantas">
										<label class="mb-0" for="">Num. Llantas:</label>
										<input type="text" class="form-control form-control-sm" data-db="NumLlantas" data-tabla="Vehiculo" data-rastreo="Numero de llantas">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Dimensión de rines">
										<label class="mb-0" for="">Dimen. Rines:</label>
										<input type="text" class="form-control form-control-sm" data-db="DimeRines" data-tabla="Vehiculo" data-rastreo="Dimension de rines">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Material rines:</label>
										<input type="text" class="form-control form-control-sm" data-db="MaterialRines" data-tabla="Vehiculo" data-rastreo="Material de rines">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Tipo de freno delantero">
										<label class="mb-0" for="">Tipo freno delan.:</label>
										<input type="text" class="form-control form-control-sm" data-db="TipoFrenosd" data-tabla="Vehiculo" data-rastreo="Tipo de freno delantero">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Tipo de freno trasero">
										<label class="mb-0" for="">Tipo freno tras.:</label>
										<input type="text" class="form-control form-control-sm" data-db="TipoFrenost" data-tabla="Vehiculo" data-rastreo="Tipo de freno trasero">
									</div>

									<!-- TITULO INTERNO -->
									<div class="col-12">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
											<label class="labelLink">Carroceria</label>
										</a>
										<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3" title="Numero de serie de carroceria">
										<label class="mb-0" for="">Num. serie carroceria:</label>
										<input type="text" class="form-control form-control-sm" data-db="NumSerieCarroce" data-tabla="Vehiculo" data-rastreo="Numero de serie de carroceria">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Numero de ventanas">
										<label class="mb-0" for="">Num. ventanas:</label>
										<input type="text" class="form-control form-control-sm numerico" data-db="NumVentas" data-tabla="Vehiculo" data-rastreo="Material de rines">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Numero de pasajeros">
										<label class="mb-0" for="">Num. pasajeros:</label>
										<input type="text" class="form-control form-control-sm numerico" data-db="CapCargaPasajeros" data-tabla="Vehiculo" data-rastreo="Numero de pasajeros">
									</div>
									<div class="col-sm-12 col-md-12 col-xl-12">
										<label class="mb-0" for="">Observaciones:</label>
										<textarea type="text" class="form-control form-control-sm" rows="2" data-db="Observacion" data-tabla="Vehiculo" data-rastreo="Observaciones"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accEVV">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllEVV" aria-expanded="true" aria-controls="cllEVV">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clipboard-check"></i> Elementos del vehículo
								</h5>
							</button>
							<div id="cllEVV" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accEVV">
								<div class="row">
									<div class="col-12 col-sm-12 col-md-6 col-xl-4">
										<!-- TITULO INTERNO -->
										<div class="col-12 p-0">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Caja de herramientas</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-12 p-0 mb-2">
											<button class="btn btn-primary btn-sm btn-block col-sm-6 col-md-6 col-xl-4 btnEV" data-tipo="H" data-tabla="tblCajaHerramienta" data-nombre="Caja de herramientas"><i class="fas fa-plus"></i> Agregar</button>
										</div>
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento" id="tblCajaHerramienta" cellspacing="0" style="width: 100%;">
											<thead>
												<tr>
													<th>Elemento</th>
													<th>Cantidad</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
									<div class="col-12 col-sm-12 col-md-6 col-xl-4">
										<!-- TITULO INTERNO -->
										<div class="col-12 p-0">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Equipo de carretera</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-12 p-0 mb-2">
											<button class="btn btn-primary btn-sm btn-block col-sm-6 col-md-6 col-xl-4 btnEV" data-tipo="E" data-tabla="tblEquipoCarretera" data-nombre="Equipo de carretera"><i class="fas fa-plus"></i> Agregar</button>
										</div>
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento" id="tblEquipoCarretera" cellspacing="0" style="width: 100%;">
											<thead>
												<tr>
													<th>Elemento</th>
													<th>Cantidad</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
									<div class="col-12 col-sm-12 col-md-6 col-xl-4">
										<!-- TITULO INTERNO -->
										<div class="col-12 p-0">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Botiquin</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>
										<div class="col-12 p-0 mb-2">
											<button class="btn btn-primary btn-sm btn-block col-sm-6 col-md-6 col-xl-4 btnEV" data-tipo="B" data-tabla="tblBotiquin" data-nombre="Botiquin"><i class="fas fa-plus"></i> Agregar</button>
										</div>
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento" id="tblBotiquin" cellspacing="0" style="width: 100%;">
											<thead>
												<tr>
													<th>Elemento</th>
													<th>Cantidad</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOTV">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOTV" aria-expanded="true" aria-controls="cllOTV">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clock"></i> Operaciones de tiempo
								</h5>
							</button>
							<div id="cllOTV" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOTV">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="TV" data-tabla="tblOperacionTV" data-op="T" data-modu="Vehiculo" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionTV" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Valor de medida">Val. Medida</th>
													<th title="Fecha de última operación">Fecha Ult. Operación</th>
													<th title="Fecha de próxima operación">Fecha prox. Operación</th>
													<th>Días de alerta</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOCV">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOCV" aria-expanded="true" aria-controls="cllOCV">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-hourglass-half"></i> Operaciones de consumo
								</h5>
							</button>
							<div id="cllOCV" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOCV">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="CV" data-tabla="tblOperacionCV" data-op="C" data-modu="Vehiculo" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive" style="height: 240px;">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionCV" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Unidad de medida">Und. de medida</th>
													<th title="Valor de ultima opración">Val. ult. operación</th>
													<th title="Valor de notificación">Val. Notificación</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accANXV">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" id="btnAnexo" data-toggle="collapse" data-tipo="V" data-target="#cllANV" aria-expanded="true" aria-controls="cllANV">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-upload"></i> Anexos
								</h5>
							</button>
							<div id="cllANV" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accANXV">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnANX" data-tabla="tblAnexoV"><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblANX w-100" id="tblAnexoV" cellspacing="0">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Documento</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-group col-12 mt-2 p-0" role="group">
						<button type="button" class="btn btn-danger col-2 ml-auto btnCancelar" data-tabla="Vehiculo" data-class="DataVehi" data-tab="Tvehiculo" data-clave="VehiculoId">&nbsp;Cancelar&nbsp;</button>
						<button type="submit" class="btn btn-success col-6 col-sm-3 col-xl-2 btnGuardar" form="frmVehiculo" data-class="DataVehi" data-tab="Tvehiculo" data-tabla="tblCRUDVehiculo" data-tbl="Vehiculo" data-clave="VehiculoId" id="btnGuardar">&nbsp;Guardar&nbsp;</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Tab contenido de maquinaria y equipo -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabMaqui">
			<div class="TMaquinaria box">
				<div class="col-12 col-sm-4 col-xl-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block btnRegistro" data-tab="TMaquinaria" data-class="DataMaqui" data-tipo="Maquinaria"><i class="fas fa-plus mr-1"></i>Registrar maquinaria</button>
				</div>
				<div class=" col-12 table-responsive p-0">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display w-100 tblPPAL" id="tblCRUDMaquinaria" cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>MaquinariaId</th>
								<th>Nombre</th>
								<th>Serial</th>
								<th>ResponUso</th>
								<th>Ubicacion</th>
								<th>CodActivoFijo</th>
								<th>Caracteristica</th>
								<th>Tipo</th>
								<th>Observacion</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataMaqui box d-none">
				<form id="frmMaquinaria" autocomplete="off">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-4 col-xl-3 form-valid">
							<span class="text-danger">*</span><label class="mb-0" for="TipoViviendaId">Equipo:</label>
							<select class="form-control form-control-sm chosen-select ignore" data-db="ItemEquipoId" data-tabla="Maquinaria" data-rastreo="Equipo" data-clave="MaquinariaId" required>
								<option value="" selected disabled>Seleccione equipo...</option>
								<option value="">&nbsp;</option>
								<?php
								foreach ($Maquinaria as $value) {
									echo '<option value="' . $value->ItemEquipoId . '" data-equipo="' . $value->EquipoId . '">' . $value->nombre . '</option>';
								}
								?>
							</select>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Serial:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Serial" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Marca:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="marcaid" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Familia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FamiliaId" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Modelo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Modelo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Color:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="colorEquipo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código interno">
							<label class="mb-0" for="">Cód. interno:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoInterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código externo">
							<label class="mb-0" for="">Cód. externo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoExterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Fin de garantia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FinGarantia" disabled>
						</div>
					</div>
					<div class="accordion col-12 mt-2 p-0 verEditar" id="accDBM">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllDBM" aria-expanded="true" aria-controls="cllDBM">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clipboard-list"></i> Datos básicos
								</h5>
							</button>
							<div id="cllDBM" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accDBM">
								<div class="row">
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Responsable de uso:</label>
										<input type="text" class="form-control form-control-sm" data-db="ResponUso" data-tabla="Maquinaria" data-rastreo="Responsable de uso">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Responsable de operación:</label>
										<input type="text" class="form-control form-control-sm" data-db="ResponOperacion" data-tabla="Maquinaria" data-rastreo="Responsable de operacion">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Ubicación:</label>
										<input type="text" class="form-control form-control-sm" data-db="Ubicacion" data-tabla="Maquinaria" data-rastreo="Ubicacion">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Caracteristica:</label>
										<input type="text" class="form-control form-control-sm" data-db="Caracteristica" data-tabla="Maquinaria" data-rastreo="Caracteristica">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3" title="Código de activo fijo">
										<label class="mb-0" for="">Cod. Activo fijo:</label>
										<input type="text" class="form-control form-control-sm" data-db="CodActivoFijo" data-tabla="Maquinaria" data-rastreo="Codigo de activo fijo">
									</div>

									<!-- TITULO INTERNO -->
									<div class="col-12">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
											<label class="labelLink">Fuente de alimentación</label>
										</a>
										<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
									</div>

									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Tolerancia:</label>
										<input type="text" class="form-control form-control-sm" data-db="Tolerancia" data-tabla="Maquinaria" data-rastreo="Tolerancia">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Gas:</label>
										<input type="text" class="form-control form-control-sm" data-db="Gas" data-tabla="Maquinaria" data-rastreo="Gas">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Motor:</label>
										<input type="text" class="form-control form-control-sm" data-db="Motor" data-tabla="Maquinaria" data-rastreo="Motor">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Aire:</label>
										<input type="text" class="form-control form-control-sm" data-db="Aire" data-tabla="Maquinaria" data-rastreo="Aire">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Presión:</label>
										<input type="text" class="form-control form-control-sm" data-db="Presion" data-tabla="Maquinaria" data-rastreo="Presion">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Agua:</label>
										<input type="text" class="form-control form-control-sm" data-db="Agua" data-tabla="Maquinaria" data-rastreo="Agua">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Volumen:</label>
										<input type="text" class="form-control form-control-sm" data-db="Volumen" data-tabla="Maquinaria" data-rastreo="Volumen">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Electricidad / Voltaje">
										<label class="mb-0" for="">Elect. / Volt. :</label>
										<input type="text" class="form-control form-control-sm" data-db="Electivoltaje" data-tabla="Maquinaria" data-rastreo="Electricidad y/o voltaje">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Amperios:</label>
										<input type="text" class="form-control form-control-sm" data-db="amp" data-tabla="Maquinaria" data-rastreo="Amperios">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Combustible:</label>
										<input type="text" class="form-control form-control-sm" data-db="Combustible" data-tabla="Maquinaria" data-rastreo="Combustible">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Tipo:</label>
										<input type="text" class="form-control form-control-sm" data-db="Tipo" data-tabla="Maquinaria" data-rastreo="Tipo">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Potencia:</label>
										<input type="text" class="form-control form-control-sm" data-db="Potencia" data-tabla="Maquinaria" data-rastreo="Potencia">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Capacidad:</label>
										<input type="text" class="form-control form-control-sm" data-db="Capacidad" data-tabla="Maquinaria" data-rastreo="Capacidad">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2" title="Revoluciones por minuto">
										<label class="mb-0" for="">RPM:</label>
										<input type="text" class="form-control form-control-sm" data-db="rpm" data-tabla="Maquinaria" data-rastreo="RPM">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Lubricación:</label>
										<input type="text" class="form-control form-control-sm" data-db="Lubricacion" data-tabla="Maquinaria" data-rastreo="Lubricacion">
									</div>
									<div class="col-12">
										<label class="mb-0" for="">Observaciones:</label>
										<textarea type="text" class="form-control form-control-sm" rows="2" data-db="Observacion" data-tabla="Maquinaria" data-rastreo="Observaciones"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOTM">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOTM" aria-expanded="true" aria-controls="cllOTM">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clock"></i> Operaciones de tiempo
								</h5>
							</button>
							<div id="cllOTM" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOTM">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="TM" data-tabla="tblOperacionTM" data-op="T" data-modu="Maquinaria" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionTM" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Valor de medida">Val. Medida</th>
													<th title="Fecha de última operación">Fecha Ult. Operación</th>
													<th title="Fecha de próxima operación">Fecha prox. Operación</th>
													<th>Días de alerta</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOCM">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOCM" aria-expanded="true" aria-controls="cllOCM">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-hourglass-half"></i> Operaciones de consumo
								</h5>
							</button>
							<div id="cllOCM" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOCM">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="CM" data-tabla="tblOperacionCM" data-op="C" data-modu="Maquinaria" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive" style="height: 240px;">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionCM" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Unidad de medida">Und. de medida</th>
													<th title="Valor de ultima opración">Val. ult. operación</th>
													<th title="Valor de notificación">Val. Notificación</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accANXM">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" id="btnAnexo" data-toggle="collapse" data-tipo="V" data-target="#cllANM" aria-expanded="true" aria-controls="cllANM">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-upload"></i> Anexos
								</h5>
							</button>
							<div id="cllANM" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accANXM">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnANX" data-tabla="tblAnexoM"><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblANX w-100" id="tblAnexoM" cellspacing="0">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Documento</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-group col-12 mt-2 p-0" role="group">
						<button type="button" class="btn btn-danger col-6 col-sm-3 col-xl-2 ml-auto btnCancelar" data-tabla="Maquinaria" data-class="DataMaqui" data-tab="TMaquinaria" data-clave="MaquinariaId">&nbsp;Cancelar&nbsp;</button>
						<button type="submit" class="btn btn-success col-6 col-sm-3 col-xl-2 btnGuardar" form="frmMaquinaria" data-class="DataMaqui" data-tab="TMaquinaria" data-tabla="tblCRUDMaquinaria" data-tbl="Maquinaria" data-clave="MaquinariaId" id="btnGuardar">&nbsp;Guardar&nbsp;</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Tab contenido de equipo computo -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabEqui">
			<div class="TEquipo box">
				<div class="col-12 col-sm-4 col-xl-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block btnRegistro" data-tab="TEquipo" data-class="DataEqui" data-tipo="EquipoComputo"><i class="fas fa-plus mr-1"></i>Registrar equipo</button>
				</div>
				<div class=" col-12 table-responsive p-0">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblPPAL w-100" id="tblCRUDComputo" cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>EquipoComputoId</th>
								<th>Nombre</th>
								<th>Serial</th>
								<th>Fecha de registro</th>
								<th>Tipo de computo</th>
								<th>Condiciones</th>
								<th>Color</th>
								<th>Observación</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataEqui box d-none">
				<form id="frmComputo" autocomplete="off">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-4 col-xl-3 form-valid">
							<span class="text-danger">*</span><label class="mb-0" for="">Equipo:</label>
							<select class="form-control form-control-sm chosen-select ignore" data-db="ItemEquipoId" data-tabla="EquipoComputo" data-rastreo="Equipo" data-clave="EquipoComputoId" required>
								<option value="" selected disabled>Seleccione equipo...</option>
								<option value="">&nbsp;</option>
								<?php
								foreach ($EquipoC as $value) {
									echo '<option value="' . $value->ItemEquipoId . '" data-equipo="' . $value->EquipoId . '">' . $value->nombre . '</option>';
								}
								?>
							</select>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Serial:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Serial" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Marca:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="marcaid" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Familia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FamiliaId" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Modelo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Modelo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Color:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="colorEquipo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código interno">
							<label class="mb-0" for="">Cód. interno:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoInterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código externo">
							<label class="mb-0" for="">Cód. externo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoExterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Fin de garantia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FinGarantia" disabled>
						</div>
					</div>
					<div class="accordion col-12 mt-2 p-0 verEditar" id="accDBE">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllDBE" aria-expanded="true" aria-controls="cllDBE">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clipboard-list"></i> Datos básicos
								</h5>
							</button>
							<div id="cllDBE" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accDBE">
								<div class="row">
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Fecha registro:</label>
										<div class="input-group date cha2 datepicker">
											<input type="text" class="form-control form-control-sm dateFecha" maxlength="15" data-db="FechaRegistro" data-tabla="EquipoComputo" data-rastreo="Fecha de registro">
											<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
												<span class="input-group-text fas fa-calendar-alt d-flex"></span>
											</a>
										</div>
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Tipo de computo:</label>
										<select class="form-control form-control-sm" data-db="TipoComputo" data-tabla="EquipoComputo" data-rastreo="Tipo de computo">
											<option value="">&nbsp;</option>
											<option value="ES">Escritorio</option>
											<option value="PO">Portatil</option>
											<option value="SE">Servidor</option>
										</select>
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Condiciones:</label>
										<input type="text" class="form-control form-control-sm" data-db="Condiciones" data-tabla="EquipoComputo" data-rastreo="Condiciones">
									</div>
									<div class="col-12">
										<label class="mb-0" for="">Observaciones:</label>
										<textarea type="text" class="form-control form-control-sm" rows="2" data-db="Observacion" data-tabla="EquipoComputo" data-rastreo="Observaciones"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOTE">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOTE" aria-expanded="true" aria-controls="cllOTE">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clock"></i> Operaciones de tiempo
								</h5>
							</button>
							<div id="cllOTE" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOTE">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="TE" data-tabla="tblOperacionTE" data-op="T" data-modu="EquipoComputo" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionTE" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Valor de medida">Val. Medida</th>
													<th title="Fecha de última operación">Fecha Ult. Operación</th>
													<th title="Fecha de próxima operación">Fecha prox. Operación</th>
													<th>Días de alerta</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOCE">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOCE" aria-expanded="true" aria-controls="cllOCE">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-hourglass-half"></i> Operaciones de consumo
								</h5>
							</button>
							<div id="cllOCE" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOCE">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="CE" data-tabla="tblOperacionCE" data-op="C" data-modu="EquipoComputo" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive" style="height: 240px;">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionCE" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Unidad de medida">Und. de medida</th>
													<th title="Valor de ultima opración">Val. ult. operación</th>
													<th title="Valor de notificación">Val. Notificación</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accANXE">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" id="btnAnexo" data-toggle="collapse" data-tipo="V" data-target="#cllANE" aria-expanded="true" aria-controls="cllANE">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-upload"></i> Anexos
								</h5>
							</button>
							<div id="cllANE" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accANXE">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnANX" data-tabla="tblAnexoE"><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblANX w-100" id="tblAnexoE" cellspacing="0">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Documento</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-group col-12 mt-2 p-0" role="group">
						<button type="button" class="btn btn-danger col-6 col-sm-3 col-xl-2 ml-auto btnCancelar" data-tabla="EquipoComputo" data-class="DataEqui" data-tab="TEquipo" data-clave="EquipoComputoId">&nbsp;Cancelar&nbsp;</button>
						<button type="submit" class="btn btn-success col-6 col-sm-3 col-xl-2 btnGuardar" form="frmComputo" data-class="DataEqui" data-tab="TEquipo" data-tabla="tblCRUDComputo" data-tbl="EquipoComputo" data-clave="EquipoComputoId" id="btnGuardar">&nbsp;Guardar&nbsp;</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Tab contenido de locativa -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabLoca">
			<div class="TLocativa box">
				<div class="col-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block btnRegistro" data-tab="TLocativa" data-class="DataLoca" data-tipo="Locativa"><i class="fas fa-plus mr-1"></i>Registrar locativa</button>
				</div>
				<div class=" col-12 table-responsive p-0">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblPPAL w-100" id="tblCRUDLocativa" cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>LocativaId</th>
								<th>Nombre</th>
								<th>Serial</th>
								<th>Estructura</th>
								<th>Area</th>
								<th>Accesorios</th>
								<th>Fecha de registro</th>
								<th>Observación</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataLoca box d-none">
				<form id="frmLocativa" autocomplete="off">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-4 col-xl-3 form-valid">
							<span class="text-danger">*</span><label class="mb-0" for="">Equipo:</label>
							<select class="form-control form-control-sm chosen-select ignore" data-db="ItemEquipoId" data-tabla="Locativa" data-rastreo="Equipo" data-clave="LocativaId" required>
								<option value="" selected disabled>Seleccione equipo...</option>
								<option value="">&nbsp;</option>
								<?php
									foreach ($Locativa as $value) {
										echo '<option value="' . $value->ItemEquipoId . '" data-equipo="' . $value->EquipoId . '">' . $value->nombre . '</option>';
									}
								?>
							</select>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Serial:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Serial" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Marca:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="marcaid" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Familia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FamiliaId" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Modelo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="Modelo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Color:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="colorEquipo" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código interno">
							<label class="mb-0" for="">Cód. interno:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoInterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0" title="Código externo">
							<label class="mb-0" for="">Cód. externo:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="CodigoExterno" disabled>
						</div>
						<div class="col-md-4 col-xl-3 pl-3 py-0">
							<label class="mb-0" for="">Fin de garantia:</label>
							<input type="text" class="form-control form-control-sm txtDisabled" data-db="FinGarantia" disabled>
						</div>
					</div>
					<div class="accordion col-12 mt-2 p-0 verEditar" id="accDBL">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllDBL" aria-expanded="true" aria-controls="cllDBL">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clipboard-list"></i> Datos básicos
								</h5>
							</button>
							<div id="cllDBL" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accDBL">
								<div class="row">
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Estructura:</label>
										<input type="text" class="form-control form-control-sm" data-db="Estructura" data-tabla="Locativa" data-rastreo="Estructura">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Area:</label>
										<input type="text" class="form-control form-control-sm" data-db="Area" data-tabla="Locativa" data-rastreo="Area">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-3">
										<label class="mb-0" for="">Accesorios:</label>
										<input type="text" class="form-control form-control-sm" data-db="Accesorios" data-tabla="Locativa" data-rastreo="Accesorios">
									</div>
									<div class="col-sm-6 col-md-4 col-xl-2">
										<label class="mb-0" for="">Fecha registro:</label>
										<div class="input-group date cha2 datepicker">
											<input type="text" class="form-control form-control-sm dateFecha" maxlength="15" data-db="FechaRegistro" data-tabla="Locativa" data-rastreo="Fecha de registro">
											<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
												<span class="input-group-text fas fa-calendar-alt d-flex"></span>
											</a>
										</div>
									</div>
									<div class="col-12">
										<label class="mb-0" for="">Observaciones:</label>
										<textarea type="text" class="form-control form-control-sm" rows="2" data-db="Observacion" data-tabla="Locativa" data-rastreo="Observaciones"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOTL">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOTL" aria-expanded="true" aria-controls="cllOTL">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-clock"></i> Operaciones de tiempo
								</h5>
							</button>
							<div id="cllOTL" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOTL">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="TL" data-tabla="tblOperacionTL" data-op="T" data-modu="Locativa" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionTL" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Valor de medida">Val. Medida</th>
													<th title="Fecha de última operación">Fecha Ult. Operación</th>
													<th title="Fecha de próxima operación">Fecha prox. Operación</th>
													<th>Días de alerta</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accOCL">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#cllOCL" aria-expanded="true" aria-controls="cllOCL">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-hourglass-half"></i> Operaciones de consumo
								</h5>
							</button>
							<div id="cllOCL" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accOCL">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnOP" data-tipo="CL" data-tabla="tblOperacionCL" data-op="C" data-modu="Locativa" id=""><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive" style="height: 240px;">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblOPT w-100" id="tblOperacionCL" cellspacing="0">
											<thead>
												<tr>
													<th>Operación</th>
													<th title="Valor de frecuencia">Val. Frecuencia</th>
													<th title="Unidad de medida">Und. de medida</th>
													<th title="Valor de ultima opración">Val. ult. operación</th>
													<th title="Valor de notificación">Val. Notificación</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion col-12 p-0 verEditar" id="accANXL">
						<div class="card border-bottom mb-0">
							<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" id="btnAnexo" data-toggle="collapse" data-tipo="V" data-target="#cllANL" aria-expanded="true" aria-controls="cllANL">
								<h5 class="mb-0 my-auto">
									<i class="fas fa-upload"></i> Anexos
								</h5>
							</button>
							<div id="cllANL" class="collapse container-fluid pt-3 pb-2" aria-labelledby="Historial" data-parent="#accANXL">
								<div class="row">
									<div class="col-12 col-md-2 mb-2">
										<button class="btn btn-primary btn-sm btn-block btnANX" data-tabla="tblAnexoL"><i class="fas fa-plus"></i> Agregar</button>
									</div>
									<div class="col-12 table-responsive">
										<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblANX w-100" id="tblAnexoL" cellspacing="0">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Documento</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-group col-12 mt-2 p-0" role="group">
						<button type="button" class="btn btn-danger col-6 col-sm-3 col-xl-2 ml-auto btnCancelar" data-tabla="Locativa" data-class="DataLoca" data-tab="TLocativa" data-clave="LocativaId">&nbsp;Cancelar&nbsp;</button>
						<button type="submit" class="btn btn-success col-6 col-sm-3 col-xl-2 btnGuardar" form="frmLocativa" data-class="DataLoca" data-tab="TLocativa" data-tabla="tblCRUDLocativa" data-tbl="Locativa" data-clave="LocativaId" id="btnGuardar">&nbsp;Guardar&nbsp;</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Tab contenido de informes -->
		<div class="tab-pane container-fluid" role="tabpanel" id="tabInf">
		</div>
	</div>
</div>

<div class="modal fade" id="mOperacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-chack"></i>Seleccionar operacion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="frmCRUD" autocomplete="off">
					<div class="row">
						<div class="col-12">
							<div class="alert alert-primary txtAlert" role="alert">
								<strong> Operaciones</strong> asociadas al equipo
							</div>
						</div>
					</div>
					<div class="row rowDataOpe">
						<div class="col-12">
							<div class="input-group">
								<input type="" name="" class="form-control mr-1" readonly value="Jose David Sanz Martinez">
								<button type="button" class="btn btn-primary f-r" id="btnCA"><i class="fas fa-check-circle"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" id="btnCerrar" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$VALMEDIDA = `
		<select class="form-control form-control-sm undMedidaTiempo tiempoOP w-100">
			<option value="001" data-tipo="Dias">Dias</option>
			<option value="002" data-tipo="Semanas">Semanas</option>
			<option value="003" data-tipo="Meses">Meses</option>
			<option value="004" data-tipo="Anios">Años</option>
		</select>
	`;
	$INPUTOT = `
		<div class="input-group">
			<button class="btn btn-sm btn-primary mr-1 cargaOP" title="Cargar operación" data-tipo="T">
				<i class="fas fa-upload"></i>
			</button>
			<input class="form-control form-control-sm nomOP">
		</div>
	`;
	$INPUTOC = `
		<div class="input-group">
			<button class="btn btn-sm btn-primary mr-1 cargaOP" title="Cargar operación" data-tipo="C">
				<i class="fas fa-upload"></i>
			</button>
			<input class="form-control form-control-sm nomOP">
		</div>
	`;

	$UNIDADES = <?= $undMedida ?>;

	$UNDMEDIDA = `
		<select class="form-control form-control-sm chosen-select undOP" id="equipoOC">
			<option value="" selected disabled>Seleccione unidad de medida...</option>
			<option value="">&nbsp;</option>
	`;
	for (var i = 0; i < $UNIDADES.length; i++) {
		$UNDMEDIDA += '<option value="' + $UNIDADES[i].id + '" data-tipo="' + $UNIDADES[i].nombre + '">' + $UNIDADES[i].nombre + '</option>';
	}
	$UNDMEDIDA += '</select>';
</script>