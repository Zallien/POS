<?php
    include '../connection.php';
    $sql = "SELECT * FROM entries ORDER BY date DESC";
    $stmt = $conn->query($sql);
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows) {
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td style='width:10%;'>" . $row['reference_no'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['itemname'] . "</td>";
                echo "<td style='width:10%;'>" . $row['itemid'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['quantity'] . "</td>";
                echo "<td  style='width:10%;'>₱" . $row['price'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['date'] . "</td>";
                echo "<td  style='width:10%;'>₱" . $row['total'] . "</td>";
                echo "</tr>";
            } }else{
                echo "<tr><td colspan='7'>No Record found.</td></tr>";
            }
        } else {
            echo "Error: " . $conn->errorInfo();
        }
    ?>