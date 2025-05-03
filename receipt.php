<?php
include "./library/tcpdf.php";
include 'php/connection.php';


$transactionNo = $_GET['transaction_no'];
$stmtHeader = $conn->prepare("SELECT t.transaction_no, t.Date, SUM(t.total) as grand_total, t.payment, t.sukli
                               FROM transactions t
                               WHERE t.transaction_no = ?
                               GROUP BY t.transaction_no, t.Date, t.payment, t.sukli");
$stmtHeader->execute([$transactionNo]);
$headerData = $stmtHeader->fetch(PDO::FETCH_ASSOC);
$stmtItems = $conn->prepare("SELECT pname, price, quantity, total
                              FROM transactions
                              WHERE transaction_no = ?");
$stmtItems->execute([$transactionNo]);
$itemsData = $stmtItems->fetchAll(PDO::FETCH_ASSOC);


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', array(80, 297), true, 'UTF-8', false);
$pdf->SetMargins(5, 5, 5);
$pdf->SetAutoPageBreak(false, 5);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetTitle('Receipt - ' . $headerData['transaction_no']);
$pdf->AddPage();
$pdf->SetFont('dejavusans', '', 10);
$imageFile = './media/log.jpg'; 
$imageWidth = 40;
$imageHeight = 0;
$xPosition = (80 - $imageWidth) / 2;
$yPosition = $pdf->GetY() + 2;
if (file_exists($imageFile)) {
    $pdf->Image($imageFile, $xPosition, $yPosition, $imageWidth, $imageHeight, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);
    $pdf->Ln(42);
} else {
    $pdf->Cell(70, 5, "Daza's Best", 0, 1, 'C');
}


if (!file_exists($imageFile)) {
    $pdf->Cell(70, 5, "Ging2's Bakery & Eatery, 102 Vista Verde Ave. Caloocan City", 0, 1, 'C');
} else {
    $pdf->Cell(70, 5, "Daza's Best", 0, 1, 'C', 0, 1, '', '', true, 'T', 'M');
    $pdf->Cell(70, 5, "Ging2's Bakery & Eatery,", 0, 1, 'C', 0, 1, '', '', true, 'T', 'M');
    $pdf->Cell(70, 5, "102 Vista Verde Ave. Caloocan City", 0, 1, 'C', 0, 1, '', '', true, 'T', 'M');
}
$pdf->Ln(5);
$pdf->Cell(70, 5, 'Transaction No: ' . $headerData['transaction_no'], 0, 1, 'L');
$pdf->Cell(70, 5, 'Date: ' . date('Y-m-d H:i:s', strtotime($headerData['Date'])), 0, 1, 'L');
$pdf->Ln(3);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);
$pdf->Cell(30, 5, 'Product', 0, 0, 'L');
$pdf->Cell(10, 5, 'Qty', 0, 0, 'C');
$pdf->Cell(15, 5, 'Price', 0, 0, 'R');
$pdf->Cell(15, 5, 'Total', 0, 1, 'R');
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());

foreach ($itemsData as $item) {
    $pdf->Cell(30, 5, $item['pname'], 0, 0, 'L');
    $pdf->Cell(10, 5, $item['quantity'], 0, 0, 'C');
    $pdf->Cell(15, 5,"₱".   number_format($item['price'], 2), 0, 0, 'R');
    $pdf->Cell(15, 5,"₱".   number_format($item['total'], 2), 0, 1, 'R');
}
$pdf->Ln(2);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);
$pdf->Cell(55, 5, 'Grand Total:', 0, 0, 'R');
$pdf->Cell(15, 5,"₱".   number_format($headerData['grand_total'], 2), 0, 1, 'R');
$pdf->Cell(55, 5, 'Payment:', 0, 0, 'R');
$pdf->Cell(15, 5,"₱".   number_format($headerData['payment'], 2), 0, 1, 'R');
$pdf->Cell(55, 5, 'Change:', 0, 0, 'R');
$pdf->Cell(15, 5,"₱".   number_format($headerData['sukli'], 2), 0, 1, 'R');
$pdf->Ln(5);
$pdf->Cell(70, 5, 'Thank you for your purchase!', 0, 1, 'C');
$pdf->Cell(70, 5, 'Come back Again!', 0, 1, 'C');
$pdf->Output('receipt_' . $headerData['transaction_no'] . '.pdf', 'I');
?>