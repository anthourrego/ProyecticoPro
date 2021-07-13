<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/adminLTE/adminlte.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/js/alertify/alertify.min.js"></script>
<script src="<?= base_url(); ?>assets/js/overlayScrollbars/jquery.overlayScrollbars.min.js"></script>

<!-- Librerías -->
<script src="<?= base_url() ?>assets/js/libraries/jsRastreo.js?<?= rand() ?>"></script>
<script src="<?= base_url() ?>assets/js/personalizados/jsAcercaDe.js?<?= rand() ?>"></script>
<script src="<?= base_url() ?>assets/js/personalizados/jsGlobal.js?<?= rand() ?>"></script>


<script>
	<?php if($this->config->item('sess_expiration') != -1){ ?>
		var idleTime = 0;
		document.addEventListener('DOMContentLoaded', function (e) {
			$(document).ready(function(){
				// Incrementa el contador del idle cada minuto
				var idleIntervak = setInterval(timerIncrement, 60000); // 1 minuto

				$(this).on({
					click:function(e){
						idleTime = 0;
					},
					keypress:function(e){
						idleTime = 0;
					}
				});
			});
			function timerIncrement(){
				idleTime = idleTime + 1;
				if(idleTime > <?= (($this->config->item('sess_expiration') / 60) - 1) ?>){
					location.reload();
				}
			}
		});
	<?php } ?>
	function base_url(){
		return "<?=base_url()?>";
	}
	function NIT(){
		return "<?= $this->session->userdata('NIT') ?>";
	}

	function TipoV(){
		return "<?= $this->session->userdata('TipoV') ?>";
	}
</script>

<!-- Scripts Adicionales -->
<?php
if(isset($js_lib)){
	foreach ($js_lib as $script) {
		printf('<script type="text/javascript" src="%s"></script>', base_url("assets/js/".$script)); 
	}
}
if(isset($script_adicional)){
	foreach ($script_adicional as $script) {
		printf('<script type="text/javascript" src="%s"></script>', base_url("assets/js/".$script."?".rand())); 
	}
}
?>

</html>