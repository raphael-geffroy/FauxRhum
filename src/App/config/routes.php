<?php
declare(strict_types=1);

use App\Controller\Article\Category\CreateController as CategoryCreateController;
use App\Controller\Article\CreateController;
use App\Controller\Article\ShowController;
use App\Controller\HelloController;
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\LogoutController;
use App\Controller\RegisterController;
use Framework\Routes\Route;
use Framework\Routes\RouteCollection;

/** @var RouteCollection $routes */
$routes->add('home', new Route("/", [
    'controller' => HomeController::class.'@__invoke'
]));
$routes->add('register', new Route("/register", [
    'controller' => RegisterController::class.'@__invoke'
]));
$routes->add('login', new Route("/login", [
    'controller' => LoginController::class.'@__invoke'
]));
$routes->add('logout', new Route("/logout", [
    'controller' => LogoutController::class.'@__invoke'
]));
$routes->add('hello', new Route("/hello/{name}/{name2}", [
    'controller' => HelloController::class.'@__invoke'
]));
$routes->add('article_create', new Route("/article", [
    'controller' => CreateController::class.'@__invoke'
]));
$routes->add('category_create', new Route("/category", [
    'controller' => CategoryCreateController::class.'@__invoke'
]));
$routes->add('article_show', new Route("/article/{id}", [
    'controller' => ShowController::class.'@__invoke'
]));