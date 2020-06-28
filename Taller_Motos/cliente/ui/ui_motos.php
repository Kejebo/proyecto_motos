<?php

require_once('gui_login.php');
require_once('ln/ln_motorcycle.php');

class UI_Motos extends Gui_login
{
  var $ln;
  var $id_usuario;

  function __construct()
  {
    if (isset($_COOKIE['cliente'])) {
      $data = json_decode($_COOKIE['cliente'], true);
      $this->id_usuario = $data['id_cliente'];
    }
      $this->ln = new ln_motorcycle();
  }

  function action_controller()
    {
        $this->ln->action_controller();
    }

    function get_content(){
?>

<main id="main">
<!-- ======= Motos Section ======= -->
<section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Motos</h2>
          
        </div>
        <section class="container py-3" style="color: #04ADBF;">
            <div class="row">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3">
                    <div class="card shadow ">
                        <div class="card-header">
                          <div class="clearfix">
                            <div class="float-left">
                              <h5 style="color:black">Lista de Motos</h5>
                            </div>
                            <div class="float-right">
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
                                        <th>Moto</th>
                                        <th>Placa</th>
                                        <th>Transmision</th>
                                        <th>Kilometraje</th>
                                        <th>Ver</th>
                                        <th>Eliminar</th>
                                        <th>Editar</th>

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach ($this->ln->get_motos_client($this->id_usuario) as $motos) { ?>
                                        <tr>
                                            <td><?= $motos['moto'] ?></td>
                                            <td><?= $motos['placa'] ?></td>
                                            <td><?= $motos['transmision'] ?></td>
                                            <td><?= $motos['kilometraje'] ?></td>
                                            <td><a href="<?= $motos['id']; ?>" class="btn btn-info"><i class="far fa-eye"></i></a></td>
                                            <td><a href="motorcycle.php?action=delete&id=<?= $motos['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            <td><a href="manage_motorcycle.php?action=update_moto&id=<?= $motos['id']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        
      </div>
    </section><!-- End Motos Section -->
    </main>

     
     <?php
    }
}