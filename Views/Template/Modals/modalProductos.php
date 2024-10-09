<!-- Modal -->
<div class="modal fade" id="modalFromProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegistro">
        <h5 class="modal-title" id="tituloModal">Registro de nuevo Hilo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formProducto" name="formProducto">
              <input type="hidden" id="idProductos" name="idProductos" value="">
              <p class="text-danger">Campos obligatorios. *</p>
                <div class="form-group">
                    <label class="control-label" for="listDiseñoProductos">Diseños</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listDiseñoProductos" name="listDiseñoProductos" required>
                      
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="listColorProductos">Color</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listColorProductos" name="listColorProductos" required>
                      
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="txtPrecioProductos">Precio</label><span class="text-danger"> *</span>
                  <input class="form-control" id="txtPrecioProductos" name="txtPrecioProductos" type="text" placeholder="Ingrese el precio" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="intCantidadProductos">Cantidad</label><span class="text-danger"> *</span>
                  <input class="form-control valid validNumber" id="intCantidadProductos" name="intCantidadProductos" type="int" placeholder="Ingrese la cantidad " required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control valid validText" id="txtDescripciónProductos" name="txtDescripciónProductos" rows="2" placeholder="Opcional"></textarea>
                </div>
                <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-outline-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnTexto">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-outline-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

