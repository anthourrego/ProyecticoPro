<style type="text/css">
	.card-title{
		font-size: 35px;
		text-align: center;
		font-weight: bold;
		color: white;
	}
	.iconoIni{
		margin: auto;
		font-size: 120px;
		color: white;
	}
	.card-text{
		text-align: justify;
		color: white;
		font-weight: bolder;	
	}
	.card{
		height: 290px;
		border-radius: .35rem !important;
		text-decoration: none !important;
	}
	.card-ingreso:hover{
		background-color: #1F69FF !important;
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.30);
		transition: 0.3s ease;
	}
	.card-salida:hover{
		background-color: #E77E23 !important;
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.30);
		transition: 0.3s ease;
	}
	.card-encomiendas:hover{
		background-color: #FF4747 !important;	
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.30);
		transition: 0.3s ease;
	}
	.card-servicios:hover{
		background-color: #A8CE50 !important;
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.30);
		transition: 0.3s ease;

	}
	.card-incidentes:hover{
		background-color: #C84F41 !important;
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.30);
		transition: 0.3s ease;
	}
	.card-otros:hover{
		background-color: #F76C26 !important;
		box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.30);
		transition: 0.3s ease;

	}
</style>
<div class="row">
	<div class="col-md-6 col-lg-3 col-xl-3 offset-1 offset-md-0 offset-xl-0 col-10 form-group">
		<a class="card card-ingreso" href="<?= base_url() ?>Porteria/Ingreso/cIngreso" style="background-color: #4886FF">
			<i class="far fa-address-card iconoIni"></i>
			<div class="card-body">
				<h5 class="card-title">Ingresos</h5>
				<p class="card-text">Ingresos al conjunto residencial (Propietarios,residentes,arrendatarios,visitantes)</p>
			</div>
		</a>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 offset-1 offset-md-0 offset-xl-0 col-10 form-group">
		<a class="card card-salida" href="<?= base_url() ?>Porteria/Salida/cSalida" style="background-color: #EB984E">
			<i class="fas fa-sign-out-alt iconoIni"></i>
			<div class="card-body">
				<h5 class="card-title">Salidas</h5>
				<p class="card-text">Salida del conjunto residencial (Propietarios,residentes,arrendatarios,visitantes)</p>
			</div>
		</a>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 offset-1 offset-md-0 offset-xl-0 col-10 form-group">
		<a class="card card-encomiendas" href="<?= base_url() ?>Porteria/Encomienda/cEncomienda" style="background-color: #FF6F6F">
			<i class="fas fa-people-carry iconoIni mt-2"></i>
			<div class="card-body">
				<h5 class="card-title">Encomiendas</h5>
				<p class="card-text">Encomiendas para los personas del conjunto residencial</p>
			</div>
		</a>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 offset-1 offset-md-0 offset-xl-0 col-10 form-group">
		<a class="card card-servicios" href="<?= base_url() ?>Porteria/Servicio/cServicio" style="background-color: #B5D56A">
			<i class="fas fa-paste iconoIni mt-2"></i>
			<div class="card-body">
				<h5 class="card-title">Servicios</h5>
				<p class="card-text">Agua, luz, gas, proveedores de servicios, etc...</p>
			</div>
		</a>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 offset-1 offset-md-0 offset-xl-0 col-10 form-group">
		<a class="card card-incidentes" href="<?= base_url() ?>Porteria/Incidente/cIncidente" style="background-color: #CD6155">
			<i class="fas fa-book-reader iconoIni mt-2"></i>
			<div class="card-body">
				<h5 class="card-title">Incidentes</h5>
				<p class="card-text">Reportes de incidentes y daños en el conjunto residencial</p>
			</div>
		</a>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 offset-1 offset-md-0 offset-xl-0 col-10 form-group">
		<a class="card card-otros" href="<?= base_url() ?>Porteria/Otro/cOtro" style="background-color: #F77147">
			<i class="fas fa-swatchbook iconoIni mt-2"></i>
			<div class="card-body">
				<h5 class="card-title">Otros</h5>
				<p class="card-text">Otros asociados al conjunto residencial</p>
			</div>
		</a>
	</div>
</div>