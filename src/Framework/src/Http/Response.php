<?php declare(strict_types=1);

namespace App\Http;

final class Response
{
    function __construct(
        protected int $statusCode = 200,
        protected string $content = '',
        protected array $headers = []
    ){
        $this->headers = array_merge(['content-type'=>'text/html; charset=utf-8'], $this->headers);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Response
     */
    public function setContent(string $content): Response
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return Response
     */
    public function setHeaders(array $headers): Response
    {
        $this->headers = $headers;
        return $this;
    }

    function setHeader(string $key, string $value): self {
        $this->headers[$key] = $value;
        return $this;
    }

    function getHeader(string $key) : ?string {
        return $this->headers[$key] ?? null;
    }

    function send() {
        http_response_code($this->getStatusCode());
        foreach($this->getHeaders() as $key => $value){
            header(sprintf(
                "%s: %s",
                $key,
                $value
            ));
        }
        echo($this->getContent());
    }

}