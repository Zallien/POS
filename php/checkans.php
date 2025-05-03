<?php
    include 'connection.php';
    $name = $_POST['username'];
    $ans1 = $_POST['ans1'];
    $ans2 = $_POST['ans2'];
    $ans3 = $_POST['ans3'];

    try{
        $sql = "SELECT * FROM users WHERE username = ? AND answer_1 = ? AND answer_2 = ? AND answer_3 = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $ans1, $ans2, $ans3]); 
        if ($stmt->rowCount() > 0) {
            echo "Account verified.";
        } else {
            echo "Account not verified.";
        }
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
?>