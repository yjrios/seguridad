<?php require_once('../../../config/conexion.php');

$id_u = $_GET['id'];
$fecha = $_GET['fecha'];
$final = $_GET['final'];

if ($id_u== -1) { // todos los usuarios
  $sql_reportes="SELECT re.id AS id, u.nombre AS usuario, e.nombre AS empresa, re.fecha_apertura as fecha, ev.nombre as evento
  FROM empresas e ,reporte_eventos re , det_eventos de , evento ev , det_actuacion da , actuacion a , usuarios u
          where re.id_empresas=e.id 
          AND de.id_reporte=re.id
          AND de.id_evento=ev.id
          AND da.id_reporte=re.id
          AND da.id_actuacion=a.id
          AND u.id=re.id_usuarios_de
          AND re.fecha_apertura BETWEEN '$fecha' AND '$final'
          GROUP BY re.id";
 
}else{

  $sql_reportes="SELECT re.id AS id, u.nombre AS usuario, e.nombre AS empresa, re.fecha_apertura as fecha, ev.nombre as evento
  FROM empresas e ,reporte_eventos re , det_eventos de , evento ev , det_actuacion da , actuacion a , usuarios u
          where re.id_empresas=e.id 
          AND de.id_reporte=re.id
          AND de.id_evento=ev.id
          AND da.id_reporte=re.id
          AND da.id_actuacion=a.id
          AND u.id=re.id_usuarios_de
          AND u.id=$id_u
          AND re.fecha_apertura BETWEEN '$fecha' AND '$final'
          GROUP BY re.id";
}

		$consulta_reportes= mysqli_query($conexion,$sql_reportes);


			$resultado ["data"] = [];
            while ($reporte = mysqli_fetch_assoc($consulta_reportes)) {

            	  $id=$reporte['id'];
              	$usuario=$reporte['usuario'];
              	$empresa=$reporte['empresa'];
                $fecha_n=$reporte['fecha'];
                $obj =  date_create_from_format('Y-m-d', $fecha_n);
                $fecha = date_format($obj, "d-m-Y");
             	$evento=$reporte['evento'];

                $resultado ["data"] [] = array(
                   'id' => $id ,
                   'usuario' => $usuario,
                   'empresa' => $empresa,
                   'fecha' => $fecha,
                   'evento' => $evento
                );            
			}
            
            mysqli_free_result($consulta_reportes);
			       echo json_encode($resultado);

?>