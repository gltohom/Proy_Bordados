<?php 
  headerAdmin($data);
  getModal('modalProductos', $data);

?>
    <div id="contentAjax"></div>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>
            <i class="fas fa-user-tag"></i> <?= $data['page_title']?>
            <button class="btn btn-Nuevo" type="button" onclick="openModal();"><i class="fas fa-plus-square"></i>  Nuevo Producto</button>
          </h1>
          <p>Bienvenidos a la vista de Productos</p>
        </div>
      </div>



      <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-dark" id="tableProductos">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Color</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Aqui se generaran los datos desde la base de dtaso-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
      </div>

    </main>
<?php footerAdmin($data); ?>