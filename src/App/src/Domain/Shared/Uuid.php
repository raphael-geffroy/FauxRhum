<?php
declare(strict_types=1);

namespace App\Domain\Shared;

final class Uuid
{
    private string $id;

    private function __construct(){}

    public static function createFromUuid(string $uuid): self
    {
        return (new self)
            ->setId($uuid);
    }

    public static function create(string $uuid): self
    {
        return (new self)
            ->setId(self::generate());
    }

    public static function generate(): string {
        return uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    private function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

}