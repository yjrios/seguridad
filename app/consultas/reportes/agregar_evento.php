<?php  require_once('../../../config/conexion.php');
require_once('logger.php');
$id_e = $_SESSION['sesion']['id_empresa']; // variable de tipo session ya creada al seleccionar empresa
$id_u = $_SESSION['sesion']['id'];


$fecha = $_POST['txtfechaE'];

$dicotomica = $_POST['rdioevidencia'];
$det_actuacion = $_POST['txtorganismo'];
$acciones_tomadas = $_POST['txtacciones'];
$recomendaciones= $_POST['txtrecomendaciones'];
$encargado = $_POST['txtdirigidoE']; 
$cargo_encargado = $_POST['txtcargoE']; 


/*echo "cantidad de eventos : ".sizeof($con)." cantidad de detalles:".sizeof($con_det)." cantidad de organismos seleccionados: ".sizeof($con_org);
die();*/

	if ($dicotomica=="SI") {
		 $evidencia = 0;
	}else{
		$evidencia = 1;
	}

	if ( isset($_POST['items']) && isset($_POST['itemstext']) ) {
		$con = $_POST['items'];
		$con_det = $_POST['itemstext'];

		//CONSULTAR FECHA
		$error=1;
		$sql_fecha = "SELECT * FROM `reporte_eventos` WHERE `fecha_apertura`='".$fecha."' AND `id_empresas`='".$id_e."'";
			$consulta_fecha = mysqli_query($conexion,$sql_fecha);
			$resul = mysqli_num_rows($consulta_fecha);
								
		if ($resul > 0) {
			$error=2;
		}else {
			
					error_log(__LINE__ . ' $id_e ' . $id_e . ' $id_u ' . $fecha . ' $id_u ' . $evidencia . ' $id_u ' . $det_actuacion . ' $acciones_tomadas ' . $acciones_tomadas . ' $recomendaciones ' . $recomendaciones . ' $encargado ' . $encargado . ' $cargo_encargado ' . $cargo_encargado);
					//INSERT REPORTE
					$sql_eventos = "INSERT INTO `reporte_eventos` VALUES (NULL,'$id_e','$id_u','$fecha','$evidencia','$det_actuacion','$acciones_tomadas','$recomendaciones','$encargado','$cargo_encargado')";
					$guardar_reporte=mysqli_query($conexion,$sql_eventos);


					//cantidad de eventos y sus detalles a guardar
					if ($guardar_reporte) {
						
						$consultar_ult = "SELECT MAX(`id`) FROM `reporte_eventos`";
											$max_arch = mysqli_query($conexion,$consultar_ult);
											$fila = mysqli_fetch_array($max_arch);
											$id_repor=$fila[0];

						for ($i=0; $i <sizeof($con) ; $i++) { 
						 $id_evento=$con[$i]-1;	
						 $sql_evento_y_det = "INSERT INTO `det_eventos` (`id_reporte`, `id_evento`, `det_evento`)  
												VALUES ('$id_repor','$con[$i]' ,'$con_det[$id_evento]')";
												//echo "id de evento es $con[$i] y el detalle del evento es $con_det[$id_evento]";
							$guardar_evento=mysqli_query($conexion,$sql_evento_y_det);
							if (!$guardar_evento) {
								$error=3;
							}
					    }

					    //guardar cantidad de organismos
					    if (isset($_POST['itemsorg']) ) {
					    	$con_org = $_POST['itemsorg'];
					    	for ($i=0; $i <sizeof($con_org) ; $i++) { 	
								$sql_evento_y_det = "INSERT INTO `det_actuacion`(`id_reporte`, `id_actuacion`) VALUES ('$id_repor','$con_org[$i]')";
								$guardar_evento=mysqli_query($conexion,$sql_evento_y_det);
								if (!$guardar_evento) {
									$error=3;
								}
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