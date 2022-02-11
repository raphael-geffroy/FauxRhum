<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\User\Logout\Logout;
use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;

final class LogoutController extends AbstractController
{
    public function __construct(
        Session $session,
        private Logout   $logout,
        private LoginController $loginController
    )
    {
        parent::__construct($session);
    }

    public function __invoke(Request $request): Response
    {
        ($this->logout)();
        return ($this->loginController)($request);
    }
}