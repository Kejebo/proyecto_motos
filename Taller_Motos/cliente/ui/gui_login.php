<?php

require_once('ln/ln_security.php');


class Gui_login
{

  var $ln_security;
  var $estado;
  var $nombre_cliente;


  function __construct($config)
  {

    $this->ln_security = new ln_security();

    if ($config) {
      $this->config = $config;
    }

    $this->ln_security->check_tipo_login_cliente();

    if (isset($_COOKIE['cliente'])) {
      $data = json_decode($_COOKIE['cliente'], true);
      $this->nombre_cliente = $data['nombre_cliente'];
    }
  }
  function get_header()
  {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta name="google" content="notranslate">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mighty motors</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
      <link rel="stylesheet" href="assets/css/styles_login.css" <script src="https://kit.fontawesome.com/b99e675b6e.js">
      <link rel="stylesheet" href="assets/css/styleCliente.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="../cliente/assets/css/jquery.dataTables.min.css">
      <script src="../cliente/assets/js/jquery.dataTables.min.js"></script>
      <script src="../cliente/assets/js/datatables.js"></script>
      <script src="assets/js/reports.js"></script>
    </head>


    </script>


  <?php
  }
  function get_menu()

  {
  ?>

    <body>

      <header id="header">

        <div class="d-flex flex-column">

          <div class="profile">
            <img src="assets/img/usuario_icon.png" alt="" class="img-fluid rounded-circle">
            <h1 class="text-light"><a href="index.html"><?= $this->nombre_cliente ?></a></h1>
            <div class="social-links mt-3 text-center">
              <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
              <!--<a href="#" class="instagram"><i class="fab fa-instagram"></i></a>-->
              <a href="https://api.whatsapp.com/send?phone=0050688303820&text=Hola, Soy <?= $this->nombre_cliente ?>" target="_blank" class="google-plus"><i class="fab fa-whatsapp"></i></i></a>
              <!--<a href="#" class="linkedin"><i class="fab fa-youtube"></i></a>-->
              <span>|</span>
              <a href="#" title="Salir">
                <form action="security.php?action=logout" method="post">
                  <button id="boton_cerrar_sesion"><i class="fas fa-sign-out-alt"></i></button>
                </form>
              </a>

            </div>
          </div>

          <nav class="nav-menu">
            <ul>
              <li><a href="index.php?pagina=motos"><i class="fas fa-motorcycle"></i> <span>Mis Motos</span></a></li>
              <!--<li><a href="#about"><i class="fas fa-chart-bar"></i> <span>Reportes</span></a></li>-->
              <li><a href="index.php?pagina=contacto"><i class="fas fa-address-book"></i><span>Contacto</span></a></li>
            </ul>
          </nav><!-- .nav-menu -->
          <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

        </div>


      </header><!-- End Header -->

    <?php

  }

  function get_footer()
  {
    ?>

      <script src="assets/js/main_login.js"></script>
      <link rel="stylesheet" href="jquery.dataTables.min.css">
      <script src="assets/js/reports.js"></script>
      <script src="assets/js/datatable_motos.js"></script>
      <script src="assets/js/datatable_buttons.js"></script>
      <script src="assets/js/datatable_buttons_boot.js"></script>
      <script src="assets/js/jszip.min.js"></script>
      <script src="assets/js/pdfmake.min.js"></script>
      <script src="assets/js/vfs_fonts.js"></script>
      <script src="assets/js/buttons.html5.min.js"></script>
      <script src="assets/js/buttons.print.min.js"></script>
      <script src="assets/js/buttons.colVis.min.js"></script>

    </body>

    </html>
<?php
  }
}

?>