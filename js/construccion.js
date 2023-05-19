var _Construccion = (function (){
    var TablesCons;
    _columnsCons = [
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    TablesCons = $("#tableConstruc").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsCons,
        order: [[1, 'asc']]
    });

    var init = ()=>{
        listarConstr();
    }

    var listarConstr = ()=>{
        var ruta = 'Controller/Construccion.controller.php';
        var data = {"metodo":"listarConstruc"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesCons.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Construccion.modalEditConstruccion('+e.id_constr+')" id="editarConstruccion'+e.id_constr+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Construcción"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Construccion.deleteConstruccion('+e.id_constr+')" id="deleteConstruccion'+e.id_constr+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Construcción"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablesCons.row.add([
                        edit,
                        e.nom_pagina,
                        e.img_constr,
                        e.estado == 0 ? 'En construcción' : 'Activo'
                    ]).draw();
                });
            }
        });
    }

    var addConstruccion = ()=>{
        var data = new FormData($('#form-Constr')[0]);
        var ruta = 'Controller/Construccion.controller.php';
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#').val() == 'addCategoria') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-Constr');
                listarConstr();
                $('#add-modal-construccion').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-Constr');
        $('#add-modal-construccion').modal('show');
        $('#metodoConstr').val('addConstruccion');
    }

    var modalEditConstruccion = (id)=>{
        limpiarFormulario('form-Constr');
        var ruta = 'Controller/Construccion.controller.php';
        var data = {"metodo":"getConstruccion","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $('#nomConstr').val(data[0].nom_pagina);
                $('#selConstr option').removeAttr('selected');
                $('#selConstr option[value="'+data[0].estado+'"]').attr('selected','');
                $('#actuImg').html('');
                if(data[0].img_constr != ''){$('#actuImg').html('<b style="color:red">Actualmente Tiene imàgen</b>')}
                $('#metodoConstr').val('editConstruc');
                $('#idConstr').remove();
                $('#form-Constr').append('<input type="hidden" id="idConstr" name="idConstr" value="'+data[0].id_constr+'">');
                $('#btn-add-Constr').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-construccion').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }


    return {
        init:init,
        addConstruccion:addConstruccion,
        modalAdd:modalAdd,
        modalEditConstruccion:modalEditConstruccion,

    } 


})(jQuery);
$(document).ready(function(){
    _Construccion.init();
    $("#form-Constr").submit(function(event){
        event.preventDefault();
        _Construccion.addConstruccion();
    });
});
