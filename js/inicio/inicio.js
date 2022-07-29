$(document).ready(function(){ 
	console.log("inicio.js ready!");

	listar();
	desarrollo();

});

	function listar(){
		var $contenido = $('div#contenido').html('<center><p style="height:590px"> Procesando...</p></center>');
		$("#contenido").attr( "style", "display: none;" );
		$("#contenido").load("vistas/empresas/empresas.php");
		$("#contenido").toggle(1000);
	}

	function desarrollo(){

		var permiso = $('#permiso').attr("permiso");

		$("#inicio").click(function(){
			var $contenido = $('div#contenido').html('<center><p style="height:750px"> Procesando...</p></center>');
			$("#contenido").attr( "style", "display: none;" );
			$("#contenido").load("vistas/empresas/empresas.php").toggle(1000);
			$( ".active" ).toggleClass( "active", "addOrRemove" );//busca la clase activa y la elimina la classe
			$( "#inicio" ).toggleClass( "active", "addOrRemove" );//busca el id inicio y le agrega la clase Active
		});
			
		$("#lista_reportes").click(function(){
			
			$("#contenido").attr( "style", "display: none;");
			if (permiso == 1) {
				var $contenido = $('div#contenido').html('<center><p style="height:340px"> Procesando...</p></center>');
				$("#contenido").load("vistas/lista_reportes/lista_reportes.php").toggle(1000);
			}else{
				var $contenido = $('div#contenido').html('<center><p style="height:205px"> Procesando...</p></center>');
				$("#contenido").load("vistas/permisos/sin_permiso.php").toggle(1000);
			}
			$( ".active" ).toggleClass( "active", "addOrRemove" );
			$( "#lista_reportes" ).toggleClass( "active", "addOrRemove" );
		});

		/*$("#graficos").click(function(){
			var $contenido = $('div#contenido').html('<center><p style="height:205px"> Procesando...</p></center>');
			$("#contenido").attr( "style", "display: none;");
			$("#contenido").load("vistas/permisos/desarrollo.php").toggle(1000);
			$( ".active" ).toggleClass( "active", "addOrRemove" );
			$( "#graficos" ).toggleClass( "active", "addOrRemove" );
		});*/

		$("#usuarios").click(function(){
			
			$("#contenido").attr( "style", "display: none;");

			if (permiso == 1) {
				var $contenido = $('div#contenido').html('<center><p style="height:520px"> Procesando...</p></center>');
				$("#contenido").load("vistas/configuracion/usuarios.php").toggle(1000);
			}else{
				var $contenido = $('div#contenido').html('<center><p style="height:205px"> Procesando...</p></center>');
				$("#contenido").load("vistas/permisos/sin_permiso.php").toggle(1000);
			}
			
			$( ".active" ).toggleClass( "active", "addOrRemove" );
			$( "#config" ).toggleClass( "active", "addOrRemove" );
			$( "#usuarios" ).toggleClass( "active", "addOrRemove" );
			
		});

		$("#asistencia").click(function(){
			
			$("#contenido").attr( "style", "display: none;");

			if (permiso == 1) {
				var $contenido = $('div#contenido').html('<center><p style="height:1080px"> Procesando...</p></center>');
				$("#contenido").load("vistas/configuracion/asistencia.php").toggle(1000);
			}else{
				var $contenido = $('div#contenido').html('<center><p style="height:205px"> Procesando...</p></center>');
				$("#contenido").load("vistas/permisos/sin_permiso.php").toggle(1000);
			}
			
			$( ".active" ).toggleClass( "active", "addOrRemove" );
			$( "#config" ).toggleClass( "active", "addOrRemove" );
			$( "#asistencia" ).toggleClass( "active", "addOrRemove" );	
		});

        $("#graficos").click(function(){
			
			$("#contenido").attr( "style", "display: none;");

			if (permiso == 1) {
				var $contenido = $('div#contenido').html('<center><p style="height:1080px"> Procesando...</p></center>');
				$("#contenido").load("vistas/estadisticas/mensual.php").toggle(1000);
			}else{
				var $contenido = $('div#contenido').html('<center><p style="height:205px"> Procesando...</p></center>');
				$("#contenido").load("vistas/permisos/sin_permiso.php").toggle(1000);
			}
			
			$( ".active" ).toggleClass( "active", "addOrRemove" );
			$( "#grafic" ).toggleClass( "active", "addOrRemove" );
			$( "#graficos" ).toggleClass( "active", "addOrRemove" );	
		});

        $("#xempresa").click(function(){
			
			$("#contenido").attr( "style", "display: none;");

			if (permiso == 1) {
				var $contenido = $('div#contenido').html('<center><p style="height:1080px"> Procesando...</p></center>');
				$("#contenido").load("vistas/estadisticas/por_empresa.php").toggle(1000);
			}else{
				var $contenido = $('div#contenido').html('<center><p style="height:205px"> Procesando...</p></center>');
				$("#contenido").load("vistas/permisos/sin_permiso.php").toggle(1000);
			}
			
			$( ".active" ).toggleClass( "active", "addOrRemove" );
			$( "#grafic" ).toggleClass( "active", "addOrRemove" );
			$( "#xempresa" ).toggleClass( "active", "addOrRemove" );	
		});
	}