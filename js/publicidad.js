var _Publicidad = (function () {
    var TablePublicidad, tarjetaPodcast, tarjetaPeriodico, tarjetaSerieWeb, imagen;

    TablePublicidad = $("#tablePublicidad").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        order: [[0, "asc"]],
    });

    var tarjetas = () =>{
        var ruta = 'Controller/Publicidad.controller.php';
        var data = {"metodo":"traerTarjetas"};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
           tarjetaPodcast = data.podcast;
           tarjetaPeriodico = data.periodico;
           tarjetaSerieWeb = data.serieweb;
        });
    }

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

        html = '<div id="publicidad" class="row" style="text-align: center;">'+
                '<div class="col-md-12">'+
                    '<h1><b>"<i>'+tittle+'</i>"</b></h1></div>'+
                    imagen+
                '</div>';
        html = html.replace('70%', '40%');
        
        var ruta = 'Controller/Publicidad.controller.php';
        var data = {"metodo":"EnviarPublicidad","parametros":{
            "tipo": tipo,
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
                                // '<img width="70%" src="'+tarjetaPodcast+'"</img>'+
                                '<img width="70%" src="https://aleteotransmedia.com/publicidadPodcast.jpg"</img>'+
                            '</a>'+
                        '</div>';
            break;

            case 'serie_web':
                imagen = '<div class="col-md-12">'+
                            '<a href="https://aleteotransmedia.com/podcast.php" target="_blank">'+
                                // '<img width="70%" src="'+tarjetaSerieWeb+'"</img>'+
                                '<img width="70%" src="https://aleteotransmedia.com/publicidadSerieWeb.jpg"</img>'+
                            '</a>'+
                        '</div>';
            break;

            case 'periodico':
                imagen = '<div class="col-md-12">'+
                            '<a href="https://aleteotransmedia.com/periodico.php" target="_blank">'+
                                // '<img width="70%" src="'+tarjetaPeriodico+'"</img>'+
                                '<img width="70%" src="https://aleteotransmedia.com/publicidadPeriodico.jpg"</img>'+
                            '</a>'+
                        '</div>';
            break;
                
            default:
                break;
        }
        $("#publicidadPrevisualizar").append(imagen);
    }

    return {
        modalPublicidad: modalPublicidad,
        sendPublicidad:sendPublicidad,
        listarItemsPublicidad:listarItemsPublicidad,
        previsualizar:previsualizar,
        tarjetas:tarjetas
    };
})(jQuery);

$(document).ready(function () {
    _Publicidad.tarjetas();

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