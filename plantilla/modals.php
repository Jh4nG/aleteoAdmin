<div class="modal fade modal-md" id="modal-medium" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modal-title-md" class="modal-title ">mediano</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div id="modal-body-md" class="modal-body">
         
        </div>
        <div class="modal-footer" id="btn-md">

        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade " id="modal-large" role="dialog">
    <div class="modal-dialog modal-lg" id="modal-large-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modal-title-lg" class="modal-title">Grande</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div id="modal-body-lg" class="modal-body">
          
        </div>
        <div class="modal-footer" id="btn-lg">

        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade " id="modal-small" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modal-title-sm" class="modal-title">pequeño</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div id="modal-body-sm" class="modal-body">

        </div>
        <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
          <button id="btn-sm" type="button" class="btn btn-default" onclick="refreshTable();" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade " id="modal-large-2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modal-title-lg-2" class="modal-title">Grande</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div id="modal-body-lg-2" class="modal-body">
          
        </div>
        <div class="modal-footer" id="btn-lg-2">

        </div>
      </div>
      
    </div>
  </div>

  <div class="modal" id="modalAnadirAudio" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Añadir Nuevo Audio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="formAnadirAudio" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="nameAudio" name="nameAudio" placeholder="Nombre" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <textarea class="form-control" name="descripcionAudio" id="descripcionAudio" placeholder="Descripción" required></textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label"> Categoría Podcast</label>
                          <select name="catPodcast" id="catPodcast" class="form-control"></select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <label class="control-label"><i class="fas fa-file-audio"></i> Cargar Audio</label>
                  </div>
              </div>  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input  id="audio" name="audio" type="file" accept="audio/*" required>
                      </div>
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Cargar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="modal" id="modalEditarAudio" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Podcast</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="formEditarAudio" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="nameEditAudio" name="nameEditAudio" placeholder="Nombre" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <textarea class="form-control" name="descripcionEditAudio" id="descripcionEditAudio" placeholder="Descripción" required></textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label"> Categoría Podcast</label>
                          <select name="catEditPodcast" id="catEditPodcast" class="form-control"></select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <label class="control-label"><i class="fas fa-file-audio"></i> Cargar Audio si desea reemplazar el existente</label>
                  </div>
              </div>  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input  id="audioEdit" name="audioEdit" type="file" accept="audio/*">
                      </div>
                  </div>
              </div>
              <input type="hidden" id="idPodcast" name="idPodcast">
              <input type="hidden" id="linkBorrar" name="linkBorrar">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Editar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalAnadirOrganizaciones" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Añadir Nueva Organización</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="formAnadirOrg" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="nameOrg" name="nameOrg" placeholder="Título" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <textarea class="form-control" name="descripcionOrg" id="descripcionOrg" placeholder="Descripción" required></textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="urlOrg" name="urlOrg" placeholder="URL" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="orgActivo" name="orgActivo" style="margin-left: 0 !important;" checked>
                      <label class="form-check-label" for="orgActivo">Activo</label>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label"> Tipo</label>
                          <select name="tipoOrg" id="tipoOrg" class="form-control">
                            <option value="organizaciones">Organizaciones</option>
                            <option value="aliados">Aliados</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <label class="control-label"><i class="fas fa-file-image"></i> Cargar Imagen</label>
                  </div>
              </div>  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input  id="imagenOrg" name="imagenOrg" type="file" accept="image/png, .jpeg, .jpg" required>
                      </div>
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Cargar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalEditarOrg" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Organización</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="formEditarOrg" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="nameEditOrg" name="nameEditOrg" placeholder="Título" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <textarea class="form-control" name="descripcionEditOrg" id="descripcionEditOrg" placeholder="Descripción" required></textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="urlEditOrg" name="urlEditOrg" placeholder="URL" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="orgActivoEdit" name="orgActivoEdit" style="margin-left: 0 !important;" checked>
                      <label class="form-check-label" for="orgActivoEdit">Activo</label>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label"> Tipo</label>
                          <select name="tipoOrgEdit" id="tipoOrgEdit" class="form-control">
                            <option value="organizaciones">Organizaciones</option>
                            <option value="aliados">Aliados</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-8">
                      <label class="control-label"><i class="fas fa-file-image"></i> Cargar Imagen si desea reemplazar la existente</label>
                  </div>
              </div>  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input  id="imagenOrgEdit" name="imagenOrgEdit" type="file" accept="image/png, .jpeg, .jpg">
                      </div>
                  </div>
              </div>
              <input type="hidden" id="idOrg" name="idOrg">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Editar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalAnadirApoyanos" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Añadir Nuevos Items Apoyanos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="formAnadirApoyanos" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="tituloApoyanos" name="tituloApoyanos" placeholder="Título" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="urlApoyanos" name="urlApoyanos" placeholder="Url Vídeo" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <label class="control-label"><i class="fas fa-file-image"></i> Cargar Imagen</label>
                  </div>
              </div>  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input  id="imagenApoyanos" name="imagenApoyanos" type="file" accept="image/png, .jpeg, .jpg" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 " id="divEditorApoyanos">
                  <div id="editorApoyanos"></div>
					      </div>
					    </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Cargar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalEditarApoyanos" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Items Apoyanos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="formEditarApoyanos" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="tituloApoyanosEdit" name="tituloApoyanosEdit" placeholder="Título" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <input type="text" class="form-control" id="urlApoyanosEdit" name="urlApoyanosEdit" placeholder="Url Vídeo" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-8">
                      <label class="control-label"><i class="fas fa-file-image"></i>Cargar Imagen si desea reemplazar la existente</label>
                  </div>
              </div>  
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input  id="imagenApoyanosEdit" name="imagenApoyanosEdit" type="file" accept="image/png, .jpeg, .jpg">
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 " id="divEditorApoyanosEdit">
                  <div id="editorApoyanosEdit"></div>
					      </div>
					    </div>
              <input type="hidden" id="idApoyanos" name="idApoyanos">
              <input type="hidden" id="imagenApoyanosBorrar" name="imagenApoyanosBorrar">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Editar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalPublicidad" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title">Enviar Publicidad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label"> Tipo Publicidad</label>
                <select name="publicidadModulo" id="publicidadModulo" class="form-control">
                  <option value="9999999" selected>Seleccione una opción</option>
                  <option value="podcast">Podcast</option>
                  <option value="serie_web">Serie Web</option>
                  <option value="periodico">Periódico</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label"> Item</label>
                <select name="publicidadItem" id="publicidadItem" class="form-control"></select>
              </div>
            </div>
          </div>
          <hr>

          <div id="publicidadPrevisualizar" class="row" style="text-align: center;"></div>
         
        </div>
        <div class="modal-footer">
          <button type="button" onclick="_Publicidad.sendPublicidad()" class="btn btn-success">Enviar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalPublicidadVerEmails" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title">Emails Enviados</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-xs-12">
              <div class="card">
                <div class="card-body">
                  <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tableVerEmails" width="100%">
                    <thead>
                      <tr>
                        <td>Nombres </td>
                        <td>Email </td>
                        <td>Telefono </td>
                        <td>Fecha Suscripción </td>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>