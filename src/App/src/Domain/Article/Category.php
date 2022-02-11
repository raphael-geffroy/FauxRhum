<?php
declare(strict_types=1);

namespace App\Domain\Article;

use App\Domain\Shared\Uuid;

final class Category
{
    private Uuid $id;
    private string $name;
    /** @var iterable<Article> $articles */
    private iterable $articles = [];

    private function __construct(){}

    public static function create(string $id, string $name): self {
        return (new self)
            ->setId(Uuid::createFromUuid($id))
            ->setName($name)
            ;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @param Uuid $id
     * @return Category
     */
    public function setId(Uuid $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Article[]
     */
    public function getArticles(): iterable
    {
        return $this->articles;
    }

    /**
     * @param Article[] $articles
     * @return Category
     */
    public function setArticles(iterable $articles): Category
    {
        $this->articles = $articles;
        return $this;
    }

    public function addArticle(Article $article): self {
        $this->articles = [...$this->articles, $article];
        return $this;
    }

    public static function fromArray(array $data, ArticleRepositoryInterface $articleRepository): self {
        return (new self)
            ->setId(Uuid::createFromUuid($data['id']))
            ->setName($data['name'])
            ->setArticles(
                    $articleRepository->findByIds(json_decode($data['articles_ids']))
            );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getId(),
            'name' => $this->getName(),
            'articles_ids'=> json_encode(array_map(fn(Article $article)=>$article->getId()->getId(), $this->getArticles()))
        ];
    }

}