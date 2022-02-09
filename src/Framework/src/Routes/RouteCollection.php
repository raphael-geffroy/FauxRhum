<?php
declare(strict_types=1);

namespace Framework\Routes;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

final class RouteCollection implements IteratorAggregate
{
    /** @var array<Route> $routes */
    private array $routes = [];

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->routes);
    }

    public function add(string $name, Route $route): void
    {
        $this->routes[$name] = $route;
    }
}