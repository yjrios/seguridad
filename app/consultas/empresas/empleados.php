<?php require_once('../../../config/conexion.php');

$id=$_SESSION['sesion']['id_empresa'];
$fecha=$_POST['fecha'];
	
$sql_cantidad="SELECT * FROM `asistencia_vigilantes` WHERE `fecha`='$fecha' AND `id_empresa`=$id";

    $consulta_cantidad = mysqli_query($conexion,$sql_cantidad);
    $cantidad = mysqli_fetch_array($consulta_cantidad); 



 			$resultado = array(
 				'matricula' => $cantidad['matricula'],
                'asistencia' => $cantidad['asistencia']
				);
	echo json_encode($resultado, JSON_FORCE_OBJECT);

 ?>