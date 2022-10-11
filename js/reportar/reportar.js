 $(document).ready(function(){

 			console.log("reportar.js ready!!");


 			listar_eventos();
 			listar_diarios();
 			listar_riesgos();

 			agregar_diario();
      agregar_evento();
      agregar_riesgo();

      actualizar_diario_editar();
      actualizar_evento_editar();
      actualizar_riesgo_editar();

      aparecer();//para modal eventos, aparece los text file.

      cargar_asistencia();
      guardar_asistencia();

});
 			

 function listar_eventos(){
    	var table = $("#dt_eventos").DataTable({    
          "destroy":false,
          "pageLength": 20,
          "bProcessing": false,
          "bServerSide": false,
          "dom": 'Bfrtip',
          "buttons": [
              {"extend" : 'copy',
               "text" : 'Copiar'
              },
              {"extend" : 'excel',
               "text" : 'Excel'
              },
              {"extend" : 'pdf',
               "text" : 'Pdf'
              },
              {"extend" : 'print',
               "text" : 'Imprimir'
              },
              {"extend" : 'colvis',
               "text" : 'Mostrar'
              },
            ] ,
           "ajax":{
             "method":"POST",
             "url":"consultas/datatables/dt_eventos.php",
           },
         "aoColumns": [
              { "mData": "id" },
              { "mData": "usuario" },
              { "mData": "empresa" },
              { "mData": "fecha" },
              { "mData": "evento" },
              {"mData": null,
                render:function(mData, type, row)
                {
                var d = mData.id
                  return "<button title='Display' onclick=window.open('consultas/visualizar/visualizar_evento.php?id="+d+"','_blank')><span class='fa fa-eye'></span></button> &nbsp;&nbsp;&nbsp;<button name='editarE' id='editarE' class='editarE'  title='Editar' data-toggle='modal' data-target='#modaleventomod'>&nbsp;<span class='icon ion-edit'></span></button> &nbsp;&nbsp;&nbsp;<button title='Imprimir' onclick=window.open('reportes/eventosPDF.php?id="+d+"','_blank')  ><span class='fa fa-print'></span></button>";
                 },
               
              } 
          ],

          	"oLanguage": {
	            "sProcessing":     "Procesando...",
	            "sLengthMenu": 'Mostrar <select>'+
	            '<option value="5">5</option>'+
	            '<option value="10">10</option>'+
	            '<option value="20">20</option>'+
	            '<option value="30">30</option>'+
	            '<option value="40">40</option>'+
	            '<option value="-1">All</option>'+
		            '</select> registros',    
		        "sZeroRecords":    "No se encontraron resultados",
		        "sEmptyTable":     "Ningún dato disponible en esta tabla",
		        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
		        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
		        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		        "sInfoPostFix":    "",
		        "sSearch":         "Filtrar:",
		        "sUrl":            "",
		        "sInfoThousands":  ",",
		        "sLoadingRecords": "Por favor espere - .",
		        "oPaginate": {
		            "sFirst":    "Primero",
		            "sLast":     "Último",
		            "sNext":     "Siguiente",
		            "sPrevious": "Anterior"
	        	},
		        "oAria": {
		            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		        }
	        }
    	});   

       obtener_evento_editar("#dt_eventos", table);
 }
    function obtener_evento_editar(tbody, table){
          $(tbody).on("click", "button.editarE", function(){
          data = table.row( $(this).parents("tr") ).data();

             $("#editareventomod").html( "EDITAR Reporte de Evento\nNro: "+ data.id );
             $("#controlevento").val( data.id);
             $("#txtfechamod2").val( data.fecha );
             $("#txtdirigidoEmod").val( data.dirigido );
             $("#txtcargoEmod").val( data.cargo );
             $("#txtorganismomod").val( data.actuacion );
             $("#txtaccionesmod").val( data.acciones );
             $("#txtrecomendacionesmod").val( data.recomendaciones);
             evi =  data.evidencia;
             if (evi == 0) {
                $(".siE").prop("checked", true);
             }
             if (evi != 0) {
                $(".noE").prop("checked", true);
             }

             //YEISON
            obj={
            id_reporte: data.id,
            tipo: "evento"
            }
            let ruta = "../app/consultas/reportes/buscarfiles.php";
            $.getJSON(
              ruta,
              obj,
              (data) => {
                console.log("PETICION ENVIADA "+data);
              }
            )
            .done( (result) => {
              if(result){
                let arrayAll = result.files.split(",");
                arrayAll.forEach(element => {
                  let tipoarchivo = element.split('.');
                  if(tipoarchivo[1]==='png' || tipoarchivo[1]==='jpg' || tipoarchivo[1]==='jpeg') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/icono_img.png');"><button type="button" class="close" aria-label="Close" id="ximg"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModEve");
                    $('#ximg').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                  if (tipoarchivo[1]==='docx' || tipoarchivo[1]==='doc' || tipoarchivo[1]==='xls' || tipoarchivo[1]==='xlsx' || tipoarchivo[1]==='pptx' || tipoarchivo[1]==='ppt' || tipoarchivo[1]==='pdf' || tipoarchivo[1]==='txt') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/archivo.png');"><button type="button" class="close" aria-label="Close" id="xarchi"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModEve");
                    $('#xarchi').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                  if(tipoarchivo[1]==='mp4' || tipoarchivo[1]==='mkv' || tipoarchivo[1]==='avi' || tipoarchivo[1]==='mov') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/camara-de-video.png');"><button type="button" class="closevideo" aria-label="Close" id="xvideo"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModEve");
                    $('#xvideo').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                });
              }
            });
            //YEISON
          });
    }
    function actualizar_evento_editar(){
      $('#btnenviarEmod').click(function(){

          //VALIDACIONES--------------------------
             var nomedi = $("#txtdirigidoEmod").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (nomedi == "") {
                  alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                  $("#txtdirigidoEmod").focus();
                  return false;
              }

              var caredi = $("#txtcargoEmod").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (caredi == "") {
                  alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                  $("#txtcargoEmod").focus();
                  return false;
              }

              var org = $("#txtorganismomod").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (org == "") {
                  alertify.log("Ingrese los detalles de los organismos", "error",1500);
                  $("#txtorganismomod").focus();
                  return false;
              }

              var acc = $("#txtaccionesmod").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (acc == "") {
                  alertify.log("Ingrese las acciones correctivas", "error",1500);
                  $("#txtaccionesmod").focus();
                  return false;
              }

              var rec = $("#txtrecomendacionesmod").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (rec == "") {
                  alertify.log("Ingrese las recomendaciones", "error",1500);
                  $("#txtrecomendacionesmod").focus();
                  return false;
              }

              //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
              var datos = $("#form_eventomod").serialize();

              let oldfiles = "";
              $.each($('.pip'), (index, ele)=>{
                if (oldfiles === "") {
                  oldfiles = $(ele).text().substr(1);
                } else {
                  oldfiles = oldfiles + ',' + $(ele).text().substr(1);
                }
              });
              let newfiles = $("#filemev")[0].files;

              $.ajax({
                type: "POST",
                url: "../app/consultas/reportes/actualizar_evento.php",
                data: datos,
                success: function(resultado) {
                  console.log(resultado);
                  if (resultado == 1) {
                    let formData = new FormData();
                    let controlevento = $('#controlevento').val();
                    formData.append('controlevento',controlevento);
                    if (oldfiles.length > 0 && newfiles.length > 0) {
                      formData.append('oldfiles',oldfiles);
                      for (let i=0; i < newfiles.length; i++) {
                        formData.append('newfiles[]', newfiles[i]);
                      }
                      console.log("oldfiles.length > 0 && newfiles.length > 0");
                    }
                    if (oldfiles.length === 0 && newfiles.length !== 0) {
                      for (let i=0; i < newfiles.length; i++) {
                        formData.append('newfiles[]', newfiles[i]);
                      }
                      console.log("oldfiles.length === 0 && newfiles.length !== 0");
                    }
                    if (oldfiles.length !== 0 && newfiles.length === 0) {
                      formData.append('oldfiles', oldfiles);
                      console.log("oldfiles.length !== 0 && newfiles.length === 0");
                    }
                    $.ajax({
                      method: "POST",
                      url: "../app/consultas/reportes/editfiles_evento.php",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(result) {
                        if (result == 0 ) {
                          console.log("result = 0");
                          alertify.log("Se ha Modificado Correctamente", "success",1500);
                          limpiarevento();                      
                          $("#modaleventomod").modal('hide');
                          $("#dt_eventos").DataTable().ajax.url( 'consultas/datatables/dt_eventos.php' ).load();
                        }
                        if (result == 7 ) {
                          console.log("result = 7");
                          alertify.log("Ocurrio un error, Archivos Vacíos", "error",1500);
                        }
                        if (result == 6 ) {
                          console.log("result = 6");
                          alertify.log("Ocurrio un error al guardar adjuntos", "error",1500);
                        }
                        if (result == 5 ) {
                          console.log("result = 5");
                          alertify.log("Problemas con las rutas para guardar adjuntos", "error",1500);
                        }
                      }
                    })
                    .done(()=>{
                      console.log("request ready");
                    })
                    .fail((jqXHR)=>{
                      console.log("FAIL FILES");
                      console.log(jqXHR);
                    });
                  }
                  if (resultado == 2 ) {
                    alertify.log("Ocurrio un error", "error",1500);
                  }
                }
              })
              .fail((jqXHR)=>{
                console.log("FAIL POST");
                console.log(jqXHR);
              }); //Terminamos la Funcion Ajax
              return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario 

      });
    }
    function agregar_evento(){

            $('#btnenviarE').click(function(){

               //Obtenemos el valor del campo nombre
              var fec = $("#txtfechaE").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (fec == "") {
                    alertify.log("Ingrese fecha", "error",1500);
                    $("#txtfechaE").focus();
                    return false;//false para terminar de correr hacia las demas valiciones
              }
              
              //Obtenemos el valor del campo nombre
              var nom = $("#txtdirigidoE").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (nom == "") {             
                  alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                  $("#txtdirigidoE").focus();
                  return false;
              }

              //Obtenemos el valor del campo cargo
              var car = $("#txtcargoE").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (car == "") {
                  alertify.log("Ingrese el Cargo del encargado de la unidad", "error",1500);
                  $("#txtcargoE").focus();
                  return false;
              }


              //Obtenemos el valor del campo organismos
              var org = $("#txtorganismo").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (org == "") {
                  alertify.log("Ingrese la actuacion de los organismos", "error",1500);
                  $("#txtorganismo").focus();
                  return false;
              }

              //Obtenemos el valor del campo acciones
              var acc = $("#txtacciones").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (acc == "") {
                  alertify.log("Ingrese las acciones correctivas", "error",1500);
                  $("#txtacciones").focus();
                  return false;
              }

              //Obtenemos el valor del campo acciones
              var rec = $("#txtrecomendaciones").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (rec == "") {
                  alertify.log("Ingrese las Recomendaciones", "error",1500);
                  $("#txtrecomendaciones").focus();
                  return false;
              }

              //organismos 
              var pl= $('#pl').prop('checked');var pn= $('#pn').prop('checked');
              var gn= $('#gn').prop('checked');var ci= $('#ci').prop('checked');
              var bo= $('#bo').prop('checked');var ot= $('#ot').prop('checked');
              if(pl == false && pn == false && gn == false && ci == false && bo == false && ot == false ) {
           
                  alertify.log("Ingrese almenos una actuacion de organismo", "error",1500);
                  return false;
              }

              var files = $("#fileev").val();
              if (files == "") {
                alertify.log("Ingrese adjuntos", "error",1500);
                $("#fileev").focus();
                return false;
              }

              //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
              var datos = $("#form_evento").serialize();

              $.ajax({
                type: "POST",
                url: "../app/consultas/reportes/agregar_evento.php",
                data: datos,
                success: function(resultado) {
                  console.log(resultado);
                  if (resultado == 1) {
                    let archivos = $("#fileev")[0].files;
                    var formData = new FormData();
                    for (let i=0; i < archivos.length; i++) {
                      formData.append("files[]",archivos[i]);
                    }
                    $.ajax({
                      method: "POST",
                      url: "../app/consultas/reportes/subirfile_evento.php",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(result) {
                        if (result == 0 ) {
                          console.log("result = 0");
                          alertify.log("Se ha registrado Correctamente", "success",1500);
                          limpiarevento();
                          $("#modalevento").modal('hide');
                          $("#dt_eventos").DataTable().ajax.url( 'consultas/datatables/dt_eventos.php' ).load();
                        }
                        if (result == 7 ) {
                          console.log("result = 7");
                          alertify.log("Ocurrio un error, Archivos Vacíos", "error",1500);
                        }
                        if (result == 6 ) {
                          console.log("result = 6");
                          alertify.log("Ocurrio un error al guardar adjuntos", "error",1500);
                        }
                        if (result == 5 ) {
                          console.log("result = 5");
                          alertify.log("Problemas con las rutas para guardar adjuntos", "error",1500);
                        }
                      }
                    });
                  }
                  if (resultado == 3 ) {
                    alertify.log("Ocurrio un error", "error",1500);
                  }
                    if (resultado == 2 ) {
                    alertify.log("Reporte ya existe para esta fecha asignada", "standard",2500);
                    $("#txtfecha").focus();
                  }
                    if (resultado == 4 ) {
                    alertify.log("Elija almenos un Evento", "error",1500);
                  }
                }
              }); //Terminamos la Funcion Ajax
              return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario  */
            });
    }
    function limpiarevento(){

      $("#txtfechaE").val( '' );
      $("#txtdirigidoE").val( '' );
      $("#txtcargoE").val( '' );
      $( "input.a" ).prop( "checked", false );
      $( "textarea.b" ).val( '' );
      $( "textarea.b" ).attr("hidden","hidden");
      $("#txtorganismo").val( '' );
      $("#txtacciones").val( '' );
      $("#txtrecomendaciones").val( '' );
      $("#fileev").val('');
      $("#filemev").val('');
      $(".pip").remove();

    }
    $('#btncancelarE').click(function(){ 
         limpiarevento();
         $("#modalevento").modal('hide');
    });
    $('#btncancelarEmod').click(function(){ 
         limpiarevento();
         $("#modaleventomod").modal('hide');
    });
    function aparecer(clase){ // para aparecer text area del modal eventos
       
                 var status = $('textarea.'+clase+'').attr("status");
                 if (status == 0) {
                   console.log("debe aparecer111");
                   $('textarea.'+clase+'').removeAttr("hidden");
                   $('textarea.'+clase+'').attr("status","1");
                   $('textarea.'+clase+'').focus();
                 }else if (status == 1){
                    console.log("debe Desaparecer111");     
                   $('textarea.'+clase+'').attr("hidden","hidden");
                    $('textarea.'+clase+'').attr("status","0");
                 }   
    }


//------------------------------------------------------

  function listar_diarios(){
  	
    	var table = $("#dt_diarios").DataTable({
          "destroy":true,
          "pageLength": 20,
          "bProcessing": false,
          "bServerSide": false,
          "dom": 'Bfrtip',
          "buttons": [
            {"extend" : 'copy',
             "text" : 'Copiar'
            },
            {"extend" : 'excel',
             "text" : 'Excel'
            },
            {"extend" : 'pdf',
             "text" : 'Pdf'
            },
            {"extend" : 'print',
             "text" : 'Imprimir'
            },
            {"extend" : 'colvis',
             "text" : 'Mostrar'
            },
          ] ,
           "ajax":{
             "method":"POST",
             "url":"consultas/datatables/dt_diarios.php",
           },
         "aoColumns": [
              { "mData": "id" },
              { "mData": "usuario" },
              { "mData": "empresa" },
              { "mData": "fecha" },
              { "mData": "suceso" },
              {"mData": null,
                render:function(mData, type, row)
                {
                  var d= mData.id
                  return "<button title='Display' onclick=window.open('consultas/visualizar/visualizar_diario.php?id="+d+"','_blank')><span class='fa fa-eye'></span></button> &nbsp;&nbsp;&nbsp;<button title='Editar' name='editar' id='editar' class='editar' data-toggle='modal' data-target='#modaldiariomod'>&nbsp;<span class='icon ion-edit'></span></button> &nbsp;&nbsp;&nbsp;<button title='Imprimir' onclick=window.open('reportes/diariosPDF.php?id="+d+"','_blank')  ><span class='fa fa-print'></span></button>";
                },
              }
          ],

          	"oLanguage": {
	            "sProcessing":     "Procesando...",
	            "sLengthMenu": 'Mostrar <select>'+
	            '<option value="5">5</option>'+
	            '<option value="10">10</option>'+
	            '<option value="20">20</option>'+
	            '<option value="30">30</option>'+
	            '<option value="40">40</option>'+
	            '<option value="-1">All</option>'+
		            '</select> registros',    
		        "sZeroRecords":    "No se encontraron resultados",
		        "sEmptyTable":     "Ningún dato disponible en esta tabla",
		        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
		        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
		        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		        "sInfoPostFix":    "",
		        "sSearch":         "Filtrar:",
		        "sUrl":            "",
		        "sInfoThousands":  ",",
		        "sLoadingRecords": "Por favor espere - .",
		        "oPaginate": {
		            "sFirst":    "Primero",
		            "sLast":     "Último",
		            "sNext":     "Siguiente",
		            "sPrevious": "Anterior"
	        	},
		        "oAria": {
		            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		        }
	        }


    	});     
      //  obtener_diario_editar("#dt_diarios", $("#dt_diarios").DataTable() );
      obtener_diario_editar("#dt_diarios", table);
  }
    function obtener_diario_editar(tbody, table){
          $(tbody).on("click", "button.editar", function(){
          data = table.row( $(this).parents("tr") ).data();
             $("#editardiario").html( "EDITAR Reporte de actividades\nNro: "+data.id );
             $("#controldiario").val(data.id);
             $("#txtfechamod").val( data.fecha );
             $("#txtdirigidomod").val( data.dirigido );
             $("#txtcargomod").val( data.cargo );
             $("#txtactividadesmod").val( data.descripcion );
             $("#txtacompanantemod").val( data.acompanado );
             aco = data.acompanado;
             if (aco == "") {
                $(".no").prop("checked", true);
             }
             if (aco != "") {
                $(".si").prop("checked", true);
             }
             //YEISON
             obj={
              id_reporte: data.id,
              tipo: "diario"
             }
             let ruta = "../app/consultas/reportes/buscarfiles.php";
             $.getJSON(
              ruta,
              obj,
              (data) => {
                console.log("PETICION ENVIADA "+data);
              }
            )
            .done( (result) => {
              if(result){
                let arrayAll = result.files.split(",");
                arrayAll.forEach(element => {
                  let tipoarchivo = element.split('.');
                  if(tipoarchivo[1]==='png' || tipoarchivo[1]==='jpg' || tipoarchivo[1]==='jpeg') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/icono_img.png');"><button type="button" class="close" aria-label="Close" id="ximg"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModDia");
                    $('#ximg').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                  if (tipoarchivo[1]==='docx' || tipoarchivo[1]==='doc' || tipoarchivo[1]==='xls' || tipoarchivo[1]==='xlsx' || tipoarchivo[1]==='pptx' || tipoarchivo[1]==='ppt' || tipoarchivo[1]==='pdf' || tipoarchivo[1]==='txt') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/archivo.png');"><button type="button" class="close" aria-label="Close" id="xarchi"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModDia");
                    $('#xarchi').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                  if(tipoarchivo[1]==='mp4' || tipoarchivo[1]==='mkv' || tipoarchivo[1]==='avi' || tipoarchivo[1]==='mov') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/camara-de-video.png');"><button type="button" class="closevideo" aria-label="Close" id="xvideo"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModDia");
                    $('#xvideo').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                });
              }
            });
            //YEISON
          });
    }
    function actualizar_diario_editar(){
      $('#btnenviarmod').click(function(){

        //VALIDACIONES--------------------------
           var nomedi = $("#txtdirigidomod").val();
            //Validamos el campo Nombre, simplemente miramos que no esté vacío
            if (nomedi == "") {
                alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                $("#txtdirigidomod").focus();
                return false;
            }

            var caredi = $("#txtcargomod").val();
            //Validamos el campo Nombre, simplemente miramos que no esté vacío
            if (caredi == "") {
                alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                $("#txtcargomod").focus();
                return false;
            }

            if( $(".si").is(':checked') ) {
              nomacomedi = $("#txtacompanantemod").val();
              if (nomacomedi == "") {
                  alertify.log("Ingrese el Nombre del acompañante", "error",1500);
                  $("#txtacompanantemod").focus();
                  return false;
              }
            }

            var actedi = $("#txtactividadesmod").val();
            //Validamos el campo Apellidos, simplemente miramos que no esté vacío
            if (actedi == "") {
                alertify.log("Ingrese las actividades", "error",1500);
                $("#txtactividadesmod").focus();
                return false;
            }
            //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
            var datos = $("#form_diariomod").serialize();

            ///////////////////////////YEISON//////////////////////////

            let oldfiles = "";
            $.each($('.pip'), (index, ele)=>{
              if (oldfiles === "") {
                oldfiles = $(ele).text().substr(1);
              } else {
                oldfiles = oldfiles + ',' + $(ele).text().substr(1);
              }
            });
            let newfiles = $("#filemd")[0].files;

             $.ajax({
                type: "POST",
                url: "../app/consultas/reportes/actualizar_diario.php",
                data: datos,
                success: function(resultado) {
                  console.log(resultado);
                  if (resultado == 1) {
                    let formData = new FormData();
                    let controldiario = $('#controldiario').val();
                    formData.append('controldiario',controldiario);
                    if (oldfiles.length > 0 && newfiles.length > 0) {
                      formData.append('oldfiles',oldfiles);
                      for (let i = 0; i < newfiles.length; i++) {
                        formData.append('newfiles[]',newfiles[i]);
                      }
                      console.log("oldfiles.length > 0 && newfiles.length > 0");
                    }
                    if (oldfiles.length === 0 && newfiles.length !== 0) {
                      for (let i=0; i < newfiles.length; i++){
                        formData.append('newfiles[]', newfiles[i]);
                      }
                      console.log("oldfiles.length === 0 && newfiles.length !== 0");
                    }
                    if (oldfiles.length !== 0 && newfiles.length === 0) {
                      formData.append('oldfiles',oldfiles);
                      console.log("oldfiles.length !== 0 && newfiles.length === 0");
                    }
                    $.ajax({
                      method: "POST",
                      url: "../app/consultas/reportes/editfiles_diario.php",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(result) {
                        if (result == 0 ) {
                          console.log("result = 0");
                          alertify.log("Se ha Modificado Correctamente", "success",1500);
                          limpiardiario();
                          $("#modaldiariomod").modal('hide');
                          $("#dt_diarios").DataTable().ajax.url( 'consultas/datatables/dt_diarios.php' ).load();
                        }
                        if (result == 7 ) {
                          console.log("result = 7");
                          alertify.log("Ocurrio un error, Archivos Vacíos", "error",1500);
                        }
                        if (result == 6 ) {
                          console.log("result = 6");
                          alertify.log("Ocurrio un error al guardar adjuntos", "error",1500);
                        }
                        if (result == 5 ) {
                          console.log("result = 5");
                          alertify.log("Problemas con las rutas para guardar adjuntos", "error",1500);
                        }
                      }
                    })
                    .done(()=>{
                      console.log("request ready");
                    })
                    .fail((jqXHR)=>{
                      console.log("FAIL FILES");
                      console.log(jqXHR);
                    });        
                  }
                  if (resultado == 2 ) {
                    alertify.log("Ocurrio un error", "error",1500);
                  }
                }
            }); //Terminamos la Funcion Ajax
            return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario 

      });
    }
    function agregar_diario(){

          $('#btnenviar').click(function(){

               //Obtenemos el valor del campo nombre
              var fec = $("#txtfecha").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (fec == "") {
                  //alertify.set('notifier','position', 'bottom-center');
                  //alertify.notify('Ingrese fecha ', 'warning',5);
                  alertify.log("Ingrese fecha", "error",1500);
                  $("#txtfecha").focus();
                  return false;//false para terminar de correr hacia las demas valiciones
              }
              
              //Obtenemos el valor del campo nombre
              var nom = $("#txtdirigido").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (nom == "") {
                  alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                  $("#txtdirigido").focus();
                  return false;
              }

              //Obtenemos el valor del campo cargo
              var car = $("#txtcargo").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (car == "") {
                  alertify.log("Ingrese el Cargo del encargado de la unidad", "error",1500);
                  $("#txtcargo").focus();
                  return false;
              }

              //Estuvo acompañado SI o No
              if( $("#si").is(':checked') ) {
                nomacom = $("#txtacompanante").val();
                if (nomacom == "") {
                    alertify.log("Ingrese el Nombre del acompañante", "error",1500);
                    $("#txtacompanante").focus();
                    return false;
                }
              }

              //Obtenemos el valor del campo actividades
              var act = $("#txtactividades").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (act == "") {
                  alertify.log("Ingrese las actividades", "error",1500);
                  $("#txtactividades").focus();
                  return false;
              } 

              var files = $("#filed").val();
              if (files == "") {
                alertify.log("Ingrese adjuntos", "error",1500);
                $("#filed").focus();
                return false;
              }
              //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
              var datos = $("#form_diario").serialize();
              $.ajax({
                  method: "POST",
                  url: "../app/consultas/reportes/agregar_diario.php",
                  data: datos,
                  success: function(resultado) {
                    if (resultado == 1) {
                      console.log("Entro en resultado = 1");
                      let archivos = $("#filed")[0].files;
                      var formData = new FormData();
                      for (let i=0; i < archivos.length; i++) {
                        formData.append("files[]",archivos[i]);
                      }
                      $.ajax({
                        method: "POST",
                        url: "../app/consultas/reportes/subirfile_diario.php",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                          if (result == 0 ) {
                            alertify.log("Se ha registrado Correctamente", "success",1500);
                            limpiardiario();
                            $("#modaldiario").modal('hide');
                            $("#dt_diarios").DataTable().ajax.url( 'consultas/datatables/dt_diarios.php' ).load();
                          }
                          if (result == 7 ) {
                            alertify.log("Ocurrio un error, Archivos Vacíos", "error",1500);
                          }
                          if (result == 6 ) {
                            alertify.log("Ocurrio un error al guardar adjuntos", "error",1500);
                          }
                          if (result == 5 ) {
                            alertify.log("Problemas con las rutas para guardar adjuntos", "error",1500);
                          }
                        }
                      });
                    }
                    if (resultado == 3 ) {
                      alertify.log("Ocurrio un error", "error",1500);
                    }
                      if (resultado == 2 ) {
                      alertify.log("Reporte ya existe para esta fecha asignada", "standard",2500);
                      $("#txtfecha").focus();
                    }
                    if (resultado == 4 ) {
                      alertify.log("Elija almenos una actividad", "error",1500);
                    }
                  }
              }); //Terminamos la Funcion Ajax
               return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario  */
            });
    }
    function limpiardiario(){
        $("#txtfecha").val( '' );
        $("#txtdirigido").val( '' );
        $("#txtactividades").val( '' );
        $("#txtacompanante").val( '' );
        $("#txtcargo").val( '' );
        $( "input.a" ).prop( "checked", false );

        $("#txtfechamod").val( '' );
        $("#txtdirigidomod").val( '' );
        $("#txtactividadesmod").val( '' );
        $("#txtacompanantemod").val( '' );
        $("#txtcargomod").val( '' );
        $("#editardiario").html( "EDITAR Reporte de actividades");
        $("#filed").val( '' );
        $(".pip").remove();
        $("#filemd").val('');
    }
     $('#btncancelar').click(function(){ 
        limpiardiario();
        $("#modaldiario").modal('hide');
     });
     $('#btncancelarmod').click(function(){ 
        limpiardiario();
        $("#modaldiariomod").modal('hide');
     });

//-----------------------------------------------------
  function listar_riesgos(){
      	var table = $("#dt_riesgos").DataTable({
            "destroy":true,
            "pageLength": 20,
            "bProcessing": false,
            "bServerSide": false,
               "dom": 'Bfrtip',
            "buttons": [
            {"extend" : 'copy',
             "text" : 'Copiar'
            },
            {"extend" : 'excel',
             "text" : 'Excel'
            },
            {"extend" : 'pdf',
             "text" : 'Pdf'
            },
            {"extend" : 'print',
             "text" : 'Imprimir'
            },
            {"extend" : 'colvis',
             "text" : 'Mostrar'
            },
            ] ,
             "ajax":{
               "method":"POST",
               "url":"consultas/datatables/dt_riesgos.php",
             },
           "aoColumns": [
                { "mData": "id" },
                { "mData": "usuario" },
                { "mData": "empresa" },
                { "mData": "fecha" },
                { "mData": "tipo" },
                {"mData": null,
                  render:function(mData, type, row)
                  {
                     var d = mData.id 
                     return "<button title='Display' onclick=window.open('consultas/visualizar/visualizar_riesgo.php?id="+d+"','_blank')><span class='fa fa-eye'></span></button> &nbsp;&nbsp;&nbsp;<button title='Editar' class='editar' href='#' data-toggle='modal' data-target='#modalriesgomod'>&nbsp;<span class='icon ion-edit'></span></button> &nbsp;&nbsp;&nbsp;<button title='Imprimir' onclick=window.open('reportes/riesgosPDF.php?id="+d+"','_blank')  ><span class='fa fa-print'></span></button>";
                      },
                }

            ],

            	"oLanguage": {
  	            "sProcessing":     "Procesando...",
  	            "sLengthMenu": 'Mostrar <select>'+
  	            '<option value="5">5</option>'+
  	            '<option value="10">10</option>'+
  	            '<option value="20">20</option>'+
  	            '<option value="30">30</option>'+
  	            '<option value="40">40</option>'+
  	            '<option value="-1">All</option>'+
  		            '</select> registros',    
  		        "sZeroRecords":    "No se encontraron resultados",
  		        "sEmptyTable":     "Ningún dato disponible en esta tabla",
  		        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
  		        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
  		        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  		        "sInfoPostFix":    "",
  		        "sSearch":         "Filtrar:",
  		        "sUrl":            "",
  		        "sInfoThousands":  ",",
  		        "sLoadingRecords": "Por favor espere - .",
  		        "oPaginate": {
  		            "sFirst":    "Primero",
  		            "sLast":     "Último",
  		            "sNext":     "Siguiente",
  		            "sPrevious": "Anterior"
  	        	},
  		        "oAria": {
  		            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
  		            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  		        }
  	        }
      	});  
            obtener_riesgo_editar("#dt_riesgos", table);
  }
    function obtener_riesgo_editar(tbody, table){
          $(tbody).on("click", "button.editar", function(){
          data = table.row( $(this).parents("tr") ).data();
             $("#editariesgo").html( "EDITAR Reporte de riesgo\nNro: "+data.id );
             $("#controlriesgo").val(data.id);
             $("#txtfechaRmod2").val( data.fecha );
             $("#txtdirigidoRmod").val( data.dirigido );
             $("#txtcargoRmod").val( data.cargo );
             $("#txtanalisismod").val( data.analisis );
             $("#txtrecomendacionesRmod").val( data.recomendaciones );
             $("#txtaccionesRmod").val( data.acciones );
             
             evir = data.evidencia;
             if (evir == 0) {
                $(".siR").prop("checked", true);
             }
             if (evir != 0) {
                $(".noR").prop("checked", true);
             }

             clas = data.clasificacion;
             if (clas == 1) {
                $(".leve").prop("checked", true);
             }
             if (clas == 2) {
                $(".moderado").prop("checked", true);
             }
             if (clas == 3) {
                $(".alto").prop("checked", true);
             }
             if (clas == 4) {
                $(".muy_alto").prop("checked", true);
             }
//YEISON
            obj={
            id_reporte: data.id,
            tipo: "riesgo"
            }
            let ruta = "../app/consultas/reportes/buscarfiles.php";
            $.getJSON(
              ruta,
              obj,
              (data) => {
                console.log("PETICION ENVIADA "+data);
              }
            )
            .done( (result) => {
              if(result){
                let arrayAll = result.files.split(",");
                arrayAll.forEach(element => {
                  let tipoarchivo = element.split('.');
                  if(tipoarchivo[1]==='png' || tipoarchivo[1]==='jpg' || tipoarchivo[1]==='jpeg') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/icono_img.png');"><button type="button" class="close" aria-label="Close" id="ximg"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModRies");
                    $('#ximg').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                  if (tipoarchivo[1]==='docx' || tipoarchivo[1]==='doc' || tipoarchivo[1]==='xls' || tipoarchivo[1]==='xlsx' || tipoarchivo[1]==='pptx' || tipoarchivo[1]==='ppt' || tipoarchivo[1]==='pdf' || tipoarchivo[1]==='txt') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/archivo.png');"><button type="button" class="close" aria-label="Close" id="xarchi"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModRies");
                    $('#xarchi').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                  if(tipoarchivo[1]==='mp4' || tipoarchivo[1]==='mkv' || tipoarchivo[1]==='avi' || tipoarchivo[1]==='mov') {
                    $(`<li class="lista pip" style="list-style: none; background-image: url('../img/camara-de-video.png');"><button type="button" class="closevideo" aria-label="Close" id="xvideo"><span style="color: red;">&times;</span></button><span>${element}</span></li>`).insertAfter("#listaModRies");
                    $('#xvideo').click(function() {
                      $(this).parent('.pip').remove();
                    });
                  }
                });
              }
            });
//YEISON
          });
    }
    function actualizar_riesgo_editar(){
      $('#btnenviarRmod').click(function(){

        //VALIDACIONES--------------------------
           var nomedi = $("#txtdirigidoRmod").val();
            //Validamos el campo Nombre, simplemente miramos que no esté vacío
            if (nomedi == "") {
                alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                $("#txtdirigidoRmod").focus();
                return false;
            }

            var caredi = $("#txtcargoRmod").val();
            //Validamos el campo Nombre, simplemente miramos que no esté vacío
            if (caredi == "") {
                alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                $("#txtcargoRmod").focus();
                return false;
            }


            var actedi = $("#txtanalisismod").val();
            //Validamos el campo Apellidos, simplemente miramos que no esté vacío
            if (actedi == "") {
                alertify.log("Ingrese el Analisis", "error",1500);
                $("#txtanalisismod").focus();
                return false;
            }

            var reco = $("#txtrecomendacionesRmod").val();
            //Validamos el campo Apellidos, simplemente miramos que no esté vacío
            if (reco == "") {
                alertify.log("Ingrese las Recomendaciones", "error",1500);
                $("#txtrecomendacionesRmod").focus();
                return false;
            }

            var acci = $("#txtaccionesRmod").val();
            //Validamos el campo Apellidos, simplemente miramos que no esté vacío
            if (acci == "") {
                alertify.log("Ingrese las Acciones", "error",1500);
                $("#txtaccionesRmod").focus();
                return false;
            }
            //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
            var datos = $("#form_riesgomod").serialize();

            ///////////////////////////////YEISON/////////////////////////
            let oldfiles = "";
            $.each($('.pip'), (index, ele)=>{
              if (oldfiles === "") {
                oldfiles = $(ele).text().substr(1);
              } else {
                oldfiles = oldfiles + ',' + $(ele).text().substr(1);
              }
            });
            let newfiles = $("#filemr")[0].files;
             $.ajax({
                type: "POST",
                url: "../app/consultas/reportes/actualizar_riesgo.php",
                data: datos,
                success: function(resultado) {
                  console.log(resultado);
                  if (resultado == 1) {
                    let formData = new FormData();
                    let controlriesgo = $('#controlriesgo').val();
                    formData.append('controlriesgo',controlriesgo);
                    if (oldfiles.length > 0 && newfiles.length > 0) {
                      console.log("oldfiles.length > 0  && newfiles.length > 0 ");
                      formData.append('oldfiles',oldfiles);
                      for (let i=0; i < newfiles.length; i++) {
                        formData.append('newfiles[]',newfiles[i]);
                      }
                      console.log("oldfiles.length > 0 && newfiles.length > 0");
                    }
                    if (oldfiles.length === 0 && newfiles.length !== 0) {
                      for (let i = 0; i < newfiles.length; i++){
                        formData.append('newfiles[]',newfiles[i]);
                      }
                      console.log("oldfiles.length === 0 && newfiles.length !== 0");
                    }
                    if (oldfiles.length !== 0 && newfiles.length === 0) {
                      formData.append('oldfiles',oldfiles);
                      console.log("oldfiles.length !== 0 && newfiles.length === 0");
                    }
                    $.ajax({
                      method: "POST",
                      url: "../app/consultas/reportes/editfiles_riesgo.php",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(result) {
                        if (result == 0 ) {
                          console.log("result = 0");
                          alertify.log("Se ha Modificado Correctamente", "success",1500);
                          limpiarRiesgo();                      
                          $("#modalriesgomod").modal('hide');
                          $("#dt_riesgos").DataTable().ajax.url( 'consultas/datatables/dt_riesgos.php' ).load();
                        }
                        if (result == 7 ) {
                          console.log("result = 7");
                          alertify.log("Ocurrio un error, Archivos Vacíos", "error",1500);
                        }
                        if (result == 6 ) {
                          console.log("result = 6");
                          alertify.log("Ocurrio un error al guardar adjuntos", "error",1500);
                        }
                        if (result == 5 ) {
                          console.log("result = 5");
                          alertify.log("Problemas con las rutas para guardar adjuntos", "error",1500);
                        }
                      }
                    })
                    .done(()=>{
                      console.log("request ready");
                    })
                    .fail((jqXHR)=>{
                      console.log("FAIL FILES");
                      console.log(jqXHR);
                    });
                  }
                  if (resultado == 2 ) {
                    alertify.log("Ocurrio un error", "error",1500);
                  }
                }
            }); //Terminamos la Funcion Ajax
            return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario 

      });
    }
    function agregar_riesgo(){

            $('#btnenviarR').click(function(){

               //Obtenemos el valor del campo nombre
              var fec = $("#txtfechaR").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (fec == "") {
                    alertify.log("Ingrese Fecha", "error",1500);
                    $("#txtfechaR").focus();
                    return false;//false para terminar de correr hacia las demas valiciones
              }
              
              //Obtenemos el valor del campo nombre
              var nom = $("#txtdirigidoR").val();
              //Validamos el campo Nombre, simplemente miramos que no esté vacío
              if (nom == "") {
                    alertify.log("Ingrese el nombre a quien va dirigido el reporte", "error",1500);
                    $("#txtdirigidoR").focus();
                  return false;
              }

              //Obtenemos el valor del campo cargo
              var car = $("#txtcargoR").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (car == "") {
                  alertify.log("Ingrese el Cargo del encargado de la unidad", "error",1500);
                  $("#txtcargoR").focus();
                  return false;
              }


              //Obtenemos el valor del campo organismos
              var org = $("#txtanalisis").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (org == "") {
                  alertify.log("Ingrese el analisis de la evaluacion del riesgo", "error",1500);
                  $("#txtanalisis").focus();
                  return false;
              }

              //Obtenemos el valor del campo acciones
              var acc = $("#txtrecomendacionesR").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (acc == "") {
                  alertify.log("Ingrese las Recomendaciones", "error",1500);
                  $("#txtrecomendacionesR").focus();
                  return false;
              }

              //Obtenemos el valor del campo acciones
              var rec = $("#txtaccionesR").val();
              //Validamos el campo Apellidos, simplemente miramos que no esté vacío
              if (acc == "") {
                  alertify.log("Ingrese las Acciones ejecutadas", "error",1500);
                  $("#txtaccionesR").focus();
                  return false;
              }


              //if( $("#si").is(':checked') ) {
              //evaluacion de riesgo leve l m medio a alto mu muy alto
              var l= $('#l').prop('checked');var m= $('#m').prop('checked');
              var a= $('#a').prop('checked');var mu= $('#mu').prop('checked');
              if(l == false && m == false && a == false && mu == false ) {
           
                  alertify.log("Ingrese la evaluacion del riesgo", "error",1500);
                  return false;
              }

              var files = $("#filer").val();
              if (files == "") {
                alertify.log("Ingrese adjuntos", "error",1500);
                $("#filer").focus();
                return false;
              }

              //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
              var datos = $("#form_riesgo").serialize();

              $.ajax({
                  type: "POST",
                  url: "../app/consultas/reportes/agregar_riesgo.php",
                  data: datos,
                  success: function(resultado) {
                    console.log(resultado);
                    if (resultado == 1) {
                      let archivos = $("#filer")[0].files;
                      var formData = new FormData();
                      for (let i=0; i < archivos.length; i++) {
                        formData.append("files[]",archivos[i]);
                      }
                      console.log("Aqui FormDara "+formData.keys())
                      $.ajax({
                        method: "POST",
                        url: "../app/consultas/reportes/subirfile_riesgo.php",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                          console.log("Aqui RESULT");
                          if (result == 0 ) {
                            console.log("RESULT = 0");
                            alertify.log("Se han registrado Correctamente", "success",1500);
                            limpiarRiesgo();
                            $("#modalriesgo").modal('hide');
                            $("#dt_riesgos").DataTable().ajax.url( 'consultas/datatables/dt_riesgos.php' ).load();
                          }
                          if (result == 7 ) {
                            console.log("RESULT = 7");
                            alertify.log("Ocurrio un error, Archivos Vacíos", "error",1500);
                          }
                          if (result == 6 ) {
                            console.log("RESULT = 6");
                            alertify.log("Ocurrio un error al guardar adjuntos", "error",1500);
                          }
                          if (result == 5 ) {
                            console.log("RESULT = 5");
                            alertify.log("Problemas con las rutas para guardar adjuntos", "error",1500);
                          }
                        }
                      });
                    }
                    if (resultado == 3 ) {
                      alertify.log("Ocurrio un error", "error",1500);
                    }
                      if (resultado == 2 ) {
                      alertify.log("Reporte ya existe para esta fecha asignada", "standard",2500);
                      $("#txtfechaR").focus();
                    }
                    if (resultado == 4 ) {
                      alertify.log("Elija almenos un tipo de Riesgo", "error",1500);
                    }
                  }
              }); //Terminamos la Funcion Ajax
              return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario  */
            });
    }
    function limpiarRiesgo(){

      $("#txtfechaR").val( '' );
      $("#txtdirigidoR").val( '' );
      $("#txtcargoR").val( '' );
      $( "input.a" ).prop( "checked", false );
      $("#txtanalisis").val( '' );
      $("#txtrecomendacionesR").val( '' );
      $("#txtaccionesR").val( '' );
      $("#filer").val('');
      $("#filemr").val('');
      $(".pip").remove();
    }
    $('#btncancelarR').click(function(){ 
         limpiarRiesgo();
         $("#modalriesgo").modal('hide');
    });
    $('#btncancelarRmod').click(function(){ 
        $(".pip").remove();
        $("#modalriesgomod").modal('hide');
         //
    });

//------------------------ASISTENCIA-----------------------------

function cargar_asistencia(){


      status="";
        var datos = $("#form_asistencia").serialize();

        $.ajax({
                  type: "POST",
                  url: "../app/consultas/empresas/empleados.php",
                  data: datos,
                  success: function(resultado) {
                    console.log(typeof resultado);
                    // if (!ifEmptyObject(resultado)) {
                      var json_info = JSON.parse(resultado);
                      

                      $("#vigilantes").html("");
                      $("#matr_esperada").html("");
                      
                      for (var i = 0; i <= json_info.matricula; i++) {
                          status="";
                          if (json_info.asistencia == i) {
                              status="selected";
                          }

                        $("#vigilantes").append("<option value='"+i+"'  "+status+">"+i+"</option>");
                      }
                      $("#matr_esperada").html(" <h6 >/ "+json_info.matricula+" Vigilantes</h6> ")
                    }
                  // }
              }); //Terminamos la Funcion Ajax

}

  function guardar_asistencia(){

      $('#btnguardarA').click(function(){

        var datos = $("#form_asistencia").serialize();
        console.log("datos"+datos);

        $.ajax({
                  type: "POST",
                  url: "../app/consultas/empresas/asistencia.php",
                  data: datos,
                  success: function(resultado) {
                    console.log(resultado);
                        if (resultado==1) {
                          alertify.log("Error! No se pudo guardar", "error",1500);
                        }
                        if (resultado==2) {
                          alertify.log("Asistencia Guardada Correctamente", "success",1500);
                        }
                        if (resultado==3) {
                          alertify.log("No existe asistencia creada para mes seleccionado", "error",1500);
                        }
                  }
              }); //Terminamos la Funcion Ajax

      });

}


$('#fecha').change(function(){
    cargar_asistencia();
});

