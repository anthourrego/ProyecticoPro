<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mFichasTecnicas extends CI_Model {
	
	function SelectItemequipo(){
		$TipoInfra        = $this->input->post('TipoInfra');

		$sql = "SELECT I.ItemEquipoId, E.Nombre +' - Serial '+ I.serial as Nombre ,I.EquipoId 
		FROM Itemequipo I
		LEFT JOIN Equipo E on I.EquipoId = E.EquipoId
		WHERE TipoInfra = ?";
		$consulta = $this->db->query($sql,array($TipoInfra))->result();
		return $consulta;
	}

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

	function validarItemequipoEquipo(){
		$informacion = array();
		$data 	                = $this->input->post('Data');
		$ItemEquipoId           = $this->input->post('ItemEquipoId');
		$tabla                  = $this->input->post('Ficha');
		$ItemeEquipoIdAnterior  = $this->input->post('ItemeEquipoIdAnterior');

		$this->db->where('ItemequipoId', $ItemeEquipoIdAnterior);
		$this->db->delete($tabla);

		$this->db->where('ItemEquipoId', $ItemEquipoId);
		$consulta =  $this->db->get($tabla)->result();
		
		if($consulta){
			return 1;
		}
		if($ItemEquipoId){
			$sql = "SELECT I.Serial
			,I.FinGarantia
			,I.CodigoInterno
			,I.CodigoExterno
			,I.Proveedor
			,I.Color
			,E.Nombre
			,F.Nombre as Familia
			,M.Nombre as Marca
			,Modelo
			FROM Itemequipo I
			LEFT JOIN Equipo E on I.EquipoId = E.EquipoId
			LEFT JOIN Familia F on E.FamiliaId = F.FamiliaId
			LEFT JOIN marca M on E.MarcaId = M.marcaid
			WHERE I.ItemEquipoId = ?";
			$consulta = $this->db->query($sql,array($ItemEquipoId))->result();


			$this->db->insert($tabla, $data);
			$FichaId = $this->db->insert_id();

			$informacion['datosEquipo']  = $consulta;
			$informacion['ItemEquipoId'] = $ItemEquipoId;
			$informacion['FichaId']      = $FichaId;
		}else{
			return 1;
		}
		return $informacion;
	}

	function DatosEquipoFicha(){
		$informacion = array();

		$ItemEquipoId           = $this->input->post('ItemEquipoId');
		$tabla                  = $this->input->post('Ficha');

		$sql = "SELECT I.Serial
		,I.FinGarantia
		,I.CodigoInterno
		,I.CodigoExterno
		,I.Proveedor
		,I.Color
		,E.Nombre
		,F.Nombre as Familia
		,M.Nombre as Marca
		,Modelo
		FROM Itemequipo I
		LEFT JOIN Equipo E on I.EquipoId = E.EquipoId
		LEFT JOIN Familia F on E.FamiliaId = F.FamiliaId
		LEFT JOIN marca M on E.MarcaId = M.marcaid
		WHERE I.ItemEquipoId = ?";

		$this->db->where('ItemEquipoId', $ItemEquipoId);
		$consulta2 =  $this->db->get($tabla)->result();
		$consulta = $this->db->query($sql,array($ItemEquipoId))->result();

		$informacion['datosEquipo']  = $consulta;
		$informacion['datosficha'] = $consulta2;
		
		
		return $informacion;
	}

	function actualizar($cliente, $nombre, $value, $tabla) {
		if($value == ''){
			$value = NULL;
		}
		$this->db->trans_begin();
		$this->db->where('ItemEquipoId', $cliente);
		$this->db->update($tabla, array($nombre => $value));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			RASTREO();
			$this->db->trans_commit();
			return 1;
		}
	}

	function eliminarDatosFicha(){
		$tabla = $this->input->post('tabla');
		$ItemEquipoId = $this->input->post('ItemEquipoId');

		$this->db->trans_begin();

		$this->db->where('ItemequipoId', $ItemEquipoId);
		$this->db->delete($tabla);


		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			return 1;
		}
	}

	function eliminar(){
		$id = $this->input->post('id');
		$tabla = $this->input->post('tabla');

		$this->db->trans_begin();

		$this->db->where('ItemequipoId', $id);
		$this->db->delete($tabla);


		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function eliminarOperacion(){
		$id = $this->input->post('id');
		$this->db->trans_begin();

		$this->db->where('OperacionId', $id);
		$this->db->delete('Operacion');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function eliminarElemento(){
		$id    = $this->input->post('id');
		$tabla = $this->input->post('tabla');
		$value = $this->input->post('value');
		$this->db->trans_begin();

		$this->db->where($value, $id);
		$this->db->delete($tabla);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function uploadImg(){

		if (isset($_FILES['Lista_Anexos'])){
			if(preg_match('/#|"|á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['Lista_Anexos']['name'])===1){
				return 3;
			}
		}
		$codigo = $this->input->post('codigo');
		$files = $_FILES;
		$nombreDoc = "";
		$cpt = count($_FILES['Lista_Anexos']['name']);
		$subidas = array();
		if($files['Lista_Anexos']['size'] > 0){
			// Configuración upload
			$config = array();
			$config['upload_path']      = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/fichasTecnicas/Anexos';
			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');
			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}
			// Subida de cada archivo
			$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
			$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
			$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
			$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
			$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];
			if (strpos($files['Lista_Anexos']['name'], " ") == true) {
				$nombreDoc = str_replace(' ','_',$files['Lista_Anexos']['name']); 
			}else{
				$nombreDoc = $files['Lista_Anexos']['name'];
			}
			$config['file_name'] = 'Ficha_'.$codigo."_".$nombreDoc;
			$this->upload->initialize($config);
			$this->db->trans_begin();
			$archivo = array(
				'Id'      => $codigo,
				'Tipo'    => 'FCHA',
				'Fecha'   => date("Y-m-d"),
				'Ruta'    => './uploads/'.$this->session->userdata('NIT').'/fichasTecnicas/Anexos/Ficha_'.$codigo."_".$nombreDoc
				);
				// Inserta la PQR para conseguir su consecutivo
			$this->db->insert('Anexo', $archivo);
			$insert_id = $this->db->insert_id();
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$subida = array();
				$subida['nombre'] = $_FILES['Lista_Anexos']['name'];
				if ($this->upload->do_upload('Lista_Anexos')) {
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
					$this->db->trans_commit();
					$subida['estado'] = 1;
				} else {
					$this->db->trans_rollback();
					$subida['estado'] = 0;
				}
				array_push($subidas, $subida);
			}
			
		}else{
			return 0;
		}

		return 1;
	}

	function obtenerAnexos(){
		$ItemEquipoId = $this->input->post('ItemEquipoId');
		$sql="SELECT * FROM Anexo
		WHERE Id = $ItemEquipoId AND Tipo = 'FCHA'";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function guardarValores(){
		$data   = $this->input->post('data');
		$tabla  = $this->input->post('tabla');

		$this->db->insert($tabla, $data);
		$dataid = $this->db->insert_id();

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function guardarValoresVehiculo(){
		$data    = $this->input->post('data');
		$tabla   = $this->input->post('tabla');
		$ItemEquipoId  = $this->input->post('ItemEquipoId');

		$this->db->where('ItemEquipoId',$ItemEquipoId);
		$Vehiculo = $this->db->get('Vehiculo')->result();

		$data['VehiculoId'] = $Vehiculo[0]->VehiculoId;
		$this->db->insert($tabla, $data);
		$dataid = $this->db->insert_id();

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function actualizarDatos(){
		$data      = $this->input->post('data');
		$tblNombre = $this->input->post('tabla');
		$value     = $this->input->post('value');
		$nombre    = $this->input->post('nombre');

		$this->db->where($nombre, $value);
		$this->db->update($tblNombre, $data );

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function cargarDatosTablas(){
		$tblNombre = $this->input->post('tabla');
		$value = $this->input->post('value');
		$nombre = $this->input->post('nombre');

		$this->db->where($nombre,$value);
		return $this->db->get($tblNombre)->result();
	}
	
	function cargarDatosTablasVehiculo(){
		$ItemEquipoId = $this->input->post('ItemEquipoId');

		$this->db->where('ItemEquipoId',$ItemEquipoId);
		$Vehiculo = $this->db->get('Vehiculo')->result();
	
		if(count($Vehiculo)){
			$data['VehiculoId'] = $Vehiculo[0]->VehiculoId;
			$this->db->where('VehiculoId',$Vehiculo[0]->VehiculoId);
			return $this->db->get('ElementoVehiculo')->result();
		}else{
			return 0;
		}
	}

	function actualizarDatoSElemento(){
		$data      = $this->input->post('data');
		$tblNombre = $this->input->post('tabla');
		$id     = $this->input->post('id');


		$this->db->where('ElementoVehiculoId',$id);
		$this->db->update('ElementoVehiculo', $data );

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function eliminarItemAnexo(){
		$id = $this->input->post('id');
		$ruta = $this->db->query("SELECT Ruta FROM Anexo WHERE AnexoId = '$id'")->row()->Ruta;

		$this->db->trans_begin();

		$this->db->where('AnexoId',$id);
		$this->db->delete('Anexo');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			if (is_file($ruta)) {
				unlink($ruta);
			}
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
		FROM ActividadEquipo 
		WHERE EquipoId = ? AND Tipo = ?";

		return $this->db->query($sql,array($id,$tipo))->result();
	}
}
?>