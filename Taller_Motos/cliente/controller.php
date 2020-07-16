<?php
//require_once('db/db_inventory.php');
//require_once('ln/ln_purchase.php');
//require_once('ln/ln_sales.php');
require_once('db/db_motorcycle.php');
require_once('db/db_workshop.php');
//require_once('db/db_client.php');
//$inventory = new db_inventory();
//$purchase = new ln_purchase();
//$sale = new ln_sales();
$moto = new db_motorcycle();
$work = new db_workshop();
//$client = new db_client();
switch ($_POST['action']) {
    case 'get_medida':
        echo json_encode($inventory->get_category_medida($_POST['id'])[0]);
        break;
    case 'insert_purchase':
        $purchase->insert_purchase($_POST);
        break;
    case 'update_purchase':
        $purchase->update_purchase($_POST);
        break;
    case 'get_prices':
        echo json_encode($inventory->get_sale_prices($_POST['id'])[0]);
        break;

    case 'insert_marca':
        $inventory->insert_marca($_POST['nombre_marca']);
        echo json_encode($inventory->get_marcas());
        break;

    case 'insert_cliente':
        $client->insert_client($_POST);
        echo json_encode($client->get_clients());
        break;

    case 'insert_categoria':
        $inventory->insert_categoria($_POST);
        echo json_encode($inventory->get_category());
        break;

    case 'get_saldo':
        echo json_encode($inventory->validate_sale($_POST['id'])[0]);
        break;

    case 'insert_transmision':
        $moto->insert_transmision($_POST['nombre_transmision']);
        echo json_encode($moto->get_transmisiones());
        break;
    case 'insert_marcas_motos':
        $moto->insert_marca($_POST['nombre_marca']);
        echo json_encode($moto->get_marcas());
        break;
    case 'insert_combustible':
        $moto->insert_combustible($_POST['nombre_combustible']);
        echo json_encode($moto->get_combustible());
        break;
    case 'insert_cilindraje':
        $moto->insert_cilindraje($_POST['tamano_cilindraje']);
        // echo json_encode($moto->get_cilindraje());
        break;

    case 'insert_modelo_motos':
        $moto->insert_modelo($_POST);
        echo json_encode($moto->get_modelos());
        break;
    case 'get_motos':
        echo json_encode($moto->get_motos_client($_POST['id_cliente']));
        break;
    case 'venta_mensual':
        echo json_encode($sale->db->get_sales_mensual($_POST['dia']));
        break;
    case 'venta_diaria':
        echo json_encode($sale->db->get_sales_diario($_POST['dia']));
        break;
    case 'venta_anual':
        echo json_encode($sale->db->get_sales_anual($_POST['dia']));
        break;
    case 'venta_general':
        echo json_encode($sale->db->get_sales());
        break;
    case 'venta_periodo':
        echo json_encode($sale->db->get_sales_periodo($_POST['inicio'], $_POST['final']));
        break;
    case 'compra_mensual':
        echo json_encode($purchase->db->get_purchases_mensual($_POST['dia']));
        break;
    case 'compra_diaria':
        echo json_encode($purchase->db->get_purchases_diario($_POST['dia']));
        break;
    case 'compra_anual':
        echo json_encode($purchase->db->get_purchases_anual($_POST['dia']));
        break;
    case 'compra_general':
        echo json_encode($purchase->db->get_purchases());
        break;
    case 'compra_periodo':
        echo json_encode($purchase->db->get_purcharses_periodo($_POST['inicio'], $_POST['final']));
        break;
    case 'inventario':
        echo json_encode($inventory->get_inventory());
        break;
    case 'clientes':
        echo json_encode($client->get_clients());
        break;
    case 'motos_cliente':
        echo json_encode($moto->get_motos_client($_POST['id']));
        break;
}
