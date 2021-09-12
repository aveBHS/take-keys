<?php

namespace Site\Controllers\Exceptions;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;

class NotFoundController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
        $request->show(view("exception",
            ["error" => (object) ["code" => 404, "message" => "Not Found"]]
        ));
    }
}