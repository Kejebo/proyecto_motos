<?php
require_once('gui.php');
require_once('ln/ln_workshop.php');
class ui_repairs extends Gui
{
    var $ln;

    function __construct($config)
    {
      $this->ln= new ln_workshop();
        parent::__construct($config);
    }

    function get_content()
    {
      ?>
<div class="container row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3">
    <div class="card shadow">
      <div class="card-header">
        <div class="clearfix">
          <div class="float-left">
            <h5 class="card-title">Lista de Reparaciones</h5>
          </div>
          <div class="float-right">
            <a class="btn btn-dark" href="workshop.php"> + Nuevo</a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered" id="example">
          <thead class="thead-dark text-center text-white">
            <tr>
              <th>Fecha</th>
              <th>Cliente</th>
              <th>Moto</th>
              <th>Placa</th>
              <th>Precio</th>
              <th>Editar</th>
              <th>Eliminar</th>

            </tr>
          </thead>
          <tbody class="text-center">
            <?php
              foreach ($this->ln->get_repairs() as $repair) { ?>
                <tr>
                  <td><?=$repair['fecha']?></td>
                  <td><?=$repair['cliente']?></td>
                  <td><?=$repair['moto']?></td>
                  <td><?=$repair['placa']?></td>
                  <td><?=$repair['monto']?></td>
                  <td><a href="workshop.php?action=update&id=<?=$repair['id']?>" class="btn btn-warning">+</a></td>
                  <td><a href="repairs.php?action=delete&id=<?=$repair['id']?>" class="btn btn-danger">X</a></td>
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
