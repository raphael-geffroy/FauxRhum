<?php
declare(strict_types=1);

namespace App\Domain\Article;

use App\Domain\Shared\Uuid;
use DateTimeImmutable;
use DateTimeInterface;

final class Article
{
    private Uuid $id;
    private string $title;
    private string $content;
    private DateTimeInterface $createdAt;
    private Uuid $authorId;
    private ?Uuid $categoryId;

    private function __construct(){}

    public static function create(
        string $id,
        string $title,
        string $content,
        string $authorId,
        ?string $categoryId
    ): self {
        return (new self)
            ->setId(Uuid::createFromUuid($id))
            ->setTitle($title)
            ->setContent($content)
            ->setCreatedAt(new DateTimeImmutable)
            ->setAuthorId(Uuid::createFromUuid($authorId))
            ->setCategoryId($categoryId?Uuid::createFromUuid($categoryId):null);
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
     * @return Article
     */
    private function setId(Uuid $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    private function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    private function setContent(string $content): Article
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return Article
     */
    private function setCreatedAt(DateTimeInterface $createdAt): Article
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Uuid
     */
    public function getAuthorId(): Uuid
    {
        return $this->authorId;
    }

    /**
     * @param Uuid $authorId
     * @return Article
     */
    private function setAuthorId(Uuid $authorId): Article
    {
        $this->authorId = $authorId;
        return $this;
    }

    /**
     * @return Uuid|null
     */
    public function getCategoryId(): ?Uuid
    {
        return $this->categoryId;
    }

    /**
     * @param Uuid|null $categoryId
     * @return Article
     */
    public function setCategoryId(?Uuid $categoryId): Article
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public static function fromArray(array $data): self {
        return (new self)
            ->setId(Uuid::createFromUuid($data['id']))
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setAuthorId(Uuid::createFromUuid($data['author_id']))
            ->setCategoryId($data['category_id']?Uuid::createFromUuid($data['category_id']):null)
            ->setCreatedAt(new DateTimeImmutable((string)$data['created_at']));
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'author_id'=> $this->getAuthorId()->getId(),
            'category_id'=> $this->getCategoryId()?->getId()??null,
            'created_at'=> $this->getCreatedAt()->getTimestamp()
        ];
    }

}