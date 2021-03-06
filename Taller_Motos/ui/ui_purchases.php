<?php
require_once('gui.php');
require_once('ln/ln_purchase.php');
class ui_purchases extends Gui
{
    var $ln;

    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_purchase();
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
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3 contenido_modulos">
    <div class="card shadow">
      <div class="card-header">
        <div class="clearfix">
          <div class="float-left">
            <h5 class="card-title">Lista de Compras</h5>
          </div>
          <div class="float-right">
            <div class="btn-group" role="group" aria-label="First group">

            <a class="btn btn-dark" href="purchase.php"> <i class="fas fa-plus-circle"></i> Nuevo</a>
            <div class="btn-group ml-2" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Exportar
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" target="blank" href="pdf.php?data=compras">PDF</a>
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
                            <th>Fecha</th>
                            <th>#Factura</th>
                            <th>Proveedor</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                            <th>Exportar</th>

                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                        if($this->ln->get_purchases()){
                        foreach ($this->ln->get_purchases() as $list) { ?>
                            <tr>
                                <td><?= $list['fecha'] ?></td>
                                <td><?= $list['factura'] ?></td>
                                <td><?= $list['proveedor'] ?></td>
                                <td><?= number_format($list['saldo']) ?></td>
                                <td><a href="purchases.php?action=delete&id=<?= $list['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                <td><a href="purchase.php?action=update_purchase&id=<?= $list['id'] ?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                                <td><a href="pdf.php?data=compra&id=<?= $list['id'] ?>" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>

                            </tr>
                        <?php } }?>

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
?>
