<?php

namespace Site\Middleware;

use Site\Core\HttpRequest;

class UserMiddleware implements Middleware
{

    public function handle(HttpRequest $request, $callback, $args)
    {
        global $auth;
        if(!is_null($auth())){
            return call_user_func_array($callback, $args);
        }
        $request->setFlash("login_redirect", $request->getUrl());
        $request->redirect("/login");
        return null;
    }
}