<?php
/**
 * Login Page - Вхід
 */
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        $db = Database::getInstance();
        $user = $db->fetchOne("SELECT * FROM users WHERE username = ? AND is_active = 1", [$username]);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            redirect($user['role'] === 'admin' ? '/admin/' : '/index.php');
        } else {
            $error = 'Невірне ім\'я користувача або пароль';
        }
    } else {
        $error = 'Заповніть всі поля';
    }
}

$page_title = 'Вхід';
include 'includes/header.php';
?>
<div class="container auth-container">
    <h2>Вхід</h2>
    <?php if (isset($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" class="auth-form">
        <div class="form-group">
            <label for="username">Ім'я користувача</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Увійти</button>
    </form>
    <p class="auth-link">Немає акаунту? <a href="/register.php">Зареєструватися</a></p>
</div>
<?php include 'includes/footer.php';