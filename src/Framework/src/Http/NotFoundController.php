<?php
declare(strict_types=1);

namespace Framework\Http;

final class NotFoundController extends AbstractController
{
    public function __invoke(): Response {
        return $this->render(__DIR__."/page404.html.php");
    }
}