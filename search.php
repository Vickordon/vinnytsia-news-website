<?php
/**
 * Search Page - Пошук
 */
require_once 'config.php';
$db = Database::getInstance();

$query = sanitize_input($_GET['q'] ?? '');
$articles = [];

if ($query && strlen($query) >= 2) {
    $articles = $db->fetchAll(
        "SELECT a.*, u.username as author_name FROM articles a 
         JOIN users u ON a.author_id = u.id 
         WHERE a.status = 'published' AND (a.title LIKE ? OR a.content LIKE ?) 
         LIMIT 20",
        ["%{$query}%", "%{$query}%"]
    );
}

$page_title = 'Пошук';
include 'includes/header.php';
?>
<div class="container">
    <h2>Пошук: <?= htmlspecialchars($query) ?></h2>
    <?php if ($query && $articles): ?>
        <p>Знайдено статей: <?= count($articles) ?></p>
        <div class="news-list">
            <?php foreach ($articles as $article): ?>
            <article class="news-card">
                <h3><a href="/article.php?slug=<?= $article['slug'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                <p class="excerpt"><?= limit_text($article['excerpt'] ?: $article['content'], 200) ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    <?php elseif ($query): ?>
        <p>Нічого не знайдено за запитом "<?= htmlspecialchars($query) ?>"</p>
    <?php else: ?>
        <p>Введіть запит для пошуку новин.</p>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php';