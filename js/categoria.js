var _Categoria = (function (){
    var TablesCat;
    _columnsCat = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "1%"},
        {"width": "20%"},
        {"width": "15%"},
        {"width": "15%"}
    ];
    TablesCat = $("#tableCategoria").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsCat,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarCategorias();
    }

    var listarCategorias = ()=>{
        var ruta = 'Controller/Categoria.controller.php';
        var data = {"metodo":"listarCategoria"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesCat.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Categoria.modalEditCategoria('+e.id+')" id="editarCategoria'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Categoria"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Categoria.deleteCategoria('+e.id+')" id="deleteCategoria'+e.id+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Categoria"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablesCat.row.add([
                        edit,
                        e.id,
                        e.nombre_categoria,
                        e.desc_categoria,
                        e.cant_reg,
                        e.fecha_creacion
                    ]).draw();
                });
            }
        });
    }

    var addCategoria = ()=>{
        var data = new FormData($('#form-categoria')[0]);
        var ruta = 'Controller/Categoria.controller.php';
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#').val() == 'addCategoria') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-categoria');
                listarCategorias();
                $('#add-modal-categoria').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-categoria');
        $('#add-modal-categoria').modal('show');
        $('#metodoCat').val('addCategoria');
    }

    var modalEditCategoria = (id)=>{
        limpiarFormulario('form-categoria');
        var ruta = 'Controller/Categoria.controller.php';
        var data = {"metodo":"getCategoria","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $('#nomCategoria').val(data[0].nombre_categoria);
                $('#descCategoria').val(data[0].desc_categoria);
                $('#cantCategoria').val(data[0].cant_reg);
                $('#metodoCat').val('editCategoria');
                $('#idCat').remove();
                $('#form-categoria').append('<input type="hidden" id="idCat" name="idCat" value="'+data[0].id+'">');
                $('#btn-add-categoria').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-categoria').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var deleteCategoria = (id)=>{
        swal({
            title: 'Precaución!',
            text: 'Está seguro que desea eliminar la categoría con id '+ id +'?',
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
                var ruta = 'Controller/Categoria.controller.php';
                var data = {"metodo":"deleteCategoria","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarCategorias();
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
        modalEditCategoria:modalEditCategoria,
        addCategoria:addCategoria,
        deleteCategoria:deleteCategoria
    }
})(jQuery);

$(document).ready(function(){
    _Categoria.init();
    $("#form-categoria").submit(function(event){
        event.preventDefault();
        _Categoria.addCategoria();
    });
});
