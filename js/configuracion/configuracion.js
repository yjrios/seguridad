$(document).ready(function(){ 

		cargar();
		guardar();

});


function guardar(){

	$('#btnguardar').click(function(){
	 		 	id = $("#usuario").val();
	 		 	permisos = $("#permisos").val();
	 		 	sedes = $("#sedes").val();

	 		 	if (id =="" || permisos == "" || sedes == "") {
	 		 		 alertify.log("Ingrese todos los campos", "error",1500);
	 		 		 return false;
	 		 	}

	 		 	$.ajax({
	                type: "POST",
	                url: "../app/consultas/configuracion/configuracion.php",
	                data: {id_u: id, permiso: permisos, sede : sedes},
	                success: function(resultado) {
	                	console.log(resultado);
	               		if (resultado == 1) {
	                      alertify.log("Se ha guardado Correctamente", "success",1500);
	                      $("#usuario").val( '0' );
	                      $("#permisos").val( '0' );
	                      $("#sedes").val( '0' );
	                    }
	     
	                     if (resultado == 2 ) {
	                      alertify.log("Ocurrio un error", "error",2500);	        
	                    }
	                }
            	}); //Terminamos la Funcion Ajax
	});

	$('#btncancelar').click(function(){
		$("#usuario").val( '0' );
	    $("#permisos").val( '0' );
	    $("#sedes").val( '0' );
	});
}

function cargar(){


		$('#usuario').change(function(){
			console.log("cambio");
			id = $("#usuario").val();
			if (id == 0) {
				$("#usuario").val( '0' );
	            $("#permisos").val( '0' );
	            $("#sedes").val( '0' );
	            return false;
			}
				$.ajax({
	                type: "POST",
	                url: "../app/consultas/configuracion/permisos.php",
	                data: {id_u : id},
	                success: function(resultado) {
		                console.log(resultado);
		               	var json_info = JSON.parse(resultado);
		                	 $("#sedes").val(json_info.sede);
		                	 $("#permisos").val( json_info.permiso );
	                }
            	}); //Terminamos la Funcion Ajax

		});
}
