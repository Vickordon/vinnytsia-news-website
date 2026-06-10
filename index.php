<?php
/**
 * Homepage - Головна сторінка
 */
require_once 'config.php';
$db = Database::getInstance();

$featured = $db->fetchAll(
    "SELECT a.*, u.username as author_name FROM articles a 
     JOIN users u ON a.author_id = u.id 
     WHERE a.status = 'published' AND a.is_featured = 1 
     ORDER BY a.published_at DESC LIMIT 3"
);

$latest = $db->fetchAll(
    "SELECT a.*, u.username as author_name, c.name as category_name FROM articles a 
     JOIN users u ON a.author_id = u.id 
     JOIN categories c ON a.category_id = c.id 
     WHERE a.status = 'published' 
     ORDER BY a.published_at DESC LIMIT 10"
);

$page_title = 'Головна - Сайт Новин Вінничини';
include 'includes/header.php';
?>
<div class="container">
    <?php if ($featured): ?>
    <section class="featured-section">
        <h2>Головні новини</h2>
        <div class="featured-grid">
            <?php foreach ($featured as $article): ?>
            <article class="featured-card">
                <a href="/article.php?slug=<?= $article['slug'] ?>">
                    <h3><?= htmlspecialchars($article['title']) ?></h3>
                    <p class="excerpt"><?= limit_text($article['excerpt'] ?: $article['content'], 150) ?></p>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="latest-section">
        <h2>Останні новини</h2>
        <div class="news-list">
            <?php foreach ($latest as $article): ?>
            <article class="news-card">
                <h3><a href="/article.php?slug=<?= $article['slug'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                <p class="excerpt"><?= limit_text($article['excerpt'] ?: $article['content'], 200) ?></p>
                <div class="meta">
                    <span class="category"><?= htmlspecialchars($article['category_name'] ?? '') ?></span>
                    <span class="date"><?= format_date($article['published_at']) ?></span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
</div>
<?php include 'includes/footer.php';