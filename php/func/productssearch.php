<?php
    include '../connection.php';
    header('Content-Type: application/json');
    $searchQuery = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :query OR pcode LIKE :query");
    $stmt->execute(['query' => '%' . $searchQuery . '%']);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($products);
    ?>