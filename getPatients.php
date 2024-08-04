<?php
header('Content-Type: application/json');
require 'db.php';

$db = getDbConnection();
$stmt = $db->query("SELECT * FROM patients ORDER BY severity DESC, wait_time ASC");
$patients = $stmt->fetchAll();

echo json_encode($patients);
?>
