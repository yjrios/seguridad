<?php require_once('../../../config/conexion.php');

$id_u = $_GET['id'];
$fecha = $_GET['fecha'];
$final = $_GET['final'];

if($id_u== -1) {
$sql_reportes="SELECT rr.id AS id, u.nombre AS usuario, e.nombre AS empresa, rr.fecha_apertura as fecha, c.nombre as tipo FROM usuarios u, empresas e , reporte_riesgos rr , det_condicion dc, condicion c, clasificacion cl
 WHERE u.id=rr.id_usuarios_de
         AND rr.id_empresas=e.id 
         AND rr.id=dc.id_reporte
         AND dc.id_condicion=c.id
         AND rr.id_clasificacion=cl.id
         AND rr.fecha_apertura BETWEEN '$fecha' AND '$final' 
         GROUP BY rr.id";

 } else{
    $sql_reportes="SELECT rr.id AS id, u.nombre AS usuario, e.nombre AS empresa, rr.fecha_apertura as fecha, c.nombre as tipo FROM usuarios u, empresas e , reporte_riesgos rr , det_condicion dc, condicion c, clasificacion cl
         WHERE u.id=rr.id_usuarios_de
         AND rr.id_empresas=e.id 
         AND rr.id=dc.id_reporte
         AND dc.id_condicion=c.id
         AND rr.id_clasificacion=cl.id
         AND u.id=$id_u
         AND rr.fecha_apertura BETWEEN '$fecha' AND '$final' 
         GROUP BY rr.id";

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
             	$tipo=$reporte['tipo'];


                $resultado ["data"] [] = array(
                   'id' => $id ,
                   'usuario' => $usuario,
                   'empresa' => $empresa,
                   'fecha' => $fecha,
                   'tipo' => $tipo
                );            
			}
            
            mysqli_free_result($consulta_reportes);
			      echo json_encode($resultado);

?>