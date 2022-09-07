<?php
require_once('../../../config/conexion.php');

$arrayFiles = array();
if ( isset($_GET["id_reporte"]) && isset($_GET["tipo"]) ) {
    $id_reporte = $_GET["id_reporte"];
    $tipo_repo = $_GET["tipo"];
    if($tipo_repo === "diario"){
        $sql_repo_diario = "SELECT files FROM adjuntos_diarios WHERE id_reporte = $id_reporte";
        $filesAll = mysqli_query($conexion,$sql_repo_diario);
        $arrayFiles = mysqli_fetch_array($filesAll);
    }
    if ($tipo_repo === "evento"){
        $sql_repo_evento = "SELECT files FROM adjuntos_eventos WHERE id_reporte = $id_reporte";
        $filesAll = mysqli_query($conexion,$sql_repo_evento);
        $arrayFiles = mysqli_fetch_array($filesAll);
    }
    if ($tipo_repo === "riesgo"){
        $sql_repo_riesgo = "SELECT files FROM adjuntos_riesgos WHERE id_reporte = $id_reporte";
        $filesAll = mysqli_query($conexion,$sql_repo_riesgo);
        $arrayFiles = mysqli_fetch_array($filesAll);
    }

    $json = json_encode($arrayFiles);
}
echo $json;
?>