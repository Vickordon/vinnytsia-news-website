<?php
/**
 * Authentication API Endpoint
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? 'login';

$db = Database::getInstance();

if ($action === 'login') {
    $username = sanitize_input($data['username'] ?? '');
    $password = $data['password'] ?? '';

    $user = $db->fetchOne("SELECT * FROM users WHERE username = ? AND is_active = 1", [$username]);

    if ($user && password_verify($password, $user['password_hash'])) {
        echo json_encode([
            'success' => true,
            'data' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
    }
}