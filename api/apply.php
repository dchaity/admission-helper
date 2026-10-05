<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['error'=>'Method not allowed']); exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$scholarship_id = (int)($data['scholarship_id'] ?? 0);
if (!$scholarship_id) { http_response_code(400); echo json_encode(['error'=>'Scholarship ID required']); exit; }

$user_id = (int)$_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT id FROM scholarship_applications WHERE user_id = ? AND scholarship_id = ?");
$stmt->execute([$user_id, $scholarship_id]);
if ($stmt->fetch()) { echo json_encode(['success'=>false,'message'=>'Already applied']); exit; }

$stmt = $pdo->prepare("INSERT INTO scholarship_applications (user_id, scholarship_id) VALUES (?, ?)");
$ok = $stmt->execute([$user_id, $scholarship_id]);

echo json_encode($ok ? ['success'=>true,'message'=>'Application submitted']
                     : ['error'=>'Application failed']);
?>