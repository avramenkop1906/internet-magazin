<?php
include 'header.php';

// Обработка формы регистрации
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $full_name = trim($_POST['full_name']);
    
    // Простая валидация
    if (!empty($email) && !empty($password) && !empty($full_name)) {
        // Подключаемся к базе данных
        include 'config.php';
        
        try {
            // Проверяем, нет ли уже такого email
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Пользователь с таким email уже существует!";
            } else {
                // Сохраняем пароль БЕЗ хеширования (просто как есть)
                $stmt = $pdo->prepare("INSERT INTO users (email, password, full_name) VALUES (?, ?, ?)");
                $stmt->execute([$email, $password, $full_name]);
                
                $success = "Регистрация успешна! Теперь вы можете войти.";
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
            <h2>Создать аккаунт</h2>
            <p>Присоединяйтесь к сообществу креативщиков!</p>
            
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="full_name">Ваше имя:</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="auth-button">Зарегистрироваться</button>
            </form>
            
            <p class="auth-link">
                Уже есть аккаунт? <a href="login.php">Войдите здесь</a>
            </p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>