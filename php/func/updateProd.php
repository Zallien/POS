<?php
    include '../connection.php';
    $idproduct = $_POST['idproduct'];
    $nameproduct = $_POST['nameproduct'];
    $productcode = $_POST['productcode'];
    $productprice = $_POST['productprice'];
try {
    $sql = "UPDATE products SET name = ?, pcode = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameproduct, $productcode, $productprice, $idproduct]);
    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>