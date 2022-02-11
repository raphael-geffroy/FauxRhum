<?php
declare(strict_types=1);

namespace App\Application\User\Login;

use App\Domain\User\InvalidCredentialsException;
use App\Domain\User\UserRepositoryInterface;
use Framework\Http\Session;

final class LoginHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private Session $session
    ){}

    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(LoginCommand $command): void
    {
        $user = $this->userRepository->findOneByUsername($command->username);
        if($user === null
        || !$user->getCredentials()->getHashedPassword()->match($command->plainPassword)) {
            throw new InvalidCredentialsException;
        }
        $this->session->set('user-id', $user->getId()->getId());
    }
}