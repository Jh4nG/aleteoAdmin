var _PodCast = (function (){

    var modalAñadir = ()=>{
        $("#modal-title-md").html('Añadir nuevo audio');
        let body = '<form id="formAnadirAudio" enctype="multipart/form-data">'+
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<input type="text" class="form-control" id="nameAudio" name="nameAudio" placeholder="Nombre" required>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<textarea class="form-control" name="descripcionAudio" id="descripcionAudio" placeholder="Descripción" required></textarea>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="row">'+
                '<div class="col-md-4">'+
                    '<label class="control-label"><i class="fas fa-file-audio"></i> Cargar Audio</label>'+
                '</div>'+
            '</div>'+  
            '<div class="row">'+
                '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<input  id="audio" name="audio" type="file" accept="audio/*" required>'+
                    '</div>'+
                '</div>'
            '</div>'+
        '</form>';

        $("#modal-body-md").html(body);
        $("#btn-md").html('<button type="submit" class="btn btn-success">Cargar</button>');
        $("#modal-medium").modal('show');
    }
    return {
        modalAñadir:modalAñadir
    }
})(jQuery);

$(document).ready(function(){

});