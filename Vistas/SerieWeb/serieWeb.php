<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_SerieWeb.modalAdd()">Añadir</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableSerie" width="100%">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Título </td>
                                <td>Descipción</td>
                                <td>Imagen</td>
                                <td>Vídeo </td>
                                <td>Clasificación </td>
                                <td>Fecha creación</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="add-modal-SerieWeb" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">SerieWeb Digital</h4>
            </div>
            <form id="form-SerieWeb" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label for="titSerieWeb">Titulo</label>
                            <input class="form-control" type="text" id="titSerieWeb" name="titSerieWeb" placeholder="Titulo" required>

                            <label for="descSerieWeb">Descipción</label>
                            <textarea class="form-control" id="descSerieWeb" name="descSerieWeb" placeholder="Descipción" required></textarea>

                            <label for="imgSerieWeb">Imagen</label><br>
                            <input type="file" name="imgSerieWeb" id="imgSerieWeb" accept="image/,.jpg,.png,.jpeg" required>
                            <p id="actuImg"></p>

                            <label for="videoSerie">Video</label><br>
                            <input type="text" class="form-control" name="videoSerie" id="videoSerie" placeholder="Iframe" required>

                            <label for="clasificaSerieWeb">Clasificación</label>
                            <select type="date" class="form-control" name="clasificaSerieWeb" id="clasificaSerieWeb" required>
                                <option>Seleccionar</option>
                                <option value="0">Serie</option>
                                <option value="1">Adicionales</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoSer" value="addSerieWeb">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-SerieWeb" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/serieweb.js"></script>