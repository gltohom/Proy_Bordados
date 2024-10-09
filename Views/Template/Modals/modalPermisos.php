<!--Modal Permisos-->
<div class="modal fade modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
          <h5 class="modal-title h4">Roles de usuarios, Permisos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
      </div>
        <?php 
            //dep($data);
         ?>
        <div class ="modal-body">
          <div class="col-md-12">
            <div class="tile">
              <form action="" id="formPermisos" name="formPermisos">
               <input type="hidden" id="idRol" name="idRol" value="<?= $data['idRol']; ?>" required="">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Vistas</th>
                        <th>Insertar</th>
                        <th>Consultar</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $no=1;
                          $modulos = $data['modulo'];
                          for ($i=0; $i < count($modulos); $i++) 
                          { 

                                    $permisos = $modulos[$i]['permisos'];
                                    $insertarCheck = $permisos['insertar'] == 1 ? " checked " : "";
                                    $consultarCheck = $permisos['consultar'] == 1 ? " checked " : "";
                                    $actualizarCheck = $permisos['actualizar'] == 1 ? " checked " : "";
                                    $eliminarCheck = $permisos['eliminar'] == 1 ? " checked " : "";

                                    $idmod = $modulos[$i]['idModulo'];
                        ?>
                      <tr>
                        <td>
                          <?= $no;  ?>
                          <input type="hidden" name="modulo[<?= $i; ?>][idModulo]" value="<?= $idmod ?>" required >
                        </td>
                        <td>
                          <?= $modulos[$i]['título'];  ?>
                        </td>
                        <td>
                          <div class="toggle lg">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][insertar]" <?= $insertarCheck ?> ><span class="button-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle lg">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][consultar]" <?= $consultarCheck ?> ><span class="button-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle lg">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][actualizar]" <?= $actualizarCheck ?> ><span class="button-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle lg">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][eliminar]" <?= $eliminarCheck ?> ><span class="button-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                      </tr>
                      <?php 
                                $no++;
                      }
                            ?>
                    </tbody>
                  </table>
                </div>
                <div class="text-center">
                  <button class="btn btn-outline-success" type="submit">Guardar</button>
                  <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>