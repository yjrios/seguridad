<?php  require_once('../../../config/conexion.php');

$id_e = $_SESSION['sesion']['id_empresa'];  // esta es la manera correcta 
$id_u = $_SESSION['sesion']['id'];


$fecha = $_POST['txtfecha'];

$dicotomica = $_POST['rdioacompanante'];
$nombreacom = $_POST['txtacompanante'];
$descripcion = $_POST['txtactividades'];
$encargado = $_POST['txtdirigido']; 
$cargo_encargado = $_POST['txtcargo']; 

  $error=1;
	

	if ($dicotomica=="SI") {
		 $acompanado = $nombreacom;
	}else{
		$acompanado ="";
	}

	if ( isset($_POST['items'])) {
	 $con = $_POST['items'];
	 	//CONSULTAR FECHA
		
	 	$sql_fecha = "SELECT * FROM `reporte_diario` WHERE `fecha_apertura`='".$fecha."' AND `id_empresas`='".$id_e."'";
	  							$consulta_fecha = mysqli_query($conexion,$sql_fecha);
	 							$resul = mysqli_num_rows($consulta_fecha);
						
	  	if ($resul > 0) {
	  		$error=2;
	  	}else{
					
	//  			//INSERT REPORTE
	 			$sql_diario = "INSERT INTO `reporte_diario` VALUES (NULL,'$id_e','$id_u','$fecha','$acompanado','$descripcion','$encargado','$cargo_encargado')";
	  			$guardar_reporte=mysqli_query($conexion,$sql_diario);

	// // 			//cantidad de sucesos a guardar
	  			if ($guardar_reporte) {
	  					$consultar_ult = "SELECT MAX(`id`) FROM `reporte_diario`";
	  					$max_arch = mysqli_query($conexion,$consultar_ult);
	  					$fila = mysqli_fetch_array($max_arch);
	  					$id_repor=$fila[0];

	  				for ($i=0; $i <sizeof($con) ; $i++) { 	
	  				  $sql_suceso = "INSERT INTO `det_suceso`(`id_suceso`, `id_reporte`) VALUES ('$con[$i]','$id_repor')";
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