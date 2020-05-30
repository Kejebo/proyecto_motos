<?php
require('assets/pdf/fpdf.php');
require_once('db/db_inventory.php');
require_once('db/db_purchase.php');

class PDF extends FPDF
{

    function encabezado($data)
    {
        // Logo
        //    $this->Image('logo_pb.png',10,8,33);
        // Arial bold 15
        // Movernos a la derecha
        $this->SetFont('Arial', 'I', 12);

        $this->Cell(150);
        $this->Cell(30, 10, date('d/m/Y'), 0, 0, 'C');

        $this->Ln(20);
        $this->SetFont('Arial', 'B', 15);

        $this->Cell(80);

        // Título
        $this->Cell(30, 10, $data, 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }
    function ImprovedTable($header, $data)
    {
        $this->SetFont('Arial', 'B', 12);

        $this->SetFillColor(030, 030, 030);
        $this->SetTextColor(255);
        // Anchuras de las columnas
        $w = array(60, 35, 45, 40);
        // Cabeceras
        for ($i = 0; $i < count($header); $i++)

            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        $this->SetFillColor(215, 215, 215);
        $this->SetTextColor(0);
        // Datos
        $fill = false;

        // Datos
        foreach ($data as $row) {
            $this->SetFont('Arial', 'I', 12);

            $this->Cell($w[0], 6, $row['nombre'], 1, 0, 'C', $fill);
            $this->Cell($w[1], 6, number_format($row['saldo']), 1, 0, 'C', $fill);
            $this->Cell($w[2], 6, number_format($row['venta']), 1, 0, 'C', $fill);
            $this->Cell($w[3], 6, number_format($row['compra']), 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre

        $this->Cell(array_sum($w), 0, '', 'T');
    }
    function get_compra($header,$data){
        $this->SetFont('Arial', 'B', 12);

        $this->SetFillColor(030, 030, 030);
        $this->SetTextColor(255);
        // Anchuras de las columnas
        $w = array(60, 35, 45, 40);
        // Cabeceras
        for ($i = 0; $i < count($header); $i++)

            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        $this->SetFillColor(215, 215, 215);
        $this->SetTextColor(0);
        // Datos
        $fill = false;

        // Datos
        foreach ($data as $row) {
            $this->SetFont('Arial', 'I', 12);

            $this->Cell($w[0], 6, $row['fecha'], 1, 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_encode($row['factura']), 1, 0, 'C', $fill);
            $this->Cell($w[2], 6, utf8_encode($row['proveedor']), 1, 0, 'C', $fill);
            $this->Cell($w[3], 6, number_format($row['saldo']), 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre

        $this->Cell(array_sum($w), 0, '', 'T');
    }
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
// Títulos de las columnas
if ($_GET['data'] == "Inventory") {
    $header = array('Material', 'Cantidad', 'Precio venta', 'Precio Compras');
    // Carga de datos
    $db = new db_inventory();
    $pdf->SetFont('Arial', '', 14);
    $pdf->SetTitle('Lista de inventario');
    $pdf->SetAuthor('Taller de motos');
    $pdf->AddPage();
    $pdf->ImprovedTable($header, $db->get_inventory());
} elseif ($_GET['data'] == "Compra") {
    $header = array('Fecha', '#Factura', 'Proveedor', 'Saldo');
    $db= new db_purchase();
    $pdf->Header('Lista de Compras');
    $pdf->SetFont('Arial', '', 14);
    $pdf->SetTitle('Lista de Compras');
    $pdf->SetAuthor('Taller de motos');
    $pdf->AddPage();
    $pdf->encabezado('Historial de Compras');
    $pdf->get_compra($header, $db->get_purchases());
}
$pdf->Output("d");
