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
      
        $visibilidad='none';
        $action = 'insert';
        $script='insert_purchase';
        $boton = 'Registrar';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_purchase') {
                $purchase = $this->ln->get_purchase($_GET['id']);
                $action = 'update';
                $boton = 'Actualizar';
                $visibilidad='block';
                $script='update_purchase';
            }
        }

?>
        <div class=" container row">
            <div class="col-12 col-sm-12 col-lg-4 py-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> <span> <i class="fas fa-bars"></i></span> Registrar Compra</h5>
                    </div>
                    <div class="card-body">
                        <form id="form-purchase" method="POST" action="<?= $action ?>">
                            <div class="form-group notificar">
                                <label class="etiquetas">Fecha</label>
                                <input class="form-control" id="fecha" type="date" name="fecha" value="<?= date("Y-m-d") ?>">
                                <input type="hidden" name="id" id="id" value="<?=$purchase[0]['id']?>">
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Numero de factura</label>
                                <input class="form-control" type="text" name="factura" id="factura" required value="<?=$purchase[0]['factura']?>">
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Proveedor</label>
                                <select class="form-control" name="proveedor" id="proveedor">
                                    <?php foreach ($this->ln->get_proveedor() as $proveedores) { ?>
                                        <option value="<?= $proveedores['id_proveedor'] ?>"><?= $proveedores['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Material</label>
                                <select class="form-control" name="material" id="material">
                                    <?php foreach ($this->ln->get_inventory() as $material) { ?>
                                        <option value="<?= $material['id'] ?>"><?= $material['nombre'] . ' ' . $material['marca'] . ' ' .
                                                                                    $material['monto'] . $material['medida'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="etiquetas">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" required>
                            </div>

                            <div class="form-group">
                                <label class="etiquetas">Precio</label>
                                <input type="number" class="form-control" name="precio" id="precio" required>
                            </div>

                            <hr>
                            <div class="form-group">

                                <button class="btn btn-primary" type="submit"><i class="fas fa-file"></i> <?= $boton ?></button>
                                <button class="btn btn-success" type="button" onclick="sendpurchase('<?=$script?>')"><i class="fas fa-file"></i>Guardar</button>
                            </div>
                            <hr>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-3">

                <div class="card shadow" id="purchase" style="display:<?=$visibilidad?>">
                    <div class="card-header">
                        <h5 class="card-title">Detalle de compra</h5>
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
                            
                                <?php $id=0; 
                                if(isset($purchase)){
                                foreach ($purchase as $list) { ?>
                                    <tr ids="<?=$id++?>">
                                        <input type="hidden" name="detalle[]" class="lista" value='<?php print(json_encode($list))?>'>
                                        <td><?= $list['nombre_material'] ?></td>
                                        <td><?= $list['cantidad'] ?></td>
                                        <td><?= $list['precio'] ?></td>
                                        <td><?= $list['saldo'] ?></td>
                                        <td><span class='delete_detail btn btn-danger' onclick="deletes(this)">x</span></td>
                                    </tr>
                                <?php      } }?>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Lista de Compras</h5>
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

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($this->ln->get_purchases() as $list) { ?>
                                    <tr>
                                        <td><?= $list['fecha'] ?></td>
                                        <td><?= $list['factura'] ?></td>
                                        <td><?= $list['proveedor'] ?></td>
                                        <td><?= $list['saldo'] ?></td>
                                        <td><a href="purchases.php?action=delete&id=<?= $list['id'] ?>" class="btn btn-danger">x</a></td>
                                        <td><a href="purchases.php?action=update_purchase&id=<?= $list['id'] ?>" class="btn btn-warning">edit</a></td>

                                    </tr>
                                <?php } ?>

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