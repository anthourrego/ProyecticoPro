<?php
	/* if(!empty($_GET['procal'])){
		$procal = $_GET['procal'];
		$procal = explode(',', $procal);
	}
	if(!empty($_GET['operacion'])){
		$operacion = $_GET['operacion'];
		$operacion = explode(',', $operacion);
	} */
	if(!empty($_GET['causapqr'])){
		$causapqr = $_GET['causapqr'];
		$causapqr = explode(',', $causapqr);
	}
	/* if(!empty($_GET['responsable'])){
		$responsable = $_GET['responsable'];
		$responsable = explode(',', $responsable);
	}
	if(!empty($_GET['seccion'])){
		$seccion = $_GET['seccion'];
		$seccion = explode(',', $seccion);
	} */
	if(!empty($_GET['estado'])){
		$estado = $_GET['estado'];
		$estado = explode(',', $estado);
	}
	if(!empty($_GET['tipo'])){
		$tipo = $_GET['tipo'];
		$tipo = explode(',', $tipo);
	}
	if(!empty($_GET['ciudad'])){
		$ciudad = $_GET['ciudad'];
		$ciudad = explode(',', $ciudad);
	}
	/* if(!empty($_GET['asesor'])){
		$asesor = $_GET['asesor'];
		$asesor = explode(',', $asesor);
	}
	if(!empty($_GET['dependencia'])){
		$dependencia = $_GET['dependencia'];
		$dependencia = explode(',', $dependencia);
	} */
?>

<div class="form-row">
	<div class="col-12 col-md-2 mb-2">
		<button class="btn btn-primary btn-sm btn-block" id="btnFiltros" data-toggle="collapse" data-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros">
			<i class="fas fa-filter"></i> Filtros
		</button>
	</div>
	<div class="collapse col-12" id="collapseFiltros">
		<div class="card card-body mb-2">
			<div class="form-row">
				<div class="col-12 col-md-2 my-1">
					<label class="mb-0">Fecha inicio: </label>
					<div class="input-group date cha1 datepicker">
						<input type="text" class="form-control form-control-sm dateFecha" name="fecha1" id="fecha1" maxlength="15" value="<?= date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y'))) ?>">
						<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
							<span class="input-group-text fas fa-calendar-alt d-flex"></span>
						</a>
					</div>
				</div>
				<div class="col-12 col-md-2 my-1">
					<label class="mb-0">Fecha final: </label>
					<div class="input-group date cha2 datepicker">
						<input type="text" name="fecha2" id="fecha2" class="form-control form-control-sm dateFecha" maxlength="15" value="<?= date('Y-m-d') ?>">
						<a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
							<span class="input-group-text fas fa-calendar-alt d-flex"></span>
						</a>
					</div>
				</div>

				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Problema de Calidad:</label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm" multiple name="procal[]" id="procal">
						<?php
							$PROCAL = json_decode($selectProblemaCalidad);
							for($i = 0; $i<count($PROCAL); ++$i){
								if(!empty($_GET['procal'])){
									if(in_array($PROCAL[$i]->CausaPQRId, $procal)){
										echo("<option selected value='".$PROCAL[$i]->CausaPQRId."'>".$PROCAL[$i]->Nombre);
									}else{
										echo("<option value='".$PROCAL[$i]->CausaPQRId."'>".$PROCAL[$i]->Nombre);
									}
								}else{
									echo("<option value='".$PROCAL[$i]->CausaPQRId."'>".$PROCAL[$i]->Nombre);
								}
							}
						?>
					</select>
				</div> -->
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Operación:</label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm" multiple name="operacion[]" id="operacion">
						<?php
							$OPERACION = json_decode($selectOperacion);
							for($i = 0; $i<count($OPERACION); ++$i){
								if(!empty($_GET['operacion'])){
									if(in_array($OPERACION[$i]->CausaPQRId, $operacion)){
										echo("<option selected value='".$OPERACION[$i]->CausaPQRId."'>".$OPERACION[$i]->Nombre);
									}else{
										echo("<option value='".$OPERACION[$i]->CausaPQRId."'>".$OPERACION[$i]->Nombre);
									}
								}else{
									echo("<option value='".$OPERACION[$i]->CausaPQRId."'>".$OPERACION[$i]->Nombre);
								}
							}
						?>
					</select>
				</div> -->

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0">Causa PQR:</label>
					<select class="chosen-select custom-select custom-select-sm" multiple name="causapqr[]" id="causapqr">
						<?php
							$CAUSAPQR = json_decode($selectCausaPQR);
							for($i = 0; $i<count($CAUSAPQR); ++$i){
								if(!empty($_GET['causapqr'])){
									if(in_array($CAUSAPQR[$i]->CausaPQRId, $causapqr)){
										echo("<option selected value='".$CAUSAPQR[$i]->CausaPQRId."'>".$CAUSAPQR[$i]->Nombre);
									}else{
										echo("<option value='".$CAUSAPQR[$i]->CausaPQRId."'>".$CAUSAPQR[$i]->Nombre);
									}
								}else{
								echo("<option value='".$CAUSAPQR[$i]->CausaPQRId."'>".$CAUSAPQR[$i]->Nombre);
								}
							}
						?>
					</select>
				</div>

				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Responsable:</label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm" multiple name="responsable[]" id="responsable">
						<?php
							$RESPONSABLE = json_decode($selectResponsable);
							for($i = 0; $i<count($RESPONSABLE); ++$i){
								if(!empty($_GET['responsable'])){
									if(in_array($RESPONSABLE[$i]->CausaPQRId, $responsable)){
										echo("<option selected value='".$RESPONSABLE[$i]->CausaPQRId."'>".$RESPONSABLE[$i]->Nombre);
									}else{
										echo("<option value='".$RESPONSABLE[$i]->CausaPQRId."'>".$RESPONSABLE[$i]->Nombre);
									}
								}else{
									echo("<option value='".$RESPONSABLE[$i]->CausaPQRId."'>".$RESPONSABLE[$i]->Nombre);
								}
							}
						?>
					</select>
				</div> -->
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Sección:</label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm se" multiple name="seccion[]" id="seccion">
						<?php
							$SECCION = json_decode($selectSeccion);
							for($i = 0; $i<count($SECCION); ++$i){
								if(!empty($_GET['seccion'])){
									if(in_array($SECCION[$i]->CausaPQRId, $seccion)){
										echo("<option selected value='".$SECCION[$i]->CausaPQRId."'>".$SECCION[$i]->Nombre);
									}else{
										echo("<option value='".$SECCION[$i]->CausaPQRId."'>".$SECCION[$i]->Nombre);
									}
								}else{
									echo("<option value='".$SECCION[$i]->CausaPQRId."'>".$SECCION[$i]->Nombre);
								}
							}
						?>
					</select>
				</div> -->

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0">Estado:</label>
					<select class="chosen-select custom-select custom-select-sm se" multiple name="estado[]" id="estado" tabindex="8">
						<?php
							$ESTADO = json_decode($selectEstado);
							for($i = 0; $i<count($ESTADO); ++$i){
								if(!empty($_GET['estado'])){
									if(in_array($ESTADO[$i]->EstadoId, $estado)){
										echo("<option selected value='".$ESTADO[$i]->EstadoId."'>".$ESTADO[$i]->Nombre);
									}else{
										echo("<option value='".$ESTADO[$i]->EstadoId."'>".$ESTADO[$i]->Nombre);
									}
								}else{
									echo("<option value='".$ESTADO[$i]->EstadoId."'>".$ESTADO[$i]->Nombre);
								}
							}
						?>
					</select>
				</div>

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0">Tipo:</label>
					<select class="chosen-select custom-select custom-select-sm se" multiple name="tipo[]" id="tipo" tabindex="8">
						<?php
							$TIPO = json_decode($selectTipo);
							for($i = 0; $i<count($TIPO); ++$i){
								if(!empty($_GET['tipo'])){
									if(in_array($TIPO[$i]->TipoPQRId, $tipo)){
										echo("<option selected value='".$TIPO[$i]->TipoPQRId."'>".$TIPO[$i]->Nombre);
									}else{
										echo("<option value='".$TIPO[$i]->TipoPQRId."'>".$TIPO[$i]->Nombre);
									}
								}else{
									echo("<option value='".$TIPO[$i]->TipoPQRId."'>".$TIPO[$i]->Nombre);
								}
							}
						?>
					</select>
				</div>

				<div class="col-12 col-md-4 my-1">
					<label class="mb-0">Ciudad:</label>
					<select class="chosen-select custom-select custom-select-sm se" multiple name="ciudad[]" id="ciudad" tabindex="9">
						<?php
							$CIUDAD = json_decode($selectCiudad);
							for($i = 0; $i<count($CIUDAD); ++$i){
								if(!empty($_GET['ciudad'])){
									if(in_array($CIUDAD[$i]->ciudadid, $ciudad)){
										echo("<option selected value='".$CIUDAD[$i]->ciudadid."'>".$CIUDAD[$i]->nombre);
									}else{
										echo("<option value='".$CIUDAD[$i]->ciudadid."'>".$CIUDAD[$i]->nombre);
									}
								}else{
									echo("<option value='".$CIUDAD[$i]->ciudadid."'>".$CIUDAD[$i]->nombre);
								}
							}
						?>
					</select>
				</div>

				<!-- Cliente -->			
				<div class="col-12 col-md-4 my-1">
					<label class="mb-0">Cliente:</label>
					<select class="chosen-select custom-select custom-select-sm" name="TerceroId" id="TerceroId">
						<option value="" selected>Todos</option>
						<?php 
							foreach ($listaClientes as $cliente) {
								echo("<option value='" . $cliente->TerceroID . "'>" . $cliente->nombre . "</option>");
							}
						?>
					</select>
					<!-- <div class='input-group input-group-sm cCliente'>
						<input type='text' class='form-control form-control-sm w-25 TerceroId ClienteId' data-db='TerceroId' data-tabla='Tercero' maxlength='15' data-nombre='Tercero' data-terceroAnt='' onKeyPress="return soloNumeros(event)" data-foranea='Tercero' data-nuevo='1' data-foranea-codigo='TerceroId' data-tipo='' data-habitacion='' value='' id="TerceroId">
						<div class='input-group-append w-75'>
							<span class='input-group-text w-100 ellipsis ClienteNombre' id="ClienteNombre" name="ClienteNombre" data-db='TerceroIdNombre' data-terceronombreant='' title='Cliente'>Cliente</span>
						</div>
					</div> -->
				</div>

				<!-- Pedido -->			
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">N° de Pedido:</label>
				<div class="col-12 col-md-4 my-1">
					<input placeholder="N° de Pedido" class="form-control form-control-sm" id="pedido" type="text">
				</div> -->

				<!-- Asesor -->
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Asesor:</label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm" multiple name="asesor[]" id="asesor">
						<?php
							$ASESOR = json_decode($selectAsesor);
							for($i = 0; $i<count($ASESOR); ++$i){
								if(!empty($_GET['asesor'])){
									if(in_array($ASESOR[$i]->usuarioId, $asesor)){
										echo("<option selected value='".$ASESOR[$i]->usuarioId."'>".$ASESOR[$i]->Nombre);
									}else{
										echo("<option value='".$ASESOR[$i]->usuarioId."'>".$ASESOR[$i]->Nombre);
									}
								}else{
									echo("<option value='".$ASESOR[$i]->usuarioId."'>".$ASESOR[$i]->Nombre);
								}
							}
						?>
					</select>
				</div> -->

				<!-- Factura -->			
				<div class="col-12 col-md-2 my-1">
					<label class="mb-0">Factura:</label>
					<input placeholder="N° de factura" class="form-control form-control-sm" id="factura" type="text">
				</div>

				<!-- Productos -->			
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Producto:</label>
				<div class="col-12 col-md-4 my-1">
					<div class='input-group input-group-sm cCliente'>
						<input type='text' class='form-control form-control-sm w-25 ProductoId' data-db='ProductoId' data-tabla='HeadProd' maxlength='15' data-nombre='Tercero' onKeyPress="return soloNumeros(event)" data-foranea='HeadProd' data-foranea-codigo='headprodid' value='' id="ProductoId">
						<div class='input-group-append w-75'>
							<span class='input-group-text w-100 ellipsis ProductoNombre' id="ProductoNombre" name="ProductoNombre" data-db='ProductoNombre'  title='Producto'>Todos</span>
						</div>
					</div>
				</div> -->

				<!-- Materiales -->			
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Material:</label>
				<div class="col-12 col-md-4 my-1">
					<div class='input-group input-group-sm cCliente'>
						<input type='text' class='form-control form-control-sm w-25 MaterialId' data-db='MaterialId' data-tabla='Tercero' maxlength='15' data-nombre='Tercero' data-foranea='Tercero' data-foranea-codigo='MaterialId'  value='' id="MaterialId">
						<div class='input-group-append w-75'>
							<span class='input-group-text w-100 ellipsis ProductoNombre' id="MaterialNombre" name="MaterialNombre" data-db='MaterialNombre'  title='Producto'>Todos</span>
						</div>
					</div>
				</div> -->

				<!-- Dependencia -->
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Dependencia:</label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm se" multiple name="dependencia[]" id="dependencia">
						<?php
							$DEPENDENCIA = json_decode($selectDependencia);
							for($i = 0; $i<count($DEPENDENCIA); ++$i){
								if(!empty($_GET['dependencia'])){
									if(in_array($DEPENDENCIA[$i]->dependenciaId, $dependencia)){
										echo("<option selected value='".$DEPENDENCIA[$i]->dependenciaId."'>".$DEPENDENCIA[$i]->Nombre);
									}else{
										echo("<option value='".$DEPENDENCIA[$i]->dependenciaId."'>".$DEPENDENCIA[$i]->Nombre);
									}
								}else{
									echo("<option value='".$DEPENDENCIA[$i]->dependenciaId."'>".$DEPENDENCIA[$i]->Nombre);
								}
							}
						?>
					</select>
				</div> -->

				<!-- N° de PQR -->			
				<div class="col-12 col-md-2 my-1">
					<label class="mb-0">N° de PQR:</label>
					<input placeholder="N° de PQR" class="form-control form-control-sm" id="nPqr" type="text">
				</div>
				<div class="col-12 col-md-2 my-1 align-self-end">
					<button class="btn btn-primary btn-sm btn-block" id="btnCargar">
						<i class="fas fa-list-alt" id="fontbtn"></i> Cargar
					</button>
				</div>		
			</div>
		</div>
	</div>
</div>

<div>
	<table class="table table-bordered table-sm table-hover table-fixed table-striped display tblConsultarPQR" id="tblConsultarPQR" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>PQR</th>
				<th>PQRID</th>
				<th>Fecha PQR</th>
				<th>Factura</th>
				<th>Id Cliente</th>
				<th>Nombre Cliente</th>
				<th>Ciudad</th>
				<th>Descripción del PQR</th>
				<th>Durante revisión</th>
				<th>Solución</th>
				<th>TipoPQRId</th>
				<th>Devoluciones</th>
				<th>Fecha solución del PQR</th>
				<th>Costos PQR</th>	
				<th>Causa PQR</th>
				<th>Año</th>
				<th>Mes</th>
				<th>Día</th>
				<th>Respuesta Cliente</th>
				<th>Fecha cierre</th>
				<th>Estado</th>
				<th>Tiempo solución PQR</th>
				<th>Semana</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
