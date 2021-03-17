var _Apoyanos = (function () {
    var TableApoyanos;

    TableApoyanos = $("#tableApoyanos").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
    });

    var modalAñadir = () => {
        $("#tituloApoyanos").val("");
        $("#descripcionApoyanos").val("");
        $("#urlApoyanos").val("");
        $("#imagenApoyanos").val("");
        $("#modalAnadirApoyanos").modal("show");
    };

    var modalEditApoyanos = (id) =>{
        var ruta = 'Controller/Apoyanos.controller.php';
        var data = {"metodo":"listarApoyanos","parametros":{
            "id": id,
        }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $("#idApoyanos").val(id);
            $("#tituloApoyanosEdit").val(data[0].titulo);
            $("#descripcionApoyanosEdit").val(data[0].descripcion);
            $("#urlApoyanosEdit").val(data[0].video);
            $("#imagenApoyanosBorrar").val(data[0].imagen);
            $("#imagenApoyanosEdit").val('');
       
            $("#modalEditarApoyanos").modal('show');
        });
    }

    var DeleteApoyanos = (id) =>{
        var imagen = $("#deleteApoyanos"+id).attr('data-imagen');
        swal({
            title: 'Estás Seguro?',
            text: "Se eliminará el registro!",
            icon: 'warning',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result) {
                var ruta = 'Controller/Apoyanos.controller.php';
                var data = {"metodo":"deleteApoyanos",
                "parametros":{
                    "id": id,
                    "imagen": imagen
                }};
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((data)=>{
                    if (data == "delete"){
                        swal("Exito", "El regsitro ha sido eliminado!",_success);
                    }else{
                        swal("Error", "Ha habido un problema!",_error);
                    }
                    _Apoyanos.listarApoyanos();
                });
            }
        })
    }

    var listarApoyanos = () =>{
        $.ajax({
            url : "Controller/Apoyanos.controller.php",
            type: "POST",
            data : {"metodo":"listarApoyanos"},
            dataType: 'json',
            beforeSend: function () {
                $("#tableApoyanos").DataTable().clear();
            },
        }).done(function(data){
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Apoyanos.modalEditApoyanos('+e.id+')" id="editarApoyanos'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Organización"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Apoyanos.DeleteApoyanos('+e.id+')" id="deleteApoyanos'+e.id+'" data-imagen='+e.imagen+' data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Organización"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TableApoyanos.row.add([
                        e.id,
                        e.titulo,
                        e.descripcion,
                        e.imagen,
                        e.video,
                        edit
                    ]).draw();
                });
            }
        });
    }

    return {
        modalAñadir: modalAñadir,
        listarApoyanos:listarApoyanos,
        modalEditApoyanos:modalEditApoyanos,
        DeleteApoyanos:DeleteApoyanos
    };
})(jQuery);

$(document).ready(function () {
    _Apoyanos.listarApoyanos();
    
    $("#formAnadirApoyanos").submit(function(event){
        event.preventDefault();
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'upload');
        form_data.append('titulo', $("#tituloApoyanos").val());
        form_data.append('desc', $("#descripcionApoyanos").val());
        form_data.append('url', $("#urlApoyanos").val());
        
        $.ajax({
            url : "Controller/Apoyanos.controller.php",
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
                swal("Exito", "Los items han sido cargados!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalAnadirApoyanos").modal('hide');
            _Organizaciones.listarApoyanos();
        });
    });

    $("#formEditarApoyanos").submit(function(event){
        event.preventDefault();
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'edit');
        
        $.ajax({
            url : "Controller/Apoyanos.controller.php",
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
                swal("Exito", "Los items han sido actualizados!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalEditarApoyanos").modal('hide');
            _Apoyanos.listarApoyanos();
        });
    });
});