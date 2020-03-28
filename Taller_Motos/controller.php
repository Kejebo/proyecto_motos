<?php
require_once('db/db_inventory.php');
require_once('ln/ln_purchase.php');

$db = new db_inventory();
$purchase = new ln_purchase();
if ($_POST['action'] == 'get_medida') {
    echo json_encode($db->get_category_medida($_POST['id'])[0]);
} else
    if ($_POST['action'] == 'insert_purchase') {
    extract($_POST);
    $purchase->insert_purchase($_POST);
    echo true;
} else
if ($_POST['action'] == 'update_purchase') {
    extract($_POST);
    $purchase->update_purchase($_POST);
    $purchase->rediretion();
    // echo true;
}
