<?php
declare(strict_types=1);

namespace Framework\Routes;

use function array_key_exists;

final class Route
{
    private string $path = '/';
    private array $defaults = [];

    public function __construct(string $path, array $defaults = [])
    {
        $this->setPath($path);
        $this->addDefaults($defaults);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $pattern): self
    {
        $this->path = '/'.ltrim(trim($pattern), '/');
        return $this;
    }

    public function getDefaults(): array
    {
        return $this->defaults;
    }

    public function setDefaults(array $defaults): self
    {
        $this->defaults = [];
        return $this->addDefaults($defaults);
    }

    public function addDefaults(array $defaults): self
    {
        foreach ($defaults as $name => $default) {
            $this->defaults[$name] = $default;
        }
        return $this;
    }

    public function getDefault(string $name): mixed
    {
        return $this->defaults[$name] ?? null;
    }

    public function hasDefault(string $name): bool
    {
        return array_key_exists($name, $this->defaults);
    }

    public function setDefault(string $name, $default): self
    {
        $this->defaults[$name] = $default;
        return $this;
    }

}