<!-- <link href="assets/css/voice.css"  rel="stylesheet" type="text/css" media="all"> -->
<div class="content-body"><!-- stats -->    
    <h1>Ventas del futuro</h1>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-success" onclick="_Store.getEstadisticas()">Estadísticas</button>
                    <br>
                    <br>
                    <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact" id="tableStore" width="100%">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Id </td>
                                <td>Nombre Usuario</td>
                                <td>Correos</td>
                                <td>Factura</td>
                                <td>Fecha compra</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="add-modal-store" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Detalle de compra</h4>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Usuario: <span id="userStore"></span></h4>
                        <h4>Factura: <span id="invoiceStore"></span></h3>
                    </div>
                    <div class="col-md-6">
                        <h4>Correos: <span id="emailStore"></span></h4>
                        <h4>Fecha: <span id="dateStore"></span></h3>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact" id="tableStoreDetails" width="100%">
                            <thead>
                                <tr>
                                    <td>Nombre Producto</td>
                                    <td>Imagen</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-estadisticas" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Estadísticas de compra</h4>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="pink" id="cantAllBuy"></h3>
                                            <span>Total Ventas</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="fa fa-shopping-cart pink font-large-2 float-xs-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 id="cantAllProducts"></h3>
                                            <span>Total productos comprados</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="fa fa-cubes teal font-large-2 float-xs-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gráfica de meses -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h3>Ventas Según rango de fechas</h3>
                                    <div class="form-group row">
                                        <!-- <div class="col-md-4">
                                            <label>Tipo</label>
                                            <select class="form-control" id="tipoFiltro">
                                                <option value="1">Visitas totales</option>
                                                <option value="2">Visitas de usuarios</option>
                                            </select>
                                        </div> -->
                                        <div class="col-md-6">
                                            <label>Fecha inicial</label>
                                            <input onchange="_Store.setEstadisticas()" class="form-control" type="date" id="fechaIni" value="<?php echo date('Y-m-d',strtotime(date('Y-m-d') . '-3 month'));?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Fecha final</label>
                                            <input onchange="_Store.setEstadisticas()" class="form-control" type="date" id="fechaFin" value="<?php echo date('Y-m-d');?>">
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline text-xs-center pt-2 m-0">
                                    <li class="mr-1">
                                    </li>
                                    <li class="mr-1">
                                    </li>
                                </ul>
                                <div class="chartjs height-250" id="canvasGrafica">
                                    <canvas id="line-stacked-area" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfica de productos más vendidos -->
                    <div class="col-xl-2 col-lg-12"></div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="card card-inverse bg-info">
                            <div class="card-body">
                                <div class="position-relative" style="max-width:500px;">
                                    <div id="canvasGraficaProductosVendidos" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="js/museo/store.js"></script>