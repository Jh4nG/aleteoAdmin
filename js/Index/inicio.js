var _Inicio = (function (){
    var TablesDes;
    _columnsDes = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "20%"},
        {"width": "15%"},
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
    TablesDes = $("#tableIndex").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsDes,
        order: [[1, 'asc']]
    });

    var init = ()=>{
        listarSecciones();
        listarCategoria();
    }

    var listarSecciones = ()=>{
        var ruta = 'Controller/Inicio.controller.php';
        var data = {"metodo":"listarSecciones"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesDes.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_Inicio.modalEditSecciones('+e.id+')" id="editarSecciones'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Secciones"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_Inicio.deleteSecciones('+e.id+')" id="deleteSecciones'+e.id+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Categoria"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    if(e.sec_iframe != ''){
                        e.sec_iframe = e.sec_iframe.replace('width="650" height="400"','width="100" height="60"');
                    }
                    TablesDes.row.add([
                        edit,
                        e.id,
                        e.nombre,
                        e.sec_titulo,
                        e.sec_desc,
                        e.sec_img,
                        e.sec_iframe,
                        e.sec_link_redirect,
                        e.sec_icon,
                        e.sec_estado,
                        e.sec_posicion,
                        e.nombre_categoria,
                        e.fecha_creacion
                    ]).draw();
                });
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-Seccion');
        $('#actuImg').html('');
        $('#add-modal-seccion').modal('show');
        $('#metodoSec').val('addSeccion');
    }

    var listarCategoria = ()=>{
        var ruta = 'Controller/Categoria.controller.php';
        var data = {"metodo":"listarCategoria"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $('#catSeccion').html();
            if(data){
                $('#catSeccion').append('<option value>Seleccionar...</option>');
                $.each(data,(i,e)=>{
                    $('#catSeccion').append('<option value="'+e.id+'">'+e.nombre_categoria+'</option>');
                });
            }
        });
    }

    var addSeccion = ()=>{
        var data = new FormData($('#form-Seccion')[0]);
        var ruta = 'Controller/Inicio.controller.php';
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#').val() == 'addSeccion') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-Seccion');
                listarSecciones();
                $('#add-modal-seccion').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalEditSecciones = (id)=>{
        limpiarFormulario('form-Seccion');
        var ruta = 'Controller/Inicio.controller.php';
        var data = {"metodo":"getSeccion","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){

                $('#nomSeccion').val(data[0].nombre);
                $('#titSeccion').val(data[0].sec_titulo);
                $('#descSeccion').val(data[0].sec_desc);
                $('#videoSeccion').val(data[0].sec_iframe);
                $('#actuImg').html('<b style="color:red;">Sin foto</b>');
                if(data[0].sec_img != ''){
                    $('#actuImg').html('<b style="color:red;">Actualmente tiene foto</b>');
                }
                $('#linkSeccion').val(data[0].sec_link_redirect);
                $('#iconSeccion').val(data[0].sec_icon);
                $('#selSeccion option').removeAttr('selected');
                $('#selSeccion option[value="'+data[0].sec_estado+'"]').attr('selected','');
                $('#posSeccion').val(data[0].sec_posicion);
                $('#catSeccion option[value="'+data[0].id_categoria+'"]').attr('selected','');

                $('#metodoSec').val('editSecciones');
                $('#idSec').remove();
                $('#form-Seccion').append('<input type="hidden" id="idSec" name="idSec" value="'+data[0].id+'">');
                $('#btn-add-Seccion').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-seccion').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var deleteSecciones = (id)=>{
        swal({
            title: 'Precaución!',
            text: 'Está seguro que desea eliminar la sección con id '+ id +'?',
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
                var ruta = 'Controller/Inicio.controller.php';
                var data = {"metodo":"deleteSeccion","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarSecciones();
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
        addSeccion:addSeccion,
        deleteSecciones:deleteSecciones,
        modalEditSecciones:modalEditSecciones
    }
})(jQuery);

$(document).ready(function(){
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: false
    });
    _Inicio.init();
    $("#form-Seccion").submit(function(event){
        event.preventDefault();
        _Inicio.addSeccion();
    });
  
});
