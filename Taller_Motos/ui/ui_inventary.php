<?php
require_once('gui.php');
require_once('ln/ln_inventory.php');
class ui_inventary extends gui
{
  var $ln;

  function __construct($config)
  {
    parent::__construct($config);
    $this->ln = new ln_inventory();
  }
  function action_controller()
  {
    $this->ln->action_controller();
  }
  function get_content()
  {

?>
    <div class="container">
      <div class="row">        
      <div  class="col-12 col-sm-12 col-md-12 col-lg-12 py-3 contenido_modulos">
        <div class="card shadow">
          <div class="card-header">
            <div class="clearfix">
              <div class="float-left">
                <h5 class="card-title">Lista de Materiales</h5>
              </div>
              <div class="float-right">
                <div class="btn-group" role="group" aria-label="First group">

                <a class="btn btn-dark" href="materials.php"> + Nuevo</a>
      
              </div>

              </div>
            </div>
          </div>
                <div class="card-body  table-responsive">
                    <table class="table table-bordered" id="example">
                        <thead class="thead-dark text-center text-white">
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Presentacion</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                    <th>Eiminar</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php foreach ($this->ln->get_inventory() as $list) { ?>
                    <tr>
                      <td><?= $list['nombre']; ?></td>
                      <td><?= $list['saldo']; ?></td>
                      <td><?= $list['monto'].' '.$list['medida']; ?></td>
                      <td><?= $list['venta']; ?></td>
                      <td><?= $list['compra']; ?></td>
                      <td><a href="inventary.php?action=delete&id=<?= $list['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                      <td><a href="materials.php?action=update_material&id=<?= $list['id']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>

                    </tr>
                  <?php } ?>
                </tbody>

              </table>
            </div>
          </div>
        </div>
        </div>
    </div>
    </section>

<?php
  }
}
?>
