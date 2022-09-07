$(document).ready(function() {
    $(function() {
        $('#filed').change(function(e){
            chequeartamaño(e);
        });
        $('#filemd').change(function(e){
            chequeartamaño(e);
        });
        $('#filer').change(function(e){
            chequeartamaño(e);
        });
        $('#filemr').change(function(e){
            chequeartamaño(e);
        });
        $('#fileev').change(function(e){
            chequeartamaño(e);
        });
        $('#filemev').change(function(e){
            chequeartamaño(e);
        });
        function chequeartamaño (e) {
            if(e.target.files.length > 0) {
                if(e.target.files.length <= 5) {
                    for(let i=0; i < e.target.files.length;i++) {
                        let file = e.target.files[i].size;
                        let name = e.target.files[i].name;
                        let filesize = Math.round((file / 1024));
                        if (filesize > 2048) {
                            alertify.log("Tamaño máximo 2MB por archivo", "error",1500);
                            return false;
                        }else{
                            let arrayname = name.split(".");
                            if(arrayname.length > 2){
                                alertify.log("Nombre de archivo no debe poseer puntos (.)", "error",1500);
                                return false;
                            }
                        }
                    }
                } else {
                    alertify.log("Máximo 5 archivos adjuntos", "error",1500);
                    return false;
                }
            }
        }
    });
});