<?php
declare(strict_types=1);

namespace App\Application\Article\FindAll;

use App\Domain\Article\ArticleRepositoryInterface;

final class FindAll
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
    ){}

    public function __invoke(bool $filterNonCategorized = false): iterable {
        return $filterNonCategorized
            ?$this->articleRepository->findAllNonCategorized()
            :$this->articleRepository->findAll();
    }
}