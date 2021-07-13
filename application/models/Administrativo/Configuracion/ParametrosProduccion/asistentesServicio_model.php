<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AsistentesServicio_model extends CI_Model {

	function estadocivilid(){
		return $this->db->query("SELECT RTRIM(id) id, RTRIM(estadocivilid) estadocivilid, RTRIM(nombre) nombre FROM EstadoCivil ORDER BY nombre ASC")->result();
	}

	function listaClientes(){
		$TerceroID 	= $this->input->post('TerceroID');
		$btn 		= $this->input->post('btn');
		$cliente = '';

		if(($btn == 'btnFastBackward' || $btn == 'btnFastForward') || ($btn == 'btnBackward' && $TerceroID == '') || ($btn == 'btnForward' && $TerceroID == '')){
			switch($btn){
				case 'btnFastBackward':
					$cliente = $this->db->query("SELECT TerceroId FROM Operario WHERE OperarioId = (SELECT TOP 1 OperarioId FROM Operario ORDER BY OperarioId ASC)");
				break;
				case 'btnFastForward':
					$cliente = $this->db->query("SELECT TerceroId FROM Operario WHERE OperarioId = (SELECT TOP 1 OperarioId FROM Operario ORDER BY OperarioId DESC)");
				break;
				case 'btnBackward':
					$cliente = $this->db->query("SELECT O.TerceroId FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY OperarioId ASC) AS n, OperarioId FROM Operario) T
							LEFT JOIN Operario O ON T.OperarioId = O.OperarioId
						WHERE T.n = 1");
				break;
				case 'btnForward':
					$cliente = $this->db->query("SELECT O.TerceroId FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY OperarioId ASC) AS n, OperarioId FROM Operario) T
							LEFT JOIN Operario O ON T.OperarioId = O.OperarioId
						WHERE T.n = 1");
				break;
			}
		}
		if($TerceroID != ''){
			switch($btn){
				case 'btnBackward':
					if($TerceroID != $cliente){
						$cliente = $this->db->query("SELECT O.TerceroId FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY OperarioId ASC) AS n, OperarioId FROM Operario) T
							LEFT JOIN Operario O ON T.OperarioId = O.OperarioId
						WHERE T.n = (
						SELECT T.n - 1 FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY OperarioId ASC) AS n, OperarioId, TerceroId FROM Operario) T
						WHERE T.TerceroId = '$TerceroID'
						)");
					}
				break;
				case 'btnForward':
					if($TerceroID != $cliente){
						$cliente = $this->db->query("SELECT O.TerceroId FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY OperarioId ASC) AS n, OperarioId FROM Operario) T
							LEFT JOIN Operario O ON T.OperarioId = O.OperarioId
						WHERE T.n = (
						SELECT T.n + 1 FROM
							(SELECT ROW_NUMBER() OVER(ORDER BY OperarioId ASC) AS n, OperarioId, TerceroId FROM Operario) T
						WHERE T.TerceroId = '$TerceroID'
						)");
					}
				break;
			}
		}

		if ($cliente->row() != null)
			$cliente = $cliente->row()->TerceroId;
		else
			$cliente = '';

		return $cliente;
	}

	function cargar(){
		$codigo = $this->input->post('codigo');
		$sql = "SELECT
			LTRIM(RTRIM(O.OperarioId)) AS OperarioId
			,LTRIM(RTRIM(O.TerceroId)) AS TerceroID
			,LTRIM(RTRIM(O.CodigoBarras)) AS CodigoBarras
			,LTRIM(RTRIM(T.nombre)) AS nombre
			,LTRIM(RTRIM(T.nombruno)) AS nombruno
			,LTRIM(RTRIM(T.nombrdos)) AS nombrdos
			,LTRIM(RTRIM(T.apelluno)) AS apelluno
			,LTRIM(RTRIM(T.apelldos)) AS apelldos
			,LTRIM(RTRIM(T.direccion)) AS direccion
			,LTRIM(RTRIM(T.ciudadid)) AS ciudadid
			,LTRIM(RTRIM(C.nombre)) AS ciudadidNombre
			,LTRIM(RTRIM(T.telefono)) AS telefono
			,LTRIM(RTRIM(T.celular)) AS celular
			,LTRIM(RTRIM(T.email)) AS email
			,LTRIM(RTRIM(T.profesionid)) AS profesionid
			,LTRIM(RTRIM(P.nombre)) AS profesionidNombre
			,LTRIM(RTRIM(T.fechanacim)) AS fechanacim
			,LTRIM(RTRIM(T.estadocivilid)) AS estadocivilid
			,LTRIM(RTRIM(O.ValorHora)) AS ValorHora
			,LTRIM(RTRIM(O.Estado)) AS Estado
			,T.foto
		FROM Operario O
			LEFT JOIN Tercero T ON O.TerceroId = T.TerceroID
			LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid
			LEFT JOIN Profesion P ON T.Profesionid = P.profesionid

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
			return $consulta;
		}else{
			// Si no existe, crea el Tercero y el Operario

			$consulta = $this->db->query("SELECT TerceroID FROM Tercero WHERE TerceroID = '$codigo'")->result();

			if(count($consulta) > 0){
				return -1;
			}else{
				$this->registrar(1);
				return $this->cargar();
			}
		}
	}

	function registrar($existe = 0){
		$codigo = $this->input->post('codigo');
		$this->db->trans_begin();
		if($existe != 0){
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
				EsEmpleado,
				RespoFisca,
				NombrComer,
				Sincronizar)
			VALUES(
				'$codigo',
				'',
				'',
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
				0,
				'',
				'',
				1
			)";

			try{
				$this->db->query($sql);
			}catch (Exception $e){
				$this->db->trans_rollback();
				return 0;
			}
		}

		$sql = "INSERT INTO Operario (TerceroId, ValorHora, Estado, Clave, CodigoBarras)
			VALUES ('$codigo', 0, 'A', '', '')";

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
			$OperarioId = $this->db->insert_id();
			$_POST['RASTREO']['cambio'] = "Crea Asistente Servicio ".$codigo;
			RASTREO();
			$this->db->trans_commit();
			$_POST['RASTREO']['cambio'] = "Carga Asistente Servicio ".$codigo;
			return $OperarioId;
		}
	}

	function actualizar($cliente, $nombre, $value, $tabla) {
		if($value == ''){
			$value = NULL;
		}
		$this->db->trans_begin();
		$this->db->where('TerceroID', $cliente);
		$this->db->update($tabla, array($nombre => $value));

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
		$this->db->select($tblNombre)
				 ->where($nombre, $value);
		$consulta = $this->db->get($tabla)->result();
		if(count($consulta) == 1){
			return $consulta;
		}else{
			return 0;
		}
	}

	function qActividadesOperarioCP($id = null){
		$cliente = $this->input->post('cliente');
		$sql = "SELECT
			OA.OperarioActividadId
			,OA.CentroProduccionId
			,CP.nombre
		FROM OperarioActividad OA
		LEFT JOIN CentroProduccion CP ON OA.CentroProduccionId = CP.CentroProduccionId
		LEFT JOIN Operario O ON OA.OperarioId = O.OperarioId
		WHERE OA.Tipo = 'CP'
		AND O.TerceroId = '".$cliente."'";
		if($id != null){
			$sql.=" AND OA.OperarioActividad = '$id'";
		}
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function qActividadesOperarioAC($id = null){
		$cliente = $this->input->post('cliente');
		$CP = $this->input->post('CentroProduccionId');
		$sql = "SELECT
			OA.OperarioActividadId
			,OA.ActividadProduccionId
			,A.nombre
		FROM OperarioActividad OA
		LEFT JOIN ActividadProduccion A ON OA.ActividadProduccionId = A.ActividadProduccionId
		LEFT JOIN Operario O ON OA.OperarioId = O.OperarioId
		WHERE OA.Tipo = 'AC'
		AND O.TerceroId = '".$cliente."'";
		if($CP != ''){
			$sql.=" AND OA.CentroProduccionId = '$CP'";
		}
		if($id != null){
			$sql.=" AND OA.OperarioActividad = '$id'";
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

	function eliminarCliente(){
		$cliente = $this->input->post('cliente');

		if($this->db->query("SELECT TOP 1 operarioid FROM MaquinariaOperario WHERE operarioid = '$cliente'")->num_rows() > 0){
			return 2;
		}elseif($this->db->query("SELECT TOP 1 operarioid FROM ordeprodlogoperario WHERE operarioid = '$cliente'")->num_rows() > 0){
			return 2;
		}elseif($this->db->query("SELECT TOP 1 operarioid FROM OTLogOperario WHERE operarioid = '$cliente'")->num_rows() > 0){
			return 2;
		}elseif($this->db->query("SELECT TOP 1 operarioid FROM ServicioFacturaLogOperario WHERE operarioid = '$cliente'")->num_rows() > 0){
			return 2;
		}

		$this->db->trans_begin();
		try{
			$this->db->query("DELETE Operario WHERE operarioid = '$cliente'");
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
			return 1;
		}	
	}

	function cargarCRUD($tabla, $codigo, $cliente, $nombreCodigo){
		$this->db->where($nombreCodigo, $codigo)
		->where('OperarioId', $cliente);
		$consulta = $this->db->get($tabla)->result();
		return json_encode($consulta);
	}

	function eliminarCRUD($tabla, $codigo, $cliente, $nombreCodigo){
		$operario = $this->input->post('operario');
		$this->db->trans_begin();

		$consulta = $this->db->query("SELECT Tipo, CentroProduccionId FROM OperarioActividad WHERE OperarioActividadId = '$codigo'")->row();

		if($consulta->Tipo == 'CP'){
			$this->db->where('CentroProduccionId', $consulta->CentroProduccionId)
			->where('Tipo', 'AC')
			->where('OperarioId', $operario);
			try{
				$this->db->delete($tabla);
			}catch(Exception $e){
				$this->db->trans_rollback();
				return 0;
			}			
		}

		$this->db->where($nombreCodigo, $codigo)
		->where('OperarioId', $operario);
		try{
			$this->db->delete($tabla);
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");

		RASTREO();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
	}

	function GuardarCP(){
		$CP = $this->input->post('CP');
		$operario = $this->input->post('operario');
		$cliente = $this->input->post('cliente');
		$this->db->trans_begin();

		$this->db->query("INSERT INTO OperarioActividad (OperarioId, CentroProduccionId, Tipo) VALUES ('$operario', '$CP', 'CP')");

		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");

		RASTREO();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
	}

	function GuardarAC(){
		$AC = $this->input->post('AC');
		$CP = $this->input->post('CP');
		$operario = $this->input->post('operario');
		$cliente = $this->input->post('cliente');
		$this->db->trans_begin();

		$this->db->query("INSERT INTO OperarioActividad (OperarioId, CentroProduccionId, ActividadProduccionId, Tipo) VALUES ('$operario', '$CP', '$AC', 'AC')");

		$this->db->query("UPDATE Tercero SET fechamodif = GETDATE() WHERE TerceroID = '$cliente'");

		RASTREO();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
	}
}

?>