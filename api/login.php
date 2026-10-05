<?php
require_once 'config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['error'=>'Method not allowed']); exit;
}

$data     = json_decode(file_get_contents('php://input'), true) ?? [];
$email    = trim($data['email']    ?? '');
$password = $data['password']      ?? '';

if ($email === '' || $password === '') {
    http_response_code(400); echo json_encode(['error'=>'Email and password required']); exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['id'];
    unset($user['password']);
    echo json_encode(['success'=>true,'user'=>$user]);
} else {
    http_response_code(401); echo json_encode(['error'=>'Invalid email or password']);
}
?>