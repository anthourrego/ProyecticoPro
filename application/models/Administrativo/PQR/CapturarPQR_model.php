<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CapturarPQR_model extends CI_Model {

	function listaTipoPQR(){
		$sql = "SELECT TipoPQRId, Nombre, ValidaPedido FROM TipoPQR";

		$listaTipoPQR = $this->db->query($sql)->result();

		return $listaTipoPQR;
	}

	function verificarPedido(){
		$pedidoid = $this->input->post('pedidoid');
		$consulta = array();
		$sql ="SELECT
					PW.id
					,PW.productoid productoId
					,CONCAT(HP.nombre,' ',C.nombre,' ',PW.ancho,' x ',PW.alto) producto
					,PW.cantidad
					,Hpe.terceroid
					,CONCAT(T.nombruno, ' ', T.nombrdos, ' ',T.apelluno, ' ', T.apelldos) Cliente
				FROM PWEBPedido PW
					LEFT JOIN Producto P ON PW.productoid = P.productoid
					LEFT JOIN HeadProd HP ON P.headprodid = HP.headprodid
					LEFT JOIN PWEBHeadPedi HPe ON PW.pedidoid = HPe.pedidoid
					LEFT JoiN Tercero T ON HPe.terceroid = T.TerceroID
					LEFT JOIN Color C ON P.colorid = C.colorid
				WHERE HPe.pedido = '$pedidoid'";
		$consulta['dataProductos'] = $this->db->query($sql)->result();

		$sql = "SELECT 
					DISTINCT
					LTRIM(RTRIM(F.factura)) factura
				FROM PWEBHeadPedi PHP
					INNER JOIN Factura F ON PHP.pedido = F.pedido
					LEFT JOIN HeadFact HF ON F.factura = HF.factura
				WHERE (HF.Estado IS NULL OR HF.Estado NOT IN('NU','MO')) 
					AND PHP.pedido  = '$pedidoid'
		ORDER BY factura";
		$consulta['dataFacturas'] = $this->db->query($sql)->result();

		return $consulta;
	}

	function verificarFactura(){
		$factura = $this->input->post('factura');

		$consulta = array();
		$sql ="SELECT 
					DISTINCT
					H.Factura
					,P.productoId
					,HP.nombre producto
					,F.cantidad
					,T.terceroid
					,T.nombre As Cliente
				FROM HeadFact H
					INNER JOIN Factura F ON H.facturaid = F.facturaid
					LEFT JOIN Tercero T ON H.terceroid = T.TerceroID
					LEFT JOIN Producto P ON F.ProductoId = P.ProductoId
					LEFT JOIN HeadProd HP ON P.headprodid = HP.headprodid
				WHERE (H.Estado IS NULL OR H.Estado NOT IN('NU','MO')) 
					AND F.Factura = '$factura'";
		$consulta['dataFactura'] = $this->db->query($sql)->result();

		$sql = "SELECT DISTINCT Pedido FROM Factura WHERE Factura = '$factura' AND Pedido IS NOT NULL AND Pedido <> ''";
		$consulta['dataPedido'] = $this->db->query($sql)->result();

		return $consulta;
	}

	function listaMateriales(){
		$pedidoid = $this->input->post('pedidoid');
		$sql = "SELECT H.headprodid
					,P.productoid
					,CONCAT(H.nombre,' ',C.nombre) AS nombre 
				FROM PWEBMaterialPedido M
					LEFT JOIN Producto P ON M.productoid = P.productoid
					LEFT JOIN HeadProd H ON P.headprodid = H.headprodid
					LEFT JOIN Color C ON P.colorid = C.colorid
				WHERE M.pedidoid = '$pedidoid'";
		$consulta = $this->db->query($sql);
		return $consulta->result();
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

	function insertar($data){
		try{
			$this->db->insert('HeadPQR', $data);
			$pqrid = $this->db->insert_id();
		}catch (Exception $e){
			return 0;
		}
		$sql = "UPDATE Montaje SET ConsePQR = CASE WHEN ConsePQR IS NULL THEN 1 ELSE ConsePQR + 1 END";
		try{
			$this->db->query($sql);
		}catch (Exception $e){
			return 0;
		}
		$sql = "SELECT ConsePQR FROM Montaje";
		try{
			$PQR = $this->db->query($sql)->row()->ConsePQR;
		}catch (Exception $e){
			return 0;
		}
		$sql = "UPDATE HeadPQR SET PQR = ".$PQR." WHERE PQRId = '".$pqrid."'";
		try{
			$this->db->query($sql);
		}catch (Exception $e){
			return 0;
		}
		return array($pqrid, $PQR);
	}

	function registrarProductosPedido($PQRId, $productosPedido, $validaMaterial){
		$cad = "";
		
		if (count($productosPedido) > 0) {
			for($i = 0; $i < count($productosPedido); $i++){
				if(!$validaMaterial){
					if ($productosPedido[$i]->ProductoId == 'otro' && $productosPedido[$i]->MaterialId == 'otro'){
						$cad = "INSERT INTO ProductoPQR (PQRId, Producto, Material, Producidos) 
						VALUES ($PQRId, 
						'".$productosPedido[$i]->Producto."',
						'".$productosPedido[$i]->Material."', 
						'".$productosPedido[$i]->Producidos."') ";
					} else if ($productosPedido[$i]->ProductoId == 'otro' && $productosPedido[$i]->MaterialId != 'otro'){
						$cad = "INSERT INTO ProductoPQR (PQRId, Producto, MaterialId, Producidos) 
						VALUES ($PQRId, 
						'".$productosPedido[$i]->Producto."', 
						'".$productosPedido[$i]->MaterialId."', 
						'".$productosPedido[$i]->Producidos."') ";
					} else if ($productosPedido[$i]->ProductoId != 'otro' && $productosPedido[$i]->MaterialId == 'otro'){
						$cad = "INSERT INTO ProductoPQR (PQRId, ProductoId, Producto, Material, Producidos) 
						VALUES ($PQRId, '".$productosPedido[$i]->ProductoId."', 
						'".$productosPedido[$i]->Producto."', 
						'".$productosPedido[$i]->Material."', 
						'".$productosPedido[$i]->Producidos."') ";
					} else if ($productosPedido[$i]->ProductoId != 'otro' && $productosPedido[$i]->MaterialId != 'otro'){
						$cad = "INSERT INTO ProductoPQR (PQRId, ProductoId, Producto, MaterialId, Producidos) 
						VALUES ($PQRId, '".$productosPedido[$i]->ProductoId."', 
						'".$productosPedido[$i]->Producto."', 
						'".$productosPedido[$i]->MaterialId."', 
						'".$productosPedido[$i]->Producidos."') ";
					}
				}else{
					if ($productosPedido[$i]->ProductoId == 'otro'){
						$cad = "INSERT INTO ProductoPQR (PQRId, Producto, Producidos) 
						VALUES ($PQRId, 
						'".$productosPedido[$i]->Producto."',
						'".$productosPedido[$i]->Producidos."') ";
					} else if ($productosPedido[$i]->ProductoId != 'otro'){
						$cad = "INSERT INTO ProductoPQR (PQRId, ProductoId, Producto, Producidos) 
						VALUES ($PQRId, '".$productosPedido[$i]->ProductoId."', 
						'".$productosPedido[$i]->Producto."', 
						'".$productosPedido[$i]->Producidos."') ";
					}
				}
				$this->db->query($cad);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			return 0;
		}else {
			return 1;
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

			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}
			
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

	// 20/01/2020 ASUP JCSM - Crea alerta para todos los usuarios
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

	function act($PQRId, $dato) {
		$this->db->where('PQRId', $PQRId);
		$this->db->update('HeadPQR', $dato);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			return 1;
		}
	}

}

?>