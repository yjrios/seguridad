<?php
	$server = "localhost";
	$user = "root";
	$password = "";//poner tu propia contraseña, si tienes una.
	$bd = "sicong_bd";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	
	mysqli_query($conexion,"SET NAMES 'utf8'");//poner el servidor en español
	session_start();
?>

