<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Reportes_Model'));
		$this->load->helper('date');
	}

	function imprimirReserva($consecutivo){
		$data = $this->Reportes_Model->reserva($consecutivo);
		$variables['reporte'] = 'reportes/'.$this->session->userdata('NIT').'/Reservas';
		$variables['data'] = $data;

		$variables['Reserva'] = $data[0][0]->Reserva;
		$variables['Usuario'] = $data[0][0]->Usuario;
		$variables['UsuarioActual'] = $data[3]->nombre;
		$variables['FechaHora'] = $data[0][0]->FechaHora;
		$variables['Noches'] = $data[0][0]->Noches;
		$variables['Llegada'] = $data[0][0]->Llegada;
		$variables['Salida'] = $data[0][0]->Salida;
		$variables['Transporte'] = $data[0][0]->Transporte;
		$variables['HoraTransporte'] = $data[0][0]->HoraTransporte;
		
		$variables['Observacion'] = $data[0][0]->Observacion;

		$variables['Fecha'] = $data[0][0]->Fecha;
		$variables['NumeAcomp'] = $data[0][0]->NumeAcomp;

		$variables['DocumentoTitular'] = $data[0][0]->DocumentoTitular;
		$variables['DV'] = $data[0][0]->DV;
		$variables['Titular'] = $data[0][0]->Titular;

		$variables['NOMBRuno'] = $data[0][0]->NOMBRuno;
		$variables['NOMBRdos'] = $data[0][0]->NOMBRdos;
		$variables['APELLuno'] = $data[0][0]->APELLuno;
		$variables['APELLdos'] = $data[0][0]->APELLdos;
		$variables['FechaNacim'] = $data[0][0]->FechaNacim;

		$variables['TipoIdentificacion'] = $data[0][0]->TipoIdentificacion;
		$variables['RazonSocial'] = $data[0][0]->RazonSocial;
		$variables['NombreComercial'] = $data[0][0]->NombreComercial;
		$variables['Email'] = $data[0][0]->Email;
		$variables['Celular'] = $data[0][0]->Celular;
		$variables['Sexo'] = $data[0][0]->Sexo;
		$variables['Direccion'] = $data[0][0]->Direccion;
		$variables['Ciudad'] = $data[0][0]->Ciudad;
		$variables['Barrio'] = $data[0][0]->Barrio;
		$variables['Departamento'] = $data[0][0]->Departamento;
		$variables['Pais'] = $data[0][0]->Pais;
		$variables['Zona'] = $data[0][0]->Zona;
		$variables['Telefono'] = $data[0][0]->Telefono;
		$variables['DocumentoFacturado'] = $data[0][0]->DocumentoFacturado;
		$variables['TerceroFacturado'] = $data[0][0]->TerceroFacturado;
		$variables['DocumentoReferencia'] = $data[0][0]->DocumentoReferencia;
		$variables['TerceroReferencia'] = $data[0][0]->TerceroReferencia;
		$variables['Total'] = number_format($data[0][0]->Total);
		$variables['DetalleReserva'] = $data[1];
		$variables['NIT'] = $data[2]->NIT;
		$variables['Empresa'] = $data[2]->Empresa;
		$variables['Regimen'] = $data[2]->Regimen;

		$this->load->view('UI/report_view', $variables);
	}

	function imprimirCheckIn($consecutivo){
		$data = $this->Reportes_Model->reserva($consecutivo);
		$variables['reporte'] = 'reportes/'.$this->session->userdata('NIT').'/CheckIn';
		$variables['data'] = $data;

		$variables['Reserva'] = $data[0][0]->Reserva;
		$variables['Usuario'] = $data[0][0]->Usuario;
		$variables['UsuarioActual'] = $data[3]->nombre;
		$variables['FechaHora'] = $data[0][0]->FechaHora;
		$variables['CheckIn'] = $data[0][0]->CheckIn;
		$variables['Noches'] = $data[0][0]->Noches;
		$variables['Llegada'] = $data[0][0]->Llegada;
		$variables['Salida'] = $data[0][0]->Salida;
		$variables['Transporte'] = $data[0][0]->Transporte;
		$variables['HoraTransporte'] = $data[0][0]->HoraTransporte;
		
		$variables['Observacion'] = $data[0][0]->Observacion;

		$variables['Fecha'] = $data[0][0]->Fecha;
		$variables['NumeAcomp'] = $data[0][0]->NumeAcomp;

		$variables['DocumentoTitular'] = $data[0][0]->DocumentoTitular;
		$variables['DV'] = $data[0][0]->DV;
		$variables['Titular'] = $data[0][0]->Titular;

		$variables['NOMBRuno'] = $data[0][0]->NOMBRuno;
		$variables['NOMBRdos'] = $data[0][0]->NOMBRdos;
		$variables['APELLuno'] = $data[0][0]->APELLuno;
		$variables['APELLdos'] = $data[0][0]->APELLdos;
		$variables['FechaNacim'] = $data[0][0]->FechaNacim;

		$variables['TipoIdentificacion'] = $data[0][0]->TipoIdentificacion;
		$variables['RazonSocial'] = $data[0][0]->RazonSocial;
		$variables['NombreComercial'] = $data[0][0]->NombreComercial;
		$variables['Email'] = $data[0][0]->Email;
		$variables['Celular'] = $data[0][0]->Celular;
		$variables['Sexo'] = $data[0][0]->Sexo;
		$variables['Direccion'] = $data[0][0]->Direccion;
		$variables['Ciudad'] = $data[0][0]->Ciudad;
		$variables['Barrio'] = $data[0][0]->Barrio;
		$variables['Departamento'] = $data[0][0]->Departamento;
		$variables['Pais'] = $data[0][0]->Pais;
		$variables['Zona'] = $data[0][0]->Zona;
		$variables['Telefono'] = $data[0][0]->Telefono;
		$variables['DocumentoFacturado'] = $data[0][0]->DocumentoFacturado;
		$variables['TerceroFacturado'] = $data[0][0]->TerceroFacturado;
		$variables['DocumentoReferencia'] = $data[0][0]->DocumentoReferencia;
		$variables['TerceroReferencia'] = $data[0][0]->TerceroReferencia;
		$variables['Total'] = number_format($data[0][0]->Total);
		$variables['DetalleReserva'] = $data[1];
		$variables['NIT'] = $data[2]->NIT;
		$variables['Empresa'] = $data[2]->Empresa;
		$variables['Regimen'] = $data[2]->Regimen;

		$this->load->view('UI/report_view', $variables);
	}

	function imprimirEstadoCuenta($consecutivo){
		$data = $this->Reportes_Model->reserva($consecutivo);
		$EstadoCUenta = $this->Reportes_Model->estadoCuenta($consecutivo);

		$totalEstadoCuenta = $this->Reportes_Model->totalEstadoCuenta($consecutivo);

		$variables['reporte'] = 'reportes/'.$this->session->userdata('NIT').'/EstadoCuenta';
		$variables['data'] = $data;

		$variables['Reserva'] = $data[0][0]->Reserva;
		$variables['Usuario'] = $data[0][0]->Usuario;
		$variables['UsuarioActual'] = $data[3]->nombre;
		$variables['FechaHora'] = $data[0][0]->FechaHora;
		$variables['CheckIn'] = $data[0][0]->CheckIn;
		$variables['Noches'] = $data[0][0]->Noches;
		$variables['Llegada'] = $data[0][0]->Llegada;
		$variables['Salida'] = $data[0][0]->Salida;
		$variables['Transporte'] = $data[0][0]->Transporte;
		$variables['HoraTransporte'] = $data[0][0]->HoraTransporte;
		
		$variables['Observacion'] = $data[0][0]->Observacion;

		$variables['Fecha'] = $data[0][0]->Fecha;
		$variables['NumeAcomp'] = $data[0][0]->NumeAcomp;

		$variables['DocumentoTitular'] = $data[0][0]->DocumentoTitular;
		$variables['DV'] = $data[0][0]->DV;
		$variables['Titular'] = $data[0][0]->Titular;

		$variables['NOMBRuno'] = $data[0][0]->NOMBRuno;
		$variables['NOMBRdos'] = $data[0][0]->NOMBRdos;
		$variables['APELLuno'] = $data[0][0]->APELLuno;
		$variables['APELLdos'] = $data[0][0]->APELLdos;
		$variables['FechaNacim'] = $data[0][0]->FechaNacim;

		$variables['TipoIdentificacion'] = $data[0][0]->TipoIdentificacion;
		$variables['RazonSocial'] = $data[0][0]->RazonSocial;
		$variables['NombreComercial'] = $data[0][0]->NombreComercial;
		$variables['Email'] = $data[0][0]->Email;
		$variables['Celular'] = $data[0][0]->Celular;
		$variables['Sexo'] = $data[0][0]->Sexo;
		$variables['Direccion'] = $data[0][0]->Direccion;
		$variables['Ciudad'] = $data[0][0]->Ciudad;
		$variables['Barrio'] = $data[0][0]->Barrio;
		$variables['Departamento'] = $data[0][0]->Departamento;
		$variables['Pais'] = $data[0][0]->Pais;
		$variables['Zona'] = $data[0][0]->Zona;
		$variables['Telefono'] = $data[0][0]->Telefono;
		$variables['DocumentoFacturado'] = $data[0][0]->DocumentoFacturado;
		$variables['TerceroFacturado'] = $data[0][0]->TerceroFacturado;
		$variables['DocumentoReferencia'] = $data[0][0]->DocumentoReferencia;
		$variables['TerceroReferencia'] = $data[0][0]->TerceroReferencia;
		$variables['Total'] = number_format($data[0][0]->Total);
		$variables['DetalleReserva'] = $data[1];
		$variables['EstadoCuenta'] = $EstadoCUenta;
		$variables['NIT'] = $data[2]->NIT;
		$variables['Empresa'] = $data[2]->Empresa;
		$variables['Regimen'] = $data[2]->Regimen;

		$variables['AlojamientoConsumos'] = number_format($totalEstadoCuenta->AlojamientoConsumos);
		$variables['Iva'] = number_format($totalEstadoCuenta->Iva);
		$variables['ValorTotal'] = number_format($totalEstadoCuenta->ValorTotal);
		$variables['Anticipos'] = number_format($totalEstadoCuenta->Anticipos);
		$variables['TotalCancelar'] = number_format($totalEstadoCuenta->TotalCancelar);

		$this->load->view('UI/report_view', $variables);
	}

}
?>