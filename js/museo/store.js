var _Store = (function () {
    var TablesStore;
    var TablesStoreDetails;
    _columnsStore = [
        {"width": "1%"},
        {"width": "1%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
        {"width": "15%"},
    ];
    TablesStore = $("#tableStore").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsStore,
        order: [[0, 'asc']]
    });
    _columnsStoreDetails = [
        {"width": "15%", "className": "dt-center"},
        {"width": "15%", "className": "dt-center"},
    ];
    TablesStoreDetails = $("#tableStoreDetails").DataTable({
        pagingType: "numbers",
        language: lang_dataTable,
        autoWidth: false,
        searching: true,
        ordering: true,
        paging: true,
        destroy: true,
        pageLength: 10,
        columns: _columnsStoreDetails,
        order: [[0, 'asc']]
    });

    var init = ()=>{
        listarVentas();
    }

    const listarVentas = () =>{
        let data = {
            "controlador": "Tienda",
            "metodo": "getVentas"
        }
        data = JSON.stringify(data);
        let type = 'POST';
        $.when(ajaxJson(APIMuseo,data,type)).done((data)=>{
            TablesStore.rows().clear().draw();
            if(data.status == 200){
                dataVentas = data.data;
                $.each(data.data, (i,e)=>{
                    TablesStore.row.add([
                        `<button class="btn btn-info btn-sm" onclick="_Store.getDetails(${e.id},'${e.name_user}','${e.emails}','${e.invoice_number}','${e.register_create}')" id="detailsStore${e.id}" data-toggle="tooltip" data-placement="left" data-original-title="Detalle"><i class="fa fa-info fa-lg"></i></button>`,
                        e.id,
                        e.name_user,
                        e.emails,
                        e.invoice_number,
                        e.register_create
                    ]);
                });
                TablesStore.draw();
            }
        });
    }

    const getDetails = (id,name_user,emails,invoice_number,register_create)=>{
        let data = {
            "controlador": "Tienda",
            "metodo": "getDetailVenta",
            "id" : id
        }
        data = JSON.stringify(data);
        let type = 'POST';
        let userStore = $('#userStore').html(name_user);
        let invoiceStore = $('#invoiceStore').html(invoice_number);
        let emailStore = $('#emailStore').html(emails);
        let dateStore = $('#dateStore').html(register_create);
        $.when(ajaxJson(APIMuseo,data,type)).done((data)=>{
            TablesStoreDetails.rows().clear().draw();
            if(data.status == 200){ // Obtiene el detalle correctamente
                $.each(data.data,(i,e)=>{
                    TablesStoreDetails.row.add([
                        e.name_product,
                        `<img src="https://museointeractivoaleteo.com/assets/img/store/buy/${e.id_product}.jpg" width="150">`
                    ]);
                });
                TablesStoreDetails.draw();
                $('#add-modal-store').modal('show');
            }else{ // Error en el cambio
                swal('Error!',data.msg,_error);
            }
        });
    }

    const getEstadisticas = ()=>{
        setEstadisticas();
        $('#modal-estadisticas').modal('show');
    }

    const setEstadisticas = ()=>{
        let data = {
            "controlador": "Tienda",
            "metodo": "getEstadisticasTienda",
            "fecha_ini" : $('#fechaIni').val(),
            "fecha_fin" : $('#fechaFin').val()
        }
        data = JSON.stringify(data);
        $.when(ajaxJson(APIMuseo,data)).done((data)=>{
            if(data.status == 200){ // Obtiene Estadísticas correctamente
                let d = data.data;
                $('#cantAllBuy').html((d.allBuy[0] != undefined) ? d.allBuy[0].cantidad : 'N/A');
                $('#cantAllProducts').html((d.allProduct[0] != undefined) ? d.allProduct[0].cantidad : 'N/A');
                let labelsGroupMonth = [] ;
                let dataGroupMonth = [] ;
                d.groupMonth.forEach(element => {
                    labelsGroupMonth.push(`${meses[element.mes]} ${element.anio}`);
                    dataGroupMonth.push(element.cantidad);
                });
                setGraficaMonth(labelsGroupMonth,dataGroupMonth);
                let labelsGroupProduct = [] ;
                let dataGroupProducto = [] ;
                d.groupProduct.forEach(element => {
                    labelsGroupProduct.push(element.name_product);
                    dataGroupProducto.push(element.cantidad);
                });
                setTimeout(()=>{
                    setGraficaProducts(labelsGroupProduct,dataGroupProducto);
                },500);
            }else{ // Error en obtener data
                swal('Error!',data.msg,_error);
            }
        });
    }

    const setGraficaMonth = (labelsGroupMonth,dataGroupMonth) =>{
        $('canvas#line-stacked-area').empty();
        $('#line-stacked-area').remove();
        $('#canvasGrafica').html('<canvas id="line-stacked-area" height="100"></canvas>');
        var ctx = document.getElementById('line-stacked-area').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labelsGroupMonth,
                datasets: [{
                    label: "Ventas",
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
    }

    const setGraficaProducts = (labelsGroupProduct,dataGroupProducto) =>{
        $('canvas#emp-satisfaction').empty();
        $('#emp-satisfaction').remove();
        $('#canvasGraficaProductosVendidos').html('<canvas id="emp-satisfaction" height="500"></canvas>');
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
                text: 'Rnago de Productos Vendidos'
            }
        };
        
        // Chart Data
        var empSatData = {
            labels: labelsGroupProduct,
            datasets: [{
                label: "Producto",
                data: dataGroupProducto,
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

    return {
        init:init,
        getDetails:getDetails,
        getEstadisticas:getEstadisticas,
        setEstadisticas:setEstadisticas
    }
})(jQuery);

$(document).ready(function(){
    _Store.init();
});
