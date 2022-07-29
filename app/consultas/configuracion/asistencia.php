<?php  
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');


$id=$_SESSION['sesion']['permisos'];
$mes=$_POST['meses'];
$ano=$_POST['ano'];

$fecha1="$ano-$mes-01";
$fecha = strtotime( $fecha1 );
$dias=date('t',$fecha );//conseguimos la cantidad de dias que tiene el mes de ese año

$salida=0;



//validar que no haya asistencia creada para dicho mes 
$sql="SELECT * FROM `asistencia_vigilantes` WHERE `fecha`='$fecha1'";
$consulta = mysqli_query($conexion,$sql);

$existe=0;
if (mysqli_num_rows($consulta) > 0) {
	$existe=1;
}

		if ($existe==0) {

			$empresas=conseguirEmpresas2($conexion);

			while ($empresa = mysqli_fetch_array($empresas)) {
				for ($i=1; $i <= $dias ; $i++) { 

				   $d= sprintf("%02d",$i);
				   $matricula=$_POST[$empresa["id"]];
				   $sql="INSERT INTO `asistencia_vigilantes` (`fecha`, `asistencia`, `matricula`, `id_empresa`) VALUES ('{$ano}-{$mes}-{$d}', '0', '{$matricula}', '{$empresa["id"]}');";
					//echo "{$ano}-{$mes}-{$d}', '0', '$matricula', '{$empresa["id"]} \n\n";
				   $consulta = mysqli_query($conexion,$sql);
				   if ( mysqli_error($conexion) ) {
						$salida=0;
						return false;
				   }
				}
			}
			$salida=1;

		}
		if ($existe==1) {
			$salida=2;
		}

		echo $salida;
		
