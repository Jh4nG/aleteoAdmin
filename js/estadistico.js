var _Estadistico = (function (){
    var ruta = 'Controller/Estadisticos.controller.php';
    var TablesEst,_columnsEst;
    _columnsEst = [
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    TablesEst = $("#tableVisit").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsEst,
        order: [[0, 'desc']]
    });

    var init = ()=>{
        getDataPrincipal();
        getGrafica();
        getTable();
    }

    var getDataPrincipal = ()=>{
        var data = {"metodo":"getInfo","parametros":{
            'fechaIni' : $('#fechaIni').val(),
            'fechaFin' : $('#fechaFin').val()
        }}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            var total = data.visitas[0].cantidad;
            $('#cantVisitasUsuarios').html(data.visitador[0].cantidad);
            $('#cantVisitasTotal').html(total);
            $('#dispoEscritorio').html(0);
            $('#dispoMovil').html(0);
            $('#cantPodcast').html(data.podcast[0].cantidad);
            $('#cantPeriodico').html(data.periodico[0].cantidad);
            if(total>0){
                var pocertEscr = Math.round((data.dispositivos[0].cantidad*100)/total);
                $('#dispoEscritorio').html(data.dispositivos[0].cantidad + ' ('+ pocertEscr + '%)');
                var pocertMovil = Math.round((data.dispositivos[1].cantidad*100)/total);
                $('#dispoMovil').html(data.dispositivos[1].cantidad + ' ('+ pocertMovil + '%)');
            }
        });
    }

    var getGrafica = ()=>{
        var data = {"metodo":"getGrafica","parametros":{
            "tipo" : $('#tipoFiltro').val(),
            'fechaIni' : $('#fechaIni').val(),
            'fechaFin' : $('#fechaFin').val()
        }}
        var type = 'post';
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            $('canvas#line-stacked-area').empty();
            $('#line-stacked-area').remove();
            $('#canvasGrafica').html('<canvas id="line-stacked-area" height="100"></canvas>');
            var ctx = document.getElementById('line-stacked-area').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.label,
                    datasets: [{
                        label: $('#tipoFiltro option:selected').html(),
                        data: data.data,
                        borderWidth: 1,
                        fillColor: "rgba(255, 99, 132, 0.2)",
                        strokeColor: "rgba(255, 99, 132, 1)",
                        pointColor: "rgba(255, 99, 132, 1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(255, 99, 132, 1)",
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 1)",
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            display: true,
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


            $('canvas#emp-satisfaction').empty();
            $('#emp-satisfaction').remove();
            $('#canvasGraficaDispositivo').html('<canvas id="emp-satisfaction" height="500"></canvas>');
            var ctx1 = document.getElementById("emp-satisfaction").getContext("2d");

            // Create Linear Gradient
            var white_gradient = ctx1.createLinearGradient(0, 0, 0,400);
            white_gradient.addColorStop(0, 'rgba(255,255,255,0.5)');
            white_gradient.addColorStop(1, 'rgba(255,255,255,0)');

            // Chart Options
            var empSatOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetStrokeWidth : 3,
                pointDotStrokeWidth : 4,
                textColor: "#FFF",
                tooltipFillColor: "rgba(255,255,255,0.8)",
                legend: {
                    display: false,
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        label: {
                            fontColor: "#FFF",
                        }
                    }],
                    yAxes: [{
                        display: false,
                        ticks: {
                            min: 0,
                        },
                    }]
                },
                title: {
                    display: true,
                    fontColor: "#FFF",
                    fullWidth: false,
                    fontSize: 15,
                    text: 'Visita a páginas'
                }
            };
            
            // Chart Data
            var empSatData = {
                labels: data.labelPag,
                datasets: [{
                    label: "Página",
                    data: data.dataPag,
                    backgroundColor: white_gradient,
                    borderColor: "rgba(255,255,255,1)",
                    borderWidth: 2,
                    strokeColor : "#ff6c23",
                    pointColor : "#fff",
                    pointBorderColor: "rgba(255,255,255,1)",
                    pointBackgroundColor: "#3BAFDA",
                    pointBorderWidth: 2,
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                }]
            };

            var empSatconfig = {
                type: 'line',

                // Chart Options
                options : empSatOptions,

                // Chart Data
                data : empSatData
            };

            // Create the chart
            var areaChart = new Chart(ctx1, empSatconfig);

        });
    }

    var getTable = () =>{
        var data = {"metodo":"getVisitasTable","parametros":{
            'fechaIni' : $('#fechaIni').val(),
            'fechaFin' : $('#fechaFin').val()
        }}
        var type = 'post';
        alertaWait();
        $.when(ajaxJson(ruta,data,type)).done((data)=>{
            TablesEst.rows().clear().draw();
            if(data){
                $.each(data,(i,e)=>{
                    TablesEst.row.add([
                        e.id_vis,
                        e.id_visitador,
                        e.pagina,
                        (e.dispositivo == 0)?'Escritorio':'Móvil',
                        e.fecha_visita,
                    ]).draw();
                });
                swal.close();
            }
        });
    }

    return {
        init:init
    }
})(jQuery);

$(document).ready(function(){
    _Estadistico.init();

    $('#tipoFiltro, #fechaIni, #fechaFin').on('change',()=>{
        _Estadistico.init();
    });
});
