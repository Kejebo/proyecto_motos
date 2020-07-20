<?php
require_once('db/db_inventory.php');
require_once('db/db_admin.php');
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=archivo_nuevo.xls');
$inventory = new db_inventory();
$admin = new db_admin();
$data = $admin->get_admin();
?>


<table cellpadding="50" cellspacing="20" with=100%>
    <h2 style="solid; width: 150px; text-align: center;"><?= $data['nombre'] ?></h2>
    <h3 style=" width: 150px; text-align: center;">Inventario</h3>
    <thead>
        <th style=" border: solid; color: black; background-color: #ffcc80; text-align: center; width: 70px;">Telefono</th>
        <th style=" border: solid; color: black; background-color: #ffcc80; text-align: center; width: 70px;">Correo</th>
        <th style=" border: solid; color: black; background-color: #ffcc80; text-align: center; width: 200px;">Direccion</th>
        <th style=" border: solid; color: black; background-color: #ffcc80; text-align: center; width: 70px;">Cedula Juridica</th>
    </thead>
    <tbody>
        <tr>
            <td style="border: solid;text-align: center;vertical-align:middle;"><?= $data['telefono'] ?></td>
            <td style="border: solid;text-align: center;vertical-align:middle;"><?= $data['correo'] ?></td>
            <td style="border: solid;text-align: center;vertical-align:middle;"><?= $data['direccion'] ?></td>
            <td style="border: solid;text-align: center;vertical-align:middle;"><?= $data['cedula_juridica'] ?></td>
        </tr>
        <tr>
            <td style="border: none;"></td>
        </tr>
    </tbody>

</table>

<table border="1" cellpadding="2" cellspaccing="0" with=100%>
    <thead>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 70px;">Venta</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 70px;">Compra</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 200px;">Nombre</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 70px;">Medida</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 70px;">Total</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 200;">Marca</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 70px;">Saldo</th>
        <th style="color: black; background-color: #ffcc80; text-align: center; width: 70px;">Cantidad</th>
    </thead>

    <tbody>
        <?php $data = $inventory->get_inventory(); ?>
        <?php foreach ($data as $item) { ?>
            <tr>
                <td style="text-align: center;vertical-align:middle;"><?= $item['venta'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['compra'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['nombre'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['medida'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['total'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['marca'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['saldo'] ?></td>
                <td style="text-align: center;vertical-align:middle;"><?= $item['cantidad'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>