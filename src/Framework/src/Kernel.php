<?php
declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Http\NotFoundController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routes\RouteCollection;
use Framework\Routes\UrlMatcher;
use Framework\Services\Container;

final class Kernel
{
    function handle(Request $request, ?string $containerConfigPath = null, ?string $routerConfigPath = null): Response
    {
        $container = new Container;
        if($containerConfigPath !== null){
            require_once $containerConfigPath;
        }

        $routes = new RouteCollection;
        if($containerConfigPath !== null){
            require_once $routerConfigPath;
        }

        $matcher = new UrlMatcher($routes);

        try {
            $matcherResponse = $matcher->match($request->getPathInfo());
            $controller = $matcherResponse['controller'];
            $parameters = $matcherResponse['parameters'];
        } catch (Exception $e) {
            return (new NotFoundController)();
        }

        [$className, $methodName] = explode("@", $controller);
        $instance = $container->get($className);
        $callable = [$instance, $methodName];
        return $callable($request,...$parameters);
    }
}