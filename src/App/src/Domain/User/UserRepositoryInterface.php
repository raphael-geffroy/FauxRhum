<?php
declare(strict_types=1);

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function update(User $user): void;
    public function findOneByUsername(string $username): ?User;
    public function findOneById(string $id): ?User;
}