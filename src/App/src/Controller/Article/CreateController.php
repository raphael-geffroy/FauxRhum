<?php
declare(strict_types=1);

namespace App\Controller\Article;

use App\Application\Article\Create\Create;
use App\Domain\Article\CategoryRepositoryInterface;
use App\Domain\User\CategoryNotFoundException;
use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;

final class CreateController extends AbstractController
{
    public function __construct(
        private Session $session,
        private Create   $create,
        private CategoryRepositoryInterface $categoryRepository
    ){
        parent::__construct($session);
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function __invoke(Request $request): Response
    {
        if ($request->getMethod() === 'POST'
            && $this->validateForm($request->getParams())
            && $this->session->has('user-id')) {
            ($this->create)(
                $request->getParam('title'),
                $request->getParam('content'),
                $this->session->get('user-id'),
                $request->getParam('category')
            );
            $this->session->addMessage(sprintf("Article %s created.", $request->getParam('title')));
        }
        $categories = $this->categoryRepository->findAll();
        return $this->render('article/create.html.php', ['categories'=>$categories]);
    }

    private function validateForm(array $params): bool
    {
        return isset($params['title']) && isset($params['content']);
    }
}