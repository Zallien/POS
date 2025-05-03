<?php
    include '../connection.php';
    $adjustcode = $_GET['adjustcode'];
    $sql = "SELECT * FROM raw WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$adjustcode]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
?>