 $(document).ready(function(){

 			console.log("eventos.js ready!");
 			
	 		 
	       //Evento click que permite que en el div "contenido" se cargue la vista "Vcomponent.jsp"
            $('a.btnreport').click(function(){
            var id = $(this).attr("id_e");
            $.ajax({
		 		 		type: "POST",
		                url: "vistas/empresas/reportar.php",
		                data: {id_e:id}, 
		                success: function(resultado) {
		               
		               	var $contenido = $('div#contenido').html('<center><p style="height:400px"> Procesando...</p></center>');
			            $("#contenido").html(resultado);
			          	$("#contenido").attr( "style", "display: none;" );
			            $("#contenido").slideDown();
		                }	


		 		 }); //Terminamos la Funcion Ajax

    		});



});