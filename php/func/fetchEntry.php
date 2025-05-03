<?php
    include '../connection.php';
    $entryid = $_GET['entryid'];
    $sql = "SELECT * FROM raw WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$entryid]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
?>