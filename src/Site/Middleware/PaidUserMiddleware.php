<?php

namespace Site\Middleware;

use Site\Core\HttpRequest;

class PaidUserMiddleware implements Middleware
{

    public function handle(HttpRequest $request, $callback, $args)
    {
        global $auth;
        if(!is_null($auth()) && $auth()->request->purchased == 1){
            return call_user_func_array($callback, $args);
        }
        $request->redirect("/");
        return null;
    }
}