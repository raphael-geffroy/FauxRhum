<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\User\Register\Register;
use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;

final class RegisterController extends AbstractController
{
    public function __construct(
        private Session       $session,
        private Register $register
    )
    {
        parent::__construct($session);
    }

    public function __invoke(Request $request): Response {
        if($request->getMethod() === 'POST'
        &&$this->validateForm($request->getParams())){
            ($this->register)(
                $request->getParam('username'),
                $request->getParam('password'),
                false
            );
            $this->session->addMessage(sprintf("User %s has been created.", $request->getParam('username')));
        }
        return $this->render('register.html.php');
    }

    private function validateForm(array $params): bool {
        return isset($params['username']) && isset($params['password']);
    }
}