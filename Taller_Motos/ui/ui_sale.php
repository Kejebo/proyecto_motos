<?php
require_once('gui.php');
require_once('ln/ln_sales.php');
class ui_sale extends Gui
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
        $sale = null;

        $visibilidad = 'none';
        $action = 'insert';
        $script = 'insert_sale';
        $fecha =  date("Y-m-d");
        $boton = 'none';
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'update_sale') {
                $sale = $this->ln->get_sale($_GET['id']);
                $action = 'update';
                $boton = 'block';
                $visibilidad = 'block';
                $script = 'update_sale';
                $fecha = $sale[0]['fecha'];
            }
        }

?>
        <form method="POST" action="sale.php?action=<?= $action ?>">
            <div class=" container row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 py-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5> <span> <i class="fas fa-bars"></i></span> Registrar Venta</h5>

                        </div>
                        <div class="card-body">
                            <div class="form-group notificar">
                                <label class="etiquetas">Fecha</label>
                                <input class="form-control" id="fecha" type="date" name="fecha" value="<?= $fecha ?>">
                                <input type="hidden" name="id" id="id" value="<?= $sale[0]['id'] ?>">
                            </div>

                            <label class="etiquetas">Cliente</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="cliente" id="cliente">
                                    <?php foreach ($this->ln->get_client() as $clientes) { ?>
                                        <option value="<?= $clientes['id_cliente'] ?>"><?= $clientes['nombre_cliente'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="btn btn-success" type="submit" data-toggle="modal" data-target="#form_cliente"><i class="fas fa-user"></i></span>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-file"></i> Registrar</button>
                                <a id="cancelar" href="sales.php" class="btn btn-danger btn-block" style="display: <?= $boton ?>"><i class="fas fa-file"></i> Cancelar</a>

                            </div>
                            <hr>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-3">

                    <div class="card shadow">
                        <div class="card-header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h5 class="card-title">Detalle de Venta</h5>
                                </div>
                                <div class="float-right">
                                    <a href="sales.php" class="btn btn-dark"><i class="far fa-eye"></i> Ver Todas</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-white card-title p-4 mt-3  table-responsive" style="border-radius:20px;">
                            <div class=" container bg-primary  clearfix p-2">

                                <div class="float-left">
                                    <h5 class="ml-2">Materiales Vendidos</h5>

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
                                        if (isset($sale)) {
                                            foreach ($this->ln->db->get_detail_sale($_GET['id']) as $list) {
                                                $saldo += $list['cantidad'] * $list['precio']; ?>
                                                <tr ids="<?= $id++ ?>">
                                                    <input type="hidden" name="detalles[]" class="lista" value='<?php print(json_encode($list)) ?>'>
                                                    <td><?= $list['nombre_material'] ?></td>
                                                    <td><?= $list['cantidad'] ?></td>
                                                    <td><?= $list['precio'] ?></td>
                                                    <td><?= $list['saldo'] ?></td>
                                                    <td><span class='delete_detail btn btn-danger' onclick="deletes(this,'sale')"><i class="fas fa-trash"></i></span></td>
                                                </tr>
                                        <?php      }
                                        } ?>
                                    </tbody>
                                    <tfoot id="pie_venta" class="bg-dark text-center text-white">
                                        <tr>
                                            <td>Saldo</td>
                                            <td></td>
                                            <td></td>
                                            <td><?= $saldo ?></td>
                                            <td></td>

                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div>

                    </div>
                </div>
        </form>

        <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Agregar Material</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="etiquetas">Material</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="material" id="material" onchange="get_prices(this)">
                                    <option value="0">Seleccione un material</option>
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
                        <button type="button" class="btn btn-success btn-block" id="form-sale" onclick="insert_sale_data()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="form_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Agregar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="tipo" value="cliente">
                        <input type="hidden" name="id_usuario">
                        <div class="form-group">
                            <label class="etiquetas">Nombre Completo</label>
                            <input class="form-control" type="text" id="nombre">
                        </div>
                        <div class="form-group">
                            <label class="etiquetas">Telefono</label>
                            <input class="form-control" type="number" id="telefono">
                        </div>
                        <div class="form-group">
                            <label class="etiquetas">Correo</label>
                            <input class="form-control" type="email" id="correo">
                        </div>
                        <div class="form-group">
                            <label class="etiquetas">Cedula Juridica</label>
                            <input class="form-control" type="text" id="cedula">
                        </div>
                        <div class="form-group">
                            <label class="etiquetas">Contraseña</label>
                            <input type="password" class="form-control" id="clave">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-block" data-dismiss="modal" onclick="insert_cliente()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>