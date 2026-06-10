<?php
/**
 * Category Page - Сторінка категорії
 */
require_once 'config.php';
$db = Database::getInstance();

$slug = $_GET['slug'] ?? '';
$category = $db->fetchOne("SELECT * FROM categories WHERE slug = ?", [$slug]);

if (!$category) {
    redirect('/index.php');
}

$articles = $db->fetchAll(
    "SELECT a.*, u.username as author_name FROM articles a 
     JOIN users u ON a.author_id = u.id 
     WHERE a.category_id = ? AND a.status = 'published' 
     ORDER BY a.published_at DESC",
    [$category['id']]
);

$page_title = htmlspecialchars($category['name']);
include 'includes/header.php';
?>
<div class="container">
    <h2><?= htmlspecialchars($category['name']) ?></h2>
    <?php if ($articles): ?>
    <div class="news-list">
        <?php foreach ($articles as $article): ?>
        <article class="news-card">
            <h3><a href="/article.php?slug=<?= $article['slug'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
            <p class="excerpt"><?= limit_text($article['excerpt'] ?: $article['content'], 200) ?></p>
            <div class="meta">
                <span class="date"><?= format_date($article['published_at']) ?></span>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p>У цій категорії ще немає новин.</p>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php';