	<?php  
	/* switch ($this->session->userdata('TipoV')) {
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
	} */
	?>
	<?php if ($this->session->userdata('TipoV') == 'A') {?>
	<footer class="footer mt-auto py-2 col-12 col-md-12 col-xl-12">
	<?php }else{ ?>
	<footer class="footer mt-auto py-2 col-12">
	<?php } ?>
		<div class="container">
			Todos los derechos reservados 20<?= date('y') ?>, Casa de Software Prosof®. V 1.0.0
		</div>
	</footer>
</body>