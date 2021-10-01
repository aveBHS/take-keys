<?php

namespace Site\Controllers\Admin;

use Site\Core\HttpRequest;

class MainController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $request->show(view("admin.index"));
    }
}