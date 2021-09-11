<?php

namespace Site\Controllers\Exceptions;

use Site\Core\HttpRequest;

class NotFoundController
{
    public function view(HttpRequest $request)
    {
        $request->show("404 Not Found");
    }
}