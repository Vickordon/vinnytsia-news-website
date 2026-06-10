<?php
/**
 * Vinnytsia News Website - Main Configuration
 * Сайт Новин Вінничини
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'vinnytsia_news');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Application Settings
define('SITE_NAME', 'Сайт Новин Вінничини');
define('SITE_URL', 'http://localhost/vinnytsia-news-website');
define('ADMIN_EMAIL', 'admin@vinnytsia-news.com');

// Security Settings
define('HASH_COST', 10); // bcrypt cost
define('SESSION_LIFETIME', 3600); // 1 hour
define('CSRF_TOKEN_NAME', 'csrf_token');

// File Upload Settings
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif']);

// Error Reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Europe/Kiev');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoloader
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/src/',
        __DIR__ . '/src/Models/',
        __DIR__ . '/database/',
        __DIR__ . '/includes/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Include essential files
require_once __DIR__ . '/database/config.php';
require_once __DIR__ . '/database/Database.php';
require_once __DIR__ . '/includes/functions.php';
