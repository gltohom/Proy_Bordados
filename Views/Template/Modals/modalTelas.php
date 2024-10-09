<!-- Modal -->
<div class="modal fade" id="modalFromTelas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegistro">
        <h5 class="modal-title" id="tituloModal">Registro de nueva tela</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formTela" name="formTela">
              <input type="hidden" id="idTelas" name="idTelas" value="">
              <p class="text-danger">Campos obligatorios *</p>
                <div class="form-group">
                    <label class="control-label" for="listColorTelas">Color</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listColorTelas" name="lisColorTelas" required>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="intCantidadTelas">Cantidad</label><span class="text-danger"> *</span>
                  <input class="form-control valid validNumber" id="intCantidadTelas" name="intCantidadTelas" type="int" placeholder="Ingrese la cantidad de telas" required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control valid validText" id="txtDescripciónTelas" name="txtDescripciónTelas" rows="2" placeholder="Opcional"></textarea>
                </div>
                
                <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-outline-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnTexto">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-outline-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

