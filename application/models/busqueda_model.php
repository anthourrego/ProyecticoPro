<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda_model extends CI_Model {

	//Vista consulta llamadas

	//Vista registro llamadas - ciudades

	public function consultarProducto($codigo) {
		if(is_numeric($codigo)){
			$sql ="SELECT
			P.productoid as codigo, H.headprodid as headprodid, CONCAT((H.nombre),(' '),(C.nombre)) AS nombre, G.Tipo, G.grupoid Grupo
			FROM HeadProd H
			LEFT JOIN producto P ON H.headprodid = P.headprodid
			LEFT JOIN Color C ON P.colorid = C.colorid
			LEFT JOIN PWEBGrupo G ON H.GrupoWeb = G.GrupoId
			WHERE P.estado = 'A' AND P.productoid = '$codigo'"
			;
			$consulta = $this->db->query($sql);
			return $consulta->result();	
		}else{
			return array();
		}
	}

	public function consultaProducto($codigo) {
		if(is_numeric($codigo)){
			$sql ="SELECT 
						P.productoid, 
						H.nombre 
					FROM HeadProd H
						INNER JOIN Producto P ON H.headprodid = P.headprodid
					WHERE P.productoid = '$codigo'";
			$consulta = $this->db->query($sql)->result();
			
			if(count($consulta) == 1){
				return $consulta;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	public function consultarProductoValidado($codigo, $pedido) {
		if(is_numeric($codigo)){
			$sql ="SELECT
			P.productoid as codigo, H.headprodid as headprodid, CONCAT((H.nombre),(' '),(C.nombre)) AS nombre, G.Tipo, G.grupoid Grupo
			FROM HeadProd H
			LEFT JOIN producto P ON H.headprodid = P.headprodid
			INNER JOIN Pedido Pe ON Pe.productoid = P.productoid
			LEFT JOIN HeadPedi HP ON Pe.pedidoid = Hp.pedidoid
			LEFT JOIN Color C ON P.colorid = C.colorid
			LEFT JOIN PWEBGrupo G ON H.GrupoWeb = G.GrupoId
			WHERE P.estado = 'A' AND Pe.pedidoid = '$pedido' AND P.productoid = '$codigo'"
			;
			$consulta = $this->db->query($sql);
			return $consulta->result();	
		}else{
			return array();
		}
	}

	function detallePedido($pedidoid){
		$sql = "SELECT P.pedidoid, P.ID, P.productoid,
		CASE WHEN G.Tipo = 'M' THEN HPRO.nombre ELSE CONCAT(HPRO.nombre,' ',C.nombre) END AS nombre,
		P.cantidad, P.ancho, P.alto,(CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) AS Fletes, (CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Instalacion, P.valor,
		material = STUFF((SELECT DISTINCT CONCAT(H.nombre,' ',C.nombre) as nombre FROM PWEBMaterialPedido M
			LEFT JOIN Producto PR ON PR.productoid = M.productoid
			LEFT JOIN HeadProd H ON H.headprodid = PR.headprodid
			LEFT JOIN Color C ON PR.colorid = C.colorid
			WHERE M.pedidoid = P.id FOR XML PATH('p')),1, 0, ''),
		(SELECT (CASE WHEN COUNT(*) = 0 THEN 'NO' ELSE 'SI' END) FROM PWEBDetallePedido D
			LEFT JOIN PWEBCampo C ON D.campoid = C.campoId
			WHERE P.id = D.pedidoid AND C.posicion = 'M') AS Motorizado,
		(SELECT (CASE WHEN COUNT(*) = 0 THEN 'NO' ELSE 'SI' END) FROM PWEBDetallePedido D
			LEFT JOIN PWEBCampo C ON D.campoid = C.campoId
			WHERE P.id = D.pedidoid AND C.posicion = 'P') AS Personalizado,
		G.Tipo,
		HPRO.GrupoWeb,
		CP.nombre AS nombrePromocion,
		P.PromocionId,
		PR.nombre AS PresentacionNombre
		FROM PWEBPedido P
		LEFT JOIN PWEBHeadPedi HP ON P.pedidoid = HP.pedidoid
		LEFT JOIN Producto PRO ON P.productoid = PRO.productoid
		LEFT JOIN HeadProd HPRO ON PRO.headprodid = HPRO.headprodid
		LEFT JOIN PWEBGrupo G ON HPRO.GrupoWeb = G.grupoid
		LEFT JOIN Color C ON PRO.colorid = C.colorid
		LEFT JOIN CampanaPromocion CP ON P.PromocionId = CP.PromocionId
		LEFT JOIN Presentacion PR ON P.PresentacionId = PR.PresentacionId
		WHERE HP.pedidoid = '$pedidoid'
		ORDER BY P.id ASC";
		$consulta = $this->db->query($sql);
		$consulta = $consulta->result();
		for ($i=0; $i < count($consulta); $i++) { 
			if($consulta[$i]->PresentacionNombre != null){
				$consulta[$i]->nombre = $consulta[$i]->nombre.' '.$consulta[$i]->PresentacionNombre;
			}
		}
		return $consulta;
	}

	function cabeceraPedido($pedidoid, $conse){
		/*$sql = "SELECT
            HP.pedidoid,
            HP.pedido,
            HP.fecha,
            O.observacion,
            S.nombre AS NombreU,
            T.TerceroID,
            T.nombre,
            (CASE WHEN HP.DirecEntre IS NULL THEN HP.DirecEntre ELSE T.direccion END) AS direccion,
            T.telefono,
            C.nombre AS Ciudad,
            (SELECT SUM(valor) FROM PWEBPedido WHERE pedidoid = HP.pedidoid) AS Total,
            (CASE WHEN HP.FastTime = 1 THEN 'SI' ELSE 'NO' END) AS FastTime,
            HP.usuarioid
        FROM
            PWEBHeadPedi HP
            LEFT JOIN Observaciones O ON HP.pedido = O.documentoid
            LEFT JOIN Segur S ON HP.usuarioid = S.usuarioId
            LEFT JOIN Tercero T ON HP.terceroid = T.TerceroID
            LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid
        WHERE HP.pedidoid = '$pedidoid'";*/
        $sql = "SELECT
            HP.pedidoid,
            HP.pedido,
            HP.fecha,
            O.observacion,
            S.nombre AS NombreU,
            T.TerceroID,
            T.nombre,
            T.telefono,
            C.nombre AS Ciudad,
            (CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) AS Fletes, 
            (CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Instalacion,
            (SELECT SUM(valor) FROM PWEBPedido WHERE pedidoid = HP.pedidoid) + 
			(CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) +  
			(CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Total,
            (CASE WHEN HP.FastTime = 1 THEN 'SI' ELSE 'NO' END) AS FastTime,
            HP.usuarioid,
			HP.vendedorid,
			V.nombre AS Vendedor,
			T.direccion,
			HP.DirecEntre,
			HP.estado,
			HP.fechamodif,
			HP.cotizacion,
			(SELECT SUM(descuento) FROM PWEBPedido WHERE pedidoid = HP.pedidoid) AS Descuento,
			CASE WHEN P.cantidadproductos = P.finalizados THEN 'Finalizado'
                WHEN EFDX.estadosEmpa > 1 THEN 'Parcial'
                WHEN EFDX.estadosEmpa = 1 AND EFDX.estadoEmpa = 'FA' THEN 'Despachado'
                WHEN EFDX.estadosEmpa = 1 AND EFDX.estadoEmpa = 'FA' THEN 'Facturado'
				WHEN HP.Estado = 'CO' AND HP.BloqueoCartera = 'B' THEN 'Cartera'
                WHEN HP.Estado = 'CO' AND HP.BloqueoInventario = 'B' THEN 'Inventario'
                WHEN HP.estado = 'PR' And OP.Pedido Is Null THEN 'Programado'
                WHEN HP.estado = 'PR' And OP.Pedido Is Not Null THEN 'Producción'
                WHEN HP.estado = 'CO' THEN 'Confirmado'
                WHEN HP.estado = 'ED' THEN 'Edición'
                WHEN HP.estado = 'NU' THEN 'Anulado'
                ELSE HP.estado END AS Estado
        FROM
            PWEBHeadPedi HP
            LEFT JOIN Observaciones O ON HP.pedido = O.documentoid AND O.tipo = 'PW'
            LEFT JOIN Segur S ON HP.usuarioid = S.usuarioId
            LEFT JOIN Tercero T ON HP.terceroid = T.TerceroID
            LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid
           	LEFT JOIN Cliente Cl ON T.TerceroID = Cl.TerceroID
			LEFT JOIN Vendedor V ON HP.vendedorid = V.vendedorid
			LEFT JOIN (SELECT H.Pedido FROM HeadOrdeProd H Inner Join OrdeProdOperacion O ON H.OrdeProdId = O.OrdeProdId Inner Join ordeprodlog L ON O.OrdeProdOperacionId = L.ordeprodoperacionid Where H.TipoPedido = 'C' Group By H.Pedido) AS OP ON HP.pedido = OP.pedido
			LEFT JOIN (SELECT H.pedidoid, COUNT(DISTINCT EFD.Tipo) AS estadosEmpa, MIN(EFD.Tipo) AS estadoEmpa 
                    FROM PWEBPedido P 
                    LEFT JOIN PWEBHeadPedi H ON P.pedidoid = H.pedidoid 
                    LEFT JOIN EmpaFactDesp EFD ON P.id = EFD.PedidoId AND EFD.TipoPedido = 'C' AND EFD.Tipo IN (NULL,'DE','FA') 
                GROUP BY H.pedidoid) AS EFDX on HP.pedidoid = EFDX.pedidoid
			LEFT JOIN (SELECT pedidoid, SUM(CASE WHEN Finalizado = 1 THEN 1 ELSE 0 END) AS finalizados, COUNT(id) AS cantidadproductos FROM PWEBPedido GROUP BY pedidoid) AS P ON P.pedidoid = Hp.pedidoid
        WHERE HP.";
        if($conse == 0){
        	$sql .= 'pedidoid';
        }else{
        	$sql .= 'pedido';
        }
        $sql .= " = '$pedidoid' AND T.esCliente = 1";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows()>0) {
			return $consulta->result();
		}else{
			return false;
		}
	}

	public function consultarMaterial($codigo, $grupo) {

		if(is_numeric($codigo)){
			$sql = "
			SELECT P.productoid AS codigo, H.headProdId as headprodid, CONCAT(H.nombre,' ', C.nombre) AS nombre
			FROM Producto P
			left join HeadProd H ON P.headprodid = H.headprodid
			left join Color C ON P.colorid = C.colorid
			inner join PWEBMaterialGrupo M on H.headprodid = M.headprodid
			WHERE P.estado = 'A'
			AND M.grupoid = '$grupo'
			AND P.productoid = '$codigo'
			";
			$consulta = $this->db->query($sql)->result();

			if(count($consulta) == 1){
				return $consulta;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	public function consultarTipoMaterial($codigo) {
		if(is_numeric($codigo)) {
			$sql ="
			SELECT 
			P.productoid,
			H.headprodid,
			CONCAT((H.nombre),(' '),(C.nombre)) AS nombre FROM PWEBMaterialGrupo M
			JOIN HeadProd H ON M.headprodid = H.headprodid
			JOIN Producto P ON P.headprodid = H.headprodid
			LEFT JOIN Color C ON C.colorid = P.colorid
			WHERE P.estado = 'A' AND P.productoid = '$codigo'
			"
			;
			$consulta = $this->db->query($sql)->result();
			
			if(count($consulta) == 1){
				return $consulta;
			}else{
				return 0;
			}
		} else {
			return 0;
		}

	}

	function consultarCuidad($codigo) {

		$sql ="SELECT DISTINCT  r.ciudadid, r.nombre as ciudad, dr.dptoid, dr.nombre as dpto
		FROM  Ciudad r 
		INNER JOIN Dpto dr on dr.dptoid = r.dptoid
		WHERE r.ciudadid = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();		  
	}

  	//Vista registro llamadas - zonas
	public function consultarZona($codigo) {
		$sql ="SELECT z.zonaid, z.nombre from Zona z where z.zonaid  = '$codigo'";
		$consulta = $this->db->query($sql);
		return $consulta->result();		
	}

	public function consultarPedido($codigo) {
		$sql ="SELECT hp.pedidoid, hp.pedido 
		from HeadPedi hp 
		where hp.pedidoid  = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	public function consultarCliente($codigo) {
		$otros = $this->input->post('clientes');
		$sql ="SELECT t.TerceroID, t.nombre 
		from Tercero t 
		where t.TerceroID  = '$codigo'";
		if ($otros != '' && $otros != null)
			$sql.=" AND t.TerceroID NOT IN ($otros)";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarCampana($codigo) {
		$sql ="SELECT c.CampanaId, c.Nombre 
		from Campana c 
		where c.CampanaId  = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarVendedor($codigo) {
		$sql ="SELECT V.vendedorid, V.Nombre, V.estado
		from Vendedor V
		where V.vendedorid  = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarCodigos($tabla, $campo, $condicion) {
		$sql = "
		SELECT LTRIM(".$campo.") Id FROM ".$tabla."
		";
		if ($condicion != "") {
			$sql .= " WHERE ".$condicion;
		}

		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	public function consultarClientes($codigo) {
		$sql ="SELECT t.TerceroID, t.nombre
		where t.TerceroID  = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarNotas($codigo) {
		$sql ="SELECT l.LlamadaId,
		l.Fecha,
		l.Asunto,
		tll.Nombre as Tipo,
		CASE l.Tipo WHEN 'SA' THEN 'Saliente' END AS Clase,
		CASE l.Estado WHEN 'A' THEN 'Abierta' WHEN 'CE' THEN 'Cerrada' END AS Estado,
		l.UsuarioId

		FROM  Tercero t

		INNER JOIN Llamada l on l.TerceroId = t.TerceroID
		LEFT JOIN TipoLlamada tl on tl.TipollamadaId = l.TipollamadaId
		INNER JOIN TipoLlamada tll on tll.TipollamadaId = l.TipollamadaId

		WHERE t.TerceroID = '$codigo' order by l.Estado ASC, l.LlamadaId DESC";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarUsuario($codigo) {
		$sql ="SELECT S.usuarioId, S.nombre 
		from Segur S
		where S.usuarioId  = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarDependencia($codigo) {
		$sql ="SELECT  D.DependenciaId, D.Nombre 
		from Dependencia D
		where D.DependenciaId  = '$codigo'";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function contFacturacion($pedidos) {
		$sql ="SELECT H.Factura 
		,H.Fecha 
		,Sum(F.Valor - F.Descuento) As Valor
		,Sum(F.Iva) As Iva
		,Sum(F.Descuento) As Descuento
		,Sum(F.Cantidad) As Cantidad
		,Max(H.Estado) As Estado 
		From HeadFact H 
			Inner Join Factura F On H.FacturaId = F.FacturaId 
		Where F.Pedido = '$pedidos'
			And F.TipoPedido = 'C'
			And (H.Estado Is Null Or H.Estado <> 'MO')
		Group By H.Factura, H.Fecha
		Order By H.Factura, H.Fecha";

		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	public function contPqrs($pedidos) {
		$sql ="SELECT PQR, PQRId, PedidoId, Pedido, TipoPQR, Fecha, FechaCierre,
		Estado, Asunto, UsuarioId, Solicitud, Producidos, Comerciali, TerceroId,
		Descripcion, DependenciaId, Fabricado, Despachado, Producto, Material,
		Imagen1, Imagen2, Imagen3, EstadoId, TipoPQRId, Costos, ReclamoProveedor,
		Causa, Calidad, Responsable, Operacion, Seccion, OtraCausa, OtraCalidad,
		OtraResponsable, OtraOperacion, OtraSeccion, Devoluciones, ProductoId, OtroCliente 
		FROM HeadPQR
		WHERE Pedido ='$pedidos'";

		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	public function consultarCorrerias($codigo) {
		$vendedor = $this->input->post('vendedor');
		$sql ="SELECT C.correriaid, C.nombre
		FROM Correria C
		WHERE C.correriaid = '$codigo' "
		;
		if ($vendedor != '' && $vendedor != null) {
			$sql .=" AND C.vendedorid = '$vendedor' ";
		}
		$consulta = $this->db->query($sql);
		return $consulta->result();	
	}

	function cabeceraCotizacion($datos){
		$sql ="SELECT HP.pedidoid,
		HP.pedido,
		HP.fecha,
		O.observacion,
		S.nombre AS NombreU,
		T.TerceroID,
		T.nombre,
		T.telefono,
		C.nombre AS Ciudad,
		(CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) AS Fletes, 
		(CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Instalacion,
		(SELECT SUM(valor) FROM PWEBPedido WHERE pedidoid = HP.pedidoid) + 
		(CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) +  
		(CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Total,
		(CASE WHEN HP.FastTime = 1 THEN 'SI' ELSE 'NO' END) AS FastTime,
		HP.usuarioid,
		HP.vendedorid,
		V.nombre AS Vendedor,
		T.direccion,
		HP.DirecEntre,
		HP.estado,
		HP.fechamodif,
		HP.cotizacion,
		(SELECT SUM(descuento) FROM PWEBPedido WHERE pedidoid = HP.pedidoid) AS Descuento,
		CASE WHEN HP.Estado = 'CO' AND HP.BloqueoCartera = 'B' THEN 'Cartera'
		WHEN HP.Estado = 'CO' AND HP.BloqueoInventario = 'B' THEN 'Inventario'
		WHEN HP.estado = 'PR' And OP.Pedido Is Null THEN 'Programado'
		WHEN HP.estado = 'PR' And OP.Pedido Is Not Null THEN 'Producción'
		WHEN HP.estado = 'CO' THEN 'Confirmado'
		WHEN HP.estado = 'ED' THEN 'Edición'
		WHEN HP.estado = 'NU' THEN 'Anulado'
		ELSE HP.estado END AS Estado
		FROM
		PWEBHeadPedi HP
		LEFT JOIN Observaciones O ON HP.pedido = O.documentoid AND O.tipo = 'PW'
		LEFT JOIN Segur S ON HP.usuarioid = S.usuarioId
		LEFT JOIN Tercero T ON HP.terceroid = T.TerceroID
		LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid
		LEFT JOIN Cliente Cl ON T.TerceroID = Cl.TerceroID
		LEFT JOIN Vendedor V ON HP.vendedorid = V.vendedorid
		LEFT JOIN (SELECT H.Pedido FROM HeadOrdeProd H Inner Join OrdeProdOperacion O ON H.OrdeProdId = O.OrdeProdId Inner Join ordeprodlog L ON O.OrdeProdOperacionId = L.ordeprodoperacionid Where H.TipoPedido = 'C' Group By H.Pedido) AS OP ON HP.pedido = OP.pedido
		WHERE HP.cotizacion ='$datos'";

		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function cabeceraCotizaciones($pedidoid, $conse){
		$sql = "SELECT
            HP.CotizacionId AS pedidoid,
            HP.cotizacion AS pedido,
            HP.fecha,
            O.observacion,
            S.nombre AS NombreU,
            T.TerceroID,
            T.nombre,
            T.telefono,
            C.nombre AS Ciudad,
            (CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) AS Fletes, 
            (CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Instalacion,
            (SELECT SUM(valor) FROM Cotizacion WHERE CotizacionId = HP.CotizacionId) + 
			(CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) +  
			(CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Total,
            HP.usuarioid,
			HP.vendedorid,
			V.nombre AS Vendedor,
			T.direccion,
			HP.estado,
			HP.fechamodif,
			(CASE WHEN HP.estado = '' THEN 'Activa' WHEN HP.estado = 'AP' THEN 'Aprobada' WHEN HP.estado = 'RE' THEN 'Rechazada' WHEN HP.estado = 'NU' THEN 'Anulada' ELSE HP.estado END) AS EstadoNombre,
			TNA.nombre AS TipoNoApro,
			HP.TipoNoAproId,
			(SELECT SUM(descuento) FROM cotizacion WHERE CotizacionId = HP.CotizacionId) AS Descuento
        FROM
            HeadCoti HP
            LEFT JOIN Observaciones O ON '".$this->session->userdata('almacen')."-'+HP.cotizacion = O.documentoid AND O.tipo = 'CT'
            LEFT JOIN Segur S ON HP.usuarioid = S.usuarioId
            LEFT JOIN Tercero T ON HP.terceroid = T.TerceroID
            LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid
           	LEFT JOIN Cliente Cl ON T.TerceroID = Cl.TerceroID
			LEFT JOIN Vendedor V ON HP.vendedorid = V.vendedorid
			LEFT JOIN TipoNoApro TNA ON Hp.TipoNoAproId = TNA.tiponoaproid
        WHERE HP.";
        if($conse == 0){
        	$sql .= 'CotizacionId';
        }else{
        	$sql .= 'Cotizacion';
        }
        $sql .= " = '$pedidoid' AND T.esCliente = 1";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows()>0) {
			return $consulta->result();
		}else{
			return false;
		}
	}

	function detalleCotizacion($pedidoid){
		$sql = "SELECT P.CotizacionId AS pedidoid, P.ID, P.productoid,
		CASE WHEN G.Tipo = 'M' THEN HPRO.nombre ELSE CONCAT(HPRO.nombre,' ',C.nombre) END AS nombre,
		P.cantidad, P.ancho, P.alto, (CASE WHEN HP.Fletes IS NULL THEN '0' ELSE HP.Fletes END) AS Fletes, 
            (CASE WHEN HP.Instalacion IS NULL THEN '0' ELSE HP.Instalacion END) AS Instalacion, P.valor,
		material = STUFF((SELECT DISTINCT CONCAT(H.nombre,' ',C.nombre) as nombre FROM MaterialCotizacion M
			LEFT JOIN Producto PR ON PR.productoid = M.productoid
			LEFT JOIN HeadProd H ON H.headprodid = PR.headprodid
			LEFT JOIN Color C ON PR.colorid = C.colorid
			WHERE M.id = P.id FOR XML PATH('p')),1, 0, ''),
		(SELECT (CASE WHEN COUNT(*) = 0 THEN 'NO' ELSE 'SI' END) FROM DetalleCotizacion D
			LEFT JOIN PWEBCampo C ON D.campoid = C.campoId
			WHERE P.id = D.id AND C.posicion = 'M') AS Motorizado,
		(SELECT (CASE WHEN COUNT(*) = 0 THEN 'NO' ELSE 'SI' END) FROM DetalleCotizacion D
			LEFT JOIN PWEBCampo C ON D.campoid = C.campoId
			WHERE P.id = D.id AND C.posicion = 'P') AS Personalizado,
		G.Tipo,
		HPRO.GrupoWeb,
		CP.nombre AS nombrePromocion,
		P.PromocionId
		FROM Cotizacion P
		LEFT JOIN HeadCoti HP ON P.CotizacionId = HP.CotizacionId
		LEFT JOIN Producto PRO ON P.productoid = PRO.productoid
		LEFT JOIN HeadProd HPRO ON PRO.headprodid = HPRO.headprodid
		LEFT JOIN PWEBGrupo G ON HPRO.GrupoWeb = G.grupoid
		LEFT JOIN Color C ON PRO.colorid = C.colorid
		LEFT JOIN CampanaPromocion CP ON P.PromocionId = CP.PromocionId
		WHERE HP.CotizacionId = '$pedidoid'
		ORDER BY P.id ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function detalleOrden($pedidos){
		$sql = "SELECT H.OrdeProdId 
		,Max(H.NumerOrden) AS NumerOrden 
		,Max(H.Fecha) AS Fecha
		,Max(H.Estado) AS Estado 
		,Max(CASE WHEN H.Estado = 'FI' THEN L.fin Else '1900-01-01' END) AS FechaFin
		FROM HeadOrdeProd H
		INNER JOIN OrdeProdOperacion O On H.OrdeProdId = O.OrdeProdId 
		LEFT JOIN OrdeProdLog L On O.OrdeProdOperacionId = L.OrdeProdOperacionId
		WHERE H.Pedido = '$pedidos'
		AND H.TipoPedido = 'C'
		AND (H.Estado IS NULL OR H.Estado NOT IN('NU','MO'))
		GROUP BY H.OrdeProdId 
		Union All 
		SELECT H.OrdeProdId 
		,Max(H.NumerOrden) AS NumerOrden 
		,Max(H.Fecha) AS Fecha
		,Max(H.Estado) AS Estado 
		,Max(CASE WHEN H.Estado = 'FI' THEN L.fin Else '1900-01-01' END) AS FechaFin
		FROM HeadOrdeProdCerrado H
		INNER JOIN OrdeProdOperacionCerrado O On H.OrdeProdId = O.OrdeProdId 
		LEFT JOIN OrdeProdLogCerrado L On O.OrdeProdOperacionId = L.OrdeProdOperacionId
		WHERE H.Pedido = '$pedidos'
		AND H.TipoPedido = 'C'
		AND (H.Estado IS NULL OR H.Estado NOT IN('NU','MO'))
		GROUP BY H.OrdeProdId";
		$consulta = $this->db->query($sql);
		$consulta = $consulta->result();
		return $consulta;
	}
}

?>