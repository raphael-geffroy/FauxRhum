<?php
declare(strict_types=1);

namespace Framework\Http;

abstract class AbstractController
{
    function render(string $templatePath, array $params): Response {
        extract($params);
        ob_start();
        require_once $templatePath;
        $html = ob_get_clean();
        return new Response(
            200,
            $html
        );
    }
}