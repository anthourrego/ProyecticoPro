<form>
	<h4>Datos Generales</h4>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="nit">NIT</label>
		<div class="col-12 col-md-2">
			<input type="number" class="form-control form-control-sm" id="nit" maxlength="15" data-db>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="digitverif">D.V</label>
		<div class="col-12 col-md-2">
			<input type="text" class="form-control form-control-sm" maxlength="1" id="digitverif" data-db>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="regimen">Régimen</label>
		<div class="col-12 col-md-2">
			<select class="chosen-select form-control form-control-sm" id="regimen" data-db>
				<option value="C">C - Común</option>
				<option value="S">S - Simplificado</option>
			</select>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="nombre">Nombre</label>
		<div class="col-12 col-md-10">
			<input type="text" class="form-control form-control-sm" id="nombre" maxlength="60" data-db>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="direccion">Dirección</label>
		<div class="col-12 col-md-10">
			<input type="text" class="form-control form-control-sm" id="direccion" maxlength="100" data-db>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="CiudadId">Ciudad</label>
		<div class="col-12 col-md-4">
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm w-25" maxlength="5" id="CiudadId" data-foranea="ciudad" data-foranea-codigo="ciudadid">
				<div class="input-group-append w-75">
					<span class="input-group-text w-100 ellipsis"></span>
				</div>
			</div>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="DptoId">Dpto</label>
		<div class="col-12 col-md-4">
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm w-25" maxlength="15" id="DptoId" data-foranea="dpto" data-foranea-codigo="dptoid">
				<div class="input-group-append w-75">
					<span class="input-group-text w-100 ellipsis"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="PaisId">País</label>
		<div class="col-12 col-md-4">
			<div class="input-group input-group-sm">
				<input type="text" class="form-control form-control-sm w-25" id="PaisId" maxlength="15" data-foranea="pais" data-foranea-codigo="paisid">
				<div class="input-group-append w-75">
					<span class="input-group-text w-100 ellipsis"></span>
				</div>
			</div>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="telefonos">Teléfono</label>
		<div class="col-12 col-md-4">
			<input type="number" class="form-control form-control-sm" id="telefonos" maxlength="100" data-db>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="email">e-mail</label>
		<div class="col-12 col-md-10">
			<input type="email" class="form-control form-control-sm" id="email" maxlength="120" data-db>
		</div>
	</div>
	<!-- <div class="row">
		<label class="col-sm-2 col-form-label col-form-label-sm text-md-right" for="TipoOperacionId">Tipo de Operación</label>
		<div class="col-sm-10">
			<select class="form-control form-control-sm" id="TipoOperacionId" data-db>
				<option value="" disabled selected hidden>&nbsp;</option>
				<?php if(count($TipoOperacionDIAN) > 0) {
					foreach ($TipoOperacionDIAN as $key) {
						echo "<option value='".$key->TipoOperacionId."'>".$key->Nombre."</option>";
					}
				} ?>
			</select>
		</div>
	</div> -->
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="tipoPersonaDIAN">Tipo de Persona</label>
		<div class="col-12 col-md-4">
			<select class="chosen-select form-control form-control-sm" id="tipoPersonaDIAN" data-db>
				<option value="1">Persona Juridica</option>
				<option value="2">Persona Natural</option>
			</select>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="TipoRegiDIAN">Régimen según FE</label>
		<div class="col-12 col-md-4">
			<select class="chosen-select form-control form-control-sm" id="TipoRegiDIAN" data-db>
				<option value="04">Régimen Simple</option>
				<option value="05">Régimen Ordinario</option>
			</select>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="RespoFisca">Responsabilidades Fiscales</label>
		<div class="col-12 col-md-10">
			<select class="form-control form-control-sm" multiple id="RespoFisca" maxlength="200">
				<?php if(count($ResponsabilidadFiscal) > 0) {
					foreach ($ResponsabilidadFiscal as $key) {
						echo "<option value='".$key->RespoFiscaId."'>".$key->Nombre."</option>";
					}
				} ?>
			</select>
		</div>
	</div>
	<h4 class="mt-3">Datos Comerciales</h4>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="reprelegal">Representante Legal</label>
		<div class="col-12 col-md-10">
			<input type="text" class="form-control form-control-sm" id="reprelegal" maxlength="60" data-db>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="codigtribu">Código Tributario</label>
		<div class="col-12 col-md-4">
			<input type="text" class="form-control form-control-sm" id="codigtribu" maxlength="2" data-db>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="CodigoCIIU">Actividad (CIIU)</label>
		<div class="col-12 col-md-4">
			<input type="text" class="form-control form-control-sm" id="CodigoCIIU" maxlength="30" data-db>
		</div>
	</div>
	<h4 class="mt-3">Datos Configuración</h4>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="cierre">Mes del Cierre</label>
		<div class="col-12 col-md-4">
			<input type="number" class="form-control form-control-sm inputNumeric" id="cierre" maxlength="2" data-db>
		</div>
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="anocierre">Año del Cierre</label>
		<div class="col-12 col-md-4">
			<input type="number" class="form-control form-control-sm inputNumeric" id="anocierre" maxlength="4" data-db>
		</div>
	</div>
	<div class="row">
		<label class="col-12 col-md-2 col-form-label col-form-label-sm text-md-right" for="mensafactu">Mensaje Factura</label>
		<div class="col-12 col-md-10">
			<input type="text" class="form-control form-control-sm" id="mensafactu" maxlength="120" data-db>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-12 col-lg-6">
		<h4 class="mt-3">Logotipo Corporativo</h4>
		<form enctype="multipart/form-data" class="col-md-8 col-xl-6 mx-auto">
			<a href="#" style="display: inline-block;position: relative;width: 100%;">
				<div style="margin-top: 75%;"></div>
				<div class="fondo" style="border: 1px solid #cccccc;position: absolute;top: 0;bottom: 0;left: 0;right: 0;background-repeat: no-repeat;background-position: center center;background-size: contain;background-image: url(<?= base_url() ?>uploads/<?= $this->session->userdata('NIT') ?>/InformacionEmpresa/logo_cliente.png)">
					<input id="logo" data-tipo="logo" type="file" style="opacity: 0.0;width: 100%;height:100%;" accept="image/png" tabindex="-1" />
				</div>
			</a>
		</form>
	</div>
	<div class="col-12 col-lg-6">
		<h4 class="mt-3">Fondo</h4>
		<form enctype="multipart/form-data" class="col-md-8 col-xl-6 mx-auto">
			<a href="#" style="display: inline-block;position: relative;width: 100%;">
				<div style="margin-top: 75%;"></div>
				<div class="fondo" style="border: 1px solid #cccccc;position: absolute;top: 0;bottom: 0;left: 0;right: 0;background-repeat: no-repeat;background-position: center center;background-size: contain;background-image: url(<?= $Empresa[0]->Fondo == null ? '' : base_url() . $Empresa[0]->Fondo ?>)">
					<input id="fondo" data-tipo="fondo" type="file" style="opacity: 0.0;width: 100%;height:100%;" accept="image/png, image/jpg" tabindex="-1" />
				</div>
			</a>
		</form>
		<div class="text-center">
			<button class="btn btn-danger <?= $Empresa[0]->Fondo == null ? 'd-none' : '' ?>" id="eliminarFondo"><i class="fas fa-times"></i></button>
		</div>
	</div>
</div>

<script type="text/javascript">
	$Empresa = <?= json_encode($Empresa) ?>;
</script>