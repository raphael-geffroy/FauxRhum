<?php
declare(strict_types=1);

namespace App\Application\User\Login;

use App\Domain\User\InvalidCredentialsException;

final class Login
{
    public function __construct(
        private LoginHandler $handler
    ){}

    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(string $username, string $password): void {
        ($this->handler)(
            new LoginCommand($username, $password)
        );
    }
}