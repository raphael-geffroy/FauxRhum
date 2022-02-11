<?php
declare(strict_types=1);

namespace App\Application\User\Register;

use App\Domain\User\HashingErrorException;
use App\Domain\User\PasswordDoesNotRespectRequirementsException;
use App\Domain\User\UsernameAlreadyTakenException;

final class Register
{

    public function __construct(
        private RegisterHandler $handler
    ){}

    /**
     * @throws PasswordDoesNotRespectRequirementsException
     * @throws UsernameAlreadyTakenException
     * @throws HashingErrorException
     */
    public function __invoke(string $username, string $plainPassword, bool $isAdministrator): void {
        ($this->handler)(
            new RegisterCommand($username, $plainPassword, $isAdministrator)
        );
    }
}