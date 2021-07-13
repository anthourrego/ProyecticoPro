<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilesAcceso extends MY_CRUD_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login") || !in_array(2003, $this->session->userdata('SEGUR')) || !in_array(2004, $this->session->userdata('SEGUR'))){
			redirect(base_url());
		}

		$this->load->model(array('Administrativo/Utilidades/PerfilesAcceso_model'));
	}

	function permisos($id, $tipo = null){
		$contenido['content_page'] = 'Administrativo/Utilidades/vPerfilesAcceso';
		$contenido['css_lib'] = array(
			'gijgo-Tree/gijgo.min.css'

			,'dataTables/datatables.min.css'
			,'dataTables/dataTables.bootstrap4.min.css'
		);
		$contenido['js_lib'] = array(
			'gijgo-Tree/gijgo.min.js'

			,'dataTables/jquery.dataTables.min.js'
			,'dataTables/dataTables.bootstrap4.min.js'
		);
		$contenido['script_adicional'] = array(
			'personalizados/Administrativo/Utilidades/jsPerfilesAcceso.js'
		);
		$contenido['titulo'] = 'Perfiles de Acceso';

		$perfil = ($tipo != null) ? $this->PerfilesAcceso_model->cargarPerfilesAcceso($id, "perfilid", "perfil")[0]->nombre : $this->PerfilesAcceso_model->cargarPerfilesAcceso($id, "UsuarioId", "SEGUR") ;
		if($tipo == null){
			$perfil = $perfil[0]->nombre;
		}
		$contenido['perfil'] = $id . ' - ' . $perfil;

		$contenido['perfilesTercero'] = array(
			'1' => 'Tipo Identificación'
			,'2' => 'Código de Barras'
			,'92' => 'Estado'
			,'3' => 'Razón Social'
			,'90' => 'Nombre Comercial'
			,'4' => 'Nombres y Apellidos'
			,'5' => 'Emails'
			,'6' => 'Celular'
			,'7' => 'Estado Civil'
			,'8' => 'Sexo'
			,'9' => 'Número de Tarjeta'
			,'80' => 'Tipo Tercero'
			,'10' => 'Dirección Residencia'
			,'11' => 'Ciudad Residencia'
			,'12' => 'Barrio Residencia'
			,'13' => 'Departamento Residencia'
			,'14' => 'País Residencia'
			,'15' => 'Zona Residencia'
			,'16' => 'Teléfonos Residencia'
			,'17' => 'Dirección Correspondencia'
			,'18' => 'Ciudad Correspondencia'
			,'19' => 'Barrio Correspondencia'
			,'20' => 'Departamento Correspondencia'
			,'21' => 'País Correspondencia'
			,'22' => 'Teléfonos Correspondencia'
			,'43' => 'Tipo Régimen'
			,'49' => 'Actividad Económica'
			,'34' => 'Fecha Nacimiento'
			,'35' => 'Ciudad Nacimiento'
			,'36' => 'Profesión'
			,'37' => 'Ocupación'
			,'40' => 'Número Hijos'
			,'41' => 'Autoriza Utilizar Información Fines Comerciales'
			,'85' => 'Almacén'
			,'39' => 'Vendedor'
			,'88' => 'Clasificación Cliente'
			,'89' => 'Responsabilidades Fiscales'
			,'23' => 'Empresa'
			,'24' => 'Dirección Empresa'
			,'25' => 'Ciudad Empresa'
			,'26' => 'Barrio Empresa'
			,'27' => 'Departamento Empresa'
			,'28' => 'País Empresa'
			,'29' => 'Teléfonos Empresa'
			,'30' => 'Cargo'
			,'31' => 'Contacto Empresa'
			,'32' => 'Tipo Contacto Empresa'
			,'33' => 'Sector Económico Empresa'
			,'52' => 'Tarifa Retención en la Fuente'
			,'53' => 'Liquida Retención en la Fuente Sobre Base'
			,'51' => 'Tarifa Retención IVA'
			,'87' => 'NO Liquidar IVA'
			,'47' => 'Días Crédito'
			,'46' => 'Cupo Crédito'
			,'44' => 'Tipo Cartera'
			,'81' => 'Bloqueo por Monto'
			,'82' => 'Bloqueo por Vencimiento'
			,'83' => 'Aplicar Bloqueos a Pedidos'
			,'84' => 'Lista de Precios'
			,'54' => 'Días Crédito Compras'
			,'45' => 'Descuentos Financieros'
			,'50' => 'Tarifas Retención ICA Compras'
			,'55' => 'Información Adicional'
			,'56' => 'Foto'
			,'61' => 'Razón Social Sucursal'
			,'62' => 'Dirección Sucursal'
			,'63' => 'Ciudad Sucursal'
			,'64' => 'Barrio Sucursal'
			,'65' => 'Departamento Sucursal'
			,'66' => 'País Sucursal'
			,'67' => 'Zona Sucursal'
			,'68' => 'Teléfono Sucursal'
			,'69' => 'Email Sucursal'
			,'70' => 'Vendedor Sucursal'
			,'91' => 'Tarifa Retención ICA'
			,'72' => 'Nombre Contacto'
			,'73' => 'Dependencia Contacto'
			,'74' => 'Cargo Contacto'
			,'75' => 'Fecha de Nacimiento Contacto'
			,'76' => 'Email Contacto'
			,'77' => 'Teléfono Contacto'
			,'78' => 'Celular Contacto'
			,'79' => 'Gestión Cartera'
			,'95' => 'Adjuntos'
		);

		if($tipo != null){
			$SEGUR 		= $this->PerfilesAcceso_model->permisos($id, "PerfilId");
			$TERCCrear 	= $this->PerfilesAcceso_model->permisosTERC($id, "perfilid", "crear");
			$TERCModif 	= $this->PerfilesAcceso_model->permisosTERC($id, "perfilid", "modificar");
			$TERCElimi 	= $this->PerfilesAcceso_model->permisosTERC($id, "perfilid", "eliminar");
		}else{
			$SEGUR 		= $this->PerfilesAcceso_model->permisos($id, "UsuarioId");
			$TERCCrear 	= $this->PerfilesAcceso_model->permisosTERC($id, "usuarioid", "crear");
			$TERCModif 	= $this->PerfilesAcceso_model->permisosTERC($id, "usuarioid", "modificar");
			$TERCElimi 	= $this->PerfilesAcceso_model->permisosTERC($id, "usuarioid", "eliminar");
		}
		$contenido['permisos'] = array(
			'SEGUR' => $SEGUR
			,'TERCCrear' => $TERCCrear
			,'TERCModif' => $TERCModif
			,'TERCElimi' => $TERCElimi
		);

		$contenido['id'] = $id;
		$contenido['tipo'] = $tipo;

		if($tipo == null){
			$contenido["breadcrumb"] = [
				["nombre" => "Utilidades", "ruta" => "Administrativo/Utilidades/Menu"]
				,["nombre" => "Usuarios", "ruta" => "Administrativo/Utilidades/SeguridadGeneral"]
				,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
			];
		}else{
			$contenido["breadcrumb"] = [
				["nombre" => "Utilidades", "ruta" => "Administrativo/Utilidades/Menu"]
				,["nombre" => "Creación de Perfiles", "ruta" => "Administrativo/Utilidades/TiposPerfil"]
				,["nombre" => $contenido['titulo'], "ruta" => $this->uri->uri_string]
			];
		}

		$this->load->view('UI/gestion_view', $contenido);
	}

	function guardarPerfilAcceso(){
		if($this->input->is_ajax_request()){
			echo $this->PerfilesAcceso_model->guardarPerfilAcceso();
		}else{
			show_404();
		}
	}
}
?>