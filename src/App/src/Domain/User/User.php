<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\Uuid;

final class User
{
    private Uuid $id;
    private Credentials $credentials;
    private Role $role;

    private function __construct(){}

    /**
     * @throws UsernameAlreadyTakenException
     * @throws PasswordDoesNotRespectRequirementsException
     * @throws HashingErrorException
     */
    public static function create(
        string $id,
        string $username,
        string $plainPassword,
        Role $role,
        UserRepositoryInterface $userRepository
    ): self
    {
        return (new self)
            ->setId(Uuid::createFromUuid($id))
            ->setCredentials(
                Credentials::create($username, $plainPassword, $userRepository)
            )->setRole($role);
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @param Uuid $id
     * @return User
     */
    public function setId(Uuid $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Credentials
     */
    public function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     * @return User
     */
    public function setCredentials(Credentials $credentials): User
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function setRole(Role $role): User
    {
        $this->role = $role;
        return $this;
    }

    public static function fromArray(array $data): self {
        return (new self)
            ->setId(Uuid::createFromUuid($data['id']))
            ->setCredentials(
                Credentials::createFromExisting($data['username'], $data['password'])
            )
            ->setRole(Role::from($data['role']));
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getId(),
            'username' => $this->getCredentials()->getUsername()->getUsername(),
            'password' => $this->getCredentials()->getHashedPassword()->getHashedPassword(),
            'role' => $this->getRole()->value
        ];
    }
}