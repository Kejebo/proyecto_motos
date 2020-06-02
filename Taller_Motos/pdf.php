<?php
require_once('vendor/autoload.php');
require_once('ui/ui_inventary.php');

use Spipu\Html2Pdf\Html2Pdf;

$db = new ui_inventary(null);
$htmls = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF 8');

foreach ($db->ln->db->get_inventory() as $list) {
       
$htmls->writeHTML('
<td>'.$list['nombre'].'</td>
<td>'.$list['saldo'].'</td>
<td>'.$list['monto'] . ' ' . $list['medida'].'</td>
<td>'.$list['venta'].'</td>
<td>'.$list['compra'].'</td>
');
}
$htmls->output();
?>
            
        <?php  ?>
