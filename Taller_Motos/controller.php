<?php
require_once('db/db_inventory.php');
require_once('ln/ln_purchase.php');

$db = new db_inventory();
$purchase = new ln_purchase();
switch ($_POST['action']) {
    case 'get_medida':
        echo json_encode($db->get_category_medida($_POST['id'])[0]);
        break;
    case 'insert_purchase':
        extract($_POST);
        $purchase->insert_purchase($_POST);
        echo true;
        break;
    case 'update_purchase':
        extract($_POST);
        $purchase->update_purchase($_POST);
        $purchase->rediretion();
        // echo true;
        break;
    case 'get_prices':
        echo json_encode($db->get_sale_prices($_POST['id'])[0]);
}
