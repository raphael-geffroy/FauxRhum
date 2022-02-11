<?php
declare(strict_types=1);

namespace App\Domain\User;

use Exception;

class HashingErrorException extends Exception
{
    public function __construct()
    {
        parent::__construct("Server error hashing password.");
    }

}