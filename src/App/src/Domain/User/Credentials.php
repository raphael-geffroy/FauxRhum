<?php
declare(strict_types=1);

namespace App\Domain\User;

final class Credentials
{
    private Username $username;
    private HashedPassword $hashedPassword;

    private function __construct(){}

    /**
     * @throws UsernameAlreadyTakenException
     * @throws PasswordDoesNotRespectRequirementsException
     * @throws HashingErrorException
     */
    public static function create(
        string $username,
        string $plainPassword,
        UserRepositoryInterface $userRepository
    ): self {
        return (new self())
            ->setUsername(Username::createNew($username, $userRepository))
            ->setHashedPassword(HashedPassword::fromString($plainPassword));
    }

    public function setHashedPassword(HashedPassword $hashedPassword): self
    {
        $this->hashedPassword = $hashedPassword;
        return $this;
    }

    public function getHashedPassword(): HashedPassword
    {
        return $this->hashedPassword;
    }

    /**
     * @return Username
     */
    public function getUsername(): Username
    {
        return $this->username;
    }

    /**
     * @param Username $username
     * @return Credentials
     */
    public function setUsername(Username $username): self
    {
        $this->username = $username;
        return $this;
    }

    public static function createFromExisting(
        string $username,
        string $hashedPassword
    ): self {
        return (new self())
            ->setUsername(Username::create($username))
            ->setHashedPassword(HashedPassword::fromHash($hashedPassword));
    }
}