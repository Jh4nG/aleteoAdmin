var _PodCast = (function (){
    var TablePodcast;
    
    TablePodcast = $("#tablePodCast").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        order: [[0, 'asc']]
    });

    var listarCategoriasPodcast = () =>{
        var ruta = 'Controller/Podcast.controller.php';
        var data = {"metodo":"listarCategoriaPodcast"};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $('#catPodcast').html('');
            $('#catEditPodcast').html('');
            $.each(data, function(key, val){
                $('#catPodcast').append('<option value="'+ val.id+ '">'+val.nombre+'</option>')
            });
            $.each(data, function(key, val){
                $('#catEditPodcast').append('<option value="'+ val.id+ '">'+val.nombre+'</option>')
            });
        });
    }

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
            
            $("#idPodcast").val(id);
            $("#linkBorrar").val(data[0].link);
            $("#nameEditAudio").val(data[0].nombre);
            $("#descripcionEditAudio").val(data[0].descripcion);
            $("#modalEditarAudio").modal('show');
            $('#catEditPodcast option[value="'+data[0].cat+'"]').prop('selected', 'selected');
        });
    }

    var DeletePodcast = (id) =>{
        var link = $("#deletePodcast"+id).attr('data-link');
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
                    "link":link
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
                console.log(data);
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_PodCast.modalEditPodcast('+e.id+')" id="editarPodcast'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Podcast"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_PodCast.DeletePodcast('+e.id+')" id="deletePodcast'+e.id+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Podcast"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablePodcast.row.add([
                        e.id,
                        e.nombre,
                        e.descripcion,
                        e.link,
                        e.cat,
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
        listarCategoriasPodcast:listarCategoriasPodcast,
        modalEditPodcast:modalEditPodcast,
        DeletePodcast:DeletePodcast
    }
})(jQuery);

$(document).ready(function(){
    _PodCast.listarPodcast();
    _PodCast.listarCategoriasPodcast();

    $("#formAnadirAudio").submit(function(event){
        event.preventDefault();
        
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'upload');
        form_data.append('parametros', [$("#nameAudio").val(), $("#descripcionAudio").val(), $("#catPodcast").val()]);
        
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
            $("#modalAnadirAudio").modal('hide');
            _PodCast.listarPodcast();
	    });
    });

    $("#formEditarAudio").submit(function(event){
        event.preventDefault();
        
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'edit');
        form_data.append('parametros', [$("#idPodcast").val(), $("#nameEditAudio").val(), $("#descripcionEditAudio").val(), $("#catEditPodcast").val(), $("#linkBorrar").val()]);
        
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
            if (response == "edit"){
                swal("Exito", "El Podcast ha sido actualizado!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalEditarAudio").modal('hide');
            _PodCast.listarPodcast();
	    });
    });
});