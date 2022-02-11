<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\Article\Category\FindAll\FindAll as FindAllCategories;
use App\Application\Article\FindAll\FindAll as FindAllArticles;
use App\Application\User\GetUserFromSession\GetUserFromSession;
use Framework\Http\AbstractController;
use Framework\Http\Response;
use Framework\Http\Session;

final class HomeController extends AbstractController
{
    public function __construct(
        private Session $session,
        private GetUserFromSession $getUserFromSession,
        private FindAllCategories $findAllCategories,
        private FindAllArticles $findAllArticles
    ){
        parent::__construct($session);
    }

    public function __invoke(): Response
    {
        $user = ($this->getUserFromSession)();
        $categories = ($this->findAllCategories)();
        if($user !== null){
            $this->session->addMessage(sprintf("You are logged in as %s", $user->getCredentials()->getUsername()->getUsername()));
        }
        return $this->render('home.html.php', [
            'user'=>$user,
            'categories'=> ($this->findAllCategories)(),
            'articles'=> ($this->findAllArticles)(true),
            ]);
    }
}