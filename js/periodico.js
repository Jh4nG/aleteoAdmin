var _Periodico = (function (){
    var TablesPer;
    var viewFragment;
    var modelFragment;
    _columnsPer = [
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"}
    ];
    TablesPer = $("#tablePeriodico").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsPer,
        order: [[1, 'asc']]
    });

    var init = ()=>{
        listarPeriodico();
    }

    var listarPeriodico = ()=>{
        var ruta = 'Controller/Periodico.controller.php';
        var data = {"metodo":"listarPeriodico"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesPer.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Periodico.modalEditPeriodico('+e.id_periodico+')" id="editarPeriodico'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Categoria"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Periodico.deletePeriodico('+e.id_periodico+')" id="deletePeriodico'+e.id+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Categoria"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    texto = "";
                    $.each(e.per_texto.split('\n'),(i,e)=>{
                        texto += '<p class="card-text">'+e+'</p>';
                    });
                    TablesPer.row.add([
                        edit,
                        e.per_titulo,
                        e.per_contratitulo.substr(0,100)+' ....',
                        e.per_autor,
                        texto.substr(0,100)+' ....',
                        e.per_link_img,
                        e.per_link_pie_img,
                        e.fecha_publico,
                        e.fecha_publicacion,
                        e.per_fecha_ingreso
                    ]).draw();
                });
            }
        });
    }

    var modalEditPeriodico = (id)=>{
        limpiarFormulario('form-Periodico');
        var ruta = 'Controller/Periodico.controller.php';
        var data = {"metodo":"getPeriodico","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            // editor.instances['content'].setData('');
            //contructEditor();
            $('#editor').html('');
            if(data){
                $('#titPeriodico').val(data[0].per_titulo);
                $('#contitPeriodico').val(data[0].per_contratitulo);
                $('#autorPeriodico').val(data[0].per_autor);
                var content = data[0].per_texto;
                var viewFragment = editor.data.processor.toView( content );
                var modelFragment = editor.data.toModel( viewFragment );

                editor.model.insertContent( modelFragment );
                $('#actuImg').html('<b style="color:red;">Sin foto</b>');
                if(data[0].per_link_img != ''){
                    $('#actuImg').html('<b style="color:red;">Actualmente tiene foto</b>');
                }
                $('#pieImgPer').val(data[0].per_link_pie_img);
                $('#fecpublicoPeriodico').val(data[0].fecha_publico_date);
                $('#fecpublPeriodico').val(data[0].fecha_publicacion);
                $('#metodoPer').val('editPeriodico');
                $('#idPer').remove();
                $('#form-Periodico').append('<input type="hidden" id="idPer" name="idPer" value="'+data[0].id_periodico+'">');
                $('#btn-add-Periodico').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-periodico').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var addPeriodico = ()=>{
        var data = new FormData($('#form-Periodico')[0]);
        data.append('textPer',$('.ck-editor__editable').html());
        var ruta = 'Controller/Periodico.controller.php';
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#metodoPed').val() == 'addPeriodico') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-Periodico');
                listarPeriodico();
                $('#add-modal-periodico').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-Periodico');
        $('#add-modal-periodico').modal('show');
        $('#metodoPer').val('addPeriodico');
        $('#actuImg').html('');
        $('#actupieImg').html('');
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

    var deletePeriodico = (id)=>{
        swal({
            title: 'Precaución!',
            text: 'Está seguro que desea eliminar la artículo con id '+ id +'?',
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
                var ruta = 'Controller/Periodico.controller.php';
                var data = {"metodo":"deletePeriodico","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarPeriodico();
                    }else{
                        swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
                    }
                });
            }
        });
    }

    return {
        init:init,
        modalAdd:modalAdd,
        addPeriodico:addPeriodico,
        modalEditPeriodico:modalEditPeriodico,
        deletePeriodico:deletePeriodico
    }


})(jQuery);

$(document).ready(function(){
    _Periodico.init();
    $("#form-Periodico").submit(function(event){
        event.preventDefault();
        _Periodico.addPeriodico();
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
