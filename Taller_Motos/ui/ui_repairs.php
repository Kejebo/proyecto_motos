<?php
require_once('gui.php');
require_once('ln/ln_workshop.php');
class ui_repairs extends Gui
{
  var $ln;

  function __construct($config)
  {
    $this->ln = new ln_workshop();
    parent::__construct($config);
  }

    function get_content()
    {
      ?>
<div class="container row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3 contenido_modulos">
    <div class="card shadow">
      <div class="card-header">
        <div class="clearfix">
          <div class="float-left">
            <h5 class="card-title">Lista de Reparaciones</h5>
          </div>
          <div class="float-right">
            <div class="btn-group" role="group" aria-label="First group">

                  <a class="btn btn-dark" href="workshop.php"> <i class="fas fa-plus-circle"></i> Nuevo</a>
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
                  <th>Cliente</th>
                  <th>Moto</th>
                  <th>Placa</th>
                  <th>Precio</th>
                  <th>Estado</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                  <th>Exportar</th>

                </tr>
              </thead>
              <tbody class="text-center" >
                <?php
                foreach ($this->ln->get_repairs() as $repair) { ?>
                  <tr>
                    <td><?= $repair['fecha'] ?></td>
                    <td><?= $repair['cliente'] ?></td>
                    <td><?= $repair['moto'] ?></td>
                    <td><?= $repair['placa'] ?></td>
                    <td><?= number_format($repair['monto']) ?></td>
                    <?php
                    if ($repair['estado'] == 'Espera') { ?>
                      <td class="text-center text-white bg-warning">Espera</td>
                    <?php
                    } else { ?>
                      <td class="text-center text-white bg-success">Finalizado</td>
                    <?php
                    }
                    ?>
                    <td><a href="workshop.php?action=update&id=<?= $repair['id'] ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                    <td><a href="repairs.php?action=delete&id=<?= $repair['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
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

<?php
  }
}
?>