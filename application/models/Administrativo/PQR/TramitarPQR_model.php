<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TramitarPQR_model extends CI_Model {
	
	function selectProblemaCalidad(){
		$sql = "SELECT * FROM CausaPQR
		 WHERE Tipo = 'D' 
		 ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectOperacion(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'O' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectCausaPQR(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'C' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectResponsable(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'R' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectSeccion(){
		$sql = "SELECT * FROM CausaPQR 
		WHERE Tipo = 'S' 
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectEstado(){
		$sql = "SELECT * FROM EstadoPQR
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectTipo(){
		$sql = "SELECT * FROM TipoPQR
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectCiudad(){
		$sql = "SELECT * FROM Ciudad
		ORDER BY nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectAsesor(){
		$sql = "SELECT usuarioId, Nombre FROM Segur
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}
	
	function selectDependencia(){
		$sql = "SELECT dependenciaId, Nombre FROM Dependencia
		ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	// 13/01/2017 JCSM - Carga cabecera y detalle de PQR
	function consultaPQR($PQRId){
		$user = $this->session->userdata('id');
		$sql = "SELECT
		HP.PQRId,
		HP.PedidoId,
		HP.Pedido,
		HP.TipoPQR,
		HP.Fecha,
		HP.FechaCierre,
		HP.Estado,
		HP.Asunto,
		HP.UsuarioId,
		HP.Solicitud,
		HP.Producidos,
		HP.Comerciali,
		HP.TerceroId,
		HP.Descripcion,
		HP.DependenciaId,
		HP.Fabricado,
		HP.Despachado,
		CASE WHEN HP.Producto IS NULL THEN NULL ELSE CONCAT(H.nombre,' ',CO.nombre) END AS Producto,
		HP.Material,
		HP.Imagen1,
		HP.Imagen2,
		HP.Imagen3,
		HP.EstadoId,
		HP.TipoPQRId,
		HP.Costos,
		HP.ReclamoProveedor,
		HP.Causa,
		HP.Calidad,
		HP.Responsable,
		HP.Operacion,
		HP.Seccion,
		HP.OtraCausa,
		HP.OtraCalidad,
		HP.OtraResponsable,
		HP.OtraOperacion,
		HP.OtraSeccion,
		HP.Devoluciones,
		HP.ProductoId,
		HP.OtroCliente,
		S.nombre AS Usuario,
		D.nombre AS Dependencia,
		CONCAT(T.nombre,HP.OtroCliente) AS Cliente,
		C.nombre AS Ciudad,
		E.Nombre AS EstadoPQR,
		E.Cierre AS Cerrada,
		HP.PQR,
		HP.Factura
		FROM 
		HeadPQR HP
		LEFT JOIN Segur S ON HP.UsuarioId = S.usuarioId
		LEFT JOIN Dependencia D ON S.DependenciaId = D.DependenciaId
		LEFT JOIN Tercero T ON HP.TerceroId = T.TerceroID
		LEFT JOIN Ciudad C ON T.ciudadid = C.ciudadid
		LEFT JOIN EstadoPQR E ON HP.EstadoId = E.EstadoId
		LEFT JOIN Producto P ON HP.ProductoId = P.ProductoId
		LEFT JOIN HeadProd H ON P.headprodid = H.headprodid
		LEFT JOIN Color CO ON P.colorid = CO.colorid
		WHERE
		PQRId = '$PQRId'";
		$query = $this->db->query($sql);

		$HeadPQR = $query->result();

		if(count($HeadPQR) <= 0){
			redirect(base_url().'CapturaPQR');
		}

		$HeadPQR[0]->ProductoPQR = $this->db->query("
			SELECT 
			P.ProductoPQRId,
			P.PQRId,
			P.ProductoId,
			P.Producto,
			P.MaterialId,
			P.Material,
			P.Producidos,
			CASE WHEN P.ProductoId IS NOT NULL AND P.Producto IS NOT NULL THEN P.Producto WHEN P.ProductoId IS NULL THEN P.Producto ELSE CONCAT(H.nombre,' ',C.nombre) END AS ProductoNombre,
			CASE WHEN P.MaterialId IS NULL THEN P.MaterialId ELSE CONCAT(H2.nombre,' ',C2.nombre) END AS MaterialNombre	
			FROM ProductoPQR P
			LEFT JOIN Producto PR ON P.ProductoId = PR.productoid
			LEFT JOIN HeadProd H ON PR.headprodid = H.headprodid
			LEFT JOIN Color C ON PR.colorid = C.colorid
			LEFT JOIN Producto PR2 ON P.MaterialId = PR2.productoid
			LEFT JOIN HeadProd H2 ON PR2.headprodid = H2.headprodid
			LEFT JOIN Color C2 ON PR2.colorid = C2.colorid
			WHERE P.PQRId = '".$HeadPQR[0]->PQRId."'
		")->result();

		$sql = "SELECT Archivo FROM PQRArchivo WHERE TIPO = 'PQR' AND PQRId = '$PQRId'";
		$query = $this->db->query($sql);        
		$adjuntos = $query->result();
		if($query->num_rows() > 0){
			$HeadPQR[0]->Adjuntos = $adjuntos;
		}

		if($HeadPQR[0]->Imagen1 != null){
			$foto = $HeadPQR[0]->Imagen1;
			$foto = base64_encode($foto);
			$HeadPQR[0]->Imagen1 = $foto;
		}
		if($HeadPQR[0]->Imagen2 != null){
			$foto = $HeadPQR[0]->Imagen2;
			$foto = base64_encode($foto);
			$HeadPQR[0]->Imagen2 = $foto;
		}
		if($HeadPQR[0]->Imagen3 != null){
			$foto = $HeadPQR[0]->Imagen3;
			$foto = base64_encode($foto);
			$HeadPQR[0]->Imagen3 = $foto;
		}

		$sql = "SELECT
		DP.*,
		S.nombre,
		S.DependenciaId,
		D.Nombre AS Dependencia,
		E.Nombre AS Estado,
		REPLACE(DP.Detalle, CHAR(10) ,'<br>') DetalleP
		FROM
		DetallePQR DP
		LEFT JOIN Segur S ON DP.UsuarioId = S.usuarioId
		LEFT JOIN Dependencia D ON S.DependenciaId = D.DependenciaId
		LEFT JOIN EstadoPQR E ON DP.EstadoReporte = E.EstadoId
		WHERE
		PQRId = '$PQRId'";
		$query = $this->db->query($sql);
		$data = $query->result();

		foreach ($data as $nota) {
			$sql = "SELECT Archivo FROM PQRArchivo WHERE Tipo = 'NPQR' AND DetalleId = '".$nota->id."'";
			$query = $this->db->query($sql);
			$adjuntos = $query->result();
			if($query->num_rows() > 0){
				$nota->Adjuntos = $adjuntos;
			}
		}

		$sql = "SELECT D.Nombre, S.DependenciaId FROM Segur S
		LEFT JOIN Dependencia D ON S.DependenciaId = D.DependenciaId
		WHERE S.usuarioId = '$user'";
		$query = $this->db->query($sql);
		$DEPENDENCIA = $query->result();

		$sql = "SELECT * FROM Dependencia WHERE Estado = 'A' ORDER BY Nombre ASC";
		$query = $this->db->query($sql);
		$DEPENDENCIAS = $query->result();

		$sql = "SELECT * FROM EstadoPQR";
		$query = $this->db->query($sql);
		$ESTADOSPQR = $query->result();

		$sql = "SELECT * FROM TipoPQR";
		$query = $this->db->query($sql);
		$TIPOSPQR = $query->result();

		$sql = "SELECT * FROM CausaPQR WHERE Tipo = 'C' ORDER BY Nombre ASC";
		$query = $this->db->query($sql);
		$CAUSAPQR = $query->result();

		$sql = "SELECT * FROM CausaPQR WHERE Tipo = 'D' ORDER BY Nombre ASC";
		$query = $this->db->query($sql);
		$PCALIDAD = $query->result();

		$sql = "SELECT * FROM CausaPQR WHERE Tipo = 'R' ORDER BY Nombre ASC";
		$query = $this->db->query($sql);
		$RESPONSABLEPQR = $query->result();

		$sql = "SELECT * FROM CausaPQR WHERE Tipo = 'O' ORDER BY Nombre ASC";
		$query = $this->db->query($sql);
		$OPERACIONPQR = $query->result();

		$sql = "SELECT * FROM CausaPQR WHERE Tipo = 'S' ORDER BY Nombre ASC";
		$query = $this->db->query($sql);
		$SECCIONPQR = $query->result();

		$this->db->where('AsignadoA', $user)
				 ->where('Tipo', 'PQ')
				 ->where('Numero', $PQRId);
		$this->db->delete('Alerta');

		return array($HeadPQR, $data, $DEPENDENCIA, $DEPENDENCIAS, $ESTADOSPQR, $TIPOSPQR, $CAUSAPQR, $PCALIDAD, $RESPONSABLEPQR, $OPERACIONPQR, $SECCIONPQR);
	}

	// 16/01/2017 JCSM - Envío de nota
	function agregarNota($nota) {
		$this->db->trans_begin();
		$date = date("Y-m-d H:i:s");
		// var_dump($nota);
		$this->db->insert('DetallePQR', $nota);

		$consulta = "SELECT UsuarioId, Pqr FROM HeadPQR WHERE PQRId = '". $nota['PQRId'] ."'";
		$query = $this->db->query($consulta);
		$usrCreador = $query->result_array()[0]['UsuarioId'];
		$nPQR = $query->result_array()[0]['Pqr'];

		// En caso de que se de por cerrada la PQR actualiza la fecha de cierre
		$sql = "SELECT Cierre FROM EstadoPQR WHERE EstadoId = '".$nota['EstadoReporte']."'";
		$query = $this->db->query($sql);
		$EstadoPQR = $query->result();
		
		/* $sql = "SELECT AlertaId FROM Alerta WHERE tipo = 'QR' AND Numero = '".$nota['PQRId']."'";
		$consulta = $this->db->query($sql)->result(); */
		if ($EstadoPQR[0]->Cierre == 1) {
			$data['FechaCierre'] = $date;

			// Cerrar notas para todos los que tienen en su bandeja alertas relacionadas
			$sql2 = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero) VALUES ('" . $this->session->userdata('id') . "', '" . $usrCreador . "', 'Nro $nPQR, PQR Cerrada', GETDATE(), GETDATE(), 'QR', '', '".$nota['PQRId']."')";
			/* $update = "UPDATE Alerta SET Estado = 'C', Ejecutada = '$date' WHERE Tipo = 'PQ' AND Numero = '".$nota['PQRId']."'";
			$this->db->query($update);

			if(count($consulta) > 0){
				$sql = "UPDATE Alerta SET Estado = '', Descripcion = 'PQR Cerrada', Creada = GETDATE() WHERE Tipo = 'QR' AND Numero = '".$nota['PQRId']."'";
			}else{
				$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
					SELECT TOP(1) '".$this->session->userdata('id')."', UsuarioId, 'PQR Cerrada', GETDATE(), GETDATE(), 'QR', '', '".$nota['PQRId']."'
					FROM Alerta
					WHERE Numero = '".$nota['PQRId']."'";	
			} */
		} else {
			$sql2 = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero) VALUES ('" . $this->session->userdata('id') . "', '" . $usrCreador . "', 'Nro $nPQR, Nuevo comentario', GETDATE(), GETDATE(), 'QR', '', '".$nota['PQRId']."')";
			/* if(count($consulta) > 0){
				$sql = "UPDATE Alerta SET Estado = '', Descripcion = 'Nuevo comentario', Creada = GETDATE() WHERE Tipo = 'QR' AND Numero = '".$nota['PQRId']."'";
			}else{
				$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
					SELECT TOP(1) '".$this->session->userdata('id')."', UsuarioId, 'Nuevo comentario', GETDATE(), GETDATE(), 'QR', '', '".$nota['PQRId']."'
					FROM Alerta
					WHERE Numero = '".$nota['PQRId']."'";

				 
			}*/
		}

		//$this->db->query($sql);
		$this->db->query($sql2);

		// Actualizar estado
		$this->db->where('PQRId', $nota['PQRId']);
		$data['EstadoId'] = $nota['EstadoReporte'];
		$this->db->update('HeadPQR', $data);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			$insert_id = $this->db->insert_id();
			//Si le crea un nota se lo envia al rastreo
			$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
			$_POST['RASTREO']['programa'] = 'PQR';
			$_POST['RASTREO']['cambio'] = 'Asigna Nota al Tramite ID '.$nota['PQRId'];
			RASTREO();
			return $insert_id;
		}
	}

	function PQRArchivo($tipo, $id) {
		$files = $_FILES;
		$cpt = count($_FILES['archivos']['name']);
		$subidas = array();
		if($files['archivos']['size'][0] > 0) {
			// Configuración upload
			$config = array();
			$config['upload_path']      = FCPATH.'uploads/'.$this->session->userdata('NIT').'/pqr/';
			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');
			// Subida de cada archivo
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['archivos']['name']     = $files['archivos']['name'][$i];
				$_FILES['archivos']['type']     = $files['archivos']['type'][$i];
				$_FILES['archivos']['tmp_name'] = $files['archivos']['tmp_name'][$i];
				$_FILES['archivos']['error']    = $files['archivos']['error'][$i];
				$_FILES['archivos']['size']     = $files['archivos']['size'][$i];
				$config['file_name'] = 'PQR_'.$id.'_nota_';
				$this->upload->initialize($config);

				$archivo = array(
					'tipo'      => $tipo
					);
				if($tipo == 'PQR') {
					$archivo['PQRId'] = $id;
				} else {
					$archivo['DetalleId'] = $id;
				}
				// Inserta la PQR para conseguir su consecutivo
				$this->db->insert('PQRArchivo', $archivo);
				$insert_id = $this->db->insert_id();
				$nombre = 'PQR_'.$id.'_nota_'.$insert_id.'.'.pathinfo($_FILES['archivos']['name'], PATHINFO_EXTENSION);
				$config['file_name'] = $nombre;
				// Una vez tiene el consecutivo cambia el nombre con que se guardó
				$this->db->where('Id', $insert_id);
				$this->db->update('PQRArchivo', array('Archivo' => $nombre));
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
				} else {
					$subida = array();
					$subida['nombre'] = $_FILES['archivos']['name'];
					$this->upload->initialize($config);
					if ($this->upload->do_upload('archivos')) {
						$data = $this->upload->data();
						// Resize
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data['full_path'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 512;
						$config['height'] = 512;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$subida['estado'] = 1;
					} else {
						$this->db->trans_rollback();
						$subida['estado'] = 0;
					}
					array_push($subidas, $subida);
				}
			}
		}
		return json_encode($subidas);
	}

	function actualizarPQR($PQRId, $nombre, $value, $otra) {
		$date = date("d-m-Y H:i:s");
		$usuario = $this->session->userdata('id');
		$this->db->trans_begin();
		$this->db->where('PQRId', $PQRId);
		//trae los datos anteriores
		$valueAnt = $this->db->query("SELECT $nombre FROM HeadPQR WHERE PQRId = '$PQRId'")->result();	
		if($otra == 'true') {
			if(substr($nombre, 0, 4) == 'Otra'){
				$this->db->update('HeadPQR', array(substr($nombre, 4) => null));
			} else {
				if( ! $this->db->update('HeadPQR', array('Otra'.$nombre => null))) {
					$this->db->update('HeadPQR', array($nombre => null));
				}
			}
		}
		$this->db->where('PQRId', $PQRId);
		$this->db->update('HeadPQR', array($nombre => $value));

		// 25/01/2018 JCSM - Enviar notificación a todos los usuarios de la dependencia asignada y cerrar a quienes la tienen
		$consulta = "SELECT Asunto, UsuarioId, Pqr FROM HeadPQR WHERE PQRId = '$PQRId'";
		$query = $this->db->query($consulta);
		$detalle = $query->result_array()[0]['Asunto'];
		$usrCreador = $query->result_array()[0]['UsuarioId'];
		$nPQR = $query->result_array()[0]['Pqr'];
		$this->enviarAlertasPQR($detalle, $PQRId);

		/* $sql = "SELECT AlertaId FROM Alerta WHERE tipo = 'QR' AND Numero = '".$PQRId."'";
		$consulta = $this->db->query($sql)->result();
		if(count($consulta) > 0){
			$sql = "UPDATE Alerta SET Estado = '', Descripcion = 'Actualización de PQR', Creada = GETDATE() WHERE Tipo = 'QR' AND Numero = '".$PQRId."' AND AsignadoA != '" . $usrCreador . "'";
		}else{
			$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
				SELECT TOP(1) '". $usuario ."', UsuarioId, 'Actualización de PQR', GETDATE(), GETDATE(), 'QR', '', '".$PQRId."'
				FROM Alerta
				WHERE Numero = '".$PQRId."'";
		}

		try{
			$this->db->query($sql);
		}catch (Exception $e){
			$this->db->trans_rollback();
			return 0;
		}	 */
		
		$sql2 = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero) VALUES ('" . $usuario . "', '" . $usrCreador . "', 'Nro $nPQR,Actualización de PQR', GETDATE(), GETDATE(), 'QR', '', '".$PQRId."')";

		$this->db->query($sql2);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}
		else {
			$this->db->trans_commit();
			//$this->rastreo($valueAnt,$value,$PQRId,$nombre);
			return 1;
		}
	}

	// 20/01/2020 ASUP - Crea alerta para todos los usuarios
	function enviarAlertasPQR($detalle, $numero) {
		$user = $this->session->userdata('id');
		$date = date("Y-m-d H:i:s");

		$update = "UPDATE Alerta SET Estado = 'C', Ejecutada = '$date' WHERE Tipo = 'PQ' AND Numero = '$numero'";
		$this->db->query($update);		

		$sql = "INSERT INTO Alerta (UsuarioId, AsignadoA, Descripcion, Creada, Programada, Tipo, Estado, Numero)
		SELECT '$user', S.usuarioId, '$detalle', '$date', '$date', 'PQ', '', '$numero'
		FROM Segur S 
			INNER JOIN PermisoSistema PS ON S.usuarioId = PS.UsuarioId OR S.perfilId = PS.PerfilId
		WHERE PS.Permiso = '3'";
		$this->db->query($sql);

		if ($this->db->trans_status() === FALSE) {
			return 0;
		} else {
			return 1;
		}
	}

	function listaClientes(){
		$sql = "SELECT 
					TerceroID
					,nombre 
				FROM Tercero 
				WHERE Estado = 'A'";
		$conuslta = $this->db->query($sql)->result();

		return $conuslta;
	}
}

?>