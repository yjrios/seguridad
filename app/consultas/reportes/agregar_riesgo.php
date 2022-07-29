<?php  require_once('../../../config/conexion.php');

$id_e = $_SESSION['sesion']['id_empresa']; // variable de tipo session ya creada al seleccionar empresa
$id_u = $_SESSION['sesion']['id'];


$fecha = $_POST['txtfechaR'];

$evidencia = $_POST['rdioevidenciaR'];
$evaluacion = $_POST['rdioevaluacion'];
$analisis_e_s = $_POST['txtanalisis'];
$recomendaciones= $_POST['txtrecomendacionesR'];
$acciones_tomadas = $_POST['txtaccionesR'];
$encargado = $_POST['txtdirigidoR']; 
$cargo_encargado = $_POST['txtcargoR']; 


/*echo "cantidad de eventos : ".sizeof($con)." cantidad de detalles:".sizeof($con_det)." cantidad de organismos seleccionados: ".sizeof($con_org);
die();*/
if ( isset($_POST['items']) ) {
	$con = $_POST['items'];  
	//CONSULTAR FECHA
	$error=1;
	$sql_fecha = "SELECT * FROM `reporte_riesgos` WHERE `fecha_apertura`='".$fecha."' AND `id_empresas`='".$id_e."'";
	$consulta_fecha = mysqli_query($conexion,$sql_fecha);
	$resul = mysqli_num_rows($consulta_fecha);
							
	if ($resul > 0) {
		$error=2;
	}else{ 
							
			//INSERT REPORTE RIESGO
			$sql_diario = "INSERT INTO `reporte_riesgos`(`id`, `id_empresas`, `id_usuarios_de`, `fecha_apertura`, `evidencia`, `id_clasificacion`, `analisis_e_s`, `recomendaciones`, `acciones`, `nom_dirigido`, `cargo_dirigido`) VALUES (NULL,'$id_e' , '$id_u' ,'$fecha','$evidencia', '$evaluacion','$analisis_e_s','$recomendaciones','$acciones_tomadas', '$encargado','$cargo_encargado')";
			$guardar_reporte=mysqli_query($conexion,$sql_diario);
			//echo mysqli_error($conexion);
			//cantidad de riesgos a guardar
			if ($guardar_reporte) {
					$consultar_ult = "SELECT MAX(`id`) FROM `reporte_riesgos`";
					$max_arch = mysqli_query($conexion,$consultar_ult);
					$fila = mysqli_fetch_array($max_arch);
					$id_repor=$fila[0];

				for ($i=0; $i <sizeof($con) ; $i++) { 	
				  $sql_suceso = "INSERT INTO `det_condicion`(`id_reporte`, `id_condicion`) VALUES ('$id_repor','$con[$i]')";
				  $guardar_suceso=mysqli_query($conexion,$sql_suceso);
				  if (!$guardar_suceso) {
						$error=3;
				   }
				}
			}else{
				$error=3;
			}
	}

}else{
	$error=4;
}

echo $error;


?>