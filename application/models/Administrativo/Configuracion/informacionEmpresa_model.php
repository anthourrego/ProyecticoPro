<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InformacionEmpresa_model extends CI_Model {

	function TipoOperacionDIAN(){
		return $this->db->query("SELECT TipoOperacionId, Nombre FROM TipoOperacionDIAN ORDER BY Nombre ASC")->result();
	}

	function Empresa(){
		return $this->db->query("SELECT TOP 1
			RTRIM(E.nit) nit
			,RTRIM(E.digitverif) digitverif
			,RTRIM(E.regimen) regimen
			,RTRIM(E.nombre) nombre
			,RTRIM(E.direccion) direccion
			,RTRIM(E.CiudadId) CiudadId
			,RTRIM(E.DptoId) DptoId
			,RTRIM(E.PaisId) PaisId
			,RTRIM(E.telefonos) telefonos
			,RTRIM(E.email) email
			,RTRIM(E.TipoOperacionId) TipoOperacionId
			,RTRIM(E.tipoPersonaDIAN) tipoPersonaDIAN
			,RTRIM(E.RespoFisca) RespoFisca
			,RTRIM(E.TipoRegiDIAN) TipoRegiDIAN
			,RTRIM(E.reprelegal) reprelegal
			,RTRIM(E.codigtribu) codigtribu
			,RTRIM(E.CodigoCIIU) CodigoCIIU
			,RTRIM(E.cierre) cierre
			,RTRIM(E.anocierre) anocierre
			,RTRIM(E.mensafactu) mensafactu
			,RTRIM(C.nombre) CiudadIdNombre
			,RTRIM(D.nombre) DptoIdNombre
			,RTRIM(P.nombre) PaisIdNombre
			,(E.Imagen) AS Fondo
		FROM Empresa E
		LEFT JOIN Ciudad C ON E.CiudadId = C.CiudadId
		LEFT JOIN Dpto D ON E.DptoId = D.DptoId
		LEFT JOIN Pais P ON E.PaisId = P.PaisId
		")->result();
	}

	function ResponsabilidadFiscal(){
		return $this->db->query("SELECT RespoFiscaId, Nombre FROM ResponsabilidadFiscal ORDER BY Nombre ASC")->result();
	}

	function actualizarBD(){
		$campo = $_POST['campo'];
		$valor = $_POST['valor'];

		$this->db->trans_begin();
		$this->db->query("IF EXISTS (SELECT Codigo FROM Empresa)
			BEGIN
			UPDATE Empresa SET $campo = ".($valor == '' ? "null" : "'$valor'")."
			END
		ELSE
			BEGIN
			INSERT INTO EMPRESA ($campo) VALUES (".($valor == '' ? "null" : "'$valor'").")
			END");

		if ($this->db->trans_status() == true) {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		} else {
			$this->db->trans_rollback();
			return 0;
		}
	}

	function cargarForanea(){
		$tabla = $_POST['tabla'];
		$value = $_POST['value'];
		$nombre = $_POST['nombre'];
		$this->db->select('nombre')
				 ->where($nombre, $value);
		$consulta = $this->db->get($tabla)->result();
		if(count($consulta) > 0){
			return $consulta;
		}else{
			return 0;
		}
	}

	function actualizarFondo(){
		if (isset($_FILES['Lista_Anexos'])){
			if(preg_match('/#|"|á|é|í|ó|ú|Á|É|Í|Ó|Ú|à|è|ì|ò|ù|À|È|Ì|Ò|Ù|ä|ë|ï|ö|ü|Ä|Ë|Ï|Ö|Ü|â|ê|î|ô|û|Â|Ê|Î|Ô|Û|ý|Ý|ÿ/', $_FILES['Lista_Anexos']['name'])===1){
				echo 3;
				return 3;
			}
		}

		$files = $_FILES;
		if (count($files) > 0) {
			$cpt = count($_FILES['Lista_Anexos']['name']);
		}
		$subidas = array();
		if (count($files) == 0) {
			echo "No se han seleccionado archivos";
		}else{
			if($files['Lista_Anexos']['size'] > 0){

				$ruta = 'uploads/'.$this->session->userdata('NIT').'/InformacionEmpresa';

				$config = array();
				$config['upload_path']      = FCPATH.'/' . $ruta;
				$config['allowed_types']    = 'png|jpg';
				$config['max_size']         = '30048';
				$config['overwrite']        = true;
				$config['file_name'] = 'fondo.png';
				
				$this->load->library('upload');
				$this->load->library('image_lib');

				if (!file_exists($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, true);
				}
				
				//SUBIDA DE CADA ARCHIVO
				$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
				$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
				$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
				$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
				$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];
					
				
				$this->upload->initialize($config);
				if ($this->upload->do_upload('Lista_Anexos')) {
					$data = $this->upload->data();

					if ($data["image_width"] > 1920 && $data["image_height"] > 1080) {
						$config['width'] = 1920;
						$config['height'] = 1080;
					} else if ($data["image_width"] > 1920){
						$config['width'] = 1920;
					} else if($data["image_height"] > 1080){
						$config['height'] = 1080;
					}

					//RESIZE
					$config['image_library'] = 'gd2';
					$config['source_image'] = $data['full_path'];
					$config['maintain_ratio'] = true;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);

					if ($this->image_lib->resize()) {
						$datosConexion = array(
							'dsn'	=> '',
							'hostname' => "SQLGESTIONWEB\GESTIONWEB,1433",
							'username' => 'sa',
							'password' => '123/admin.*',
							'database' => 'GESTION_CONF_PROSOF',
							'dbdriver' => 'sqlsrv',
							'dbprefix' => '',
							'pconnect' => FALSE,
							'db_debug' => TRUE,
							'cache_on' => FALSE,
							'cachedir' => '',
							'char_set' => 'utf8',
							'dbcollat' => 'utf8_general_ci',
							'swap_pre' => '',
							'encrypt' => FALSE,
							'compress' => FALSE,
							'stricton' => FALSE,
							'failover' => array(),
							'save_queries' => TRUE
						);
			
						$db2 = $this->load->database($datosConexion, TRUE);

						$this->db->trans_begin();
						$db2->trans_begin();

						$this->db->query("UPDATE Empresa SET Imagen = '" . ($ruta . '/fondo.png') . "'");
						$db2->query("UPDATE Cliente SET Imagen = '" . ($ruta . '/fondo.png') . "' WHERE Nit = '" . $this->session->userdata('NIT') . "'");

						if ($db2->trans_status() == true && $this->db->trans_status() == true) {
							
							$this->db->trans_commit();
							$db2->trans_commit();

							$_POST["RASTREO"]['fecha'] = $this->input->post('fecha');
							$_POST["RASTREO"]['programa'] = $this->input->post('programa');
							$_POST["RASTREO"]['cambio'] = $this->input->post('cambio'); 
							RASTREO();
							echo 1;
						} else {
							$this->db->trans_rollback();
							$db2->trans_rollback();

							if (file_exists(@$data['full_path'])) {
								unlink($data['full_path']);                
							}
							//echo "No se pudieron actualizar los datos.";
							echo "No se ha guardado la imagen";
						}

						
					} else {
						echo "No se ha guardado la imagen";
					}
				} else {
					echo "No se ha guardado la imagen";
				}
			}else{
				echo "No se han seleccionado archivos";
			}
		}
	}

	function quitarFondo(){
		$datosConexion = array(
			'dsn'	=> '',
			'hostname' => "SQLGESTIONWEB\GESTIONWEB,1433",
			'username' => 'sa',
			'password' => '123/admin.*',
			'database' => 'GESTION_CONF_PROSOF',
			'dbdriver' => 'sqlsrv',
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => TRUE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => FALSE,
			'compress' => FALSE,
			'stricton' => FALSE,
			'failover' => array(),
			'save_queries' => TRUE
		);

		$db2 = $this->load->database($datosConexion, TRUE);

		$this->db->trans_begin();
		$db2->trans_begin();

		$rutaFondo = $db2->query("SELECT Imagen FROM Cliente WHERE Nit = '" . $this->session->userdata('NIT') . "'")->result();

		$this->db->query("UPDATE Empresa SET Imagen = null");
		$db2->query("UPDATE Cliente SET Imagen = null WHERE Nit = '" . $this->session->userdata('NIT') . "'");

		if ($db2->trans_status() == true && $this->db->trans_status() == true) {
			
			$this->db->trans_commit();
			$db2->trans_commit();

			if (file_exists('./' . $rutaFondo[0]->Imagen)) {
				unlink('./' . $rutaFondo[0]->Imagen);                
			}
			
			RASTREO();
			return 1;
			//echo var_dump($rutaFondo[0]);
		} else {
			$this->db->trans_rollback();
			$db2->trans_rollback();
			//echo "No se pudieron actualizar los datos.";
			return "Error al quitar la imagen";
		}
	}
}

?>