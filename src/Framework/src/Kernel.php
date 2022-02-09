<?php
declare(strict_types=1);

namespace Framework;

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routes\RouteCollection;
use Framework\Routes\UrlMatcher;
use Framework\Services\Container;

final class Kernel
{
    function handle(Request $request): Response
    {
        $container = new Container();
        require_once __DIR__.'/../config/container.php';

        $routes = new RouteCollection();
        require_once __DIR__.'/../config/routes.php';

        $matcher = new UrlMatcher($routes);

        $controller = $matcher->match($request->getPathInfo())['controller'];
        [$className, $methodName] = explode("@", $controller);
        $instance = $container->get($className);
        $callable = [$instance, $methodName];
        return $callable($request);
    }
}