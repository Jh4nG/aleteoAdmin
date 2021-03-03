<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Construccion.modalAdd()">Añadir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableConstruc" width="100%">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Nombre </td>
                                    <td>Imagen </td>
                                    <td>Estado </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="add-modal-construccion" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Construcción</h4>
            </div>
            <form id="form-Constr" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="nomConstr">Nombre</label>
                            <input class="form-control" type="text" id="nomConstr" name="nomConstr" placeholder="Nombre" required>

                            <label for="imgConstr">Imagen</label>
                            <input type="file" name="imgConstr" id="imgConstr" accept="image/,.jpg,.png,.jpeg">
                            <p id="actuImg"></p>

                            <label for="selConstr">Estado</label>
                            <select class="form-control" id="selConstr" name="selConstr" required>
                                <option value="">Seleccionar...</option>
                                <option value="1">Activo</option>
                                <option value="0">En construcción</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoConstr" value="addConstr">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-Constr" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="js/construccion.js"></script>