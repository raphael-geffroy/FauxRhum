<?php
declare(strict_types=1);

namespace App\Domain\User;

use Exception;

class PasswordDoesNotRespectRequirementsException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid password format.");
    }
}