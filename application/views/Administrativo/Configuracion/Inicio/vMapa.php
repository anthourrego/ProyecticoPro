<style type="text/css">
	.txtLabel{
		font-size: 16px;
		font-weight: bolder;
	}

	.foto{
		/*border-right: 1px solid rgba(0,0,0,.125);*/
		/*	min-height: 400px;*/
		background-repeat: no-repeat !important;
		background-position: center center;
		background-size: contain;
		min-width: 890px !important;
		max-width: 890px !important;
		width: 890px !important;
	}
	.foto2{
		/*border-right: 1px solid rgba(0,0,0,.125);*/
		min-height: 400px;
		background-repeat: no-repeat !important;
		background-position: center center;
		background-size: contain;
	}
	.division{
		border-left: 1px solid #c1c1c1;
		background-color: white;
		z-index: 61;
	}
	.btnData{
		border-color: #1d2124;
		padding: 15px;
		opacity: 0.4;
		margin-top: 5px;
	}
	.btnData2{
		border-color: transparent !important;
		background-color: transparent !important;
		padding: 15px;
		margin-top: 5px;
	}
	.btnData2:hover{
		border-color: transparent !important;
		background-color: transparent !important;
	}
	.btnClick{
		background-color: red;
		opacity: 0.4;
		margin-top: 5px;
	}
	.rowBTN{
		overflow: auto;
	}
	.localiza{
		font-size: 40px;
		color: red;
	}
	.divLocaliza{
		min-height: 440px;
		min-width: 890px !important;
		max-width: 890px !important;
		width: 890px !important;
	}
	.divLocaliza2{
		min-height: 440px;
	}
	.rowZonas{
		height: 215px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	.rowVivienda{
		height: 215px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	.tooltip{
		z-index: 60 !important;
	}
	.btnZonaMapa{
		border-color: #e0e0e0 !important;
	}
	.btnSA{
		border-color: #e0e0e0 !important;
	}
</style>
<div class="row mt-3">
	<div class="col-12 col-md-8 col-xl-8">
		<div class="col-12 p-0">
			<div class="row">
				<div class="col-1" title="Interlineado de botones">
					
				</div>
				<div class="col-6">
					<div class="row">
						<form enctype="multipart/form-data">
							<label class="col-md-4 col-xl-2 col-form-label col-form-label-md text-md-right pl-0 py-0">Adjunto</label>
							<div class="col-12 p-0">
								<div class="input-group input-group-sm">
									<div class="custom-file custom-file-sm">
										<input type="file" class="custom-file-input custom-file-input-sm" id="adj" lang="es">
										<label class="custom-file-label custom-file-label-sm" data-browse='Elegir'>Seleccione un archivo...</label>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 p-0 mt-3" style="overflow: auto;">
			<div class="foto">
				<div class="divLocaliza2">

				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 col-xl-4 division">
		<div class="col-12">
			<div class="row">
				<div class="col-10 p-0">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Zona: </label>
					<input type="text" class="form-control form-control-sm" autofocus id="nomZona" autocomplete="off">
				</div>
				<div class="col-2">
					<label class="d-none d-md-block mb-0">&nbsp;</label>
					<button class="btn btn-sm btn-success" id="btnZona"><span class="fas fa-plus"></span></button>
				</div>
				<div class="col-12 rowZonas p-0">
					
				</div>
				<div class="col-12 p-0 mt-2">
					<label class="mb-0 txtLabel"><span class="text-danger">*</span>Viviendas asociadas: </label>
				</div>
				<div class="col-12 rowVivienda p-0">
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
	</div>
</div>

<script type="text/javascript">

</script>