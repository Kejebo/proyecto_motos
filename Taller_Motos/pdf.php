<?php
include 'ln/ln_pdf.php';
require_once('db/db_admin.php');

$admin = new db_admin();
if (isset($_GET['dia'])) {
    $mes = $admin->get_month($_GET['dia']);
}
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
        Logo
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
            case 'inventario':
                get_inventory();
                break;
            case 'Clients':
                get_clients();
                break;
            case 'Motos_cliente':
                get_client_motorcycle();
                break;
            case 'compras':
                get_purcharses();
                break;
            case 'Compra':
                get_purchase();
                break;
            case 'Ventas':
                get_sales();
                break;
            case 'venta':
                get_sale();
                break;
            case 'venta_diaria':
                get_sales_daily();
                break;
            case 'venta_periodo':
                get_sales_periodo();
                break;
            case 'venta_mensual':
                get_sales_mensual($mes);
                break;
            case 'venta_anual':
                get_sales_anual();
                break;

            case 'compra_diaria':
                get_purcharses_dialy();
                break;
            case 'compra_mensual':
                get_purcharses_mensual($mes);
                break;
            case 'compra_anual':
                get_purcharses_anual();
                break;
            case 'compra_periodo':
                get_purcharses_periodo();
                break;
            case 'Proveedor':
                get_proveedor();
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