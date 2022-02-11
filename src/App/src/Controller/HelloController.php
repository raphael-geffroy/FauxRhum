<?php
declare(strict_types=1);

namespace App\Controller;

use Framework\Http\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;

class HelloController extends AbstractController
{
    public function __invoke(Request $request,string $name2, string $name){
        return new Response(200,"Hello $name $name2");
    }
}