<?php
    include '../connection.php';
    $idraw = $_GET['idraw'];
    $sql = "DELETE FROM raw WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idraw]);
?>