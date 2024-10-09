<!-- Modal -->
<div class="modal fade" id="modalFromHilos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegistro">
        <h5 class="modal-title" id="tituloModal">Registro de nuevo Hilo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formHilo" name="formHilo">
              <input type="hidden" id="idHilos" name="idHilos" value="">
              <p class="text-danger">Campos obligatorios *</p>
                <div class="form-group">
                    <label class="control-label" for="listColorHilos">Color</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listColorHilos" name="listColorHilos" required>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="txtCódigoHilos">Código de Color</label><span class="text-danger"> *</span>
                  <input class="form-control" id="txtCódigoHilos" name="txtCódigoHilos" type="text" placeholder="Ingrese el código de hilo" required="">
                </div>
                <div class="form-group">
                    <label class="control-label" for="listTipoHilos">Tipo de hilo</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listTipoHilos" name="listTipoHilos" required>
                      
                    </select>
                </div>
                
                <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control valid validText" id="txtDescripciónHilos" name="txtDescripciónHilos" rows="2" placeholder="Opcional"></textarea>
                </div>
                <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-outline-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnTexto">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-outline-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

