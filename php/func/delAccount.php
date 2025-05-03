<?php
    include '../connection.php';

    $iduser = $_GET['iduser'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$iduser]);
?>