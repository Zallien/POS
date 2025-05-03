<?php
    include '../connection.php';
    try {
        if ($_GET['action'] === 'getRowCount') {
            $stmt = $conn->query("SELECT COUNT(*) as rowCount FROM transactions");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'rowCount' => $row['rowCount']]);
        } elseif ($_GET['action'] === 'saveTransaction') {
            $data = json_decode(file_get_contents('php://input'), true);
    
            if ($data) {
                foreach ($data as $item) {
                    $transactionNo = $item['transaction_no'];
                    $pname = $item['pname'];
                    $price = $item['price'];
                    $quantity = $item['quantity'];
                    $total = $item['total'];
                    $payment = $item['payment'];
                    $change = $item['change'];
                    $date = date('Y-m-d H:i:s');
    
                    $sql = "INSERT INTO transactions (transaction_no, pname, price, quantity, total, payment, sukli, Date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$transactionNo, $pname, $price, $quantity, $total, $payment, $change, $date]);
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No data received']);
            }
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
?>
