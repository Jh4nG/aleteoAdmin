var _SerieWeb = (function (){
    var ruta = 'Controller/SerieWeb.controller.php';
    var TablesSerie;
    _columnsPer = [
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    TablesSerie = $("#tableSerie").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsPer,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarSerie();
    }

    var listarSerie = ()=>{
        var data = {"metodo":"listarSerie"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesSerie.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    var edit = '<a href="#" onclick="_SerieWeb.modalEditSerieWeb('+e.id+')" id="editarSerieWeb'+e.id+'" data-toggle="tooltip" data-placement="left" data-original-title="Editar Categoria"><span class="btn btn-warning btn-sm"><i class="far fa-edit fa-lg"></i></span></a>  ';
                    edit += '<a href="#" onclick="_SerieWeb.deleteSerieWeb('+e.id+')" id="deleteSerieWeb'+e.id+'" data-link="'+e.link+'" data-toggle="tooltip" data-placement="right" data-original-title="Eliminar Categoria"><span class="btn btn-danger btn-sm"><i class="far fa-times-circle fa-lg"></i></span></a>';
                    TablesSerie.row.add([
                        edit,
                        e.serie_titulo,
                        e.serie_descipcion.substr(0,50)+' ....',
                        e.serie_img,
                        e.serie_video.replace('width="560" ','width="100"').replace('height="315"','height="50"'),
                        e.clasificacion,
                        e.serie_fecha_creacion
                    ]).draw();
                });
            }
        });
    }

    var modalAdd = ()=>{
        limpiarFormulario('form-SerieWeb');
        $('#add-modal-SerieWeb').modal('show');
        $('#metodoSer').val('addSerieWeb');
    }

    var addSerie = ()=>{
        var data = new FormData($('#form-SerieWeb')[0]);
        var type = 'post';
        $.when(ajaxJsonForm(ruta,data,type)).done((resp)=>{
            if(resp){
                add = ($('#metodoSer').val() == 'addSerie') ?'registrado':'editado';
                swal('Éxito!','Se ha '+add+' con éxito.',_success);
                limpiarFormulario('form-SerieWeb');
                listarSerie();
                $('#add-modal-SerieWeb').modal('hide');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var modalEditSerieWeb = (id)=>{
        limpiarFormulario('form-SerieWeb');
        var data = {"metodo":"getSerieWeb","parametros":{'id':id}}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $('#titSerieWeb').val(data[0].serie_titulo);
                $('#descSerieWeb').val(data[0].serie_descipcion);
                $('#videoSerie').val(data[0].serie_video);
                $('#clasificaSerieWeb option').removeAttr('selected');
                $('#clasificaSerieWeb option[value="'+data[0].serie_clasificacion+'"]').attr('selected','true');

                $('#actuImg').html('<b style="color:red;">Sin foto</b>');
                if(data[0].serie_img != ''){
                    $('#actuImg').html('<b style="color:red;">Actualmente tiene foto</b>');
                }
                $('#metodoSer').val('editSerieWeb');
                $('#idSer').remove();
                $('#form-SerieWeb').append('<input type="hidden" id="idSer" name="idSer" value="'+data[0].id+'">');
                $('#btn-add-SerieWeb').html('Editar').attr('class','btn btn-primary');
                $('#add-modal-SerieWeb').modal('show');
            }else{
                swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
            }
        });
    }

    var deleteSerieWeb = (id)=>{
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
                var data = {"metodo":"deleteSerie","parametros":{'id':id}}
                var type = 'post';
                $.when(ajaxJson(ruta,data,type)).done((resp)=>{
                    if(resp){
                        swal('Éxito!','Se ha elimiando con éxito.',_success);
                        listarSerie();
                    }else{
                        swal('Error!','No se ha podido registar. \n Contacte con el administrador',_error);
                    }
                });
            }
        });
    }

    return {
        init:init,
        addSerie:addSerie,
        modalAdd:modalAdd,
        modalEditSerieWeb:modalEditSerieWeb,
        deleteSerieWeb:deleteSerieWeb
    }
})(jQuery);

$(document).ready(function(){
    _SerieWeb.init();
    $("#form-SerieWeb").submit(function(event){
        event.preventDefault();
        _SerieWeb.addSerie();
    });
});
    