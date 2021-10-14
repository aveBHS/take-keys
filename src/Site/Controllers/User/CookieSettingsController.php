<?php

namespace Site\Controllers\User;

use Site\Core\HttpRequest;

class CookieSettingsController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    public function config(HttpRequest $request, $args)
    {
        if(isset($args[0]) && !is_null($request->post("param"))){
            $request->setCookie($args[0], $request->post("param"));
        }
    }
}