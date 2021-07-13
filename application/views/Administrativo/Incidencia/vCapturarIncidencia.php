<form id="frmRegistrar" class="container-fluid">
	<div class="form-row"> 
		<input type="hidden" id="UsuarioId" name="UsuarioId" value="<?= $this->session->userdata('id'); ?>">
		<div class="col-12 col-md-4">
		    <label class="mb-0" for="TipoIncidenciaId"><span class="text-danger">*</span>Tipo Incidencia:</label>
			<select class="chosen-select custom-select custom-select-sm" name="TipoIncidenciaId" id="TipoIncidenciaId">
				<option value="0" disabled selected>Seleccione</option>
				<?php
					foreach ($listaTipoIncidencia as $TipoInc) {
						echo "<option value='".$TipoInc->TipoIncidenciaId."'>".$TipoInc->Nombre."</option>";
					}
				?> 
			</select>
		</div> 

		<div class="col-12 col-md-5">
		    <label class="mb-0" for="ItemEquipoId"><span class="text-danger">*</span>Equipo:</label>
			<select class="chosen-select custom-select custom-select-sm" name="ItemEquipoId" id="ItemEquipoId">
				<option value="0" disabled selected>Seleccione</option>
				<?php
					foreach ($listaEquipos as $Equipos) {
						echo "<option value='" . $Equipos->ItemEquipoId . "' data-serial='".$Equipos->Serial."'>" . $Equipos->ItemEquipoId . " | ". $Equipos->Nombre . " | " . $Equipos->Serial . "</option>";
					}
				?> 
			</select>
		</div> 

		<div class="col-12 col-md-3">
			<label class="mb-0">Serial:</label>
			<input type='text' id="Serial" disabled class='form-control form-control-sm'>
		</div>

		<div class="col-12 form-group row no-gutters my-1">
			<div class="col-sm-12">
				<label class="mb-0" for="Asunto"><span class="text-danger">*</span>Asunto:</label>
				<input name="Asunto" id="Asunto" class="form-control form-control-sm" type="text" autocomplete="off">
			</div>
		</div>
		<div class="col-12 form-group mb-1">
			<label class="mb-0" for="Descripcion"><span class="text-danger">*</span>Descripción:</label>  
			<textarea name="Descripcion" id="Descripcion" rows="5" class="form-control form-control-sm" type="text"></textarea>  
		</div>
		<div class="col-12 form-group">
			<label class="mb-0" for="form-image">Anexar archivos:</label>
			<div class='custom-file custom-file-sm'>
				<input type='file' class='custom-file-input custom-file-input-sm' name="archivos[]" id="form-image" multiple="true" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
				<label class='custom-file-label  custom-file-label-sm' for='archivos' data-browse='Elegir'>
					<span id="form-image-span" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
				</label>
			</div>
		</div>
		<div class="col-12 text-right">
			<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar</button>
		</div>
	</div>
</form>
