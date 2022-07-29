$(document).ready(function(){
	console.log("user.js readys!");

	$("#entrar").click(function(){
			var usuario = $("#usuario").val();
			var pass = $("#contraseña").val();

			//validaciones!
			if (usuario == '' ) {
				console.log("Entro en usuario vacio!");
				texto = " Ingresa el usuario!";
			    color = "#f41a1a";
			    $(".mensaje_user").html( texto ).css({"color": color });
			    $(".mensaje_user").fadeOut(5000, function(){
			    $(this).html("");
			    $(this).fadeIn(1000);
			    $("#usuario").focus();
		 		});
			}else if ( pass == "") {
				console.log("Entro en pass vacio!");
				texto = " Ingresa la contraseña!";
			    color = "#f41a1a";
			    $(".mensaje_pass").html( texto ).css({"color": color });
			    $(".mensaje_pass").fadeOut(5000, function(){
			    $(this).html("");
			    $(this).fadeIn(1000);
			    $("#contraseña").focus();
		 		});
		 		

			}else{
				$.ajax({
						type: "POST",
						url: "consultas/user.php",
						data: {user: usuario, contraseña:pass}, 
						success: function(resultado) {
							console.log("prueba")

						console.log(resultado)

							if ( resultado == 3) {
									texto = " Usuario no existe!";
									color = "#f41a1a";
									$(".mensaje_user").html( texto ).css({"color": color });
									$(".mensaje_user").fadeOut(5000, function(){
									$(this).html("");
									$(this).fadeIn(1000);
									$("#usuario").focus();
									});
							}
							if (resultado == 2) {
								texto = " Contraseña incorrecta!";
									color = "#f41a1a";
									$(".mensaje_pass").html( texto ).css({"color": color });
									$(".mensaje_pass").fadeOut(5000, function(){
									$(this).html("");
									$(this).fadeIn(1000);
									$("#contraseña").focus();
									});
								
							}
							if (resultado == 1) {
							
								window.location ="inicio.php";
							}
						}	 

				});//Terminamos la Funcion Ajax*/
				

			}


	});









});


