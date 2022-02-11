<?php
declare(strict_types=1);

namespace App\Application\Article\Create;

final class CreateCommand
{
    public function __construct(
        public string $title,
        public string $content,
        public string $authorId,
        public ?string $categoryId = null
    ){}
}