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

