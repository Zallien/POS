<?php
    include '../connection.php';
    $sql = "SELECT * FROM entries WHERE date BETWEEN :start_date AND :end_date ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    // Validate and format the input dates to match 'Y-m-d H:i:s' format
    $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['start_date']) ?: DateTime::createFromFormat('Y-m-d', $_GET['start_date']);
    $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['end_date']) ?: DateTime::createFromFormat('Y-m-d', $_GET['end_date']);

    if ($start_date && $end_date) {
        $formatted_start_date = $start_date->format('Y-m-d H:i:s');
        $formatted_end_date = $end_date->format('Y-m-d H:i:s');
        $stmt->bindParam(':start_date', $formatted_start_date);
        $stmt->bindParam(':end_date', $formatted_end_date);
    } else {
        echo "Invalid date format provided.";
        exit;
    }
    // if the date from the data base is setted in this format date('Y-m-d H:i:s'), how to set the date in the same format in the input field?
    $stmt->execute();
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