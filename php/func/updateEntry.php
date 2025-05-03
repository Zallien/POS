<?php
    include '../connection.php';
    $entryrefer = $_POST['entryrefer'];
    $entryname = $_POST['entryname'];
    $entryid = $_POST['entryid'];
    $entryquan = $_POST['entryquan'];
    $entryprice = $_POST['entryprice'];
    $date = date('Y-m-d H:i:s');
try {
    $sql = "UPDATE raw SET quantity= quantity + ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$entryquan, $entryid]);

    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>