<?php
declare(strict_types=1);

namespace Framework\Http;

final class Request
{
    function __construct(
        private string $pathInfo = "/",
        private array $params = [],
        private string $method = "GET"
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
        $param = $this->params[$key] ?? null;
        return $param !== "" ? $param : null;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Request
     */
    public function setMethod(string $method): Request
    {
        $this->method = $method;
        return $this;
    }

}