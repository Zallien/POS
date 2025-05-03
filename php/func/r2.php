<?php
    include '../connection.php';
    $sql = "SELECT * FROM raw";
    $stmt = $conn->query($sql);
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows) {
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td style='width:10%;'>" . $row['id'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['name'] . "</td>";
                echo "<td style='width:10%;'>₱" . $row['price'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['quantity'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['status'] . "</td>";
                echo "</tr>";
            } }else{
                echo "<tr><td colspan='5'>No Record found.</td></tr>";
            }
        } else {
            echo "Error: " . $conn->errorInfo();
        }
    ?>