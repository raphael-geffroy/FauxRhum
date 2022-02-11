<?php
declare(strict_types=1);

namespace App\Repository;

use App\Domain\Article\ArticleRepositoryInterface;
use App\Domain\Article\Category;
use App\Domain\Article\CategoryRepositoryInterface;
use PDO;

final class PdoCategoryRepository implements CategoryRepositoryInterface
{
    private PDO $pdo;

    public function __construct(
        private ArticleRepositoryInterface $articleRepository
    )
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../../../data.db');
    }

    public function save(Category $category): void
    {
        $query = $this->pdo->prepare("INSERT INTO category (id, name, articles_ids) VALUES (:id, :name, :articles_ids)");
        $query->execute($category->toArray());
    }

    public function findAll(): iterable
    {
        $data = $this->pdo->query("SELECT * FROM category")
            ->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            foreach ($data as $array) {
                yield Category::fromArray($array, $this->articleRepository);
            }
        }
        return null;
    }

    public function findOneById(string $id): ?Category
    {
        $data = $this->pdo->query("SELECT * FROM category where id = '$id'")
            ->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return Category::fromArray($data, $this->articleRepository);
        }
        return null;
    }

    public function update(Category $category): void
    {
        $query = $this->pdo->prepare("UPDATE category SET name = :name, articles_ids = :articles_ids WHERE id = :id");
        $query->execute($category->toArray());
    }
}