<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');
requireAdmin($pdo);

$stmt = $pdo->query(
    "SELECT id,name,email,phone,ssc_gpa,hsc_gpa,academic_group,ip_address,created_at
     FROM users WHERE user_type='student' ORDER BY created_at DESC"
);
echo json_encode($stmt->fetchAll());
?>