<?php
declare(strict_types=1);

namespace App\Application\Article\Category\Create;

final class Create
{
    public function __construct(
        private CreateHandler $handler
    ){}

    public function __invoke(string $name): void {
        ($this->handler)(
            new CreateCommand($name)
        );
    }
}