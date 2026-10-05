<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['error'=>'Method not allowed']); exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$university_id = (int)($data['university_id'] ?? 0);
if (!$university_id) { http_response_code(400); echo json_encode(['error'=>'University ID required']); exit; }

$user_id = (int)$_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT id FROM bookmarks WHERE user_id = ? AND university_id = ?");
$stmt->execute([$user_id, $university_id]);
$existing = $stmt->fetch();

if ($existing) {
    $pdo->prepare("DELETE FROM bookmarks WHERE id = ?")->execute([$existing['id']]);
    echo json_encode(['bookmarked'=>false]);
} else {
    $pdo->prepare("INSERT INTO bookmarks (user_id, university_id) VALUES (?, ?)")
        ->execute([$user_id, $university_id]);
    echo json_encode(['bookmarked'=>true]);
}
?>