<style>
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
		transform: rotate(90deg) ;
		transition: all linear 0.25s;
		float: right;
	}

	[data-toggle="collapse"].collapsed:after {
		transform: rotate(0deg) ;
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

	.btn-collapse:focus, .btn-collapse.focus {
		outline: 0 !important;
		box-shadow: 0 0 0 0 !important;
	}
</style>

<div id="accordion"> 
	<div class="card mb-0">
		<button class="card-header headerCollapse py-2 d-flex justify-content-between btn btn-collapse btn-sm" id="registroInvitacion" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			<h5 class="mb-0 my-auto">
				<i class="fas fa-clipboard-list"></i> Registrar invitación
			</h5>
		</button>	

		<div id="collapseOne" class="collapse show collaGen" aria-labelledby="registroInvitacion" data-parent="#accordion">
			<div class="card-body">
				<form id="frmIngreso" autocomplete="off">
					<div class="row">
						<div class="col-12 p-0">
							<div class="col-12 col-md-4 col-lg-3">
								<label class="labelForm" for="cedula"><span class="text-danger">*</span>Cedula</label>
								<input type="text" class="form-control form-control-sm numerico" id="cedula" required autofocus maxlength="15">
							</div>
						</div>
						<div class="col-12 col-md-4 col-lg-3">
							<label class="labelForm" for="tipoVehi">Tipo vehiculo</label>
							<select class="form-control form-control-sm chosen-select" id="tipoVehi">
								<option value="">Seleccione</option>
								<?php if(count($TipoVehi) > 0) {
									foreach ($TipoVehi as $key) {
										echo "<option value='".$key->id."'>".$key->nombre."</option>";
									}
								} ?>
							</select>
						</div>
						<div class="col-12 col-md-4 col-lg-2">
							<label class="labelForm" for="placa">Placa</label>
							<input type="text" class="form-control form-control-sm toUpper" id="placa" autofocus maxlength="15">
						</div>
						<div class="col-12 col-md-4 col-lg-2">
							<label class="labelForm" for="fecha"><span class="text-danger">*</span>Fecha</label>
							<div class="input-group date datepicker">
								<input type="text" class="form-control form-control-sm dateFecha" name="fecha" id="fecha" maxlength="15" value="">
								<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
									<span class="input-group-text fas fa-calendar-alt d-flex"></span>
								</a>
							</div>
						</div>
						<div class="col-12 col-lg-5">
							<label class="labelForm" for="nombre"><span class="text-danger">*</span>Nombre</label>
							<input type="text" class="form-control form-control-sm" id="nombre" required maxlength="120">
						</div>
						<div class="col-12">
							<label class="labelForm" for="observacion">Observaciones</label>
							<textarea class="form-control form-control-sm" id="observacion" rows="1" maxlength="450"></textarea>
						</div>
						<div class="btn-group col-12 mt-2" role="group">
							<button type="button" class="btn btn-danger col-12 col-md-3 col-lg-2 ml-auto" id="btnCancelar"><i class="fas fa-times"></i> Cancelar</button>
							<button type="submit" class="btn btn-success col-12 col-md-3 col-lg-2" form="frmIngreso" id="btnGuardar"><i class="fas fa-save"></i> Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="card mb-0">
		<button class="card-header headerCollapse py-2 d-flex justify-content-between btn btn-collapse btn-sm collapsed" id="invitaciones" data-toggle="collapse" data-target="#invi" aria-expanded="false" aria-controls="invi">
			<h5 class="mb-0 my-auto">
				<i class="fas fa-address-book"></i> Invitaciones pendientes
			</h5>
		</button>	

		<div id="invi" class="collapse collaGen" aria-labelledby="invitaciones" data-parent="#accordion">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tblIngreso" class="table table-striped table-bordered table-condensed nowrap table-hover w-100">
						<thead>
							<tr>
								<th style="width: 8%">Acciones</th>
								<th style="width: 8%">Id</th>
								<th>Cedula</th>
								<th>Nombre visitante</th>
								<th>Tipo de vehículo</th>
								<th>Placa</th>
								<th>Fecha</th>
								<th>Observaciones</th>
								<th>Estado</th>
							</tr>
						</thead>	
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card mb-0">
		<button class="card-header headerCollapse py-2 d-flex justify-content-between btn btn-collapse btn-sm collapsed" id="historicoInvitacion" data-toggle="collapse" data-target="#hInvi" aria-expanded="false" aria-controls="hInvi">
			<h5 class="mb-0 my-auto">
				<i class="fas fa-history"></i> Historico de ingresos
			</h5>
		</button>
		<div id="hInvi" class="collapse collaGen" aria-labelledby="historicoInvitacion" data-parent="#accordion">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tblHistorico" class="table table-striped table-bordered table-condensed nowrap table-hover w-100">
						<thead>
							<tr>
								<th>Cedula</th>
								<th>Nombre visitante</th>
								<th title="Numero de acompañantes">Num. Acomp.</th>
								<th>Email</th>
								<th>Fecha</th>
								<th>Tipo</th>
								<th>Fecha/Hora - Entrada/Salida</th>
								<th>Observaciones</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$CC = '<?=$this->session->userdata('CEDULA')?>';
	$ID = '<?=$ViviendaId[0]->ViviendaId?>';
</script>