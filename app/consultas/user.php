<?php require_once ('../../config/conexion.php'); 

$validar=""; 
	//recoger datos de formulario
	if (isset($_REQUEST)) {
		$usuario= trim($_REQUEST['user']); 
		$contraseña=trim($_REQUEST['contraseña']); 
	}

	//consulta de datos del usuario ingresado
	$sql="SELECT * FROM `usuarios` WHERE `usuario`= '$usuario'";
	$consulta= mysqli_query($conexion,$sql);

	if ($consulta && mysqli_num_rows($consulta) == 1) {
			$datos=mysqli_fetch_assoc($consulta);

			//comprobamos la cotraseña
			//$verify = password_verify($contraseña,$datos['clave']); if ($verify){};
			if ($contraseña == $datos['clave'] ){ //si contraseñas son iguales (true) 
				$validar=1;
			// Utilizar una sesion para guardar el usuario logeado
			  $_SESSION["sesion"] = $datos;
			  $_SESSION["meses"] = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			}else{
				$validar=2;
			}


	}else{
		//usuario no exite
			$validar=3;
	}

	echo json_encode($validar, JSON_FORCE_OBJECT);
?>
