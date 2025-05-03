<?php
    include '../connection.php';
    $sql = "SELECT pname, SUM(quantity) as total_quantity FROM transactions GROUP BY pname ORDER BY total_quantity ASC LIMIT 3";
    $stmt = $conn->query($sql);
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows) {
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td style='width:90%;'>" . $row['pname'] . "</td>";
                echo "<td style='width:10%;'>" . $row['total_quantity'] . "</td>";
                echo "</tr>";
            } }else{
                echo "<tr><td colspan='2'>No Products found.</td></tr>";
            }
        } else {
            echo "Error: " . $conn->errorInfo();
        }
    ?>