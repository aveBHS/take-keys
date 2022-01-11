<?php

namespace Site\Controllers\Exceptions;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;

class ClosedController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
        $request->show(view("exception",
            ["error" => (object) ["code" => 503, "message" => "Проводятся технические работы"]]
        ));
    }
}