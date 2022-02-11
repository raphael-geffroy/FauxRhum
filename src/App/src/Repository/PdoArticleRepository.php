<?php
declare(strict_types=1);

namespace App\Repository;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleRepositoryInterface;
use PDO;

final class PdoArticleRepository implements ArticleRepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../../../data.db');
    }

    public function save(Article $article): void
    {
        $query = $this->pdo->prepare("INSERT INTO article (id,author_id,category_id,title,content) VALUES (:id, :author_id, :category_id, :title, :content)");
        $query->execute($article->toArray());
    }

    public function update(Article $article): void
    {
        return;
    }

    public function findOneById(string $id): ?Article
    {
        $data = $this->pdo->query("SELECT * FROM article where id = '$id'")
            ->fetch(PDO::FETCH_ASSOC);
        if($data){
            return Article::fromArray($data);
        }
        return null;
    }

    public function findAll(): iterable
    {
        $data = $this->pdo->query("SELECT * FROM article")
            ->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            foreach ($data as $array){
                yield Article::fromArray($array);
            }
        }
        return null;
    }

    public function findAllNonCategorized(): iterable
    {
        $data = $this->pdo->query("SELECT * FROM article WHERE category_id IS NULL")
            ->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            foreach ($data as $array){
                yield Article::fromArray($array);
            }
        }
        return null;
    }

    public function findByIds(iterable $ids): iterable
    {
        $ids = implode(", ", array_map(fn($id)=>"'$id'",[...$ids]));
        $data = $this->pdo->query("SELECT * FROM article where id IN ($ids)")
            ->fetchAll(PDO::FETCH_ASSOC);
        if(count($data) > 0){
            foreach ($data as $array){
                yield Article::fromArray($array);
            }
        }
        return null;
    }
}