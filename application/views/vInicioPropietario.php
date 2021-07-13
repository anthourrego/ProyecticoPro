<style type="text/css">
	.div-info{
		border-radius: 5px;
		padding: 0;
		position: relative;
		text-align: center;
		background-color: #fff;
	}
	.div-infoT{
		border-radius: 5px;
		padding: 0;
		position: relative;
		text-align: center;
		background-color: transparent;
	}
	.div-info a{
		text-decoration: none;
		color: #000;
	}

	.div-header{
		height: 150px;
		display: block;
		object-fit: cover;
		position: relative;
		background-position: center !important;
	   	background-size: cover !important;
	   	background-size: 100% !important;
	   	transition: all 0.3s ease-in-out !important;
		-webkit-transition: all 0.3s ease-in-out !important;
	}

	.div-header:hover{
		background-size: 120% !important;
	}


	.div-icon{
		height: 100px;
		display: block;
		position: relative;
		margin: -55px auto 10px;
	}
	body .container-fluid .contenidoPR{
		padding-top: 0px;
	}
</style>

<div class="portfolio-item"></div>


<div class=" pt-3">
	<div class="row justify-content-around form-group">
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="<?=base_url()?>Propietario/TerceroVehiculo/cTerceroVehiculo" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/misVehiculos.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/car.png) no-repeat center center; background-size: 20%;"></div>
				<div class="div-content mb-3">
					<h4>Mis vehiculos</h4>
					<p class="mb-0">Seguridad</p>
					<p class="mb-0">Control de ingreso</p>
					<p class="mb-0">Vehiculos de la vivienda</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="<?=base_url()?>Propietario/AutorizarVisitante/cAutorizarVisitante" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/autorizar.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/CodiVent.png) no-repeat center center; background-size: 20%;"></div>
				<div class="div-content mb-3">
					<h4>Autorizar visitante</h4>
					<p class="mb-0">Seguridad</p>
					<p class="mb-0">Control de ingreso</p>
					<p class="mb-0">Personal autorizado siempre</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="<?=base_url()?>Propietario/ProgramarInvitacion/cProgramarInvitacion" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/programar.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/tipoEvento.png) no-repeat center center; background-size: 20%;"></div>
				<div class="div-content mb-3">
					<h4>Programar invitaciones</h4>
					<p class="mb-0">Visitantes</p>
					<p class="mb-0">Control de ingreso</p>
					<p class="mb-0">Seguridad en porteria</p>
				</div>
			</a>
		</div>
	</div>
	<div class="row justify-content-around">
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="#">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/factura.jpg);"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/bill.png) no-repeat center center;"></div>
				<div class="div-content mb-3">
					<h4>Paga tus facturas</h4>
					<p class="mb-0">Admon,servicios publicos etc...</p>
					<p class="mb-0">Gestiona tus facuras</p>
					<p class="mb-0">Matente al día</p>
				</div>
			</a> 
		</div>
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="#" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/reserva.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/reservas.png) no-repeat center center;"></div>
				<div class="div-content mb-3">
					<h4>Reservas</h4>
					<p class="mb-0">Areas sociales</p>
					<p class="mb-0">Canchas multiples</p>
					<p class="mb-0">Barbacoa...etc</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="<?=base_url()?>Propietario/Incidencia/cIncidencia" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/incidencias.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/tipoServicio.png) no-repeat center center;"></div>
				<div class="div-content mb-3">
					<h4>Registrar incidencias</h4>
					<p class="mb-0">Seguridad</p>
					<p class="mb-0">Incidentes</p>
					<p class="mb-0">Reporte y seguimiento</p>
				</div>
			</a>
		</div>
		<!-- <div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="#" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/camaras.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/Profesion.png) no-repeat center center;"></div>
				<div class="div-content mb-3">
					<h4>Revisar cámaras</h4>
					<p class="mb-0">Seguridad</p>
					<p class="mb-0">Areas comunes</p>
					<p class="mb-0">Información visual</p>
				</div>
			</a>
		</div> -->
	</div>
	<div class="row justify-content-around">
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="<?=base_url()?>Propietario/PQR/cPQR" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/pqr.png) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/Memos.png) no-repeat center center; background-size: 20%;"></div>
				<div class="div-content mb-3">
					<h4>PQRSF</h4>
					<p class="mb-0">Peticiones, quejas, reclamos</p>
					<p class="mb-0">Sugerencias, Felicitaciones</p>
					<p class="mb-0">Reporte y seguimiento</p>
				</div>
			</a>
		</div>
		<!-- <div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="#" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/registro.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/Memos.png) no-repeat center center; background-size: 20%;"></div>
				<div class="div-content mb-3">
					<h4>Registro fotografico</h4>
					<p class="mb-0">Seguridad</p>
					<p class="mb-0">Control de ingreso</p>
					<p class="mb-0">Información visual</p>
				</div>
			</a>
		</div> -->
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="<?=base_url()?>Propietario/Mascota/cMascota" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/mascotas.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/pets.png) no-repeat center center;"></div>
				<div class="div-content mb-3">
					<h4>Mascotas</h4>
					<p class="mb-0">Registro</p>
					<p class="mb-0">Patologias</p>
					<p class="mb-0">Seguridad</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 col-xs-12 m-2 form-group div-info shadow">
			<a href="#" class="mr-1">
				<div class="div-header" style="background: url(<?= base_url() ?>assets/img/iconos/Propietarios/directorio.jpg) no-repeat center center; background-size: cover;"></div>
				<div class="div-icon" style="background: url(<?= base_url() ?>assets/img/iconos/AuditoriaGeneral.png) no-repeat center center; background-size: 20%;"></div>
				<div class="div-content mb-3">
					<h4>Directorio telefonico</h4>
					<p class="mb-0">Emergencias</p>
					<p class="mb-0">Lista de direcciones</p>
					<p class="mb-0">Información de interes</p>
				</div>
			</a>
		</div>
	</div>
</div>