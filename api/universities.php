<?php
require_once 'config.php';
header('Content-Type: application/json');

$type = $_GET['type'] ?? 'all';
$sql = "SELECT * FROM universities";
$params = [];
if ($type === 'public' || $type === 'private') { $sql .= " WHERE type = ?"; $params[] = $type; }
$sql .= " ORDER BY ranking ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
echo json_encode($stmt->fetchAll());
?>