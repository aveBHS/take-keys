<?php

namespace Site\Middleware;

use Site\Controllers\Exceptions\ForbiddenController;
use Site\Core\HttpRequest;

class AdminMiddleware implements Middleware
{

    public function handle(HttpRequest $request, $callback, $args)
    {
        global $auth;
        if(!is_null($auth())){
            var_dump($auth());
            if($auth()->admin){
                return call_user_func_array($callback, $args);
            } else {
                $request->returnException(new ForbiddenController, 403);
                return null;
            }
        }
        $request->setFlash("login_redirect", $request->getUrl());
        $request->redirect("/login");
        return null;
    }
}