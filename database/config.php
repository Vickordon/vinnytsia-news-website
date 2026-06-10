<?php
/**
 * Database Configuration
 */
return [
    'host' => defined('DB_HOST') ? DB_HOST : 'localhost',
    'dbname' => defined('DB_NAME') ? DB_NAME : 'vinnytsia_news',
    'username' => defined('DB_USER') ? DB_USER : 'root',
    'password' => defined('DB_PASS') ? DB_PASS : '',
    'charset' => defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];