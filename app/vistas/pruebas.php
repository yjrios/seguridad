<?php 
	setlocale(LC_TIME,"es_ES.UTF-8");
	
$fecha1='2018-12-01';
$fecha = strtotime( $fecha1 );

$dias=date('t',$fecha );

echo $dias;  

$hoy=date('Y-m-d');
echo "<br>".$hoy;


$mes=strftime('%B');

echo "<br>".$mes;


echo 'Fecha actual: '.strftime("%A, %d de %B de %Y").'<br/>'; 


echo strftime("%A %d de %B de %Y");		
?>
