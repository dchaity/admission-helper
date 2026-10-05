<?php
require_once 'config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['error'=>'Method not allowed']); exit;
}

$data     = json_decode(file_get_contents('php://input'), true) ?? [];
$name     = trim($data['name']     ?? '');
$email    = trim($data['email']    ?? '');
$phone    = trim($data['phone']    ?? '');
$password = $data['password']      ?? '';
$sscGPA   = $data['sscGPA']        ?? null;
$hscGPA   = $data['hscGPA']        ?? null;
$group    = $data['group']         ?? '';

if ($sscGPA === null || $hscGPA === null || $sscGPA > 5 || $hscGPA > 5 || $sscGPA < 0 || $hscGPA < 0) {
    http_response_code(400); echo json_encode(['error'=>'GPA must be between 0 and 5.00']); exit;
}
if ($name === '' || $email === '' || $password === '' || $group === '') {
    http_response_code(400); echo json_encode(['error'=>'All fields are required']); exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); echo json_encode(['error'=>'Invalid email address']); exit;
}
if (strlen($password) < 6) {
    http_response_code(400); echo json_encode(['error'=>'Password must be at least 6 characters']); exit;
}
if (!in_array($group, ['science','commerce','arts'], true)) {
    http_response_code(400); echo json_encode(['error'=>'Invalid academic group']); exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(409); echo json_encode(['error'=>'Email already registered']); exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$ip     = $_SERVER['REMOTE_ADDR'] ?? '';

$stmt = $pdo->prepare(
    "INSERT INTO users (name,email,phone,password,ssc_gpa,hsc_gpa,academic_group,ip_address,user_type)
     VALUES (?,?,?,?,?,?,?,?, 'student')"
);
$ok = $stmt->execute([$name,$email,$phone,$hashed,$sscGPA,$hscGPA,$group,$ip]);

echo json_encode($ok ? ['success'=>true,'message'=>'Registration successful']
                     : ['error'=>'Registration failed']);
?>