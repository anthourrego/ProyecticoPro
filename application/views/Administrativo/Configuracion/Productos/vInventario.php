<style type="text/css">
	.txtLabel{
		float: left;
	}
	.chosen-results{
		text-align: left;
	}
	.f-right{
		float: right;
	}
	.f-left{
		float: left;
	}
	.date{
		text-align: center;
	}
</style>
<div class="form-row">
	<div class="col-12 col-md-3 col-xl-2 mb-3">
		<button class="btn btn-primary btn-sm btn-block" id="btnFiltros"><i class="fas fa-plus mr-1"></i>Registrar</button>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-sm table-hover table-fixed table-striped display w-100" id="tblCRUD">
		<thead>
			<tr>
				<th>Acción</th>
				<th>ItemEquipoId</th>
				<th>Equipo</th>			
				<th>Serial</th>				
				<th>FinGarantia</th>		
				<th>CodigoInterno</th>		
				<th>CodigoExterno</th>		
				<th>Proveedor</th>			
				<th>Costo</th>				
				<th>ValorCop</th>			
				<th>ValorUsd</th>			
				<th>PaisOrigen</th>			
				<th>FechaCompra</th>		
				<th>Color</th>				
				<th>TipoOrigen</th>			
				<th>Descripcion</th>		
				<th>FechaAprobacion</th>	
				<th>Estado</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>


<div id="mModal" class="modal fade text-center" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Inventario de equipos</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="frmInventario" autocomplete="off">
					<div class="row">
						<div class="col-12 col-md-6 col-xl-5">
							<label class="mb-0 txtLabel"><span class="text-danger">*</span>Equipo:</label>
							<select id="EquipoId" class="chosen-select chosen form-control form-control-sm" data-rastreo="EquipoId" data-db="EquipoId" required>
								<option value=""></option>
								<?php 
								if(count($selectEquipo)){
									foreach ($selectEquipo as $key) {
										?>
										<option value="<?= $key->EquipoId ?>"><?= $key->Nombre ?></option>
										<?php 
									}
								}
								?> 
							</select>
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel"><span class="text-danger">*</span>Serial:</label>
							<input placeholder="Serial" id="Serial" class="form-control form-control-sm toUpper" data-db="Serial" data-nombre="Serial" type="text" required>
						</div>
						<div class="col-12 col-md-6 col-xl-3">
							<label class="mb-0 txtLabel">Fecha fin garantia:</label>
							<input placeholder="Garantia" class="form-control form-control-sm date" id="pedido" data-db="Fingarantia" data-nombre="Fingarantia">
						</div>
						<div class="col-12 col-md-6 col-xl-4" title="Código interno">
							<label class="mb-0 txtLabel">Cod. Interno:</label>
							<input placeholder="Código Interno" class="form-control form-control-sm toUpper" id="pedido" data-db="CodigoInterno" data-nombre="CodigoInterno" type="text">
						</div>
						<div class="col-12 col-md-6 col-xl-4" title="Código externo">
							<label class="mb-0 txtLabel">Cod. Externo:</label>
							<input placeholder="Código Externo" class="form-control form-control-sm toUpper" id="pedido" data-db="CodigoExterno" data-nombre="CodigoExterno" type="text">
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Proveedor:</label>
							<div class="chos-unit">
								<select id="Proveedor" class="chosen-select chosen form-control form-control-sm" data-rastreo="Proveedor" data-db="Proveedor">
									<option value=""></option>
									<?php 
										if(count($selectProveedor)){
											foreach ($selectProveedor as $key) {
												?>
												<option value="<?= $key->TerceroID ?>"><?= $key->Nombre ?></option>
												<?php 
											}
										}
									?> 
								</select>
							</div>
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Costo:</label>
							<input placeholder="Costo" class="form-control form-control-sm numerico" id="costo" data-db="Costo" data-nombre="Costo">
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Valor $COP:</label>
							<input placeholder="Valor $COP" class="form-control form-control-sm numerico" id="pedido" type="text" data-db="ValorCop" data-nombre="ValorCop">
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Valor $USD:</label>
							<input placeholder="Valor $USD" class="form-control form-control-sm numerico" id="pedido" type="text" data-db="ValorUsd" data-nombre="ValorUsd">
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Pais origen:</label>
							<div class="chos-unit">
								<select id="PaisOrigen" class="chosen-select chosen form-control form-control-sm" data-rastreo="PaisOrigen" data-db="PaisOrigen" unico >
									<option value=""></option>
									<?php 
										if(count($selectPais)){
											foreach ($selectPais as $key) {
												?>
												<option value="<?= $key->paisid ?>"><?= $key->nombre ?></option>
												<?php 
											}
										}
									?> 
								</select>
							</div>
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Color:</label>
							<input placeholder="Color" class="form-control form-control-sm" id="color" type="text" data-db="Color" data-nombre="Color">
						</div>
						<div class="col-12 col-md-6 col-xl-4">
							<label class="mb-0 txtLabel">Tipo origen:</label>
							<div class="chos-unit">
								<select class="chosen-select chosen form-control form-control-sm" id="tipoOrigen" data-db="TipoOrigen" data-nombre="TipoOrigen">
									<option value=""></option>
									<option value="1">Nacional</option>
									<option value="0">Importado</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-6 col-xl-3">
							<label class="mb-0 txtLabel">Fecha aprobación:</label>
							<input placeholder="Fecha aprobación" class="form-control form-control-sm date" id="fechaAprob" data-db="FechaAprobacion" data-nombre="FechaAprobacion">
						</div>
						<div class="col-12 col-md-6 col-xl-3">
							<label class="mb-0 txtLabel">Estado:</label>
							<div class="chos-unit">
								<select class="chosen-select chosen form-control form-control-sm" id="estadoInv" data-db="Estado">
									<option value=""></option>
									<option value="A">Activo</option>
									<option value="I">Inactivo</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<label class="mb-0 txtLabel">Descripción:</label>
							<textarea class="form-control" rows="1" placeholder="Descripción" id="descripcionInv" type="text" data-db="Descripcion" data-nombre="Descripcion"></textarea>
						</div>

						<div class="col-12">
							<hr class="w-100">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button style="width: 20%; float: right" id="btnGuardarTC" class="btn btn-success" type="submit" form="frmInventario"><i class="fas fa-save"></i> Guardar</button>
				<button style="width: 20%; float: right;margin-right: 8px;" id="btnCancelarTC" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
			</div>
		</div>
	</div>
</div>