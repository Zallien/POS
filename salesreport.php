<?php
header('Content-Type: text/html; charset=utf-8');
include "./library/tcpdf.php";
include 'php/connection.php';

$stmtWeeklySales = $conn->prepare("SELECT
    DATE(t.Date) AS sale_date,
    pname,
    SUM(quantity) AS total_quantity_sold,
    SUM(total) AS total_sales
FROM
    transactions t
WHERE
    t.Date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)
GROUP BY
    DATE(t.Date),
    pname
ORDER BY
    DATE(t.Date),
    pname");
$stmtWeeklySales->execute();
$weeklySalesData = $stmtWeeklySales->fetchAll(PDO::FETCH_ASSOC);
//size ng papel
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetTitle('Weekly Sales Report');
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 9);
//picture ng logo
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
$pdf->Cell(0, 10, 'Weekly Sales Report', 0, 1, 'C');
$pdf->SetFont('dejavusans', '', 9);
$pdf->Ln(5);
$startDate = date('Y-m-d', strtotime('-1 week'));
$endDate = date('Y-m-d');
$pdf->Cell(0, 5, 'From: ' . $startDate . ' To: ' . $endDate, 0, 1, 'C');
$pdf->Ln(5);
$tableWidth = 180;
$colWidthDate = 30;
$colWidthProduct = 80;
$colWidthQty = 30;
$colWidthSales = 40;
$currentX = (210 - $tableWidth) / 2;
$pdf->SetX($currentX);

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->Cell($colWidthDate, 7, 'Sale Date', 1, 0, 'C');
$pdf->Cell($colWidthProduct, 7, 'Product Name', 1, 0, 'C');
$pdf->Cell($colWidthQty, 7, 'Quantity Sold', 1, 0, 'C');
$pdf->Cell($colWidthSales, 7, 'Total Sales', 1, 1, 'C');
$pdf->SetFont('dejavusans', '', 9);
$pdf->SetX($currentX);

$currentDate = null;
$totalWeeklySales = 0;

foreach ($weeklySalesData as $row) {
    if ($row['sale_date'] !== $currentDate) {
        if ($currentDate !== null) {
            $pdf->Ln(2);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(2);
        }
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(0, 6, 'Date: ' . $row['sale_date'], 0, 1, 'L'); 
        $pdf->SetFont('dejavusans', '', 9);
        $currentDate = $row['sale_date'];
        $pdf->SetX($currentX);
    }

    $pdf->Cell($colWidthDate, 6, '', 0, 0, 'L');
    $pdf->Cell($colWidthProduct, 6, $row['pname'], 1, 0, 'L');
    $pdf->Cell($colWidthQty, 6, $row['total_quantity_sold'], 1, 0, 'C');
    $pdf->Cell($colWidthSales, 6,  '₱'. number_format($row['total_sales'], 2), 1, 1, 'R');
    $pdf->SetX($currentX); 
    $totalWeeklySales += $row['total_sales'];
}
if (!empty($weeklySalesData)) {
        $pdf->Ln(5);
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->SetX($currentX);
        $pdf->Cell($tableWidth - $colWidthSales, 7, 'Total Weekly Sales:', 0, 0, 'R');
        $pdf->Cell($colWidthSales, 7,  "₱". number_format($totalWeeklySales, 2), 0, 1, 'R');
    }
$pdf->Output('weekly_sales_report.pdf', 'I');
?>