<?php
    include '../connection.php';
    $entryrefer = $_POST['entryrefer'];
    $entryname = $_POST['entryname'];
    $entryid = $_POST['entryid'];
    $entryquan = $_POST['entryquan'];
    $entryprice = $_POST['entryprice'];
    $date = date('Y-m-d H:i:s');
    $total= $entryprice * $entryquan;
try {
    $sql = "INSERT INTO entries (reference_no, itemname, itemid, quantity, price, date, total) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$entryrefer, $entryname, $entryid, $entryquan, $entryprice, $date, $total]);
    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>