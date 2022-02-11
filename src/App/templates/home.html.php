<h1>Home</h1>
<ul>
    <?php

    use App\Domain\Article\Article;
    use App\Domain\Article\Category;

    /** @var iterable<Article> $articles */
    foreach ($articles as $article) {
        echo '<li>' . $article->getTitle() . '</li>';
    }
    ?>
</ul>

<?php
/** @var iterable<Category> $categories */
foreach ($categories as $category) {
    echo '<h3>' . $category->getName() . '</h3>';
    echo '<ul>';
    foreach ($category->getArticles() as $article) {
        echo '<li>' . $article->getTitle() . '</li>';
    }
    echo '</ul>';
}
?>
