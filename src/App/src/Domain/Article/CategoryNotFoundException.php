<?php
declare(strict_types=1);

namespace App\Domain\User;

use Exception;

class CategoryNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Category not found.");
    }

}