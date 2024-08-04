<?php
header('Content-Type: application/json');
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $name = $input['name'];
    $code = $input['code'];
    $severity = $input['severity'];

    $db = getDbConnection();
    $waitTime = calculateWaitTime($db, $severity);

    $stmt = $db->prepare("INSERT INTO patients (name, code, severity, wait_time) VALUES (:name, :code, :severity, :wait_time)");
    $stmt->execute(['name' => $name, 'code' => $code, 'severity' => $severity, 'wait_time' => $waitTime]);

    echo json_encode(['success' => true, 'waitTime' => $waitTime]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

function calculateWaitTime($db, $severity) {
    $stmt = $db->query("SELECT SUM(wait_time) AS total_wait FROM patients");
    $result = $stmt->fetch();
    $baseWaitTime = 10;
    $severityMultiplier = 5;

    return $result['total_wait'] + ($severity - 1) * severityMultiplier;
}
?>
