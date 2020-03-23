<?php
    require_once('db/db_inventory.php');
    $db=new db_inventory();
    if($_POST['id']){
        echo json_encode($db->get_category_medida($_POST['id'])[0]);
    }
?>