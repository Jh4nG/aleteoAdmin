var _EstadisticoMuseo = (function (){
    var ruta = 'Controller/Estadisticos.controller.php';
    var TablesEst,_columnsEst;
    _columnsEst = [
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
    }

    var getDataPrincipal = ()=>{
        let data = {
            "controlador": "Tienda",
            "metodo": "getEstadisticas",
            "fecha_ini" : $('#fechaIni').val(),
            "fecha_fin" : $('#fechaFin').val()
        }
        data = JSON.stringify(data);
        $.when(ajaxJson(APIMuseo,data)).done((data)=>{
            if(data.status == 200){ // Obtiene Estadísticas correctamente
                let d = data.data;
                $('#cantVisitasTotal').html((d.dataAllVisitas[0] != undefined) ? d.dataAllVisitas[0].cantidad : 'N/A');
                $('#cantVisitasUsuarios').html((d.dataAllVisitasUser[0] != undefined) ? d.dataAllVisitasUser[0].cantidad : 'N/A');
                $('#cantVisitasMes').html((d.dataAllVisitasOneMonth[0] != undefined) ? d.dataAllVisitasOneMonth[0].cantidad : 'N/A');
                let labelsGroupMonth = [] ;
                let dataGroupMonth = [] ;
                d.dataVisitasMonth.forEach(element => {
                    labelsGroupMonth.push(`${meses[element.mes]} ${element.anio}`);
                    dataGroupMonth.push(element.cantidad);
                });
                let labelsGroupPage = [] ;
                let dataGroupPage = [] ;
                d.dataVisitasPage.forEach(element => {
                    labelsGroupPage.push(element.pagina);
                    dataGroupPage.push(element.cantidad);
                });
                getGrafica(labelsGroupMonth,dataGroupMonth, labelsGroupPage, dataGroupPage);
                getTable(d.dataAllVisitasTable);
            }else{ // Error en obtener data
                swal('Error!',data.msg,_error);
            }
        });
    }

    var getGrafica = (labelsGroupMonth,dataGroupMonth, labelsGroupPage, dataGroupPage)=>{
        $('canvas#line-stacked-area').empty();
        $('#line-stacked-area').remove();
        $('#canvasGrafica').html('<canvas id="line-stacked-area" height="100"></canvas>');
        var ctx = document.getElementById('line-stacked-area').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labelsGroupMonth,
                datasets: [{
                    label: "Meses",
                    data: dataGroupMonth,
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
                    ticks: {
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
            labels: labelsGroupPage,
            datasets: [{
                label: "Página",
                data: dataGroupPage,
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
    }

    var getTable = (data) =>{
        TablesEst.rows().clear().draw();
        if(data){
            $.each(data,(i,e)=>{
                TablesEst.row.add([
                    e.id_vis,
                    e.id_visitador,
                    e.pagina,
                    e.fecha_visita,
                ]);
            });
            TablesEst.draw();
            swal.close();
        }
    }

    return {
        init:init
    }
})(jQuery);

$(document).ready(function(){
    _EstadisticoMuseo.init();

    $('#tipoFiltro, #fechaIni, #fechaFin').on('change',()=>{
        _EstadisticoMuseo.init();
    });
});
