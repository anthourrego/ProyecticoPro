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
<?php if ($this->session->userdata('TipoV') != 'P' && $this->session->userdata('TipoV') != 'PR'){ ?>
	<div class="content-wrapper contenido">
<?php } ?>
		<div class="container-fluid"> 
			<?php $this->load->view($content_page); ?>
		</div>
	</div>
	
<?php

$this->load->view('UI/foot');

$this->load->view('UI/scripts');



?>