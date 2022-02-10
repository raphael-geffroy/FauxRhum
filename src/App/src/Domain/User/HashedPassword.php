<?php
declare(strict_types=1);

namespace App\Domain\User;

final class HashedPassword
{
    private function __construct(
        private string $hashedPassword
    ){}

    /**
     * @throws PasswordDoesNotRespectRequirementsException
     * @throws HashingErrorException
     */
    static function fromString(string $plainPassword): self
    {
        if(!self::checkRequirements($plainPassword)){
            throw new PasswordDoesNotRespectRequirementsException;
        }
        return new self(self::hash($plainPassword));
    }

    static function fromHash(string $hashedPassword): self
    {
        return new self($hashedPassword);
    }

    /**
     * @throws HashingErrorException
     */
    private static function hash(string $plainPassword): string
    {
        //https://symfony.com/doc/current/security/passwords.html#the-auto-hasher
        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        if(is_bool($hashedPassword)){
            throw new HashingErrorException;
        }
        return $hashedPassword;
    }

    function match(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }

    private static function checkRequirements(string $plainPassword): bool
    {
        $containsUppercaseChar = preg_match('@[A-Z]@', $plainPassword);
        $containsLowercaseChar = preg_match('@[a-z]@', $plainPassword);
        $containsNumber = preg_match('@[0-9]@', $plainPassword);
        $is8CharLongOrMore = strlen($plainPassword) > 8;

        $requirements = [ $containsUppercaseChar, $containsLowercaseChar, $containsNumber, $is8CharLongOrMore ];
        return !in_array(false, $requirements);
    }

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }


}