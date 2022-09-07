<?php
require_once('../../../config/conexion.php');
require_once('logger.php');
define('DS', DIRECTORY_SEPARATOR);
$error=0;
$id_repor=0;
$nombrearchivos="";
if (isset($_FILES["files"])) {
    error_log(__LINE__ . ' agregandoRIESGO');
    $result=array();
    foreach ($_FILES["files"] as $key1 => $value1)
        foreach ($value1 as $key2 => $value2)
            $result[$key2][$key1] = $value2;
    $cantidadRegistros=count($result);
    $trueFalse=false;
    error_log(__LINE__ . ' $cantidadRegistros ' . $cantidadRegistros);
    foreach ($result as $key => $item) {
        $dir = dirname(__DIR__,3);
        $rutaFile = "img". DS ."adjuntos". DS ."diario". DS;
        $rutaFileBD = DS . DS ."img". DS . DS ."adjuntos". DS . DS ."diario". DS . DS;
        $nombreFile = $item['name'];
        error_log(__LINE__ . ' $rutaFile ' . $rutaFile);
        $rutaTemporal = $item['tmp_name'];
        if ( !is_dir($dir . DS . $rutaFile) ) {
            mkdir($dir . DS . $rutaFile);
        }
        if (!$trueFalse) {
            error_log(__LINE__ . ' $trueFalse ' . $trueFalse);
            $consultar_ult = "SELECT MAX(`id`) FROM `reporte_diario`";
            $max_arch = mysqli_query($conexion,$consultar_ult);
            $fila = mysqli_fetch_array($max_arch);
            $id_repor=intval($fila[0]);
            $trueFalse=true;
        }
        $rutaupload = $dir . DS . $rutaFile;
        moveralservidor($rutaTemporal,$rutaupload,$nombreFile);
        if($cantidadRegistros===1) {    
            error_log(__LINE__ . ' $cantidadRegistros===1');
            if ($error === 0) {
                error_log(__LINE__ . ' $error===0');
                error_log(__LINE__ . ' $rutaFile ' . $rutaFileBD . ' ID_REPOR ' . $id_repor . ' $nombreFile ' . $nombreFile);
                
                    $anexaradjuntos = "INSERT INTO `adjuntos_diarios` VALUES (NULL,$id_repor,'$rutaFileBD','$nombreFile')";
                    error_log(__LINE__ . ' ' . $anexaradjuntos);
                    $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                
                if (!$anexoExitoso) {
                    $error=6;
                }
            }
        } else {
            error_log(__LINE__ . ' $cantidadRegistros!==1');
            if ($error === 0) {
                error_log(__LINE__ . ' $error !==0');
                if ( ($key + 1) === $cantidadRegistros ) {
                    $nombrearchivos = $nombrearchivos . $nombreFile;
                    error_log(__LINE__ . ' $rutaFile ' . $rutaFile);
                    $anexaradjuntos = "INSERT INTO `adjuntos_diarios` VALUES (NULL,$id_repor,'$rutaFileBD','$nombrearchivos')";
                    $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                    if (!$anexoExitoso) {
                        $error=6;
                    }
                } else {
                    if ($nombrearchivos==="") {
                        $nombrearchivos = $nombreFile . ",";
                    }else{
                        $nombrearchivos = $nombrearchivos . $nombreFile . ",";
                    }
                }
            }
        }
    }    
} else {
    $error = 7;
}
echo $error;


function moveralservidor($rutaTemporal,$rutaFile,$nombreFile) {
    if (!move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile) ) {
        $error=5;
    } else {
        move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile);
    }
}
?>