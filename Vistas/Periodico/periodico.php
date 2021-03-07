<div class="content-body"><!-- stats -->
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-xs-1 form-group">
            <button type="button" class="btn btn-success" onclick="_Periodico.modalAdd()">Añadir</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive display table-sm table table-striped table-hover dataTable table-bordered table-condensed compact nowrap" id="tablePeriodico" width="100%">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Título </td>
                                <td>Contratítulo </td>
                                <td>Autor </td>
                                <td>Texto </td>
                                <td>Imagen </td>
                                <td>Pie imagen </td>
                                <td>Fecha público </td>
                                <td>Fecha publicación </td>
                                <td>Fecha creación </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="add-modal-periodico" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title-sm" class="modal-title">Periodico Digital</h4>
            </div>
            <form id="form-Periodico" enctype="multipart/form-data">
                <div id="modal-body-sm" class="modal-body">
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="titPeriodico">Titulo</label>
                            <input class="form-control" type="text" id="titPeriodico" name="titPeriodico" placeholder="Titulo" required>

                            <label for="contitPeriodico">Contra Título</label>
                            <input class="form-control" id="contitPeriodico" name="contitPeriodico" placeholder="Contra Título" required>
                            
                            <label for="autorPeriodico">Autor</label>
                            <input class="form-control" id="autorPeriodico" name="autorPeriodico" placeholder="Autor">

                            <label for="fecpublicoPeriodico">Fecha público</label>
                            <input type="date" class="form-control" name="fecpublicoPeriodico" id="fecpublicoPeriodico">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imgPeriodico">Imagen</label><br>
                            <input type="file" name="imgPeriodico" id="imgPeriodico" accept="image/,.jpg,.png,.jpeg">
                            <p id="actuImg"></p>

                            <label for="pieimgPeriodico">Pie Imagen</label><br>
                            <input type="file" name="pieimgPeriodico" id="pieimgPeriodico" accept="image/,.jpg,.png,.jpeg">
                            <p id="actupieImg"></p>

                            <label for="fecpublPeriodico">Fecha publicacion</label>
                            <input type="date" class="form-control" name="fecpublPeriodico" id="fecpublPeriodico">
                        </div>
                        <div class="col-md-12 col-sm-12 ">
                            <div id="editor">
                            </div>
                            <div id="references">
                            </div>
					    </div>
                    </div>
                    <input type="hidden" name="metodo" id="metodoPer" value="addPeriodico">
                </div>
                <div id="btn-footer-sm" class="modal-footer boton-footer" align="center">
                    <button id="btn-add-Periodico" type="submit" class="btn btn-success">Agregar</button>
                    <button id="btn-sm" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/ckeditor.js"></script>
<script src="js/es.js"></script>

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>

<script src="js/periodico.js"></script>