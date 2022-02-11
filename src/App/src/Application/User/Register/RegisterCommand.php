<?php
declare(strict_types=1);

namespace App\Application\User\Register;

final class RegisterCommand
{
    public function __construct(
        public string $username,
        public string $plainPassword,
        public bool   $isAdministrator,
    )
    {
    }
}