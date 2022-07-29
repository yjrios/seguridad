<?php  require_once('../../../config/conexion.php');


$id_u = $_SESSION['sesion']['id'];


$dicotomica = $_POST['rdioevidenciamod'];
$det_actuacion = $_POST['txtorganismomod'];
$acciones_tomadas = $_POST['txtaccionesmod'];
$recomendaciones= $_POST['txtrecomendacionesmod'];
$encargado = $_POST['txtdirigidoEmod']; 
$cargo_encargado = $_POST['txtcargoEmod']; 
$control = $_POST['controlevento']; 



	if ($dicotomica=="SI") {
		 $evidencia = 0;
	}else{
		$evidencia = 1;
	}

	//CONSULTAR FECHA
	
	
							
					
				//UPDATE REPORTE
				$sql_eventos = "UPDATE `reporte_eventos` SET `evidencia`='$evidencia',`det_actuacion_o`='$det_actuacion',`acciones_tomadas`='$acciones_tomadas',`recomendaciones`='$recomendaciones',`nom_dirigido`='$encargado',`cargo_dirigido`='$cargo_encargado' WHERE `id`='$control'";
				$guardar_reporte=mysqli_query($conexion,$sql_eventos);


				//cantidad de eventos y sus detalles a guardar
				if ($guardar_reporte) {
					$error=1;
				}else{
					$error=2;
				}

	 echo $error;
    

?>