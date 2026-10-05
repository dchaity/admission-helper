<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

$user_id = (int)$_SESSION['user_id'];
$stmt = $pdo->prepare(
    "SELECT b.*, u.name AS university_name, u.type
     FROM bookmarks b
     JOIN universities u ON b.university_id = u.id
     WHERE b.user_id = ? ORDER BY b.created_at DESC"
);
$stmt->execute([$user_id]);
echo json_encode($stmt->fetchAll());
?>