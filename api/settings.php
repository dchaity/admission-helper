<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['error'=>'Method not allowed']); exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$current = $data['current_password'] ?? '';
$new     = $data['new_password'] ?? '';

if ($current === '' || $new === '') { http_response_code(400); echo json_encode(['error'=>'All fields required']); exit; }
if (strlen($new) < 6) { http_response_code(400); echo json_encode(['error'=>'New password must be at least 6 characters']); exit; }

$user_id = (int)$_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetch();

if (!$row || !password_verify($current, $row['password'])) {
    http_response_code(401); echo json_encode(['error'=>'Current password is incorrect']); exit;
}

$hashed = password_hash($new, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
$ok = $stmt->execute([$hashed, $user_id]);

echo json_encode($ok ? ['success'=>true] : ['error'=>'Password change failed']);
?>