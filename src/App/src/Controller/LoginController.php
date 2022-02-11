<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\User\Login\Login;
use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;

final class LoginController extends AbstractController
{
    public function __construct(
        private Session $session,
        private Login   $login
    )
    {
        parent::__construct($session);
    }

    public function __invoke(Request $request): Response
    {
        if ($request->getMethod() === 'POST'
            && $this->validateForm($request->getParams())) {
            ($this->login)(
                $request->getParam('username'),
                $request->getParam('password')
            );
            $this->session->addMessage(sprintf("You are logged in as %s.", $request->getParam('username')));
        }
        return $this->render('login.html.php');
    }

    private function validateForm(array $params): bool
    {
        return isset($params['username']) && isset($params['password']);
    }
}