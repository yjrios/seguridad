<?php require_once('../../../config/conexion.php');

$id_e=$_SESSION['sesion']['id_empresa'];
$sql_reportes="SELECT rd.id AS id, u.nombre AS usuario, e.nombre AS empresa, rd.fecha_apertura as fecha, s.nombre as suceso ,rd.nom_dirigido,rd.cargo_dirigido, rd.acompanado,rd.descripcion
        FROM usuarios u, empresas e , reporte_diario rd , det_suceso ds, seceso s 
         WHERE u.id=rd.id_usuarios_de 
         AND rd.id_empresas=e.id 
         AND rd.id=ds.id_reporte 
         AND ds.id_suceso=s.id 
         AND e.id=$id_e
         GROUP BY rd.id";

		$consulta_reportes= mysqli_query($conexion,$sql_reportes);


			$resultado ["data"] = [];
            while ($reporte = mysqli_fetch_assoc($consulta_reportes)) {

            	  $id=$reporte['id'];
              	$usuario=$reporte['usuario'];
              	$empresa=$reporte['empresa'];
              	$fecha_n=$reporte['fecha'];
                $obj =  date_create_from_format('Y-m-d', $fecha_n);
                $fecha = date_format($obj, "d-m-Y");
             	$suceso=['suceso'];


                $resultado ["data"] [] = array(
                   'id' => $id ,
                   'usuario' => $usuario,
                   'empresa' => $empresa,
                   'fecha' => $fecha,
                   'suceso' => $suceso,
                   'cargo' => $reporte['cargo_dirigido'],
                   'dirigido'=> $reporte['nom_dirigido'],
                   'acompanado' => $reporte['acompanado'],
                   'descripcion' => $reporte['descripcion']
                );            
			}
            
            mysqli_free_result($consulta_reportes);
			      echo json_encode($resultado);

?>
