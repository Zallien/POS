<?php
    include 'connection.php';
    $username = $_POST['username'];
    $newpass = $_POST['newpassword'];
try {
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $hashedPassword = password_hash($newpass, PASSWORD_DEFAULT);
    $stmt->execute([$hashedPassword, $username]);
    echo "Update successful.";
} catch (PDOException $e) {
    echo "Update failed: " . $e->getMessage();
}
?>