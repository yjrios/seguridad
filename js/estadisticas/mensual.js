$(document).ready(function(){ 
		console.log("manual.js Ready!");
		cargar();

});

function cargar(){

		$('#mesa').change(function(){

			if ( $('#mesa').val() != 0 ) {
				console.log("cambio");
				var datos = $("#formulario_asistencia").serialize();

					$.ajax({
		                type: "POST",
		                url: "../app/vistas/estadisticas/grafica_mensual.php",
		                data: datos,
		                success: function(resultado) {
			               // console.log(resultado);
			                	 $("#reporte").html(resultado);
		                }
	            	}); //Terminamos la Funcion Ajax
            }

		});
}

