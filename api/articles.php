<?php
/**
 * Articles API Endpoint
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

require_once __DIR__ . '/../config.php';

$db = Database::getInstance();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $article = $db->fetchOne("SELECT * FROM articles WHERE id = ?", [$_GET['id']]);
            echo json_encode(['success' => true, 'data' => $article]);
        } else {
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
            $articles = $db->fetchAll(
                "SELECT * FROM articles WHERE status = 'published' ORDER BY published_at DESC LIMIT ? OFFSET ?",
                [$limit, $offset]
            );
            echo json_encode(['success' => true, 'data' => $articles]);
        }
        break;

    case 'POST':
        require_admin();
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            $slug = create_slug($data['title']);
            $id = $db->insert('articles', [
                'title' => $data['title'],
                'slug' => $slug,
                'content' => $data['content'],
                'excerpt' => $data['excerpt'] ?? '',
                'author_id' => $_SESSION['user_id'],
                'category_id' => $data['category_id'],
                'status' => $data['status'] ?? 'draft'
            ]);
            echo json_encode(['success' => true, 'data' => ['id' => $id]]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Method not allowed']);
}