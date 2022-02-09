<?php
declare(strict_types=1);

use App\Controller\HelloController;
use Framework\Routes\Route;
use Framework\Routes\RouteCollection;

/** @var RouteCollection $routes */
$routes->add('hello', new Route("/hello/{name}", [
    'controller' => HelloController::class.'@__invoke'
]));