<?php
declare(strict_types=1);

namespace App\Application\Article\Category\FindOneById;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleRepositoryInterface;
use App\Domain\Article\Category;
use App\Domain\Article\CategoryRepositoryInterface;

final class FindOneById
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
    ){}

    public function __invoke(string $id): ?Category {
        return $this->categoryRepository->findOneById($id);
    }
}