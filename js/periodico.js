var _Periodico = (function (){
    var TablesPer;
    _columnsPer = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"}
        // Título - fecha - nombre de autor - Contratítulo - Texto - Imagen - Pie de foto (imagen) -
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

    return {

    }

})(jQuery);

$(document).ready(function(){
    _Periodico.init();
    $("#form-Seccion").submit(function(event){
        event.preventDefault();
        _Periodico.addSeccion();
    });
  
});
