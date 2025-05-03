<?php
    include '../connection.php';
    header('Content-Type: application/json');
    $stmt = $conn->prepare("SELECT DATE(Date) as sale_date, SUM(total) as daily_sales
                            FROM transactions
                            GROUP BY DATE(Date)
                            ORDER BY DATE(Date)");
    $stmt->execute();
    $salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($salesData);
?>