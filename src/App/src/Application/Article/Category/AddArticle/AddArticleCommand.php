<?php
declare(strict_types=1);

namespace App\Application\Article\Category\AddArticle;

use App\Domain\Article\Article;

final class AddArticleCommand
{
    public function __construct(
        public string $categoryId,
        public Article $article
    ){}
}