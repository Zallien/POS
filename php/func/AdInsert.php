<?php
    include '../connection.php';
    $adjustrefer = $_POST['adjustrefer'];
    $adjustname = $_POST['adjustname'];
    $adjustprice = $_POST['adjustprice'];
    $adjustquan = $_POST['adjustquan'];
    $adjustreason = $_POST['adjustreason'];
    $date = date('Y-m-d H:i:s');
    $total= $adjustprice * $adjustquan;
try {
    $sql = "INSERT INTO adjustment (reference_no, itemname, itemprice, quantity, reason, total, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$adjustrefer, $adjustname, $adjustprice, $adjustquan, $adjustreason, $total, $date]);
    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>