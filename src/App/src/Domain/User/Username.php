<?php
declare(strict_types=1);

namespace App\Domain\User;

final class Username
{
    private string $username;

    private function __construct(){}

    public static function create(string $username): self {
        return (new self())
            ->setUsername($username);
    }

    /**
     * @throws UsernameAlreadyTakenException
     */
    public static function createNew(string $username, UserRepositoryInterface $userRepository): self {
        return (new self())
            ->setUsernameAndCheckUniqueness($username, $userRepository);
    }

    /**
     * @throws UsernameAlreadyTakenException
     */
    public function setUsernameAndCheckUniqueness(string $email, UserRepositoryInterface $userRepository): self
    {
        self::assertUsernameIsAvailable($email, $userRepository);
        $this->setUsername($email);
        return $this;
    }

    /**
     * @throws UsernameAlreadyTakenException
     */
    private static function assertUsernameIsAvailable(string $email, UserRepositoryInterface $userRepository)
    {
        if($userRepository->findOneByUsername($email) !== null){
            throw new UsernameAlreadyTakenException;
        }
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return self
     */
    private function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
}