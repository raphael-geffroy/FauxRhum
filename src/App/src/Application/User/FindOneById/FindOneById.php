<?php
declare(strict_types=1);

namespace App\Application\User\FindOneById;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;

final class FindOneById
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    public function __invoke(string $id): ?User {
        return $this->userRepository->findOneById($id);
    }
}