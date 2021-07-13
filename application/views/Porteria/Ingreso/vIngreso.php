<style type="text/css">
	.iconoIni{
		margin: auto;
		/*font-size: 120px;*/
		color: black;
	}
	.telF{
		font-size: 35px;
		text-align: center;
	}
	.txtCA{
		font-size: 25px;
		text-align: center;
	}
	.txtAlert{
		font-size: 25px;
	}
	.card-ingreso{
		min-height: 162px; 
	}
	.foto-usuario{
		min-height: 195px; 
		background-repeat: no-repeat;
		background-position: center center;
		background-size: contain;
	}
	.dataResidente{
		overflow-y: auto;
		display: block;
		height: 450px;
	}
	.txtH2{
		text-align: center;
	}
	
	.chosen-results{
		text-align: justify !important;
	}
	
	.txtLabel{
		font-size: 16px;
		font-weight: bolder;
	}
	.hCenter{
		text-align: center;
	}
	.foto{
		border-right: 1px solid rgba(0,0,0,.125);
		height: 110px;
		background-repeat: no-repeat;
		background-position: center center;
		background-size: contain;
	}

	.fotoPlano{
		background-repeat: no-repeat !important;
		background-position: center center;
		background-size: contain;
		min-width: 890px !important;
		max-width: 890px !important;
		width: 890px !important;
	}
	.division{
		border-left: 1px solid #c1c1c1;
	}
	.btnData{
		border-color: #1d2124;
		padding: 15px;
		opacity: 0.4;
		margin-top: 5px;
	}
	.btnData2{
		border-color: transparent !important;
		background-color: transparent !important;
		padding: 15px;
		margin-top: 5px;
	}
	.btnData2:hover{
		border-color: transparent !important;
		background-color: transparent !important;
	}
	.btnClick{
		background-color: red;
		opacity: 0.8;
		margin-top: 5px;
	}
	.rowBTN{
		overflow: auto;
	}
	.localiza{
		font-size: 40px;
		color: red;
	}
	.divLocaliza{
		min-height: 440px;
		min-width: 890px !important;
		max-width: 890px !important;
		width: 890px !important;
	}
	.rowZonas{
		height: 550px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	.chos-unit .chosen-container-single a{
		height: calc(1.5em + .5rem + 8px) !important;
	}
	.chos-unit .chosen-container-single a span{
		margin-top: 3px;
	}
</style>
<div class="row">
	<div class="col-12 col-sm-12 col-md-5 col-xl-5">
		<div class="btn-group col-12 pr-xl-0" role="group">
			<button type="button" class="btn btn-primary" id="btnCA"><i class="fas fa-home"></i> N° Casa / Apto</button>
			<button type="button" class="btn btn-info" id="btnNom"><i class="fas fa-id-badge mr-1"></i>Nombre residente</button>
			<button type="button" class="btn btn-warning" id="btnPlaca"><i class="fas fa-car"></i>&nbsp;Placa&nbsp;</button>
			<button type="button" class="btn btn-secondary" id="btnMapa"><i class="fas fa-map-marker-alt"></i>&nbsp;Mapa&nbsp;</button>
		</div>
		<div class="col-12 mt-2 pr-xl-0 divCA d-none" title="Ej : Casa(CS-5) - Apto(1002 / 1-102 / L-906)">
			<select class="form-control chos-unit chosen" required autofocus id="chVivienda" data-tipo="Vivienda" style="border-radius: 0;" autocomplete="off">
				<option selected value="" disabled>Selecione vivienda:</option>
				<option value="">&nbsp;</option>
				<?php if(count($Vivienda) > 0) {
					foreach ($Vivienda as $key) {
						echo "<option value='".$key->id."' data-cod='".$key->nombre."' data-citofono='".$key->Citofono."'>".$key->nombre."</option>";
					}
				} ?>
			</select>
		</div>	
		<!-- <div class="chos-unit mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divNom d-none">
			<select class="form-control input-sm chos-unit chosen" required autofocus id="chResidente" data-tipo="Residente" style="border-radius: 0;" autocomplete="off">
				<option selected value="" disabled>Selecione nombre de residente:</option>
				<option value="">&nbsp;</option>
				<?php if(count($Residentes) > 0) {
					foreach ($Residentes as $key) {
						echo "<option value='".$key->id."' data-cod='".$key->cod."' data-tercero='".$key->id."' data-vivienda='".$key->viviendaId."' data-citofono='".$key->Citofono."'>".$key->nombre."</option>";
					}
				} ?>
			</select>
		</div> -->
		<div class="mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divNom d-none">
			<select class="custom-select custom-select-sm chos-unit chosen" required autofocus id="chResidente" data-tipo="Residente" style="border-radius: 0;" autocomplete="off">
				<option selected value="" disabled>Selecione nombre de residente:</option>
				<option value="">&nbsp;</option>
				<?php if(count($Residentes) > 0) {
					foreach ($Residentes as $key) {
						echo "<option value='".$key->id."' data-cod='".$key->cod."' data-tercero='".$key->id."' data-vivienda='".$key->viviendaId."' data-citofono='".$key->Citofono."'>".$key->nombre."</option>";
					}
				} ?>
			</select>
		</div>
		<div class="mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divPlaca d-none">
			<input type="text" class="form-control telF toUpperTrim" id="txtPlaca" placeholder="Ej: SFT289 " autocomplete="off">
		</div>
		<div class="btn-group col-12 mt-2 mb-2 pr-xl-0 divBtn" role="group">
			<button type="button" class="btn btn-danger col-6 d-none" id="btnLimpiar"><i class="fas fa-ban"></i>&nbsp;Limpiar&nbsp;</button>
			<button type="button" class="btn btn-primary col-6 d-none" id="btnResidente"><i class="fas fa-user-check"></i>&nbsp;Ingreso residente&nbsp;</button>
			<button type="button" class="btn btn-success col-6 d-none" id="btnIngreso"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo ingreso&nbsp;</button>
		</div>
		<div class="divIngresosProg d-none mt-2">
			<div class="col-12 pr-xl-0">
				<div class="alert alert-primary txtAlert" role="alert">
				<strong> Ingresos</strong> programados
				</div>
			</div>
			<div class="col-12 w-100 pr-xl-0 table-responsive">
				<table id="tblProgramado" class="table table-striped table-bordered table-condensed nowrap table-hover">
					<thead>
						<tr>
							<th style="width: 8%">Acción</th>
							<th style="width: 8%">Id</th>
							<th>Cedula</th>
							<th>Nombre visitante</th>
							<th>Placa</th>
							<th>Estado</th>
							<th>Observación</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-7 col-xl-7 dataResidente d-none">
		<div class="row rowData d-none">
			<div class="col-12 p-0 divDP">
			</div>
			<div class="col-12">
				<div class="alert alert-primary txtAlert" role="alert">
					<strong> Historico</strong> de ingresos
				</div>
			</div>
			<div class="col-12 table-responsive">
				<table id="tblHistorico" class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style="width: 8%">Acción</th>
							<th style="width: 8%">Id</th>
							<th>Cedula</th>
							<th>Nombre visitante</th>
							<th>Estado</th>
							<th>Observación</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row rowIngreso d-none">
			<div class="col-12 col-sm-12 col-md-12 col-xl-4">
				<div class="col-12 p-0">
					<img class='foto-usuario img-thumbnail h-100 w-100' data-cambio="0" src='' alt=''>
				</div>
				<div class='col-12 p-0'>
					<button class='btn btn-primary btn-sm btn-block' type='button' data-toggle='modal' data-target='#modalFoto' onClick=modalFoto($(this))><i class='fas fa-camera'></i> Tomar</button>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-xl-8">
				<form id="frmIngreso" autocomplete="off">
					<div class="form-row">
						<div class="col-12 col-sm-12 col-md-6 col-xl-6">
							<label class="mb-0 txtLabel"><span class="text-danger">*</span>Cedula: </label>
							<input type="text" id="ccV" class="form-control form-control-sm txtInput numerico valida" placeholder="Cedula...">
						</div>
						<div class="col-12">
							<label class="mb-0 txtLabel"><span class="text-danger">*</span>Nombre visitante: </label>
							<input type="text" id="nomV" class="form-control form-control-sm txtInput valida" placeholder="Nombre visitante...">
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-xl-6">
							<label class="mb-0 txtLabel">Vehículo</label>
							<select class="custom-select custom-select-sm chos-unit chosen" required autofocus id="chTipoVehi" data-tipo="Residente" style="border-radius: 0;" autocomplete="off">
								<option selected value="" disabled>Selecione tipo de vehículo:</option>
								<option value="">&nbsp;</option>
								<?php if(count($TipoVehi) > 0) {
									foreach ($TipoVehi as $key) {
										echo "<option value='".$key->id."'>".$key->nombre."</option>";
									}
								} ?>
							</select>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-xl-6">
							<label class="mb-0 txtLabel">Placa: </label>
							<input type="text" id="placaV" class="form-control form-control-sm txtInput toUpperTrim" placeholder="Placa...">
						</div>
						<div class="col-12 col-sm-12 col-md-5 col-xl-3" title="Numero de acompañantes">
							<label class="mb-0 txtLabel"><span class="text-danger">*</span>N° Acomp: </label>
							<input type="text" id="acomV" class="form-control form-control-sm txtInput numerico valida" placeholder="N° acomp...">
						</div>
						<div class="col-12 col-sm-12 col-md-12 col-xl-9">
							<label class="mb-0 txtLabel">E-mail: </label>
							<input type="text" id="mailV" class="form-control form-control-sm txtInput" placeholder="Email...">
						</div>
						<div class="col-12 divObserV">
							<label class="mb-0 txtLabel">Observaciones del residente: </label>
							<textarea id="obserV" class="form-control form-control-sm" disabled></textarea>
						</div>
						<div class="col-12">
							<label class="mb-0 txtLabel">Observaciones: </label>
							<textarea id="obserI" class="form-control"></textarea>
						</div>
						<div class="btn-group col-12 mt-2" role="group">
							<button type="button" class="btn btn-danger col-6" id="btnCancelar"><i class="fas fa-times"></i>&nbsp;Cancelar&nbsp;</button>
							<button type="button" class="btn btn-success col-6" id="btnGuardar"><i class="fas fa-save"></i>&nbsp;Guardar&nbsp;</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row mt-3 rowMapa d-none">
	<div class="col-12 col-md-8 col-xl-8">
		<div class="col-12 p-0 mt-3" style="overflow: auto;">
			<div class="fotoPlano">
				<div class="divLocaliza">

				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 col-xl-4 division">
		<div class="col-12">
			<div class="row">
				<div class="col-10 p-0">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Zonas: </label>
				</div>
				<div class="col-12 rowZonas p-0">
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Ingreso por placa</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="frmCRUD" autocomplete="off">

					<div class="row">
						<div class="col-12 mb-2">
							<input type="text" class="form-control telF toUpperTrim" id="txtCasa" readonly>
						</div>
						<div class="col-12 col-md-6 col-xl-6">
							<div class="row">
								<div class="col-12 col-md-12 col-xl-12">
									<label class="labelForm" for="tipoVehi">*Foto</label>
									<div style="margin-top: 75%;"></div>
									<div class="fotoIngreso" style="border: 1px solid #cccccc;position: absolute;top: 20px;bottom: 0;background-repeat: no-repeat;background-position: center center;background-size: contain;right: 15px;left: 15px">
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-xl-6">
							<div class="row">
								<div class="col-12">
									<label class="mb-0 txtLabel">*Cedula: </label>
									<input type="text" id="ccVP" class="form-control txtInput" readonly placeholder="Cedula...">
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<label class="mb-0 txtLabel">*Tipo de vehículo: </label>
									<input type="text" id="tipoVehiVP" class="form-control txtInput" readonly placeholder="Tipo de vehículo...">
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<label class="mb-0 txtLabel">*Placa: </label>
									<input type="text" id="placaVP" class="form-control txtInput" readonly placeholder="Placa...">
								</div>
							</div>
						</div>
						<div class="col-12">
							<label class="mb-0 txtLabel">*Nombre visitante: </label>
							<input type="text" id="nomVP" class="form-control txtInput" readonly placeholder="Nombre visitante...">
						</div>
						<div class="col-12 divObserV">
							<label class="mb-0 txtLabel">Observaciones del residente: </label>
							<textarea id="obserVP" class="form-control" disabled></textarea>
						</div>
						<div class="col-12 col-sm-12 col-md-5 col-xl-3" title="Numero de acompañantes">
							<label class="mb-0 txtLabel">*N° Acomp: </label>
							<input type="text" id="acomVP" required class="form-control txtInput numerico valida" placeholder="N° acomp..." autocomplete="off">
						</div>
						<div class="col-12 col-sm-12 col-md-12 col-xl-9">
							<label class="mb-0 txtLabel">E-mail: </label>
							<input type="text" id="mailVP" class="form-control txtInput" placeholder="Email...">
						</div>
						<div class="col-12">
							<label class="mb-0 txtLabel">Observaciones: </label>
							<textarea id="obserIP" class="form-control"></textarea>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="frmCRUD">Guardar</button>
				<button type="button" class="btn btn-outline-secondary" id="btnCerrar" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modalFoto" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-camera"></i> Tomar foto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Seleccione una dispositivo:</label>
					<select class="custom-select" name="listaDeDispositivos" id="listaDeDispositivos"></select>
				</div>
				<p id="estado"></p>
				<video class="w-100" muted="muted" id="video"></video>
				<canvas class="d-none" id="canvas"></canvas>	
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-primary" id="btnFoto"><i class="fas fa-camera"></i> Tomar foto</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mResidente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-chack"></i>Seleccionar tercero</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="frmCRUD" autocomplete="off">

					<div class="row">
						<div class="col-12">
							<div class="alert alert-primary txtAlert" role="alert">
								<strong> Terceros</strong> asociados a la vivienda
							</div>
						</div>
					</div>
					<div class="form-row rowDataTer">
						<div class="col-10 mb-2">
							<input type="" name="" class="form-control" readonly value="Jose David Sanz Martinez">
						</div>
						<div class="col-2" title="seleccionar tercero">
							<button type="button" class="btn btn-primary btn-block f-r" id="btnCA"><i class="fas fa-check-circle"></i></button>
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
