<?php
require_once('../../../config/conexion.php');
require_once('logger.php');
define('DS', DIRECTORY_SEPARATOR);
$error=0;
$id_repor=0;
$nombrearchivos="";
$nombresold = "";

if (isset($_FILES["newfiles"]) && isset($_POST['oldfiles'])) {
    if (isset($_POST['controlevento'])) {
        $controlevento = $_POST['controlevento'];
    }
    $nombresold = verificarchivosold($controlevento,$conexion);
    if ($error === 0) {
        $result=array();
        foreach ($_FILES["newfiles"] as $key1 => $value1)
            foreach ($value1 as $key2 => $value2)
                $result[$key2][$key1] = $value2;

        $cantidadRegistros=count($result);
        foreach ($result as $key => $item) {
            $dir = dirname(__DIR__,3);
            $rutaFile = "img". DS ."adjuntos". DS ."evento". DS;
            $nombreFile = $item['name'];
            $rutaTemporal = $item['tmp_name'];
            if ( !is_dir($dir . DS . $rutaFile) ) {
                mkdir($dir . DS . $rutaFile);
            }
            $rutaupload = $dir . DS . $rutaFile;
            moveralservidor($rutaTemporal,$rutaupload,$nombreFile);
            if ($cantidadRegistros === 1) {
                if ($error === 0) {
                    $nombrefiles = $nombreFile .','. $nombresold;
                    $anexaradjuntos = "UPDATE `adjuntos_eventos` SET files = '$nombrefiles' WHERE id_reporte = $controlevento";
                    $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                    if (!$anexoExitoso) {
                        $error=6;
                    }
                }
            } else {
                if ($error===0) {
                    if ( ($key + 1) === $cantidadRegistros ) {
                        $nombrearchivos = $nombrearchivos .','. $nombreFile .','. $nombresold;
                        $anexaradjuntos = "UPDATE `adjuntos_eventos` SET files = '$nombrearchivos' WHERE id_reporte = $controlevento";
                        $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                        if (!$anexoExitoso) {
                            $error=6;
                        }
                    } else {
                        if ($nombrearchivos === "") {
                            $nombrearchivos = $nombreFile;
                        } else {
                            $nombrearchivos = $nombrearchivos . "," . $nombreFile;
                        }
                    }
                }
            }
        }
    }
}
if (isset($_FILES["newfiles"]) && !isset($_POST['oldfiles'])) {
    if (isset($_POST['controlevento'])) {
        $controlevento = $_POST['controlevento'];
    }
    error_log(__LINE__ . ' $controlevento ' . $controlevento);
    $sql_archivos = "SELECT files, ruta FROM adjuntos_eventos WHERE id_reporte = $controlevento";
    $resultado = mysqli_query($conexion,$sql_archivos);
    $result = mysqli_fetch_array($resultado);
    if (empty($result)) {
        error_log(__LINE__);
        guardar($controlevento, $conexion, $error);
    } else {
        if (substr_count($result['files'], ',', 0, strlen($result['files'])) !== 0) {
            $bdfile = explode(",",$result['files']);
            error_log(__LINE__ . ' $bdfile ' . var_dump($bdfile));
            foreach($bdfile as $name) {
                error_log(__LINE__ . ' name ' . $name);
                eliminar($name);
            }
        } else {
            error_log(__LINE__);
            eliminar($result['files']);
        }
        if ($error === 0) {
            error_log(__LINE__);
            guardar($controlevento, $conexion, $error);
        }
    }
}
if (!isset($_FILES["newfiles"]) && isset($_POST['oldfiles'])) {
    $oldFiles = $_POST['oldfiles'];
    if (isset($_POST['controlevento'])) {
        $controlevento = $_POST['controlevento'];
    }
    error_log(__LINE__);
    $oldFiles = $_POST['oldfiles'];
    $oldFilesArray = Array();
    if (substr_count($oldFiles, ',', 0, strlen($oldFiles)) !== 0) {
        error_log(__LINE__);
        $oldFilesArray = explode(",",$oldFiles);
    } else {
        error_log(__LINE__);
        Array_push($oldFilesArray,$oldFiles);
    }
    error_log(__LINE__);
    $sql_archivos = "SELECT files, ruta FROM adjuntos_eventos WHERE id_reporte = $controlevento";
    $resultado = mysqli_query($conexion,$sql_archivos);
    $result = mysqli_fetch_array($resultado);

    if (substr_count($result['files'], ',', 0, strlen($result['files'])) !== 0) {
        error_log(__LINE__);
        $bdfile = explode(",",$result['files']);
        $dropFile = true;
        $nombresold = "";
        foreach($bdfile as $key => $value) {
            foreach($oldFilesArray as $oldfile) {
                if ($value === $oldfile) {
                    $dropFile = false;
                }
            }
            if ($dropFile) {
                error_log(__LINE__);
                eliminar($value);
                // $fija = "img". DS ."adjuntos". DS ."evento". DS . $value;
                // $dir = dirname(__DIR__,3);
                // $local = $dir . DS . $fija;
                // if (unlink($local)) {
                //     $error=0;
                // } else {
                //     $error=1;
                // }
            } else {
                error_log(__LINE__);
                if (empty($nombresold)) {
                    $nombresold = $value;
                    error_log(__LINE__);
                } else {
                    $nombresold = $nombresold . "," . $value;
                    error_log(__LINE__);
                }
                $dropFile = true;
            }
        }
    }else {
        error_log(__LINE__);
        foreach($oldFilesArray as $oldfile) {
            if ($result['files'] === $oldfile) {
                $nombresold = $result['files'];
            } else {
                eliminar($result['files']);
            }
        }
    }

    if ($error === 0) {
        error_log(__LINE__.' $nombresold '. $nombresold. ' $controlevento '.$controlevento);
        $anexaradjuntos = "UPDATE adjuntos_eventos SET files = '$nombresold' WHERE id_reporte = $controlevento";
        $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
        if (!$anexoExitoso) {
            error_log(__line__ . 'ERROR === 6');
            $error=6;
        }
    }
}

function eliminar($nombre) {
    $dir = dirname(__DIR__,3);
    $rutaFile = "img". DS ."adjuntos". DS ."evento". DS;
    if(unlink($dir . DS . $rutaFile . $nombre)) {
        $error=0;
    } else {
        $error=1;
    }
}

function guardar($controlevento, $conexion, $error) {
    $resultado=array();
    error_log(__LINE__);
    foreach ($_FILES["newfiles"] as $key1 => $value1)
        foreach ($value1 as $key2 => $value2)
            $resultado[$key2][$key1] = $value2;

    $nombrearchivos = "";
    $cantidadRegistros=count($resultado);
    foreach($resultado as $key => $item) {
        $dir = dirname(__DIR__,3);
        $rutaFile = "img". DS ."adjuntos". DS ."evento". DS;
        $nombreFile = $item['name'];
        error_log(__LINE__ . ' $nombreFile ' . $nombreFile);
        $rutaTemporal = $item['tmp_name'];
        if ( !is_dir($dir . DS . $rutaFile) ) {
            mkdir($dir . DS . $rutaFile);
        }
        $rutaupload = $dir . DS . $rutaFile;
        moveralservidor($rutaTemporal,$rutaupload,$nombreFile);
        if($cantidadRegistros === 1) {
            error_log(__LINE__);
            if ($error === 0) {
                error_log(__LINE__);
                $anexaradjuntos = "UPDATE `adjuntos_eventos` SET files = '$nombreFile' WHERE id_reporte = $controlevento";
                $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                if (!$anexoExitoso) {
                    $error=6;
                }
            }
        } else {
            error_log(__LINE__);
            if ($error === 0) {
                error_log(__LINE__);
                if ( ($key + 1) === $cantidadRegistros ) {
                    error_log(__LINE__ . ' $nombreFile ' . $nombreFile . ' $nombrearchivos ' . $nombrearchivos);
                    $nombrearchivos = $nombrearchivos . "," . $nombreFile;
                    error_log(__LINE__ . ' $nombrearchivos ' . $nombrearchivos);
                    $anexaradjuntos = "UPDATE `adjuntos_eventos` SET files = '$nombrearchivos' WHERE id_reporte = $controlevento";
                    $anexoExitoso = mysqli_query($conexion,$anexaradjuntos);
                    if (!$anexoExitoso) {
                        $error=6;
                    }
                } else {
                    error_log(__LINE__);
                    if (empty($nombrearchivos)) {
                        error_log(__LINE__);
                        $nombrearchivos = $nombreFile;
                    } else {
                        $nombrearchivos = $nombrearchivos . "," . $nombreFile;
                    }
                }
            }
        }
    } 
}

function moveralservidor($rutaTemporal,$rutaFile,$nombreFile) {
    if (!move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile) ) {
        $error=5;
    } else {
        move_uploaded_file($rutaTemporal, $rutaFile . $nombreFile);
    }
}

function verificarchivosold($controlevento,$conexion) {
    $dir = dirname(__DIR__,3);
    $oldFiles = $_POST['oldfiles'];
    $sql_archivos = "SELECT files, ruta FROM adjuntos_eventos WHERE id_reporte = $controlevento";
    $resultado = mysqli_query($conexion,$sql_archivos);
    $result = mysqli_fetch_array($resultado);
    $nombresold = "";
    $oldFilesArray = Array();
    if (!empty($result)) {
        if (substr_count($oldFiles, ',', 0, strlen($oldFiles)) !== 0) {
            $oldFilesArray = explode(",",$oldFiles);
        } else {
            Array_push($oldFilesArray,$oldFiles);
        }

        if (substr_count($result['files'], ',', 0, strlen($result['files'])) !== 0) {
            $bdfile = explode(",",$result['files']);
            $dropFile = true;
            foreach($bdfile as $key => $value) {
                foreach($oldFilesArray as $oldfile) {
                    if ($value === $oldfile) {
                        $dropFile = false;
                    }
                }
                if ($dropFile) {
                    if(unlink($dir . $result['ruta'] . $value)) {
                        $error=0;
                    } else {
                        $error=1;
                    }
                } else {
                    if (empty($nombresold)) {
                        $nombresold = $value;
                    } else {
                        $nombresold = $nombresold . "," . $value;
                    }
                    $dropFile = true;
                }
            }
        } else {
            foreach($oldFilesArray as $oldfile) {
                if ($result['files'] === $oldfile) {
                    $nombresold = $result['files'];
                } else {
                    eliminar($result['files']);
                }
            }
        }
    }
    return $nombresold;
}
echo $error;
?>