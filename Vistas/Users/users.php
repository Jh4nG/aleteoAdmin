<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Users.modalAdd()">Añadir</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableUsers" width="100%">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Nombres </td>
                                <td>Descipción</td>
                                <td>Foto</td>
                                <td>Rol</td>
                                <td>Fecha creación</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="add-modal-Users" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Crear Participante</h4>
            </div>
            <form id="form-Users" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label for="nombreUsers">Nombres</label>
                            <input class="form-control" type="text" id="nombreUsers" name="nombreUsers" placeholder="Nombres" required>

                            <label for="descUsers">Descipción</label>
                            <textarea class="form-control" id="descUsers" name="descUsers" placeholder="Descipción" required></textarea>

                            <label for="imgUsers">Foto</label><br>
                            <input type="file" name="imgUsers" id="imgUsers" accept="image/,.jpg,.png,.jpeg">
                            <p id="actuImg"></p>

                            <label for="videoUsers">Perfil</label><br>
                            <select type="date" class="form-control" name="perfilUsers" id="perfilUsers" required>
                                <option>Seleccionar</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoUsers" value="addUsers">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-Users" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/users.js"></script>