<?php
    include '../connection.php';
    $iduser = $_POST['iduser'];
    $nameusers = $_POST['nameusers'];
    $contactusers = $_POST['contactusers'];
    $usernameusers = $_POST['usernameusers'];
    $passwordusers = password_hash($_POST['passwordusers'], PASSWORD_DEFAULT); 
    $positionusers = $_POST['positionusers']; 
try {
    $sql = "UPDATE users SET name = ?, username = ?, password = ?, contact_no = ?, position = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameusers, $usernameusers, $passwordusers, $contactusers, $positionusers, $iduser]);

    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>