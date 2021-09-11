<?php

namespace Site\Controllers;

use \Site\Core\HttpRequest;

class MainController
{
    public function index(HttpRequest $request)
    {
        $request->show("<h1>Hello World</h1>");
    }
}