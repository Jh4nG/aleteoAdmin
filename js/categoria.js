var _Categoria = (function (){
    var TablesCat;
    _columnsCat = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "20%"},
        {"width": "15%"},
        {"width": "15%"}
    ];
    TablesCat = $("#tableCategoria").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsCat,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarCategorias();
    }

    var listarCategorias = ()=>{
        var ruta = 'Controller/Categoria.controller.php';
        var data = {"metodo":"listarCategoria"}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            if(data){
                $.each(data,(i,e)=>{
                    TablesCat.row.add([
                        e.id,
                        e.nombre_categoria,
                        e.desc_categoria,
                        e.cant_reg,
                        e.fecha_creacion
                    ]).draw();
                });
            }
        });
    }

    return {
        init:init
    }
})(jQuery);

$(document).ready(function(){
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: false
    });
    _Categoria.init();
});
