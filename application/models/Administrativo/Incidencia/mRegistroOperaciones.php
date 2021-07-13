<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mRegistroOperaciones extends CI_Model {
	
	function ListadoVencimiento(){
		$tipo = $this->input->post('id');

		$filtro;
     
        switch ($tipo) {
            case '001':
                $filtro = " AND v.vehiculoid IS NOT NULL"; 
            break;
            case '002':
                $filtro = " AND m.maquinariaid IS NOT NULL"; 
            break;
            case '003':
                $filtro = " AND ec.equipocomputoid IS NOT NULL";  
            break;
            case '004':
                $filtro = " AND l.locativaid IS NOT NULL";  
            break;
            default:
                $filtro = '';
            break;
        } 
            
        $sql = "SELECT 
                    it.serial
                    ,eq.nombre as nombreequipo
				    ,f.familiaid
				    ,f.nombre as nombrefamilia
				    ,oct.* 
				    ,DATEDIFF(day,CAST(GETDATE() AS DATE),oct.UltimaFecha) diasSemaforo
				    ,v.vehiculoid
				    ,m.maquinariaid
				    ,ec.equipocomputoid 
				    ,l.locativaid
				    ,v.placa
				    ,CASE 
                        WHEN lg.fecha IS NOT NULL THEN CONVERT(varchar,lg.fecha,23) 
                        ELSE CONVERT(varchar,oct.ultimafecha,23)
                    END AS fecha
                    ,(CASE 
                        WHEN oct.tiempooperacion = '001' THEN 'Dia'
                        WHEN oct.tiempooperacion = '002' THEN 'Semanal'
                        WHEN oct.tiempooperacion = '003' THEN 'Mensual'
                        WHEN oct.tiempooperacion = '004' THEN 'Anual'
                    END) as nombretiempooperacion
                    ,(CASE 
                        WHEN v.vehiculoid IS NOT NULL THEN 'Vehiculo'
                        WHEN m.maquinariaid IS NOT NULL THEN 'Maquinaria' 
                        WHEN ec.equipocomputoid IS NOT NULL  THEN 'Equipo Computo'
                        WHEN l.locativaid IS NOT NULL THEN 'Locativa'
                    END) as ficha
                FROM operacion oct
                    LEFT JOIN Vehiculo v ON oct.ItemEquipoId = v.ItemEquipoId
                    LEFT JOIN maquinaria m ON oct.ItemEquipoId = m.ItemEquipoId
                    LEFT JOIN EquipoComputo ec ON oct.ItemEquipoId = ec.ItemEquipoId
                    LEFT JOIN equipocomputo c ON oct.ItemEquipoId = c.ItemEquipoId
                    LEFT JOIN locativa l ON oct.ItemEquipoId = l.ItemEquipoId
                    LEFT JOIN itemequipo it ON oct.ItemEquipoId = it.ItemEquipoId
                    LEFT JOIN equipo eq ON it.equipoid = eq.equipoid
                    LEFT JOIN familia f ON eq.familiaid = f.familiaid
				    LEFT JOIN (SELECT 
							        max(l.Fecha) AS fecha
							        ,MAX(l.HeadIncidenciaId) AS HeadIncidenciaId
							        ,MAX(operacionid) AS operacionid
							        ,ItemEquipoId 
							        ,max(l.Estado) AS accion
							    FROM logtiempo l
							        LEFT JOIN HeadIncidencia h ON l.HeadIncidenciaId= h.HeadIncidenciaId
							    WHERE l.Estado = 'I' AND operacionid IS NOT NULL
							GROUP BY ItemEquipoId,operacionid) lg ON (it.ItemEquipoId =lg.ItemEquipoId) AND (lg.operacionid = oct.operacionid)
				    WHERE (oct.ItemEquipoId IS NOT NULL) 
                        AND (oct.tipooperacion = 'T')
                        AND (oct.UltimaFecha IS NOT NULL AND it.estado = 'A') 
                        AND (v.ItemEquipoId = oct.ItemEquipoId OR m.ItemEquipoId = oct.ItemEquipoId OR ec.ItemEquipoId = oct.ItemEquipoId OR l.ItemEquipoId = oct.ItemEquipoId) 
 				    $filtro";

		$info = $this->db->query($sql)->result();

        $arrayVehiculo = array();
        $arrayCantidad = array();
        $operacionaldia = 0;
        $operacionporvencer = 0;
        $operacionvencido = 0;
        
        if (count($info) > 0) {
            
            for ($i=0; $i < count($info) ; $i++) { 
                $valor = $info[$i]->ValorFrecuencia;
                $fecha = $info[$i]->fecha;

                switch ($info[$i]->TiempoOperacion) {
                    case '001':
                        $dateTiempo = date("Y-m-d", strtotime(" ".$fecha." + ".(int)$valor." days"));
                    break;
                    case '002':
                        $dateTiempo = date("Y-m-d", strtotime(" ".$fecha." + ".(int)$valor." week"));
                    break;
                    case '003':
                        $dateTiempo = date("Y-m-d", strtotime(" ".$fecha." + ".(int)$valor." month"));  
                    break;
                    case '004':
                        $dateTiempo = date("Y-m-d", strtotime(" ".$fecha." + ".(int)$valor." year"));
                    break;
                } 

                $fechaActual = new \ DateTime("now");
                $fechaOtra = new \ DateTime($dateTiempo);
                $diferencia = $fechaActual->diff($fechaOtra);
                $diferencia = $diferencia->days;
                $diferencia+=1;

                if ($fechaActual<$fechaOtra) {
                    $diferencia = $diferencia * 1;
                }else{
                    $diferencia = $diferencia * -1;
                }

                if($diferencia > $info[$i]->DiasAlerta){
                    $vencimiento = 'aldia';
                    $operacionaldia = $operacionaldia + 1;  
                }else if(($diferencia <= $info[$i]->DiasAlerta) && ($diferencia > -2)){
                    $vencimiento = 'porvencer';
                    $operacionporvencer = $operacionporvencer + 1;    
                }else if ($diferencia < 0) { 
                    $vencimiento = 'vencido';
                    $operacionvencido =  $operacionvencido + 1;
                }
                array_push($arrayVehiculo, array(
                    'Placa'                 => $info[$i]->placa ? $info[$i]->placa : '', 
                    'ficha'                 => $info[$i]->ficha,
                    'nombreequipo'          => $info[$i]->nombreequipo , 
                    'ItemEquipoId'          => $info[$i]->ItemEquipoId, 
                    'nombretiempooperacion' => $info[$i]->nombretiempooperacion,
                    'serial'                => $info[$i]->serial,
                    'nombrefamilia'         => $info[$i]->nombrefamilia, 
                    'Operacion'             => $info[$i]->Operacion, 
                    'UltimaFecha'           => $info[$i]->fecha, 
                    'ValorFrecuencia'       => $info[$i]->ValorFrecuencia, 
                    'PROXIMA'               => $dateTiempo,   
                    'vencimiento'           => $vencimiento
                ));
            }
        }
     
        return $arrayVehiculo;
	}
}

?>