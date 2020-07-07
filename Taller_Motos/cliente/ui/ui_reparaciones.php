<?php

require_once('gui_login.php');
require_once('ln/ln_motorcycle.php');
require_once('ln/ln_workshop.php');

class UI_Reparaciones extends Gui_login
{
  var $ln;
  var $id_usuario;
  var $ln_workshop;
  var $placa;

  function __construct()
  {
    if (isset($_COOKIE['cliente'])) {
      $data = json_decode($_COOKIE['cliente'], true);
      $this->id_usuario = $data['id_cliente'];
    }

    if (isset($_GET['moto'])) {
      $this->placa = $_GET['moto'];
    }
    $this->ln = new ln_motorcycle();
    $this->ln_workshop = new ln_workshop();
  }

  function action_controller()
  {
    $this->ln->action_controller();
  }
  function action_controller_workshop()
  {
    $this->ln_workshop->action_controller();
  }


  function get_content()
  {

?>
    <main id="main">
      <!-- ======= Motos Section ======= -->
      <section id="services" class="services">
        <div class="container">

          <div class="section-title">
            <h2>Reparaciones</h2>
          </div>

          <div class="container row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3 contenido_modulos">
              <div class="card shadow">
                <div class="card-header bg-primary text-white">
                  <div class="clearfix">
                    <div class="float-left">
                      <h5 class="card-title"">Lista de Reparaciones</h5>
                    </div>
                    <div class=" float-right">
                        <div class="btn-group" role="group" aria-label="First group">

                          <div class="btn-group ml-2" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Exportar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <a class="dropdown-item" href="#">PDF</a>
                              <a class="dropdown-item" href="#">EXCEL</a>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-bordered" id="example">
                    <thead class="thead-dark text-center text-white">
                      <tr>
                        <th>Fecha Entrada</th>
                        <th>Moto</th>
                        <th>Placa</th>
                        <th>Precio</th>
                        <th>Ver</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      foreach ($this->ln_workshop->get_reparacion_moto($this->placa) as $repair) { ?>
                        <tr>
                          <td><?= $repair['fecha'] ?></td>
                          <td><?= $repair['moto'] ?></td>
                          <td><?= $repair['placa'] ?></td>
                          <td>₡ <?= number_format($repair['monto']) ?></td>
                          <td><a href="index.php?pagina=detalle_reparacion&reparacion=<?= $repair['id'] ?>" class="btn btn-info"><i class="far fa-eye"></i></a></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </div>

      </section><!-- End Motos Section -->
    </main>


<?php
  }
}
