<?php
declare(strict_types=1);

namespace App\Domain\Article;

interface ArticleRepositoryInterface
{
    public function save(Article $article): void;
    public function update(Article $article): void;
    public function findOneById(string $id): ?Article;
    /**
     * @param iterable<string> $ids
     * @return iterable<Article>
     */
    public function findByIds(iterable $ids): iterable;
    /** @return iterable<Article> */
    public function findAll(): iterable;
    /** @return iterable<Article> */
    public function findAllNonCategorized(): iterable;
}