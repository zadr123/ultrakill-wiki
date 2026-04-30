<?php
require_once 'data.php';
$page_title = 'Главная';
include 'header.php';

$selected_category = isset($_GET['category']) ? $_GET['category'] : 'all';

function getCategoryName($key) {
    $names = [
        'weapon' => 'Оружие',
        'enemy' => 'Враги',
        'level' => 'Уровни',
        'lore' => 'История'
    ];
    return isset($names[$key]) ? $names[$key] : '';
}

if ($selected_category !== 'all') {
    $cat_name = getCategoryName($selected_category);
    echo "<h2>{$cat_name}</h2>";
    echo '<div class="category-section">';
    echo '<ul class="page-list">';
    
    $count = 0;
    foreach ($all_articles as $article) {
        if ($article['category'] === $selected_category) {
            echo '<li>';
            echo '<a href="page.php?id=' . $article['id'] . '">' . htmlspecialchars($article['title']) . '</a>';
            echo '<span class="views"> ' . $article['views'] . ' просмотров</span>';
            echo '</li>';
            $count++;
        }
    }
    
    if ($count === 0) {
        echo '<p class="empty">В этой категории пока нет статей.</p>';
    }
    
    echo '</ul>';
    echo '</div>';
} 

else {
    echo '<h2>Все статьи</h2>';
    
    $categories = ['weapon', 'enemy', 'level', 'lore'];
    foreach ($categories as $cat_key) {
        echo '<div class="category-section">';
        echo '<h3>' . getCategoryName($cat_key) . '</h3>';
        echo '<ul class="page-list">';
        
        $has_articles = false;
        foreach ($all_articles as $article) {
            if ($article['category'] === $cat_key) {
                echo '<li>';
                echo '<a href="page.php?id=' . $article['id'] . '">' . htmlspecialchars($article['title']) . '</a>';
                echo '<span class="views"> ' . $article['views'] . ' просмотров</span>';
                echo '</li>';
                $has_articles = true;
            }
        }
        
        if (!$has_articles) {
            echo '<p class="empty">Нет статей в этой категории</p>';
        }
        
        echo '</ul>';
        echo '</div>';
    }
}

include 'footer.php';
?>