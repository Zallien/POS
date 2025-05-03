<?php
include "./library/tcpdf.php";
include 'php/connection.php';

$stmtStockEntries = $conn->prepare("SELECT
    date,
    itemname,
    quantity,
    price,
    total
FROM
    entries
WHERE
    date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
ORDER BY
    date,
    itemname");
$stmtStockEntries->execute();
$stockEntriesData = $stmtStockEntries->fetchAll(PDO::FETCH_ASSOC);

$totalQuantity = 0;
$totalPrice = 0;
foreach ($stockEntriesData as $row) {
    $totalQuantity += $row['quantity'];
    $totalPrice += ($row['quantity'] * $row['price']);
}
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetTitle('Monthly Stock Entry Report');
$pdf->AddPage();

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
$pdf->Cell(0, 10, 'Monthly Stock Entry Report', 0, 1, 'C');
$pdf->SetFont('dejavusans', '', 9);
$pdf->Ln(5);
$startDate = date('Y-m-d', strtotime('-1 month'));
$endDate = date('Y-m-d');
$pdf->Cell(0, 5, 'From: ' . $startDate . ' To: ' . $endDate, 0, 1, 'C');
$pdf->Ln(5);


$tableWidth = 170;
$colWidthDate = 32;
$colWidthItem = 78;
$colWidthQty = 25;
$colWidthPrice = 35;
$currentX = (210 - $tableWidth) / 2;
$pdf->SetX($currentX);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell($colWidthDate, 7, 'Entry Date', 1, 0, 'C');
$pdf->Cell($colWidthItem, 7, 'Item Name', 1, 0, 'C');
$pdf->Cell($colWidthQty, 7, 'Qty(kg)', 1, 0, 'C');
$pdf->Cell($colWidthPrice, 7, 'Price', 1, 1, 'C');
$pdf->SetFont('dejavusans', '', 8);
$pdf->SetX($currentX);
$currentDate = null;
foreach ($stockEntriesData as $row) {

    $pdf->Cell($colWidthDate, 6, $row['date'], 1, 0, 'L');
    $pdf->Cell($colWidthItem, 6, $row['itemname'], 1, 0, 'L');
    $pdf->Cell($colWidthQty, 6, $row['quantity'] ."kg", 1, 0, 'C');
    $pdf->Cell($colWidthPrice, 6,"₱". number_format($row['total'], 2), 1, 1, 'R');
    $pdf->SetX($currentX);
}
$pdf->Ln(10);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->SetX($currentX);
$pdf->Cell(140, 7, 'Total Price:', 0, 0, 'R');
$pdf->Cell(30, 7,"₱". number_format($totalPrice, 2), 0, 1, 'R');
$pdf->Output('monthly_stock_entry_report.pdf', 'I');
?>