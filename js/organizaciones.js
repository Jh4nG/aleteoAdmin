var _Organizaciones = (function () {
    var TableOrganizaciones;

    TableOrganizaciones = $("#tableOrganizaciones").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        order: [[0, "asc"]],
    });

    // var listarCategoriasPodcast = () =>{
    //     var ruta = 'Controller/Podcast.controller.php';
    //     var data = {"metodo":"listarCategoriaPodcast"};
    //     var type = 'post';
    //     $.when(ajaxJson(ruta,data,type)).done((data)=>{
    //         $('#catPodcast').html('');
    //         $('#catEditPodcast').html('');
    //         $.each(data, function(key, val){
    //             $('#catPodcast').append('<option value="'+ val.id+ '">'+val.nombre+'</option>')
    //         });
    //         $.each(data, function(key, val){
    //             $('#catEditPodcast').append('<option value="'+ val.id+ '">'+val.nombre+'</option>')
    //         });
    //     });
    // }

    var modalAñadir = () => {
        $("#nameOrg").val("");
        $("#descripcionOrg").val("");
        $("#imagenOrg").val("");
        $("#modalAnadirOrganizaciones").modal("show");
    };

    var modalEditOrg = (id) =>{
        var ruta = 'Controller/Organizaciones.controller.php';
        var data = {"metodo":"listarOrg","parametros":{
            "id": id,
        }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $("#idOrg").val(id);
            $("#nameEditOrg").val(data[0].titulo);
            $("#descripcionEditOrg").val(data[0].descripcion);
            $("#imagenOrgEdit").val('');
            if(data[0].activo == 1){
                $("#orgActivoEdit").prop('checked', true);
            }else{
                $("#orgActivoEdit").prop('checked', false);
            }
            $("#modalEditarOrg").modal('show');
        });
    }

    var DeleteOrg = (id) =>{
        swal({
            title: 'Estás Seguro?',
            text: "Se eliminará La organización!",
            icon: 'warning',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result) {
                var ruta = 'Controller/Organizaciones.controller.php';
                var data = {"metodo":"deleteOrg",
                "parametros":{
                    "id": id
                }};
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((data)=>{
                    if (data == "delete"){
                        swal("Exito", "La organización ha sido eliminada!",_success);
                    }else{
                        swal("Error", "Ha habido un problema!",_error);
                    }
                    _Organizaciones.listarOrganizacion();
                });
            }
        })
    }

    var listarOrganizacion = () =>{
        $.ajax({
            url : "Controller/Organizaciones.controller.php",
            type: "POST",
            data : {"metodo":"listarOrg"},
            dataType: 'json',
            beforeSend: function () {
                $("#tableOrganizaciones").DataTable().clear();
            },
        }).done(function(data){
            if(data){
                $.each(data,(i,e)=>{
                    var activo = e.activo == 1 ? 'Activo' : 'Inactivo';
                    var img = '<img width="195px" src="'+e.imagen+'"</img>';
                    var edit = '<a href="#" onclick="_Organizaciones.modalEditOrg('+e.id+')" id="editarOrg'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Organización"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Organizaciones.DeleteOrg('+e.id+')" id="deleteOrg'+e.id+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Organización"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TableOrganizaciones.row.add([
                        e.id,
                        e.titulo,
                        e.descripcion,
                        img,
                        e.fecha_creacion,
                        activo,
                        edit
                    ]).draw();
                });
            }
        });
    }

    return {
        modalAñadir: modalAñadir,
        listarOrganizacion:listarOrganizacion,
        // listarCategoriasPodcast:listarCategoriasPodcast,
        modalEditOrg:modalEditOrg,
        DeleteOrg:DeleteOrg
    };
})(jQuery);

$(document).ready(function () {
    _Organizaciones.listarOrganizacion();
    
    $("#formAnadirOrg").submit(function(event){
        event.preventDefault();
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'upload');
        form_data.append('parametros', [$("#nameOrg").val(), $("#descripcionOrg").val(), document.getElementById("orgActivo").checked]);
        $.ajax({
            url : "Controller/Organizaciones.controller.php",
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
                swal("Exito", "La organización ha sido cargada!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalAnadirOrganizaciones").modal('hide');
            _Organizaciones.listarOrganizacion();
        });
    });

    $("#formEditarOrg").submit(function(event){
        event.preventDefault();
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'edit');
        form_data.append('parametros', [$("#idOrg").val(), $("#nameEditOrg").val(), $("#descripcionEditOrg").val(), document.getElementById("orgActivoEdit").checked]);
        $.ajax({
            url : "Controller/Organizaciones.controller.php",
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
                swal("Exito", "La organización ha sido actualizada!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalEditarOrg").modal('hide');
            _Organizaciones.listarOrganizacion();
        });
    });
});
