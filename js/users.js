var _Users = (function (){
    var ruta = 'Controller/Users.controller.php';
    var TablesUsers;
    _columnsUsers = [
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    TablesUsers = $("#tableUsers").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsUsers,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarUsers();
        listarPerfiles();
    }

    var listarUsers = () =>{
        var data = {"metodo":"listarUsers"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesUsers.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Users.modalEditUsers('+e.du_id+')" id="editarUsers'+e.du_id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Categoria"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Users.deleteUsers('+e.du_id+')" id="deleteUsers'+e.du_id+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Categoria"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablesUsers.row.add([
                        edit,
                        e.du_nombres,
                        e.du_descripcion.substr(0,50)+' ....',
                        `<img src="/../../aleteoGit/images/img-project/${e.du_img}" width="50" \>`,
                        e.rol_nombre,
                        e.fecha_creacion
                    ]).draw();
                });
            }
        });
    }

    var listarPerfiles = () =>{
        var data = {"metodo":"listarPerfiles"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $.each(data,(i,e)=>{
                $('#perfilUsers').append('<option value="'+e.rol_id+'">'+e.rol_nombre+'</option>');
            });
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-Users');
        $('#add-modal-Users').modal('show');
        $('#metodoUsers').val('addUsers');
        $('#btn-add-Users').html('Agregar').attr('class','btn btn-success');
        $('#actuImg').html('');
        $('#perfilUsers option').removeAttr('selected');
    }

    var addUsers = ()=>{
        var data = new FormData($('#form-Users')[0]);
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#metodoSer').val() == 'addUsers') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-Users');
                listarUsers();
                $('#add-modal-Users').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalEditUsers = (id)=>{
        limpiarFormulario('form-Users');
        var data = {"metodo":"getUsers","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $('#nombreUsers').val(data[0].du_nombres);
                $('#descUsers').val(data[0].du_descripcion);
                $('#perfilUsers option').removeAttr('selected');
                $('#perfilUsers option[value="'+data[0].id_rol+'"]').attr('selected','true');

                $('#actuImg').html('<b style="color:red;">Sin foto</b>');
                if(data[0].du_img != '' && data[0].du_img != null){
                    $('#actuImg').html('<b style="color:red;">Actualmente tiene foto</b>');
                }else{
                    $('#imgUsers').attr('required',true);
                }
                $('#metodoUsers').val('editUsers');
                $('#idUser').remove();
                $('#form-Users').append('<input type="hidden" id="idUser" name="idUser" value="'+data[0].du_id+'">');
                $('#btn-add-Users').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-Users').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var deleteUsers = (id)=>{
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
                var data = {"metodo":"deleteUsers","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarUsers();
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
        addUsers:addUsers,
        modalEditUsers:modalEditUsers,
        deleteUsers:deleteUsers
    }
})(jQuery);

$(document).ready(function(){
    _Users.init();
    $("#form-Users").submit(function(event){
        event.preventDefault();
        _Users.addUsers();
    });
});
    