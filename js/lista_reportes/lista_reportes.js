$(document).ready(function(){ 

		cargar_diario();
		cargar_evento();
		cargar_riesgo();

});


function cargar_diario(){
 		 $('#btndiario').click(function(){
 		 	id = $("#usuario").val();
 		 	fecha = $("#txtfecha").val();
 		 	final = $("#txtfinal").val();

 		 	if (id == 0) {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Seleccione Personal", "error",1500);
                $("#usuario").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }

 		 	if (fecha == "") {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Ingrese fecha de inicio", "error",1500);
                $("#txtfecha").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }

             if (final == "") {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Ingrese fecha final", "error",1500);
                $("#txtfinal").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }
          	
          	

 		 	listar_diarios(id,fecha,final);
 		 }); 
}

function listar_diarios(id,fecha,final){
  	
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
             "text" : 'Imprimir Listado'
            },
            {"extend" : 'colvis',
             "text" : 'Mostrar'
            },
           ] ,
           "ajax":{
             "method":"POST",
             "url":"consultas/lista_reportes/dt_diarios.php?id="+id+"&fecha="+fecha+"&final="+final,
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
                 return "<a name=''><span class='fa fa-eye'></span></a> &nbsp;&nbsp;&nbsp;<a title='Editar' name='editar' id='editar' class='editar' data-toggle='modal' data-target='#modaldiariomod'>&nbsp;<span class='icon ion-edit'></span></a> &nbsp;&nbsp;&nbsp;<a title='Imprimir' href='reportes/diariosPDF.php?id="+d+"' target='_blank'  ><span class='fa fa-print'></span></button>";
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
}

function cargar_evento(){
 		 $('#btnevento').click(function(){
 		 	id= $("#usuarioE").val();
 		 	fecha=$("#txtfechaE").val();
 		 	final=$("#txtfinalE").val();

 		 	if (id == 0) {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Seleccione Personal", "error",1500);
                $("#usuarioE").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }

 		 	if (fecha == "") {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Ingrese fecha de inicio", "error",1500);
                $("#txtfechaE").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }

             if (final == "") {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Ingrese fecha final", "error",1500);
                $("#txtfinalE").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }
          	
          	

 		 	listar_eventos(id,fecha,final);
 		 }); 
}

function listar_eventos(id,fecha,final){
  	
    	var table = $("#dt_eventos").DataTable({
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
               "text" : 'Imprimir Listado'
              },
              {"extend" : 'colvis',
               "text" : 'Mostrar'
              },
            ] ,
           "ajax":{
             "method":"POST",
             "url":"consultas/lista_reportes/dt_eventos.php?id="+id+"&fecha="+fecha+"&final="+final,
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
                  var d= mData.id
                  return "<a ><span class='fa fa-eye'></span></a> &nbsp;&nbsp;&nbsp;<a name='editarE' id='editarE' class='editarE'  title='Editar' data-toggle='modal' data-target='#modaleventomod'>&nbsp;<span class='icon ion-edit'></span></a> &nbsp;&nbsp;&nbsp;<a title='Imprimir' href='reportes/eventosPDF.php?id="+d+"' target='_blank' ><span class='fa fa-print'></span></a>";
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
}

function cargar_riesgo(){
 		 $('#btnriesgo').click(function(){
 		 	id= $("#usuarioR").val();
 		 	fecha=$("#txtfechaR").val();
 		 	final=$("#txtfinalR").val();

 		 	if (id == 0) {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Seleccione Personal", "error",1500);
                $("#usuarioR").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }

 		 	if (fecha == "") {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Ingrese fecha de inicio", "error",1500);
                $("#txtfechaR").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }

             if (final == "") {
            	  //alertify.set('notifier','position', 'bottom-center');
                //alertify.notify('Ingrese fecha ', 'warning',5);
                alertify.log("Ingrese fecha final", "error",1500);
                $("#txtfinalR").focus();
                return false;//false para terminar de correr hacia las demas valiciones
            }
          	
          	

 		 	listar_riesgos(id,fecha,final);
 		 }); 
}

function listar_riesgos(id,fecha,final){
  	
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
             "text" : 'Imprimir Listado'
            },
            {"extend" : 'colvis',
             "text" : 'Mostrar'
            },
           ] ,
           "ajax":{
             "method":"POST",
             "url":"consultas/lista_reportes/dt_riesgos.php?id="+id+"&fecha="+fecha+"&final="+final,
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
                  var d= mData.id
                  return "<a><span class='fa fa-eye'></span></a> &nbsp;&nbsp;&nbsp;<a title='Editar' class='editar' data-toggle='modal' data-target='#modalriesgomod'>&nbsp;<span class='icon ion-edit'></span></a> &nbsp;&nbsp;&nbsp;<a title='Imprimir' href='reportes/riesgosPDF.php?id="+d+"' target='_blank' ><span class='fa fa-print'></span></a>";
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
}