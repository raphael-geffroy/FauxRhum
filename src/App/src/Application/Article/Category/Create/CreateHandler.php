<?php
declare(strict_types=1);

namespace App\Application\Article\Category\Create;

use App\Domain\Article\Category;
use App\Domain\Article\CategoryRepositoryInterface;
use App\Domain\Shared\Uuid;

final class CreateHandler
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function __invoke(
        CreateCommand $command
    ): void {
        $category = Category::create(
            Uuid::generate(),
            $command->name
        );
        $this->categoryRepository->save($category);
    }
}