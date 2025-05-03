<?php
    include '../connection.php';
    $sql = "UPDATE raw
        SET status = CASE
            WHEN quantity = 0 THEN 'Out Of Stock'
            WHEN quantity < 3 AND  quantity > 0 THEN 'Critical'
            WHEN quantity >= 3 AND quantity <= 10 THEN 'Normal'
            WHEN quantity > 10 THEN 'Overstock'
        END";
    $stmt = $conn->query($sql);
    
?>
