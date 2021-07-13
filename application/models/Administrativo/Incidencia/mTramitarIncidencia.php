<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mTramitarIncidencia extends CI_Model {
	
	function listaActividades(){

		$id = $this->input->post('HeadIncidenciaId');

		$sql ="SELECT 
					TA.TipoActividadId
					,TA.Nombre 
					,CASE WHEN  TA.TipoActividadId = TI.TipoActividadId 
						THEN 1 ELSE 0 
					END Estado
					,CASE WHEN  TA.TipoActividadId = TI.TipoActividadId 
						THEN 'ASIGNADO' ELSE 'SIN ASIGNAR' 
					END EstadoActual
				FROM HeadIncidencia HI
					LEFT JOIN ItemEquipo I ON HI.ItemEquipoId = I.ItemEquipoId
					LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
					LEFT JOIN TipoActividad TA ON E.FamiliaId = TA.FamiliaId
					LEFT JOIN ActividadIncidencia TI ON TA.TipoActividadId = TI.TipoActividadId 
						AND HI.HeadIncidenciaId = TI.HeadIncidenciaId
				WHERE TA.TipoActividadId is not null and HI.HeadIncidenciaId = ?";
		$consulta = $this->db->query($sql,$id);
		return $consulta->result();
	}

	public function anexosAgenda(){

		$supported_image = array(
			'gif',
			'jpg',
			'jpeg',
			'png'
		); 

		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');

		$sql = "SELECT 
					S.Nombre AS Usuario
					,Descripcion
					,FechaRegis
					,Ruta AS Archivo
					,CASE WHEN Privado = 1 
						THEN 'Privado' ELSE 'Publico' 
					END Privado
					,CASE WHEN Privado = 1 
						THEN 'background:antiquewhite' ELSE '' 
					END PrivadoColor
				FROM NotaIncidencia NI
					LEFT JOIN Segur S ON NI.UsuarioId = S.usuarioId
					LEFT JOIN Anexo A ON NI.NotaIncidenciaId = A.Id AND A.Tipo = 'INCI'
				WHERE NI.Estado = 'A' 
					AND NI.HeadIncidenciaId = '$HeadIncidenciaId'
				ORDER BY NotaIncidenciaId DESC";

		$NOTAINCIDENCIA = $this->db->query($sql)->result();

		$datosGeneral = array();

		foreach ($NOTAINCIDENCIA as $nota) {
		 	if (isset($nota->Archivo)) {
				$adjuntos = '';
				$ext = strtolower(pathinfo($nota->Archivo, PATHINFO_EXTENSION));
				if (in_array($ext, $supported_image)) {
					$adjuntos = $adjuntos.'<div class="div-hidden"><a download="'. $nota->Archivo .'" href="'.base_url().$nota->Archivo.'"><i class="fas fa-image"></i> '.$nota->Archivo.'</a> <a href="#" class="btn-hidden span-hidden" title="Ver imagen"><span class="fas fa-arrow-alt-circle-up"></span></a><div data-ocultar><a href="'.base_url().$nota->Archivo.'" target="_blank" class="img-pqr"><img class="w-25" src="'.base_url().$nota->Archivo.'"/></a></div></div>';
				} 
				else {
					$adjuntos = $adjuntos.'<a download="'. $nota->Archivo .'" href="'.base_url().$nota->Archivo.'"><i class="fas fa-file"></i> '.$nota->Archivo.'</a><br/>';
				}
				
				$nota->Descripcion = $nota->Descripcion.'<br/>'.$adjuntos;
			}

			$iconoPublicoPrivado = $nota->Privado == 'Publico' ? 'fa-eye' : 'fa-eye-slash';
			
			$datos = '<tr>
						<td style="width: 35%" class="px-3">
							<div class="row no-gutters">
								<div class="col-9">
									<div class="text-truncate">
										<i class="fas fa-user"></i> <strong>'.$nota->Usuario.'</strong>
									</div>
								</div>
								<div class="col-3 text-right">
									<i class="far '. $iconoPublicoPrivado . '"></i> '.$nota->Privado.'</span>
								</div>
							</div>
							<p class="mt-2"><i class="far fa-clock"></i> '. date("Y-m-d h:i:s A", strtotime($nota->FechaRegis)).'</p>
						</td>
						<td class="px-3" style="width: 65%; '.$nota->PrivadoColor.'">
							'.$nota->Descripcion.'
						</td>
					</tr>
					<tr class="spacer">
						<td colspan="2"></td>
					</tr>';

			array_push($datosGeneral, $datos);
		}

		return $datosGeneral;
	}

	public function historialIncidencia(){
		$incidencia = $this->input->post('HeadIncidenciaId');
		$sql = "SELECT
					DI.FechaRegis,
					S.nombre,
					REPLACE(DI.Descripcion, CHAR(10) ,'<br>') DetalleP
				FROM DetalleIncidencia DI
					LEFT JOIN Segur S ON DI.UsuarioId = S.usuarioId
					LEFT JOIN Dependencia D ON S.DependenciaId = D.DependenciaId
				WHERE DI.HeadIncidenciaId = '$incidencia'";
		$data = $this->db->query($sql)->result();

		return $data;
	}

	public function listaEquipos(){
		$sql = "SELECT 
					I.ItemEquipoId
					,E.Nombre
					,I.Serial
				FROM Itemequipo I
					LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
				WHERE E.Estado = 'A' AND I.Estado = 'A'";

		$consulta = $this->db->query($sql)->result();

		return $consulta;
	}

	function selectTipoPrioridad(){
		$sql = "SELECT 
					TipoPrioridadIncidenciaId
					,Nombre
					,ValorFrecuencia
					,CASE 
						WHEN Tiempo = '001' THEN 'Hora'
						WHEN Tiempo = '002' THEN 'Dia'  
						WHEN Tiempo = '003' THEN 'Semana'  
						WHEN Tiempo = '004' THEN 'Mensual' 
						WHEN Tiempo = '005' THEN 'Anual'
					END Tiempo 
				FROM TipoPrioridadIncidencia 
				WHERE Estado = 'A'
				ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function selectEstado(){
		$sql = "SELECT 
					*
				FROM EstadoIncidencia
				ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function TipoIncidencia(){
		$sql = "SELECT 
					* 
				FROM TipoIncidencia
				WHERE Estado = 'A'
				ORDER BY Nombre ASC";
		$consulta = $this->db->query($sql);
		return $consulta->result();
	}

	function consultaIncidencia($idIncidencia){
		$user = $this->session->userdata('id');
		$sql = "  SELECT 
					HI.HeadIncidenciaId
					,HI.TipoIncidenciaId
					,HI.EstadoIncidenciaId
					,HI.TipoPrioridadIncidenciaId
					,HI.ItemEquipoId
					,HI.OperacionId
					,HI.Ticket
					,HI.Asunto
					,HI.Descripcion
					,HI.Fecha
					,I.Serial
					,E.Nombre AS EstadoPQR
					,E.Cierre AS Cerrada
					,EQ.Nombre AS NombreEquipo
					,HI.Numero
				FROM HeadIncidencia HI
					LEFT JOIN EstadoIncidencia E ON HI.EstadoIncidenciaId = E.EstadoIncidenciaId
					LEFT JOIN ItemEquipo I ON HI.ItemEquipoId = I.ItemEquipoId
					LEFT JOIN Equipo EQ ON I.EquipoId = EQ.EquipoId
				WHERE HI.HeadIncidenciaId = '$idIncidencia'";
		$query = $this->db->query($sql);

		$HeadIncidencia = $query->result();

		if(count($HeadIncidencia) <= 0){
			redirect(base_url().'Administrativo/Incidencia/cTramitarIncidencia/');
		}

		$sql = "SELECT 
					OperacionId
					,Operacion
					,ItemEquipoId 
				FROM Operacion 
				WHERE ItemEquipoId = ".$HeadIncidencia[0]->ItemEquipoId."
				ORDER BY Operacion ASC";
		$query = $this->db->query($sql);
		$SECCIONOPERACION = $query->result();

		$this->db->query("UPDATE Alerta SET Estado = 'C', Ejecutada = GETDATE() WHERE Tipo = 'IN' AND Numero = '$idIncidencia' AND AsignadoA = '$user'");	

		return array($HeadIncidencia[0],$SECCIONOPERACION);
	}

	function qListaTecnicosAsignados(){
		$id = $this->input->post('HeadIncidenciaId');

		$sql = "SELECT 
					TI.TecnicoIncidenciaId
					,TI.UsuarioId
					,S.Nombre
					,S.Cedula
				FROM TecnicoIncidencia TI
				LEFT JOIN segur S ON TI.UsuarioId = S.UsuarioId
				WHERE TI.Estado = 'A' and  TI.HeadIncidenciaId = ?";

		$ListTecnicos = $this->db->query($sql,$id)->result();

		return $ListTecnicos;
	}

	function listaTecnicos(){
		$id = $this->input->post('HeadIncidenciaId');

		$sql = "SELECT 
			S.UsuarioId
			,S.Nombre
			,S.Cedula 
			,TI.Estado
		FROM SEGUR S 
			LEFT JOIN TecnicoIncidencia TI ON TI.UsuarioId = S.UsuarioId AND HeadIncidenciaId = ?
		WHERE TI.Estado <> 'A' or TI.Estado is null";

		$ListUsuarios = $this->db->query($sql,$id)->result();

		return $ListUsuarios;
	}

	function agregarNota($nota) {
		$this->db->trans_begin();
		
		$this->db->insert('NotaIncidencia', $nota);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			$insert_id = $this->db->insert_id();

			//Si le crea un nota se lo envia al rastreo
			$_POST['RASTREO']['fecha'] = date('d-m-Y H:i:s');
			$_POST['RASTREO']['programa'] = $this->input->post('programa');
			$_POST['RASTREO']['cambio'] = $this->input->post('cambio');
			RASTREO();
			return $insert_id; 
		}
	}

	function AdjuntarArchivos($tipo, $id, $incidencia) {
		$files = $_FILES;
		$cpt = count($_FILES['archivos']['name']);
		$subidas = array();

		if($files['archivos']['size'][0] > 0) {
			// Configuración upload
			$config = array();
			$config['upload_path']      = FCPATH.'uploads/'.$this->session->userdata('NIT').'/Incidencia/'  . $incidencia;
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
				$config['file_name'] = 'Anexo_'.$id."_".$_FILES['archivos']['name'];
				$this->upload->initialize($config); 

				$archivo = array(
					'Id'      => $id,
					'Tipo'    => $tipo,
					'Fecha'   => date("d-m-Y H:i:s"),
					'Ruta'    => './uploads/'.$this->session->userdata('NIT').'/Incidencia/' . $incidencia . '/Anexo_'.$id."_".$_FILES['archivos']['name']
				);

				// Inserta la PQR para conseguir su consecutivo
				$this->db->insert('Anexo', $archivo);
				$insert_id = $this->db->insert_id();
				
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

	function eliminarAgregaActividad(){
		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');
		$TipoActividadId  = $this->input->post('id');
		$estado           = $this->input->post('estado');
		$datos            = $this->input->post('datos');
		
		$this->db->trans_begin();

		if($estado == 1) {
			$this->db->where('HeadIncidenciaId', $HeadIncidenciaId);
			$this->db->where('TipoActividadId', $TipoActividadId);
			$this->db->delete('ActividadIncidencia');
		}else{
			$this->db->insert('ActividadIncidencia', $datos);
		}

		$detalleIncidencia = $this->input->post('detalleIncidencia');
		$this->DetalleIncidencia($detalleIncidencia);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function eliminarTecnicosAsignados(){
		$id = $this->input->post('id');
		$UsuarioId = $this->input->post('UsuarioId');
		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');

		$sql = "SELECT * 
 				FROM LogTiempo
 				WHERE UsuarioId = '".$UsuarioId."' and HeadIncidenciaId = $HeadIncidenciaId";
		$LogTiempo = $this->db->query($sql)->result();

		$TecnicoIncidenciaId = $this->input->post('id');
		$datos  = $this->input->post('datos');
		
		$this->db->trans_begin();

		if(count($LogTiempo) > 0){
			$this->db->where('TecnicoIncidenciaId', $TecnicoIncidenciaId);
			$this->db->update('TecnicoIncidencia',$datos);
		}else{		
			$this->db->where('TecnicoIncidenciaId', $id);
			$this->db->delete('TecnicoIncidencia');
		}

		$detalleIncidencia = $this->input->post('detalleIncidencia');
		$this->DetalleIncidencia($detalleIncidencia);

		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function agregarTecnicos(){
		$UsuarioId = $this->input->post('id');
		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');
		$datosUpdate = $this->input->post('datosUpdate');
		$datos  = $this->input->post('datos');

		$sql = "SELECT * 
 				FROM TecnicoIncidencia
				WHERE UsuarioId = '".$UsuarioId."' 
					AND HeadIncidenciaId = $HeadIncidenciaId";
				 
		$Tecnico = $this->db->query($sql)->result();

		$this->db->trans_begin();

		if(count($Tecnico) > 0){
			$this->db->where('HeadIncidenciaId', $HeadIncidenciaId);
			$this->db->where('UsuarioId', $UsuarioId);
			$this->db->update('TecnicoIncidencia',$datosUpdate);
		}else{
			$this->db->insert('TecnicoIncidencia', $datos);
		}

		$detalleIncidencia = $this->input->post('detalleIncidencia');
		$this->DetalleIncidencia($detalleIncidencia);

		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function actualizar() {

		$id = $this->input->post("HeadIncidenciaId");
		$campo = $this->input->post("campo");
		$valor = $this->input->post("valor");
		$historial = $this->input->post("historial");

		$this->db->trans_begin();

		$sql = "UPDATE HeadIncidencia SET $campo = '$valor' WHERE HeadIncidenciaId = $id";

		$detalle = array(
			'HeadIncidenciaId' => $id, 
			'Descripcion' => $historial
		);

		$this->DetalleIncidencia($detalle);

		$this->db->query($sql);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	function qListaActividadesLogTiempo(){
		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');
		
		$sql = "SELECT 
					x.TipoActividadId
					,max(T.Nombre) AS NombreActividad
					,x.UsuarioId
					,max(S.Nombre) NombreUsuario 
					,min(case when orden = '1' then convert(varchar,Fecha,23) else null end) as FechaInicio
					,min(case when orden = '1' then convert(varchar,Fecha,14) else null end) as HoraInicio
					,max(case when orden = '2' then convert(varchar,Fecha,23) else null end) as FechaFin
					,max(case when orden = '2' then convert(varchar,Fecha,14) else null end) as HoraFin
					,min(CASE WHEN orden = '1' then x.logtiempoid else null end) as logTiempoInico
					,max(CASE WHEN orden = '2' then x.logtiempoid else null end) as logTiempoFin								
				FROM (
					SELECT row_number() over(partition by l.tipoactividadid, l.usuarioid, l.Estado,l.HeadIncidenciaId order by l.logtiempoid) as numero
						,CASE WHEN l.Estado = 'I' then '1' else '2' end as orden
						,* 
					FROM logtiempo l
					WHERE l.Estado in('I','T')
				) x
					LEFT JOIN Segur S on x.UsuarioId = S.UsuarioId
					LEFT JOIN TipoActividad T on x.TipoActividadId = T.TipoActividadId      
				WHERE x.HeadIncidenciaId = $HeadIncidenciaId
				GROUP BY x.tipoactividadid, x.usuarioid, x.numero";

		$listaActividadesLog = $this->db->query($sql)->result();

		return $listaActividadesLog;
	}

	public function listaActividadesLogTiempo(){
		$HeadIncidenciaId = $this->input->post('HeadIncidenciaId');
		
		$sql = "SELECT 
					TA.TipoActividadId
					,TA.Nombre 
				FROM HeadIncidencia HI
					LEFT JOIN ItemEquipo I ON HI.ItemEquipoId = I.ItemEquipoId
				LEFT JOIN Equipo E ON I.EquipoId = E.EquipoId
				LEFT JOIN TipoActividad TA ON E.FamiliaId = TA.FamiliaId
				LEFT JOIN ActividadIncidencia TI ON TA.TipoActividadId = TI.TipoActividadId AND HI.HeadIncidenciaId = TI.HeadIncidenciaId
				WHERE TA.TipoActividadId is not null and HI.HeadIncidenciaId = $HeadIncidenciaId";
		$listaactividades = $this->db->query($sql)->result();

		$sql = "SELECT 
					TI.UsuarioId 
					,S.Nombre 
				FROM TecnicoIncidencia TI
				LEFT JOIN Segur S ON TI.UsuarioId = S.UsuarioId
				WHERE TI.HeadIncidenciaId  = $HeadIncidenciaId";
		$listatecnicosInc = $this->db->query($sql)->result();

		return array($listaactividades, $listatecnicosInc);
	}

	public function guardarLogTiempo(){

		$dataIni = $this->input->post('dataIni');
		$dataFin = $this->input->post('dataFin');

		$this->db->trans_begin();

		$this->db->insert('LogTiempo', $dataIni);
		$this->db->insert('LogTiempo', $dataFin);

		$detalleIncidencia = $this->input->post('detalleIncidencia');
		$this->DetalleIncidencia($detalleIncidencia);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	public function actualizarLogTiempo(){
		$LogTiempoIdIni = $this->input->post('logini');
		$LogTiempoIdFin = $this->input->post('logfin');

		$dataIni = $this->input->post('dataIni');
		$dataFin = $this->input->post('dataFin');

		$this->db->trans_begin();

		$this->db->where('LogTiempoId', $LogTiempoIdIni);
		$this->db->update('LogTiempo',$dataIni);

		$this->db->where('LogTiempoId', $LogTiempoIdFin);
		$this->db->update('LogTiempo',$dataFin);

		$detalleIncidencia = $this->input->post('detalleIncidencia');
		$this->DetalleIncidencia($detalleIncidencia);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	public function eliminarLogTiempo(){
		$LogTiempoIdIni = $this->input->post('logini');
		$LogTiempoIdFin = $this->input->post('logfin');

		$this->db->trans_begin();

		$this->db->where('LogTiempoId', $LogTiempoIdIni);
		$this->db->delete('LogTiempo');

		$this->db->where('LogTiempoId', $LogTiempoIdFin);
		$this->db->delete('LogTiempo');

		$detalleIncidencia = $this->input->post('detalleIncidencia');
		$this->DetalleIncidencia($detalleIncidencia);
		

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			RASTREO();
			return 1;
		}
	}

	public function DetalleIncidencia($data){
		$fecha = new DateTime();
		$data['UsuarioId']  = $this->session->userdata('id'); 
		$data['FechaRegis'] = $fecha->format("Y-m-d H:i:s");

		$this->db->insert('DetalleIncidencia', $data);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			
			return 1;
		}
	}

}

?>