<?php
include "./library/tcpdf.php";
include 'php/connection.php';

$startDate = date('Y-m-d', strtotime('-1 month'));
$endDate = date('Y-m-d');

$stmtAdjustments = $conn->prepare("SELECT
    reference_no,
    itemname,
    itemprice,
    quantity,
    reason,
    total,
    date
FROM
    adjustment
WHERE
    date >= :startDate AND date <= :endDate
ORDER BY
    date,
    itemname");
$stmtAdjustments->bindParam(':startDate', $startDate);
$stmtAdjustments->bindParam(':endDate', $endDate);
$stmtAdjustments->execute();
$adjustmentData = $stmtAdjustments->fetchAll(PDO::FETCH_ASSOC);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetTitle('Stock Adjustment Report');
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 9);
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
$pdf->Cell(0, 10, 'Monthly Stock Adjustment Report', 0, 1, 'C');
$pdf->SetFont('dejavusans', '', 9);
$pdf->Ln(5);
$pdf->Cell(0, 5, 'From: ' . $startDate . ' To: ' . $endDate, 0, 1, 'C');
$pdf->Ln(5);


$tableWidth = 190;
$colWidthRef = 35;
$colWidthItem = 20;
$colWidthPrice = 20;
$colWidthQty = 25;
$colWidthReason = 40;
$colWidthTotal = 18;
$currentX = (210 - $tableWidth) / 2;
$pdf->SetX($currentX);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->Cell($colWidthRef, 7, 'Reference No', 1, 0, 'C');
$pdf->Cell($colWidthItem, 7, 'Item Name', 1, 0, 'C');
$pdf->Cell($colWidthPrice, 7, 'Item Price', 1, 0, 'C');
$pdf->Cell($colWidthQty, 7, 'Quantity', 1, 0, 'C');
$pdf->Cell($colWidthReason, 7, 'Reason', 1, 0, 'C');
$pdf->Cell($colWidthTotal, 7, 'Total', 1, 0, 'C');
$pdf->Cell(30, 7, 'Date', 1, 1, 'C');
$pdf->SetFont('dejavusans', '', 8);
$pdf->SetX($currentX);
foreach ($adjustmentData as $row) {
    $pdf->Cell($colWidthRef, 6, $row['reference_no'], 1, 0, 'L');
    $pdf->Cell($colWidthItem, 6, $row['itemname'], 1, 0, 'L');
    $pdf->Cell($colWidthPrice, 6,"₱".  number_format($row['itemprice'], 2), 1, 0, 'R');
    $pdf->Cell($colWidthQty, 6, $row['quantity'] ."kg", 1, 0, 'C');
    $pdf->Cell($colWidthReason, 6, $row['reason'], 1, 0, 'L');
    $pdf->Cell($colWidthTotal, 6,"₱".  number_format($row['total'], 2), 1, 0, 'R');
    $pdf->Cell(30, 6, date('Y-m-d H:i:s', strtotime($row['date'])), 1, 1, 'C');
    $pdf->SetX($currentX);
}
$pdf->Output('stock_adjustment_report.pdf', 'I');
?>