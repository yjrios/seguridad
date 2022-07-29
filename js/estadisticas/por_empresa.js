$(document).ready(function(){ 
		console.log("por_empresa.js Ready!");
		cargar();

});

function cargar(){


		$('#emp').change(function(){

			if ( $('#emp').val() != 0 && $('#mesa2').val() != 0) {
				console.log("cambio");
				
				var datos = $("#formulario_asistencia").serialize();

					$.ajax({
		                type: "POST",
		                url: "../app/vistas/estadisticas/grafica_empresa.php",
		                data: datos,
		                success: function(resultado) {
			               // console.log(resultado);
			                	 $("#reporte").html(resultado);
		                }
	            	}); //Terminamos la Funcion Ajax
			}
		});

		
		$('#mesa2').change(function(){

			if ( $('#emp').val() != 0 && $('#mesa2').val() != 0 ) {
				console.log("cambio");
				
				var datos = $("#formulario_asistencia").serialize();

					$.ajax({
		                type: "POST",
		                url: "../app/vistas/estadisticas/grafica_empresa.php",
		                data: datos,
		                success: function(resultado) {
			               // console.log(resultado);
			                	 $("#reporte").html(resultado);
		                }
	            	}); //Terminamos la Funcion Ajax
            }
		});
}

