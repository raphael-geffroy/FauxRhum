<?php
declare(strict_types=1);

namespace Framework\Http;

final class Request
{
    function __construct(
        private string $pathInfo = "/",
        private array $params = []
    ){}

    /**
     * @return string
     */
    public function getPathInfo(): string
    {
        return $this->pathInfo;
    }


    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getParam(string $key): ?string
    {
        return $this->params[$key] ?? null;
    }


}