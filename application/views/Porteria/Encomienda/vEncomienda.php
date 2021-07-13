<style type="text/css">
	.chos-unit .chosen-container-single a{
		height: calc(1.5em + .5rem + 8px) !important;
	}
	.chos-unit .chosen-container-single a span{
		margin-top: 3px;
	}
	.telF{
		font-size: 25px;
		text-align: center;
	}
	.txtLabel{
		font-size: 16px;
		font-weight: bolder;
	}
	.txtAlert{
		font-size: 18px;
	}
	.f-r{
		float: right;
	}
	.division{
		border-left: 1px solid #c1c1c1;
	}
	.fotoPlano{
		background-repeat: no-repeat !important;
		background-position: center center;
		background-size: contain;
		min-width: 890px !important;
		max-width: 890px !important;
		width: 890px !important;
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
</style>
<div class="row">
	<div class="col-12 col-sm-12 col-md-5 col-xl-5">
		<div class="btn-group col-12 pr-xl-0" role="group">
			<button type="button" class="btn btn-primary" id="btnCA"><i class="fas fa-home"></i> N° Casa / Apto</button>
			<button type="button" class="btn btn-info" id="btnNom"><i class="fas fa-id-badge mr-1"></i>Nombre residente</button>
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
		<div class="mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divNom d-none">
			<select class="form-control input-sm chos-unit chosen" required autofocus id="chResidente" data-tipo="Residente" style="border-radius: 0;" autocomplete="off">
				<option selected value="" disabled>Selecione nombre de residente:</option>
				<option value="">&nbsp;</option>
				<?php if(count($Residentes) > 0) {
					foreach ($Residentes as $key) {
						echo "<option value='".$key->id."' data-cod='".$key->cod."' data-tercero='".$key->id."' data-vivienda='".$key->viviendaId."' data-citofono='".$key->Citofono."'>".$key->nombre."</option>";
					}
				} ?>
			</select>
		</div>
		<div class="divDatos d-none">
			<div class="mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divDataTer">
				<input type="text" class="form-control telF toUpperTrim" id="txtDataDir" readonly autocomplete="off">
			</div>
			<div class="mt-2 col-12 col-md-12 col-xl-12 pr-xl-0 divDataTer">
				<input type="text" class="form-control telF toUpperTrim" id="txtDataTer" readonly autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-7 col-xl-7 divEmpresa">
		<form id="frmRegistro" autocomplete="off">
			<div class="row pt-0 pr-3 pl-3">
				<div class="col-12">
					<div class="alert alert-primary txtAlert" role="alert">
					<strong><h4 class="m-0">Datos de encomienda</h4></strong>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-xl-4">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Documento: </label>
					<input type="" name="" id="cedula" class="form-control form-control-sm txtInput numerico" placeholder="Documento..." required>
				</div>
				<div class="col-12 col-sm-12 col-md-8 col-xl-8">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Nombre empresa / persona: </label>
					<input type="" name="" id="nombre" class="form-control form-control-sm txtInput" placeholder="Nombre empresa y/o persona..." required>
				</div>
				<div class="col-12">
					<label class="mb-0 txtLabel">Observaciones : </label>
					<textarea class="form-control form-control-sm" id="observacion"></textarea>
				</div>
				<div class="btn-group col-12 mt-2" role="group">
					<button type="submit" class="btn btn-success col-6 col-sm-6 col-xl-3 ml-xl-auto" form="frmRegistro" id="btnGuardar"><i class="fas fa-save"></i>&nbsp;Guardar&nbsp;</button>
					<button type="button" class="btn btn-danger col-6 col-sm-6 col-xl-3 " id="btnCancelar"><i class="fas fa-times"></i>&nbsp;Cancelar&nbsp;</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-12 col-sm-12 col-md-4 col-xl-4 mt-1 divHistorico">
		<div class="col-12">
			<div class="alert alert-primary txtAlert" role="alert">
				<strong><h4 class="m-0">Tareas</h4></strong>
			</div>
		</div>
	</div>
	<div class="col-12 divHistorico">
		<div class="col-12 table-responsive">
			<table id="tblTareas" class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 8%">Acción</th>
						<th style="width: 5%">Id</th>
						<th>Estado</th>
						<th>Usuario</th>
						<th>Casa / Apto</th>
						<th>Residente / Propietario</th>
						<th>Documento empresa / persona</th>
						<th>Empresa / Persona</th>
						<th>Onservaciones</th>
						<th>Fecha y hora</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
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

<div class="modal" id="modalDatos" tabindex="-1" role="dialog">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-chack"></i>Seleccionar tercero</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="alert alert-primary txtAlert" role="alert">
						<strong> Terceros</strong> asociados a la vivienda
						</div>
					</div>
					<div class="col-10 mb-2">
						<input type="" name="" class="form-control" readonly value="Jose David Sanz Martinez">
					</div>
					<div class="col-2" title="seleccionar tercero">
						<button type="button" class="btn btn-primary f-r" id="btnCA"><i class="fas fa-check-circle"></i></button>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary ml-auto" id="btnCierre" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="mIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Selección de tercero</h4>
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
					<div class="form-row rowData">
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