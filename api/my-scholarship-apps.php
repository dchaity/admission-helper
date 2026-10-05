<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

$user_id = (int)$_SESSION['user_id'];
$stmt = $pdo->prepare(
    "SELECT sa.*, s.name AS scholarship_name, s.university_id, u.name AS university_name
     FROM scholarship_applications sa
     JOIN scholarships s ON sa.scholarship_id = s.id
     JOIN universities u ON s.university_id   = u.id
     WHERE sa.user_id = ? ORDER BY sa.applied_at DESC"
);
$stmt->execute([$user_id]);
echo json_encode($stmt->fetchAll());
?>