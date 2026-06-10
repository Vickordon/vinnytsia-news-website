<?php
/**
 * Article Page - Сторінка статті
 */
require_once 'config.php';
$db = Database::getInstance();

$slug = $_GET['slug'] ?? '';
$article = $db->fetchOne("SELECT * FROM articles WHERE slug = ? AND status = 'published'", [$slug]);

if (!$article) {
    http_response_code(404);
    $page_title = 'Не знайдено';
    include 'includes/header.php';
    echo '<div class="container"><h1>Статтю не знайдено</h1></div>';
    include 'includes/footer.php';
    exit;
}

$db->query("UPDATE articles SET views = views + 1 WHERE id = ?", [$article['id']]);

$page_title = htmlspecialchars($article['title']);
include 'includes/header.php';
?>
<div class="container">
    <article class="article-full">
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <div class="article-meta">
            <span>Автор: <?= htmlspecialchars($article['author_name'] ?? 'Адмін') ?></span>
            <span>Опубліковано: <?= format_date($article['published_at']) ?></span>
            <span>Переглядів: <?= $article['views'] ?></span>
        </div>
        <div class="article-content">
            <?= nl2br(htmlspecialchars($article['content'])) ?>
        </div>
    </article>
</div>
<?php include 'includes/footer.php';