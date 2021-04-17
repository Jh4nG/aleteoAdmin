var _Publicidad = (function () {
    var TablePublicidad, tarjetaPodcast, tarjetaPeriodico, tarjetaSerieWeb;

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
            $('#publicidadItem').append('<option value="9999999">Seleccione un item</option>')
            $.each(data, function(key, val){
                $('#publicidadItem').append('<option value="'+ val.titulo+ '">'+val.titulo+'</option>');
            });
        });
    }

    var sendPublicidad = () => {
        var ruta = 'Controller/Publicidad.controller.php';
        var data = {"metodo":"EnviarPublicidad"};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{

        });
    }

    var previsualizar = (titulo, modulo) =>{
        $("#publicidadPrevisualizar").html('');
        let divTitulo = '<div class="col-md-12">'+
                            '<h4><b>"<i>'+titulo+'</i>"</b></h4></div>';

        $("#publicidadPrevisualizar").append(divTitulo);
        
        switch (modulo) {
            case 'podcast':
                var imagen = '<div class="col-md-12">'+
                            '<img width="70%" src="'+tarjetaPodcast+'"</img></div>';
            break;

            case 'serie_web':
                var imagen = '<div class="col-md-12">'+
                            '<img width="70%" src="'+tarjetaSerieWeb+'"</img></div>';
            break;

            case 'periodico':
                var imagen = '<div class="col-md-12">'+
                            '<img width="70%" src="'+tarjetaPeriodico+'"</img></div>';
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