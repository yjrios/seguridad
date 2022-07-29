<?php require_once('../../../config/conexion.php');


$id_u = $_POST['id_u'];
$permiso = $_POST['permiso'];
$sede = $_POST['sede'];
$error = 1;


			$sql_actualizar = " UPDATE `usuarios` SET `id_sede`='$sede',`permisos`='$permiso' WHERE `id`= $id_u ";
			$actualizar=mysqli_query($conexion,$sql_actualizar);
			if (!$actualizar) {
				$error=2;
			}

			echo $error;


 ?>