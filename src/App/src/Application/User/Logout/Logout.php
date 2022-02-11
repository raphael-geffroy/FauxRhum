<?php
declare(strict_types=1);

namespace App\Application\User\Logout;

use Framework\Http\Session;

final class Logout
{
    public function __construct(
        private Session $session
    ){}

    public function __invoke(): void {
        $this->session->remove('user-id');
    }
}