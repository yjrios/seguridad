<?php
define("RUTA_LOGS", __DIR__. "/log");

if (!file_exists(RUTA_LOGS)) {
    mkdir(RUTA_LOGS);
}

ini_set('display_errors', 0);
ini_set("log_errors",1);
ini_set("error_log", RUTA_LOGS . "/" . date("Y-m-d") . ".log");
?>