var _Perfiles = (function (){
    var ruta = 'Controller/Perfiles.controller.php';
    var TablesPerfiles;
    _columnsPerfiles = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "15%"}
    ];
    TablesPerfiles = $("#tablePerfiles").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsPerfiles,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarPerfiles();
    }

    var listarPerfiles = () =>{
        var data = {"metodo":"listarPerfiles"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesPerfiles.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Perfiles.modalEditPerfiles('+e.rol_id+')" id="editarPerfiles'+e.rol_id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Categoria"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Perfiles.deletePerfiles('+e.rol_id+')" id="deletePerfiles'+e.rol_id+'" data-link="" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Categoria"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablesPerfiles.row.add([
                        edit,
                        e.rol_id,
                        e.rol_nombre
                    ]).draw();
                });
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-Perfiles');
        $('#add-modal-Perfiles').modal('show');
        $('#metodoPerfiles').val('addPerfiles');
        $('#btn-add-Perfiles').html('Agregar').attr('class','btn btn-success');
        $('#actuImg').html('');
        $('#perfilPerfiles option').removeAttr('selected');
    }

    var addPerfiles = ()=>{
        var data = new FormData($('#form-Perfiles')[0]);
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#metodoSer').val() == 'addPerfiles') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-Perfiles');
                listarPerfiles();
                $('#add-modal-Perfiles').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalEditPerfiles = (id)=>{
        limpiarFormulario('form-Perfiles');
        var data = {"metodo":"getPerfiles","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $('#nombrePerfiles').val(data[0].rol_nombre);
                $('#metodoPerfiles').val('editPerfiles');
                $('#idPerfil').remove();
                $('#form-Perfiles').append('<input type="hidden" id="idPerfil" name="idPerfil" value="'+data[0].rol_id+'">');
                $('#btn-add-Perfiles').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-Perfiles').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var deletePerfiles = (id)=>{
        swal({
            title: 'Precaución!',
            text: 'Está seguro que desea eliminar el registro con id '+ id +'?',
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
                var data = {"metodo":"deletePerfiles","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarPerfiles();
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
        addPerfiles:addPerfiles,
        modalEditPerfiles:modalEditPerfiles,
        deletePerfiles:deletePerfiles
    }
})(jQuery);

$(document).ready(function(){
    _Perfiles.init();
    $("#form-Perfiles").submit(function(event){
        event.preventDefault();
        _Perfiles.addPerfiles();
    });
});
    