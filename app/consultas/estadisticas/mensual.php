<?php  
      function empresaestadistica($conexion,$id,$mes,$año){ // graficos

      	$sql="SELECT * 
                FROM `asistencia_vigilantes` 
                WHERE `id_empresa`='$id' 
                AND MONTH(`fecha`) = $mes 
                AND YEAR(`fecha`) = $año";

          $consulta_empresa= mysqli_query($conexion,$sql);

          $empresa = array();
          if ($consulta_empresa && mysqli_num_rows($consulta_empresa) >= 1 ) {
            $empresa=$consulta_empresa;
          }

      		return $empresa;

      }

?>