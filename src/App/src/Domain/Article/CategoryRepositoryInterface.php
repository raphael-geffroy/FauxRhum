<?php
declare(strict_types=1);

namespace App\Domain\Article;

interface CategoryRepositoryInterface
{
    public function save(Category $category): void;
    public function update(Category $category): void;
    /** @return iterable<Category> */
    public function findAll(): iterable;
    public function findOneById(string $id): ?Category;
}