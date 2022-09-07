<?php
require_once('../../../config/conexion.php');
require_once('logger.php');
define('DS', DIRECTORY_SEPARATOR);
$error=0;
$id_repor=0;
$nombrearchivos="";
if (isset($_FILES["files"])) {
    $result=array();
    foreach ($_FILES["files"] as $key1 => $value1)
        foreach ($value1 as $key2 => $value2)
            $result[$key2][$key1] = $value2;

    $cantidadRegistros=count($result);
    $trueFalse=false;
    foreach ($result as $key => $item) {
        error_log(__LINE__);
        $dir = dirname(__DIR__,3);
        $rutaFile = "img". DS ."adjuntos". DS ."evento". DS;
        $rutaFileBD = DS . DS ."img". DS . DS ."adjuntos". DS . DS ."evento". DS . DS;
        $nombreFile = $item['name'];
        $rutaTemporal = $item['tmp_name'];
        if ( !is_dir($dir . DS . $rutaFile) ) {
            mkdir($dir . DS . $rutaFile);
            error_log(__LINE__);
        }
        if (!$trueFalse) {
            error_log(__LINE__);
            $consultar_ult = "SELECT MAX(`id`) FROM `reporte_eventos`";
            $max_arch = mysqli_query($conexion,$consultar_ult);
            $fila = mysqli_fetch_array($max_arch);
            $id_repor=intval($fila[0]);
            $trueFalse=true;
        }
        $rutaupload = $dir . DS . $rutaFile;
        moveralservidor($rutaTemporal,$rutaupload,$nombreFile);
        error_log(__LINE__);
        if($cantidadRegistros===1) {
            error_log(__LINE__);
            if ($error === 0) {
                error_log(__LINE__);
                $rutaFile = DS . $rutaFile;
                $anexaradjuntos = "INSERT INTO `adjuntos_eventos` VALUES (NULL,$id_repor,'$rutaFileBD', '$nombreFile')";
                $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                if (!$anexoExitoso) {
                    $error=6;
                    error_log(__LINE__);
                }
            }
        } else {
            if ($error===0) {
                if ( ($key + 1) === $cantidadRegistros ) {
                    error_log(__LINE__);
                    $nombrearchivos = $nombrearchivos . $nombreFile;
                    $rutaFile = DS . $rutaFile;
                    $anexaradjuntos = "INSERT INTO `adjuntos_eventos` VALUES (NULL,$id_repor,'$rutaFileBD', '$nombrearchivos')";
                    $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                    if (!$anexoExitoso) {
                        $error=6;
                        error_log(__LINE__);
                    }
                } else {
                    error_log(__LINE__);
                    if ($nombrearchivos==="") {
                        $nombrearchivos = $nombreFile . ",";
                    } else {
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
    error_log(__LINE__);
    if (!move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile) ) {
        $error=5;
    } else {
        move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile);
    }
}
?>