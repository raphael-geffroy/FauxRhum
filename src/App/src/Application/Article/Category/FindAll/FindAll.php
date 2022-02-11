<?php
declare(strict_types=1);

namespace App\Application\Article\Category\FindAll;

use App\Domain\Article\CategoryRepositoryInterface;

final class FindAll
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function __invoke(): iterable {
        return $this->categoryRepository->findAll();
    }
}