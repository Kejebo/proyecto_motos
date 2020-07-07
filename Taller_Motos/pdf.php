<?php
require_once('db/db_inventory.php');
require_once('db/db_admin.php');
require_once('db/db_client.php');
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
                    <td><?= $list['saldo']; ?></td>
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
                    <td><?= $list['saldo']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}


$admin = new db_admin();
$admin = $admin->get_admin();
?>
<style>
    thead th {
        height: 40px;
        font-size: 14px;
        color: white;
        text-transform: uppercase;
    }

    tbody td {
        height: 30px;
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
        background-color: lavender;
    }

    #titulo {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    #datos {
        width: 35%;
        margin-left: 65%;
        text-align: left;
        font-size: 14px;
    }

    #datos label {
        padding: 10px;
    }

    #datos hr {
        height: 4px;
        background-color: lightgray;
        border: none;
    }
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        Taller
    </page_header>
    <page_footer>
        <table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">Migthy Motors</td>
                <td style="text-align: right;    width: 50%">pagina [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>

    <div id="datos">

        <label><strong>Cedula Juridica</strong> <?= $admin['cedula_juridica'] ?></label>
        <br>
        <label><strong>Tel:</strong> <?= $admin['telefono'] ?></label>
        <br>
        <label><strong>Correo:</strong> <?= $admin['correo'] ?></label>
        <br>
        <label><strong>Direccion:</strong> <?= $admin['direccion'] ?></label>
        <hr>
    </div>

    <?php
    if (isset($_GET['data'])) {
        switch ($_GET['data']) {
            case 'Inventory':
                get_inventory();
                break;
            case 'Clients':
                get_clients();
                break;
            case 'Compras':
                get_purcharses();
                break;
            case 'Ventas':
                get_sales();
                break;
        }
    }
    ?>
</page>
<?php
require_once(__DIR__ . "./vendor/autoload.php");

use Spipu\Html2Pdf\Html2Pdf;

$html = ob_get_clean();
$pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
$pdf->writeHTML($html);

$pdf->output();
?>