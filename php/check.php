<?php session_start();
header('Content-Type: application/json');

include 'connection.php';
error_reporting(E_ALL);
    ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $pass = $user['password'];
        if($pass===null){
            $pass = "nothing";
        }
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['position'];
            $response = ['success' => true, 'message' => 'Login successful.', 'name' => $user['name'], 'type' => $user['position']];
        } else {
            $response = ['success' => false, 'message' => 'Invalid username or password.'];
        }
    } catch (PDOException $e) {
        $response = ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        error_log("PDO Exception: " . $e->getMessage());
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => 'General error: ' . $e->getMessage()];
        error_log("General Exception: " . $e->getMessage());
    }

    error_log(print_r($response, true));
    $json_response = json_encode($response);
    error_log("JSON Encode Error: ".json_last_error()); 
    echo $json_response;
} else {
    $response = ['success' => false, 'message' => 'Invalid request.'];
    error_log(print_r($response, true));
    echo json_encode($response);
}
?>