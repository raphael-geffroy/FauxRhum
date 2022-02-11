<?php
declare(strict_types=1);

namespace App\Domain\User;

use Exception;

class UsernameAlreadyTakenException extends Exception
{
    public function __construct()
    {
        parent::__construct("This username is already taken.");
    }
}