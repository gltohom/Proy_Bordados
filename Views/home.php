<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="shortcut icon" href="<?= media();?>/images/icono2.png">
    <title><?= $data['page_tag']?></title>
    
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/carousel.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/whatsapp.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- colocacion de imagen por medio de url --> </i>
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><i><img src="<?= media(); ?>/images/icono3.ico" alt="logotipo" style="width: 70px;"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>/login">Iniciar sesión</a>
            </li>
        </ul>
        <h1>Productos bordados Say</h1>
        </div>
      </div>
    </nav>
  </div>
  <br>
  <!-- Contenedor del carousel -->
  <div class="carousel">
    <div>
      <h5>Si necesitas más información, puedes contactarnos a través de nuestro whatsapp. Será un gusto atenderte 😉</h5>
    </div><br>
    

        <figure class="icon-cards mt-5 carousel">
            <div class="icon-cards__content">
                <div class="icon-cards__item d-flex align-items-center justify-content-center"><span class="h1"></span><img class="imgProductos" src="<?= media(); ?>/images/IMG_20210903_152322.jpg" alt="Imagen producto 1"></div>
                <div class="icon-cards__item d-flex align-items-center justify-content-center"><span class="h1"></span><img class="imgProductos" src="<?= media(); ?>/images/IMG_20211019_100727.jpg" alt="Imagen producto 2"></div>
                <div class="icon-cards__item d-flex align-items-center justify-content-center"><span class="h1"></span><img class="imgProductos" src="<?= media(); ?>/images/IMG_20211019_104654.jpg" alt="Imagen producto 3"></div>
            </div>
        </figure>
    </div>
    <br>
    <br>

    <h5 class="container center">Variedad de productos en diseños y colores. Puedes pulsar sobre la imágen.</h5>
    <!-- div para cards-->
    <div class="container">
      <div class="card-group">
        <div class="card">
          <a href="<?= media(); ?>/images/IMG_20211108_133504.jpg" data-toggle="lightbox" data-title="sample 3 - red">
          <img src="<?= media(); ?>/images/IMG_20211108_133504.jpg" class="card-img-top" alt="Imagenes de productos">
          </a>
          <div class="card-body">
            <h5 class="card-title">Blusa con diseño caballo</h5>
            <p class="card-text">Multicolor</p>
            <p class="card-text"><small class="text-muted">Agregado recientemente</small></p>
          </div>
        </div>
        <div class="card">
          <a href="<?= media(); ?>/images/20191209_130137.jpg" data-toggle="lightbox" data-title="sample 3 - red">
          <img src="<?= media(); ?>/images/20191209_130137.jpg" class="card-img-top img-fluid mb-2" alt="Imagenes de productos">
          </a>
          <div class="card-body">
            <h5 class="card-title">Diseño conchitas</h5>
            <p class="card-text">Multicolor</p>
            <p class="card-text"><small class="text-muted">Agregado recientemente</small></p>
          </div>
        </div>
        <div class="card">
        <a href="<?= media(); ?>/images/20191209_130141.jpg" data-toggle="lightbox" data-title="sample 3 - red">
          <img src="<?= media(); ?>/images/20191209_130141.jpg" class="card-img-top" alt="Imagenes de productos">
        </a>
          <div class="card-body">
            <h5 class="card-title">Diseño conchitas</h5>
            <p class="card-text">Multicolor</p>
            <p class="card-text"><small class="text-muted">Agregado recientemente</small></p>
          </div>
        </div>
      </div>
    </div>

    <br>
    <br>


    <!-- Otro carousel -->
      <div class="container">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?= media(); ?>/images/20191213_150519.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Diseño pavoreal multicolor</h5>
              <p>Tela en color blanco</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?= media(); ?>/images/20191213_132605.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Diseño pavoreal multicolor</h5>
              <p>Tela en color coral</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?= media(); ?>/images/20191213_124946.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Diseño pavoreal multicolor</h5>
            <p>Tela en colo azul marino</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  
  <br>
  <br>

  <!-- div para cards-->
  <h5 class="container center">Variedad de productos en diseños y colores. Puedes pulsar sobre la imágen.</h5>
  <div class="container">
      <div class="card-group">
        <div class="card">
          <a href="<?= media(); ?>/images/IMG_20210924_160548.jpg" data-toggle="lightbox" data-title="sample 3 - red">
          <img src="<?= media(); ?>/images/IMG_20210924_160548.jpg" class="card-img-top" alt="Imagenes de productos">
          </a>
          <div class="card-body">
            <h5 class="card-title">Diseños con hilos lana</h5>
            <p class="card-text">Color blanco</p>
            <p class="card-text"><small class="text-muted">Agregado recientemente</small></p>
          </div>
        </div>
        <div class="card">
          <a href="<?= media(); ?>/images/IMG_20211001_113508.jpg" data-toggle="lightbox" data-title="sample 3 - red">
          <img src="<?= media(); ?>/images/IMG_20211001_113508.jpg" class="card-img-top img-fluid mb-2" alt="Imagenes de productos">
          </a>
          <div class="card-body">
            <h5 class="card-title">Diseños con hilos lana</h5>
            <p class="card-text">Luto</p>
            <p class="card-text"><small class="text-muted">Agregado recientemente</small></p>
          </div>
        </div>
        <div class="card">
        <a href="<?= media(); ?>/images/IMG_20210913_152655.jpg" data-toggle="lightbox" data-title="sample 3 - red">
          <img src="<?= media(); ?>/images/IMG_20210913_152655.jpg" class="card-img-top" alt="Imagenes de productos">
        </a>
          <div class="card-body">
            <h5 class="card-title">Diseños con hilos lana</h5>
            <p class="card-text">Multicolor</p>
            <p class="card-text"><small class="text-muted">Agregado recientemente</small></p>
          </div>
        </div>
      </div>
    </div>
  

  <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?= media(); ?>/js/functions_carousel.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=+50233040665&text=Hola,%20ser%C3%ADan%20tan%20amables%20de%20brindarme%20mas%20informaci%C3%B3n%20acerca%20de%20un%20producto" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
  </body>
</html>