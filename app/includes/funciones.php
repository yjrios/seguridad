<?php


	function listasucceso($conexion){
		$sqlc="SELECT * FROM `seceso`";
		$resultado = mysqli_query($conexion, $sqlc);
	

		$salida = false;
		if ($resultado && mysqli_num_rows($resultado) >= 1) {
			$salida = $resultado;
		}

		return $salida;
	}

	function listaevento($conexion){
		$sqlc="SELECT * FROM `evento` ORDER BY `evento`.`id` ASC";
		$resultado = mysqli_query($conexion, $sqlc);

		$salida = false;
		if ($resultado && mysqli_num_rows($resultado) >= 1) {
			$salida = $resultado;
		}

		return $salida;
	}

	function listacondicion($conexion){
		$sqlc="SELECT * FROM `condicion` ORDER BY `condicion`.`id` ASC";
		$resultado = mysqli_query($conexion, $sqlc);

		$salida = false;
		if ($resultado && mysqli_num_rows($resultado) >= 1) {
			$salida = $resultado;
		}

		return $salida;
	}

function conseguirEmpresas($conexion,$sede) {
		//global $db;
	if ($sede == 3) {
		$sql="SELECT * 
		FROM empresas e, sedes s , asistencia_vigilantes av 
		WHERE e.id_sede=s.id_sede  
		AND av.id_empresa=e.id 
		and av.fecha= curdate()";
	}else{ 
		$sql="SELECT * 
		FROM empresas e, sedes s, asistencia_vigilantes av
		WHERE e.id_sede=s.id_sede 
		AND e.id_sede='$sede' 
		AND av.id_empresa=e.id 
		and av.fecha= curdate()";		
	}

	

    $consulta_empresas= mysqli_query($conexion,$sql);

    $empresas = array();
    if ($consulta_empresas && mysqli_num_rows($consulta_empresas) >= 1 ) {
      $empresas=$consulta_empresas;
    }
		
		return $empresas;
	
}

function conseguirEmpresas2($conexion) { 


		$sql="SELECT * FROM empresas where id_sede <> 9 ";

	    $consulta_empresas= mysqli_query($conexion,$sql);

	    $empresas = array();
	    if ($consulta_empresas && mysqli_num_rows($consulta_empresas) >= 1 ) {
	      $empresas=$consulta_empresas;
	    }

		 return $empresas;
}

function empresa($conexion,$id) {
	
	$sql="SELECT * FROM empresas e LEFT JOIN asistencia_vigilantes av
	ON av.id_empresa=e.id
	AND av.fecha= curdate()
	WHERE e.id=$id";

    $consulta_empresa= mysqli_query($conexion,$sql);

    $empresa = array();
    if ($consulta_empresa && mysqli_num_rows($consulta_empresa) >= 1 ) {
      $empresa=$consulta_empresa;
    }else{
		$empresa=$consulta_empresa;
	}

		return $empresa;

}
//############################## YEISON ##############################
function buscarempresas($conexion,$id_sede){
	if ($id_sede == 3){
		$sql="SELECT * FROM empresas e";
	}else{
		$sql="SELECT * FROM empresas e WHERE e.id_sede = $id_sede";
	}
    $consulta_empresa= mysqli_query($conexion,$sql);

	$empresa = array();
    if ($consulta_empresa && mysqli_num_rows($consulta_empresa) >= 1 ) {
      $empresa=$consulta_empresa;
    }

		return $empresa;

}
//############################## YEISON ##############################

function usuarios($conexion){
	
	$sql="SELECT * FROM `usuarios`";

    $consulta = mysqli_query($conexion,$sql);

    $usuario = array();
    if ($consulta && mysqli_num_rows($consulta) >= 1 ) {
      $usuario=$consulta;
    }

		return $usuario;
}

function fecha($conexion){
	
	$sql="SELECT MIN(`fecha`) as fecha FROM `asistencia_vigilantes`";

    $consulta = mysqli_query($conexion,$sql);
    $dato="";

    if ($consulta && mysqli_num_rows($consulta) >= 1 ) {
      $fecha = mysqli_fetch_assoc($consulta);
	  $dato = $fecha['fecha'];
    }
		 return $dato;
		
}



?>