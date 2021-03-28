<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="pink" id="cantVisitasUsuarios"></h3>
                                <span>Visitas de usuarios</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-user1 pink font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 id="cantVisitasTotal"></h3>
                                <span>Visitas totales</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange" id="dispoEscritorio"></h3>
                                <span>Dispositivos escitorio</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-desktop deep-orange font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-blue" id="dispoMovil"></h3>
                                <span>Dispositivos móviles</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-mobile blue font-large-2 float-xs-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ stats -->
    <!--/ project charts -->
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Tipo</label>
                                <select class="form-control" id="tipoFiltro">
                                    <option value="1">Visitas totales</option>
                                    <option value="2">Visitas de usuarios</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Fecha inicial</label>
                                <input class="form-control" type="date" id="fechaIni" value="<?php echo date('Y-m-01');?>">
                            </div>
                            <div class="col-md-4">
                                <label>Fecha final</label>
                                <input class="form-control" type="date" id="fechaFin" value="<?php echo date('Y-m-d');?>">
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
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xs-3 text-xs-center">
                            <span class="text-muted">Total Projects</span>
                            <h2 class="block font-weight-normal">18</h2>
                            <progress class="progress progress-xs mt-2 progress-success" value="70" max="100"></progress>
                        </div>
                        <div class="col-xs-3 text-xs-center">
                            <span class="text-muted">Total Task</span>
                            <h2 class="block font-weight-normal">125</h2>
                            <progress class="progress progress-xs mt-2 progress-success" value="40" max="100"></progress>
                        </div>
                        <div class="col-xs-3 text-xs-center">
                            <span class="text-muted">Completed Task</span>
                            <h2 class="block font-weight-normal">242</h2>
                            <progress class="progress progress-xs mt-2 progress-success" value="60" max="100"></progress>
                        </div>
                        <div class="col-xs-3 text-xs-center">
                            <span class="text-muted">Total Revenue</span>
                            <h2 class="block font-weight-normal">$11,582</h2>
                            <progress class="progress progress-xs mt-2 progress-success" value="90" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card card-inverse bg-info">
                <div class="card-body">
                    <div class="position-relative">
                        <div class="chart-title position-absolute mt-2 ml-2 white">
                            <!-- <h1 class="display-4">Visitas a páginas</h1> -->
                            <span>Visitas a páginas</span>
                        </div>
                        <div id="canvasGraficaDispositivo">
                            
                        </div>
                        <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-2 mr-3 white">
                            <!-- <a href="#" class="btn bg-info bg-darken-3 mr-1 white">Statistics <i class="icon-stats-bars"></i></a> for the last year. -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ project charts -->
    <!-- Recent invoice with Statistics -->
    <div class="row match-height">
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="p-2 text-xs-center bg-deep-orange media-left media-middle">
                            <i class="icon-user1 font-large-2 white"></i>
                        </div>
                        <div class="p-2 media-body">
                            <h5 class="deep-orange">Suscriptores</h5>
                            <h5 class="text-bold-400"></h5>
                            <!-- <progress class="progress progress-sm progress-deep-orange mt-1 mb-0" value="45" max="100"></progress> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="p-2 text-xs-center bg-cyan media-left media-middle">
                            <i class="icon-camera7 font-large-2 white"></i>
                        </div>
                        <div class="p-2 media-body">
                            <h5>Publicaciones</h5>
                            <h5 class="text-bold-400"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="p-2 media-body text-xs-left">
                            <h5>New Users</h5>
                            <h5 class="text-bold-400">1,22,356</h5>
                        </div>
                        <div class="p-2 text-xs-center bg-teal media-right media-middle">
                            <i class="icon-user1 font-large-2 white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado de Visitantes</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <p>Total paid invoices 240, unpaid 150. <span class="float-xs-right"><a href="#">Invoice Summary <i class="icon-arrow-right2"></i></a></span></p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Invoice#</th>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Due</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-truncate"><a href="#">INV-001001</a></td>
                                    <td class="text-truncate">Elizabeth W.</td>
                                    <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                                    <td class="text-truncate">10/05/2016</td>
                                    <td class="text-truncate">$ 1200.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate"><a href="#">INV-001012</a></td>
                                    <td class="text-truncate">Andrew D.</td>
                                    <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                                    <td class="text-truncate">20/07/2016</td>
                                    <td class="text-truncate">$ 152.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate"><a href="#">INV-001401</a></td>
                                    <td class="text-truncate">Megan S.</td>
                                    <td class="text-truncate"><span class="tag tag-default tag-success">Paid</span></td>
                                    <td class="text-truncate">16/11/2016</td>
                                    <td class="text-truncate">$ 1450.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate"><a href="#">INV-01112</a></td>
                                    <td class="text-truncate">Doris R.</td>
                                    <td class="text-truncate"><span class="tag tag-default tag-warning">Overdue</span></td>
                                    <td class="text-truncate">11/12/2016</td>
                                    <td class="text-truncate">$ 5685.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate"><a href="#">INV-008101</a></td>
                                    <td class="text-truncate">Walter R.</td>
                                    <td class="text-truncate"><span class="tag tag-default tag-warning">Overdue</span></td>
                                    <td class="text-truncate">18/05/2016</td>
                                    <td class="text-truncate">$ 685.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/estadistico.js"></script>