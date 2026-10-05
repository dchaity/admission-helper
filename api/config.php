<?php
session_start();

// ⚠️ CHANGE THESE VALUES to your real credentials on your server.
// For GitHub, keep the placeholders below.

$host     = 'sql304.infinityfree.com';
$dbname   = 'if0_41164503_admission_helper';
$username = 'if0_41164503';
$password = 'YOUR_DB_PASSWORD_HERE';   // ← never commit the real password
$port     = 3306;

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    error_log('DB Error: ' . $e->getMessage());
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

function isLoggedIn(): bool { return isset($_SESSION['user_id']); }

function requireLogin(): void {
    if (!isLoggedIn()) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Unauthorized. Please login.']);
        exit;
    }
}

function requireAdmin(PDO $pdo): void {
    requireLogin();
    $stmt = $pdo->prepare("SELECT user_type FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $row = $stmt->fetch();
    if (!$row || $row['user_type'] !== 'admin') {
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Forbidden. Admin access required.']);
        exit;
    }
}

function getCurrentUser(PDO $pdo) {
    $stmt = $pdo->prepare(
        "SELECT id, name, email, phone, ssc_gpa, hsc_gpa, academic_group, user_type
         FROM users WHERE id = ?"
    );
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
?>