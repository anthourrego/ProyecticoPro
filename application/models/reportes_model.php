<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class reportes_Model extends CI_Model {

	function reserva($consecutivo){
		$strHabitaciones = '';
		$contador = 1;
		$ultimoTipoProducto = '';
		$adicionales = [];
		$arrAdicionales = [];

		$DetalleReserva = $this->db->query("SELECT
			HR.Reserva,
			Creador.nombre AS Usuario,
			FORMAT(HR.FechaSistema,'dd/MM/yyyy hh:mm:ss') AS FechaHora,
			FORMAT(HR.FechaIngresoReal,'dd/MM/yyyy hh:mm:ss') AS CheckIn,
			FORMAT(HR.FechaSalidaReal,'dd/MM/yyyy hh:mm:ss') AS CheckOut,
			0 AS Noches,
			ES.Entrada AS Llegada,
			ES.Salida AS Salida,
			CASE WHEN HR.Transporte = 'S' THEN 'Sí' ELSE 'No' END AS Transporte,
			HR.HoraTransporte,

			HR.Observacion,

			FORMAT(HR.FechaSistema,'dd/MM/yyyy') AS Fecha,
			(SELECT
				COUNT(TR3.Id)
			FROM Reserva R3
			LEFT JOIN TerceroReserva TR3 ON R3.ReservaId = TR3.ReservaId
			WHERE R3.Estado <> 'I'
			AND R3.HeadReservaId = HR.HeadReservaId
			AND ( (TR3.TerceroId IS NOT NULL AND TR3.Tipo IS NULL) OR (TR3.Tipo IS NOT NULL) )
			) AS NumeAcomp,

			T.TerceroID AS DocumentoTitular,
			T.digitverif AS DV,
			T.nombre AS Titular,

			T.NOMBRuno AS NOMBRuno,
			T.NOMBRdos AS NOMBRdos,
			T.APELLuno AS APELLuno,
			T.APELLdos AS APELLdos,
			T.FechaNacim AS FechaNacim,

			TD.nombre AS TipoIdentificacion,
			T.razonsocia AS RazonSocial,
			T.NombrComer AS NombreComercial,
			T.Email,
			T.Celular,
			T.Sexo,
			T.Direccion,
			C.nombre AS Ciudad,
			B.nombre AS Barrio,
			Dpto.nombre AS Departamento,
			P.nombre AS Pais,
			Z.nombre AS Zona,
			T.Telefono,
			TF.TerceroID AS DocumentoFacturado,
			TF.nombre AS TerceroFacturado,
			TR.TerceroID AS DocumentoReferencia,
			TR.nombre AS TerceroReferencia,

			(SELECT SUM(Q1.Total) FROM (
				SELECT (
					RD2.ValorAdulto * (SELECT COUNT(TR2.ReservaId) AS Cantidad FROM TerceroReserva TR2 WHERE TR2.ReservaId = R2.ReservaId AND Tipo = 'A')
					+ RD2.ValorJoven * (SELECT COUNT(TR2.ReservaId) AS Cantidad FROM TerceroReserva TR2 WHERE TR2.ReservaId = R2.ReservaId AND Tipo = 'J') 
					+ RD2.ValorNino * (SELECT COUNT(TR2.ReservaId) AS Cantidad FROM TerceroReserva TR2 WHERE TR2.ReservaId = R2.ReservaId AND Tipo = 'N')
					+ RD2.ValorBebe * (SELECT COUNT(TR2.ReservaId) AS Cantidad FROM TerceroReserva TR2 WHERE TR2.ReservaId = R2.ReservaId AND Tipo = 'B')
					+ RD2.ValorDiscapacitado * (SELECT COUNT(TR2.ReservaId) AS Cantidad FROM TerceroReserva TR2 WHERE TR2.ReservaId = R2.ReservaId AND Tipo = 'D')
					+ RD2.Valor
				) AS Total
				FROM HeadReserva HR2
				LEFT JOIN Reserva R2 ON HR2.HeadReservaId = R2.HeadReservaId AND R2.Estado <> 'I'
				LEFT JOIN ReservaDia RD2 ON R2.ReservaId =  RD2.ReservaId
				WHERE HR2.HeadReservaId = HR.HeadReservaId)
			Q1) AS Total

			FROM HeadReserva as HR
				LEFT JOIN Tercero  AS T ON T.TerceroID = HR.TerceroId 
				LEFT JOIN tipodocu AS TD ON TD.tipodocuid = T.tipodocuid 
				LEFT JOIN Ciudad AS C ON C.ciudadid = T.ciudadid
				LEFT JOIN Dpto ON Dpto.dptoid = t.dptoid
				LEFT JOIN Barrio AS B ON B.barrioid = T.barrioid
				LEFT JOIN Pais AS P ON P.paisid = T.paisid
				LEFT JOIN Zona AS Z ON Z.zonaid = T.zonaid
				LEFT JOIN Tercero AS TF ON TF.TerceroID = HR.TerceroFacturaId
				LEFT JOIN Tercero AS TR ON TR.TerceroID = HR.TerceroReferencia
				LEFT JOIN tipodocu AS TPTR ON TR.tipodocuid = TPTR.tipodocuid
				LEFT JOIN Segur AS Creador ON Creador.usuarioId = HR.UsuarioId
				LEFT JOIN (SELECT
				HR1.HeadReservaId
					,MIN(RD1.Fecha) AS Entrada
					,MAX(RD1.Fecha) AS Salida
				FROM HeadReserva HR1
				LEFT JOIN Reserva R1 ON HR1.HeadReservaId = R1.HeadReservaId AND R1.Estado <> 'I'
				LEFT JOIN ReservaDia RD1 ON R1.ReservaId = RD1.ReservaId
				GROUP BY HR1.HeadReservaId) ES ON HR.HeadReservaId = ES.HeadReservaId
			WHERE HR.HeadReservaId = '$consecutivo'
		")->result();

		$habitaciones = $this->db->query("SELECT
			R.ReservaId
			,TP.nombre AS TipoProducto
			,HP.tipoproductoid
		FROM Reserva R
			LEFT JOIN Producto P ON R.HabitacionId = P.productoid
			LEFT JOIN HeadProd HP ON P.headprodid = HP.headprodid
			LEFT JOIN TipoProducto TP ON HP.tipoproductoid = TP.tipoproductoid
		WHERE R.HeadReservaId = '$consecutivo'
			AND R.Estado <> 'I'")->result();

		foreach ($habitaciones as $key => $value) {

			$adicionales[] = $value->ReservaId;

			if($value->tipoproductoid != $ultimoTipoProducto){
				$ultimoTipoProducto = $value->tipoproductoid;
				$contador = 1;
			}else{
				$contador++;
			}

			if( ($key + 1 == count($habitaciones)) || ($habitaciones[$key + 1]->tipoproductoid != $ultimoTipoProducto) ){
				if($strHabitaciones != ''){
					$strHabitaciones .= '<br/>';
				}
				if($contador > 1){
					$strHabitaciones .= $contador . ' x';
				}
				$strHabitaciones .= ' ' . $value->TipoProducto;

				$arrAdicionales = $this->db->query("SELECT
					Tipo
					,COUNT(Tipo) AS Cantidad
				FROM TerceroReserva
				WHERE Tipo IS NOT NULL AND ReservaId IN ('".implode("','", $adicionales)."')
				GROUP BY Tipo
				ORDER BY Tipo ASC")->result();

				if(count($arrAdicionales) > 0){
					$strHabitaciones .= '<small>';
					foreach ($arrAdicionales as $key2 => $value2) {
						$strHabitaciones .= '<br/>+ ';
						$strHabitaciones .= $value2->Cantidad;
						switch ($value2->Tipo) {
							case 'A':
								if($value2->Cantidad > 1){
									$strHabitaciones .= ' Adultos adicionales';
								}else{
									$strHabitaciones .= ' Adulto adicional';
								}
							break;
							case 'J':
								if($value2->Cantidad > 1){
									$strHabitaciones .= ' Jovenes adicionales';
								}else{
									$strHabitaciones .= ' joven adicional';
								}
							break;
							case 'N':
								if($value2->Cantidad > 1){
									$strHabitaciones .= ' Niños adicionales';
								}else{
									$strHabitaciones .= ' Niño adicional';
								}
							break;
							case 'B':
								if($value2->Cantidad > 1){
									$strHabitaciones .= ' Bebés adicionales';
								}else{
									$strHabitaciones .= ' Bebé adicional';
								}
							break;
							case 'D':
								if($value2->Cantidad > 1){
									$strHabitaciones .= ' Discapacitados adicionales';
								}else{
									$strHabitaciones .= ' Discapacitado adicional';
								}
							break;
						}
					}
					$strHabitaciones .= '</small>';
				}

				$adicionales = [];
			}
		}

		$Empresa = $this->db->query("SELECT
			NIT
			,nombre AS Empresa
			,CASE regimen WHEN 'C' THEN 'Régimen Común' WHEN 'S' THEN 'Régimen Simple' END AS Regimen
		FROM Empresa")->row();

		$usuarioActual = $this->db->query("SELECT nombre FROM segur WHERE usuarioId = '".$this->session->userdata('id')."'")->row();

		return array($DetalleReserva, $strHabitaciones, $Empresa, $usuarioActual);
	}

	function estadoCuenta($HeadReservaId){
		$consulta = "SELECT
			HP2.nombre AS Habitacion
			,CR.Fecha
			,SUM(CR.Cantidad) AS Cantidad
			,HP.nombre AS Concepto
			,CR.Valor AS ValorUnitario
			,SUM(CR.Valor) AS ValorTotal
		FROM ConsumoReserva CR
		LEFT JOIN Reserva R ON CR.ReservaId = R.ReservaId
		LEFT JOIN Producto P ON CR.ProductoId = P.productoid
		LEFT JOIN HeadProd HP ON P.headprodid = HP.headprodid

		LEFT JOIN Producto P2 ON R.HabitacionId = P2.productoid
		LEFT JOIN HeadProd HP2 ON P2.headprodid = HP2.headprodid

		WHERE R.HeadReservaId = '$HeadReservaId'
		AND CR.Facturado = 0 ";

		if(isset($_GET['selecciones'])){
			$selecciones = $_GET['selecciones'];
			$selecciones = json_decode($selecciones);
			if(count($selecciones) > 0){
				$selecciones = "('".implode("','", $selecciones)."')";
				$consulta .= " AND CR.ConsumoId IN ".$selecciones;
			}
		}

		$consulta .= "GROUP BY HP2.nombre
			,CR.Fecha
			,HP.nombre
			,CR.Valor

		ORDER BY HP2.nombre, CR.Fecha";

		$consulta = $this->db->query($consulta)->result();

		$strEstadoCuenta = "<table style='width:100%;'>
			<thead>
				<tr>
					<th style='width:10%;'>Habitación</th>
					<th style='width:10%;'>Fecha</th>
					<th style='width:10%;'>Cant.</th>
					<th>Concepto</th>
					<th style='width:10%;' class='nDerecha'>Vr. Unitario</th>
					<th style='width:10%;' class='nDerecha'>Vr. Total</th>
				</tr>
			</thead>
			<tbody>";
			if(count($consulta) > 0){
				foreach ($consulta as $key => $value) {
					$strEstadoCuenta .= "<tr>
						<td>".$value->Habitacion."</td>
						<td>".$value->Fecha."</td>
						<td class='nDerecha'>".number_format($value->Cantidad, 3)."</td>
						<td>".$value->Concepto."</td>
						<td class='nDerecha'>$ ".number_format($value->ValorUnitario)."</td>
						<td class='nDerecha'>$ ".number_format($value->ValorTotal)."</td>
					</tr>";
				}
			}
			$strEstadoCuenta .= "</tbody>
			</table>";

		return $strEstadoCuenta;
	}

	function totalEstadoCuenta($HeadReservaId){
		$consulta = "SELECT
			SUM(CASE WHEN CR.Tipo <> 'S' THEN CR.Valor ELSE 0 END) AS AlojamientoConsumos
			,SUM(CR.Iva) AS Iva
			,SUM(CR.Valor) AS ValorTotal
			,0 AS Anticipos
			,SUM(CR.Valor) - 0 AS TotalCancelar
		FROM ConsumoReserva CR
		LEFT JOIN Reserva R ON CR.ReservaId = R.ReservaId
		WHERE R.HeadReservaId = '$HeadReservaId'
		AND CR.Facturado = 0";

		if(isset($_GET['selecciones'])){
			$selecciones = $_GET['selecciones'];
			$selecciones = json_decode($selecciones);
			if(count($selecciones) > 0){
				$selecciones = "('".implode("','", $selecciones)."')";
				$consulta .= " AND CR.ConsumoId IN ".$selecciones;
			}
		}

		return $this->db->query($consulta)->row();
	}
}

?>