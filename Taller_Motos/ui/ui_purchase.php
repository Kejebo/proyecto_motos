<?php
require_once('gui.php');
require_once('ln/ln_purchase.php');
class ui_purchase extends Gui
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
        $purchase = null;

        $visibilidad = 'none';
        $action = 'insert';
        $script = 'insert_purchase';
        $fecha =  date("Y-m-d");
        $boton='none';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_purchase') {
                $purchase = $this->ln->get_purchase($_GET['id']);
                $action = 'update';
                $boton = 'block';
                $visibilidad = 'block';
                $script = 'update_purchase';
                $fecha=$purchase[0]['fecha'];

            }
        }

?>
<form  method="POST" action="purchase.php?action=<?= $action ?>">

        <div class=" container row">

            <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span> <i class="fas fa-bars"></i></span> Registrar Compra</h5>
                    </div>
                    <div class="card-body">
                            <div class="form-group notificar">
                                <label class="etiquetas">Fecha</label>
                                <input class="form-control" id="fecha" type="date" name="fecha" value="<?=$fecha ?>">
                                <input type="hidden" name="id" id="id" value="<?= $purchase[0]['id'] ?>">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Numero de factura</label>
                                <input class="form-control" type="text" name="factura" id="factura" required value="<?= $purchase[0]['factura'] ?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Proveedor</label>
                                <select class="form-control" name="proveedor" id="proveedor">
                                    <?php foreach ($this->ln->get_proveedor() as $proveedores) { ?>
                                        <option value="<?= $proveedores['id_proveedor'] ?>"><?= $proveedores['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> Registrar</button>
                                <a id="cancelar" href="purchases.php" class="btn btn-danger btn-block" style="display: <?= $boton ?>"><i class="fas fa-file"></i> Cancelar</a>
                            </div>
                            <hr>

                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-3">

                <div class="card shadow" id="purchase">
                    <div class="card-header">
                        <h5 class="card-title">Detalle de compra</h5>
                    </div>

                    <div class="bg-primary text-white card-title p-4 mt-3  table-responsive" style="border-radius:20px;">
                    <div class="clearfix p-2">

                      <div class="float-left">
                        <h5 class="ml-2">Materiales Comprados</h5>

                      </div>
                      <div class="float-right">
                        <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info mr-5">Agregar</button>
                      </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark text-center text-white">
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>SubTotal</th>
                                <th>Total</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody id="detalle" class="text-center">

                                <?php $id = 0;
                                $saldo = 0;
                                if (isset($purchase)) {
                                    foreach ($this->ln->db->get_detail_purchase($_GET['id']) as $list) {
                                        $saldo += $list['cantidad'] * $list['precio']; ?>
                                        <tr ids="<?= $id++ ?>">
                                            <input type="hidden" name="detalles[]" class="lista" value='<?php echo json_encode($list) ?>'>
                                            <td><?= $list['nombre_material'] ?></td>
                                            <td><?= $list['cantidad'] ?></td>
                                            <td><?= $list['precio'] ?></td>
                                            <td><?= $list['precio'] * $list['cantidad']  ?></td>
                                            <td><span class='delete_detail btn btn-danger' onclick="deletes(this,'purchase')"><i class="fas fa-trash"></i></span></td>
                                        </tr>
                                <?php      }
                                } ?>
                            </tbody>
                            <tfoot id="pie" class="bg-dark text-center text-white">
                               
                            </tfoot>
                        </table>


                    </div>
                </div>

            </div>
        </div>
                  <div class="modal fade bg-dark" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Agregar Material</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="etiquetas">Material</label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="material" id="material">
                            <?php foreach ($this->ln->get_inventory() as $material) { ?>
                                <option value="<?= $material['id'] ?>"><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .
                                                                            $material['monto'] . $material['medida'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append">
                            <a href="inventary.php" class="btn btn-success"><i class="fas fa-file"></i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="etiquetas">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" required value="0" min="0">
                    </div>

                    <div class="form-group">
                        <label class="etiquetas">Precio</label>
                        <input type="number" class="form-control" name="precio" id="precio" required value="0" min="0">
                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary">Cerrar</button>
                  <button type="button" class="btn btn-primary" id="form-purchase" >Agregar</button>
                </div>
              </div>
            </div>
          </div>
        </form>

<?php
    }
}
?>
