<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');
requireAdmin($pdo);

$stmt = $pdo->query(
    "SELECT sa.*, u.name AS student_name, u.email AS student_email,
            s.name AS scholarship_name, s.university_id, un.name AS university_name
     FROM scholarship_applications sa
     JOIN users u        ON sa.user_id        = u.id
     JOIN scholarships s ON sa.scholarship_id = s.id
     JOIN universities un ON s.university_id  = un.id
     ORDER BY sa.applied_at DESC"
);
echo json_encode($stmt->fetchAll());
?>