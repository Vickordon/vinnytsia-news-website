<?php
/**
 * Register Page - Реєстрація
 */
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    
    if ($username && $email && $password) {
        if ($password !== $password_confirm) {
            $error = 'Паролі не співпадають';
        } elseif (strlen($password) < 6) {
            $error = 'Пароль має бути не менше 6 символів';
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => HASH_COST]);
            $db = Database::getInstance();
            
            try {
                $db->insert('users', [
                    'username' => $username,
                    'email' => $email,
                    'password_hash' => $password_hash,
                    'role' => 'user'
                ]);
                set_flash_message('success', 'Реєстрація успішна! Тепер ви можете увійти.');
                redirect('/login.php');
            } catch (PDOException $e) {
                $error = 'Користувач з таким ім\'ям або email вже існує';
            }
        }
    } else {
        $error = 'Заповніть всі поля';
    }
}

$page_title = 'Реєстрація';
include 'includes/header.php';
?>
<div class="container auth-container">
    <h2>Реєстрація</h2>
    <?php if (isset($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" class="auth-form">
        <div class="form-group">
            <label for="username">Ім'я користувача</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required minlength="6">
        </div>
        <div class="form-group">
            <label for="password_confirm">Підтвердження паролю</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
        </div>
        <button type="submit" class="btn btn-primary">Зареєструватися</button>
    </form>
    <p class="auth-link">Вже маєте акаунт? <a href="/login.php">Увійти</a></p>
</div>
<?php include 'includes/footer.php';