var _Publicidad = (function () {
    var TablePublicidad, TableVerEmails, imagen, linkImagen;
    _columnsPubli = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "20%"},
        {"width": "30%"},
        {"width": "40%"},
        {"width": "10%"},
    ];

    _columnsEmail = [
        {"width": "1%"},
        {"width": "30%"},
        {"width": "30%"},
        {"width": "30%"},
    ];

    TablePublicidad = $("#tablePublicidad").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsPubli,
        order: [[0, "asc"]],
    });

    TableVerEmails = $("#tableVerEmails").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: false,
        ordering: false,
        paging: true,
        destroy: true,
        columns: _columnsEmail,
        pageLength: 5,
    });

    var modalPublicidad = () => {
        $("#modalPublicidad").modal('show');
    };

    var listarItemsPublicidad = (modulo) =>{
        var ruta = 'Controller/Publicidad.controller.php';
        var data = {"metodo":"listarItemsPublicidad","parametros":{
            "modulo": modulo,
        }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $("#publicidadPrevisualizar").html('');
            $('#publicidadItem').html('');
            imagen = '';
            $('#publicidadItem').append('<option value="9999999">Seleccione un item</option>')
            $.each(data, function(key, val){
                $('#publicidadItem').append('<option value="'+ val.titulo+ '">'+val.titulo+'</option>');
            });
        });
    }

    var sendPublicidad = () => {
        var html = '';
        var tipo = $('#publicidadModulo').val();
        var tittle = $('#publicidadItem').val();

        if (tipo == '9999999'){
            swal("Advertencia!", "Debe seleccionar un tipo de publicidad!",_warning);
            return false;
        }
        
        if (tittle == '9999999'){
            swal("Advertencia!", "Debe seleccionar un item a enviar!",_warning);
            return false;
        }

        html = '<div id="publicidad" class="row" style="text-align: center;width:700px;margin-left:auto;margin-right:auto">'+
                '<div class="col-md-12">'+
                    '<h1><b>"<i>'+tittle+'</i>"</b></h1></div>'+
                    imagen+
                '</div>';
        html = html.replace('70%', '100%');
        
        var ruta = 'Controller/Publicidad.controller.php';
        var data = {"metodo":"EnviarPublicidad","parametros":{
            "tipo": tipo,
            "titulo": tittle,
            'imagen': linkImagen,
            "html": html,
        }};
        var type = 'post';
        swal("", "Espere!",_warning);
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data == 'nohay'){
                swal("Advertencia!", "No hay personas suscritas!",_warning);
                return false;
            }else if (data == 'error'){
                swal("Advertencia!", "Hubo un erorr!",_warning);
            }else{
                swal("Exito!", "Publicidad enviada!",_success);
            }

            _Publicidad.listarPublicidades();
        });
    }

    var previsualizar = (titulo, modulo) =>{
        $("#publicidadPrevisualizar").html('');
        let divTitulo = '<div class="col-md-12">'+
                            '<h4><b>"<i>'+titulo+'</i>"</b></h4></div>';

        $("#publicidadPrevisualizar").append(divTitulo);
        
        switch (modulo) {
            case 'podcast':
                imagen = '<div class="col-md-12">'+
                            '<a href="https://aleteotransmedia.com/podcast.php" target="_blank">'+
                                '<img width="70%" src="https://aleteotransmedia.com/publicidadPodcast.jpg"</img>'+
                            '</a>'+
                        '</div>';
                linkImagen = 'https://aleteotransmedia.com/publicidadPodcast.jpg';
                break;
            case 'serie_web':
                imagen = '<div class="col-md-12">'+
                            '<a href="https://aleteotransmedia.com/serieweb.php" target="_blank">'+
                                '<img width="70%" src="https://aleteotransmedia.com/publicidadSerieWeb.jpg"</img>'+
                            '</a>'+
                        '</div>';
                linkImagen = 'https://aleteotransmedia.com/publicidadSerieWeb.jpg';
                break;
                
            case 'periodico':
                imagen = '<div class="col-md-12">'+
                            '<a href="https://aleteotransmedia.com/periodico.php" target="_blank">'+
                                '<img width="70%" src="https://aleteotransmedia.com/publicidadPeriodico.jpg"</img>'+
                            '</a>'+
                        '</div>';
                linkImagen = 'https://aleteotransmedia.com/publicidadPeriodico.jpg';
            break;
                
            default:
                break;
        }
        $("#publicidadPrevisualizar").append(imagen);
    }

    var listarPublicidades =() =>{
        $.ajax({
            url : "Controller/Publicidad.controller.php",
            type: "POST",
            data : {"metodo":"listarPublicidades"},
            dataType: 'json',
            beforeSend: function () {
                $("#tablePublicidad").DataTable().clear();
            },
        }).done(function(data){ 
            if(data){
                $.each(data,(i,e)=>{
                    var veremails = '<a href="#" onclick="_Publicidad.modalVerEmails('+e.id+')" data-toggle="tooltip" data-placement="left" data-original-title="Ver Emails"><span class="btn btn-warning btn-sm"><i class="far fa-envelope fa-lg"></i></span></a>  ';
                    var img = '<img width="200px" src="'+e.imagen+'" />';
                    TablePublicidad.row.add([
                        veremails,
                        e.id,
                        e.modulo,
                        e.titulo,
                        img,
                        e.fecha_envio,
                    ]).draw();
                });
            }
        });
    }

    var modalVerEmails = (id) =>{
        var ruta = 'Controller/Publicidad.controller.php';
        var data = {"metodo":"consultarEmails","parametros":{
            "id": id
        }};
        var type = 'post';
        $("#tableVerEmails").DataTable().clear();
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $.each(data,(i,e)=>{
                    TableVerEmails.row.add([
                        e.nombres,
                        e.email,
                        e.telefono,
                        e.fecha_suscripcion,
                    ]).draw();
                });
            }
        });
        $("#modalPublicidadVerEmails").modal('show');
    }

    return {
        modalPublicidad: modalPublicidad,
        sendPublicidad:sendPublicidad,
        listarItemsPublicidad:listarItemsPublicidad,
        previsualizar:previsualizar,
        listarPublicidades:listarPublicidades,
        modalVerEmails:modalVerEmails
    };
})(jQuery);

$(document).ready(function () {
    _Publicidad.listarPublicidades();

    $("#publicidadModulo").change(function(event) {
		event.preventDefault();
		let modulo = $(this).val();

        if(modulo == '9999999'){
            $("#publicidadPrevisualizar").html('');
            $('#publicidadItem').html('');
			return false;
        }
		
        _Publicidad.listarItemsPublicidad(modulo);
	});

    $("#publicidadItem").change(function(event) {
		event.preventDefault();
		let item = $(this).val();
        let modulo = $("#publicidadModulo").val();
		
        if(item == '9999999'){
            $("#publicidadPrevisualizar").html('');
			return false;
        }

        _Publicidad.previsualizar(item, modulo);
	});
});