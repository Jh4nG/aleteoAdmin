<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Perfiles.modalAdd()">Añadir</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tablePerfiles" width="100%">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Id </td>
                                <td>Nombre </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="add-modal-Perfiles" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Crear Perfíl</h4>
            </div>
            <form id="form-Perfiles" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label for="nombrePerfiles">Nombres</label>
                            <input class="form-control" type="text" id="nombrePerfiles" name="nombrePerfiles" placeholder="Nombres" required>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoPerfiles" value="addPerfiles">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-Perfiles" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/perfiles.js"></script>