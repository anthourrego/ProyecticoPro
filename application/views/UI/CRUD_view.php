<?php

if(isset($css_lib)){
	$css_lib = array_merge(array(
		'dataTables/datatables.min.css'
		,'dataTables/dataTables.bootstrap4.min.css'
		,'dataTables/buttons.bootstrap4.min.css'
		,'chosen/chosen.min.css'
		),$css_lib);
	$contenido['css_lib'] = $css_lib;
}else{
	$contenido['css_lib'] = array(
		'dataTables/datatables.min.css'
		,'dataTables/dataTables.bootstrap4.min.css'
		,'dataTables/buttons.bootstrap4.min.css'
		,'chosen/chosen.min.css'
	);
}

$this->load->view('UI/head', $contenido);

$this->load->view('UI/Navbar');

?>

<script type="text/javascript">
	var $PARAMETROS = {};
</script>

<!-- <div class="content-wrapper contenido">
	<div class="container contenedorUnico pt-1 pb-3 shadow"> -->

<div class="content-wrapper contenido mr-3">
	<div class="container col-12 contenedorUnico ml-2 pt-1 pb-3 shadow">
		<div class="row">
			<?php if (isset($hBack) && isset($txtBack)) {?>
				<div class="col-12 pl-0 divLinkNav d-none divResNav">
					<label style="float: right;">.../
						<a href="#" onclick="window.history.back();"><?php echo $txtBack ?></a>
						/<?php echo $titulo ?>
					</label>
				</div>
			<?php } ?>
			<div class="col-4 col-sm-2 col-md-2 col-xl-1">
				<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link active titleLink">
					<span class="round-tab">
						<i class="fas fa-clone"></i>
					</span>
				</a>
			</div>
			<div class="col-8 col-sm-5 col-md-5 col-xl-6 pl-0">
				<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" class="nav-link titleLink2 col-12">
					<label class="labelLink"><?php if(isset($titulo)){echo $titulo;}else{echo "&nbsp;";} ?></label>
				</a>
			</div>

			<?php 
				if (isset($breadcrumb)) {
			?>
				<div class="col-6 col-sm-5 col-md-5 col-xl-5 pl-0 divLinkNav divFullNav">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent float-right">
							<?php	
								foreach ($breadcrumb as $key => $valor) {
									if ((count($breadcrumb)-1) == $key) {
										echo("<li class='breadcrumb-item active'>" . $valor['nombre'] . "</li>");
									}else {
										echo("<li class='breadcrumb-item'><a href='" . base_url() . $valor['ruta'] . "'>" . $valor['nombre'] . "</a></li>");
									}
								}
							?>
						</ol>
					</nav>
				</div>
			<?php
				}
			?>
			<?php if (isset($hBack) && isset($txtBack)) {?>
				<div class="col-6 col-sm-5 col-md-5 col-xl-5 pl-0 divLinkNav divFullNav">
					<label style="float: right;">.../
						<a href="#" onclick="window.history.back();"><?php echo $txtBack ?></a>
						/<?php echo $titulo ?>
					</label>
				</div>
			<?php } ?>
			<div class="col-12">
				<hr class="w-100 mt-1" style="border-color: #e0e0e0">
			</div>
		</div>
	
		<div class="row form-group mb-2">
			<div class="col-12 col-md-3 col-lg-2">
				<button class="btn btn-sm btn-primary botones" id="btnCrear"><i class="fas fa-plus"></i> Crear</button>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered table-sm table-hover table-fixed table-striped display" id="tblCRUD" cellspacing="0" style="width: 100%;">
				<thead>
					<tr>
						<th>Acciones</th>
						<?php
						foreach ($columnas as $columna) {
							echo "<th>".$columna."</th>";
						}
						?>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="frmCRUD">

				<?php

				$this->load->view($content_page);

				?>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" form="frmCRUD"><i class="fa fa-save"></i> Guardar</button>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<?php

$this->load->view('UI/navbar_footer');

$this->load->view('UI/foot');

if(isset($js_lib)){
	$js_lib = array_merge(array(
		'dataTables/jquery.dataTables.min.js'
		,'dataTables/dataTables.bootstrap4.min.js'
		,'dataTables/dataTables.scroller.min.js'
		,'dataTables/dataTables.buttons.min.js'
		,'dataTables/buttons.flash.min.js'
		,'dataTables/jszip.min.js'
		,'dataTables/pdfmake.min.js'
		,'dataTables/vfs_fonts.js'
		,'dataTables/buttons.bootstrap4.min.js'
		,'dataTables/buttons.html5.min.js'
		,'dataTables/buttons.print.min.js'
		,'inputmask/jquery.inputmask.bundle.min.js'
		),$js_lib);
	$contenido['js_lib'] = $js_lib;
}else{
	$contenido['js_lib'] = array(
		'dataTables/jquery.dataTables.min.js'
		,'dataTables/dataTables.bootstrap4.min.js'
		,'dataTables/dataTables.scroller.min.js'
		,'dataTables/dataTables.buttons.min.js'
		,'dataTables/buttons.flash.min.js'
		,'dataTables/jszip.min.js'
		,'dataTables/pdfmake.min.js'
		,'dataTables/vfs_fonts.js'
		,'dataTables/buttons.bootstrap4.min.js'
		,'dataTables/buttons.html5.min.js'
		,'dataTables/buttons.print.min.js'
		,'inputmask/jquery.inputmask.bundle.min.js'
	);
}
if(isset($script_adicional)){
	$script_adicional = array_merge(array(
		'personalizados/jsCRUD.js'
		),$script_adicional);
	$contenido['script_adicional'] = $script_adicional;
}else{
	$contenido['script_adicional'] = array(
		'personalizados/jsCRUD.js'
	);
}

$this->load->view('UI/scripts', $contenido);
?>

<script type="text/javascript">
	var $CONTROLADOR = '<?= $this->router->fetch_class() ?>';
	var $DIRECTORY = '<?= $this->router->fetch_directory() ?>';
	var $TABLA = '<?= $tabla ?>';
	var $TITULO = '<?= $titulo ?>';
	var $TABLANOMBRE = '<?= $tblNombre ?>';
	<?php
		if(isset($botonesTabla)){
			?>
			var $botonesTabla = JSON.parse('<?= json_encode($botonesTabla) ?>');
			<?php
		}else{
			?>
			var $botonesTabla = [];
			<?php
		}
	?>
	var dataTable = dataTableSSCRUD($PARAMETROS);
</script>