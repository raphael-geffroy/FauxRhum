<?php
require_once __DIR__.'/../vendor/autoload.php';

use Framework\Http\Request;
use Framework\Kernel;


$request = new Request($_SERVER['PATH_INFO']??"/", $_GET);
$response = (new Kernel())->handle($request);
$response->send();