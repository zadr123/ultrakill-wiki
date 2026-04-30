<?php
require_once 'data.php';  // ← подключаем статьи из отдельного файла

// =====================================================
// ЛОГИКА ПОЛУЧЕНИЯ ТЕКУЩЕЙ СТАТЬИ
// =====================================================
$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!isset($all_articles[$article_id])) {
    die("Статья не найдена");
}

$article = $all_articles[$article_id];
$page_title = $article['title'];
include 'header.php';

// Увеличиваем счётчик просмотров
$article['views']++;
?>

<article class="wiki-page">
    <h2><?php echo htmlspecialchars($article['title']); ?></h2>
    
    <div class="page-meta">
        <span class="category"><?php echo htmlspecialchars($article['category']); ?></span>
        <span class="views">👁️ <?php echo $article['views']; ?> просмотров</span>
    </div>

    <div class="page-with-image">
        <?php if (!empty($article['image'])): ?>
            <div class="page-image">
                <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
            </div>
        <?php endif; ?>
        
        <div class="page-content">
            <?php echo nl2br(htmlspecialchars($article['content'])); ?>
        </div>
    </div>

    <div class="page-actions">
        <a href="index.php" class="btn">← На главную</a>
    </div>
</article>

<?php include 'footer.php'; ?>