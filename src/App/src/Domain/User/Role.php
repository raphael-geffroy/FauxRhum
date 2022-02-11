<?php
declare(strict_types=1);

namespace App\Domain\User;

enum Role: string {
    case Administrator = "ADMINISTRATOR";
    case User = "USER";
}