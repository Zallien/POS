<?php
    include '../connection.php';
    $nameusers = $_POST['nameusers'];
    $contactusers = $_POST['contactusers'];
    $usernameusers = $_POST['usernameusers'];
    $passwordusers = password_hash($_POST['passwordusers'], PASSWORD_DEFAULT); 
    $positionusers = $_POST['positionusers']; 
    $sql = "INSERT INTO users (name, username, password, contact_no, position) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameusers, $usernameusers, $passwordusers, $contactusers, $positionusers]);
?>