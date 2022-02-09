<?php
require_once __DIR__.'/../vendor/autoload.php';

use Framework\Http\Request;
use Framework\Kernel;

$request = new Request($_SERVER['PATH_INFO']??"/", $_GET);
$response = (new Kernel())->handle(
    $request,
    __DIR__.'/../src/App/config/container.php',
    __DIR__.'/../src/App/config/routes.php'
);
$response->send();