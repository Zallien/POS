<?php
    include '../connection.php';
    $idproduct = $_GET['idproduct'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idproduct]);
?>