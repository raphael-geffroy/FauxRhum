<?php
declare(strict_types=1);

namespace Framework\Routes;

use Exception;

final class UrlMatcher
{
    public function __construct(
        private RouteCollection $routes
    ){}

    /**
     * @throws Exception
     */
    public function match(string $pathinfo): array
    {
        if ($ret = $this->matchCollection(rawurldecode($pathinfo) ?: '/', $this->routes)) {
            return $ret;
        }

        throw new Exception(sprintf('No routes found for "%s".', $pathinfo));
    }

    protected function matchCollection(string $pathinfo, RouteCollection $routes): array
    {
        $trimmedPathinfo = rtrim($pathinfo, '/') ?: '/';
        foreach ($routes as $name => $route) {
            $params = [];
            $regex = "#^".preg_replace('#{(!)?(\w+)}#', "(\w*)",$route->getPath())."$#";
            if((bool) preg_match($regex,$trimmedPathinfo, $params)) {
                $matches2 = [];
                preg_match_all("/{(\w+)}/",$route->getPath(), $matches2);
                $paramsNames = $matches2[1];
                array_shift($params);
                return [
                    "parameters" => array_combine($paramsNames, $params),
                    "controller" => $route->getDefault('controller')
                ];
            }
        }

        return [];
    }
}