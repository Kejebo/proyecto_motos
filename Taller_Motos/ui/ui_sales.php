<?php
require_once('gui.php');
require_once('ln/ln_sales.php');
class ui_sales extends Gui
{
    var $ln;

    function __construct($config)
    {
        parent::__construct($config);
        $this->ln = new ln_sales();
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
<div class="col-12 col-sm-12 col-md-12 col-lg-12 py-3">
    <div class="card shadow">
      <div class="card-header">
        <div class="clearfix">
          <div class="float-left">
            <h5 class="card-title">Lista de Ventas</h5>
          </div>
          <div class="float-right">
            <div class="btn-group" role="group" aria-label="First group">

            <a class="btn btn-dark" href="sale.php"><i class="fas fa-plus-circle"></i> Nuevo</a>
                
                  <a class="btn btn-dark" target="blank" href="pdf.php?data=ventas">PDF</a>
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
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                    <th>Editar</th>
                                    <th>Exportar</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($this->ln->get_sales() as $list) { ?>
                                    <tr>
                                        <td><?= $list['fecha'] ?></td>
                                        <td><?= $list['cliente'] ?></td>
                                        <td><?= number_format($list['saldo']) ?></td>
                                        <td><a href="sale.php?action=delete&id=<?=$list['id']?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                        <td><a href="sale.php?action=update_sale&id=<?=$list['id']?>" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a></td>
                                        <td><a href="pdf.php?data=venta&id=<?= $list['id'] ?>" target="blank" class="btn btn-secondary text-white"><i class="fa fa-download" aria-hidden="true"></i></a></td>

                                    </tr>
                                <?php } ?>

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
