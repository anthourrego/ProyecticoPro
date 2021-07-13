<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mEquipo extends CI_Model {

	function familia(){
		return $this->db->query("SELECT FamiliaId, RTRIM(Nombre) Nombre 
			FROM Familia 
			WHERE Estado = 'A'
			ORDER BY Nombre ASC")->result();
	}

	function marca(){
		return $this->db->query("SELECT RTRIM(marcaid) marcaid, RTRIM(nombre) nombre 
			FROM marca
			WHERE estado = 'A' 
			ORDER BY nombre ASC")->result();
	}

	function listaClientes(){
		$Codigo 	= $this->input->post('Codigo');
		$btn 		= $this->input->post('btn');
		$cliente = '';

		if(($btn == 'btnFastBackward' || $btn == 'btnFastForward') || ($btn == 'btnBackward' && $Codigo == '') || ($btn == 'btnForward' && $Codigo == '')){
			switch($btn){
				case 'btnFastBackward':
				$cliente = $this->db->query("SELECT Codigo 
					FROM Equipo 
					WHERE EquipoId = (
					SELECT TOP 1 EquipoId FROM Equipo ORDER BY EquipoId ASC)");
				break;
				case 'btnFastForward':
				$cliente = $this->db->query("SELECT Codigo 
					FROM Equipo 
					WHERE EquipoId = (
					SELECT TOP 1 EquipoId FROM Equipo ORDER BY EquipoId DESC)");
				break;
				case 'btnBackward':
				$cliente = $this->db->query("SELECT O.Codigo FROM
					(SELECT ROW_NUMBER() OVER(ORDER BY EquipoId ASC) AS n, EquipoId FROM Equipo) T
					LEFT JOIN Equipo O ON T.EquipoId = O.EquipoId
					WHERE T.n = 1");
				break;
				case 'btnForward':
				$cliente = $this->db->query("SELECT O.Codigo FROM
					(SELECT ROW_NUMBER() OVER(ORDER BY EquipoId ASC) AS n, EquipoId FROM Equipo) T
					LEFT JOIN Equipo O ON T.EquipoId = O.EquipoId
					WHERE T.n = 1");
				break;
			}
		}
		if($Codigo != ''){
			switch($btn){
				case 'btnBackward':
				if($Codigo != $cliente){
					$cliente = $this->db->query("SELECT O.Codigo FROM
						(SELECT ROW_NUMBER() OVER(ORDER BY EquipoId ASC) AS n, EquipoId FROM Equipo) T
						LEFT JOIN Equipo O ON T.EquipoId = O.EquipoId
						WHERE T.n = (
						SELECT T.n - 1 FROM
						(SELECT ROW_NUMBER() OVER(ORDER BY EquipoId ASC) AS n, EquipoId, Codigo FROM Equipo) T
						WHERE T.Codigo = '$Codigo'
						)");
				}
				break;
				case 'btnForward':
				if($Codigo != $cliente){
					$cliente = $this->db->query("SELECT O.Codigo FROM
						(SELECT ROW_NUMBER() OVER(ORDER BY EquipoId ASC) AS n, EquipoId FROM Equipo) T
						LEFT JOIN Equipo O ON T.EquipoId = O.EquipoId
						WHERE T.n = (
						SELECT T.n + 1 FROM
						(SELECT ROW_NUMBER() OVER(ORDER BY EquipoId ASC) AS n, EquipoId, Codigo FROM Equipo) T
						WHERE T.Codigo = '$Codigo'
						)");
				}
				break;
			}
		}

		if ($cliente->row() != null)
			$cliente = $cliente->row()->Codigo;
		else
			$cliente = '';

		return $cliente;
	}

	function cargar(){
		$codigo = $this->input->post('codigo');
		$sql = "SELECT
		LTRIM(RTRIM(E.EquipoId)) AS EquipoId
		,LTRIM(RTRIM(E.Codigo)) AS Codigo
		,LTRIM(RTRIM(E.Nombre)) AS Nombre
		,Modelo
		,LTRIM(RTRIM(E.MarcaId)) AS MarcaId
		,LTRIM(RTRIM(M.Nombre)) AS NombreMarca
		,LTRIM(RTRIM(E.FamiliaId)) AS FamiliaId
		,LTRIM(RTRIM(F.Nombre)) AS NombreFamilia
		,LTRIM(RTRIM(E.Dimensiones)) AS Dimensiones
		,LTRIM(RTRIM(E.TipoInfra)) AS TipoInfra
		,LTRIM(RTRIM(E.Estado)) AS Estado
		,'' as foto
		FROM Equipo E
		LEFT JOIN FAmilia F ON E.FamiliaId = F.FamiliaId
		LEFT JOIN Marca M ON E.MarcaId = M.MarcaId
		WHERE E.Codigo = '$codigo'
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

			$this->registrar(1);
			return $this->cargar();
		}
	}

	function registrar($existe = 0){
		$codigo = $this->input->post('codigo');
		$this->db->trans_begin();

		$sql = "INSERT INTO Equipo (Codigo, Estado)
		VALUES ('$codigo','A')";

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
			$_POST['RASTREO']['cambio'] = "Crea Equipo ".$codigo;
			RASTREO();
			$this->db->trans_commit();
			$_POST['RASTREO']['cambio'] = "Carga Equipo ".$codigo;
			return $OperarioId;
		}
	}

	function actualizar($cliente, $nombre, $value, $tabla) {
		if($value == ''){
			$value = NULL;
		}
		$this->db->trans_begin();
		$this->db->where('Codigo', $cliente);
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


	function actualizarImagen(){
		$imagen = $this->input->post('imagen');
		$cliente = $this->input->post('cliente');
		$_POST['RASTREO']['cambio'] = $this->input->post('cambio');
		$_POST['RASTREO']['fecha'] = $this->input->post('fecha');
		$_POST['RASTREO']['programa'] = $this->input->post('programa');

		
		if(isset($_FILES['file'])){
			
			$config = array();
			$config['upload_path'] = FCPATH.'/uploads/'.$this->session->userdata('NIT').'/Equipo';
			$config['allowed_types'] = 'jpg|png|jpeg|gif';
			$config['max_size'] = '20048';
			$config['file_name'] = $cliente;
			$config['overwrite'] = TRUE;


			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("file")) {
				$data = $this->upload->data();
				$subida = $data["file_name"];
	            // Resize
				$config['image_library'] = 'gd2';
				$config['source_image'] = $data['full_path'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 256;
				$config['height'] = 256;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				// $this->db->query("UPDATE tercero SET foto = './uploads/".$this->session->userdata('nit')."/fotos/".$subida."' where id_tercero = '$tercero_id'");
			}
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



	function EliminarEquipo(){
		$cliente = $this->input->post('cliente');

		if($this->db->query("SELECT TOP 1 EquipoId FROM Itemequipo WHERE EquipoId = '$cliente'")->num_rows() > 0){
			return 2;
		}

		$this->db->trans_begin();
		try{
			$this->db->query("DELETE Equipo WHERE EquipoId = '$cliente'");
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
}

?>