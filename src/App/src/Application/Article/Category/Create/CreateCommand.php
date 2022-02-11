<?php
declare(strict_types=1);

namespace App\Application\Article\Category\Create;

final class CreateCommand
{
    public function __construct(
        public string $name
    ){}
}