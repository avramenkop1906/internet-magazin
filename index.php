<?php
// Подключаем шапку сайта
include 'header.php';
?>

<!-- Герой-секция с крутым дизайном -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Твори без границ</h1>
            <p>Магазин цифровых товаров для дизайнеров, иллюстраторов и креативщиков</p>
            <a href="products.php" class="cta-button">Начать покупки</a>
        </div>
        <div class="hero-visual">
            <!-- Здесь будут крутые графические элементы -->
            <div class="floating-shapes">
                <div class="shape shape-1">🎨</div>
                <div class="shape shape-2">✨</div>
                <div class="shape shape-3">🖌️</div>
            </div>
        </div>
    </div>
</section>

<!-- Секция категорий -->
<section class="categories">
    <div class="container">
        <h2>Категории товаров</h2>
        <div class="category-grid">
            <div class="category-card">
                <div class="category-icon">🔤</div>
                <h3>Шрифты</h3>
                <p>Уникальные шрифты для ваших проектов</p>
            </div>
            <div class="category-card">
                <div class="category-icon">📱</div>
                <h3>UI-киты</h3>
                <p>Готовые дизайн-системы и интерфейсы</p>
            </div>
            <div class="category-card">
                <div class="category-icon">🎭</div>
                <h3>Иллюстрации</h3>
                <p>Векторные и растровые работы</p>
            </div>
            <div class="category-card">
                <div class="category-icon">⚡</div>
                <h3>Пресеты</h3>
                <p>Настройки для программ редактирования</p>
            </div>
        </div>
    </div>
</section>

<?php
// Подключаем подвал сайта
include 'footer.php';
?>