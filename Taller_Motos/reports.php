<?php
require('assets/pdf/fpdf.php');
require_once('db/db_inventory.php');
require_once('db/db_purchase.php');
require_once('db/db_sales.php');
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

        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 10, "Empresa:", 0, 0, 'L');
        $this->Ln(10);
        $this->Cell(30, 10, "Cedula Juridica:", 0, 0, 'L');
        $this->Ln(10);
        $this->Cell(30, 10, "Telefono:", 0, 0, 'L');
        $this->Ln(10);
        $this->Cell(30, 10, "Direccion:", 0, 0, 'L');
        $this->Ln(10);

        $this->Ln(20);
        $this->Cell(80);
        $this->SetFont('Arial', 'B', 15);

        // Título
        $this->Cell(30, 10, $data, 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }
    function encabezado_personal($titulo, $data, $opcion)
    {
        // Logo
        //    $this->Image('logo_pb.png',10,8,33);
        // Arial bold 15
        // Movernos a la derecha
        $this->SetFont('Arial', 'I', 12);

        $this->Cell(150);
        $this->Cell(30, 10, date('d/m/Y'), 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(30, 10, "Empresa:", 0, 0, 'L');
        $this->Ln(10);
        $this->Cell(30, 10, "Cedula Juridica:", 0, 0, 'L');
        $this->Ln(10);
        $this->Cell(30, 10, "Telefono:", 0, 0, 'L');
        $this->Ln(10);
        $this->Cell(30, 10, "Direccion:", 0, 0, 'L');

        $this->Ln(15);
        $this->Cell(80);
        $this->SetFont('Arial', 'B', 15);

        // Título
        $this->Cell(30, 10, $titulo, 0, 0, 'C');
        // Salto de línea
        $this->Ln(15);
        if ($opcion == 'Compras') {
            $this->SetFont('Arial', 'I', 12);
            $this->Cell(30, 10, utf8_encode("#Factura: " . $data[0]['factura']), 0, 0, 'L');
            $this->LN(10);
            $this->Cell(30, 10, utf8_encode("Proveedor: " . $data[0]['proveedor']), 0, 0, 'L');
            $this->LN(10);
        } else {
            $this->SetFont('Arial', 'I', 12);
            $this->Cell(30, 10, utf8_encode("Cliente: " . $data[0]['cliente']), 0, 0, 'L');
            $this->LN(10);
        }
        $this->Cell(30, 10, "Fecha: " . $data[0]['fecha'], 0, 0, 'L');
        $this->LN(20);
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
    function get_compra($header, $data)
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

            $this->Cell($w[0], 6, $row['fecha'], 1, 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_encode($row['factura']), 1, 0, 'C', $fill);
            $this->Cell($w[2], 6, utf8_encode($row['proveedor']), 1, 0, 'C', $fill);
            $this->Cell($w[3], 6, number_format($row['saldo']), 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
    }
    function get_detalle_compra_venta($header, $data)
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
        $acum = 0;
        foreach ($data as $row) {
            $this->SetFont('Arial', 'I', 12);
            $acum += $row['precio'] * $row['cantidad'];
            $this->Cell($w[0], 6, utf8_encode($row['nombre_material']), 1, 0, 'C', $fill);
            $this->Cell($w[1], 6, number_format($row['cantidad']), 1, 0, 'C', $fill);
            $this->Cell($w[2], 6, number_format($row['precio']), 1, 0, 'C', $fill);
            $this->Cell($w[3], 6, number_format($row['precio'] * $row['cantidad']), 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre

        $this->Cell($w[0], 6, utf8_encode('Saldo'), 1, 0, 'C', $fill);
        $this->Cell($w[1], 6, '', 1, 0, 'C', $fill);
        $this->Cell($w[2], 6, '', 1, 0, 'C', $fill);
        $this->Cell($w[3], 6, number_format($acum), 1, 0, 'C', $fill);

        $this->Cell(array_sum($w), 0, '', 'T');
    }
    function get_venta($header, $data)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetX(40);

        $this->SetFillColor(030, 030, 030);
        $this->SetTextColor(255);
        // Anchuras de las columnas
        $w = array(35, 60, 45);
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
            $this->SetX(40);

            $this->Cell($w[0], 6, $row['fecha'], 1, 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_encode($row['cliente']), 1, 0, 'C', $fill);
            $this->Cell($w[2], 6, number_format($row['saldo']), 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre


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
switch ($_GET['data']) {
    case "Inventory":
        $header = array('Material', 'Cantidad', 'Precio venta', 'Precio Compras');
        // Carga de datos
        $db = new db_inventory();
        $pdf->SetFont('Arial', '', 14);
        $pdf->SetTitle('Lista de inventario');
        $pdf->SetAuthor('Taller de motos');
        $pdf->AddPage();
        $pdf->ImprovedTable($header, $db->get_inventory());
        break;
    case "Compra":
        if (isset($_GET['id'])) {
            $header = array('Producto', 'Cantidad', 'Precio', 'Total');
            $db = new db_purchase();
            $pdf->Header('Lista de Compras');
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetTitle('Lista de Compras');
            $pdf->SetAuthor('Taller de motos');
            $pdf->AddPage();
            $pdf->encabezado_personal('Detalle de Compra', $db->get_purchase($_GET['id']),'Compra');
            $pdf->get_detalle_compra_venta($header, $db->get_detail_purchase($_GET['id']));
        } else {
            $header = array('Fecha', '#Factura', 'Proveedor', 'Saldo');
            $db = new db_purchase();
            $pdf->Header('Detalle de Compra');
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetTitle('Detalle de Compra');
            $pdf->SetAuthor('Taller de motos');
            $pdf->AddPage();
            $pdf->encabezado('Historial de Compras');
            $pdf->get_compra($header, $db->get_purchases());
        }
        break;

        break;
    case "Ventas":
        $db = new db_sales();

        if (isset($_GET['id'])) {
            $header = array('Producto', 'Cantidad', 'Precio', 'Total');
            $pdf->Header('Lista de Ventas');
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetTitle('Lista de Ventas');
            $pdf->SetAuthor('Taller de motos');
            $pdf->AddPage();
            $pdf->encabezado_personal('Detalle de Venta', $db->get_sale($_GET['id']),'Venta');
            $pdf->get_detalle_compra_venta($header, $db->get_detail_sale($_GET['id']));
        } else {

            $header = array('Fecha', 'Cliente', 'Saldo');
            $pdf->Header('Lista de Ventas');
            $pdf->SetFont('Arial', '', 14);
            $pdf->SetTitle('Lista de Ventas');
            $pdf->SetAuthor('Taller de motos');
            $pdf->AddPage();
            $pdf->encabezado('Historial de Ventas');
            $pdf->get_venta($header, $db->get_sales());
        }
        break;
}
$pdf->Output("d");
