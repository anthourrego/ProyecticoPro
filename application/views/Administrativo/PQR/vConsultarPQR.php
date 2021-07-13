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

	/* Este es para que el calendario pase por encima */
	.accordion > .card {
		overflow: visible !important;
	}

</style>

<?php 
	$supported_image = array(
		'gif',
		'jpg',
		'jpeg',
		'png'
	); 

?>

<div class="form-row mb-3">
	<!-- <div class="col-12 col-lg-4 col-xl-2 my-1" id="txt_ID">
		<label class="mb-0">ID:</label>
		<input type="text" class="form-control form-control-sm" readonly value="<?= $PQR[0][0]->PQR ?>">
	</div> -->

	<div class="col-12 col-md-6 col-lg-2 my-1" id="txt_fecha_PQR">
		<label class="mb-0">Fecha:</label>
		<input type="text" class="form-control form-control-sm" readonly value="<?= date("d/m/Y", strtotime($PQR[0][0]->Fecha)) ?>">
	</div>

	<div class="col-12 col-md-6 col-lg-2 my-1" id="txt_fecha_solucion">
		<label class="mb-0" id="lbl_fecha_solucion">Fecha Solución:</label>
		<input type="text" class="form-control form-control-sm" readonly tabindex="12" value="<?= $PQR[0][0]->FechaCierre != NULL ? date("d/m/Y", strtotime($PQR[0][0]->FechaCierre)) : '' ?>">
	</div>

	<div class="col-12 col-md-6 col-lg-4 my-1">
		<label class="mb-0">Estado:</label>
		<input type="text" class="form-control form-control-sm" readonly value="<?= $PQR[0][0]->EstadoPQR ?>" >
	</div>

	<div class="col-12 col-md-6 col-lg-4 my-1" style="">
		<label class="mb-0">Factura:</label>
		<input type="text" class="form-control form-control-sm" value="<?= $PQR[0][0]->Factura ?>" readonly>
	</div>

	<div class="col-12 col-md-6 col-lg-4 my-1">
		<label class="mb-0">Clasificación:</label>
		<select class="custom-select custom-select-sm headPQR" data-nombre="TipoPQRId" <?= $informacion == 0 ? 'disabled' : '' ?>>
			<option value="" disabled>Seleccione</option>
			<?php
			foreach ($PQR[5] as $Tipo) {
				echo "<option value='".$Tipo->TipoPQRId."'>".$Tipo->Nombre."</option>";
			}
			?>
		</select>
	</div>

	<div class="col-12 col-md-6 col-lg-4 my-1" id="txt_causa_PQR">
		<label class="mb-0" id="lbl_causa_PQR">Causa:</label>
		<div class="input-group input-group-sm my-group">
			<select class="custom-select custom-select-sm headPQR otra" data-nombre="Causa" <?= $informacion == 0 ? 'disabled' : '' ?>>					
				<option value="" disabled selected>Seleccione</option>
				<?php
				foreach ($PQR[6] as $Causa) {
					echo "<option value='".$Causa->CausaPQRId."'>".$Causa->Nombre."</option>";
				}
				?>
				<option value="otro">Otro</option>
			</select>
			<input type="text" class="form-control form-control-sm d-none headPQR otra" data-nombre="OtraCausa" maxlength="100" <?= $informacion == 0 ? 'disabled' : '' ?>>
		</div>
	</div>

	<div class="col-12 col-lg-4 col-xl-4 my-1"  id="txt_cliente">
		<label class="mb-0">Cliente:</label>
		<div class='input-group input-group-sm'>
			<input type='text' class='form-control form-control-sm w-25' readonly maxlength='15' value='<?= $PQR[0][0]->TerceroId ?>'>
			<div class='input-group-append w-75'>
				<span class='input-group-text w-100 ellipsis' id="VendedorNombre" title='<?= $PQR[0][0]->Cliente ?>'><?= $PQR[0][0]->Cliente ?></span>
			</div>
		</div>
	</div>

	

	<div class="col-12 my-1" id="txt_asunto">
		<label class="mb-0">Asunto:</label>
		<textarea class="form-control form-control-sm" readonly style="min-height: 30px; height: 30px" tabindex="28"><?= $PQR[0][0]->Asunto ?></textarea>
	</div>

	<div class="col-12 my-1" id="txt_descripcion">
		<label class="mb-0">Descripción:</label>
		<textarea class="form-control form-control-sm" readonly><?= $PQR[0][0]->Descripcion ?></textarea>
	</div>
</div>

<!-- <div class="row">
	<div class="col-12 col-sm-6">
		<div class="form-row">
			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Fecha Producción:</label>
			<div class="col-12 col-lg-8 col-xl-3 my-1" id="txt_fecha_produccion">
				<input type="date" class="form-control form-control-sm headPQR" data-nombre="Fabricado" <?php if($informacion == 0){echo 'readonly';} ?>>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm" <?= $PQR[0][0]->Producidos != NULL ? "id='lbl_fecha_despacho'" : '' ?>>Fecha Despacho:</label>
			<div class="col-12 col-lg-8 col-xl-3 my-1" <?= $PQR[0][0]->Producidos != NULL ? "id='txt_fecha_despacho'" : '' ?> >
				<input type="date" class="form-control form-control-sm headPQR" data-nombre="Despachado" <?= $informacion == 0 ? 'readonly' : '' ?>>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm <?= $PQR[0][0]->Producidos == NULL ? 'd-noe' : '' ?>">Cantidad:</label>
			<div class="col-12 col-lg-8 col-xl-3 my-1 <?= $PQR[0][0]->Producidos == NULL ? 'd-non' : '' ?>">
				<input type="text" class="form-control form-control-sm" value="<?= $PQR[0][0]->Producidos ?>" readonly>
			</div>
		</div>
		<div class="form-row">
			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm <?= $PQR[0][0]->Producto == NULL ? 'd-non' : '' ?>" id="lbl_producto">Producto:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1 <?= $PQR[0][0]->Producto == NULL ? 'd-non' : '' ?>" id="txt_producto">
				<input type="text" class="form-control form-control-sm" value="<?= $PQR[0][0]->Producto ?>" readonly>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Ciudad/Asesor:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_asesor">
				<input type="text" class="form-control form-control-sm" readonly value="<?= $PQR[0][0]->Ciudad ?>">
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Devoluciones:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_devoluciones">
				<textarea type="text" class="form-control form-control-sm headPQR" data-nombre="Devoluciones" style="max-height:65px;min-height:30px;height:30px" <?= $informacion == 0 ? 'readonly' : '' ?>><?= $PQR[0][0]->Devoluciones ?></textarea>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm" id="lbl_problema_calidad">Problema de Calidad:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_problema_calidad">
				<div class="input-group input-group-sm my-group">
					<select class="custom-select custom-select-sm headPQR otra" data-nombre="Calidad" <?= $informacion == 0 ? 'disabled' : ''?>>
						<option value="" disabled selected>Seleccione</option>
						<?php
						foreach ($PQR[7] as $Calidad) {
							echo "<option value='".$Calidad->CausaPQRId."'>".$Calidad->Nombre."</option>";
						}
						?>
						<option value="otro">Otro</option>
					</select>
					<input type="text" class="form-control-sm form-control d-none headPQR otra" data-nombre="OtraCalidad" maxlength="100" <?= $informacion == 0 ? 'disabled' : '' ?>>
				</div>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Operación:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_operacion">
				<div class="input-group input-group-sm my-group">
					<select class="custom-select custom-select-sm headPQR otra" data-nombre="Operacion" <?= $informacion == 0 ? 'disabled' : '' ?>>
						<option value="" disabled selected>Seleccione</option>
						<?php
						foreach ($PQR[9] as $Operacion) {
							echo "<option value='".$Operacion->CausaPQRId."'>".$Operacion->Nombre."</option>";
						}
						?>
						<option value="otro">Otro</option>
					</select>
					<input type="text" class="form-control-sm form-control d-none headPQR otra" data-nombre="OtraOperacion" maxlength="100" <?= $informacion == 0 ? 'disabled' : '' ?>>
				</div>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Costos PQR:</label>
			<div class="col-12 col-lg-8 col-xl-3 my-1">
				<input type="text" class="form-control form-control-sm headPQR" maxlength="13" data-nombre="Costos" <?= $informacion == 0 ? 'readonly' : '' ?>>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="form-row">
			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">N° Pedido:</label>
			<div class="col-12 col-lg-8 col-xl-3 my-1">
				<input type="text" class="form-control form-control-sm" readonly value="<?= $PQR[0][0]->Pedido ?>">
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm <?= $PQR[0][0]->Material == NULL ? 'd-non' : '' ?>">Material:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1 <?= $PQR[0][0]->Material == NULL ? 'd-non' : '' ?>" id="txt_material">
				<input type="text" class="form-control form-control-sm" value="<?= $PQR[0][0]->Material ?>" readonly>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Responsable:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_responsable">
				<div class="input-group input-group-sm my-group">
					<select class="custom-select custom-select-sm headPQR otra" data-nombre="Responsable" <?= $informacion == 0 ? 'disabled' : '' ?>>
						<option value="" disabled selected> Seleccione</option>
						<?php
						foreach ($PQR[8] as $Responsable) {
							echo "<option value='".$Responsable->CausaPQRId."'>".$Responsable->Nombre."</option>";
						}
						?>
						<option value="otro">Otro</option>
					</select>
					<input type="text" class="form-control-sm form-control d-none headPQR otra" data-nombre="OtraResponsable" maxlength="100" <?= $informacion == 0 ? 'disabled' : '' ?>>
				</div>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Sección:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_seccion">
				<div class="input-group input-group-sm my-group">
					<select class="custom-select custom-select-sm headPQR otra" data-nombre="Seccion" <?= $informacion == 0 ? 'disabled' : '' ?>>
						<option value="" disabled selected>Seleccione</option>
						<?php
						foreach ($PQR[10] as $Seccion) {
							echo "<option value='".$Seccion->CausaPQRId."'>".$Seccion->Nombre."</option>";
						}
						?>
						<option value="otro">Otro</option>
					</select>
					<input type="text" class="form-control-sm form-control d-none headPQR otra" data-nombre="OtraSeccion" maxlength="100" <?= $informacion == 0 ? 'disabled' : '' ?>>
				</div>
			</div>

			<label class="col-12 col-lg-4 col-xl-5 font-weight-bold text-lg-right col-form-label col-form-label-sm" id="lbl_reclamo_proveedor">Genera Reclamo a Proveedor:</label>
			<div class="col-12 col-lg-8 col-xl-7 my-1" id="txt_reclamo_proveedor">
				<select class="custom-select custom-select-sm headPQR" tabindex="26" data-nombre="ReclamoProveedor" <?= $informacion == 0 ? 'disabled' : '' ?>>
					<option value="" disabled selected>Seleccione</option>
					<option value="1">Sí</option>
					<option value="0">No</option>
				</select>
			</div>

			<label class="col-12 col-lg-4 col-xl-3 font-weight-bold text-lg-right col-form-label col-form-label-sm">Dependencia:</label>
			<div class="col-12 col-lg-8 col-xl-9 my-1" id="txt_dependencia">
				<select class="custom-select custom-select-sm headPQR" data-nombre="DependenciaId" <?= $dependencia == 0 ? 'disabled' : '' ?>>
					<option value="" disabled selected>Seleccione</option>
					<?php
					foreach ($PQR[3] as $Dependencia) {
						echo "<option value='".$Dependencia->DependenciaId."'>".$Dependencia->Nombre."</option>";
					}
					?>
				</select>
			</div>
		</div>
	</div>
</div>

<hr>

<div class="form-row">
	<label class="col-12 font-weight-bold my-1 <?= count($PQR[0][0]->ProductoPQR) <= 0 ? 'd-non' : '' ?>">Productos</label>
	<div class="col-12 my-1 <?= count($PQR[0][0]->ProductoPQR) <= 0 ? 'd-non' : '' ?>" id="txt_asunto">
		<table class="table-bordered table-condensed w-100 mb-3">
			<thead class="divNotas">
				<tr>
					<th>Código</th>
					<th>Producto</th>
					<th>Código</th>
					<th>Material</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(count($PQR[0][0]->ProductoPQR) > 0){
						foreach ($PQR[0][0]->ProductoPQR as $productoPQR) {
							echo "<tr>
								<td>".$productoPQR->ProductoId."</td>
								<td>".$productoPQR->ProductoNombre."</td>
								<td>".$productoPQR->MaterialId."</td>
								<td>".$productoPQR->MaterialNombre."</td>
								<td>".$productoPQR->Producidos."</td>
							</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<hr> -->

<div class="row form-group">
	<div class="divImagenes">
		<?php
			for ($i=1; $i <= 3; $i++) {
				$imagen = 'Imagen'.$i;
				$imagen = eval('return $PQR[0][0]->'.$imagen.';');
				if($imagen){ 
					echo
					'<div class="col-sm-4 divImg1">
						<table class="PQR-img table table-bordered table-condensed table-striped">
							<tbody>
								<tr style="text-align: center">
									<td class="PQR-nota" style="float:center;">
										<a class="imgPQR" href="#">
											<img style="width:180px; float:center" src="data:image/jpeg;base64,'.base64_decode($imagen).'"/>
										</a>
									</td>
								</tr>
								<tr class="spacer" style="text-align: center">
									<td>
										<p>
											<i class="glyphicon glyphicon-picture"></i><strong> Imagen adjunta No. '.$i.'</strong>
										</p>
										<span class="label label-sm label-default arrowed-in-right"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}
			}
		?>
	</div>

	<?php
		if(isset($PQR[0][0]->Adjuntos)){
			echo '<div class="accordion col-12" id="accordionAdjuntos">
					<div class="card border-bottom mb-0">
						<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Adjuntos" data-toggle="collapse" data-target="#collapseAdjuntos" aria-expanded="true" aria-controls="collapseAdjuntos">
							<h5 class="mb-0 my-auto">
								<i class="fas fa-paperclip"></i> Adjuntos
							</h5>
						</button>
						<div id="collapseAdjuntos" class="collapse" aria-labelledby="Adjuntos" data-parent="#accordionAdjuntos" style="">
							<div class="card-body row pb-0">';
			
			foreach ($PQR[0][0]->Adjuntos as $adjunto) {
				$ext = strtolower(pathinfo($adjunto->Archivo, PATHINFO_EXTENSION));
				if (in_array($ext, $supported_image)) {
					echo '<div class="col-md-3">
							<figure class="figure card">
								<a href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'" target="_blank">
									<img src="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'" class="figure-img img-fluid rounded-top">
								</a>
								<figcaption class="figure-caption text-center mb-2">
									<a target="_blank" download="'.$adjunto->Archivo.'" href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'"><i class="far fa-image"></i> '.$adjunto->Archivo.'</a>
								</figcaption>
							</figure>
						</div>';
				} else {
					echo '<div class="col-md-3">
							<figure class="figure card pt-3 text-center">
								<a href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'" target="_blank">
									<img src="'.base_url().'assets/img/iconos/Resolucion.png" class="figure-img w-50 rounded-top">
								</a>
								<figcaption class="figure-caption text-center mb-2">
									<a download="'.$adjunto->Archivo.'" href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'" target="_blank"><i class="far fa-file"></i> '.$adjunto->Archivo.'</a>
								</figcaption>
							</figure>
					</div>';
				}
			}

			echo '</div></div></div></div>';
		}
	?>

	<div class="accordion col-12" id="accordionNotas">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Notas" data-toggle="collapse" data-target="#collapseNotas" aria-expanded="true" aria-controls="collapseNotas">
				<h5 class="mb-0 my-auto">
					<i class="far fa-comment"></i> Notas
				</h5>
			</button>
			<div id="collapseNotas" aria-labelledby="Notas" data-parent="#accordionNotas" class="overflow-auto collapse" style="max-height: 500px !important;">
				<table class="table table-bordered table-condensed table-striped mb-0">
					<tbody class="">
						<?php
						foreach ($PQR[1] as $nota) {
							if (isset($nota->Adjuntos)) {
								$adjuntos = '';
								foreach ($nota->Adjuntos as $adjunto) {
									$ext = strtolower(pathinfo($adjunto->Archivo, PATHINFO_EXTENSION));
									if (in_array($ext, $supported_image)) {
										$adjuntos = $adjuntos.'<div class="div-hidden"><a download="'. $adjunto->Archivo .'" href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'"><i class="fas fa-image"></i> '.$adjunto->Archivo.'</a> <a href="#" class="btn-hidden span-hidden" title="Ver imagen"><span class="fas fa-arrow-alt-circle-up"></span></a><div data-ocultar><a href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'" target="_blank" class="img-pqr"><img class="w-25" src="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'"/></a></div></div>';
									} else {
										$adjuntos = $adjuntos.'<a download="'. $adjunto->Archivo .'" href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'"><i class="fas fa-file"></i> '.$adjunto->Archivo.'</a><br/>';
									}
								}
								$nota->DetalleP = $nota->DetalleP.'<br/>'.$adjuntos;
							}
							echo "
								<tr>
									<td class='col-4 px-3'>
										<p>
											<i class='fas fa-user'></i> <strong>".$nota->nombre."</strong>
										</p>
										<p>
											<i class='far fa-clock'></i> ".$nota->FechaRegis."
										</p>
										<span class='badge badge-secondary'>".$nota->Dependencia."</span>";
										if($nota->Origen == 'C'){
											echo " <span class='badge badge-secondary'>Cliente</span>";
										}
								echo "</td>
									<td class='col-8 px-3'>
										".$nota->DetalleP."
									</td>
								</tr>
								<tr class='spacer'>
									<td colspan='2'></td>
								</tr>
								";
							}
						?>
					</tbody>
				</table>
			</div>	
		</div>
	</div>

	<div class="accordion col-12 <?php $notas == 0 ? 'd-non' : '' ?>" id="accordionAddNotas">
		<div class="card border-bottom mb-0">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="AddNotas" data-toggle="collapse" data-target="#collapseAddNotas" aria-expanded="true" aria-controls="collapseAddNotas">
				<h5 class="mb-0 my-auto">
					<i class="far fa-comment"></i> Añadir Nota
				</h5>
			</button>
			<div id="collapseAddNotas" class="collapse mx-2 p-2" aria-labelledby="AddNotas" data-parent="#accordionAddNotas">
				<form class="form-row" enctype="multipart/form-data" role="form" method="POST" id="frmNota">
					<div class="col-12 col-md-4 form-group">
						<p class="mb-2 font-weight-bold">
							<i class="fas fa-user"></i> <?= $this->session->userdata('nombre') ?>
						</p>
						<p class="mb-2">
							<i class="far fa-clock"></i> <?= date('Y-m-d') ?>
						</p>
						<?php
							if($PQR[2][0]->Nombre != null) {
								echo "<span class='badge badge-secondary'>".$PQR[2][0]->Nombre."</span>";
							}
						?>
					</div>
					<div class="col-12 col-md-8">
						<textarea id="DetalleNota" class="form-control" maxlength="3000" tabindex="30" required></textarea>
					</div>
					<div class="col-12 col-md-4">
						<label class="mb-0" for="">Anexar Archivos:</label>
						<div class='custom-file custom-file-sm'>
							<input type='file' class='custom-file-input custom-file-input-sm' name="archivos[]" id="form-image" multiple="true" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
							<label class='custom-file-label custom-file-label-sm' for='archivos' data-browse='Elegir'>
								<span id="form-image-span" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
							</label>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<label class="mb-0">Origen Nota:</label>
						<select id="Origen" class="chosen-select custom-select custom-select-sm">
							<option value="">Interno</option>
							<option value="C">Cliente</option>
						</select>
					</div>
					<div class="col-12 col-md-3">
						<label class="mb-0">Estado:</label>
						<select id="EstadoReporte" class="chosen-select custom-select custom-select-sm">
							<?php
							foreach ($PQR[4] as $Estado) {
								echo "<option value='".$Estado->EstadoId."'>".$Estado->Nombre."</option>";
							}
							?>
						</select>
					</div>
					<div class="col-12 col-md-2 align-self-end">
						<button id="btn_enviarNota" type="submit" class="btn btn-success btn-sm btn-block" disabled><i class="fas fa-save"></i> Enviar</button>
					</div>
				</form>
			</div>	
		</div>
	</div>

	<div class="accordion col-12" id="accordionHistorial">
		<div class="card border-bottom">
			<button class="card-header py-0 d-flex justify-content-between btn btn-collapse btn-sm collapsed" value="1" id="Historial" data-toggle="collapse" data-target="#collapseHistorial" aria-expanded="true" aria-controls="collapseHistorial">
				<h5 class="mb-0 my-auto">
					<i class="fas fa-list"></i> Historial PQR
				</h5>
			</button>
			<div id="collapseHistorial" class="collapse overflow-auto" aria-labelledby="Historial" data-parent="#accordionHistorial" style="max-height: 500px !important;">
				<table class="table table-bordered table-condensed table-striped" style="margin-bottom: 0">
					<tbody id="historialPQR">
						<tr class="font-weight-bold">
							<td class="histoH" style="width: 20%">Fecha</td>
							<td class="histoH" style="width: 30%">Nombre de Usuario</td>
							<td class="histoH">Cambio</td>
						</tr>
						<tr>
							<td><?= $PQR[0][0]->Fecha ?></td>
							<td><?= $PQR[0][0]->Usuario ?></td>
							<td>Nueva PQR</td>
						</tr>
						<?php
						for ($i = 0; $i < count($PQR[1]); $i++) {
							$tr = "<tr>
							<td>".$PQR[1][$i]->Fecha."</td>
							<td>".$PQR[1][$i]->nombre."</td>";
							if ($i == 0) {
								echo $tr."<td>Cambio estado Abierto => ".$PQR[1][$i]->Estado."</td></tr>";
							} else {
								if ($PQR[1][$i-1]->Estado != $PQR[1][$i]->Estado) {
									echo $tr."<td>Cambio estado ".$PQR[1][$i-1]->Estado." => ".$PQR[1][$i]->Estado."</td></tr>";
								}
							}
						}
						?>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>

<!-- <div class="col-sm-12 div-hidden form-group">
	<div class="divNotas">
		<h4>
			<th><i class="glyphicon glyphicon-comment"></i> Notas<a href="#" class="btn-hidden"><i class="glyphicon glyphicon-menu-up"></i></a></th>
		</h4>
	</div>
	<div data-ocultar>
		<table class="table table-bordered table-condensed table-striped">
			<tbody>
				<?php
				foreach ($PQR[1] as $nota) {
					if (isset($nota->Adjuntos)) {
						$adjuntos = '';
						foreach ($nota->Adjuntos as $adjunto) {
							$ext = strtolower(pathinfo($adjunto->Archivo, PATHINFO_EXTENSION));
							if (in_array($ext, $supported_image)) {
								$adjuntos = $adjuntos.'<div class="div-hidden"><a href="../download/'.$adjunto->Archivo.'"><i class="glyphicon glyphicon-picture"></i> '.$adjunto->Archivo.'</a> <a href="#" class="btn-hidden span-hidden" title="Ver imagen"><span class="glyphicon glyphicon-collapse-up"></span></a><div data-ocultar><a href="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'" target="_blank" class="img-pqr"><img src="'.base_url().'/uploads/'.$this->session->userdata('NIT').'/pqr/'.$adjunto->Archivo.'"/></a></div></div>';
							} else {
								$adjuntos = $adjuntos.'<a href="../download/'.$adjunto->Archivo.'"><i class="glyphicon glyphicon-file"></i> '.$adjunto->Archivo.'</a><br/>';
							}
						}
						$nota->DetalleP = $nota->DetalleP.'<br/>'.$adjuntos;
					}
					echo "
					<tr>
						<td class='PQR-detalle'>
							<p>
								<i class='glyphicon glyphicon-user'></i><strong> ".$nota->nombre."</strong>
							</p>
							<p>
								<i class='glyphicon glyphicon-time'></i> ".$nota->FechaRegis."
							</p>
							<span class='label label-sm label-primary arrowed-in-right'>".$nota->Dependencia."</span>";
							if($nota->Origen == 'C'){
								echo " <span class='label label-sm label-danger arrowed-in-right'>Cliente</span>";
							}
							echo "</td>
							<td class='PQR-nota'>
								".$nota->DetalleP."
							</td>
						</tr>
						<tr class='spacer'>
							<td colspan='2'></td>
						</tr>
						";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<form class="col-sm-12 form-group div-hidden" enctype="multipart/form-data" role="form" method="POST" id="frmNota" <?php
	if($notas == 0){echo ' hidden ';}
	?>>
	<div class="divNotas">
		<h4>
			<th><i class="glyphicon glyphicon-comment"></i> Añadir Nota<a href="#" class="btn-hidden"><i class="glyphicon glyphicon-menu-up"></i></a></th>
		</h4>
	</div>
	<div data-ocultar>
		<table class="table table-bordered table-condensed table-striped" style="margin-bottom: 0">
			<tbody>
				<tr>
					<td class='PQR-detalle'>
						<p>
							<i clas='glysphicon glyphicon-user'></i><strong> <?= $this->session->userdata('name') ?></strong>
						</p>
						<p>
							<i class='glyphicon glyphicon-time'></i> <?= date('Y-m-d') ?>
						</p>
						<?php
						if($PQR[2][0]->Nombre != null) {
							echo "<span class='label label-sm label-default arrowed-in-right'>".$PQR[2][0]->Nombre."</span>";
						}
						?>
					</td>
					<td class='PQR-nota'>
						<textarea id="DetalleNota" class="form-control input-sm" maxlength="3000" tabindex="30" required></textarea>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="divAddNota" style="float: right; width: 100%">
			<div style="float: left; width: 50%" title="Tamaño máximo: 2MB">
				<label><small>Anexar Archivos:</small></label>
				<input type="file" name="archivos[]" id="form-image" multiple="true" accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" />
			</div>
			<div style="float: right; width: 50%">
				<div class="col-sm-4">
					<label><small>Origen Nota:</small></label>
					<select id="Origen" class="form-control" style="width: 100%">
						<option value="">Interno</option>
						<option value="C">Cliente</option>
					</select>
				</div>
				<div class="col-sm-4">
					<label><small>Estado:</small></label>
					<select id="EstadoReporte" class="form-control" style="width: 100%">
						<?php
						foreach ($PQR[4] as $Estado) {
							echo "<option value='".$Estado->EstadoId."'>".$Estado->Nombre."</option>";
						}
						?>
					</select>
				</div>
				<div class="col-sm-4">
					<label><small>&nbsp;</small></label>
					<button id="btn_enviarNota" type="submit" class="btn btn-info" style="width: 100%;margin-bottom: 5px" disabled>Enviar</button>
				</div>
			</div>
		</div>
	</div>
</form> -->

<!-- <form class="col-sm-12 div-hidden">
	<div class="divNotas">
		<h4>
			<th><i class="glyphicon glyphicon-refresh"></i> Historial PQR<a href="#" class="btn-hidden"><i class="glyphicon glyphicon-menu-up"></i></a></th>
		</h4>
	</div>
	<div data-ocultar>
		<table class="table table-bordered table-condensed table-striped" style="margin-bottom: 0">
			<tbody id="historialPQR">
				<tr>
					<td class="histoH" style="width: 20%">Fecha</td>
					<td class="histoH" style="width: 30%">Nombre de Usuario</td>
					<td class="histoH">Cambio</td>
				</tr>
				<tr>
					<td><?= $PQR[0][0]->Fecha ?></td>
					<td><?= $PQR[0][0]->Usuario ?></td>
					<td>Nueva PQR</td>
				</tr>
				<?php
				for ($i = 0; $i < count($PQR[1]); $i++) {
					$tr = "<tr>
					<td>".$PQR[1][$i]->Fecha."</td>
					<td>".$PQR[1][$i]->nombre."</td>";
					if ($i == 0) {
						echo $tr."<td>Cambio estado Abierto => ".$PQR[1][$i]->Estado."</td></tr>";
					} else {
						if ($PQR[1][$i-1]->Estado != $PQR[1][$i]->Estado) {
							echo $tr."<td>Cambio estado ".$PQR[1][$i-1]->Estado." => ".$PQR[1][$i]->Estado."</td></tr>";
						}
					}
				}
				?>
			</tbody>
		</table>
	</div>
</form>
</div> -->

<script type="text/javascript">
	var $PQR = <?= json_encode($PQR[0][0]) ?>;
	//Variable que útilizo casi al final del código
	var estado = false;
</script>