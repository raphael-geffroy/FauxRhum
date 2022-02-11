<?php
declare(strict_types=1);

namespace Framework\Http;

abstract class AbstractController
{
    private ?Session $session;

    public function __construct(?Session $session = null){
        $this->session= $session?? new Session;
    }

    protected function render(string $templatePath, array $params = []): Response {
        extract($params);
        $session = $this->session;
        ob_start();
        if($templatesDir = getenv("TemplatesDir")){
            if($baseTemplate = getenv("BaseTemplate")){
                $innerTemplate = $templatePath;
                require_once $templatesDir.$baseTemplate;
            }
            require_once $templatesDir.$templatePath;
        } else {
            require_once $templatePath;
        }
        $html = ob_get_clean();
        return new Response(
            200,
            $html
        );
    }
}