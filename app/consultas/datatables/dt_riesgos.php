<?php require_once('../../../config/conexion.php');

$id_e=$_SESSION['sesion']['id_empresa'];
$sql_reportes="SELECT rr.id AS id, u.nombre AS usuario, e.nombre AS empresa, rr.fecha_apertura as fecha, c.nombre as tipo ,rr.nom_dirigido,rr.cargo_dirigido, rr.analisis_e_s, rr.recomendaciones, rr.acciones,rr.evidencia,rr.id_clasificacion
 FROM usuarios u, empresas e , reporte_riesgos rr , det_condicion dc, condicion c, clasificacion cl
 WHERE u.id=rr.id_usuarios_de
         AND rr.id_empresas=e.id 
         AND rr.id=dc.id_reporte
         AND dc.id_condicion=c.id
         AND rr.id_clasificacion=cl.id
         AND e.id=$id_e 
         GROUP BY rr.id";

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
                   'tipo' => $tipo,
                   'cargo' => $reporte['cargo_dirigido'],
                   'dirigido'=> $reporte['nom_dirigido'],
                   'analisis'=> $reporte['analisis_e_s'],
                   'recomendaciones'=> $reporte['recomendaciones'],
                   'acciones'=> $reporte['acciones'],
                   'clasificacion'=> $reporte['id_clasificacion'],
                   'evidencia'=> $reporte['evidencia']
                );            
			}
            
            mysqli_free_result($consulta_reportes);
			      echo json_encode($resultado);

?>