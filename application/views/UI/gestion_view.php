
<?php

$this->load->view('UI/head');

switch ($this->uri->segment(1)) {
	case 'Administrativo':
		if($this->session->userdata('TipoV') != 'A'){
			redirect(base_url());
		}
		break;
	case 'Propietario':
		if($this->session->userdata('TipoV') != 'PR'){
			redirect(base_url());
		}
		break;
	case 'Porteria':
		if($this->session->userdata('TipoV') != 'P'){
			redirect(base_url());
		}
		break;
	default:
		break;
}

switch ($this->session->userdata('TipoV')) {
	case 'A':
		$this->load->view('UI/navbar');
		break;
	case 'PR':
		$this->load->view('UI/navbarPR');
		break;
	case 'P':
		$this->load->view('UI/navbarP');
		break;
	default:
		break;
}

?>

<style type="text/css">
	
</style>
<?php if ($this->session->userdata('TipoV') != 'P' && $this->session->userdata('TipoV') != 'PR'){ ?>
<div class="content-wrapper contenido mr-3">
<?php } ?>
	<?php if ($this->session->userdata('TipoV') != 'P' && $this->session->userdata('TipoV') != 'PR'){ ?>
	<div class="container m-0 col-12 shadow contenedorUnico ml-2 pt-1 pb-3 shadow">
	<?php }else{ ?>
	<div class="container m-0 col-12 shadow contenedorUnico pt-1 pb-3 shadow">
	<?php } ?>
		<!-- <div class="divGestion position-relative">
			<?php if(isset($regresar)){ ?>
			<a <?= ($regresar === true ? 'href="#" onclick="window.history.back();"' : 'href="'.base_url().$regresar.'"') ?> style="top: 0;left: 0;font-size: 2rem;" class="position-absolute pl-1" title="Atrás">
				<i class="fas fa-chevron-circle-left"></i>
			</a>
			<?php } ?>
			<h1><?php if(isset($titulo)){echo $titulo;}else{echo "&nbsp;";} ?></h1>
		</div> -->
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
						<i class="fas fa-list-alt"></i>
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

	
	<?php  
	$this->load->view($content_page);
	?>
	
	</div>
</div>

<div class="modal fade" id="mFecha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document" style="width: 310px">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-chack"></i>Fecha</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div style="overflow:hidden;">
					<div class="form-group">
						<div class="row">
							<div class="col-12">
								<div id="calendarFecha"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal"><i class="fas fa-save"></i> Guardar</button>
				<button type="button" class="btn btn-outline-secondary" id="btnCerrarMFecha" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('UI/navbar_footer');

$this->load->view('UI/foot');

$this->load->view('UI/scripts');

?>