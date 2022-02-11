<?php
declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Http\NotFoundController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;
use Framework\Routes\RouteCollection;
use Framework\Routes\UrlMatcher;
use Framework\Services\Container;

final class Kernel
{
    function handle(
        Request $request,
        ?string $configPath = null,
    ): Response
    {
        (new Session)->start();
        if($configPath !== null){
            require_once $configPath.'env.php';
        }

        $container = new Container;
        if($configPath !== null){
            require_once $configPath.'container.php';
        }

        $routes = new RouteCollection;
        if($configPath !== null){
            require_once $configPath.'routes.php';
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