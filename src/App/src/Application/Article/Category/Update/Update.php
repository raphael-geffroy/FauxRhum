<?php
declare(strict_types=1);

namespace App\Application\Article\Category\Update;

use App\Domain\Article\Category;

final class Update
{
    public function __construct(
        private UpdateHandler $handler
    ){}

    public function __invoke(Category $category): void {
        ($this->handler)(
            new UpdateCommand($category)
        );
    }
}