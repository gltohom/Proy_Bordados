<!-- Modal -->
<div class="modal fade" id="modalFromUsuarios" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegistro">
        <h5 class="modal-title" id="tituloModal">Registro de nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formUsuario" name="formUsuario">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
               <p class="text-danger">Campos obligatorios *</p>
                <div class="form-group">
                  <label class="control-label" for="txtUsuario">Ingrese su usuario</label><span class="text-danger"> *</span>
                  <input class="form-control valid validText" id="txtUsuario" name="txtUsuario" type="text" placeholder="Ingrese su usuario" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="txtContraseña">Ingrese su contraseña</label><span class="text-danger"> *</span>
                  <input class="form-control" id="txtContraseña" name="txtContraseña" type="password" placeholder="Ingrese su contraseña">
                </div>
                <div class="form-group">
                  <label class="control-label" for="listEstado">Estado</label><span class="text-danger"> *</span>
                    <select class="form-control" id="listEstado" name="listEstado" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="listIdRol">Rol</label><span class="text-danger"> *</span>
                    <select class="form-control" data-live-search="true" id="listIdRol" name="listIdRol" required>
                      
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="listIdPersonal">Personal Asociado</label><span class="text-danger"> *</span>
                    <select class="form-control" data-live-search="true" id="listIdPersonal" name="listIdPersonal" required>
                      
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


<!--  Modal para cargar los datos del usuario cuando se desee visualizarlos -->

<!-- Modal -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header header-VerUsuario">
        <h5 class="modal-title" id="tituloModal">Datos de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Nombre</td>
              <td id="tablaNombre"></td>
            </tr>
            <tr>
              <td>Apellido</td>
              <td id="tablaApellido"></td>
            </tr>
            <tr>
              <td>Usuario</td>
              <td id="tablaUsuario"></td>
            </tr>
            <tr>
              <td>Dirección</td>
              <td id="tablaDirección"></td>
            </tr>
            <tr>
              <td>Teléfono</td>
              <td id="tablaTeléfono"></td>
            </tr>
            <tr>
              <td>Rol</td>
              <td id="tablaRol"></td>
            </tr>
            <tr>
              <td>Estado</td>
              <td id="tablaEstado"></td>
            </tr>
            <tr>
              <td>Fecha de registro</td>
              <td id="tablaFecha"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

