<?php
/**
 * Vinnytsia News Website - Main Configuration
 * Сайт Новин Вінничини
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'vinnytsia_news');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('SITE_NAME', 'Сайт Новин Вінничини');
define('SITE_URL', 'http://localhost/vinnytsia-news-website');
define('ADMIN_EMAIL', 'admin@vinnytsia-news.com');

define('HASH_COST', 10);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 0);
date_default_timezone_set('Europe/Kiev');