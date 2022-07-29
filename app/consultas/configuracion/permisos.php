<?php  
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');

$id=$_POST['id_u'];
	
	$sql_usuario="SELECT * FROM `usuarios` WHERE `id`= $id";

    $consulta_usuario= mysqli_query($conexion,$sql_usuario);
    $usuario = mysqli_fetch_array($consulta_usuario); 
	$sede=$usuario['id_sede'];
	$permiso=$usuario['permisos'];

 			$resultado = array(
 				'sede' => $sede,
                'permiso' => $permiso
				);
	echo json_encode($resultado, JSON_FORCE_OBJECT);
			
 ?>