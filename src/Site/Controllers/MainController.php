<?php

namespace Site\Controllers;

use \Site\Core\HttpRequest;

class MainController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
        $request->show(view("index"));
    }
}