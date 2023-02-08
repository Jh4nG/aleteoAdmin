<div class="content-body"><!-- stats -->
    <h3>Estadísticas de visitas Museo Interactivo</h3>
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-xs-12">
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
        <div class="col-xl-4 col-lg-6 col-xs-12">
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
        <div class="col-xl-4 col-lg-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="media">
                            <div class="media-body text-xs-left">
                                <h3 class="deep-orange" id="cantVisitasMes"></h3>
                                <span>Visitas mes actual</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-desktop deep-orange font-large-2 float-xs-right"></i>
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
                            <!-- <div class="col-md-4">
                                <label>Tipo</label>
                                <select class="form-control" id="tipoFiltro">
                                    <option value="1">Visitas totales</option>
                                    <option value="2">Visitas de usuarios</option>
                                </select>
                            </div> -->
                            <div class="col-md-6">
                                <label>Fecha inicial</label>
                                <input class="form-control" type="date" id="fechaIni" value="<?php echo date('Y-m-01');?>">
                            </div>
                            <div class="col-md-6">
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
                <!-- <div class="card-footer">
                    <div class="row">
                        <div class="col-xs-4 text-xs-center">
                            <span class="text-muted">Podcast</span>
                            <h2 class="block font-weight-normal" id="cantPodcast"></h2>
                        </div>
                        <div class="col-xs-4 text-xs-center">
                            <span class="text-muted">Periódico Digital</span>
                            <h2 class="block font-weight-normal" id="cantPeriodico"></h2>
                        </div>
                        <div class="col-xs-4 text-xs-center">
                            <span class="text-muted">Serie web</span>
                            <h2 class="block font-weight-normal" id="cantSerieWeb">0</h2>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card card-inverse bg-info">
                <div class="card-body">
                    <div class="position-relative" style="max-width:500px">
                        <div id="canvasGraficaDispositivo" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ project charts -->
    <!-- Recent invoice with Statistics -->
    <div class="row match-height">
        <!-- <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="p-2 text-xs-center bg-deep-orange media-left media-middle">
                            <i class="icon-user1 font-large-2 white"></i>
                        </div>
                        <div class="p-2 media-body">
                            <h5 class="deep-orange">Suscriptores</h5>
                            <h5 class="text-bold-400"></h5>
                            <progress class="progress progress-sm progress-deep-orange mt-1 mb-0" value="45" max="100"></progress> 
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
        </div> -->
        <div class="col-xl-12 col-lg-12">
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
                        <!-- <p>Total paid invoices 240, unpaid 150. <span class="float-xs-right"><a href="#">Invoice Summary <i class="icon-arrow-right2"></i></a></span></p> -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tableVisit">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Ip Visitador</th>
                                    <th>Página</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/museo/estadisMuseo.js"></script>