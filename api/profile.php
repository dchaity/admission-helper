<?php
require_once 'config.php';
header('Content-Type: application/json');
requireLogin();

$user_id = (int)$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare(
        "SELECT id,name,email,phone,ssc_gpa,hsc_gpa,academic_group,user_type
         FROM users WHERE id = ?"
    );
    $stmt->execute([$user_id]);
    echo json_encode($stmt->fetch()); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $name = trim($data['name'] ?? '');
    $phone = trim($data['phone'] ?? '');
    $ssc = $data['ssc_gpa'] ?? null;
    $hsc = $data['hsc_gpa'] ?? null;
    $grp = $data['academic_group'] ?? '';

    if ($ssc === null || $hsc === null || $ssc > 5 || $hsc > 5 || $ssc < 0 || $hsc < 0) {
        http_response_code(400); echo json_encode(['error'=>'GPA must be between 0 and 5.00']); exit;
    }
    if ($name === '' || !in_array($grp, ['science','commerce','arts'], true)) {
        http_response_code(400); echo json_encode(['error'=>'All fields required']); exit;
    }

    $stmt = $pdo->prepare(
        "UPDATE users SET name=?, phone=?, ssc_gpa=?, hsc_gpa=?, academic_group=? WHERE id=?"
    );
    $ok = $stmt->execute([$name,$phone,$ssc,$hsc,$grp,$user_id]);
    echo json_encode($ok ? ['success'=>true] : ['error'=>'Update failed']); exit;
}

http_response_code(405); echo json_encode(['error'=>'Method not allowed']);
?>