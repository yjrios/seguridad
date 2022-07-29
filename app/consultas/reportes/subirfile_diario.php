<?php
require_once('../../../config/conexion.php');
$error = 0;
$id_repor = 0;
$nombrearchivos = "";
print_r("YA EN PHP");

if (isset($_FILES["files"])) {
    $result = array();
    foreach ($_FILES["files"] as $key1 => $value1)
        foreach ($value1 as $key2 => $value2)
            $result[$key2][$key1] = $value2;

    $cantidadRegistros = count($result);
    $trueFalse = false;
    foreach ($result as $key => $item) {
        $dir = dirname(__DIR__,3);
        $rutaFile = $dir . "/img/adjuntos/";
        $nombreFile = $item['name'];
        $rutaTemporal = $item['tmp_name'];
        if ( !is_dir($rutaFile) ) {
            mkdir($rutaFile);
        }
        echo "dentro del foreach";
        if($trueFalse===false){
            echo "dentro de trueFalse";
            $consultar_ult = "SELECT MAX(`id`) FROM `reporte_diario`";
            $max_arch = mysqli_query($conexion,$consultar_ult);
            $fila = mysqli_fetch_array($max_arch);
            $id_repor=$fila[0];
            $trueFalse=true;
        }
        if($cantidadRegistros === 1) {
            echo "CANTIDAD";
            moveralservidor($rutaTemporal,$rutaFile,$nombreFile);
            saveRouters($rutaFile,$nombreFile);
        }else{
            if ( ($key + 1) === $cantidadRegistros ) {
                $nombrearchivos = $nombrearchivos . $nombreFile;
                saveRouters($rutaFile,$nombreFile);
            }else{
                if ($nombrearchivos === "") {
                    echo "ARCHIVO VACIO";
                    $nombrearchivos = $nombreFile . ",";
                }else{
                    echo "ARCHIVO NO VACÍO";
                    $nombrearchivos = $nombrearchivos . $nombreFile . ",";
                }
            }
        }
    }
}else{
    $error = 7;
}

function saveRouters($rutaFile,$nombreFile){
    $ruta = $rutaFile . $nombreFile;
    $anexaradjuntos = "INSERT INTO `adjuntos_diarios` (`id_reporte`, `ruta`) VALUES ('$id_repor','$ruta')";
    $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
    if (!$anexoExitoso) {
        $error = 6;
    }
}

function moveralservidor($rutaTemporal,$rutaFile,$nombreFile) {
    if (!move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile) ) {
        $error = 5;
    } else {
        move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile);
    }
}
echo $error;
?>