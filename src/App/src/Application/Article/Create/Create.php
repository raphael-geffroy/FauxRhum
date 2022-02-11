<?php
declare(strict_types=1);

namespace App\Application\Article\Create;

use App\Domain\User\CategoryNotFoundException;

final class Create
{
    public function __construct(
        private CreateHandler $createHandler
    ){}

    /**
     * @throws CategoryNotFoundException
     */
    public function __invoke(
        string $title, string $content, string $authorId, ?string $categoryId = null
    ){
        ($this->createHandler)(
            new CreateCommand($title, $content, $authorId, $categoryId)
        );
    }
}