<?php
/**
 * Categories API Endpoint
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../config.php';

$db = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $category = $db->fetchOne("SELECT * FROM categories WHERE id = ?", [$_GET['id']]);
        echo json_encode(['success' => true, 'data' => $category]);
    } else {
        $categories = $db->fetchAll("SELECT * FROM categories WHERE is_active = 1 ORDER BY sort_order");
        echo json_encode(['success' => true, 'data' => $categories]);
    }
}