<?php
declare(strict_types=1);

namespace Framework\Orm\Migration;

final class MigrationFinder
{
    public function __construct(
        private History $history,
        private string $namespace
    ){}

    private function findMigrations(string $path): array
    {
        return array_map(
            fn ($file) => ucfirst(basename($file, '.php')),
            glob($path . '/*.php')
        );
    }

    public function createInstances(string $path): array
    {
        $classNames = $this->findMigrations($path);
        $classNames = $this->history->filterUndoneMigrations($classNames);

        $objects = [];

        foreach ($classNames as $className) {
            $fullClassName = $this->namespace . $className;
            $objects[] = new $fullClassName;
        }

        return $objects;
    }
}