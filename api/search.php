<?php
/**
 * Search API Endpoint
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../config.php';

$db = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = sanitize_input($_GET['q'] ?? '');
    
    if (strlen($query) >= 2) {
        $articles = $db->fetchAll(
            "SELECT * FROM articles WHERE status = 'published' AND (title LIKE ? OR content LIKE ?) LIMIT 20",
            ["%{$query}%", "%{$query}%"]
        );
        echo json_encode(['success' => true, 'data' => $articles]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Query too short']);
    }
}