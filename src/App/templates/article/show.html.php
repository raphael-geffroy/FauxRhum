<?php
/**
 * @var App\Domain\Article\Article $article
 * @var User $author
 * @var ?Category $category
 */

use App\Domain\Article\Category;
use App\Domain\User\User;

?>
<h1><?= $article->getTitle()?></h1>
<div>
    <small>Author : <?= $author->getCredentials()->getUsername()->getUsername()?></small>
</div>
<div>
    <small>Date : <?= $article->getCreatedAt()->format('d/m/Y à H:i')?></small>
</div>
<div>
    <small>Category : <?= $category?->getName()??'Aucune' ?></small>
</div>
<p><?= $article->getContent()?></p>