<?php
/**
 * Admin Dashboard
 */
require_once '../config.php';
require_admin();

$db = Database::getInstance();

// Get statistics
$total_articles = $db->fetchOne("SELECT COUNT(*) as count FROM articles")['count'];
$published_articles = $db->fetchOne("SELECT COUNT(*) as count FROM articles WHERE status = 'published'")['count'];
$total_users = $db->fetchOne("SELECT COUNT(*) as count FROM users")['count'];
$total_comments = $db->fetchOne("SELECT COUNT(*) as count FROM comments")['count'];

// Recent articles
$recent_articles = $db->fetchAll("SELECT * FROM articles ORDER BY created_at DESC LIMIT 5");

$page_title = 'Адмін-панель';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h3>Адмінка</h3>
            </div>
            <nav class="sidebar-nav">
                <a href="/admin/" class="active">📊 Dashboard</a>
                <a href="/admin/articles.php">📰 Статті</a>
                <a href="/admin/categories.php">📁 Категорії</a>
                <a href="/admin/comments.php">💬 Коментарі</a>
                <a href="/index.php" target="_blank">🌐 Сайт</a>
                <a href="/logout.php">🚪 Вихід</a>
            </nav>
        </aside>
        <main class="admin-main">
            <header class="admin-header">
                <h1>Dashboard</h1>
            </header>
            <div class="admin-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3><?= $total_articles ?></h3>
                        <p>Всього статей</p>
                    </div>
                    <div class="stat-card">
                        <h3><?= $published_articles ?></h3>
                        <p>Опубліковано</p>
                    </div>
                    <div class="stat-card">
                        <h3><?= $total_users ?></h3>
                        <p>Користувачів</p>
                    </div>
                    <div class="stat-card">
                        <h3><?= $total_comments ?></h3>
                        <p>Коментарів</p>
                    </div>
                </div>
                
                <section class="admin-section">
                    <h2>Останні статті</h2>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Назва</th>
                                <th>Статус</th>
                                <th>Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_articles as $article): ?>
                            <tr>
                                <td><?= $article['id'] ?></td>
                                <td><a href="/admin/article_edit.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></td>
                                <td><span class="badge badge-<?= $article['status'] ?>"><?= $article['status'] ?></span></td>
                                <td><?= format_date($article['created_at']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
    <script src="/admin/js/admin.js"></script>
</body>
</html>