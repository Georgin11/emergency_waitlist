<?php
header('Content-Type: application/json');
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'];
    $password = $input['password'];

    $db = getDbConnection();
    $stmt = $db->prepare("SELECT * FROM admins WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => $password]);
    $admin = $stmt->fetch();

    if ($admin) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
