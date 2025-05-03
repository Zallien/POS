<?php
include "./library/tcpdf.php";
include 'php/connection.php';

$stmtInventory = $conn->prepare("SELECT
    name,
    price,
    quantity,
    status
FROM
    raw
ORDER BY
    name");
$stmtInventory->execute();
$inventoryData = $stmtInventory->fetchAll(PDO::FETCH_ASSOC);


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetTitle('Inventory Report');
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 9);
$imageFile = 'images/your_company_logo.png';
$imageWidth = 40;
$imageHeight = 0;
$xPositionLogo = 10;
$yPositionLogo = 10;

// header
$imageFile = './media/log.jpg'; 
$imageWidth = 30;
$imageHeight = 0;
$xPositionLogo = 15;
$yPositionLogo = 5;
$pdf->Image($imageFile, $xPositionLogo, $yPositionLogo, $imageWidth, $imageHeight, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);
$pdf->SetFont('dejavusans', 'B', 16);
$companyNameX = $xPositionLogo + $imageWidth + 45;
$companyNameY = $yPositionLogo + ($imageHeight / 2) +10;
$pdf->SetXY($companyNameX, $companyNameY);
$pdf->Cell(0, 0, "Daza's Best", 0, 1, 'L');
$pdf->SetFont('dejavusans', '', 9);
$pdf->SetY($yPositionLogo + $imageHeight + 15);
$pdf->SetFont('dejavusans', 'B', 14);
$pdf->Cell(0, 10, 'Inventory Report', 0, 1, 'C');
$pdf->SetFont('dejavusans', '', 9);
$pdf->Ln(5);
$reportDate = date('Y-m-d H:i:s');
$pdf->Cell(0, 5, 'Report Generated on: ' . $reportDate, 0, 1, 'C');
$pdf->Ln(5);

// table
$tableWidth = 150;
$colWidthName = 60;
$colWidthPrice = 30;
$colWidthQty = 30;
$colWidthStatus = 30;
$currentX = (210 - $tableWidth) / 2;
$pdf->SetX($currentX);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->Cell($colWidthName, 7, 'Item Name', 1, 0, 'C');
$pdf->Cell($colWidthPrice, 7, 'Price', 1, 0, 'C');
$pdf->Cell($colWidthQty, 7, 'Quantity', 1, 0, 'C');
$pdf->Cell($colWidthStatus, 7, 'Status', 1, 1, 'C');
$pdf->SetFont('dejavusans', '', 9);
$pdf->SetX($currentX);
foreach ($inventoryData as $row) {
    $pdf->Cell($colWidthName, 6, $row['name'], 1, 0, 'L');
    $pdf->Cell($colWidthPrice, 6, "₱". number_format($row['price'], 2), 1, 0, 'R');
    $pdf->Cell($colWidthQty, 6, $row['quantity'] . '(kg)', 1, 0, 'C');
    $pdf->Cell($colWidthStatus, 6, $row['status'], 1, 1, 'C');
    $pdf->SetX($currentX);
}
$pdf->Output('inventory_report.pdf', 'I');
?>