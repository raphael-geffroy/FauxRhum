<?php
declare(strict_types=1);

namespace App\Application\User\Login;

final class LoginCommand
{
    public function __construct(
        public string $username,
        public string $plainPassword)
    {
    }
}