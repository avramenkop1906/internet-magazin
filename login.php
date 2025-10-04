<?php
include 'header.php';

// Обработка формы входа
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Простая валидация
    if (!empty($email) && !empty($password)) {
        // Подключаемся к базе данных
        include 'config.php';
        
        try {
            // Ищем пользователя по email
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user) {
                // Простая проверка пароля БЕЗ хеширования
                if ($password == $user['password']) {
                    // Успешный вход - сохраняем в сессию
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['full_name'];
                    $_SESSION['user_email'] = $user['email'];
                    
                    $success = "Вход выполнен успешно! Перенаправляем...";
                    // Перенаправляем на главную через 2 секунды
                    header("Refresh: 2; URL=index.php");
                    exit();
                } else {
                    $error = "Неверный пароль!";
                }
            } else {
                $error = "Пользователь с таким email не найден!";
            }
        } catch(PDOException $e) {
            $error = "Ошибка базы данных: " . $e->getMessage();
        }
    } else {
        $error = "Все поля обязательны для заполнения!";
    }
}
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-form">
            <h2>Вход в аккаунт</h2>
            <p>С возвращением, креативщик!</p>
            
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="auth-button">Войти</button>
            </form>
            
            <p class="auth-link">
                Нет аккаунта? <a href="register.php">Зарегистрируйтесь здесь</a>
            </p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>