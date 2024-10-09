
<!-- Modal -->
<div class="modal fade" id="modalFromTipoHilos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegistro">
        <h5 class="modal-title" id="tituloModal">Registro de nuevos tipos de hilos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--FOrumulario para agregar diseño-->
      <div class="modal-body">
            <form id="formTipoHilo" name="formTipoHilo">
              <input type="hidden" id="idTipoHilo" name="idTipoHilo" value="">
               <p class="text-danger">Campos obligatorios *</p>
                <div class="form-group">
                  <label for="txtNombreTipoHilos">Tipo de Hilo</label><span class="text-danger"> *</span>
                  <input class="form-control valid validText" id="txtNombreTipoHilos" name="txtNombreTipoHilos" type="text" placeholder="Ingrese el tipo" required="">
                </div>
                <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-outline-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnTexto">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-outline-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>


