<?php if($menu == "Terceros" && in_array(11, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Terceros</p>
		</div>
		<?php if(in_array(1101, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/RegistroClientes">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroClientes.png">
				<p class="texto_config mb-0">Registro Clientes</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1102, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/RegistroProveedores">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroProveedores.png">
				<p class="texto_config mb-0">Registro Proveedores</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1103, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/TipoTercero">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\TipoTercero.png">
				<p class="texto_config mb-0">Tipos de Terceros</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1104, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/CampoAdicional">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CampoAdicional.png">
				<p class="texto_config mb-0">Definición Campos Adicionales</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1105, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/ClasificacionCliente">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ClasificacionCliente.png">
				<p class="texto_config mb-0">Clasificación Clientes</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1106, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Pais">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Pais.png">
				<p class="texto_config mb-0">Países</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1107, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Dpto">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Dpto.png">
				<p class="texto_config mb-0">Departamentos</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1108, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Ciudad">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Ciudad.png">
				<p class="texto_config mb-0">Ciudades</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>	
		<?php if(in_array(1109, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Barrio">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Barrio.png">
				<p class="texto_config mb-0">Barrios</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1110, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Zona">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Zona.png">
				<p class="texto_config mb-0">Zonas</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1111, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Region">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Region.png">
				<p class="texto_config mb-0">Regiones</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1112, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/ActividadEconomica">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ActividadEconomica.png">
				<p class="texto_config mb-0">Actividades Económicas</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1113, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/RegimenContributivo">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegimenContributivo.png">
				<p class="texto_config mb-0">Regímenes Contributivos</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1114, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/SectorEconomico">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\SectorEconomico.png">
				<p class="texto_config mb-0">Sectores Económicos</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1115, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/EstadoCivil">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\EstadoCivil.png">
				<p class="texto_config mb-0">Estado Civil</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1116, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Cargo">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Cargo.png">
				<p class="texto_config mb-0">Cargos</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1117, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Terceros/Profesion">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Profesion.png">
				<p class="texto_config mb-0">Profesiones</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>


<!-- Botones de Parametros de facturación y cartera -->
<?php if($menu == "ParametrosFacturacionCartera" && in_array(12, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Parámetros de facturación y cartera</p>
		</div>
		<?php if(in_array(1201, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/ParametrosFacturacionCartera/ResponsabilidadFiscal">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ResponsabilidadFiscal.png">
				<p class="texto_config mb-0">Responsabilidad Fiscal</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>

<!-- Botones de configuración de PQR -->
<?php if($menu == "PQR" && in_array(13, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">PQR's</p>
		</div>
		<?php if(in_array(1301, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/PQR/EstadoPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\EstadoCivil.png">
				<p class="texto_config mb-0">Estado</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1302, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/PQR/TipoPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Cargo.png">
				<p class="texto_config mb-0">Tipo</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1303, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/PQR/CausaPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroProveedores.png">
				<p class="texto_config mb-0">Causa</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<!-- <div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR/ResponsablePQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Profesion.png">
				<p class="texto_config">Responsable</p>
			</a>
		</div>
		<div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR/SeccionPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\TipoNotaDebito.png">
				<p class="texto_config">Sección</p>
			</a>
		</div>
		<div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR/ProblemaCalidadPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CodiVent.png">
				<p class="texto_config">Problema Calidad</p>
			</a>
		</div>
		<div class="col-md-4 col-lg-3 col-xl-2 form-group">
			<a class="card shadow-sm h-100" href="<?= base_url() ?>Administrativo/PQR/OperacionPQR">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CargarNoche.png">
				<p class="texto_config">Operación</p>
			</a>
		</div> -->
	</div>
</div>
<?php } ?>

<!-- Botones Producto -->
<?php if($menu == "Productos" && in_array(14, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Productos</p>
		</div>
		<!-- <?php if(in_array(1401, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/CcentroCosto">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CentCost.png">
				<p class="texto_config mb-0">Centro Costo</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1402, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cDependencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Dependencias.png">
				<p class="texto_config mb-0">Dependencias</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?> -->

		<?php if(in_array(1406, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cHardware">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Hardware.png">
				<p class="texto_config mb-0">Hardware</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>

		<?php if(in_array(1407, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cSoftware">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Software.png">
				<p class="texto_config mb-0">Software</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>

		<?php if(in_array(1403, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cFamilia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Familia.png">
				<p class="texto_config mb-0">Familia</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1404, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cMarca">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Marca.png">
				<p class="texto_config mb-0">Marcas</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1405, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cEquipo">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\equipos.png">
				<p class="texto_config mb-0">Equipos</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>


		<?php if(in_array(1408, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Productos/cInventario">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\inventarios.png">
				<p class="texto_config mb-0">Inventario</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>

<!-- Botones de Configuración de incidencias -->
<?php if($menu == "Incidencias" && in_array(15, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Incidencias</p>
		</div>
		<?php if(in_array(1501, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/cEstadoIncidencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\EstadoCivil.png">
				<p class="texto_config mb-0">Estado de incidencia</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1502, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/cTipoIncidencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Cargo.png">
				<p class="texto_config mb-0">Tipos de incidencias</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1503, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/cTipoPrioridadIncidencia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\Cargo.png">
				<p class="texto_config mb-0">Tipos de prioridad</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1504, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/cUnidadMedida">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroProveedores.png">
				<p class="texto_config mb-0">Unidades de medida</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1505, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/tipoStop">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroProveedores.png">
				<p class="texto_config mb-0">Tipos de Stop</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1506, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/cTipoActividad">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroProveedores.png">
				<p class="texto_config mb-0">Tipos de actividades</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1507, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Incidencia/cActividadEquipo">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\RegistroProveedores.png">
				<p class="texto_config mb-0">Operaciones de equipo</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>

	</div>
</div>
<?php } ?>

<!-- Botones de Parametros de producción -->
<?php if($menu == "ParametrosProduccion" && in_array(16, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle mt-2">Parámetros de producción</p>
		</div>
		<?php if(in_array(1601, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/ParametrosProduccion/CentrosProduccion">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\CentrosProduccion.png">
				<p class="texto_config mb-0">Áreas de Servicio</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1602, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/ParametrosProduccion/ActividadesProduccion">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\ActividadesProduccion.png">
				<p class="texto_config mb-0">Actividades de Servicio</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1603, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/ParametrosProduccion/AsistentesServicio">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\AsistentesServicio.png">
				<p class="texto_config mb-0">Operarios</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>

<!-- Botones de Parametros de producción -->
<?php if($menu == "Actas" && in_array(18, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle mt-2">Actas</p>
		</div>
		<?php if(in_array(1801, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Actas/TipoReunion">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\InformeExtranjeros.png">
				<p class="texto_config mb-0">Tipo Reunión</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>

<!-- Botones de configuración -->
<?php if($menu == "Configuracion" && in_array(17, $this->session->userdata('SEGUR'))){ ?>
<div class="fondo container-fluid mb-3">
	<div class="row">
		<div class="col-12">
			<p class="txtTitle">Configuración</p>
		</div>
		<?php if(in_array(1701, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/InformacionEmpresa">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\pisos.png">
				<p class="texto_config mb-0">Datos del conjunto</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1702, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/tipoVivienda">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\tipoVivienda.png">
				<p class="texto_config mb-0">Tipos de viviendas</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1703, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/vivienda">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\vivienda.png">
				<p class="texto_config mb-0">Viviendas</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1704, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/cMapa">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\mapa.png">
				<p class="texto_config mb-0">Mapa</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1705, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/tipoVehiculo">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\tipoVehiculo.png">
				<p class="texto_config mb-0">Tipos de vehiculos</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1706, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/tipoServicio">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\tipoServicio.png">
				<p class="texto_config mb-0">Tipos de servicios</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<?php if(in_array(1707, $this->session->userdata('SEGUR'))){ ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/tipoMascota">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\pets.png">
				<p class="texto_config mb-0">Tipos de mascotas</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
		<?php } ?>
		<div class="col-md-4 col-lg-3 col-xl-3 form-group">
			<a class="card card-per h-100" href="<?= base_url() ?>Administrativo/Configuracion/Inicio/iconografia">
				<img class="icon_config" src="<?= base_url() ?>assets\img\iconos\iconos.png">
				<p class="texto_config mb-0">Iconografica</p>
				<p class="txtLow">Configuración</p>
			</a>
		</div>
	</div>
</div>
<?php } ?>