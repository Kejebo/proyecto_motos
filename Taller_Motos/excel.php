<?php
require_once('db/db_inventory.php');
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=archivo_nuevo.xls');
$inventory = new db_inventory();
?>

<table border="1" cellpadding="2" cellspaccing="0" with=100%>
    <caption>Inventario Migthy Motors</caption>
    <thead>
        <th>Venta</th>
        <th>Compra</th>
        <th>Nombre</th>
        <th>Medida</th>
        <th>Total</th>
        <th>Marca</th>
        <th>Saldo</th>
        <th>Cantidad</th>
    </thead>

    <tbody>
        <?php $data = $inventory->get_inventory(); ?>
        <?php foreach ($data as $item) { ?>
            <tr>
                <td><?= $item['venta'] ?></td>
                <td><?= $item['compra'] ?></td>
                <td><?= $item['nombre'] ?></td>
                <td><?= $item['medida'] ?></td>
                <td><?= $item['total'] ?></td>
                <td><?= $item['marca'] ?></td>
                <td><?= $item['saldo'] ?></td>
                <td><?= $item['cantidad'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>