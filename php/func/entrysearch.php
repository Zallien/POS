<?php
    include '../connection.php';
    header('Content-Type: application/json');
    $searchQuery = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM raw WHERE name LIKE :query OR id LIKE :query");
    $stmt->execute(['query' => '%' . $searchQuery . '%']);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($products);
    ?>