<?php

require_once('gui.php');
require_once('ln/ln_motorcycle.php');
require_once('ln/ln_workshop.php');

class ui_historial extends Gui
{
  var $ln;
  var $id_usuario;
  var $ln_workshop;
  var $placa;

  function __construct($config)
  {

    parent::__construct($config);
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


    <div class="container">
      <div class="row">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3 contenido_modulos">
          <div class="card shadow">
            <div class="card-header bg-primary text-white">
              <div class="clearfix">
                <div class="float-left">
                  <h5 class="card-title">Lista de Reparaciones</h5>
                    </div>
                    
                  </div>
                </div>
                <div class=" card-body table-responsive">
                    <table class="table table-bordered" id="example">
                      <thead class="thead-dark text-center text-white">
                        <tr>
                          <th>Fecha Entrada</th>
                          <th>Moto</th>
                          <th>Placa</th>
                          <th>Precio</th>
                          <th>Estado</th>
                          <th>Ver</th>
                          <th>Descargar</th>
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
                            <?php
                            if ($repair['estado'] == 'Espera') { ?>
                              <td class="text-center text-white bg-warning">Espera</td>
                            <?php
                            } else { ?>
                              <td class="text-center text-white bg-success">Finalizado</td>
                            <?php
                            }
                            ?>

                            <td><a href="workshop.php?action=update&id=<?= $repair['id'] ?>" class="btn btn-info"><i class="far fa-eye"></i></a></td>
                            <td><a href="pdf.php?data=info_reparacion&id=<?= $repair['id'] ?>" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>
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
        </div>




    <?php
  }
}
