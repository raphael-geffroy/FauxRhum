<?php
declare(strict_types=1);

namespace App\Application\Article\Category\Update;

use App\Domain\Article\CategoryRepositoryInterface;

final class UpdateHandler
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    public function __invoke(
        UpdateCommand $command
    ): void {
        $this->categoryRepository->update($command->category);
    }
}