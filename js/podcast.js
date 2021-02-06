var _PodCast = (function (){
    var TablePodcast;
    _columnsPodcast = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "20%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    
    TablePodcast = $("#tablePodCast").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsPodcast,
        order: [[0, 'asc']]
    });

    var modalAñadir = ()=>{
        $("#modalAnadirAudio").modal('show');
    }

    var modalEditPodcast = (id) =>{
        var ruta = 'Controller/Podcast.controller.php';
        var data = {"metodo":"listarPodcast","parametros":{
            "id": id,
        }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            console.log(data)
            $("#modalEditarAudio").modal('show');
        });
    }

    var DeletePodcast = (id) =>{
        
        swal({
            title: 'Estás Seguro?',
            text: "Se eliminará el podcast!",
            icon: 'warning',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result) {
                var ruta = 'Controller/Podcast.controller.php';
                var data = {"metodo":"deletePodcast", 
                "parametros":{
                    "id": id,
                }};
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((data)=>{
                    if (data == "delete"){
                        swal("Exito", "El podcast ha sido eliminado!",_success);
                    }else{
                        swal("Error", "Ha habido un problema!",_error);
                    }
                    _PodCast.listarPodcast();
                });
            }
        })
    }

    var listarPodcast = () =>{
        $.ajax({
            url : "Controller/Podcast.controller.php",
            type: "POST",
            data : {"metodo":"listarPodcast"},
            dataType: 'json',
            beforeSend: function () {
                $("#tablePodCast").DataTable().clear();
            },
        }).done(function(data){ 
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_PodCast.modalEditPodcast('+e.id+')" id="editarPodcast'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Podcast"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_PodCast.DeletePodcast('+e.id+')" id="deletePodcast'+e.id+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Podcast"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablePodcast.row.add([
                        e.id,
                        e.nombre,
                        e.descripcion,
                        e.link,
                        e.audio,
                        e.id_seccion,
                        e.fecha_creacion,
                        edit
                    ]).draw();
                });
            }
        });
    }
    
    return {
        modalAñadir:modalAñadir,
        listarPodcast:listarPodcast,
        modalEditPodcast:modalEditPodcast,
        DeletePodcast:DeletePodcast
    }
})(jQuery);

$(document).ready(function(){
    _PodCast.listarPodcast();

    $("#formAnadirAudio").submit(function(event){
        event.preventDefault();
        
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'upload');
        form_data.append('parametros', [$("#nameAudio").val(), $("#descripcionAudio").val()]);
        
        $.ajax({
	        url : "Controller/Podcast.controller.php",
	        type: "POST",
	        data : form_data,
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				swal("", "Espere!",_warning);
			},
	    }).done(function(response){ 
            response = JSON.parse(response);
            if (response == "insert"){
                swal("Exito", "El audio ha sido cargado!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalAnadirAudio").modal('close');
            _PodCast.listarPodcast();
	    });
    });
});