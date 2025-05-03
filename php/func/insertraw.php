<?php
    include '../connection.php';
    $nameraw = $_POST['nameraw'];
    $rawprice = $_POST['rawprice'];
    $quan =0;
    $status="Out of Stock";
    $sql = "INSERT INTO raw (name, price, quantity, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameraw, $rawprice, $quan , $status]);
?>