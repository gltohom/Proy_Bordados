<?php headerAdmin($data); 
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-home"></i> <?= $data['page_title']?></h1>
          <p>Bienvenidos a la vista Principal BORDADOS</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Vista Principal</div>
            <br><br>
            
            <div class="text-center">
              <img src="<?= media(); ?>/images/IMG_20210317_164057.jpg" class="rounded" alt="Imagen de máquinas">
            </div>
            
            <br>

            <div class="col-md-6 container" >
              <a href="<?= media(); ?>/pdf/Manual_de_Usuario.pdf" download="Manual.pdf">
                <button id="bntManual" class="btn btn-info btn-lg btn-block" type="button">Descargar Manual de usuario</button></a>
            </div>

          </div>
        </div>
      </div>
    </main>

    
<?php footerAdmin($data); ?>