<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Futuro.modalAdd()">Añadir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableFuturo" width="100%">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Id </td>
                                    <td>Título </td>
                                    <td>Descripción </td>
                                    <td>Imagen </td>
                                    <td>Fecha Texto </td>
                                    <td>Fecha Creación </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="add-modal-Futuro" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Sección</h4>
            </div>
            <form id="form-Futuro" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="titFuturo">Título</label>
                            <input class="form-control" id="titFuturo" name="titFuturo" placeholder="Título" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imgFuturo">Imagen</label><br>
                            <input type="file" name="imgFuturo" id="imgFuturo" accept="image/,.jpg,.png,.jpeg">
                            <p id="actuImg"></p>
                        </div>
                        <div class="col-md-12 col-sm-12 " id="divEditor">
                            <div id="editor"></div>
					    </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoFut" value="addFuturo">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-Futuro" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="js/futuro.js"></script>