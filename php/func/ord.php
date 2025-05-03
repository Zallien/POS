<?php
include '../connection.php';
header('Content-Type: application/json');
try {
    $sql = "SELECT COUNT(*) as row_count FROM transactions";
    $stmt = $conn->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(['success' => true, 'count' => $result['row_count']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Could not retrieve row count']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
}
?>