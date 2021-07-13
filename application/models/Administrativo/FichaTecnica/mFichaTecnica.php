<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mFichaTecnica extends CI_Model {
	function obtenerItemEquipo($tipo){
		$sql = "SELECT 
			IE.ItemEquipoId
			,CONCAT(E.Nombre,' [Serial : ',IE.Serial,']') AS nombre
			,IE.EquipoId
		FROM ItemEquipo IE
			LEFT JOIN Equipo E ON IE.EquipoId = E.EquipoId
		WHERE E.TipoInfra = ?";

		return $this->db->query($sql,array($tipo))->result();
	}

	function obtenerUnidadMedida(){
		return $this->db->query("SELECT UnidadMedidaId AS id,nombre FROM UnidadMedida WHERE Estado = 'A'")->result();
	}

	function verificaEquipo(){
		$id 	= $this->input->post('Id');
		$clave  = $this->input->post('Clave');
		$tabla  = $this->input->post('Tabla');

		$sql = "SELECT ".$clave." FROM ".$tabla." WHERE ItemEquipoId = ?";

		$sql2 = "SELECT 
			I.Serial
			,CONCAT(M.marcaid,' | ',M.nombre) AS marcaid
			,F.nombre AS FamiliaId
			,E.Modelo
			,I.Color AS colorEquipo
			,I.CodigoInterno
			,I.CodigoExterno
			,I.FinGarantia
		FROM Itemequipo I
			LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
			LEFT JOIN Marca M ON E.MarcaId = M.marcaid
			LEFT JOIN Familia F ON E.FamiliaId = F.FamiliaId
		WHERE I.ItemEquipoId = ?";

		return array(
			'Equipo' => $this->db->query($sql,array($id))->result(),
			'Data' 	 => $this->db->query($sql2,array($id))->result()
		);
	}

	function guardarValores(){
		$tabla = $this->input->post('Tabla');
		$campo = $this->input->post('Campo');
		$valor = $this->input->post('Valor');

		$this->db->trans_begin();

		$this->db->insert($tabla,array($campo => $valor));
		$id = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return array(
				'Inserta' 	=> 1,
				'Id' 		=> $id
			);
		}
	}

	function editarValores(){
		$id 	= $this->input->post('Id');
		$tabla 	= $this->input->post('Tabla');
		$clave 	= $this->input->post('Clave');
		$campo 	= $this->input->post('Campo');
		$valor 	= $this->input->post('Valor');
		$tipo 	= $this->input->post('Tipo');
		$data 	= $this->input->post('Data');

		$this->db->trans_begin();

		if ($tipo == 2) {
			for ($i=0; $i < count($data); $i++) { 
				$this->db->where($clave,$id);
				$this->db->update($tabla,$data[$i]);
			}
		}else{
			$this->db->where($tabla.'Id',$id);
			$this->db->update($tabla,array($campo => $valor));
		}


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function guardarElementoVehiculo(){
		$data = $this->input->post('Data');

		$this->db->trans_begin();

		$this->db->insert('ElementoVehiculo',$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function obtenerDataTabla(){
		$id 	= $this->input->post('Id');
		$id2 	= $this->input->post('Id2');
		$tabla 	= $this->input->post('Tabla');
		$tipo 	= $this->input->post('Tipo');

		switch ($tabla) {
			case 'ElementoVehiculo':
				return $this->db->query("SELECT * FROM ElementoVehiculo WHERE Tipo = ? AND VehiculoId = ?",array($tipo,$id))->result();
				break;
			case 'tblOperacionTV':
			case 'tblOperacionCV':
			case 'tblOperacionTM':
			case 'tblOperacionCM':
			case 'tblOperacionTE':
			case 'tblOperacionCE':
			case 'tblOperacionTL':
			case 'tblOperacionCL':
				$sql = "SELECT 
					O.OperacionId
					,CASE
						WHEN O.ActividadEquipoId IS NULL 
							THEN O.Operacion
						ELSE AE.Nombre
					END AS Operacion
					,O.ValorFrecuencia
					,CASE O.TipoOperacion
						WHEN 'T'
							THEN
								CASE O.TiempoOperacion
									WHEN '001'
										THEN 'Dias'
									WHEN '002'
										THEN 'Semanas'
									WHEN '003'
										THEN 'Meses'
									WHEN '004'
										THEN 'Anios'
								END
						WHEN 'C'
							THEN U.Nombre
					END AS Tiempo
					,O.UltimaFecha
					,O.ProximaFecha
					,O.DiasAlerta
					,O.ValUltimoConsu
					,O.ValNotifica
					,O.ActividadEquipoId
					,CASE
						WHEN O.ActividadEquipoId IS NULL 
							THEN O.UnidadId
						ELSE AE.UnidadMedidaId
					END AS undMedida
				FROM Operacion O
					LEFT JOIN ActividadEquipo AE ON O.ActividadEquipoId = AE.ActividadEquipoId
					LEFT JOIN UnidadMedida U ON AE.UnidadMedidaId = U.UnidadMedidaId
				WHERE ItemEquipoId = ? AND TipoOperacion = ?";

				return $this->db->query($sql,array($id2,$tipo))->result();
				break;
			case 'tblAnexoV':
			case 'tblAnexoM':
			case 'tblAnexoE':
			case 'tblAnexoL':
				return $this->db->query("SELECT AnexoId,ruta FROM Anexo WHERE Tipo = 'FCHA' AND Id = ?",array($id))->result();
				break;
			default:
				break;
		}
	}

	function eliminaElemento(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('ElementoVehiculoId',$id);
		$this->db->delete('ElementoVehiculo');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function editarElementoVehiculo(){
		$id 	= $this->input->post('Id');
		$data 	= $this->input->post('Data');

		$this->db->trans_begin();

		$this->db->where('ElementoVehiculoId',$id);
		$this->db->update('ElementoVehiculo',$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		} 
	}

	function obtenerOperacion(){
		$id 	= $this->input->post('Id');
		$tipo 	= $this->input->post('Tipo');

		$sql = "SELECT
			ActividadEquipoId  
			,CONCAT(CASE Tipo 
				WHEN 'T' THEN '[ TIEMPO ] :'
				ELSE '[ CONSUMO ] :'
			END,' ',Nombre) AS Nombre
			,TiempoOperacion
			,DiasAlerta
			,UnidadMedidaId
		FROM ActividadEquipo 
		WHERE EquipoId = ? AND Tipo = ?";

		return $this->db->query($sql,array($id,$tipo))->result();
	}

	function guardarOP(){
		$data = $this->input->post('Data');

		if ($data['Operacion'] == '') {
			$data['Operacion'] = null;
		}
		if ($data['ActividadEquipoId'] == '') {
			$data['ActividadEquipoId'] = null;
		}
		if (isset($data['UnidadId']) && $data['UnidadId'] == '') {
			$data['UnidadId'] = null;
		}
		
		$this->db->trans_begin();

		$this->db->insert('Operacion',$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		} 
	}

	function actualizarOP(){
		$id 	= $this->input->post('Id');
		$data 	= $this->input->post('Data');

		if ($data['Operacion'] == '') {
			$data['Operacion'] = null;
		}
		if ($data['ActividadEquipoId'] == '') {
			$data['ActividadEquipoId'] = null;
		}
		if (isset($data['UnidadId']) && $data['UnidadId'] == '') {
			$data['UnidadId'] = null;
		}

		$this->db->trans_begin();

		$this->db->where('OperacionId',$id);
		$this->db->update('Operacion',$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function eliminarOperacion(){
		$id = $this->input->post('Id');

		$this->db->trans_begin();

		$this->db->where('OperacionId',$id);
		$this->db->delete('Operacion');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function guardarAnexo(){
		$files 		= $_FILES;
		$id 		= $this->input->post('Id');
		$nit 		= $this->session->userdata('NIT');
		$nombreDoc 	= "";
		$upFile 	= 0;
		
		$this->db->trans_begin();

		if (count($_FILES) > 0) {
			if(preg_match('/á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['Lista_Anexos']['name'])===1){
				return 4;
			}
			if($files['Lista_Anexos']['size'] > 0){
				$config = array();
				$config['upload_path']      = FCPATH.'/uploads/'.$nit.'/fichasTecnicas/Anexos/';
				$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
				$config['max_size']         = '20048';
				$config['overwrite']        = false;

				$this->load->library('upload');
				$this->load->library('image_lib');

				if (!file_exists($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, true);
				}

				$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
				$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
				$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
				$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
				$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];

				if (strpos($files['Lista_Anexos']['name'], " ") !== false) {
					$nombreDoc = str_replace(' ','_',$files['Lista_Anexos']['name']); 
				}else{
					$nombreDoc = $files['Lista_Anexos']['name'];
				}

				$config['file_name'] = 'FichaTecnica_'.$id."_".$nombreDoc;
				$this->upload->initialize($config);

				$archivo = array(
					'ruta'			=> './uploads/'.$nit.'/fichasTecnicas/Anexos/FichaTecnica_'.$id."_".$nombreDoc,
					'Tipo' 			=> 'FCHA',
					'Id'   			=> $id,
					'Fecha'			=> date("Y-m-d\TH:i:s")
					);
				$this->db->insert('Anexo', $archivo);

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
				}else{
					$subida 			= array();
					$subida['nombre'] 	= $_FILES['Lista_Anexos']['name'];
					$this->upload->initialize($config);
					if ($this->upload->do_upload('Lista_Anexos')) {
						$this->db->trans_commit();
						$data = $this->upload->data();
						$config['image_library'] = 'gd2';
						$config['source_image']   = $data['full_path'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 512;
						$config['height'] = 512;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$subida['estado'] = 1;
						$upFile = 1;
					} else {
						$this->db->trans_rollback();
						$subida['estado'] = 0;
					}
					$subidas[] = $subida['estado'];
				}
			}else{
				return 3;
			}
		}else{
			return 2;
		}

		return $upFile;
	}

	function eliminarAnexo(){
		$id 	= $this->input->post('Id');
		$anexos = $this->db->query("SELECT ruta FROM Anexo WHERE AnexoId = ? ",array($id))->result();

		$this->db->trans_begin();

		$this->db->where('AnexoId',$id);
		$this->db->delete('Anexo');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			if (is_file($anexos[0]->ruta)) {
				unlink($anexos[0]->ruta);
			}
			return 1;
		}
	}

	function eliminarFT(){
		$id 	= $this->input->post('Id');
		$tipo 	= $this->input->post('Tipo');
		$clave 	= $this->input->post('Clave'); 

		$itemId = $this->db->query("SELECT ItemEquipoId FROM ".$tipo." WHERE ".$clave." = ?",array($id))->row()->ItemEquipoId;
		$anexos = $this->db->query("SELECT ruta FROM Anexo WHERE Id = ? AND Tipo = 'FCHA'",array($id))->result();

		$sql = "SELECT 
			HeadIncidenciaId
			,Asunto
			,CASE
				WHEN O.Operacion IS NULL 
					THEN A.Nombre
				ELSE O.Operacion
			END AS Operacion
		FROM HeadIncidencia H
			LEFT JOIN Operacion O ON H.OperacionId = O.OperacionId
			LEFT JOIN ActividadEquipo A ON O.ActividadEquipoId = A.ActividadEquipoId
		WHERE H.OperacionId IN(SELECT OperacionId FROM Operacion WHERE ItemEquipoId = ?)
		ORDER BY H.OperacionId";

		$headId = $this->db->query($sql,array($itemId))->result();

		if (count($headId) > 0) {
			return array(
				'RES' 	=> 2,
				'Data' 	=> $headId  
			);
		}
		$this->db->trans_begin();

		switch ($tipo) {
			case 'Vehiculo':
				$this->db->where('VehiculoId',$id);
				$this->db->delete('ElementoVehiculo');

				$this->db->where('VehiculoId',$id);
				$this->db->delete('Vehiculo');
				break;
			case 'Maquinaria':
				$this->db->where('MaquinariaId',$id);
				$this->db->delete('Maquinaria');
				break;
			case 'EquipoComputo':
				$this->db->where('EquipoComputoId',$id);
				$this->db->delete('EquipoComputo');
				break;
			case 'Locativa':
				$this->db->where('LocativaId',$id);
				$this->db->delete('Locativa');
				break;
			default:
				break;
		}

		$this->db->where('ItemEquipoId',$itemId);
		$this->db->delete('Operacion');

		$this->db->where('Id',$id)
				 ->where('Tipo','FCHA');
		$this->db->delete('Anexo');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			if (count($anexos) > 0) {
				for ($i=0; $i < count($anexos); $i++) { 
					if (is_file($anexos[$i]->ruta)) {
						unlink($anexos[$i]->ruta);
					}
				}
			}
			return array(
				'RES' 	=> 1,
				'Data' 	=> ''
			);
		}
	}

	function obtenerDataFT(){
		$id 	= $this->input->post('Id');
		$tipo 	= $this->input->post('Tipo');
		$clave 	= $this->input->post('Clave');

		return $this->db->query("SELECT * FROM ".$tipo." WHERE ".$clave." = ?",array($id))->result();
	}

	function eliminarTemporal(){
		$id 	= $this->input->post('Id');
		$tabla 	= $this->input->post('Tabla');
		$clave 	= $this->input->post('Clave');

		$itemId = $this->db->query("SELECT ItemEquipoId FROM ".$tabla." WHERE ".$clave." = ?",array($id))->row()->ItemEquipoId;
		$anexos = $this->db->query("SELECT ruta FROM Anexo WHERE Id = ? AND Tipo = 'FCHA'",array($id))->result();

		switch ($tabla) {
			case 'Vehiculo':
				$this->db->where('VehiculoId',$id);
				$this->db->delete('ElementoVehiculo');

				$this->db->where('VehiculoId',$id);
				$this->db->delete('Vehiculo');
				break;
			case 'Maquinaria':
				$this->db->where('MaquinariaId',$id);
				$this->db->delete('Maquinaria');
				break;
			case 'EquipoComputo':
				$this->db->where('EquipoComputoId',$id);
				$this->db->delete('EquipoComputo');
				break;
			case 'Locativa':
				$this->db->where('LocativaId',$id);
				$this->db->delete('Locativa');
				break;
			default:
				break;
		}

		$this->db->where('ItemEquipoId',$itemId);
		$this->db->delete('Operacion');

		$this->db->where('Id',$id)
				 ->where('Tipo','FCHA');
		$this->db->delete('Anexo');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			if (count($anexos) > 0) {
				for ($i=0; $i < count($anexos); $i++) { 
					if (is_file($anexos[$i]->ruta)) {
						unlink($anexos[$i]->ruta);
					}
				}
			}
			return 1;
		}
	}
}