$(document).ready(function() {
    $(function() {
        $('#archivos').change(function(e){
            addImage(e);
        });
        
        function addImage (e) {
            for(let i=0; i< e.target.files.length;i++) {
                var file = e.target.files[i];
                // imageType = /image.*/;

                // if (!file.type.match(imageType)) {
                //     return;
                // }
                var reader = new FileReader();
                reader.onload = function (e) {
                    var result = e.target.result;
                    $('<li class="pip" id="li'+i+'">' + '<span class="remove">X</span>' + '<img src="'+result+'" class="imageThumb" title="' + e.target.name+'" />' + '</li>').insertAfter("#archivos");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });
                }
                reader.readAsDataURL(file);
            }
        }

        $('#btnarchivo').click(function(e) {
            $('<div class="pip"><input type="file" id="file" name="file"><span class="remove">x</span></div>').insertAfter("#btnarchivo");
            $(".remove").click(function() {
            $(this).parent(".pip").remove();
            });
        });    
    });
});