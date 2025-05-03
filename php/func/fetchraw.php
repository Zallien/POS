<?php
    include '../connection.php';
    $idraw = $_GET['idraw'];
    $sql = "SELECT * FROM raw WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idraw]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
?>