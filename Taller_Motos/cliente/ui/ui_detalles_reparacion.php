<?php
require_once('gui_login.php');
require_once('ln/ln_motorcycle.php');
require_once('ln/ln_workshop.php');

class ui_Detalles_Reparacion extends Gui_login
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
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 py-3">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <div class="clearfix">

                                <div class="float-left">
                                    <h5 class="ml-2">Ajustes Realizados</h5>

                                </div>
                                <div class="float-right">
                                    <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info mr-5">Agregar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body   table-responsive">
                            <table class="table table-inverse|reflow|striped|bordered|hover|sm text-center">
                                <thead class="thead-dark text-center text-white">
                                    <th>Trabajo</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody id="detail_work" style="background-color:white">
                                    <?php
                                    $j = 0;
                                    if (isset($_GET['id'])) {
                                        foreach ($this->ln_workshop->db->get_work_details($_GET['id']) as $works) {

                                    ?>
                                            <tr ids="<?= $j++ ?>">
                                                <input type="hidden" class="trabajos" name="trabajos[]" value='<?= json_encode($works); ?>'>
                                                <td><?= $works['nombre_trabajo'] ?></td>
                                                <td><span class="btn btn-danger" onclick="deletes(this,'work')">X</span></td>
                                            </tr>
                                    <?php  }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 py-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="clearfix">

                                <div class="float-left">
                                    <h5 class="ml-2">Materiales Utilizados</h5>

                                </div>
                                <div class="float-right">
                                    <button type="button" data-toggle="modal" data-target="#modal_material" class="btn btn-info mr-5">Agregar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body   table-responsive">
                            <table class="table table-bordered" width="100%">
                                <thead class="thead-dark text-center text-white">
                                    <th>Material</th>
                                    <th>Cant</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody id="detail_material" class="text-center bg-white">
                                    <?php
                                    $i = 0;
                                    if (isset($_GET['id'])) {
                                        foreach ($this->ln_workshop->db->get_repair_details($_GET['id']) as $material) {
                                    ?>
                                            <tr ids="<?= $i++ ?>">
                                                <input type="hidden" name="materiales[]" class="materiales" value='<?= json_encode($material) ?>'>
                                                <td><?= $material['nombre'] . ' ' . $material['marca'] . ' ' . $material['monto'] . $material['medida'] ?></td>
                                                <td><?= $material['cant'] ?></td>
                                                <td><span class="btn btn-danger" onclick="deletes(this,'material')">X</span></td>
                                            </tr>
                                    <?php  }
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>



            </div>

            </div>    
      </section><!-- End Motos Section -->
    </main>

    <?php
  }
}