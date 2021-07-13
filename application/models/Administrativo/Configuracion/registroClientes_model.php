<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroClientes_model extends CI_Model {

	function estadocivilid(){
		return $this->db->query("SELECT RTRIM(id) id, RTRIM(estadocivilid) estadocivilid, RTRIM(nombre) nombre FROM EstadoCivil ORDER BY nombre ASC")->result();
	}

	function ClasificId(){
		return $this->db->query("SELECT RTRIM(idClasificacion) AS id, RTRIM(nombre) nombre, RTRIM(Estado) Estado FROM ClasificacionCliente ORDER BY nombre ASC, Estado ASC")->result();
	}

	function ResponsabilidadFiscal(){
		return $this->db->query("SELECT RespoFiscaId, Nombre FROM ResponsabilidadFiscal ORDER BY Nombre ASC")->result();
	}

	function cargar(){
		$codigo = $this->input->post('codigo');
		$sql = "
		SELECT
			LTRIM(RTRIM(T.TerceroID)) AS TerceroID
			,RTRIM(T.digitverif) digitverif
			,RTRIM(T.tipodocuid) tipodocuid
			,RTRIM(TD.nombre) AS tipodocuidNombre
			,RTRIM(T.barra) barra
			,RTRIM(T.estado) estado
			,RTRIM(T.nombre) nombre
			,RTRIM(T.razonsocia) razonsocia
			,RTRIM(T.nombruno) nombruno
			,RTRIM(T.nombrdos) nombrdos
			,RTRIM(T.apelluno) apelluno
			,RTRIM(T.apelldos) apelldos
			,RTRIM(T.email) email
			,RTRIM(T.email2) email2
			,RTRIM(T.celular) celular
			,RTRIM(T.estadocivilid) estadocivilid
			,RTRIM(T.sexo) sexo
			,RTRIM(T.numercredi) numercredi
			,RTRIM(C.TipoTercId) TipoTercId
			,RTRIM(TT.nombre) AS TipoTercIdNombre
			,RTRIM(T.direccion) direccion
			,RTRIM(T.ciudadid) ciudadid
			,RTRIM(CI.nombre) AS ciudadidNombre
			,RTRIM(T.barrioid) barrioid
			,RTRIM(B.nombre) AS barrioidNombre
			,RTRIM(T.dptoid) dptoid
			,RTRIM(D.nombre) AS dptoNombre
			,RTRIM(T.paisid) paisid
			,RTRIM(P.nombre) AS paisidNombre
			,RTRIM(T.zonaid) zonaid
			,RTRIM(Z.nombre) AS zonaidNombre
			,RTRIM(T.telefono) telefono
			,RTRIM(T.direccorre) direccorre
			,RTRIM(T.ciudacorre) ciudacorre
			,RTRIM(CIC.nombre) AS ciudacorreNombre
			,RTRIM(T.barricorre) barricorre
			,RTRIM(BC.nombre) AS barricorreNombre
			,RTRIM(T.dptocorre) dptocorre
			,RTRIM(DC.nombre) AS dptocorreNombre
			,RTRIM(T.paiscorre) paiscorre
			,RTRIM(PC.nombre) AS paiscorreNombre
			,RTRIM(T.telefcorre) telefcorre
			,RTRIM(T.regimenid) regimenid
			,RTRIM(TR.nombre) AS regimenidNombre
			,RTRIM(C.ActividadId) ActividadId
			,RTRIM(A.nombre) AS ActividadIdNombre
			,RTRIM(C.TarifICA) TarifICA
			,RTRIM(C.TarifRetIv) TarifRetIv
			,RTRIM(C.TariReteId) TariReteId
			,RTRIM(TAR.tarifa) AS TariReteIdNombre
			,RTRIM(T.digitverif) digitverif
			,RTRIM(C.SobreBase) SobreBase
			,RTRIM(C.Dias) Dias
			,RTRIM(C.TipoCartId) TipoCartId
			,RTRIM(TC.nombre) AS tipoNombre
			,RTRIM(C.Monto) Monto
			,RTRIM(C.BloquMonto) BloquMonto
			,RTRIM(C.BloquVenci) BloquVenci
			,RTRIM(C.BloquPedid) BloquPedid
			,RTRIM(C.ListaPrecio) ListaPrecio
			,RTRIM(C.AlmacenId) AlmacenId
			,RTRIM(AL.nombre) AS AlmacenIdNombre
			,RTRIM(C.Interes) Interes
			,RTRIM(T.fechanacim) fechanacim
			,RTRIM(T.ciudanacim) ciudanacim
			,RTRIM(CN.nombre) AS ciudanacimNombre
			,RTRIM(T.profesionid) profesionid
			,RTRIM(PR.nombre) AS profesionidNombre
			,RTRIM(T.hijos) hijos
			,RTRIM(T.ocupacion) ocupacion
			,RTRIM(T.AutorL1581) AutorL1581
			,RTRIM(C.VendedorId) VendedorId
			,RTRIM(V.nombre) AS VendedorIdNombre
			,RTRIM(C.ClasificId) ClasificId
			,RTRIM(T.empresa) empresa
			,RTRIM(T.direcempre) direcempre
			,RTRIM(T.ciudaempre) ciudaempre
			,RTRIM(CE.nombre) AS ciudaempreNombre
			,RTRIM(T.barriempre) barriempre
			,RTRIM(BE.nombre) AS barriempreNombre
			,RTRIM(T.dptoempre) dptoempre
			,RTRIM(DE.nombre) AS dptoempreNombre
			,RTRIM(T.paisempre) paisempre
			,RTRIM(PE.nombre) AS paisempreNombre
			,RTRIM(T.telefempre) telefempre
			,RTRIM(T.cargoid) cargoid
			,RTRIM(CAE.nombre) AS cargoidNombre
			,RTRIM(T.contacto) contacto
			,RTRIM(T.tipocontac) tipocontac
			,RTRIM(T.sectorid) sectorid
			,RTRIM(S.nombre) AS sectoridNombre
			,RTRIM(T.fechacreac) fechacreac
			,RTRIM(T.observacio) observacio
			,T.foto
			,RTRIM(T.EsCliente) EsCliente
			,RTRIM(T.EsProveedor) EsProveedor
			,RTRIM(T.nombrcomer) nombrcomer
			,RTRIM(C.NoLiquidarIVA) NoLiquidarIVA
			,RTRIM(T.RespoFisca) RespoFisca
		FROM Tercero T
		LEFT JOIN Cliente C ON T.TerceroID = C.TerceroId
		LEFT JOIN tipodocu TD ON T.tipodocuid = TD.tipodocuid
		LEFT JOIN TipoTerc TT ON C.TipoTercId = TT.tipotercid
		LEFT JOIN Ciudad CI ON T.ciudadid = CI.ciudadid
		LEFT JOIN Barrio B ON T.barrioid = B.barrioid
		LEFT JOIN Dpto D ON T.dptoid = D.dptoid
		LEFT JOIN Pais P ON T.paisid = P.paisid
		LEFT JOIN Zona Z ON T.zonaid = Z.zonaid
		LEFT JOIN ciudad CIC ON T.ciudacorre = CIC.ciudadid
		LEFT JOIN Barrio BC ON T.barricorre = BC.barrioid
		LEFT JOIN Dpto DC ON T.dptocorre = DC.dptoid
		LEFT JOIN Pais PC ON T.paiscorre = PC.paisid
		LEFT JOIN TipoRegi TR ON T.regimenid = TR.RegimenID
		LEFT JOIN Actividad A ON C.ActividadId = A.actividadid
		LEFT JOIN TariRete TAR ON C.TariReteId = TAR.tarireteid
		LEFT JOIN TipoCart TC ON C.TipoCartId = TC.tipocartid
		LEFT JOIN Almacen AL ON C.AlmacenId = AL.almacenid
		LEFT JOIN ciudad CN ON T.ciudanacim = CN.ciudadid
		LEFT JOIN Profesion PR ON T.profesionid = PR.profesionid
		LEFT JOIN Vendedor V ON C.VendedorId = V.vendedorid
		LEFT JOIN Ciudad CE ON T.ciudaempre = CE.ciudadid
		LEFT JOIN Barrio BE ON T.barriempre = BE.barrioid
		LEFT JOIN Dpto DE ON T.dptoempre = DE.dptoid
		LEFT JOIN Pais PE ON T.paisempre = PE.paisid
		LEFT JOIN Cargo CAE ON T.cargoid = CAE.cargoid
		LEFT JOIN Sector S ON T.sectorid = S.sectorid

		WHERE T.TerceroID = '$codigo'
		";
		$consulta = $this->db->query($sql)->result();
		if(count($consulta) > 0){
			// Codifica foto en formato base64
			if($consulta[0]->foto != null){
				$foto = $consulta[0]->foto;
				$foto = base64_encode($foto);
				$consulta[0]->foto = $foto;
			}
			RASTREO();
		}
		return $consulta;
	}

	function registrar(){
		$codigo = $this->input->post('codigo');
		$this->db->trans_begin();
		$sql = "INSERT INTO Tercero(
			TerceroID,
			barra,
			estado,
			nombre,
			razonsocia,
			nombruno,
			nombrdos,
			apelluno,
			apelldos,
			tipodocuid,
			digitverif,
			numercredi,
			clase,
			direccion,
			ciudadid,
			regionid,
			zonaid,
			telefono,
			celular,
			email,
			email2,
			estadocivilid,
			profesionid,
			ocupacion,
			hijos,
			contacto,
			tipocontac,
			observacio,
			estadoid,
			sectorid,
			fechaingre,
			fechafinal,
			fechanacim,
			ultimfactu,
			regimenid,
			representa,
			firma,
			sexo,
			fechacreac,
			fechamodif,
			foto,
			descufinan,
			barrioid,
			dptoid,
			paisid,
			direccorre,
			ciudacorre,
			barricorre,
			dptocorre,
			paiscorre,
			telefcorre,
			ciudanacim,
			empresa,
			direcempre,
			telefempre,
			ciudaempre,
			barriempre,
			dptoempre,
			paisempre,
			cargoid,
			AutorL1581,
			EsCliente,
			EsProveedor,
			EsEmpleado)
		VALUES(
			'$codigo',
			'',
			'A',
			'',
			'',
			'',
			'',
			'',
			'',
			NULL,
			'',
			'',
			'',
			'',
			NULL,
			NULL,
			NULL,
			'',
			'',
			'',
			'',
			NULL,
			NULL,
			'',
			0,
			'',
			'',
			'',
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			'',
			NULL,
			'',
			'',
			'',
			GETDATE(),
			GETDATE(),
			NULL,
			0,
			NULL,
			NULL,
			NULL,
			'',
			NULL,
			NULL,
			NULL,
			NULL,
			'',
			NULL,
			'',
			'',
			'',
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			0,
			1,
			0,
			0
		)";

		try{
			$this->db->query($sql);
		}catch (Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

		$sql = "INSERT INTO Cliente(
			TerceroId,
			Dias,
			Monto,
			Interes,
			ActividadId,
			TarifICA,
			TarifRetIv,
			TariReteId,
			SobreBase,
			BloquMonto,
			BloquVenci,
			BloquPedid,
			VendedorId,
			TipoTercId,
			TipoCartId,
			EmpresaId,
			ClasificId,
			FechaModif,
			ListaPrecio,
			AlmacenId)
		VALUES(
			'$codigo',
			0,
			0,
			'',
			NULL,
			0,
			0,
			NULL,
			'',
			'',
			'',
			'',
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			GETDATE(),
			NULL,
			NULL
		)";

		try{
			$this->db->query($sql);
		}catch (Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function actualizar($cliente, $nombre, $value, $tabla) {
		$permiso = $this->input->post('permiso');
		$crear = $this->input->post('crear');
		if($permiso != 0){
			if($crear == 0){
				if(!in_array($permiso, $this->session->userdata('TERCModif'))){
					return 2;
				}
			}else{
				if(!in_array($permiso, $this->session->userdata('TERCCrear'))){
					return 2;
				}
			}
		}
		if($value == ''){
			$value = NULL;
		}
		$this->db->trans_begin();
		$this->db->where('TerceroID', $cliente);
		$this->db->update($tabla, array($nombre => $value));

		if($nombre == 'EsProveedor'){
			if(count($this->db->query("SELECT TerceroID FROM Proveedor WHERE TerceroID = '$cliente'")->result()) == 0){
				$sql = "INSERT INTO Proveedor(
					TerceroId,
					Dias,
					ActividadId,
					TarifICA,
					TarifRetIv,
					TariReteId,
					SobreBase,
					TipoTercId,
					FechaModif
				)VALUES(
					'$cliente',
					0,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					NULL,
					GETDATE()
				)";

				try{
					$this->db->query($sql);
				}catch (Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}
		}

		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		$this->db->query("UPDATE Cliente SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function cargarForanea(){
		$tabla = $this->input->post('tabla');
		$value = $this->input->post('value');
		$nombre = $this->input->post('nombre');
		$tblNombre = $this->input->post('tblNombre');
		if($tabla == 'ciudad'){
			$this->db->select('dptoid');
		}
		$this->db->select($tblNombre)
				 ->where($nombre, $value);
		$consulta = $this->db->get($tabla)->result();
		if(count($consulta) == 1){
			return $consulta;
		}else{
			return 0;
		}
	}

	function obtenerTipoVivienda(){
		return $this->db->query("SELECT TipoViviendaId As id,nombre FROM TipoVivienda WHERE Estado = 'A'")->result();
	}

	function obtenerVivienda(){
		$id = $this->input->post('Id');
		return $this->db->query("SELECT ViviendaId AS id,Nomenclatura AS nombre FROM Vivienda WHERE TipoViviendaId = ?",array($id))->result();
	}

	function guardarResidencia(){
		$data = $this->input->post('Data');

		$verifica = $this->db->query("SELECT ViviendaTerceroId FROM ViviendaTercero WHERE TerceroID = ? AND ViviendaId = ?",array($data['TerceroID'],$data['ViviendaId']))->result();

		if ($data['Residente'] == 1) {
			$verifica2 = $this->db->query("SELECT ViviendaTerceroId FROM ViviendaTercero WHERE TerceroID = ? AND Residente = 1",array($data['TerceroID']))->result();
			if (count($verifica2) > 0) {
				return 3;
			}
		}

		if (count($verifica) > 0) {
			return 2;
		}else{
			$this->db->trans_begin();

			$this->db->insert('ViviendaTercero',$data);

			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return 0;
			}else{
				RASTREO();
				$this->db->trans_commit();
				return 1;
			}
		}
	}

	function eliminarResidencia(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('ViviendaTerceroId',$id);
		$this->db->delete('ViviendaTercero');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function qResidencia($id = null){
		$id = '0';
		if ($this->input->post('cliente') != '') {
			$id = $this->input->post('cliente');
		}
		$sql = "SELECT
			'' AS Acciones
			,ViviendaTerceroId
			,TV.Nombre AS nomTV
			,V.Nomenclatura
			,CASE WHEN Propietario = 1 THEN 'Si' ELSE 'No' END Propietario
			,CASE WHEN Residente = 1 THEN 'Si' ELSE 'No' END Residente
			,CASE WHEN Titular = 1 THEN 'Si' ELSE 'No' END Titular
			,CASE WHEN ListaGeneral = 1 THEN 'Si' ELSE 'No' END ListaGeneral
		FROM ViviendaTercero VT
			LEFT JOIN Vivienda V ON VT.ViviendaId = V.ViviendaId
			LEFT JOIN TipoVivienda TV ON V.TipoViviendaId = TV.TipoViviendaId
		WHERE VT.TerceroID = '".$id."'";
		
		$consulta = $this->db->query($sql);
		
		return $consulta->result();

	}
	function qSucursales($id = null){
		$cliente = $this->input->post('cliente');
		$sql = "SELECT
			S.sucursalid,
			S.terceroid,
			S.nombre,
			S.direccion,
			S.barrioid,
			B.nombre AS barrioidNombre,
			S.ciudadid,
			C.nombre AS ciudadidNombre,
			S.dptoid,
			D.nombre AS dptoidNombre,
			S.paisid,
			P.nombre AS paisidNombre,
			S.regionid,
			R.nombre AS regionidNombre,
			S.zonaid,
			Z.nombre AS zonaidNombre,
			S.telefono,
			S.email,
			S.vendedorid,
			V.nombre AS vendedoridNombre,
			S.estado
		FROM Sucursal S
		LEFT JOIN Ciudad C ON S.ciudadid = C.ciudadid
		LEFT JOIN Barrio B ON S.barrioid = B.barrioid
		LEFT JOIN Dpto D ON S.dptoid = D.dptoid
		LEFT JOIN Pais P ON S.paisid = P.paisid
		LEFT JOIN Region R ON S.regionid = R.regionid
		LEFT JOIN Zona Z ON S.zonaid = Z.zonaid
		LEFT JOIN Vendedor V ON S.vendedorid = V.vendedorid
		WHERE S.terceroid = '".$cliente."'";
		if($id != null){
			$sql.=" AND S.sucursalid = '$id'";
		}
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function qInformacionAdicionalCRM($id = null){
		$cliente = $this->input->post('cliente');
		$sql = "SELECT
			C.id,
			C.CRMTablaid,
			C.CRMDatoid,
			C.CRMTablaid,
			CONCAT(C.dato,D.nombre) AS Descripcion,
			T.nombre AS Campo,
			T.tipo
		FROM CRMTercero C
		LEFT JOIN CRMTablas T ON C.CRMTablaid = T.crmtablaid
		LEFT JOIN CRMDatos D ON C.CRMDatoid = D.crmdatoid
		WHERE C.terceroid = '".$cliente."'";
		if($id != null){
			$sql.=" AND C.id = '$id'";
		}
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function qContactos($id = null){
		$cliente = $this->input->post('cliente');
		$sql = "SELECT
			C.contactoid,
			C.nombre,
			C.dependencia,
			C.cargo,
			C.fechanacim,
			C.email,
			C.telefono,
			C.celular,
			C.GestionCartera
		FROM Contacto C
		WHERE C.terceroid = '".$cliente."'";
		if($id != null){
			$sql.=" AND C.contactoid = '$id'";
		}
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function actualizarImagen(){
		$imagen = $this->input->post('imagen');
		$cliente = $this->input->post('cliente');
		$_POST['RASTREO']['cambio'] = $this->input->post('cambio');
		$_POST['RASTREO']['fecha'] = $this->input->post('fecha');
		$_POST['RASTREO']['programa'] = $this->input->post('programa');

		$arrContextOptions=array(
			'ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false
			)
		);

        //Toma la foto de la ruta temporal y la pone como un string
		$file = file_get_contents($_FILES['file']['tmp_name'], false, stream_context_create($arrContextOptions));
        //Obtener el tamaño de una imagen desde una cadena
		$width = getimagesizefromstring($file);
        //Crear una imagen nueva desde el flujo de imagen de la cadena
		$image = imagecreatefromstring($file);
	    // resize the image
		if($width[0] > 256){
	        //Redimensiona una imagen empleando el algoritmo de interpolación dado.
			$image = imagescale($image , 256);
		}
		//Activa un búfer(espacio de memoria para el almacenamiento de datos)
		ob_start();
		//Crea un archivo jpg
		imagejpeg($image);
		//Obtiene el contenido del búfer de salida, sin borrarlo.
		$file = ob_get_contents();
		//Limpia el búfer
		ob_end_clean();
		imagedestroy($image);

		$unpacked = unpack('H*', $file);
		$data_string = '0x'.$unpacked[1];
		$this->db->trans_begin();
		
		$this->db->query("UPDATE Tercero SET foto = $data_string WHERE TerceroID = '$cliente'", false);
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function listaClientes(){
		$TerceroID 	= $this->input->post('TerceroID');
		$btn 		= $this->input->post('btn');
		$cliente = '';

		if(($btn == 'btnFastBackward' || $btn == 'btnFastForward') || ($btn == 'btnBackward' && $TerceroID == '') || ($btn == 'btnForward' && $TerceroID == '')){
			switch($btn){
				case 'btnFastBackward':
					$cliente = $this->db->query('SELECT TOP 1 TerceroID FROM Tercero WHERE EsCliente = 1 ORDER BY TerceroID ASC');
				break;
				case 'btnFastForward':
					$cliente = $this->db->query('SELECT TOP 1 TerceroID FROM Tercero WHERE EsCliente = 1 ORDER BY TerceroID DESC');
				break;
				case 'btnBackward':
					$cliente = $this->db->query('SELECT T.TerceroID AS TerceroID FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY TerceroID ASC) AS n, TerceroID FROM Tercero WHERE EsCliente = 1) T
						WHERE T.n = 1');
				break;
				case 'btnForward':
					$cliente = $this->db->query('SELECT T.TerceroID AS TerceroID FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY TerceroID ASC) AS n, TerceroID FROM Tercero WHERE EsCliente = 1) T
						WHERE T.n = 1');
				break;
			}
		}
		if($TerceroID != ''){
			switch($btn){
				case 'btnBackward':
					if($TerceroID != $cliente){
						$cliente = $this->db->query("SELECT T.TerceroID AS TerceroID FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY TerceroID ASC) AS n, TerceroID FROM Tercero WHERE EsCliente = 1) T
						WHERE T.n = (
						SELECT T.n - 1 FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY TerceroID ASC) AS n, TerceroID FROM Tercero WHERE EsCliente = 1) T
						WHERE T.TerceroID = '$TerceroID'
						)");
					}
				break;
				case 'btnForward':
					if($TerceroID != $cliente){
						$cliente = $this->db->query("SELECT T.TerceroID AS TerceroID FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY TerceroID ASC) AS n, TerceroID FROM Tercero WHERE EsCliente = 1) T
						WHERE T.n = (
						SELECT T.n + 1 FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY TerceroID ASC) AS n, TerceroID FROM Tercero WHERE EsCliente = 1) T
						WHERE T.TerceroID = '$TerceroID'
						)");
					}
				break;
			}
		}

		if ($cliente->row() != null)
			$cliente = $cliente->row()->TerceroID;
		else
			$cliente = '';

		return $cliente;
	}

	function guardarCRUD($tabla, $codigo, $cliente, $nombre, $value, $nombreCodigo){
		$permiso = $this->input->post('permiso');
		if($permiso != 0){
			if(!in_array($permiso, $this->session->userdata('TERCModif'))){
				return 2;
			}
		}

		$this->db->start_cache();
		$this->db->where($nombreCodigo, $codigo)
		->where('terceroid', $cliente);
		$consulta = $this->db->get($tabla)->result();
		$this->db->stop_cache();
		$this->db->flush_cache();
		if($value == ''){
			$value = NULL;
		}
		$this->db->trans_begin();
		$this->db->where($nombreCodigo, $codigo)
		->where('terceroid', $cliente);
		if(count($consulta) > 0){
			$this->db->update($tabla, array($nombre => $value));
			$_POST['RASTREO']['cambio'] = 'Actualiza'.$_POST['RASTREO']['cambio'];
		}else{
			$this->db->insert($tabla, array(
				$nombre => $value,
				'terceroid' => $cliente,
				$nombreCodigo => $codigo
				));
			$_POST['RASTREO']['cambio'] = 'Crea'.$_POST['RASTREO']['cambio'];
		}
		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		$this->db->query("UPDATE Cliente SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function cargarCRUD($tabla, $codigo, $cliente, $nombreCodigo){
		if($codigo != 0){
			switch ($tabla) {
				case 'Sucursal':
					$consulta = $this->qSucursales($codigo);
					break;
				case 'CRMTercero':
					$consulta = $this->qInformacionAdicionalCRM($codigo);
					break;
				case 'Contacto':
					$consulta = $this->qContactos($codigo);
					break;
				case 'Adjuntos':
					$consulta = $this->qAdjuntos($codigo);
					break;
				
				default:
					$this->db->where($nombreCodigo, $codigo)
					->where('terceroid', $cliente);
					$consulta = $this->db->get($tabla)->result();
					break;
			}
			return json_encode($consulta);
		}else{
			// 21/01/2019 JCSM - En caso de que se cree un registro nuevo
			$permiso = $this->input->post('permiso');
			if($permiso != 0){
				if(!in_array($permiso, $this->session->userdata('TERCCrear'))){
					return -1;
				}
			}
			$this->db->trans_begin();
			try{
				$array = array('terceroid' => $cliente);
				switch ($tabla) {
					case 'Contacto':
					$array['nombre'] = '';
					break;
				}
				$this->db->insert($tabla, $array);
			}catch(Exception $e){
				$this->db->trans_rollback();
				return 0;
			}
			$insert_id = $this->db->insert_id();
			$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
			$this->db->query("UPDATE Cliente SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
			$_POST['RASTREO']['cambio'] = 'Crea registro '.$insert_id.$_POST['RASTREO']['cambio'];
			RASTREO();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return 0;
			}else{
				$this->db->trans_commit();
				return $insert_id;
			}
		}
	}

	function eliminarCRUD($tabla, $codigo, $cliente, $nombreCodigo){
		$permiso = $this->input->post('permiso');
		if($permiso != 0){
			if(!in_array($permiso, $this->session->userdata('TERCElimi'))){
				return 2;
			}
		}

		if($tabla == 'TerceroAdjunto'){
			$archivo = $this->db->query("SELECT Adjunto FROM TerceroAdjunto WHERE AdjuntoId = '$codigo'")->row('Adjunto');
		}

		$this->db->trans_begin();
		$this->db->where($nombreCodigo, $codigo)
		->where('terceroid', $cliente);
		try{
			$this->db->delete($tabla);
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		$this->db->query("UPDATE Cliente SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		RASTREO();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();

			if($tabla == 'TerceroAdjunto'){
				if (file_exists(FCPATH.'/Uploads/'.$archivo)) {
					unlink(FCPATH.'/Uploads/'.$archivo);
				}
			}

			return 1;
		}
	}

	function guardarCRM(){
		$permiso = 55;
		if(!in_array($permiso, $this->session->userdata('TERCCrear'))){
			return 2;
		}
		$CRM = $this->input->post('CRM');
		$cliente = $this->input->post('cliente');
		if($CRM['CRMDatoid'] == ''){
			$CRM['CRMDatoid'] = null;
		}
		$CRM['terceroid'] = $cliente;
		unset($CRM['nombre']);
		unset($CRM['value']);
		unset($CRM['tipo']);
		$this->db->trans_begin();
		try{
			$this->db->insert('CRMTercero',$CRM);
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		$this->db->query("UPDATE Cliente SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");
		RASTREO();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
	}

	function eliminarCliente(){
		$permiso = '0';
		if(!in_array($permiso, $this->session->userdata('TERCElimi'))){
			return 2;
		}
		$cliente = $this->input->post('cliente');

		if($this->db->query("SELECT TOP 1 terceroid FROM HeadFact WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM HeadMovi WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM HeadCart WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM HeadCoti WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM HeadPedi WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM PWEBHeadPedi WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM HeadOrdeProd WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM GastoCaja WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}elseif($this->db->query("SELECT TOP 1 terceroid FROM HeadRemi WHERE terceroid = '$cliente'")->num_rows() > 0){
			return 3;
		}

		$this->db->trans_begin();
		try{
			$this->db->query("DELETE cliente WHERE terceroid = '$cliente'");
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}
		try{
			$this->db->query("DELETE Proveedor WHERE terceroid = '$cliente'");
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}
		try{
			$this->db->query("DELETE tercero WHERE terceroid = '$cliente'");
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}
		RASTREO();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();

			$this->deleteDir(FCPATH.'uploads/'.$this->session->userdata('NIT').'/AdjuntosTerceros/'.$cliente);

			return 1;
		}	
	}

	public static function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			// throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}

	function qAdjuntos($id = null){
		$cliente = $this->input->post('cliente');
		$sql = "SELECT AdjuntoId, TerceroId, REPLACE(Adjunto, ' ', '_') Adjunto, Descripcion FROM TerceroAdjunto WHERE TerceroId = '".$cliente."'";
		if($id != null){
			$sql.=" AND AdjuntoId = '$id'";
		}
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function guardarAdjunto(){
		$codigo = $this->input->post('Id');
		$nombre = $this->input->post('nombreCliente');
		$tipo  	= $this->input->post('Tipo');

		$this->db->trans_begin();
		switch ($tipo) {
			case 'TER':
				$resultado = $this->UPLOADIMG('TerceroId',$codigo,'Clientes','AdjuntosTerceros',$tipo ,'TerceroAdjunto');
				break;
			default:
				return 0;
				break;
		}

		if($resultado == 3){
			$this->db->trans_rollback();
			return $resultado;
		}

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
	}

	public function UPLOADIMG($llave,$codigo,$modulo,$ruta,$tipo,$tabla){

		if (isset($_FILES['Lista_Anexos'])){
			if(preg_match('/#|"|á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['Lista_Anexos']['name'])===1){
				return 3;
			}
		}

		$files = $_FILES;
		$CI = & get_instance();
		$nombreDoc = "";
		if (count($files) > 0) {
			$cpt = count($_FILES['Lista_Anexos']['name']);
		}
		$subidas = array();
		if (count($files) == 0) {
			return 0;
		}else{
			if($files['Lista_Anexos']['size'] > 0){
				$dateNow = new DateTime;
				$dateNow = $dateNow->format('Y-m-d');
				//CONFIGURACION UPLOAD
				$config = array();
				$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/'.$ruta;
				if (!file_exists($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, true);
				}
				$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/'.$ruta.'/'.$codigo;
				if (!file_exists($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, true);
				}
				
				$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
				$config['max_size']         = '20048';
				$config['overwrite']        = TRUE;
				$CI->load->library('upload');
				$CI->load->library('image_lib');
				//SUBIDA DE CADA ARCHIVO
				$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
				$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
				$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
				$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
				$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];
				
				$nombreDoc = pathinfo($_FILES['Lista_Anexos']['name'], PATHINFO_FILENAME);

				$nombreDoc = str_replace('.', '_', $nombreDoc);
				$nombreDoc = str_replace(' ', '_', $nombreDoc);

				$nombreDoc = $nombreDoc.'.'.pathinfo($_FILES['Lista_Anexos']['name'], PATHINFO_EXTENSION);

				$config['file_name'] = $nombreDoc;
				$CI->upload->initialize($config);
				$CI->db->trans_begin();
					switch ($modulo) {
						case 'Clientes':
							$archivo = array(
								$llave      	=> $codigo,
								'Adjunto'   	=> $this->session->userdata('NIT').'/'.$ruta.'/'.$codigo.'/'.$nombreDoc,
								'Descripcion' 	=> pathinfo($_FILES['Lista_Anexos']['name'], PATHINFO_FILENAME)
							);
							$CI->db->insert($tabla, $archivo);
							$_POST['RASTREO']['cambio'] = 'Modifica Cliente '.$codigo.' Agrega Adjunto '.$nombreDoc;
							$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
							$_POST['RASTREO']['programa'] = 'Terceros';
							RASTREO();
							break;
						default:
							return false;
							break;
					}
				if ($CI->db->trans_status() === FALSE){
					$CI->db->trans_rollback();
				}else{
					$subida = array();
					$subida['nombre'] = $_FILES['Lista_Anexos']['name'];
					if ($CI->upload->do_upload('Lista_Anexos')) {
						$data = $CI->upload->data();
						//RESIZE
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data['full_path'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 512;
						$config['height'] = 512;
						$CI->image_lib->clear();
						$CI->image_lib->initialize($config);
						$CI->image_lib->resize();
						$CI->db->trans_commit();
						$subida['estado'] = 1;
					} else {
						$CI->db->trans_rollback();
						$subida['estado'] = 0;
					}
					array_push($subidas, $subida);
				}
			}else{
				return 0;
			}
		}
		return 1;
	}

}

?>