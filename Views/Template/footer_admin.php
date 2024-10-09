    <!--constante para regresar a la raiz del proyecto-->
    <script> const base_url = "<?= base_url();?>";</script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/functions_admin.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <!--Script para la alerta de datos imcompletos-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>

    <!-- Data table plugin-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/bootstrap-select.min.js"></script>

    <!-- Plugins para exportar en archivos, PDF,EXCEL...-->
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    
    <!--para validacion de campos-->
    <script type="text/javascript" src="<?= media();?>/js/functions_admin.js"></script>

    <!--requiriendo modals VALIDACION PARA ESPECIFICAR QUE ARCHIVO TRABAJARÁ-->
    <?php if($data['page_name'] == "rol_usuario" ) { ?>
      <script src="<?= media(); ?>/js/functions_roles.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "usuarios" ) { ?>
      <script src="<?= media(); ?>/js/functions_usuarios.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "personal" ) { ?>
      <script src="<?= media(); ?>/js/functions_personal.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "telas" ) { ?>
      <script src="<?= media(); ?>/js/functions_telas.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "hilos" ) { ?>
      <script src="<?= media(); ?>/js/functions_hilos.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "colores" ) { ?>
      <script src="<?= media(); ?>/js/functions_colores.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "diseños" ) { ?>
      <script src="<?= media(); ?>/js/functions_diseños.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "tipoHilos" ) { ?>
      <script src="<?= media(); ?>/js/functions_tipoHilos.js"></script>
    <?php }    ?>
    <?php if($data['page_name'] == "productos" ) { ?>
      <script src="<?= media(); ?>/js/functions_productos.js"></script>
    <?php }    ?>
    

  </body>
</html>