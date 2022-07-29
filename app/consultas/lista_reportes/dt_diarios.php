<?php require_once('../../../config/conexion.php');

$id_u = $_GET['id'];
$fecha = $_GET['fecha'];
$final = $_GET['final'];

if ($id_u== -1) {
  $sql_reportes="SELECT rd.id AS id, u.nombre AS usuario, e.nombre AS empresa, rd.fecha_apertura as fecha, s.nombre as suceso
FROM usuarios u, empresas e , reporte_diario rd , det_suceso ds, seceso s
         WHERE u.id=rd.id_usuarios_de
         AND rd.id_empresas=e.id
         AND rd.id=ds.id_reporte
         AND ds.id_suceso=s.id
         AND rd.fecha_apertura BETWEEN '$fecha' AND '$final'
         GROUP BY rd.id";
}else{
$sql_reportes="SELECT rd.id AS id, u.nombre AS usuario, e.nombre AS empresa, rd.fecha_apertura as fecha, s.nombre as suceso
FROM usuarios u, empresas e , reporte_diario rd , det_suceso ds, seceso s
         WHERE u.id=rd.id_usuarios_de
         AND rd.id_empresas=e.id
         AND rd.id=ds.id_reporte
         AND ds.id_suceso=s.id
         AND u.id=$id_u
         AND rd.fecha_apertura BETWEEN '$fecha' AND '$final'
         GROUP BY rd.id";
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
             	  $suceso=$reporte['suceso'];


                $resultado ["data"] [] = array(
                   'id' => $id ,
                   'usuario' => $usuario,
                   'empresa' => $empresa,
                   'fecha' => $fecha,
                   'suceso' => $suceso
                );            
			}
            
            mysqli_free_result($consulta_reportes);
			      echo json_encode($resultado);

?>
