<!-- Modal -->
<div class="modal fade" id="modalFromRoles" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegistro">
        <h5 class="modal-title" id="tituloModal">Registro de nuevo rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formRol" name="formRol">
              <input type="hidden" id="idRol" name="idRol" value="">
              <p class="text-danger">Campos obligatorios *</p>
                <div class="form-group">
                  <label class="control-label">Nombre del Rol</label><span class="text-danger"> *</span>
                  <input class="form-control valid validText" id="txtNombre" name="txtNombre" type="text" placeholder="Ingrese el nombre el rol" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción</label><span class="text-danger"> *</span>
                  <textarea class="form-control valid validText" id="txtDescripción" name="txtDescripción" rows="2" placeholder="Ingrese una descripción del rol" required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listEstado" name="listEstado" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                </div>
                <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-outline-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnTexto">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-outline-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

