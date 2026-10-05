<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

$user_id = (int)$_SESSION['user_id'];
$user    = getCurrentUser($pdo);

$sql = "SELECT COUNT(*) AS eligible FROM universities WHERE min_ssc_gpa <= ? AND min_hsc_gpa <= ?";
$params = [$user['ssc_gpa'], $user['hsc_gpa']];
if (!empty($user['academic_group'])) {
    $sql .= " AND (required_group IS NULL OR required_group = ?)";
    $params[] = $user['academic_group'];
}
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$eligible = (int)($stmt->fetch()['eligible'] ?? 0);

$stmt = $pdo->prepare("SELECT COUNT(*) AS bm FROM bookmarks WHERE user_id = ?");
$stmt->execute([$user_id]);
$bookmarks = (int)($stmt->fetch()['bm'] ?? 0);

echo json_encode(['eligible'=>$eligible,'bookmarks'=>$bookmarks]);
?>