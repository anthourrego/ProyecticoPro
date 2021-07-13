<style>
    /* lined tabs */

	.lined .nav-link {
		border: none;
		border-bottom: 3px solid transparent;
	}

	.lined .nav-link:hover {
		border: none;
		border-bottom: 3px solid transparent;
	}

	.lined .nav-link.active {
		background: none;
		color: #555;
		border-color: #2b90d9;
	}
</style>


<div class="row">
	<div class="col-12 col-md-5 col-lg-4">
        <form id="frmRegistrarPQR">
            <div class="form-row">
                <input type="hidden" id="UsuarioId" name="UsuarioId" value="<?= $this->session->userdata('id'); ?>">
                <input type="hidden" id="TerceroId" name="TerceroId" value="<?= $this->session->userdata('CEDULA'); ?>">

                <div class="col-12">
                    <label class="font-weight-bold my-auto"><span class="text-danger">*</span>Tipo PQR:</label>
                    <select class="chosen-select custom-select custom-select-sm" name="TipoPQR" id="TipoPQR">
                        <option value="0" data-validar="0" disabled selected>Seleccione</option>
                        <?php
                            foreach ($listaTipoPQR as $TipoPQR) {
                                echo "<option value='".$TipoPQR->TipoPQRId."' data-validar='".$TipoPQR->ValidaPedido."'>".$TipoPQR->Nombre."</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="col-12 no-gutters my-1">
                    <label for="Asunto" class="font-weight-bold my-auto"><span class="text-danger">*</span>Asunto:</label>
                    <input name="Asunto" id="Asunto" class="form-control form-control-sm" type="text" autocomplete="off">
                </div>
                <div class="col-12 form-group mb-1">
                    <label for="Descripcion" class="font-weight-bold my-auto"><span class="text-danger">*</span>Descripción:</label>  
                    <textarea name="Descripcion" id="Descripcion" rows="3" class="form-control form-control-sm" type="text"></textarea>  
                </div>
                <div class="col-12 form-group">
                    <label class="font-weight-bold my-auto">Anexar Archivos:</label>
                    <div class='custom-file custom-file-sm'>
                        <input type='file' class='custom-file-input custom-file-input-sm' name="archivos[]" id="form-image" multiple="true" lang='es' accept="application/msword, application/vnd.ms-excel, text/plain, application/pdf, image/*" >
                        <label class='custom-file-label custom-file-label-sm' for='archivos' data-browse='Elegir'>
                            <span id="form-image-span" class='d-inline-block text-truncate w-75'>Seleccione un archivo...</span>
                        </label>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-success" form="frmRegistrarPQR"><i class="fas fa-save"></i> Registrar</button>
                </div>
            </div>
        </form>
	</div>

    <div class="col-12 d-block d-md-none">
        <hr>
    </div>

	<div class="col-12 col-md-7 col-lg-8 border-left ">
        <div class="form-row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="fFechaInicio" class="mb-0">Desde:</label>
                        <div class="input-group date datepicker">
                            <input type="text" class="form-control form-control-sm dateFecha" name="fFechaInicio" id="fFechaInicio" maxlength="15" value="">
                            <a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
                                <span class="input-group-text fas fa-calendar-alt d-flex"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="fFechaFin" class="mb-0">Hasta:</label>
                        <div class="input-group date datepicker">
                            <input type="text" class="form-control form-control-sm dateFecha" name="fFechaFin" id="fFechaFin" maxlength="15" value="">
                            <a href="#" class="input-group-append input-group-addon" title="Desplegar Calendario">
                                <span class="input-group-text fas fa-calendar-alt d-flex"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-lgs-6 col-lg-4">
                        <label for="tipoPQR"  class="mb-0">Tipo Reunión</label>
                        <select class="chosen-select custom-select custom-select-sm" multiple name="tipoPQR[]" id="tipoPQR"> 
                            <?php 
                                if(count($listaTipoPQR) > 0){
                                    foreach ($listaTipoPQR as $TipoPQR) {
                                        echo "<option value='".$TipoPQR->TipoPQRId."'>".$TipoPQR->Nombre."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 align-self-end">
                        <button class="btn btn-secondary btn-sm btn-block mt-3" id="btnFiltrar"><i class="fas fa-filter"></i> Filtrar</button>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 align-self-end">
                        <button class="btn btn-danger btn-sm btn-block mt-3" id="btnLimpiarFiltro"><i class="fas fa-broom"></i> Limpiar</button>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 align-self-end">
                        <button class="btn btn-info btn-sm btn-block mt-3" id="btnFiltrarTodo"><i class="fas fa-list"></i> Cargar Todas</button>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUD" cellspacing="0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>PQRID</th>
                                <th>PQR</th>
                                <th>Estado</th>
                                <th>Clasificación</th>
                                <th>Asunto</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Fecha Cierre</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
	</div>
</div>

<div class="modal fade" id="verPQR" tabindex="-1" aria-labelledby="verPQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verPQRLabel">Ver PQR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <ul class="nav nav-tabs lined" id="tabModal" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="informacion-tab" data-toggle="tab" href="#informacion" role="tab" aria-controls="informacion" aria-selected="true">Información</a>
					</li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link"id="notas-tab" data-toggle="tab" href="#notas" role="tab" aria-controls="notas" aria-selected="false">Notas</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="historial-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                    </li>
				</ul>
				<div class="tab-content pt-2" id="tabModalContent">
					<div class="tab-pane fade show active" id="informacion" role="tabpanel" aria-labelledby="informacion-tab">
                        <form id="frmVerPQR">
                            <div class="form-row">
                                <div class="col-12 col-md-6 col-lg-3">
                                    <label class="font-weight-bold my-auto">Tipo:</label>
                                    <input type="text" name="TipoPQR" disabled class="form-control form-control-sm" disabled autocomplete="off">
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label class="font-weight-bold my-auto">Estado:</label>
                                    <input type="text" name="Estado" disabled class="form-control form-control-sm" disabled autocomplete="off">
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label class="font-weight-bold my-auto">Fecha Creacion:</label>
                                    <input type="text" name="FechaCreacion" disabled class="form-control form-control-sm" disabled autocomplete="off">
                                </div>

                                <div class="col-12 col-md-6 col-lg-3">
                                    <label class="font-weight-bold my-auto">Fecha Cierre:</label>
                                    <input type="text" name="FechaCierre" disabled class="form-control form-control-sm" disabled autocomplete="off">
                                </div>

                                <div class="col-12 no-gutters my-1">
                                    <label for="Asunto" class="font-weight-bold my-auto">Asunto:</label>
                                    <input name="Asunto" disabled class="form-control form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-12 form-group mb-1">
                                    <label for="Descripcion" class="font-weight-bold my-auto">Descripción:</label>  
                                    <textarea name="Descripcion" disabled rows="3" class="form-control form-control-sm" type="text"></textarea>  
                                </div>
                            </div>
                        </form>
					</div>
					<div class="tab-pane fade" id="notas" role="tabpanel" aria-labelledby="notas-tab">
                        <table class="table table-bordered table-condensed table-striped mb-0">
                            <tbody id="tablaNotas"></tbody>
                        </table>
					</div>
					<div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="contact-tab">
                        <table class="table table-bordered table-condensed table-striped" style="margin-bottom: 0">
                            <thead>
                                <tr>
                                    <th class="histoH" style="width: 20%">Fecha</th>
                                    <th class="histoH" style="width: 30%">Nombre de Usuario</th>
                                    <th class="histoH">Cambio</th>
                                </tr>
                            </thead>
                            <tbody id="historialPQR"></tbody>
                        </table>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $idPQR = '<?= $idPQR ?>';
    $USR = '<?= $this->session->userdata('id') ?>';
</script>