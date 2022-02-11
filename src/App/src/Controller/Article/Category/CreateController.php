<?php
declare(strict_types=1);

namespace App\Controller\Article\Category;

use App\Application\Article\Category\Create\Create;
use App\Domain\User\CategoryNotFoundException;
use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;

final class CreateController extends AbstractController
{
    public function __construct(
        private Session $session,
        private Create $create
    ){
        parent::__construct($session);
    }

    public function __invoke(Request $request): Response
    {
        if ($request->getMethod() === 'POST'
            && $this->validateForm($request->getParams())) {
            ($this->create)(
                $request->getParam('name')
            );
            $this->session->addMessage(sprintf("Category %s created.", $request->getParam('name')));
        }
        return $this->render('article/category/create.html.php');
    }

    private function validateForm(array $params): bool
    {
        return isset($params['name']);
    }
}