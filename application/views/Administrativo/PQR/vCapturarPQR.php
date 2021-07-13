<form id="frmRegistrarPQR" class="container-fluid">
	<div class="form-row">
		<input type="hidden" id="UsuarioId" name="UsuarioId" value="<?= $this->session->userdata('id'); ?>">
		<input type="hidden" name="PQRPedido" id="PQRPedido">

		<div class="col-12 col-md-3 tipo">
			<label class="mb-0"><span class="text-danger">*</span>Tipo PQR:</label>
			<select class="chosen-select custom-select custom-select-sm" name="TipoPQR" id="TipoPQR">
				<option value="0" data-validar="0" disabled selected>Seleccione</option>
				<?php
					foreach ($listaTipoPQR as $TipoPQR) {
						echo "<option value='".$TipoPQR->TipoPQRId."' data-validar='".$TipoPQR->ValidaPedido."'>".$TipoPQR->Nombre."</option>";
					}
				?>
			</select>
		</div>
		<!-- contenidoValidado -->
		<!-- Verificar -->
		<!-- <label class="col-12 col-sm-1 font-weight-bold my-auto verificar">Pedido:</label>
		<div class="col-12 col-sm-3 verificar">
			<input name="Pedido" id="Pedido" class="form-control input-sm" type="text" autocomplete="off">
		</div> -->

		<div class="col-12 col-md-3 verificar">
			<label class="mb-0 verificar">Factura: </label>
			<div class="input-group my-group">
				<select class="custom-select form-control custom-select-sm selector otro selectFact" name="selectFact" id="selectFact">
					<option value="" selected>N/A</option>
					<option value="DGFact">Digitar Factura</option>
				</select>
				<input type="text" class="form-control-sm form-control selector otro d-none" id="Factura" name="Factura" maxlength="100" autocomplete="off">
			</div>
		</div>

		<!-- Cliente -->
		<div class="col-12 col-md-6">
			<label class="mb-0"><span class="text-danger">*</span>Cliente:</label>
			<div class="form-row">
				<div class="col-1 text-center my-auto">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="checkCliente" checked>
						<label class="custom-control-label" for="checkCliente"></label>
					</div>
				</div>
				<div class="col-11 esCliente">
					<select class="chosen-select custom-select custom-select-sm" name="TerceroId" id="TerceroId">
						<option value="" disabled selected>Seleccione</option>
						<?php 
							foreach ($listaClientes as $cliente) {
								echo("<option value='" . $cliente->TerceroID . "'>" . $cliente->nombre . "</option>");
							}
						?>
					</select>
					<!-- <div class='input-group input-group-sm'>
						<input type='text' name="TerceroId" class='form-control form-control-sm w-25 TerceroId ClienteId' data-db='TerceroId' data-tabla='Tercero' maxlength='15' data-nombre='Tercero' data-terceroAnt='' onKeyPress="return soloNumeros(event)" data-foranea='Tercero' data-nuevo='1' data-foranea-codigo='TerceroId' data-tipo='' data-habitacion='' value='' id="TerceroId">
						<div class='input-group-append w-75'>
							<span class='input-group-text w-100 ellipsis ClienteNombre' id="ClienteNombre" name="ClienteNombre" data-db='TerceroIdNombre' data-terceronombreant='' title='Cliente'>Cliente</span>
						</div>
					</div> -->
				</div>
				<div class="col-11 noEsCliente cliente d-none">
					<input placeholder="Cliente" class="form-control form-control-sm OtroCliente" id="OtroCliente" name="OtroCliente" type="text">
				</div>
				<!-- <div class="col-12 col-md-2 esCliente mt-2 mt-md-0">
					<button class="btn btn-success btn-sm btn-block" id="btn_buscarCliente"><i class="fas fa-search"></i> Buscar Cliente</button>
				</div> -->
			</div>
		</div>

		<!-- <div class="col-12 mb-1 div_contenido">
			<div class="form-row contenido_div principal">
				<label class="col-12 col-sm-1 font-weight-bold my-auto verificar">Producto: </label>
				<div class="col-12 col-md-4 verificar">
					<div class="input-group my-group">
						<select class="custom-select custom-select-sm form-control selector otro Producto" name="Producto" id="Producto">
							<option value="0" selected disabled>Seleccione</option>
							<option value="otro">Otro</option>
						</select>
						<input type="text" class="form-control-sm form-control selector otro OtroProducto d-none" id="OtroProducto" name="OtroProducto" maxlength="100" autocomplete="off">
					</div>
				</div>

				<label for="Material" class="col-12 col-sm-1 font-weight-bold my-auto verificar verificarMaterial">Material: </label>
				<div class="col-sm-3 verificar verificarMaterial">
					<div class="input-group my-group">
						<select class="custom-select custom-select-sm form-control selector otro Material" name="Material" id="Material" disabled>
							<option value="0" selected disabled>Seleccione</option>
							<option value="otro" data-id="otro">Otro</option>
						</select>
						<input type="text" class="form-control-sm form-control d-none selector otro MaterialNombre" id="MaterialNombre" name="MaterialNombre" maxlength="100" autocomplete="off">
					</div>
				</div>

				<label for="Producidos" class="col-12 col-sm-1 font-weight-bold my-auto verificar">Cantidad: </label>
				<div class="col-sm-1 verificar">
					<input name="Producidos" id="Producidos" class="form-control form-control-sm Producidos text-right" type="text"  onKeyPress="return soloNumeros(event)" maxlength="5" autocomplete="off">
				</div>

				<div class="col-sm-1 verificar mt-2 mt-md-0">
					<button class="btn btn-info btn-block btn-sm" id="btn_agregar">
						<i class="fas fa-plus"></i>
					</button>
				</div>
			</div>
		</div> -->
		<!-- Fin Verificar -->
		<!-- No contenidoValidado -->
		<div class="col-12 form-group row no-gutters my-1">
			<label for="Asunto" class="mb-0"><span class="text-danger">*</span>Asunto:</label>
			<input name="Asunto" id="Asunto" class="form-control form-control-sm" type="text" autocomplete="off">
		</div>
		<div class="col-12 form-group mb-1">
			<label for="Descripcion" class="mb-0"><span class="text-danger">*</span>Descripción:</label>  
			<textarea name="Descripcion" id="Descripcion" rows="8" class="form-control form-control-sm" type="text"></textarea>  
		</div>
		<div class="col-12 form-group">
			<label class="mb-0">Anexar Archivos:</label>
			<div class='custom-file custom-file-sm'>
				<input type='file' class='custom-file-input custom-file-input-sm' name="archivos[]" id="form-image" multiple="true" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
				<label class='custom-file-label custom-file-label-sm' for='archivos' data-browse='Elegir'>
					<span id="form-image-span" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
				</label>
			</div>
		</div>
		<div class="col-12 text-right">
			<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar</button>
		</div>
	</div>
</form>

<script>
	var $permisoTramite = "<?= $permisoTramite ?>";
</script>