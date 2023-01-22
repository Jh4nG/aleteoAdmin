var _Suscriptor = (function () {
    var TableSuscriptor, TableVerEmails, imagen, linkImagen;
    _columnsSuscriptor = [
        {"width": "1%"},
        {"width": "20%"},
        {"width": "30%"},
        {"width": "40%"},
        {"width": "10%"},
    ];

    TableSuscriptor = $("#tableSuscriptor").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsSuscriptor,
        order: [[0, "asc"]],
    });

    var listarSuscriptor = (modulo) =>{
        var ruta = 'Controller/Suscriptor.controller.php';
        var data = {"metodo":"listarSuscriptor","parametros":{
            "modulo": modulo,
        }};
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TableSuscriptor.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    TableSuscriptor.row.add([
                        e.nombres,
                        e.telefono,
                        e.email,
                        (e.estado == 1) ? 'Activo' : 'Inactivo',
                        e.fecha_suscripcion
                    ])
                });
                TableSuscriptor.draw();
            }
        });
    }

    return {
        listarSuscriptor: listarSuscriptor
    };
})(jQuery);

$(document).ready(function () {
    _Suscriptor.listarSuscriptor();
});