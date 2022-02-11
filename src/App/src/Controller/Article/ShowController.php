<?php
declare(strict_types=1);

namespace App\Controller\Article;

use App\Application\Article\FindOneById\FindOneById as FindOneArticleById;
use App\Application\Article\Category\FindOneById\FindOneById as FindOneCategoryById;
use App\Application\User\FindOneById\FindOneById as FindOneUserById;
use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Session;

final class ShowController extends AbstractController
{
    public function __construct(
        Session $session,
        private FindOneCategoryById $findOneCategoryById,
        private FindOneArticleById $findOneArticleById,
        private FindOneUserById $findOneUserById
    ){
        parent::__construct($session);
    }

    public function __invoke(Request $request, string $id): Response {
        $article = ($this->findOneArticleById)($id);
        if($article === null){
            return $this->render404();
        }
        $author = ($this->findOneUserById)($article->getAuthorId()->getId());
        $category = $article->getCategoryId()?->getId()?($this->findOneCategoryById)($article->getCategoryId()->getId()):null;
        return $this->render('article/show.html.php', [
            'article'=>$article,
            'author'=>$author,
            'category'=>$category
        ]);
    }

}