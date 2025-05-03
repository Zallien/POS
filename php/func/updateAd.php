<?php
    include '../connection.php';
    $adjustid = $_POST['adjustid'];
    $adjustrefer = $_POST['adjustrefer'];
    $adjustname = $_POST['adjustname'];
    $adjustprice = $_POST['adjustprice'];
    $adjustquan = $_POST['adjustquan'];
    $adjustreason = $_POST['adjustreason'];
try {
    $sql = "UPDATE raw SET quantity= quantity - ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$adjustquan, $adjustid]);

    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>