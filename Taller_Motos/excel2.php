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

$documento = \PhpOffice\PhpSpreadsheet\IOFactory::load('documents/LibroFinal.xlsx');

$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        ],
    ],
];

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

$drawing->setName('Logo Empresa');
$drawing->setDescription('Logo de la Empresa');
$drawing->setPath($data['logo']);
$drawing->setCoordinates('H3');
$drawing->setOffsetX(70);
$drawing->setOffsetY(10);
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
$worksheet->getCell('H10')->setValue($data['nombre']);

$datos = $inventory->get_inventory();
$contadorC = 6;
$contadorF = 14;

foreach ($datos as $item) {

    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['venta']);
    $worksheet->getStyle('F' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('F' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['compra']);
    $worksheet->getStyle('G' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('G' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['nombre']);
    $worksheet->getStyle('H' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('H' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['medida']);
    $worksheet->getStyle('I' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('I' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['total']);
    $worksheet->getStyle('J' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('J' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['marca']);
    $worksheet->getStyle('K' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('K' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['saldo']);
    $worksheet->getStyle('L' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('L' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorC++;
    $documento->getActiveSheet()->setCellValueByColumnAndRow($contadorC, $contadorF, $item['cantidad']);
    $worksheet->getStyle('M' . $contadorF)->applyFromArray($styleArray);
    $worksheet->getStyle('M' . $contadorF)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $contadorF++;
    $contadorC = 6;
}

$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;
