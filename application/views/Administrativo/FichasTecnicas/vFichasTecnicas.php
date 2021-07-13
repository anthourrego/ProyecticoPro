
<style type="text/css">
	.txtCenter{
		text-align: center;
	}
	.txtJusty{
		text-align: justify;
	}
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

	.OpcionesTDocsTabs {
		padding: 0;
		background-color: #ffffff !important;
		border: 1px solid #4894d7 !important;
	}
	.OpcionesTDocsTabs  a.active{
		color : #fff !important;
		background-color: #4894D7 !important;
	}
	.ATDocs{
		background-color: transparent !important;
		padding: 6px 10px !important;
	}

	body {
		background: #F9F9F9;
	}

	.myaccordion .btn {
		width: 100%;
	}

	.myaccordion .btn-link:hover,
	.myaccordion .btn-link:focus {
		text-decoration: none;
	}

	.myaccordion li + li {
		margin-top: 10px;
	}

	#TblOperacionesTiempo td{
		vertical-align: middle;
	}

</style>
<div class="wizard">
	<div class="wizard-inner">
		<div class="connecting-line"></div>
		<ul class="nav nav-tabs justify-content-between" role="tablist">
			<li role="presentation" class="nav-item">
				<a href="#tabVehi" id="tabVehib" data-toggle="tab" aria-controls="tabVehi" role="tab" title="Vehiculo" class="nav-link active">
					<span class="round-tab2">
						<i class="fas fa-car"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabMaqui" id="tabMaquib" data-toggle="tab" aria-controls="tabMaqui" role="tab" title="Maquinaria y equipo" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-tractor"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabEqui" id="tabEquib" data-toggle="tab" aria-controls="tabEqui" role="tab" title="Equipo de computo" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-laptop"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabLoca" id="tabLocab" data-toggle="tab" aria-controls="tabLoca" role="tab" title="Locativa" class="nav-link ">
					<span class="round-tab2">
						<i class="fa fa-home"></i>
					</span>
				</a>
			</li>
			<li role="presentation" class="nav-item">
				<a href="#tabInf" id="tabInfb" data-toggle="tab" aria-controls="tabInf" role="tab" title="Informes" class="nav-link ">
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
			<div class="Tvehiculo box ">
				<div class="col-2 p-0 mb-3">
					<button class="btn btn-sm btn-primary btn-block" id="crearFichaVehivulo">Registrar vehiculo</button>
				</div>
				<div id="divTbl w-100">
					<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDVehiculo" width="100%"  cellspacing="0">
						<thead>
							<tr>
								<th>Acciones</th>
								<th>Id</th>		
								<th>ItemEquipoId</th>
								<th>Nombre Equipo</th>
								<th>Placa</th>				 
								<th>Linea</th>				 
								<th>Tipo</th>				 
								<th>Color</th>				 
								<th title="Numero de chasis">Num. Chasis</th>			 
								<th title="Numero de motor">Num. Motor</th>			 
								<th>Cilindraje</th>			 
								<th>UsoVehiculo</th> 
								<th title="Numero interno">Num. Interno</th>			 
								<th title="Numero de licencia de transito">Num. Lic</th>	 
								<th title="Cantidad de valvulas">Cant. Valvulas</th>		 
								<th title="Cantidad de cilindros">Cant. Cilindros</th>		 
								<th>Turbo</th>				 
								<th>Orientacion</th>		 
								<th>Tipo de dirección</th>		 
								<th>Tipo de transmisión</th>	 
								<th title="Numero de Velocidades">Num. de velocidades</th>		 
								<th>Tipo de rodamiento</th>		 
								<th title="Numero de serie de carroceria">Num. Serie carroceria</th>	 
								<th>Observacion</th> 
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="DataVehi box ">
				<div id="accordion"> 
					<div class="card mb-0">
						<form id="frmVehiclulo" autocomplete="off">
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

										<div class="chos-unit col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Equipo</label>
											<select data-tabla="Vehiculo" id="ItemEquipoId" class="chosen-select chosen form-control form-control-sm ItemEquipoId" data-rastreo="ItemEquipoId" tabindex="1" required>
												<option value="" selected disabled>Seleccione equipo...</option>
												<option value="">&nbsp;</option>										
												<?php  
													foreach ($Vehiculo as $value) {
														echo '<option value="'.$value->ItemEquipoId.'" data-equipo="'.$value->EquipoId.'">'.$value->nombre.'</option>';
													}
												?>
											</select>
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0"">
											<label class="col-form-label col-form-label-md pl-0 py-0">Serial</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="Serial" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0"">
											<label class="col-form-label col-form-label-md pl-0 py-0">Marca</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="Marca" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>


										<div class="col-md-4 col-xl-3 pl-3 py-0"">
											<label class="col-form-label col-form-label-md pl-0 py-0">Familia</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="Familia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Modelo</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="Modelo" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Color</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="Color" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>


										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Código Interno</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="CodigoInterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>


										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Código Externo</label>
											<input type="text" class="form-control form-control-sm" data-dbItem="CodigoExterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
										</div>


										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Fin Garantia:</label>
											<div class="input-group date cha1 datepicker">
												<input type="text" class="form-control form-control-sm Fecha" data-dbItem="FinGarantia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled maxlength="15">
												<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
													<span class="input-group-text fas fa-calendar-alt d-flex"></span>
												</a>
											</div>
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

										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<span class="text-danger f-left mr-1">*</span><label class="col-form-label col-form-label-md pl-0 py-0">Placa</label>
											<input type="text" class="campo form-control form-control-sm validarCampo" data-db="Placa" maxlength="15" data-nombre="Placa" required  value="">
										</div>

										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Linea</label>
											<input type="text" class="campo form-control form-control-sm" data-db="Linea" maxlength="20" data-nombre="Linea">
										</div>

										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Tipo</label>
											<input type="text" class="campo form-control form-control-sm" data-db="Tipo" maxlength="50" data-nombre="Tipo">
										</div>

										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">N Motor</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumMotor" maxlength="20" data-nombre="Número Motor">
										</div>

										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">N Chasis</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumChasis" maxlength="20" data-nombre="Numero chasis">
										</div>


										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Cilindraje</label>
											<input type="text" class="campo form-control form-control-sm" data-db="Cilindraje" maxlength="20" data-nombre="Cilindraje">
										</div>

										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Uso Vehiculo</label>
											<input type="text" class="campo form-control form-control-sm" data-db="UsoVehiculo" maxlength="170" data-nombre="UsoVehiculo">
										</div>


										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Numero Interno</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumInterno" maxlength="20" data-nombre="NumInterno">
										</div>


										<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md pl-0 py-0">Número Licencia Trans</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumLicenciaTrans" maxlength="20" data-nombre="NumLicenciaTrans">
										</div>


										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Motor</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Cantidad Valvulas</label>
											<input type="text" class="campo form-control form-control-sm validarCampo" data-db="CantValvulas" maxlength="20" data-nombre="CantValvulas" data-codigo="codigo" value="">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Cantidad Cilindros</label>
											<input type="text" class="campo form-control form-control-sm" data-db="CantCilindros" maxlength="15" data-nombre="CantCilindros">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Turbo</label>
											<input type="text" class="campo form-control form-control-sm" data-db="Turbo" maxlength="30" data-nombre="Turbo">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Orientación</label>
											<input type="text" class="campo form-control form-control-sm" data-db="Orientacion" maxlength="30" data-nombre="Orientacion">
										</div>

										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Dirección / Transmisión / Suspensión</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">T Dirección</label>
											<input type="text" class="campo form-control form-control-sm validarCampo" data-db="TipoDireccion" maxlength="20" data-nombre="TipoDireccion"  value="">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">T Transmisión</label>
											<input type="text" class="campo form-control form-control-sm" data-db="TipoTransmision" maxlength="20" data-nombre="TipoTransmision">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">N Velocidaddes</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumVelocidades" maxlength="15" data-nombre="NumVelocidades">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">T Rodamiento</label>
											<input type="text" class="campo form-control form-control-sm" data-db="TipoRodamiento" maxlength="30" data-nombre="TipoRodamiento">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Susp Delantera</label>
											<input type="text" class="campo form-control form-control-sm validarCampo" data-db="SuspenDelantera" maxlength="15" data-nombre="SuspenDelantera"  value="">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Susp Trasera</label>
											<input type="text" class="campo form-control form-control-sm" data-db="SuspenTrasera" maxlength="30" data-nombre="Dígito de Verificación">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">N Llantas</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumLlantas" maxlength="15" data-nombre="NumLlantas">
										</div>

										<div class="col-md-3 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Dimensión Rines</label>
											<input type="text" class="campo form-control form-control-sm" data-db="DimeRines" maxlength="15" data-nombre="DimeRines">
										</div>

										<div class="col-12">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
												<label class="labelLink">Carroceria</label>
											</a>
											<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">N Serie Carroceria</label>
											<input type="text" class="campo form-control form-control-sm validarCampo" data-db="NumSerieCarroce" maxlength="20" data-nombre="NumSerieCarroce"  value="">
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">N Ventanas</label>
											<input type="text" class="campo form-control form-control-sm" data-db="NumVentas" maxlength="15" data-nombre="NumVentas">
										</div>

										<div class="col-md-4 col-xl-3 pl-3 py-0">
											<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">N Pasajeros</label>
											<input type="text" class="campo form-control form-control-sm" data-db="CapCargaPasajeros" maxlength="15" data-nombre="CapCargaPasajeros">
										</div>

										<div class="col-12 d-none">
											<label class="labelForm" for="nombre">Observación</label>
											<input type="text" class="form-control form-control-sm" required maxlength="450">
										</div>

										<div class="col-12 hide">
											<label class="labelForm" for="nombre">Observación</label>
											<textarea type="text" class="form-control form-control-sm" data-db="Observacion" maxlength="450" data-nombre="Observacion" ></textarea>
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
										<div class="col-12 col-sm-6 col-md-4 col-xl-4">
											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
													<label class="labelLink">Caja de herramientas</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>

											<div class="col-5 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearElemento" id="CrearElementoCaja" >Agregar</button>
											</div>

											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento" id="Tblcajaheramienta" data-tipo="H" cellspacing="0" style="width: 100%;">
														<thead>
															<tr>
																<th>Elemento</th>
																<th>Cantidad</th>
																<th>Acciónes</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-4 col-xl-4">
											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
													<label class="labelLink">Equipo de carretera</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>
											<div class="col-5 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa CrearElemento btnAgregar" id="CrearEquipoCarretera">Agregar</button>

											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento" id="TblEquipoCarretera" width="100%"  data-tipo="E" cellspacing="0">
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
										<div class="col-12 col-sm-6 col-md-4 col-xl-4">
											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
													<label class="labelLink">Botiquin</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>
											<div class="col-5 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa CrearElemento btnAgregar" id="CrearBotiquin">Agregar</button>

											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblElemento" id="TblBotiquin" width="100%" data-tipo="B" cellspacing="0">
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
											<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar" id="CrearOperacionTiempo">Agregar</button>
										</div>
										<div class="col-12">
											<div id="divTbl w-100">
												<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesTiempo" id="TblOperacionesTiempo" data-tipo="OT" cellspacing="0" style="width: 100%;">
													<thead>
														<tr>
															<th>Operación</th>		
															<th style="width: 5%">Valor frecuencia</th>
															<th style="width: 15%">Valor de medida</th>
															<th style="width: 10%" title="Fecha última operación">Fecha última op.</th>
															<th style="width: 10%" title="Fecha última operación">Fecha Prox op.</th>
															<th style="width: 7%">Días de alerta</th>
															<th style="width: 8%">Acciones</th>
														</tr>
													</thead>
													<tody></tbody>
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
												<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar" id="CrearOperacionConsumoVehiculo">Agregar</button>
											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesConsumo" id="TblOperacionesConsumo" data-tipo="OC" cellspacing="0" style="width: 100%;">
														<thead>
															<tr>
																<th>Acciónes</th>
																<th>Operación</th>
																<th>Valor Frecuencia</th>
																<th>Unidad de medida</th>
																<th title="Valor última operación">Valor última op.</th>
																<th>Valor notificación</th>
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
												<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar" id="CrearAnexosVehiculo" >Agregar</button>

											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblAnexos" id="TblAnexosVehiculo" data-tipo="AV" cellspacing="0" style="width: 100%;">
														<thead>
															<tr>
																<th>Acciónes</th>	
																<th>Anexo</th>
																<th>Nombre</th>
																<th>Documento</th>
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
							</div>

						</div>
					</div>

					<div class="btn-group col-12 mt-2 p-0" role="group">
						<button type="button" class="btn btn-danger col-2 ml-auto" id="btnCancelar" data-tipo="vehiculo">&nbsp;Cancelar&nbsp;</button>
						<button type="submit" class="btn btn-success col-2 " form="frmIngreso" id="btnGuardar" data-tipo="vehiculo">&nbsp;Guardar&nbsp;</button>
					</div>
				</div>
			</div>

			<!-- Tab contenido de maquinaria y equipo -->
			<div class="tab-pane container-fluid" role="tabpanel" id="tabMaqui">
				<div class="TMaquinaria box">
					<div class="col-2 p-0 mb-3">
						<button class="btn btn-sm btn-primary btn-block" id="crearMaquinariaEquipo">Registrar maquinaria</button>
					</div>
					<div id="divTbl w-100">
						<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDMaquinaria" width="100%"  cellspacing="0">
							<thead>
								<tr>
									<th>Acciones</th>
									<th>MaquinariaId</th>
									<th>ItemEquipoId</th>
									<th>Nombre Equipo</th>	
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
					<div id="accordion2"> 
						<div class="card mb-0">
							<form id="frmVehiclulo">
								<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacionm">
									<h5 class="mb-0">
										<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#datosEquipo" aria-expanded="true" aria-controls="datosEquipo">
											Datos de equipo
										</button>
									</h5>
								</div>

								<div id="datosEquipo" class="collapse show collaGen" aria-labelledby="registroInvitacionm" data-parent="#accordion2">
									<div class="card-body">
										<div class="row">

											<div class="chos-unit col-md-4 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Equipo</label>
												<select data-tabla="Maquinaria" id="ItemEquipoId" class="ItemEquipoId chosen chosen-select " data-rastreo="ItemEquipoId"  unico tabindex="1" required>
													<option value="" selected disabled>Seleccione equipo...</option>
													<option value="">&nbsp;</option>										
													<?php  
														foreach ($Maquinaria as $value) {
															echo '<option value="'.$value->ItemEquipoId.'">'.$value->nombre.'</option>';
														}
													?>
												</select>
											</div>

											<div class="col-md-4 col-xl-3 pl-3 py-0"">
												<label class="col-form-label col-form-label-md pl-0 py-0">Serial</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="Serial" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>

											<div class="col-md-4 col-xl-3 pl-3 py-0"">
												<label class="col-form-label col-form-label-md pl-0 py-0">Marca</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="Marca" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>


											<div class="col-md-4 col-xl-3 pl-3 py-0"">
												<label class="col-form-label col-form-label-md pl-0 py-0">Familia</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="Familia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>

											<div class="col-md-4 col-xl-3 pl-3 py-0>
												<label class="col-form-label col-form-label-md pl-0 py-0">Modelo</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="Modelo" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>

											<div class="col-md-4 col-xl-3 pl-3 py-0>
												<label class="col-form-label col-form-label-md pl-0 py-0">Color</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="Color" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>


											<div class="col-md-4 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Código Interno</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="CodigoInterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>


											<div class="col-md-4 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Código Externo</label>
												<input type="text" class="form-control form-control-sm" data-dbItem="CodigoExterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
											</div>

											<div class="col-md-4 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Fin Garantia:</label>
												<div class="input-group date cha1 datepicker">
													<input type="text" class="form-control form-control-sm Fecha" data-dbItem="FinGarantia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled maxlength="15">
													<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
														<span class="input-group-text fas fa-calendar-alt d-flex"></span>
													</a>
												</div>
											</div>

										</div>
									</div>
								</div>

								<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="dBasicoM">
									<h5 class="mb-0">
										<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#datosBasicos" aria-expanded="false" aria-controls="datosBasicos">
											Datos basicos
										</button>
									</h5>
								</div>

								<div id="datosBasicos" class="collapse collaGen" aria-labelledby="dBasicoM" data-parent="#accordion2">
									<div class="card-body">
										<div class="row">

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Responsable Uso</label>
												<input type="text" class="form-control form-control-sm" data-db="ResponUso" maxlength="100" data-nombre="ResponUso">
											</div>

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">ResponOperacion</label>
												<input type="text" class="form-control form-control-sm" data-db="ResponOperacion" maxlength="100" data-nombre="ResponOperacion">
											</div>

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Ubicación</label>
												<input type="text" class="form-control form-control-sm" data-db="Ubicacion" maxlength="100" data-nombre="Ubicacion">
											</div>

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Caracteristica</label>
												<input type="text" class="form-control form-control-sm" data-db="Caracteristica" maxlength="200" data-nombre="Caracteristica">
											</div>

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Código Activo Fijo</label>
												<input type="text" class="form-control form-control-sm" data-db="CodActivoFijo" maxlength="200" data-nombre="CodActivoFijo">
											</div>


											<div class="col-12">
												<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12" style="height: 0">
													<label class="labelLink">Fuente de Alimintación</label>
												</a>
												<hr class="w-100 mt-0 mb-2" style="border-color: #e0e0e0">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Tolerancia</label>
												<input type="text" class="form-control form-control-sm" data-db="Tolerancia" maxlength="200" data-nombre="Tolerancia">
											</div>

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Gas</label>
												<input type="text" class="form-control form-control-sm" data-db="Gas" maxlength="50" data-nombre="Gas">
											</div>


											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Motor</label>
												<input type="text" class="form-control form-control-sm" data-db="Motor" maxlength="50" data-nombre="Motor">
											</div>

											<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md pl-0 py-0">Aire</label>
												<input type="text" class="form-control form-control-sm" data-db="Aire" maxlength="50" data-nombre="Aire">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Presión</label>
												<input type="text" class="form-control form-control-sm" data-db="Presion" maxlength="50" data-nombre="Presion">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Agua</label>
												<input type="text" class="form-control form-control-sm validarCampo" data-db="Agua" maxlength="50" data-nombre="Agua" d value="">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Volumen</label>
												<input type="text" class="form-control form-control-sm" data-db="Volumen" maxlength="50" data-nombre="Volumen">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Elictricidad/Volt</label>
												<input type="text" class="form-control form-control-sm" data-db="ElectiVoltaje" maxlength="50" data-nombre="ElectiVoltaje">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Amperios</label>
												<input type="text" class="form-control form-control-sm" data-db="amp" maxlength="50" data-nombre="amp">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Combustible</label>
												<input type="text" class="form-control form-control-sm validarCampo" data-db="Combustible" maxlength="15" data-nombre="Combustible" value="">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Tipo</label>
												<input type="text" class="form-control form-control-sm" data-db="Tipo" maxlength="50" data-nombre="Tipo">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Potencia</label>
												<input type="text" class="form-control form-control-sm" data-db="Potencia" maxlength="50" data-nombre="Potencia">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Capacidad</label>
												<input type="text" class="form-control form-control-sm" data-db="Capacidad" maxlength="50" data-nombre="Capacidad">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Rpm</label>
												<input type="text" class="form-control form-control-sm" data-db="rpm" maxlength="50" data-nombre="rpm">
											</div>

											<div class="col-md-3 col-xl-3 pl-3 py-0">
												<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Lubricación</label>
												<input type="text" class="form-control form-control-sm" data-db="Lubricacion" maxlength="50" data-nombre="Lubricacion">
											</div>

											
											<div class="col-12 d-none">
												<label class="labelForm" for="nombre">Observación</label>
												<input type="text" class="form-control form-control-sm" required maxlength="450">
											</div>

											<div class="col-12 hide">
												<label class="labelForm" for="nombre">Observación</label>
												<textarea type="text" class="form-control form-control-sm" data-db="Observacion" maxlength="450" data-nombre="Observacion" ></textarea>
											</div>

										</div>
									</div>
								</div>
							</form>

							<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
								<h5 class="mb-0">
									<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#opeTiempoMaqui" aria-expanded="true" aria-controls="opeTiempoMaqui">
										Operaciones de tiempo
									</button>
								</h5>
							</div>

							<div id="opeTiempoMaqui" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion2">
								<div class="card-body">
									<form id="frmIngreso" autocomplete="off">
										<div class="row">
											<div class="col-2 mb-2">
												<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearOperacionTiempo" id="CrearOperacionTiempo">Agregar</button>
											</div>
											<div class="col-12">
												<div id="divTbl w-100">
													<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesTiempo" id="TblOperacionesTiempoMaquinaria" data-tipo="OT" cellspacing="0" style="width: 100%;">
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
														<tody></tbody>
														</table>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>

								<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
									<h5 class="mb-0">
										<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#opeConsuMaqui" aria-expanded="true" aria-controls="opeConsuMaqui">
											Operaciones de consumo
										</button>
									</h5>
								</div>

								<div id="opeConsuMaqui" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion2">
									<div class="card-body">
										<form id="frmIngreso" autocomplete="off">
											<div class="row">
												<div class="col-2 mb-2">
													<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearOperacionConsumo" id="CrearOperacionConsumoMaquinaria">Agregar</button>
												</div>
												<div class="col-12">
													<div id="divTbl w-100">
														<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesConsumo" id="TblOperacionesConsumoMaquinaria" data-tipo="OC" cellspacing="0" style="width: 100%;">
															<thead>
																<tr>
																	<th>Acciónes</th>
																	<th>Operación</th>
																	<th>Valor Frecuencia</th>
																	<th>Unidad de medida</th>
																	<th title="Valor última operación">Valor última op.</th>
																	<th>Valor notificación</th>
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
								</div>

								<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
									<h5 class="mb-0">
										<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#anexosMaqui" aria-expanded="true" aria-controls="anexosMaqui">
											Anexos
										</button>
									</h5>
								</div>

								<div id="anexosMaqui" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion2">
									<div class="card-body">
										<form id="frmIngreso" autocomplete="off">
											<div class="row">
												<div class="col-2 mb-2">
													<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar" id="CrearAnexosMaquinaria" >Agregar</button>

												</div>
												<div class="col-12">
													<div id="divTbl w-100">
														<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblAnexos" id="TblAnexosMaquinaria" data-tipo="AV" cellspacing="0" style="width: 100%;">
															<thead>
																<tr>
																	<th>Acciónes</th>	
																	<th>Anexo</th>
																	<th>Nombre</th>
																	<th>Documento</th>
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
								</div>

							</div>

						</div>
					</div>

					<div class="btn-group col-12 mt-2 p-0" role="group">
						<button type="button" class="btn btn-danger col-2 ml-auto" id="btnCancelar" data-tipo="maquinaria">&nbsp;Cancelar&nbsp;</button>
						<button type="submit" class="btn btn-success col-2 " form="frmIngreso" id="btnGuardar" data-tipo="maquinaria">&nbsp;Guardar&nbsp;</button>
					</div>
				</div>


				<!-- Tab contenido de equipo computo -->
				<div class="tab-pane container-fluid" role="tabpanel" id="tabEqui">
					<div class="TEquipo box">
						<div class="col-2 p-0 mb-3">
							<button class="btn btn-sm btn-primary btn-block" id="crearEquipoComputo">Registrar equipo</button>
						</div>
						<div id="divTbl w-100">
							<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDComputo" width="100%"  cellspacing="0">
								<thead>
									<tr>
										<th>Acciones</th>
										<th>EquipoComputoId</th>
										<th>ItemEquipoId</th>
										<th>Nombre Equipo</th>
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
						<div id="accordion3"> 
							<div class="card mb-0">

								<form id="frmVehiclulo">
									<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
										<h5 class="mb-0">
											<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#datosEquipo" aria-expanded="true" aria-controls="datosEquipo">
												Datos de equipo
											</button>
										</h5>
									</div>

									<div id="datosEquipo" class="collapse show collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion3">
										<div class="card-body">
											<div class="row">

												<div class="chos-unit col-md-4 col-xl-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Equipo</label>
													<select data-tabla="EquipoComputo" id="ItemEquipoId" class="ItemEquipoId chosen-select chosen" data-rastreo="ItemEquipoId"  unico tabindex="1" required>
														<option value="" selected disabled>Seleccione equipo...</option>
														<option value="">&nbsp;</option>										
														<?php  
															foreach ($EquipoC as $value) {
																echo '<option value="'.$value->ItemEquipoId.'">'.$value->nombre.'</option>';
															}
														?>
													</select>
												</div>

												<div class="col-md-4 col-xl-3 pl-3 py-0"">
													<label class="col-form-label col-form-label-md pl-0 py-0">Serial</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="Serial" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>

												<div class="col-md-4 col-xl-3 pl-3 py-0"">
													<label class="col-form-label col-form-label-md pl-0 py-0">Marca</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="Marca" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>


												<div class="col-md-4 col-xl-3 pl-3 py-0"">
													<label class="col-form-label col-form-label-md pl-0 py-0">Familia</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="Familia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>

												<div class="col-md-4 col-xl-3 pl-3 py-0>
													<label class="col-form-label col-form-label-md pl-0 py-0">Modelo</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="Modelo" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>

												<div class="col-md-4 col-xl-3 pl-3 py-0>
													<label class="col-form-label col-form-label-md pl-0 py-0">Color</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="Color" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>


												<div class="col-md-4 col-xl-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md pl-0 py-0">Código Interno</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="CodigoInterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>


												<div class="col-md-4 col-xl-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md pl-0 py-0">Código Externo</label>
													<input type="text" class="form-control form-control-sm" data-dbItem="CodigoExterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
												</div>

												<div class="col-md-4 col-xl-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md pl-0 py-0">Fin Garantia:</label>
													<div class="input-group date cha1 datepicker">
														<input type="text" class="form-control form-control-sm Fecha" data-dbItem="FinGarantia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled maxlength="15">
														<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
															<span class="input-group-text fas fa-calendar-alt d-flex"></span>
														</a>
													</div>
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

									<div id="datosBasicos" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion3">
										<div class="card-body">
											<div class="row">

												<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md pl-0 py-0">Fecha Registro:</label>
													<div class="input-group date cha1 datepicker">
														<input type="text" class="form-control form-control-sm Fecha" data-db="FechaRegistro"  data-nombre="FechaRegistro" maxlength="15">
														<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
															<span class="input-group-text fas fa-calendar-alt d-flex"></span>
														</a>
													</div>
												</div>

												<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md pl-0 py-0">T Computo</label>
													<select class="form-control form-control-sm" data-db="TipoComputo" maxlength="2" data-nombre="TipoComputo">
														<option value="" selected></option>
														<option value="ES">ESCRITORIO</option>
														<option value="PO">PORTATIL</option>
														<option value="SE">SERVIDOR</option>
													</select>
												</div>

												<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
													<label class="col-form-label col-form-label-md pl-0 py-0">Condiciones</label>
													<input type="text" class="form-control form-control-sm" data-db="Condiciones" maxlength="200" data-nombre="Condiciones">
												</div>


												<div class="col-12 d-none">
													<label class="labelForm" for="nombre">Observación</label>
													<input type="text" class="form-control form-control-sm" required maxlength="450">
												</div>

												<div class="col-12 hide">
													<label class="labelForm" for="nombre">Observación</label>
													<textarea type="text" class="form-control form-control-sm" data-db="Observacion" maxlength="450" data-nombre="Observacion" ></textarea>
												</div>

											</div>
										</div>
									</div>
								</form>

								<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
									<h5 class="mb-0">
										<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#opeTiempoVehi" aria-expanded="true" aria-controls="opeTiempoVehi">
											Operaciones de tiempo
										</button>
									</h5>
								</div>

								<div id="opeTiempoVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion3">
									<div class="card-body">
										<form id="frmIngreso" autocomplete="off">
											<div class="row">
												<div class="col-2 mb-2">
													<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearOperacionTiempo" id="CrearOperacionTiempo">Agregar</button>
												</div>
												<div class="col-12">
													<div id="divTbl w-100">
														<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesTiempo" id="TblOperacionesTiempoComputo" data-tipo="OT" cellspacing="0" style="width: 100%;">
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
															<tody></tbody>
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

									<div id="opeConsuVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion3">
										<div class="card-body">
											<form id="frmIngreso" autocomplete="off">
												<div class="row">
													<div class="col-2 mb-2">
														<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearOperacionConsumoComputo" id="CrearOperacionConsumoComputo">Agregar</button>
													</div>
													<div class="col-12">
														<div id="divTbl w-100">
															<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesConsumo" id="TblOperacionesConsumoComputo" data-tipo="OC" cellspacing="0" style="width: 100%;">
																<thead>
																	<tr>
																		<th>Acciónes</th>
																		<th>Operación</th>
																		<th>Valor Frecuencia</th>
																		<th>Unidad de medida</th>
																		<th title="Valor última operación">Valor última op.</th>
																		<th>Valor notificación</th>
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
									</div>

									<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
										<h5 class="mb-0">
											<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#anexosVehi" aria-expanded="true" aria-controls="anexosVehi">
												Anexos
											</button>
										</h5>
									</div>

									<div id="anexosVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion3">
										<div class="card-body">
											<form id="frmIngreso" autocomplete="off">
												<div class="row">
													<div class="col-2 mb-2">
														<button class="btn btn-sm btn-primary btn-block registrarActa btnAnexo btnAgregar" id="CrearAnexosComputo" >Agregar</button>

													</div>
													<div class="col-12">
														<div id="divTbl w-100">
															<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblAnexos" id="TblAnexosComputo" data-tipo="AV" cellspacing="0" style="width: 100%;">
																<thead>
																	<tr>
																		<th>Acciónes</th>	
																		<th>Anexo</th>
																		<th>Nombre</th>
																		<th>Documento</th>
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
									</div>

								</div>

							</div> 
						</div>
						<div class="btn-group col-12 mt-2 p-0" role="group">
							<button type="button" class="btn btn-danger col-2 ml-auto" id="btnCancelar" data-tipo="computo">&nbsp;Cancelar&nbsp;</button>
							<button type="submit" class="btn btn-success col-2 " form="frmIngreso" id="btnGuardar" data-tipo="computo">&nbsp;Guardar&nbsp;</button>
						</div>
					</div>

					<!-- Tab contenido de locativa -->
					<div class="tab-pane container-fluid" role="tabpanel" id="tabLoca">
						<div class="TLocativa box">
							<div class="col-2 p-0 mb-3">
								<button class="btn btn-sm btn-primary btn-block" id="crearLocativa">Registrar locativa</button>
							</div>
							<div id="divTbl w-100">
								<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUDLocativa" width="100%"  cellspacing="0">
									<thead>
										<tr>
											<th>Acciones</th>
											<th>LocativaId</th>
											<th>ItemEquipoId</th>
											<th>Nombre Equipo</th>
											<th>FechaRegistro</th>
											<th>TipoComputo</th>
											<th>Serial</th>	
											<th>Color</th>			
											<th>Observacion</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="DataLoca box d-none ">
							<div id="accordion4"> 
								<div class="card mb-0">
									
									<form id="frmVehiclulo">
										<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
											<h5 class="mb-0">
												<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#datosEquipo" aria-expanded="true" aria-controls="datosEquipo">
													Datos de equipo
												</button>
											</h5>
										</div>

										<div id="datosEquipo" class="collapse show collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion4">
											<div class="card-body">
												<div class="row">

													<div class="col-md-4 col-xl-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md text-md-right pl-0 py-0">Equipo</label>
														<select data-tabla="Locativa" id="ItemEquipoId" class="ItemEquipoId chosen-select chosen" data-rastreo="ItemEquipoId"  unico tabindex="1" required>
															<option value="" selected disabled>Seleccione equipo...</option>
															<option value="">&nbsp;</option>										
															<?php  
																foreach ($Locativa as $value) {
																	echo '<option value="'.$value->ItemEquipoId.'">'.$value->nombre.'</option>';
																}
															?>
														</select>
													</div>

													<div class="col-md-4 col-xl-3 pl-3 py-0"">
														<label class="col-form-label col-form-label-md pl-0 py-0">Serial</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="Serial" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>

													<div class="col-md-4 col-xl-3 pl-3 py-0"">
														<label class="col-form-label col-form-label-md pl-0 py-0">Marca</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="Marca" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>


													<div class="col-md-4 col-xl-3 pl-3 py-0"">
														<label class="col-form-label col-form-label-md pl-0 py-0">Familia</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="Familia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>

													<div class="col-md-4 col-xl-3 pl-3 py-0>
														<label class="col-form-label col-form-label-md pl-0 py-0">Modelo</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="Modelo" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>

													<div class="col-md-4 col-xl-3 pl-3 py-0>
														<label class="col-form-label col-form-label-md pl-0 py-0">Color</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="Color" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>


													<div class="col-md-4 col-xl-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Código Interno</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="CodigoInterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>


													<div class="col-md-4 col-xl-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Código Externo</label>
														<input type="text" class="form-control form-control-sm" data-dbItem="CodigoExterno" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled>
													</div>

													

													<div class="col-md-4 col-xl-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Fin Garantia:</label>
														<div class="input-group date cha1 datepicker">
															<input type="text" class="form-control form-control-sm Fecha" data-dbItem="FinGarantia" data-db="digitverif" maxlength="1" data-nombre="Dígito de Verificación" disabled maxlength="15">
															<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
																<span class="input-group-text fas fa-calendar-alt d-flex"></span>
															</a>
														</div>
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

										<div id="datosBasicos" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion4">
											<div class="card-body">
												<div class="row">

													<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Estructura</label>
														<input type="text" class="form-control form-control-sm" data-db="Estructura" maxlength="200" data-nombre="Estructura">
													</div>

													<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Area</label>
														<input type="text" class="form-control form-control-sm" data-db="Area" maxlength="100" data-nombre="Area">
													</div>

													<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Accesorios</label>
														<input type="text" class="form-control form-control-sm" data-db="Accesorios" maxlength="250" data-nombre="Accesorios">
													</div>


													<!-- <div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Fecha Registro</label>
														<input type="date" class="form-control form-control-sm" data-db="FechaRegistro" maxlength="1" data-nombre="FechaRegistro">
													</div> -->

													<div class="col-12 col-md-6 col-lg-3 pl-3 py-0">
														<label class="col-form-label col-form-label-md pl-0 py-0">Fecha Registro:</label>
														<div class="input-group date cha1 datepicker">
															<input type="text" class="form-control form-control-sm Fecha" data-db="FechaRegistro"  data-nombre="FechaRegistro" maxlength="15">
															<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
																<span class="input-group-text fas fa-calendar-alt d-flex"></span>
															</a>
														</div>
													</div>



													<div class="col-12 d-none">
														<label class="labelForm" for="nombre">Observación</label>
														<input type="text" class="form-control form-control-sm" required maxlength="450">
													</div>

													<div class="col-12 hide">
														<label class="labelForm" for="nombre">Observación</label>
														<textarea type="text" class="form-control form-control-sm" data-db="Observacion" maxlength="450" data-nombre="Observacion" ></textarea>
													</div>

												</div>
											</div>
										</div>
									</form>

									<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
										<h5 class="mb-0">
											<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#opeTiempoVehi" aria-expanded="true" aria-controls="opeTiempoVehi">
												Operaciones de tiempo
											</button>
										</h5>
									</div>

									<div id="opeTiempoVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion4">
										<div class="card-body">
											<form id="frmIngreso" autocomplete="off">
												<div class="row">
													<div class="col-2 mb-2">
														<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearOperacionTiempo" id="CrearOperacionTiempo">Agregar</button>
													</div>
													<div class="col-12">
														<div id="divTbl w-100">
															<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesTiempo" id="TblOperacionesTiempoLocativa" data-tipo="OT" cellspacing="0" style="width: 100%;">
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
																<tody></tbody>
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

										<div id="opeConsuVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion4">
											<div class="card-body">
												<form id="frmIngreso" autocomplete="off">
													<div class="row">
														<div class="col-2 mb-2">
															<button class="btn btn-sm btn-primary btn-block registrarActa btnAgregar CrearOperacionConsumoLocativa" id="CrearOperacionConsumoLocativa">Agregar</button>
														</div>
														<div class="col-12">
															<div id="divTbl w-100">
																<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblOperacionesConsumo" id="TblOperacionesConsumoLocativa" data-tipo="OC" cellspacing="0" style="width: 100%;">
																	<thead>
																		<tr>
																			<th>Acciónes</th>
																			<th>Operación</th>
																			<th>Valor Frecuencia</th>
																			<th>Unidad de medida</th>
																			<th title="Valor última operación">Valor última op.</th>
																			<th>Valor notificación</th>
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
										</div>

										<div class="card-header headerCollapse pt-0 pb-0 pl-1 pr-1" id="registroInvitacion">
											<h5 class="mb-0">
												<button class="btn btn-link col-12 btnCollapse pt-2 pb-2" data-toggle="collapse" data-target="#anexosVehi" aria-expanded="true" aria-controls="anexosVehi">
													Anexos
												</button>
											</h5>
										</div>

										<div id="anexosVehi" class="collapse collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion4">
											<div class="card-body">
												<form id="frmIngreso" autocomplete="off">
													<div class="row">
														<div class="col-2 mb-2">
															<button class="btn btn-sm btn-primary btn-block registrarActa btnAnexo btnAgregar" id="CrearAnexosLocativa" >Agregar</button>

														</div>
														<div class="col-12">
															<div id="divTbl w-100">
																<table class="table table-bordered table-sm table-hover table-fixed table-striped display TblAnexos" id="TblAnexoslocativa" data-tipo="AV" cellspacing="0" style="width: 100%;">
																	<thead>
																		<tr>
																			<th>Acciónes</th>	
																			<th>Anexo</th>
																			<th>Nombre</th>
																			<th>Documento</th>
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
										</div>

									</div>

								</div>
							</div>
							<div class="btn-group col-12 mt-2 p-0" role="group">
								<button type="button" class="btn btn-danger col-2 ml-auto" id="btnCancelar" data-tipo="locativa">&nbsp;Cancelar&nbsp;</button>
								<button type="submit" class="btn btn-success col-2 " form="frmIngreso" id="btnGuardar" data-tipo="locativa">&nbsp;Guardar&nbsp;</button>
							</div>
						</div>

					</div>
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
						<div class="col-10 mb-2">
							<input type="" name="" class="form-control" readonly value="Jose David Sanz Martinez">
						</div>
						<div class="col-2" title="seleccionar tercero">
							<button type="button" class="btn btn-primary f-r" id="btnCA"><i class="fas fa-check-circle"></i></button>
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
	$TITULO = '<?= $titulo ?>';
	$STIEMPO = `
		<select class="form-control undMedidaTiempo tiempoOP w-100">
			<option value="001">Dias</option>
			<option value="002">Semanas</option>
			<option value="003">Meses</option>
			<option value="004">Años</option>
		</select>
	`;
	$DATE = '<input class="form-control date w-100">';
</script>


