<?php
declare(strict_types=1);

namespace App\Application\Article\Category\Update;

use App\Domain\Article\Category;

final class UpdateCommand
{
    public function __construct(
        public Category $category
    ){}
}