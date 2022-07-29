<?php  require_once('../../../config/conexion.php');

$id_u = $_SESSION['sesion']['id'];

$evidencia = $_POST['rdioevidenciaRmod'];
$evaluacion = $_POST['rdioevaluacionmod'];
$analisis_e_s = $_POST['txtanalisismod'];
$recomendaciones= $_POST['txtrecomendacionesRmod'];
$acciones_tomadas = $_POST['txtaccionesRmod'];
$encargado = $_POST['txtdirigidoRmod']; 
$cargo_encargado = $_POST['txtcargoRmod']; 
$control = $_POST['controlriesgo']; 



/*echo "cantidad de eventos : ".sizeof($con)." cantidad de detalles:".sizeof($con_det)." cantidad de organismos seleccionados: ".sizeof($con_org);
die();*/

	//CONSULTAR FECHA
	
 				
			//UPDATE REPORTE RIESGO
			$sql_riesgo = "UPDATE `reporte_riesgos` SET `recomendaciones`='$recomendaciones',`acciones`='$acciones_tomadas',`nom_dirigido`='$encargado',`cargo_dirigido`='$cargo_encargado',`analisis_e_s`='$analisis_e_s',`evidencia`='$evidencia',`id_clasificacion`='$evaluacion'  WHERE `id`='$control'";
			$guardar_reporte=mysqli_query($conexion,$sql_riesgo);
			//echo mysqli_error($conexion);
			//cantidad de riesgos a guardar
			if ($guardar_reporte) {
					$error=1;
			}else{
				$error=2;
			}
	



echo $error;


?>