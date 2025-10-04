<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreativeDigital - Магазин для дизайнеров</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="creative-header">
        <div class="container">
            <div class="logo">
                <h1>🎨 CreativeDigital</h1>
            </div>
            <nav class="main-nav">
                <a href="index.php">Главная</a>
                <a href="products.php">Товары</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="logout.php">Выйти</a>
                    <span class="user-name">Привет, <?php echo $_SESSION['user_name']; ?>!</span>
                <?php else: ?>
                    <a href="login.php">Войти</a>
                    <a href="register.php">Регистрация</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main>