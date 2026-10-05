<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');
requireAdmin($pdo);

$students = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE user_type='student'")->fetchColumn();
$apps     = (int)$pdo->query("SELECT COUNT(*) FROM scholarship_applications")->fetchColumn();

echo json_encode(['students'=>$students,'scholarship_apps'=>$apps]);
?>