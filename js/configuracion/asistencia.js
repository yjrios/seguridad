$(document).ready(function(){ 

		generar();

});

function generar(){

	$('#btngenerar').click(function(){

				var validar=1;
	 		 	meses = $("#meses").val();
	 		 	if (meses == 0 ) {
	 		 		 alertify.log("Ingrese mes a generar asistencia", "error",2000);
	 		 		 $("#meses").focus();
	 		 		 return false;
	 		 	}

	 		 	//validamos cada campo, pero consultamos en bd id de empresa para no hacerlo con un for
	 		 	x= 0;
	 		 	$.ajax({
	                type: "POST",
	                url: "../app/consultas/configuracion/asistencia2.php",
	                data: x,
	                success: function(resultado) {
	                	var json_info = JSON.parse(resultado);

		               	$.each( json_info, function( key, value ) {
						  id = json_info[key].id;
						  
							  ///////////////////
							  asis = $("#"+id+"").val();
							  if ( !asis ) {
				 		 		 alertify.log("Complete la matricula", "error",2000);
				 		 		 $("#"+id+"").focus();
				 		 		 validar=0;
				 		 		 return false;
				 		 		}

				 		 	  if (asis < 0 ) {
				 		 		 alertify.log("La matricula debe ser Positiva", "error",2000);
				 		 		 $("#"+id+"").focus();
				 		 		 validar=0;
				 		 		 return false;
				 		 		}
						});

		               	if (validar == 1) {
		               		//Generando asistencia del mes seleccionado-----------
						        var datos = $("#formulario_asistencia").serialize();
					 		 	
					 		 	$.ajax({
					                type: "POST",
					                url: "../app/consultas/configuracion/asistencia.php",
					                data: datos,
					                success: function(resultado) {
					                	console.log(resultado);

					                	  if (resultado == 0 ) {
							 		 		 alertify.log("Error al registrar", "error",2000);
							 		 		 $("#meses").focus();
							 		 		 return false;
							 		 		}
						               	 
										  if ( resultado == 1 ) {
							 		 		 alertify.log("Asistencia creada con exito", "success",2000);
							 		 		 $("#"+id+"").focus();
							 		 		 return false;
							 		 		}

							 		 	  if (resultado == 2 ) {
							 		 		 alertify.log("Asistencia ya existe para este mes", "error",2000);
							 		 		 $("#meses").focus();
							 		 		 return false;
							 		 		}
							 		 	  
									}//success guardado
					        }); //Terminamos la Funcion Ajax 

					    }




			        }//success validador 

				}); //Terminamos la Funcion Ajax */

	}); // btngenerar

}