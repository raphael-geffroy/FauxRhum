<?php
declare(strict_types=1);

namespace App\Application\Article\FindOneById;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleRepositoryInterface;

final class FindOneById
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
    ){}

    public function __invoke(string $id): ?Article {
        return $this->articleRepository->findOneById($id);
    }
}