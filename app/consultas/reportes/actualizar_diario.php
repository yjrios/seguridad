<?php  require_once('../../../config/conexion.php');

  // esta es la manera correcta 
$id_u = $_SESSION['sesion']['id'];


$dicotomica = $_POST['rdioacompanantemod'];
$nombreacom = $_POST['txtacompanantemod'];
$descripcion = $_POST['txtactividadesmod'];
$encargado = $_POST['txtdirigidomod']; 
$cargo_encargado = $_POST['txtcargomod']; 
$control = $_POST['controldiario']; 

	if ($dicotomica=="SI") {
		 $acompanado = $nombreacom;
	}
	if ($dicotomica=="NO") {
		$acompanado ="";
	}
	
						
			//Actualizar REPORTE
			$sql_diario = "UPDATE `reporte_diario` SET `acompanado`='$acompanado',`descripcion`='$descripcion',`nom_dirigido`='$encargado',`cargo_dirigido`='$cargo_encargado' WHERE `id`='$control'";

			$guardar_reporte=mysqli_query($conexion,$sql_diario);
			if(mysqli_error($conexion)){
				echo "error : ".mysqli_error($conexion);
			}
			//cantidad de sucesos a guardar
			if ($guardar_reporte) {
				$error=1;
			}else{
				$error=2;
			}


	
	 echo $error;
    

?>