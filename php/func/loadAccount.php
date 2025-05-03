<?php
    include '../connection.php';
    $sql = "SELECT * FROM users";
    $stmt = $conn->query($sql);
    if ($stmt) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows) {
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td style='width:10%;'>" . $row['name'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['position'] . "</td>";
                echo "<td  style='width:10%;'>" . $row['contact_no'] . "</td>";
                echo "<td style='width:5%;text-align:center;'><button style='width:2dvw; height: 5dvh;'  onclick='editUser(" . $row['id'] . ")'>✎</button> <button style='width:3dvw; height: 5dvh;' onclick='deleteUser(" . $row['id'] . ")'>🗑️</button></td>";
                echo "</tr>";
            } }else{
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
        } else {
            echo "Error: " . $conn->errorInfo();
        }
    ?>