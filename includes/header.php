<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Сайт Новин Вінничини' ?></title>
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/news-listing.css">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <h1 class="site-logo"><a href="/index.php">Сайт Новин Вінничини</a></h1>
            <nav class="main-nav">
                <a href="/index.php">Головна</a>
                <a href="/category.php?slug=polytyka">Політика</a>
                <a href="/category.php?slug=ekonomika">Економіка</a>
                <a href="/category.php?slug=suspilstvo">Суспільство</a>
                <a href="/category.php?slug=sport">Спорт</a>
                <a href="/category.php?slug=kultura">Культура</a>
            </nav>
            <div class="header-actions">
                <form action="/search.php" method="GET" class="search-form">
                    <input type="text" name="q" placeholder="Пошук...">
                    <button type="submit">🔍</button>
                </form>
                <?php if (is_logged_in()): ?>
                    <?php if (has_role('admin')): ?>
                    <a href="/admin/" class="btn btn-sm">Адмінка</a>
                    <?php endif; ?>
                    <a href="/logout.php" class="btn btn-sm">Вихід</a>
                <?php else: ?>
                    <a href="/login.php" class="btn btn-sm">Вхід</a>
                    <a href="/register.php" class="btn btn-sm btn-primary">Реєстрація</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="site-main">
        <?php if ($flash = get_flash_message()): ?>
        <div class="container">
            <div class="alert alert-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
        </div>
        <?php endif; ?>