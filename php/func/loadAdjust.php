<?php
    include '../connection.php';
    $sql = "SELECT * FROM raw where quantity>0";
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
                echo "<td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editAd(" . $row['id'] . ")'>≫</button></td>";
                echo "</tr>";
            } }else{
                echo "<tr><td colspan='6'>No users found.</td></tr>";
            }
        } else {
            echo "Error: " . $conn->errorInfo();
        }
    ?>