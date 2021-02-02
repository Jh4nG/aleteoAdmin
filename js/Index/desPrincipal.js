var _Estadistico = (function (){
    var TablesDes;
    _columnsDes = [
        {
          "width": "1%"
        },
        {
          "width": "1%"
        },
        {
          "width": "20%"
        },
        {
          "width": "15%"
        },
        {
          "width": "15%"
        },
        {
          "width": "15%"
        },
        {
          "width": "15%"
        }
    ];
    TablesDes = $("#tableDesPrincipal").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsDes,
        order: [[1, 'desc']]
    });

    return {
        
    }
})(jQuery);

$(document).ready(function(){
    
});
