<?php
require_once('db/db_inventory.php');
require_once('ln/ln_purchase.php');
require_once('ln/ln_sales.php');
$inventory = new db_inventory();
$purchase = new ln_purchase();
$sale = new ln_sales();
switch ($_POST['action']) {
    case 'get_medida':
        echo json_encode($inventory->get_category_medida($_POST['id'])[0]);
        break;
    case 'insert_purchase':
        $purchase->insert_purchase($_POST);
        echo true;
        break;
    case 'update_purchase':
        $purchase->update_purchase($_POST);
        // echo true;
        break;
    case 'get_prices':
        echo json_encode($inventory->get_sale_prices($_POST['id'])[0]);
        break;

    case 'insert_sale':
        $sale->insert_sale($_POST);
        break;

    case 'update_sale':
        $sale->update_sale($_POST);
        break;
    case 'insert_marca':
        $inventory->insert_marca($_POST['nombre_marca']);
        echo json_encode($inventory->get_marcas());
        break;

    case 'insert_categoria':
        $inventory->insert_categoria($_POST);
        echo json_encode($inventory->get_category());
        break;

    case 'get_saldo':
        echo json_encode($inventory->validate_sale($_POST['id'])[0]);
}
