<?php
require_once __DIR__.'/../vendor/autoload.php';

use Framework\Http\Request;
use Framework\Kernel;

$request = new Request($_SERVER['PATH_INFO']??"/", array_merge($_GET, $_POST), $_SERVER['REQUEST_METHOD']);
$response = (new Kernel())->handle(
    $request,
    __DIR__.'/../src/App/config/',
);
$response->send();