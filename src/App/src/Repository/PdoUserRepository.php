<?php
declare(strict_types=1);

namespace App\Repository;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use PDO;

final class PdoUserRepository implements UserRepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../../../data.db');
    }

    public function save(User $user): void
    {
        $query = $this->pdo->prepare("INSERT INTO user (id,username,password,role) VALUES (:id, :username, :password, :role)");
        $query->execute($user->toArray());
    }

    public function update(User $user): void
    {
        return;
    }

    public function findOneByUsername(string $username): ?User
    {
        $data = $this->pdo->query("SELECT * FROM user where username = '$username'")
            ->fetch(PDO::FETCH_ASSOC);
        if($data){
            return User::fromArray($data);
        }
        return null;
    }

    public function findOneById(string $id): ?User
    {
        $data = $this->pdo->query("SELECT * FROM user where id = '$id'")
            ->fetch(PDO::FETCH_ASSOC);
        if($data){
            return User::fromArray($data);
        }
        return null;
    }
}