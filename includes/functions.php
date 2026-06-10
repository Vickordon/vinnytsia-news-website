<?php
/**
 * Helper Functions
 */

function sanitize_input($data): string {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function generate_csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}

function verify_csrf_token(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function redirect(string $url): void {
    header("Location: {$url}");
    exit;
}

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function get_current_user(): ?array {
    if (!is_logged_in()) return null;
    $db = Database::getInstance();
    return $db->fetchOne("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']]);
}

function has_role(string $role): bool {
    $user = get_current_user();
    return $user && $user['role'] === $role;
}

function require_auth(): void {
    if (!is_logged_in()) redirect('/login.php');
}

function require_admin(): void {
    require_auth();
    if (!has_role('admin')) redirect('/index.php');
}

function format_date(string $date): string {
    return date('d.m.Y H:i', strtotime($date));
}

function create_slug(string $string): string {
    $string = mb_strtolower($string, 'UTF-8');
    $string = preg_replace('/[^a-zа-яіїє0-9\s-]/u', '', $string);
    return preg_replace('/[\s-]+/', '-', $string) ?: 'untitled';
}

function limit_text(string $text, int $length = 200): string {
    return mb_strlen($text) <= $length ? $text : mb_substr($text, 0, $length) . '...';
}

function get_flash_message(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}