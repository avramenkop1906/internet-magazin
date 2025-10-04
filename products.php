<?php
include 'header.php';
include 'config.php';

// Получаем товары из базы данных
try {
    $stmt = $pdo->query("SELECT p.*, c.name as category_name 
                         FROM products p 
                         LEFT JOIN categories c ON p.category_id = c.id 
                         ORDER BY p.created_at DESC");
    $products = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Ошибка загрузки товаров: " . $e->getMessage();
    $products = [];
}
?>

<section class="products-section">
    <div class="container">
        <h1>Наши товары</h1>
        <p class="section-subtitle">Цифровые продукты для вашего творчества</p>
        
        <div class="products-grid">
            <?php if (count($products) > 0): ?>
                <?php foreach($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
    <?php 
    // Подбираем эмодзи по категории
    $emoji = '🎨'; // по умолчанию
    $gradient = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'; // по умолчанию
    
    if ($product['category_id'] == 1) {
        $emoji = '🔤';
        $gradient = 'linear-gradient(135deg, #ff6b6b 0%, #ffd700 100%)'; // красный-желтый для шрифтов
    }
    if ($product['category_id'] == 2) {
        $emoji = '📱'; 
        $gradient = 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)'; // синий для UI
    }
    if ($product['category_id'] == 3) {
        $emoji = '✏️';
        $gradient = 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)'; // зеленый для иллюстраций
    }
    if ($product['category_id'] == 4) {
        $emoji = '⚡';
        $gradient = 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)'; // розовый-желтый для пресетов
    }
    ?>
    <div class="placeholder-image" style="background: <?php echo $gradient; ?>">
        <span class="product-emoji"><?php echo $emoji; ?></span>
    </div>
</div>
                        
                        <div class="product-info">
                            <span class="product-category"><?php echo $product['category_name']; ?></span>
                            <h3 class="product-title"><?php echo $product['name']; ?></h3>
                            <p class="product-description"><?php echo $product['description']; ?></p>
                            
                            <div class="product-footer">
                                <div class="product-price">$<?php echo $product['price']; ?></div>
                                <?php if(isset($_SESSION['user_id'])): ?>
                                    <button class="buy-button" data-product-id="<?php echo $product['id']; ?>">
                                        Купить
                                    </button>
                                <?php else: ?>
                                    <a href="login.php" class="buy-button">Войдите чтобы купить</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-products">
                    <p>Товары скоро появятся!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>