<?php
declare(strict_types=1);

namespace Framework\Orm\Migration;

final class Logger
{
    public function log(string $message)
    {
        echo $message;
    }
}