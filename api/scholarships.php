<?php
require_once 'config.php';
header('Content-Type: application/json');

$sql = "SELECT s.*, u.name AS university_name
        FROM scholarships s
        JOIN universities u ON s.university_id = u.id
        ORDER BY s.deadline ASC";
echo json_encode($pdo->query($sql)->fetchAll());
?>