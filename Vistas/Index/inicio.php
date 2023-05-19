<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Inicio.modalAdd()">Añadir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-1">  
                        <div class="dropdown mt-sm-2">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <span class="btn-label">
                                    <i class="fa fa-cog"></i>
                                </span>
                            </button>
                            
                            <ul class="dropdown-menu list-buttoms">
                                <li><label class="checkbox small"><input type="checkbox" value="0" id="campos" name="iCheck" />&nbsp; Id </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="1" id="campos" name="iCheck" checked />&nbsp; Nombre </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="2" id="campos" name="iCheck" checked />&nbsp; Título </label></li> 
                                <li><label class="checkbox small"><input type="checkbox" value="3" id="campos" name="iCheck" checked />&nbsp; Descripción </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="4" id="campos" name="iCheck" checked />&nbsp; Imagen </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="5" id="campos" name="iCheck" checked />&nbsp; Vídeo </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="6" id="campos" name="iCheck" checked />&nbsp; Link Redireccionamiento </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="7" id="campos" name="iCheck" checked />&nbsp; Ícono </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="8" id="campos" name="iCheck" checked />&nbsp; Posición </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="9" id="campos" name="iCheck" checked />&nbsp; Estado </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="10" id="campos" name="iCheck" checked />&nbsp; Categoría </label></li>
                                <li><label class="checkbox small"><input type="checkbox" value="11" id="campos" name="iCheck" checked />&nbsp; Fecha Creación </label></li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableIndex" width="100%">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Id </td>
                                    <td>Nombre </td>
                                    <td>Título </td>
                                    <td>Descripción </td>
                                    <td>Imagen </td>
                                    <td>Vídeo </td>
                                    <td>Link Redireccionamiento </td>
                                    <td>Ícono </td>
                                    <td>Posición </td>
                                    <td>Estado </td>
                                    <td>Categoría </td>
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


<div class="modal fade " id="add-modal-seccion" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Sección</h4>
            </div>
            <form id="form-Seccion" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="nomSeccion">Nombre</label>
                            <input class="form-control" type="text" id="nomSeccion" name="nomSeccion" placeholder="Nombre" required>

                            <label for="titSeccion">Título</label>
                            <input class="form-control" id="titSeccion" name="titSeccion" placeholder="Título" required>
                            
                            <label for="descSeccion">Descripción</label>
                            <textarea class="form-control" id="descSeccion" name="descSeccion" placeholder="Descripción" required></textarea>

                            <label for="imgSeccion">Imagen</label>
                            <input type="file" name="imgSeccion" id="imgSeccion" accept="image/,.jpg,.png,.jpeg">
                            <p id="actuImg"></p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="videoSeccion">Vídeo (Iframe Yputube)</label>
                            <textarea class="form-control" id="videoSeccion" name="videoSeccion" placeholder="Descripción"></textarea>

                            <label for="linkSeccion">Link</label>
                            <input class="form-control" id="linkSeccion" name="linkSeccion" placeholder="Link">

                            <label for="iconSeccion">Ícono <a href="https://www.w3schools.com/icons/fontawesome_icons_intro.asp" target="_blank">Link</a></label>
                            <input class="form-control" id="iconSeccion" name="iconSeccion" placeholder="ícono">

                            <label for="selSeccion">Estado</label>
                            <select class="form-control" id="selSeccion" name="selSeccion" required>
                                <option value="">Seleccionar...</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="posSeccion">Posición en sección</label>
                            <input class="form-control" id="posSeccion" name="posSeccion" placeholder="#">

                            <label for="catSeccion">Categoría</label>
                            <select class="form-control" id="catSeccion" name="catSeccion" required></select>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoSec" value="addSeccion">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-Seccion" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="js/Index/inicio.js"></script>