<?php
declare(strict_types=1);

namespace App\Application\Article\Category\AddArticle;

use App\Domain\Article\CategoryRepositoryInterface;
use App\Domain\User\CategoryNotFoundException;

final class AddArticleHandler
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    /**
     * @throws CategoryNotFoundException
     */
    public function __invoke(AddArticleCommand $command): void {
        $category = $this->categoryRepository->findOneById($command->categoryId);
        if($category === null){
            throw new CategoryNotFoundException;
        }
        $category->addArticle($command->article);
        $this->categoryRepository->update($category);
    }
}