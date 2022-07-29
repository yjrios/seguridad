<?php require_once('../../../config/conexion.php');

$id=$_SESSION['sesion']['id_empresa'];
$asistencia=$_POST['vigilantes'];
$fecha=$_POST['fecha'];//si un campo esta disbled no trae el valor
$guardado=0;
$existe=0;


      $sql_fecha="SELECT * FROM `asistencia_vigilantes` WHERE `fecha`='$fecha' and id_empresa='$id'";
      $consulta = mysqli_query($conexion,$sql_fecha);


      if ( mysqli_num_rows($consulta) <= 0 ) {
        $existe=1;
        $guardado=3;

      }
      if ( mysqli_num_rows($consulta) >= 1 ) {
 
        $sql_asistencia="UPDATE `asistencia_vigilantes` 
      				SET `asistencia`=$asistencia
      				where `fecha`='$fecha' and `id_empresa`=$id";

          $consulta_asistencia = mysqli_query($conexion,$sql_asistencia);
         	if ( mysqli_error($conexion) ) {
         		$guardado=1;
            echo mysqli_error($conexion);
         	}else{
         		$guardado=2;
         	}
      }


	echo json_encode($guardado);

 ?>