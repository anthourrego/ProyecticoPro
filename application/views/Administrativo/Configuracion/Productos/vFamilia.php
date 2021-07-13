<div data-auto class="d-none">
	<label class="mb-0" for="FamiliaId"><span class="text-danger">*</span>Código</label>
	<input type="text" class="form-control form-control-sm data-int" data-db="FamiliaId" data-required data-codigo data-identity-insert>
</div>
<label class="mb-0" for="Nombre"><span class="text-danger">*</span>Nombre</label>
<input type="text" class="form-control form-control-sm" data-db="Nombre" maxlength="60" data-required> 
<label class="mb-0" for="Estado">Estado</label>
<select class="custom-select custom-select-sm" data-db="Estado">
	<option value="A">Activo</option>
	<option value="I">Inactivo</option>
</select>