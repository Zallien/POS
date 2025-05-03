<?php
    include '../connection.php';
    $nameproduct = $_POST['nameproduct'];
    $productcode = $_POST['productcode'];
    $productprice = $_POST['productprice'];
    $sql = "INSERT INTO products (name, pcode, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameproduct, $productcode, $productprice]);
?>