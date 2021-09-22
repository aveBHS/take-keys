<?php

namespace Site\Controllers\Exceptions;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;

class BadRequestController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
        $request->show(view("exception",
            ["error" => (object) ["code" => 400, "message" => "Bad Request"]]
        ));
    }
}