<?php
declare(strict_types=1);

namespace App\Application\User\GetUserFromSession;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use Framework\Http\Session;

final class GetUserFromSession
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private Session $session
    ){}

    public function __invoke(): ?User {
        $id = $this->session->get('user-id');
        if($id === null){
            return null;
        }
        return $this->userRepository->findOneById($id);
    }
}