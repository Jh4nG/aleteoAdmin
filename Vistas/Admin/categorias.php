<div class="content-body"><!-- stats -->

    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Categoria.modalAdd()">Añadir</button>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableCategoria" width="100%">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Id </td>
                                    <td>Nombre </td>
                                    <td>Descripción </td>
                                    <td>Cantidad </td>
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

<div class="modal fade " id="add-modal-categoria" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 id="modal-title-sm" class="modal-title">Categoría</h4>
        </div>
        <form id="form-categoria" enctype="multipart/form-data">
            <div id="modal-body-sm" class="modal-body">
                <div class="form-group">
                    <label for="nomCategoria">Nombre</label>
                    <input class="form-control" type="text" id="nomCategoria" name="nomCategoria" placeholder="Nombre" required>

                    <label for="descCategoria">Descripción</label>
                    <textarea class="form-control" id="descCategoria" name="descCategoria" placeholder="Descripción" required></textarea>
                    
                    <label for="cantCategoria">Cantidad Registros</label>
                    <input class="form-control" type="number" id="cantCategoria" name="cantCategoria" placeholder="Cantidad" required>
                </div>
                <input type="hidden" name="metodo" id="metodoCat" value="addCategoria">
            </div>
            <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                <button id="btn-add-categoria" type="submit" class="btn btn-success">Agregar</button>
                <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<script src="js/categoria.js"></script>
