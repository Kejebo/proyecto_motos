<?php

require __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

require_once('db/db_inventory.php');
require_once('db/db_admin.php');

$inventory = new db_inventory();
$admin = new db_admin();
$data = $admin->get_admin();

$nombreDelDocumento = "Reporte_Inventario.xlsx";
/**
 * Los siguientes encabezados son necesarios para que
 * el navegador entienda que no le estamos mandando
 * simple HTML
 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
 */

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('documents/FinalTemplate.xlsx');

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

$drawing->setName('Logo Empresa');
$drawing->setDescription('Logo de la Empresa');
$drawing->setPath($data['logo']);
$drawing->setCoordinates('I2');
$drawing->setOffsetX(0);
$drawing->setOffsetY(20);
$drawing->setHeight(100);
$drawing->setRotation(0);
$drawing->getShadow()->setVisible(true);
$drawing->getShadow()->setDirection(45);

$drawing->setWorksheet($documento->getActiveSheet());

$worksheet = $documento->getActiveSheet();

$worksheet->getCell('D4')->setValue($data['telefono']);
$worksheet->getCell('D5')->setValue($data['correo']);
$worksheet->getCell('D6')->setValue($data['direccion']);
$worksheet->getCell('D7')->setValue($data['cedula_juridica']);
$worksheet->getCell('H9')->setValue($data['nombre']);

$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;
