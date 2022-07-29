<?php  
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');

$empresas=conseguirEmpresas2($conexion);

            $resultado = array();
            $resultado2 = array();
            
            while ($empresa = mysqli_fetch_array($empresas)) {

                  $resultado2= array
                  (
                   'id' => $empresa['id']
                  ); 
            	
                  $resultado [] = $resultado2;
                  
		}
            
            
			echo json_encode($resultado, JSON_FORCE_OBJECT);


?>
