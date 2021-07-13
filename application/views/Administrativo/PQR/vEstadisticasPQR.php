<style>
	.list-group-item.active{
		color: #333;
		background-color: #e6e6e6;
		border-color: #adadad;
	}

</style>


<?php
	/* if(!empty($_GET['procal'])){
		$procal = $_GET['procal'];
		$procal = explode(',', $procal);
	} */
	/* if(!empty($_GET['operacion'])){
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
	} */
	/* if(!empty($_GET['seccion'])){
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
	}
	if(!empty($_GET['vendedor'])){
		$vendedor = $_GET['vendedor'];
		$vendedor = explode(',', $vendedor);
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
				</div>

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

				
				<!-- Vendedor -->
				<!-- <label class="col-12 col-md-2 font-weight-bold text-md-right my-1">Vendedor: </label>
				<div class="col-12 col-md-4 my-1">
					<select class="chosen-select custom-select custom-select-sm" multiple name="vendedor[]" id="vendedor">
						<?php
							$VENDEDOR = json_decode($selectVendedor);
							for($i = 0; $i<count($VENDEDOR); ++$i){
								if(!empty($_GET['vendedor'])){
									if(in_array($VENDEDOR[$i]->vendedorid, $vendedor)){
										echo("<option selected value='".$VENDEDOR[$i]->vendedorid."'>".$VENDEDOR[$i]->nombre);
									}else{
										echo("<option value='".$VENDEDOR[$i]->vendedorid."'>".$VENDEDOR[$i]->nombre);
									}
								}else{
									echo("<option value='".$VENDEDOR[$i]->vendedorid."'>".$VENDEDOR[$i]->nombre);
								}
							}
						?>
					</select>
				</div> -->

				<div class="col-12 col-md-2 offset-md-10 my-1 align-self-end">
					<button class="btn btn-primary btn-sm btn-block" id="btnCargar">
						<i class="fas fa-list-alt" id="fontbtn"></i> Cargar
					</button>
				</div>		
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 col-lg-2 mb-3">
		<div class="list-group" id="list-tab" role="tablist">
		<!-- <a class="list-group-item list-group-item-action" id="list-dependencia-list" data-toggle="list" href="#list-dependencia" role="tab" aria-controls="dependencia">Dependencia</a>
		<a class="list-group-item list-group-item-action" id="list-reclamoProveedor-list" data-toggle="list" href="#list-reclamoProveedor" role="tab" aria-controls="reclamoProveedor">Reclamo Proveedor</a>
		<a class="list-group-item list-group-item-action" id="list-seccion-list" data-toggle="list" href="#list-seccion" role="tab" aria-controls="seccion">Sección</a>
		<a class="list-group-item list-group-item-action" id="list-responsable-list" data-toggle="list" href="#list-responsable" role="tab" aria-controls="responsable">Responsable</a> 
		<a class="list-group-item list-group-item-action" id="list-operacion-list" data-toggle="list" href="#list-operacion" role="tab" aria-controls="operacion">Operación</a> 
		<a class="list-group-item list-group-item-action" id="list-problemaCalidad-list" data-toggle="list" href="#list-problemaCalidad" role="tab" aria-controls="problemaCalidad">Problema de Calidad</a>
		<a class="list-group-item list-group-item-action" id="list-ciudadAsesor-list" data-toggle="list" href="#list-ciudadAsesor" role="tab" aria-controls="ciudadAsesor">Ciudad / Asesor</a> 
		<a class="list-group-item list-group-item-action" id="list-usuario-list" data-toggle="list" href="#list-usuario" role="tab" aria-controls="usuario">Usuario</a>
		<a class="list-group-item list-group-item-action" id="list-producto-list" data-toggle="list" href="#list-producto" role="tab" aria-controls="producto">Producto</a>
		<a class="list-group-item list-group-item-action" id="list-material-list" data-toggle="list" href="#list-material" role="tab" aria-controls="material">Material</a>
		<a class="list-group-item list-group-item-action" id="list-vendedor-list" data-toggle="list" href="#list-vendedor" role="tab" aria-controls="vendedor">Vendedor</a> -->
		<a class="list-group-item list-group-item-action active" id="list-causa-list" data-toggle="list" href="#list-causa" role="tab" aria-controls="causa">Causa</a>
		<a class="list-group-item list-group-item-action" id="list-clasificacion-list" data-toggle="list" href="#list-clasificacion" role="tab" aria-controls="clasificacion">Clasificación</a>
		<a class="list-group-item list-group-item-action" id="list-cliente-list" data-toggle="list" href="#list-cliente" role="tab" aria-controls="cliente">Cliente</a>
		<a class="list-group-item list-group-item-action" id="list-estado-list" data-toggle="list" href="#list-estado" role="tab" aria-controls="estado">Estado</a>
		</div>
	</div>
	<div class="col-12 col-lg-10">
		<div class="tab-content" id="nav-tabContent">
		<!-- <div class="tab-pane fade" id="list-dependencia" role="tabpanel" aria-labelledby="list-dependencia-list">
		<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblDependencia">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Total</th>
				</tr>
			</thead>
		</table>
		</div>
		<div class="tab-pane fade" id="list-reclamoProveedor" role="tabpanel" aria-labelledby="list-reclamoProveedor-list">
		<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblReclamo">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Total</th>
				</tr>
			</thead>
		</table>
		</div>
		<div class="tab-pane fade" id="list-seccion" role="tabpanel" aria-labelledby="list-seccion-list">
		<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblSeccion">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Total</th>
				</tr>
			</thead>
		</table>
		</div>
		<div class="tab-pane fade" id="list-responsable" role="tabpanel" aria-labelledby="list-responsable-list">
		<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblResponsable">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Total</th>
				</tr>
			</thead>
		</table>
		</div> 
		<div class="tab-pane fade" id="list-operacion" role="tabpanel" aria-labelledby="list-operacion-list">
			<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblOperacion">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Total</th>
					</tr>
				</thead>
			</table>
		</div> 
		<div class="tab-pane fade" id="list-problemaCalidad" role="tabpanel" aria-labelledby="list-problemaCalidad-list">
			<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblProblema">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Total</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="tab-pane fade" id="list-ciudadAsesor" role="tabpanel" aria-labelledby="list-ciudadAsesor-list">
			<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblCiudad">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Total</th>
					</tr>
				</thead>
			</table>
		</div> 
		<div class="tab-pane fade" id="list-usuario" role="tabpanel" aria-labelledby="list-usuario-list">
			<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblUsuario">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Total</th>
					</tr>
				</thead>
			</table>
		</div>	 
		<div class="tab-pane fade" id="list-producto" role="tabpanel" aria-labelledby="list-producto-list">
		<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblProducto">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Total</th>
				</tr>
			</thead>
		</table>
		</div>	 
		<div class="tab-pane fade" id="list-material" role="tabpanel" aria-labelledby="list-material-list">
			<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblMaterial">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Total</th>
					</tr>
				</thead>
			</table>
		</div>	 
		<div class="tab-pane fade" id="list-vendedor" role="tabpanel" aria-labelledby="list-vendedor-list">
			<table class="table table-striped table-bordered table-condensed nowrap table-hover" cellspacing="0" width="100%" id="tblVendedor">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Total</th>
					</tr>
				</thead>
			</table>
		</div> -->
	  		<div class="tab-pane fade show active" id="list-causa" role="tabpanel" aria-labelledby="list-causa-list">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed nowrap table-hover w-100" id="tblCausa">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Total</th>
							</tr>
						</thead>
					</table>
				</div>
	 		</div>
	  		<div class="tab-pane fade" id="list-clasificacion" role="tabpanel" aria-labelledby="list-clasificacion-list">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed nowrap table-hover w-100" id="tblClasificacion">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Total</th>
							</tr>
						</thead>
					</table>
				</div>
	  		</div>
	  		<div class="tab-pane fade" id="list-cliente" role="tabpanel" aria-labelledby="list-cliente-list">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed nowrap table-hover w-100" id="tblCliente">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Total</th>
							</tr>
						</thead>
					</table>
				</div>
	  		</div>
			<div class="tab-pane fade" id="list-estado" role="tabpanel" aria-labelledby="list-estado-list">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed nowrap table-hover w-100" id="tblEstado">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Total</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>	  
		</div>
  	</div>
</div>