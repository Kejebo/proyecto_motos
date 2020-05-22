<?php
require_once('db/db_inventory.php');
require_once('ln/ln_purchase.php');
require_once('ln/ln_sales.php');
require_once('db/db_motorcycle.php');
require_once('db/db_workshop.php');

$inventory = new db_inventory();
$purchase = new ln_purchase();
$sale = new ln_sales();
$moto= new db_motorcycle();
$work= new db_workshop();
switch ($_POST['action']) {
    case 'get_medida':
        echo json_encode($inventory->get_category_medida($_POST['id'])[0]);
        break;
    case 'insert_purchase':
        $purchase->insert_purchase($_POST);
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
    case 'insert_work':
        $work->insert_repair($_POST);
        extract($_POST);
        if (isset($material)) {
        foreach ($material as $datos) {
          $work->insert_material($datos,$work->get_last_id());
        }
      }
        if (isset($trabajo)) {
        foreach ($trabajo as $works) {
          $work->insert_work_detail($works,$work->get_last_id());
        }
      }
        $reparacion=$work->get_last_id();
      echo json_encode(array("id" => "workshop.php?action=update&id=$reparacion" ));

        break;
      case 'update_work':
        extract($_POST);
        $work->delete_works($id);
        $work->delete_materialwork($id);

        foreach ($material as $datos) {
        $work->insert_material($datos,$id);
        }

        foreach ($trabajo as $works) {
        $work->insert_work_detail($works,$id);
        }
        echo json_encode(array("id" => "workshop.php?action=update&id=$id" ));

        break;
}
