<?php
    include '../connection.php';
    $idraw = $_POST['idraw'];
    $nameraw = $_POST['nameraw'];
    $rawprice = $_POST['rawprice'];
try {
    $sql = "UPDATE raw SET name = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameraw, $rawprice, $idraw]);

    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>