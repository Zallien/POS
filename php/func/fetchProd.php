<?php
    include '../connection.php';
    $idproduct = $_GET['idproduct'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idproduct]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
?>