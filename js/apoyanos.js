var _Apoyanos = (function () {
    var TableApoyanos;
    var viewFragment;
    var modelFragment;

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
        limpiarFormulario("formAnadirApoyanos");
        $("#modalAnadirApoyanos").modal("show");
        contructEditor();
    };

    var modalEditApoyanos = (id) =>{
        limpiarFormulario("formEditarApoyanos");
        contructEditorEdit();
        $('#editorApoyanos').html('');
        var ruta = 'Controller/Apoyanos.controller.php';
        var data = {"metodo":"listarApoyanos","parametros":{
            "id": id,
        }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $("#idApoyanos").val(id);
            $("#tituloApoyanosEdit").val(data[0].titulo);
            // $("#descripcionApoyanosEdit").val(data[0].descripcion);
            $("#urlApoyanosEdit").val(data[0].video);
            $("#imagenApoyanosBorrar").val(data[0].imagen);
            $("#imagenApoyanosEdit").val('');

            var content = data[0].descripcion;
            var viewFragment = editorApoyanosEdit.data.processor.toView( content );
            var modelFragment = editorApoyanosEdit.data.toModel( viewFragment );

            editorApoyanosEdit.model.insertContent( modelFragment );
       
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

    var contructEditor=()=>{
        $('#editorApoyanos').remove();
        $('#divEditorApoyanos').html('');
        $('#divEditorApoyanos').html('<div id="editorApoyanos"></div>');
        ClassicEditor
        .create( document.querySelector( '#editorApoyanos' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        } )
        .then( editorApoyanos => {
            window.editorApoyanos = editorApoyanos;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
    }

    var contructEditorEdit=()=>{
        $('#editorApoyanosEdit').remove();
        $('#divEditorApoyanosEdit').html('');
        $('#divEditorApoyanosEdit').html('<div id="editorApoyanosEdit"></div>');
        ClassicEditor
        .create( document.querySelector( '#editorApoyanosEdit' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        } )
        .then( editorApoyanosEdit => {
            window.editorApoyanosEdit = editorApoyanosEdit;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
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

    // ClassicEditor
    // .create( document.querySelector( '#editorApoyanos' ), {
    //     // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    // } )
    // .then( editorApoyanos => {
    //     window.editorApoyanos = editorApoyanos;
    // } )
    // .catch( err => {
    //     console.error( err.stack );
    // } );
    
    $("#formAnadirApoyanos").submit(function(event){
        event.preventDefault();
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'upload');
        form_data.append('titulo', $("#tituloApoyanos").val());
        form_data.append('desc', $('.ck-editor__editable').html());
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
            // response = JSON.parse(response);
            if (response == "insert"){
                swal("Exito", "Los items han sido cargados!",_success);
            }else{
                swal("Error", "Ha habido un problema!",_error);
            }
            $("#modalAnadirApoyanos").modal('hide');
            _Apoyanos.listarApoyanos();
        });
    });

    $("#formEditarApoyanos").submit(function(event){
        event.preventDefault();
        var form_data = new FormData(this); //Creates new FormData object
        form_data.append('metodo', 'edit');
        form_data.append('descripcionApoyanosEdit',$('.ck-editor__editable').html());
        
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