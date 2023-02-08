var _Futuro = (function (){

    var TablesFuturo;
    var ruta = 'Controller/Futuro.controller.php';

    _columnsFut = [
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    TablesFuturo = $("#tableFuturo").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsFut,
        order: [[1, 'asc']]
    });

    var init = ()=>{
        listarFuturo();
    }

    var listarFuturo = ()=>{
        var data = {"metodo":"getFuturo"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesFuturo.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Futuro.modalEditFuturo('+e.id+')" id="editarFuturo'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Organización"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Futuro.DeleteFuturo('+e.id+')" id="deleteFuturo'+e.id+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Organización"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablesFuturo.row.add([
                        edit,
                        e.id,
                        e.fut_titulo,
                        e.fut_descripcion.substr(0,100)+' ...',
                        e.fut_imagen,
                        e.fecha_creacion_text,
                        e.fecha_creacion
                    ]);
                });
                TablesFuturo.draw();
            }
        });
    }

    var addFuturo = ()=>{
        var data = new FormData($('#form-Futuro')[0]);
        data.append('textPer',$('.ck-editor__editable').html());
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#metodoFut').val() == 'addFuturo') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-Futuro');
                listarFuturo();
                $('#add-modal-Futuro').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-Futuro');
        $('#add-modal-Futuro').modal('show');
        $('#metodoPer').val('addFuturo');
        $('#actuImg').html('');
        contructEditor();
    }

    var contructEditor=()=>{
        $('#editor').remove();
        $('#divEditor').html('');
        $('#divEditor').html('<div id="editor"></div>');
        ClassicEditor
        .create( document.querySelector( '#editor' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
    }

    var DeleteFuturo = (id)=>{
        swal({
            title: 'Precaución!',
            text: 'Está seguro que desea eliminar el registro '+ id +'?',
            icon: 'warning',
            type: 'warning',
            buttons:{
                confirm: {
                    text : 'Aceptar',
                    className : 'btn btn-primary',
                    value: true,
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger',
                    value: false,
                }
            }
        })
        .then(($response)=> {
            if($response)
            {
                var data = {"metodo":"deleteFuturo","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarFuturo();
                    }else{
                        swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
                    }
                });
            }
        });
    }

    var modalEditFuturo = (id)=>{
        limpiarFormulario('form-Futuro');
        var data = {"metodo":"getFuturoUnique","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $('#editor').html('');
            if(data){
                $('#titFuturo').val(data[0].fut_titulo);
                $('#actuImg').html('<b style="color:red;">Actualmente con foto</b>');
                var content = data[0].fut_descripcion;
                var viewFragment = editor.data.processor.toView( content );
                var modelFragment = editor.data.toModel( viewFragment );
                editor.model.insertContent( modelFragment );
                $('#idFut').remove();
                $('#form-Futuro').append('<input type="hidden" id="idFut" name="idFut" value="'+data[0].id+'">');
                $('#btn-add-Futuro').html('Editar').attr('class','btn btn-primary');
                $('#metodoFut').val('editFuturo');
                $('#add-modal-Futuro').modal('show');
            }
        });
    }
    
    return{
        init:init,
        modalAdd:modalAdd,
        addFuturo:addFuturo,
        DeleteFuturo:DeleteFuturo,
        modalEditFuturo:modalEditFuturo
    }
})(jQuery);

$(document).ready(function(){
    _Futuro.init();

    $("#form-Futuro").submit(function(event){
        event.preventDefault();
        _Futuro.addFuturo();
    });

    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );
});