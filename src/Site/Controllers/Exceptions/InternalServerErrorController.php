<?php

namespace Site\Controllers\Exceptions;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;

class InternalServerErrorController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
        $request->show(view("exception",
            ["error" => (object) ["code" => 500, "message" => "Internal Server Error"]]
        ));
    }
}