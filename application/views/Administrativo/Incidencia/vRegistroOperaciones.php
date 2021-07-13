<div class="form-row mb-2">
	<div class="col-12 col-md-4 my-1">
		<label class="mb-0" for="Ficha">Ficha:</label>
		<select class="chosen-select custom-select custom-select-sm Ficha" name="Ficha[]" id="Ficha">
				<option value="005" selected>Todos</option>
				<option value="001">Vehiculo</option>
				<option value="002">Maquinaria</option>
				<option value="003">Equipo Computo</option>
				<option value="004">Locativa</option>
		</select>
	</div>
	<div class="col-12 col-md-2 my-1 align-self-end">
		<button class="btn btn-primary btn-sm btn-block" id="btnCargar">
			<i class="fas fa-list-alt" id="fontbtn"></i> Cargar
		</button>
	</div>		
</div>

<hr>

<div class="table-responsive">
	<table class="table table-bordered table-sm table-hover table-fixed table-striped display W-100" id="TblListadoVencimiento">
		<thead>
			<tr>
				<th>Estado</th>
				<th>Placa</th>
				<th>Ficha</th>
				<th>Equipo</th>
				<th>Serial</th>
				<th>Operaciòn</th>
				<th>Familia</th>
				<th>Frecuencia</th>
				<th>T.Opereciòn</th>
				<th>Ultima Fecha</th>
				<th>Proxima</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>