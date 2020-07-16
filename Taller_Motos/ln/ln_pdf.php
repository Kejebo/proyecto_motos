<?php
require_once('db/db_inventory.php');
require_once('db/db_client.php');
require_once('db/db_motorcycle.php');
require_once('db/db_proveedor.php');
require_once('db/db_purchase.php');
require_once('db/db_sales.php');
function get_inventory()
{
    $db = new db_inventory();

?>
    <div id="titulo">
        <h2>Lista de Materiales</h2>
    </div>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Nombre</th>
                <th style="text-align: center;    width: 20%">Marca</th>
                <th style="text-align: center;    width: 10%">Cant</th>
                <th style="text-align: center;    width: 10%">Medida</th>
                <th style="text-align: center;    width: 20%">Precio Compra</th>
                <th style="text-align: center;    width: 20%">Precio Venta</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_inventory() as $list) { ?>

                <tr>
                    <td><?= $list['nombre']; ?></td>
                    <td><?= $list['marca']; ?></td>
                    <td><?= $list['saldo'] ?></td>
                    <td><?= $list['monto'] . ' ' . $list['medida']; ?></td>
                    <td><?= $list['compra']; ?></td>
                    <td><?= $list['venta']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_clients()
{
    $db = new db_client();

?>
    <div id="titulo">
        <h2>Lista de Clientes</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 30%">Nombre</th>
                <th style="text-align: center;    width: 15%">Cedula</th>
                <th style="text-align: center;    width: 20%">Telefono</th>
                <th style="text-align: center;    width: 25%">Correo</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_clients() as $list) { ?>

                <tr>
                    <td><?= $list['nombre_cliente']; ?></td>
                    <td><?= $list['cedula_juridica']; ?></td>
                    <td><?= $list['telefono']; ?></td>
                    <td><?= $list['correo']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_client_motorcycle()
{
    $db = new db_motorcycle;
    $client = new db_client();
?>
    <div id="titulo">
        <h2>Lista de Motos del <?= $client->get_client($_GET['id'])['nombre_cliente'] ?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 10%">#Placa</th>
                <th style="text-align: center;    width: 34%">Moto</th>
                <th style="text-align: center;    width: 20%">Cilindraje</th>
                <th style="text-align: center;    width: 18%">Kilometraje</th>
                <th style="text-align: center;    width: 18%">Proxima Cita</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_motos_client($_GET['id']) as $list) { ?>

                <tr>
                    <td><?= $list['placa']; ?></td>
                    <td><?= $list['moto']; ?></td>
                    <td><?= $list['cilindraje']; ?></td>
                    <td><?= $list['kilometraje']; ?></td>
                    <td><?= $list['nuevo_kilometraje']; ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_proveedor()
{
    $db = new db_proveedor();

?>
    <div id="titulo">
        <h2>Lista de Proveedor</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 30%">Nombre</th>
                <th style="text-align: center;    width: 25%">Cedula Juridica</th>
                <th style="text-align: center;    width: 20%">Telefono</th>
                <th style="text-align: center;    width: 25%">Correo</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_proveedores() as $list) { ?>

                <tr>
                    <td><?= $list['nombre']; ?></td>
                    <td><?= $list['cedula_juridica']; ?></td>
                    <td><?= $list['telefono']; ?></td>
                    <td><?= $list['correo']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_purcharses()
{
    $db = new db_purchase();

?>
    <div id="titulo">
        <h2>Lista de Compras</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 30%">#Factura</th>
                <th style="text-align: center;    width: 30%">Proveedor</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_purchases() as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['factura']; ?></td>
                    <td><?= $list['proveedor']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}
function get_purcharses_dialy()
{
    $db = new db_purchase();

?>
    <div id="titulo">
        <h2>Lista de Compras</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 35%">#Factura</th>
                <th style="text-align: center;    width: 35%">Proveedor</th>
                <th style="text-align: center;    width: 30%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_purchases_diario($_GET['dia']) as $list) { ?>

                <tr>
                    <td><?= $list['factura']; ?></td>
                    <td><?= $list['proveedor']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_purcharses_periodo()
{
    $db = new db_purchase();

?>
    <div id="titulo">
        <h2>Lista de Compras desde <?=$_GET['inicio'].' hasta '.$_GET['final']?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 35%">#Factura</th>
                <th style="text-align: center;    width: 35%">Proveedor</th>
                <th style="text-align: center;    width: 30%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_purcharses_periodo($_GET['inicio'], $_GET['final']) as $list) { ?>

                <tr>
                    <td><?= $list['factura']; ?></td>
                    <td><?= $list['proveedor']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_purcharses_mensual($mes)
{
    $db = new db_purchase();

?>
    <div id="titulo">
        <h2>Lista de Compras <?= ucfirst($mes['mes']) ?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 30%">#Factura</th>
                <th style="text-align: center;    width: 30%">Proveedor</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_purchases_mensual($_GET['dia']) as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>

                    <td><?= $list['factura']; ?></td>
                    <td><?= $list['proveedor']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_purcharses_anual()
{
    $db = new db_purchase();

?>
    <div id="titulo">
        <h2>Lista de Compras del Año <?= $_GET['dia'] ?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 30%">#Factura</th>
                <th style="text-align: center;    width: 30%">Proveedor</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_purchases_anual($_GET['dia']) as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['factura']; ?></td>
                    <td><?= $list['proveedor']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_sales()
{
    $db = new db_sales();

?>
    <div id="titulo">
        <h2>Lista de Ventas</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 60%">Cliente</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_sales() as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['cliente']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}
function get_sales_daily()
{
    $db = new db_sales();

?>
    <div id="titulo">
        <h2>Lista de Ventas</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 60%">Cliente</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_sales_diario($_GET['dia']) as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['cliente']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_sales_periodo()
{
    $db = new db_sales();

?>
    <div id="titulo">
        <h2>Lista de Ventas desde <?=$_GET['inicio'].' hasta '.$_GET['final']?> </h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 60%">Cliente</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_sales_periodo($_GET['inicio'], $_GET['final']) as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['cliente']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_sales_mensual($mes)
{
    $db = new db_sales();

?>
    <div id="titulo">
        <h2>Lista de Ventas de <?= ucfirst($mes['mes']) ?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 60%">Cliente</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_sales_mensual($_GET['dia']) as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['cliente']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_sales_anual()
{
    $db = new db_sales();

?>
    <div id="titulo">
        <h2>Lista de Ventas del Año <?= $_GET['dia'] ?></h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 60%">Cliente</th>
                <th style="text-align: center;    width: 20%">Total</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_sales_anual($_GET['dia']) as $list) { ?>

                <tr>
                    <td><?= $list['fecha']; ?></td>
                    <td><?= $list['cliente']; ?></td>
                    <td><?= number_format($list['saldo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}

function get_sale()
{
    $db = new db_sales();
    $data = $db->get_sale($_GET['id'])[0];
?>
    <div id="titulo">
        <h2>Lista de Ventas</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 30%">Fecha</th>
                <th style="text-align: center;    width: 70%">Cliente</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td><?= $data['fecha']; ?></td>
                <td><?= $data['cliente']; ?></td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 60%">Producto</th>
                <th style="text-align: center;    width: 10%">Cant</th>
                <th style="text-align: center;    width: 15%">SubTotal</th>
                <th style="text-align: center;    width: 15%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_detail_sale($_GET['id']) as $list) {
                $saldo = +$list['saldo']; ?>
                <tr>
                    <td><?= $list['nombre_material'] ?></td>
                    <td><?= $list['cantidad'] ?></td>
                    <td><?= number_format($list['precio']) ?></td>
                    <td><?= number_format($list['saldo'])  ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2">Total</td>
                <td colspan="2"><?= number_format($saldo) ?></td>
            </tr>
        </tbody>
    </table>
<?php
}

function get_purchase()
{
    $db = new db_purchase();
    $data = $db->get_purchase($_GET['id'])[0];
?>
    <div id="titulo">
        <h2>Lista de Ventas</h2>
    </div>
    <br>
    <br>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 20%">Fecha</th>
                <th style="text-align: center;    width: 30%">#Factura</th>
                <th style="text-align: center;    width: 50%">Proveedor</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td><?= $data['fecha']; ?></td>
                <td><?= $data['factura']; ?></td>
                <td><?= $data['proveedor']; ?></td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; text-align:center;" align="center">
        <thead>
            <tr style="background-color: black;">
                <th style="text-align: center;    width: 60%">Producto</th>
                <th style="text-align: center;    width: 10%">Cant</th>
                <th style="text-align: center;    width: 15%">SubTotal</th>
                <th style="text-align: center;    width: 15%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->get_detail_purchase($_GET['id']) as $list) {
                $saldo = +$list['precio'] * $list['cantidad']; ?>
                <tr>
                    <td><?= $list['nombre_material'] ?></td>
                    <td><?= $list['cantidad'] ?></td>
                    <td><?= number_format($list['precio']) ?></td>
                    <td><?= number_format($list['precio'] * $list['cantidad']);  ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2">Total</td>
                <td colspan="2"><?= number_format($saldo) ?></td>
            </tr>
        </tbody>
    </table>
<?php
}
?>