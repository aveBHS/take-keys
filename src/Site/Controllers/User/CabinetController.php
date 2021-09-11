<?php

namespace Site\Controllers\User;

use Site\Core\HttpRequest;

class CabinetController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $request->show(view("cabinet.index"));
    }
}