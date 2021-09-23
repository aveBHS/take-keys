<?php

namespace Site\Controllers;

use \Site\Core\HttpRequest;

class MainController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
//        $request->show("<h1>Hello World</h1>");
        $request->redirect("https://take-keys.com/");
    }
}