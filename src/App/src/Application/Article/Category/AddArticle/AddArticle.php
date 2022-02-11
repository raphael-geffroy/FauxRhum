<?php
declare(strict_types=1);

namespace App\Application\Article\Category\AddArticle;

use App\Domain\Article\Article;
use App\Domain\User\CategoryNotFoundException;

final class AddArticle
{
    public function __construct(
        private AddArticleHandler $handler
    ){}

    /**
     * @throws CategoryNotFoundException
     */
    public function __invoke(string $categoryId, Article $article): void {
        ($this->handler)(
            new AddArticleCommand($categoryId, $article)
        );
    }
}