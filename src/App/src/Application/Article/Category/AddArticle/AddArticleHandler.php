<?php
declare(strict_types=1);

namespace App\Application\Article\Category\AddArticle;

use App\Application\Article\Category\FindOneById\FindOneById;
use App\Application\Article\Category\Update\Update;
use App\Domain\User\CategoryNotFoundException;

final class AddArticleHandler
{
    public function __construct(
        private FindOneById $findOneById,
        private Update $update
    ){}

    /**
     * @throws CategoryNotFoundException
     */
    public function __invoke(AddArticleCommand $command): void {
        $category = ($this->findOneById)($command->categoryId);
        if($category === null){
            throw new CategoryNotFoundException;
        }
        $category->addArticle($command->article);
        ($this->update)($category);
    }
}