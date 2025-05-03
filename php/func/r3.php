<?php
    include '../connection.php';
    $sql = "SELECT * FROM transactions ORDER BY date DESC";
    $stmt = $conn->query($sql);
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows) {
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td style='width:10%;'>" . $row['transaction_no'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['pname'] . "</td>";
                echo "<td style='width:10%;'>₱" . $row['price'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['quantity'] . "</td>";
                echo "<td  style='width:10%;'>₱" . $row['total'] . "</td>";
                echo "<td style='width:10%;'>₱" . $row['payment'] . "</td>";
                echo "<td  style='width:10%;'>₱" . $row['sukli'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['date'] . "</td>";
                echo "</tr>";
            } }else{
                echo "<tr><td colspan='8'>No Record found.</td></tr>";
            }
        } else {
            echo "Error: " . $conn->errorInfo();
        }
    ?>