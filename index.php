<?php
header('Content-Type: application/json');
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['username']) && isset($input['password'])) {
            echo json_encode(authenticate($input['username'], $input['password']));
        } elseif (isset($input['name']) && isset($input['code'])) {
            echo json_encode(signInPatient($input['name'], $input['code']));
        }
        break;
    default:
        echo json_encode(['error' => 'Invalid request']);
        break;
}

function authenticate($username, $password) {
    $db = getDbConnection();
    $stmt = $db->prepare('SELECT * FROM admins WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $admin = $stmt->fetch();
    return $admin ? ['success' => true] : ['success' => false];
}

function signInPatient($name, $code) {
    $db = getDbConnection();
    $stmt = $db->prepare('INSERT INTO patients (name, code, arrival_time) VALUES (?, ?, ?)');
    $stmt->execute([$name, $code, time()]);

    $waitTime = calculateWaitTime($db, $name, $code);
    return ['success' => true, 'waitTime' => $waitTime];
}

function calculateWaitTime($db, $name, $code) {
    $stmt = $db->prepare('SELECT COUNT(*) FROM patients WHERE arrival_time < (SELECT arrival_time FROM patients WHERE name = ? AND code = ?)');
    $stmt->execute([$name, $code]);
    $position = $stmt->fetchColumn();
    return ($position + 1) * 10; // Approximate 10 minutes per patient
}
