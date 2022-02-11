<?php
declare(strict_types=1);

namespace App\Application\Article\Create;

use App\Application\Article\Category\AddArticle\AddArticle;
use App\Domain\Article\Article;
use App\Domain\Article\ArticleRepositoryInterface;
use App\Domain\Shared\Uuid;
use App\Domain\User\CategoryNotFoundException;

final class CreateHandler
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private AddArticle $addArticle
    ){}

    /**
     * @throws CategoryNotFoundException
     */
    public function __invoke(CreateCommand $command): void {
        $article = Article::create(
            Uuid::generate(),
            $command->title,
            $command->content,
            $command->authorId,
            $command->categoryId
        );
        $this->articleRepository->save($article);
        if($command->categoryId !== null){
            ($this->addArticle)($command->categoryId, $article);
        }
    }
}