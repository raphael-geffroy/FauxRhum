<?php
declare(strict_types=1);

namespace App\Application\User\Register;

use App\Domain\Shared\Uuid;
use App\Domain\User\HashingErrorException;
use App\Domain\User\PasswordDoesNotRespectRequirementsException;
use App\Domain\User\Role;
use App\Domain\User\User;
use App\Domain\User\UsernameAlreadyTakenException;
use App\Domain\User\UserRepositoryInterface;

final class RegisterHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    /**
     * @throws PasswordDoesNotRespectRequirementsException
     * @throws UsernameAlreadyTakenException
     * @throws HashingErrorException
     */
    public function __invoke(RegisterCommand $command): void
    {
        $user = User::create(
            Uuid::generate(),
            $command->username,
            $command->plainPassword,
            $command->isAdministrator?Role::Administrator:Role::User,
            $this->userRepository
        );
        $this->userRepository->save($user);
    }
}